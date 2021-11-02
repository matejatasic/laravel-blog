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
        <div class="form-password">
            <div class="form-heading">
                Change Password
            </div>
            <form action="{{ route('updatePassword') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation">
                </div>
                
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="submit" class="btn btn-success mx-2" value="Change Password">
            </form>
        </div>
    </div>
@endsection
