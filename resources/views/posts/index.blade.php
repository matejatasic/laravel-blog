@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Blog Posts</h1>
        </div>
        <hr>
        <div class="my-3">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Auth::check())
                <div>
                    <a href="{{ route('posts.create') }}" class="btn btn-success create mb-3">Create</a>
                </div>
            @endif
            @foreach ($posts as $post)
                <div class="blog-post mb-4">
                    <div>
                        <img src="{{ $post->img_path }}" alt="post_image">
                    </div>
                    <div class="px-3">
                        <h2 class="medium">{{ $post->title > 20 ? substr($post->title, 0, 20) . '...' : $post->title }}</h2>
                        <p class="mb-2">By <b>{{ $post->user->name }}</b>, {{ $post->created_at->diffForHumans() }}</p>
                        <p class="lead">
                            {{ strlen($post->body) > 150 ? substr($post->body, 0, 150) . '...' : $post->body }}
                        </p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links('vendor.custom') }}
    </div>
@endsection
