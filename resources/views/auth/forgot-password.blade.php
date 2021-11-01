@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="form-password">
            <div class="form-heading">
                Forgot Password
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mx-2" value="Reset">
                    <a href="{{ route('getLogin') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
