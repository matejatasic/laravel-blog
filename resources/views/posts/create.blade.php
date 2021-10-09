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
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="createForm" class="form my-3">
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
                <div class="form-group">
                    <label>Category</label>
                    <select name="categories">
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
                
                <input type="submit" id="submit" class="btn btn-success" value="Create">
        </form>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $('.select-category').select2();
    </script>
@endsection
