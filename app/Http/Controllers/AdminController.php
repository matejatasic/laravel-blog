<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Like;
use Session;

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
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.posts', [
            'posts' => $posts,
        ]);
    }

    public function showPost($id) {
        $post = Post::find($id);
        $user = $post->user->name;
        
        return response()->json([
            'data' => [$post, $user],
        ]);
    }
    
    public function approvePost(Request $request) {
        $post = Post::find($request->id);

        $post->approved = 'approved';

        $post->save();
        
        Session::flash('success', 'You have successfully approved the post!');

        return redirect()->route('admin.posts');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        $post->tags()->detach();
        File::delete(public_path($post->img_path));


        Session::flash('success', 'Successfully deleted the post');

        return redirect()->route('admin.posts');
    }

    public function getComments() {
        $comments = Comment::paginate(10);
        
        return view('admin.comments', [
            'comments' => $comments,
        ]);
    }
    
    public function editComment($id) {
        $comment = Comment::find($id);
        
        return response()->json([
            'data' => $comment,
        ]);
    }
    
    public function updateComment(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required|max:20',
            'comment' => 'required',
        ]);

        $comment = Comment::find($id);

        $comment->title = $request->title;
        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'You have successfully updated the comment!');

        return redirect()->route('admin.comments');
    }

    public function approveComment(Request $request) {
        $comment = Comment::find($request->id);

        $comment->approved = 'approved';

        $comment->save();
        
        Session::flash('success', 'You have successfully approved the comment!');

        return redirect()->route('admin.comments');
    }
    
    public function deleteComment(Request $request) {
        $comment = Comment::find($request->id);

        $comment->approved = 'approved';

        $comment->save();
        
        Session::flash('success', 'You have successfully approved the comment!');

        return redirect()->route('admin.comments');
    }

    public function getCategories() {
        $categories = Category::paginate(10);
        
        return view('admin.categories', [
            'categories' => $categories,
        ]);
    }

    public function editCategory($id) {
        $category = Category::find($id);
        
        return response()->json([
            'data' => $category,
        ]);
    }
    
    public function updateCategory(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $category = Category::find($id);

        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'You have successfully updated the comment!');

        return redirect()->route('admin.categories');
    }

    public function getTags() {
        $tags = Tag::paginate(10);
        
        return view('admin.tags', [
            'tags' => $tags,
        ]);
    }
    
    public function getLikes() {
        $likes = Like::paginate(10);
        
        return view('admin.likes', [
            'likes' => $likes,
        ]);
    }
}
