@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Admin Dashboard</h1>
    </div>
    <hr>
    <div class="my-3">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div id="statistics">
            <div class="blog-statistic mb-4">
                <h2>Total Posts</h2>
                <p>{{ count($posts) }}</p>
            </div>
            <div class="blog-statistic mb-4">
                <h2>Total Comments</h2>
                <p>{{ count($comments) }}</p>
            </div>
            <div class="blog-statistic mb-4">
                <h2>Total Likes</h2>
                <p>{{ count($likes) }}</p>
            </div>
        </div>
    </div>
@endsection
