<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/14/2017
 * Time: 4:56 PM
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <title>Reset Successfully &mdash; PayFairTax</title>

    <link rel="stylesheet" href="<?php echo site_url('../public/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('../public/css/animate.css'); ?>">

    <style type="text/css">
        body {
            font-family: "Open Sans", Arial, sans-serif;
            line-height: 1.5;
            font-size: 16px;
            color: #848484;
            background-color: #f0f0f0;
        }
        .notice-form {
            padding: 30px;
            margin-top: 4em;
            -webkit-box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            -o-box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }
        @media screen and (max-width: 768px) {
            .notice-form {
                padding: 15px;
            }
        }
        .notice-form h2 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 20px;
            margin: 0 0 30px 0;
            color: #000000;
        }
        .notice-form h3 {
            letter-spacing: 1px;
            font-size: 16px;
            margin: 0 0 30px 0;
            color: #000000;
        }
        .copyright {
            padding-top: 60px;
            clear: both;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="#" class="notice-form animate-box" data-animate-effect="fadeIn">
                <h2>Reset Successfully</h2>
                <h3>Will jump to login page after <b id="timer">5</b>s.</h3>
            </form>
        </div>
    </div>
    <div class="row copyright">
        <div class="col-md-12 text-center"><p><small>&copy; 2017 PayFairTax. All Rights Reserved.</small></p></div>
    </div>
</div>
<script type="application/javascript" src="<?php echo site_url('../public/js/jquery-3.2.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/bootstrap.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/jquery.waypoints.min.js'); ?>"></script>
<script type="application/javascript">
    var timevalue = 5;
    var updateTimer = function () {
        if (timevalue == 0) {
            window.location.href = '/texas/index.php/home/login';
        }
        $('#timer').text(timevalue--);
    };
    $(function () {
        setInterval('updateTimer()',1000);
    });
</script>
</body>
</html>