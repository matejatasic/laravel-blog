@extends('layouts.main')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login-form">
            <div class="form-heading">
                Login
            </div>
            <form action="{{ route('postLogin') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mx-2" value="Login">
                    <a href="#">Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
