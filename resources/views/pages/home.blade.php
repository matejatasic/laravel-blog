@extends('layouts.main')

@section('content')
    <!-- header image -->
    <div id="header-image">
        <div class="block-text">
            <h1 class="heading">Laravel Blog</h1>
            <p>Welcome to the Laravel blog. Here you can write and view blog posts, comments and like comments.</p>
            <a href="#" class="btn btn-primary">Read more</a>
        </div>
    </div>
    <!-- header image -->
    
    <!-- skills -->
    <div id="skills-div">
        <div id="skills">
            <h2>I'm an expert in...</h2>
            <span>PHP</span>
            <span>Laravel</span>
            <span>Symfony</span>
            <span>CodeIgniter</span>
        </div>
    </div>
    <!-- !skills -->
    
    <!-- latest post -->
    <div id="latest-post">
        <h2>Recent Posts</h2>
        <div id="post" class="my-3">
            <div>
                <img src="{{ $latest_post->img_path }}" alt="post_image">
            </div>
            <div class="px-3">
                <h2>{{ $latest_post->title > 20 ? substr($latest_post->title, 0, 20) . '...' : $latest_post->title }}</h2>
                <span class="mb-2">By <b>{{ $latest_post->user->name }}</b>, {{ $latest_post->created_at->diffForHumans() }}</span>
                <p>
                    {{ strlen(strip_tags($latest_post->body)) > 150 ? substr(strip_tags($latest_post->body), 0, 150) . '...' : strip_tags($latest_post->body) }}
                </p>
                <a href="{{ route('posts.show', $latest_post->id) }}" class="btn btn-primary mb-2">Read More</a>
            </div>
        </div>
    </div>
    <!-- !latest post -->
@endsection
