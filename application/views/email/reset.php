<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/14/2017
 * Time: 1:30 PM
 */
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration from payfairtax.com</title>
</head>
<body>
    <p>Dear user,</p>
    <br>
    <p>We received an reset password request on <a href="http://www.payfairtax.com">www.payfairtax.com</a> for your email address.</p>
    <p>To start reset your password please visit the following link:</p>
    <br>
    <a href="<?php echo $urlstring ?>"><?php echo $urlstring ?></a>
    <br>
    <p>If you do not want to reset password on <a href="http://www.payfairtax.com">www.payfairtax.com</a>, please ignore this email.</p>
    <p>Your information will then be deleted in a few days time.</p>
    <br>
    <p>Best Regards,</p>
    <p>The payfairtax.com team.</p>
</body>
</html>
