@extends('layouts.main')

@section('content')
    <div class="container">
        <div id="contact">
            <div class="mb-2 text-center">
                <h1 class="large">Contact us</h1>
                <p class="lead">If you'd like to contact us, please do not hesitate. We are happy to hear from you.</p>
            </div>
            <hr>
            <form action="" class="form my-3">
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="* Your Name">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="* Your Email">
                </div>
                <div class="form-group">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
                </div>
                
                <input type="submit" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection
