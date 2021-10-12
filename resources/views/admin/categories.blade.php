@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Categories</h1>
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
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ count($category->posts) }}</td>
                        <td>
                            <button class="btn btn-primary viewBtn" id="{{ $category->id }}">Edit</button>
                            <button class="btn btn-danger deleteBtn" id="{{ $category->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links('vendor.custom') }}
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
            let route = '{{ route("admin.editCategory", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');

            $.get('/admin/categories/' + id, (data) => {
                let category = data.data;

                $('#modal-header').css('background', '#b2a1a1')
                $('#modal-title').html('Edit category');

                $('#modal-body').html(`
                <form action="${ route }" method="POST" id="editForm" class="form my-3">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="${ category['name'] }">
                        </div>
                    
                        <input type="submit" id="submit" class="btn btn-success" value="Update">
                </form>
                `);
            });
        });

        $('#createModalBtn').click((e) => {
            modal.css('display', 'block');

            $('#modal-header').css('background', '#b2a1a1')
                $('#modal-title').html('Create category');
            $('#modal-body').html(`
                <form action="{{ route('admin.createCategory') }}" method="POST" id="createForm" class="form my-3">
                    @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name">
                        </div>
                    
                        <input type="submit" id="submit" class="btn btn-success" value="Create">
                </form>
                `);
        });

        $('.approveModalBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(28, 180, 28)');
            $('#modal-title').html('Are you sure you want to approve this category?')
            $('#modal-body').html(`
                <form action="{{ route('admin.approveCategory') }}" method="POST">
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
            let route = '{{ route("admin.deleteCategory", ":id") }}'; 
            route = route.replace(':id', id);
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(204, 55, 55)');
            $('#modal-title').html('Are you sure you want to delete this category?')
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
