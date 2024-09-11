<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>Please click the following link to verify your email:</p>
    <a href="{{ $verificationUrl }}">Verify Email</a>
</body>
</html>
