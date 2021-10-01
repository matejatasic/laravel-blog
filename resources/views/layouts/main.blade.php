<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Blog</title>

        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        
        @if (Auth::check())
            <!-- Font awesome -->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        @endif
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
            </ul>
            @if (Auth::check())
                <div class="right-nav">
                    <div class="user-name">
                        <a href="#">{{ auth()->user()->name }}</a> <i class="fas fa-caret-down"></i>
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
    </body>
</html>
