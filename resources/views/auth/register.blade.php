@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="register-form">
            <div class="form-heading">
                Register
            </div>
            <form action="">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="email">
                </div>
                <div class="form-group">
                    <label>User Image</label>
                    <input type="file" name="user_image">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mx-2" value="Register">
                    <a href="{{ route('login') }}">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
