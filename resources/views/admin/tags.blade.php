@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Tags</h1>
    </div>
    <hr>
    <div class="my-3">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div>
            <button class="btn btn-success create mb-3" id="createModalBtn">Create</button>
        </div>
        <table id="posts-table" class="mb-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ count($tag->posts) }}</td>
                        <td>
                            <button class="btn btn-primary viewBtn" id="{{ $tag->id }}">Edit</button>
                            <button class="btn btn-danger deleteModalBtn" id="{{ $tag->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tags->links('vendor.custom') }}
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
            let route = '{{ route("admin.editTag", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');

            $.get('/admin/tags/' + id, (data) => {
                let tag = data.data;
                
                $('#modal-header').css('background', '#b2a1a1')
                $('#modal-title').html('Edit tag');

                $('#modal-body').html(`
                <form action="${ route }" method="POST" id="editForm" class="form my-3">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="${ tag['name'] }">
                        </div>
                    
                        <input type="submit" id="submit" class="btn btn-success" value="Update">
                </form>
                `);
            });
        });

        $('#createModalBtn').click((e) => {
            modal.css('display', 'block');

            $('#modal-header').css('background', '#b2a1a1')
                $('#modal-title').html('Create tag');
            $('#modal-body').html(`
                <form action="{{ route('admin.createTag') }}" method="POST" id="createForm" class="form my-3">
                    @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name">
                        </div>
                    
                        <input type="submit" id="submit" class="btn btn-success" value="Create">
                </form>
                `);
        });

        $('.deleteModalBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            let route = '{{ route("admin.deleteTag", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(204, 55, 55)');
            $('#modal-title').html('Are you sure you want to delete this tag?')
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
