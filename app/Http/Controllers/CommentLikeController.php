<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function store(Comment $comment, Request $request) {
        if($comment->likedBy($request->user())) {
            return response(null, 409);
        }

        $comment->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function destroy(Comment $comment, Request $request) {
        $request->user()->likes()->where('comment_id', $comment->id)->delete();

        return redirect()->route('posts.show', $comment->post->id);
    }
}
