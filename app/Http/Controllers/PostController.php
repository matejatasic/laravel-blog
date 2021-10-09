<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use App\Models\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id = 0)
    {
        if($category_id === 0) {
            $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        }
        else {
            $posts = Post::where('category_id', $category_id)->paginate(10);    
        }
        $categories = Category::all();
        
        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:20',
            'body' => 'required',
            'img_path' => 'required|mimes:jpeg,png|max:1024'
        ]);

        $image_name = '/img/post_images/' . time() . 'post_image.' . $request->img_path->extension();

        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->img_path = $image_name;
        $post->save();

        $request->img_path->move(public_path('img/post_images'), $image_name);

        Session::flash('success', 'Successfully added the post!');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $image_name;
        $old_image;

        if($request->hasFile('img_path') && $request->img_path->isValid()) {
            $this->validate($request, [
                'title' => 'required|max:20',
                'body' => 'required',
                'img_path' => 'mimes:jpeg,png|max:1024'
            ]);

            $old_image = $post->img_path;
            $image_name = '/img/post_images/' . time() . 'post_image.' . $request->img_path->extension();
            $request->img_path->move(public_path('img/post_images'), $image_name);

            File::delete(public_path($old_image));
        }
        else {
            $this->validate($request, [
                'title' => 'required|max:20',
                'body' => 'required',
            ]);

            $image_name = $post->img_path;
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->img_path = $image_name;
        $post->save();

        Session::flash('success', 'Successfully updated the post!');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        File::delete(public_path($post->img_path));

        Session::flash('success', 'Successfully deleted the post');

        return redirect()->route('posts.index');
    }
}
