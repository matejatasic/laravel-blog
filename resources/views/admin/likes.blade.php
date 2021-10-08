@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Likes</h1>
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
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($likes as $like)
                    <tr>
                        <td>{{ $like->id }}</td>
                        <td>{{ $like->user->name }}</td>
                        <td>{{ $like->comment->title }}</td>
                        <td>
                            {{ date('Y-m-d h:m:s', strtotime($like->created_at)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $likes->links('vendor.custom') }}
    </div>
@endsection