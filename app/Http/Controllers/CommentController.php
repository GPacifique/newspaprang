<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'name' => 'required|max:255',
            'email' => 'nullable|email',
            'content' => 'required|min:3|max:2000',
        ]);

        Comment::create([
            'article_id' => $request->article_id,
            'parent_id' => $request->parent_id,

            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,

            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),

            'approved' => true,
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }
}