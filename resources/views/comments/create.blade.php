@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Create Comment</h1>
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
        <form action="{{ route('comments.store') }}" method="POST" id="createForm" class="form my-3">
            @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title">
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea name="comment" cols="30" rows="10"></textarea>
                </div>
                <input type="hidden" name="post_id" value="{{ $post_id }}">
                <input type="submit" id="submit" class="btn btn-success" value="Create">
        </form>
    </div>
@endsection
