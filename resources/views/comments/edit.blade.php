@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Edit Comment</h1>
        </div>
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('comments.update', $comment->id) }}" method="POST" id="createForm" class="form my-3">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ $comment->title }}">
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea name="comment" cols="30" rows="10">{{ $comment->comment }}</textarea>
                </div>
            
                <input type="submit" id="submit" class="btn btn-success" value="Update">
        </form>
    </div>
@endsection
