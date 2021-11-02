@extends('layouts.main')

@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-password">
            <div class="form-heading">
                Forgot Password
            </div>
            <form action="{{ route('sendEmail') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <input type="submit" class="btn btn-success mx-2" value="Reset Password">
                    <a href="{{ route('getLogin') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
