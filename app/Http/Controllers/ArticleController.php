<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{
    /**
     * Roles allowed to write/manage articles — kept in sync with the
     * CAN_MANAGE_ARTICLES list in resources/js/Layouts/AuthenticatedLayout.jsx.
     */
    private const MANAGER_ROLES = ['super_admin', 'admin', 'editor', 'author'];

    /**
     * GET /articles — public listing.
     * Feeds Pages/Articles/Index.jsx via { articles: { data, links, meta } }.
     */
    public function index(Request $request): Response
    {
        $userId = optional($request->user())->id;

        $articles = Article::query()
            ->with(['category:id,name,slug', 'author:id,name'])
            ->when($userId, fn ($q) => $q->with(['bookmarks' => fn ($q2) => $q2->where('user_id', $userId)]))
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString()
            ->through(fn (Article $article) => $this->toCard($article, $userId));

        return Inertia::render('Articles/Index', [
            'articles' => $articles,
        ]);
    }

    /**
     * GET /articles/{article:slug} — public single article.
     * Feeds Pages/Articles/Show.jsx via { article }.
     */
    public function show(Article $article): Response
    {
        $user = request()->user();
        $isManager = $user && in_array($user->role, self::MANAGER_ROLES, true);
        $isOwner = $user && $user->id === $article->user_id;

        abort_unless($article->status === 'published' || $isManager || $isOwner, 404);

        $article->load([
            'category:id,name,slug',
            'author:id,name',
            'comments' => fn ($q) => $q->where('approved', true)->latest(),
        ]);

        if ($user) {
            $article->load(['bookmarks' => fn ($q) => $q->where('user_id', $user->id)]);
        }

        return Inertia::render('Articles/Show', [
            'article' => [
                ...$this->toCard($article, optional($user)->id),
                'content' => $article->content,
                'comments' => $article->comments->map(fn ($comment) => [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'name' => $comment->name,
                    'created_at' => $comment->created_at->diffForHumans(),
                ]),
            ],
        ]);
    }

    /**
     * GET /manage/articles/create.
     * Feeds Pages/Articles/Create.jsx via { categories }.
     */
    public function create(Request $request): Response
    {
        $this->authorizeManager($request);

        return Inertia::render('Articles/Create', [
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * POST /manage/articles.
     */
    public function store(Request $request)
    {
        $this->authorizeManager($request);

        $data = $this->validateArticle($request);

        $article = new Article();
        $article->title = $data['title'];
        $article->slug = $this->uniqueSlug($data['title']);
        $article->category_id = $data['category_id'];
        $article->excerpt = $data['excerpt'] ?? null;
        $article->content = $data['content'];
        $article->status = $data['status'];
        $article->user_id = $request->user()->id;
        $article->read_time = $this->estimateReadTime($data['content']);
        $article->published_at = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('cover_image')) {
            $article->featured_image = $request->file('cover_image')->store('covers', 'public');
        }

        $article->save();

        return redirect()
            ->route('articles.edit', $article)
            ->with('success', 'Article saved.');
    }

    /**
     * GET /manage/articles/{article}/edit.
     * Feeds Pages/Articles/Edit.jsx via { article, categories }.
     */
    public function edit(Request $request, Article $article): Response
    {
        $this->authorizeManager($request, $article);

        return Inertia::render('Articles/Edit', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'category_id' => $article->category_id,
                'excerpt' => $article->excerpt,
                'content' => $article->content,
                'status' => $article->status,
                'cover_image' => $article->featured_image ? Storage::url($article->featured_image) : null,
            ],
            'categories' => Category::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * PUT /manage/articles/{article}.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorizeManager($request, $article);

        $data = $this->validateArticle($request);

        if ($article->title !== $data['title']) {
            $article->slug = $this->uniqueSlug($data['title'], $article->id);
        }

        $article->title = $data['title'];
        $article->category_id = $data['category_id'];
        $article->excerpt = $data['excerpt'] ?? null;
        $article->content = $data['content'];
        $article->read_time = $this->estimateReadTime($data['content']);

        if ($article->status !== 'published' && $data['status'] === 'published') {
            $article->published_at = now();
        }
        $article->status = $data['status'];

        if ($request->hasFile('cover_image')) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $article->featured_image = $request->file('cover_image')->store('covers', 'public');
        }

        $article->save();

        return redirect()
            ->route('articles.edit', $article)
            ->with('success', 'Article updated.');
    }

    /**
     * DELETE /manage/articles/{article}.
     */
    public function destroy(Request $request, Article $article)
    {
        $this->authorizeManager($request, $article);

        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article deleted.');
    }

    /**
     * Shared validation rules for store/update.
     */
    private function validateArticle(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'pending', 'published'])],
            // Explicit mimes (no svg): the default 'image' rule allows SVG,
            // which can carry embedded <script> and enable stored XSS
            // when served back from public storage.
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
        ]);
    }

    /**
     * Only managers (super-admin/admin/editor/author) may write articles.
     * Authors may only edit/delete their own articles; other manager roles may touch any.
     */
    private function authorizeManager(Request $request, ?Article $article = null): void
    {
        $user = $request->user();
        abort_unless($user && in_array($user->role, self::MANAGER_ROLES, true), 403);

        if ($article && $user->role === 'author') {
            abort_unless($article->user_id === $user->id, 403);
        }
    }

    /**
     * Generate a unique slug, excluding the given article id on update.
     */
    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (
            Article::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    /**
     * ~200 words per minute, minimum 1 minute.
     * NOTE: read_time is set via direct property assignment (not mass-assigned),
     * so it isn't confirmed against the model's $fillable list — verify this
     * column actually exists in your articles migration.
     */
    private function estimateReadTime(string $content): int
    {
        $words = str_word_count(strip_tags($content));

        return max(1, (int) round($words / 200));
    }

    /**
     * Shape shared by the index card list and the base of the show payload.
     * $userId is used to compute is_saved from an already-eager-loaded,
     * user-scoped 'bookmarks' relation — no per-card query.
     */
    private function toCard(Article $article, ?int $userId = null): array
    {
        return [
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
            'excerpt' => $article->excerpt,
            'cover_image' => $article->featured_image ? Storage::url($article->featured_image) : null,
            'published_at' => $article->published_at?->format('M j, Y'),
            'read_time' => $article->read_time,
            'is_saved' => $userId && $article->relationLoaded('bookmarks')
                ? $article->bookmarks->isNotEmpty()
                : false,
            'category' => $article->category ? [
                'id' => $article->category->id,
                'name' => $article->category->name,
                'slug' => $article->category->slug,
            ] : null,
            'author' => $article->author ? [
                'id' => $article->author->id,
                'name' => $article->author->name,
            ] : null,
        ];
    }
}