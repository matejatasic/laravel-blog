<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel Blog</title>

        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @if (Auth::check())
            <script src="https://kit.fontawesome.com/f9d2d5cb9c.js" crossorigin="anonymous"></script>
        @endif
    </head>
    <body>
        <!-- navbar -->
        <nav id="navbar" class="bg-dark">
            <div id="menu-wrapper">
                <a href="{{ route('pages.home') }}" class="navbar-brand">
                    Laravel Blog
                </a>
                <ul class="left-nav">
                    <li>
                        <a href="{{ route('pages.home') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}">Blog</a>
                    </li>
                    <li>
                        <a href="{{ route('pages.about') }}">About</a>
                    </li>
                    <li>
                        <a href="{{ route('pages.contact') }}">Contact</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                </ul>

                <div class="right-nav">
                    <div class="username-div">
                        <img src="{{ auth()->user()->img_path }}" alt="avatar" id="avatar">
                        <a id="username">{{ auth()->user()->name }} <i class="fas fa-caret-down"></i></a>
                        <div id="dropdown">
                            <div>
                                <a href="#">Settings</a>
                            </div>
                            <hr>
                            <div>
                                <a href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- !navbar -->

        <!-- admin-sidebar -->
        <div id="admin-sidebar">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.users') }}">Users</a>
            <a href="{{ route('admin.posts') }}">Posts</a>
            <a href="{{ route('admin.comments') }}">Comments</a>
            <a href="{{ route('admin.categories') }}">Categories</a>
            <a href="{{ route('admin.tags') }}">Tags</a>
            <a href="{{ route('admin.likes') }}">Likes</a>
        </div>
        <!-- !admin-sidebar -->

        <div id="main">
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            let username = $('#username');
            let avatar = $('#avatar');
            let dropdown = $('#dropdown'); 
            let isActive = false;

            function toggleDropdown() {
                if(!isActive) {
                    dropdown.css('display', 'block');
                    isActive = true;
                }
                else {
                    dropdown.css('display', 'none');
                    isActive = false;
                }
            }

            function onEnterChange() {
                avatar.css('cursor', 'pointer');
                username.css({
                    'cursor': 'pointer',
                    'color': '#b2a1a1'
                });
            }
            
            function onOutChange() {
                avatar.css('cursor', 'default');
                username.css({
                    'color': '#e0d9d9'
                });
            }

            // On button click show or hide dropdown
            username.on('click', toggleDropdown)
            username.hover(onEnterChange, onOutChange);
            avatar.hover(onEnterChange, onOutChange);
            avatar.on('click', toggleDropdown);

            // Hide dropdown if click is outside of button
            $(window).click((e) => {
                if(isActive && !e.target.matches('#username') && !e.target.matches('#avatar')) {
                    dropdown.css('display', 'none');
                    isActive = false;   
                }
            }); 
        </script>

        @yield('scripts')
    </body>
</html>
