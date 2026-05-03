<?php
namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Get user bookmarks
     */
    public function index()
    {
        return auth()->user()
            ->bookmarks()
            ->with('article')
            ->latest()
            ->get();
    }

    /**
     * Toggle bookmark (add/remove)
     */
    public function toggle($article_id)
    {
        $userId = auth()->id();

        $bookmark = Bookmark::where('user_id', $userId)
            ->where('article_id', $article_id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();

            return response()->json([
                'message' => 'Bookmark removed'
            ]);
        }

        $bookmark = Bookmark::create([
            'user_id' => $userId,
            'article_id' => $article_id
        ]);

        return response()->json([
            'message' => 'Bookmarked',
            'bookmark' => $bookmark
        ]);
    }

    /**
     * Remove bookmark directly
     */
    public function destroy($article_id)
    {
        Bookmark::where('user_id', auth()->id())
            ->where('article_id', $article_id)
            ->delete();

        return response()->json([
            'message' => 'Bookmark removed'
        ]);
    }
}