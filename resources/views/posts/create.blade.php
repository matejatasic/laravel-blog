@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Create Post</h1>
        </div>
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="form my-3">
            @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea name="body" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label>Post Image</label>
                    <input type="file" name="img_path">
                </div>
                
                <input type="submit" class="btn btn-success" value="Create">
        </form>
    </div>
@endsection
