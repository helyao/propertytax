<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 6/14/2017
 * Time: 1:48 PM
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <title>Reset &mdash; PayFairTax</title>

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
        .login-form {
            padding: 30px;
            margin-top: 4em;
            -webkit-box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            -o-box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }
        @media screen and (max-width: 768px) {
            .login-form {
                padding: 15px;
            }
        }
        .login-form h2 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 20px;
            margin: 0 0 30px 0;
            color: #000000;
        }
        .login-form .form-group {
            margin-bottom: 30px;
        }
        .login-form .form-group p {
            font-size: 14px;
            color: #9f9f9f;
            font-weight: 300;
        }
        .login-form .form-group p a {
            color: #000000;
        }
        .login-form label {
            font-weight: 300;
            font-size: 14px;
            font-weight: 300;
        }
        .login-form .form-control {
            font-size: 16px;
            font-weight: 300;
            height: 50px;
            padding-left: 0;
            padding-right: 0;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            -o-box-shadow: none;
            box-shadow: none;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            -ms-border-radius: 0px;
            border-radius: 0px;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -webkit-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .login-form .form-control::-webkit-input-placeholder {
            color: rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
        }
        .login-form .form-control::-moz-placeholder {
            color: rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
        }
        .login-form .form-control:-ms-input-placeholder {
            color: rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
        }
        .login-form .form-control:-moz-placeholder {
            color: rgba(0, 0, 0, 0.3);
            text-transform: uppercase;
        }
        .login-form .form-control:focus, .login-form .form-control:active {
            border-bottom: 1px solid rgba(0, 0, 0, 0.4);
        }
        .btn-primary {
            height: 50px;
            padding-right: 20px;
            padding-left: 20px;
            border: none;
            background: #f35f55;
            color: #ffffff;
            -webkit-box-shadow: -2px 10px 20px -1px rgba(241, 95, 85, 0.4);
            -moz-box-shadow: -2px 10px 20px -1px rgba(241, 95, 85, 0.4);
            -o-box-shadow: -2px 10px 20px -1px rgba(241, 95, 85, 0.4);
            box-shadow: -2px 10px 20px -1px rgba(241, 95, 85, 0.4);
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            color: #ffffff;
            background: #f14034 !important;
            outline: none;
        }
        input, textarea {
            color: #000;
        }
        .copyright {
            padding-top: 60px;
            clear: both;
        }
        #show-error {
            display: none;
        }
    </style>

    <script src="/tax/public/js/modernizr.min.js"></script>
    <script src="/tax/public/js/respond.min.js"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!--            <form method="post" id="form" action="/texas/index.php/home/test" class="login-form animate-box" data-animate-effect="fadeIn">-->
            <form class="login-form animate-box" data-animate-effect="fadeIn">
                <h2>Reset</h2>
                <div class="form-group">
                    <div id="show-error" class="alert alert-danger" role="alert"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" disabled class="form-control" id="name" placeholder="Name" value="<?php echo $username ?>" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="re-password" class="sr-only">Re-type Password</label>
                    <input type="password" class="form-control" id="re-password" placeholder="Re-type Password" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="button" id="submit" value="Sure" class="btn btn-primary">
                </div>
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
    ;(function() {
        'use strict';

        // add waypoint effection
        var contentWayPoint = function() {
            var i = 0;
            $('.animate-box').waypoint( function( direction ) {
                if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
                    i++;
                    $(this.element).addClass('item-animate');
                    setTimeout(function(){
                        $('body .animate-box.item-animate').each(function(k){
                            var el = $(this);
                            setTimeout( function () {
                                var effect = el.data('animate-effect');
                                if ( effect === 'fadeIn') {
                                    el.addClass('fadeIn animated-fast');
                                } else if ( effect === 'fadeInLeft') {
                                    el.addClass('fadeInLeft animated-fast');
                                } else if ( effect === 'fadeInRight') {
                                    el.addClass('fadeInRight animated-fast');
                                } else {
                                    el.addClass('fadeInUp animated-fast');
                                }
                                el.removeClass('item-animate');
                            },  k * 200, 'easeInOutExpo' );
                        });
                    }, 100);
                }
            } , { offset: '85%' } );
        };

        // Password Specification
        var flagPasswd = false;
        var verifyPasswdFunc = function () {
            var passwdValue = $.trim($("#password").val());
            if (passwdValue == '') {
                $("#show-error").text("The password field cannot be set none.");
                $("#show-error").css("display", "block");
                flagPasswd = false;
            }
            else if (passwdValue.length < 6) {
                $("#show-error").text("The password field must be at least 6 characters in length.");
                $("#show-error").css("display", "block");
                flagPasswd = false;
            }
            else if (passwdValue.length > 50) {
                $("#show-error").text("The password field must be at most 50 characters in length.");
                $("#show-error").css("display", "block");
                flagPasswd = false;
            }
            else {
                $("#show-error").css("display", "none");
                flagPasswd = true;
            }
        };
        var verifyPasswd = function () {
            $('#password').blur(function () {
                verifyPasswdFunc();
            });
        };

        // Re-Password Specification
        var flagRePasswd = false;
        var verifyRePasswdFunc = function () {
            var passwdValue = $.trim($("#password").val());
            var rePasswdValue = $.trim($("#re-password").val());
            if (passwdValue != rePasswdValue) {
                $("#show-error").text("Twice passwords do not match.");
                $("#show-error").css("display", "block");
                flagRePasswd = false;
            }
            else {
                $("#show-error").css("display", "none");
                flagRePasswd = true;
            }
        };
        var verifyRePasswd = function () {
            $('#re-password').blur(function () {
                verifyRePasswdFunc();
            });
        };

        // post form
        var postFormSubmit = function () {
            $('#submit').click(function () {
                verifyPasswdFunc();
                verifyRePasswdFunc();
                if (flagPasswd && flagRePasswd) {
                    $.post("/texas/index.php/home/newpasswd", {email: "<?php echo $email ?>", password: $("#password").val(), verify: "<?php echo $verify ?>"}, function (data) {
                        if (data) {
                            console.log('E-mail sent successfully.');
                            window.location.href = '/texas/index.php/home/resetsuccess';
                        }
                        else {
                            console.log('E-mail sent failed.');
                        }
                    });
                }
                else {
                    $('#alert-modal').modal('show');
                }
            });
        };

        // Onload
        $(function () {
            contentWayPoint();
            verifyPasswd();
            verifyRePasswd();
            postFormSubmit();
        });
    }());
</script>
</body>
</html>
