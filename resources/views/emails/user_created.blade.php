<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
</head>
<body>
    <h2>Hello,</h2>
    <p>Your account has been created on our portal.</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>You can login here: <a href="{{ $loginUrl }}">{{ $loginUrl }}</a></p>
    <p>Please change your password after your first login.</p>
    <br>
    <p>Thanks,<br>Team</p>
</body>
</html>