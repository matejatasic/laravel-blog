@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">{{ $post->title }}</h1>
        </div>
        <hr>
        <div class="my-3">
            @if (Auth::check() && $post->user_id === auth()->user()->id)
                <div class="user-auth-btns mb-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mb-1">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id )}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <p class="lead">By <b>{{ $post->user->name }}</b>, {{ date( 'F j, Y', strtotime($post->created_at)) }}</p>
            <div class="mb-2">
                <strong>Tags:</strong>
                @foreach ($post->tags as $tag)
                    <span class="badge badge-primary">{{ $tag->name }}</span>
                @endforeach
            </div>
            <div>
                <strong>Category:</strong>
                <span class="badge badge-dark">{{ $post->category->name }}</span>
            </div>
            <div class="post-image my-3">
                <img src="{{ $post->img_path }}" alt="post_image">
            </div>
            <div>
                <p class="lead">{{ $post->body }}</p>
            </div>
        </div>
        <hr>
        <div class="my-2">
            <!-- comments -->
            <h2 class="medium text-center">Comments</h2>
            @if (Auth::check())
                <div>
                    <a href="{{ route('comments.create', $post->id) }}" class="btn btn-success create mb-3">Create</a>
                </div>
            @endif
            
            @if (count($post->comments) > 0)
                @foreach ($post->comments as $comment)
                    <div class="comment">
                        <div>
                            <img src="{{ $comment->user->img_path }}" alt="user_avatar">
                        </div>
                        <div>
                            <h3 class="comment-title">{{ $comment->title }}</h3>
                            <p class="comment-text">{{ $comment->comment }}</p>
                            @if (Auth::check())
                                <div>
                                    @if (!$comment->likedBy(auth()->user()))
                                        <form action="{{ route('comments.likes', $comment) }}" method="post">
                                            @csrf
                                            <input type="submit" id="like-btn" value="Like">
                                        </form>
                                    @else
                                        <form action="{{ route('comments.likes', $comment) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" id="dislike-btn" value="Unlike">
                                        </form>
                                    @endif
                                    @if (auth()->user()->id === $comment->user->id)
                                        <a href="{{ route('comments.edit', $comment->id) }}" id="edit-btn">Edit</a>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" id="delete-btn" value="Delete">
                                        </form>
                                    @endif
                                </div>
                            @endif 
                        </div>  
                    </div>
                @endforeach
            @else
                <p class="lead">No comments have been posted yet</p>
            @endif
            <!-- !comments -->
        </div>
    </div>
@endsection
