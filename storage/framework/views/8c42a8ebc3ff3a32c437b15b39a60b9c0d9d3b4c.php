<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Quotation Request</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:30px;">

<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; margin:auto; background:#ffffff; border-radius:6px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1);">

    <!-- Header -->
    <tr>
        <td style="background:#2c3e50; color:#ffffff; padding:20px; text-align:center;">
            <h2 style="margin:0;">New Quotation Request</h2>
        </td>
    </tr>

    <!-- Body -->
    <tr>
        <td style="padding:25px;">

            <p style="margin-bottom:20px;">
                You have received a new quotation request from your website.
            </p>

            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;">

                <tr style="background:#f8f9fa;">
                    <td width="150"><strong>Name</strong></td>
                    <td><?php echo e($data['name']); ?></td>
                </tr>

                <tr>
                    <td><strong>Email</strong></td>
                    <td><?php echo e($data['email']); ?></td>
                </tr>

                <tr style="background:#f8f9fa;">
                    <td><strong>Phone</strong></td>
                    <td><?php echo e($data['phone']); ?></td>
                </tr>

                <tr>
                    <td valign="top"><strong>Message</strong></td>
                    <td><?php echo e($data['message']); ?></td>
                </tr>

            </table>

        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:13px; color:#777;">
            This email was generated from your website quotation form.
        </td>
    </tr>

</table>

</body>
</html><?php /**PATH C:\laragon\www\laravel-app\resources\views/emails/contact_form.blade.php ENDPATH**/ ?>