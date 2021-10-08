<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class AdminController extends Controller
{
    public function dashboard() {
        $posts = Post::all();
        $comments = Comment::all();
        $likes = Like::all();

        return view('admin.dashboard', [
            'posts' => $posts,
            'comments' => $comments,
            'likes' => $likes,
        ]);
    }

    public function getUsers() {
        $users = User::paginate(10);
        
        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function getPosts() {
        $posts = Post::paginate(10);
        
        return view('admin.posts', [
            'posts' => $posts,
        ]);
    }

    public function showPost($id) {
        $post = Post::find($id);
        
        return response()->json([
            'data' => $post,
        ]);
    }
}
