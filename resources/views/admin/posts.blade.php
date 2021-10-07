@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Admin Dashboard</h1>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img src="{{ $post->img_path }}" alt="img_thumbnail"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ strlen($post->body) > 150 ? substr($post->body, 0, 150) . '...' : $post->body }}</td>
                        <td>
                            <button class="btn btn-primary viewBtn" id="{{ $post->id }}">View</button>
                            <button class="btn btn-success">Approve</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links('vendor.custom') }}

        <!-- modal -->
        <div id="viewModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="close">&times;</span>
                    <h2 id="post-title"></h2>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="post-image">
                    <p class="post-author"></p>
                    <p id="post-body"></p>
                </div>
            </div>
        </div>
        <!-- !modal -->
@endsection

@section('scripts')
    <script>
        const modal = $('#viewModal');
        const close = $('#close');

        $('.viewBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let id = e.target.id;
            modal.css('display', 'block');

            $.get('/admin/posts/' + id, (data) => {
                $('#post-image').attr('src' , data.data.img_path);
                $('#post-title').html(data.data.title);
                $('#post-body').html(data.data.body);
                console.log(data);
            });
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