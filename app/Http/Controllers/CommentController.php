<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Roles allowed to remove comments — matches the real values on
     * User::role (underscores, e.g. 'super_admin'), not hyphens.
     */
    private const MODERATOR_ROLES = ['super_admin', 'admin', 'editor', 'moderator'];

    /**
     * POST /articles/{article}/comments
     *
     * Guest comments — no auth required. $article comes from route-model
     * binding, not from the request body (the frontend only ever sends
     * name/email/content).
     */
    public function store(Request $request, Article $article)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'content' => ['required', 'string', 'min:3', 'max:2000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        Comment::create([
            'article_id' => $article->id,
            'parent_id' => $data['parent_id'] ?? null,

            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'content' => $data['content'],

            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),

            'approved' => true,
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }

    /**
     * DELETE /comments/{comment}
     *
     * Guest comments have no owning user, so removal is moderator-only —
     * there's no "is this my comment" check possible here.
     */
    public function destroy(Request $request, Comment $comment)
    {
        $user = $request->user();
        abort_unless($user && in_array($user->role, self::MODERATOR_ROLES, true), 403);

        $comment->delete();

        return back()->with('success', 'Comment removed.');
    }
}