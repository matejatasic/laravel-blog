@extends('layouts.main')

@section('content')
    <!-- background-image -->
    <div class="background-image">
        <img src="{{ asset('img/background.jpg') }}" alt="background">
        <div class="block-text">
            <h1 class="heading">Laravel Blog</h1>
            <p class="lead">Welcome to the Laravel blog. Here you can write and view blog posts, comments and like comments.</p>
            <a href="#" class="btn btn-primary">Read more</a>
        </div>
    </div>
    <!-- !background-image -->
@endsection
