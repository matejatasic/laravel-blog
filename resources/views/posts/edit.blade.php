@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Edit Post</h1>
        </div>
        <hr>
        <div class="my-2">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-warning">Back</a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="form my-3">
            @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea name="body" cols="30" rows="10">{{ $post->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>Post Image</label>
                    <input type="file" name="img_path">
                </div>
                
                <input type="submit" class="btn btn-success" value="Update">
        </form>
    </div>
@endsection
