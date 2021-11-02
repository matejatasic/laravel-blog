<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title></title>
    <style>
        #email-card {
            width: 60%;
            border: 1px solid rgb(102, 102, 102);
            margin: 2rem auto;
            font-family: 'Oswald';
        }

        #email-heading {
            text-align: center;
            padding: 0.5rem auto;
        }

        #email-heading > h1 {
            font-size: 1.5rem;
        }

        #email-body {
            padding: 0.5rem 2rem;
        }

        #email-body > p:first-child {
            margin-bottom: 1rem;
        }

        #email-body > a {
            margin: 0.5rem auto;
            width: 10rem;
            display: block;
            background: #24a7d3;
            color: #333;
            padding: 0.4rem 1.3rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            outline: none;
            transition: all 0.2s ease-in;
            text-decoration: none;
            text-align: center;
            font-family: 'Oswald';
        }

        #email-footer {
            margin-top: 2rem;
        }

        #email-footer > p {
            margin-bottom: 0;
        }
    }
    </style>
</head>
<body>
    <div id="email-card">
        <div id="email-heading">
            <h1>Reset Password</h1>
        </div>
        <div id="email-body">
            <p><b>Hello {{ $user['name'] }},</b></p>
            <p>We've received a request to reset your password</p>
            <p>You can reset your password by clicking on the button below</p>
            <a href="{{ route('changePassword', $user['token']) }}" class="btn btn-primary">Change Password</a>
            <p>If you did not request this, you can ignore this email.</p>
            <div id="email-footer">
                <p>Best regards,</p>
                <p>Laravel Blog</p>
            </div>
        </div>
    </div>
</body>
</html>
