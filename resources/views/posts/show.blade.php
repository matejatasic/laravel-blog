@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">{{ $post->title }}</h1>
        </div>
        <hr>
        <div class="my-3">
            @if ($post->user_id === auth()->user()->id)
                <div class="user-auth-btns mb-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mb-1">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id )}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </div>
            @endif
            <p class="lead">By <b>{{ $post->user->name }}</b>, {{ date( 'F j, Y', strtotime($post->created_at)) }}</p>
            <div class="post-image my-3">
                <img src="{{ $post->img_path }}" alt="post_image">
            </div>
            <div>
                <p class="lead">{{ $post->body }}</p>
            </div>
        </div>
    </div>
@endsection

