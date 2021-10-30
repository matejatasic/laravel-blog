@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="form">
            <div class="form-heading">
                Change Password
            </div>
            <form action="#" method="POST">
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
                
                <input type="submit" class="btn btn-success mx-2" value="Change Password">
            </form>
        </div>
    </div>
@endsection