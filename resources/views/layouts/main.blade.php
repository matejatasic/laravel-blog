<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Blog</title>

        <!-- Custom styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                    <a href="#">Blog</a>
                </li>
                <li>
                    <a href="{{ route('pages.about') }}">About</a>
                </li>
                <li>
                    <a href="{{ route('pages.contact') }}">Contact</a>
                </li>
            </ul>
            <ul class="right-nav">
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </nav>
        <!-- !navbar -->

        @yield('content')
    </body>
</html>
