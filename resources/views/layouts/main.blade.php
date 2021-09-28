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
        <nav class="navbar bg-dark">
            <a href="#" class="navbar-brand">
                Laravel Blog
            </a>
            <ul class="left-nav">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Posts</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
            <ul class="right-nav">
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
