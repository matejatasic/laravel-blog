@extends('layouts.main')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Edit Post</h1>
        </div>
        <hr>
        <div class="my-2">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-black">Back</a>
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
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="editForm" class="form my-3">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea name="body" id="body" cols="30" rows="10">{{ $post->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>Post Image</label>
                    <input type="file" name="img_path" id="img_path">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags</label>
                    <select class="select-category" name="tags[]" multiple="multiple">
                        @foreach($tags as $tag)
                            <option value='{{ $tag->id }}'>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <input type="submit" class="btn btn-success" value="Update">
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            $('.select-category').select2();
        })
    </script>
@endsection
