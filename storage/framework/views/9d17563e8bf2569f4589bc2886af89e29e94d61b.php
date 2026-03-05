<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
</head>
<body>
    <h2>Hello,</h2>
    <p>Your account has been created on our portal.</p>
    <p><strong>Email:</strong> <?php echo e($email); ?></p>
    <p><strong>Password:</strong> <?php echo e($password); ?></p>
    <p>You can login here: <a href="<?php echo e($loginUrl); ?>"><?php echo e($loginUrl); ?></a></p>
    <p>Please change your password after your first login.</p>
    <br>
    <p>Thanks,<br>Team</p>
</body>
</html><?php /**PATH C:\laragon\www\laravel-app\resources\views/emails/user_created.blade.php ENDPATH**/ ?>