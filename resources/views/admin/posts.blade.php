@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Posts</h1>
    </div>
    <hr>
    <div class="my-3">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table id="table" class="mb-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Approved</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img src="{{ $post->img_path }}" alt="img_thumbnail"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->approved === 'approved' ? 'Approved' : 'Unapproved'}}</td>
                        <td>
                            <button class="viewBtn btn btn-primary" id="{{ $post->id }}">View</button>
                            @if ($post->approved === 'unapproved')
                                <button class="approveModalBtn  btn btn-success" id="{{ $post->id }}">Approve</button>
                            @endif
                            <button class="deleteModalBtn btn btn-danger" id="{{ $post->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links('vendor.custom') }}

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
            modal.css('display', 'block');

            $.get('/admin/posts/' + id, (data) => {
                let post = data.data[0];
                let user = data.data[1];

                $('#modal-header').css('background', '#b2a1a1')
                $('#modal-title').html(post['title']);
                $('#modal-body').html(`
                    <img src="${ post['img_path'] }" alt="" id="post-image">
                    <p id="post-author">Author: <strong>${ user }</strong></p>
                    <p id="post-body">${ post['body'] }</p>
                `);
            });
        });
        
        $('.approveModalBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(28, 180, 28)');
            $('#modal-title').html('Are you sure you want to approve this post?')
            $('#modal-body').html(`
                <form action="{{ route('admin.approvePost') }}" method="POST">
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
            let route = '{{ route("admin.deletePost", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(204, 55, 55)');
            $('#modal-title').html('Are you sure you want to delete this post?')
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
