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
                    <th>Approved</th>
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
                        <td>Approved</td>
                        <td>
                            <button class="btn btn-primary viewBtn" id="{{ $comment->id }}">Edit</button>
                            @if ($comment->approved === 'unapproved')
                                <button class="btn btn-success approveModalBtn" id="{{ $comment->id }}">Approve</button>
                            @endif
                            <button class="btn btn-danger deleteModalBtn" id="{{ $comment->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $comments->links('vendor.custom') }}
    </div>

    <x-modal />
@endsection

@section('scripts')
    <script>
        const modal = $('#viewModal');
        const close = $('#close');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.viewBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            let route = '{{ route("admin.editComment", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');

            $.get('/admin/comments/' + id, (data) => {
                let comment = data.data[0];

                $('#modal-header').css('background', '#b2a1a1')
                $('#modal-title').html('Edit comment');

                $('#modal-body').html(`
                <form action="${ route }" method="POST" id="createForm" class="form my-3">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="${ comment['title'] }">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea name="comment" cols="30" rows="10">${ comment['comment'] }</textarea>
                        </div>
                    
                        <input type="submit" id="submit" class="btn btn-success" value="Update">
                </form>
                `);
            });
        });
        
        $('.approveModalBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(28, 180, 28)');
            $('#modal-title').html('Are you sure you want to approve this comment?')
            $('#modal-body').html(`
                <form action="{{ route('admin.approveComment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="${id}">    
                    <input type="submit" class="btn btn-success" value="Approve">    
                </form>
            `);
        });

        $('.deleteModalBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            let route = '{{ route("admin.deleteComment", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(204, 55, 55)');
            $('#modal-title').html('Are you sure you want to delete this comment?')
            $('#modal-body').html(`
                <form action="${route}" method="POST">
                    @csrf
                    @method('DELETE')   
                    <input type="submit" class="btn btn-danger" value="Delete">    
                </form>
            `);
        });

        close.click(() => {
            modal.css('display', 'none');
        });

        $(window).click((e) => {
            if(e.target.id === 'viewModal' ) {
                modal.css('display', 'none');
            }
        });
    </script>
@endsection
