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

    // Users
    public function getUsers() {
        $users = User::where('role', 'user')->paginate(10);
        
        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function banUser(Request $request)
    {
        $user = User::find($request->id);
        $user->status = 'banned';
        $user->save();

        Session::flash('success', 'You have successfully banned the user!');

        return redirect()->route('admin.users');
    }
    
    public function unbanUser(Request $request)
    {
        $user = User::find($request->id);
        $user->status = 'active';
        $user->save();

        Session::flash('success', 'You have successfully unbanned the user!');

        return redirect()->route('admin.users');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('success', 'You have successfully deleted the user!');

        return redirect()->route('admin.users');
    }

    // Posts
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


        Session::flash('success', 'You have successfully deleted the post');

        return redirect()->route('admin.posts');
    }

    // Comments
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
    
    public function deleteComment($id) {
        $comment = Comment::find($id);
        $comment->delete();

        Session::flash('success', 'You have successfully deleted the comment!');

        return redirect()->route('admin.comments');
    }

    // Categories
    public function getCategories() {
        $categories = Category::paginate(10);
        
        return view('admin.categories', [
            'categories' => $categories,
        ]);
    }

    public function createCategory(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $category = new Category;

        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'You have successfully created the category!');

        return redirect()->route('admin.categories');
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

        Session::flash('success', 'You have successfully updated the category!');

        return redirect()->route('admin.categories');
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'You have successfully deleted the category!');

        return redirect()->route('admin.categories');
    }

    // Tags
    public function getTags() {
        $tags = Tag::paginate(10);
        
        return view('admin.tags', [
            'tags' => $tags,
        ]);
    }

    public function createTag(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $tag = new Tag;

        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'You have successfully created the tag!');

        return redirect()->route('admin.tags');
    }

    public function editTag($id) {
        $tag = Tag::find($id);
        
        return response()->json([
            'data' => $tag,
        ]);
    }
    
    public function updateTag(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|max:20',
        ]);

        $tag = Tag::find($id);

        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'You have successfully updated the tag!');

        return redirect()->route('admin.tags');
    }

    public function deleteTag($id) {
        $tag = Tag::find($id);
        $tag->delete();

        Session::flash('success', 'You have successfully deleted the tag!');

        return redirect()->route('admin.tags');
    }
    
    // Likes
    public function getLikes() {
        $likes = Like::paginate(10);
        
        return view('admin.likes', [
            'likes' => $likes,
        ]);
    }
}
