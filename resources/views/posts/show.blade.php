@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">{{ $post->title }}</h1>
        </div>
        <hr>
        <div class="my-3">
            <p class="lead">By <b>{{ $user->name }}</b>, {{ date( 'F j, Y', strtotime($post->created_at)) }}</p>
            <div class="post-image my-3">
                <img src="{{ $post->img_path }}" alt="post_image">
            </div>
            <div>
                <p class="lead">{{ $post->body }}</p>
            </div>
        </div>
    </div>
@endsection

