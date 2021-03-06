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
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        @endif
        
        @yield('styles')
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar bg-dark">
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
                @if (Auth::check() && auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>    
                @endif
            </ul>
            @if (Auth::check())
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
            @else
                <ul class="right-nav">
                    <li><a href="{{ route('getLogin') }}">Login</a></li>
                    <li><a href="{{ route('getRegister') }}">Register</a></li>
                </ul>
            @endif
        </nav>
        <!-- !navbar -->

        @yield('content')

         <!-- script if logged in -->
        @if (Auth::check())
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
        @endif
        <!-- !script if logged in -->

        @yield('scripts')

        <!-- footer -->
        <footer id="footer" class="bg-dark">
            <div id="footer-links">
                <div id="pages">
                    <h3>Pages</h3>
                    <ul>
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
                    </ul>
                </div>
                <div id="find-us">
                    <h3>Find us</h3>
                    <ul>
                        <li>
                            <a href="#">What we do</a>
                        </li>
                        <li>
                            <a href="#">Address</a>
                        </li>
                        <li>
                            <a href="#">Phone</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div id="latest-posts">
                    <h3>Features</h3>
                    <ul>
                        <li>
                            <a href="#">Articles</a>
                        </li>
                        <li>
                            <a href="#">Collections</a>
                        </li>
                        <li>
                            <a href="#">Concepts</a>
                        </li>
                        <li>
                            <a href="#">Tips & Advice</a>
                        </li>    
                    </ul>
                </div>
            </div>
            <p>
                Copyright 2021 Mateja Tasic. All Rights Reserved
            </p>
        </footer>
        <!-- !footer -->
    </body>
</html>
