<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title></title>
</head>
<body>
    <div id="email-card">
        <div id="email-heading">
            <h1>Reset Password</h1>
        </div>
        <div id="email-body">
            <p><b>Hello User,</b></p>
            <p>We've received a request to reset your password</p>
            <p>You can reset your password by clicking on the button below</p>
            <a href="#" class="btn btn-primary">Reset Password</a>
            <p>If you did not request this, you can ignore this email.</p>
            <div id="email-footer">
                <p>Best regards,</p>
                <p>Laravel Blog</p>
            </div>
        </div>
    </div>
</body>
</html>
