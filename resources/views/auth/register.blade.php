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
        <div class="register-form">
            <div class="form-heading">
                Register
            </div>
            <form action="{{ route('postRegister') }}" method="POST">
                @csrf
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
                    <input type="password" name="password_confirmation">
                </div>
                <div class="form-group">
                    <label>User Image</label>
                    <input type="file" name="user_image">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mx-2" value="Register">
                    <a href="{{ route('postLogin') }}">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
