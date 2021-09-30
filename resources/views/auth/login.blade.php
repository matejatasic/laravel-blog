@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="login-form">
            <div class="form-heading">
                Login
            </div>
            <form action="">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mx-2" value="Login">
                    <a href="#">Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
