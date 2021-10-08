@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Comments</h1>
    </div>
    <hr>
    <div class="my-3">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table id="posts-table" class="mb-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Comment</th>
                    <th>Author</th>
                    <th>Post Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->title }}</td>
                        <td>{{ strlen($comment->comment) > 150 ? substr($comment->comment, 0, 150) . '...' : $comment->comment }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>
                            <button class="btn btn-success">Approve</button>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $comments->links('vendor.custom') }}
    </div>
@endsection