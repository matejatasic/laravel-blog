@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="mb-2">
            <h1 class="text-center large">Blog Posts</h1>
        </div>
        <hr>
        <div class="my-3">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Auth::check())
                <div>
                    <a href="{{ route('posts.create') }}" class="btn btn-success create mb-3">Create</a>
                </div>
            @endif
            <div>
                <form action="" class="form">
                    <select name="categories" id="categories">
                        <option value="-">-</option>
                        <option value="0">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @foreach ($posts as $post)
                <div class="blog-post mb-4">
                    <div>
                        <img src="{{ $post->img_path }}" alt="post_image">
                    </div>
                    <div class="px-3">
                        <h2 class="medium">{{ $post->title > 20 ? substr($post->title, 0, 20) . '...' : $post->title }}</h2>
                        <p class="mb-2">By <b>{{ $post->user->name }}</b>, {{ $post->created_at->diffForHumans() }}</p>
                        <p class="lead">
                            {{ strlen(strip_tags($post->body)) > 150 ? substr(strip_tags($post->body), 0, 150) . '...' : strip_tags($post->body) }}
                        </p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links('vendor.custom') }}
    </div>
@endsection

@section('scripts')
    @if (!Auth::check())
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @endif
    <script>
        let categories = $('#categories');
        let id = 0;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        categories.on('change', (e) => {
            id = e.target.value;
            
            if(id === '0') {
                window.location.href="/posts";
            }
            
            else {
                window.location.href=`/posts/category/${id}`;
            }
        });
    </script>
@endsection
