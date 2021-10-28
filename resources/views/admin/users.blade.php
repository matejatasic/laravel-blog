@extends('admin.layout.main')

@section('content')
    <div class="mb-2">
        <h1 class="text-center large">Users</h1>
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
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->img_path }}" alt="img_thumbnail"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status === 'active' ? 'Active' : 'Banned' }}</td>
                        <td>
                            @if ($user->status === 'active')
                                <button class="btn btn-danger banUserBtn" id="{{ $user->id }}">Ban</button>
                            @else
                                <button class="btn btn-success unbanUserBtn" id="{{ $user->id }}">Unban</button>
                            @endif
                            <button class="btn btn-danger deleteUserBtn" id="{{ $user->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.custom') }}
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

        $('.banUserBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(204, 55, 55)');
            $('#modal-title').html('Are you sure you want to ban this user?')
            $('#modal-body').html(`
                <form action="{{ route('admin.banUser') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="${id}">
                    <input type="submit" class="btn btn-danger" value="Ban">    
                </form>
            `);
        });
        
        $('.unbanUserBtn').click((e) => {
            event.stopPropagation();
            event.stopImmediatePropagation();

            let id = e.target.id;
            modal.css('display', 'block');
            $('#modal-header').css('background', 'rgb(28, 180, 28)');
            $('#modal-title').html('Are you sure you want to unban this user?')
            $('#modal-body').html(`
                <form action="{{ route('admin.unbanUser') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="${id}">
                    <input type="submit" class="btn btn-success" value="Unban">    
                </form>
            `);
        });
        
        $('.deleteUserBtn').click((e) => {
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
