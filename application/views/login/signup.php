<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/15/2017
 * Time: 11:32 AM
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <title>Sign-Up &mdash; PayFairTax</title>

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
                <h2>Sign Up</h2>
                <div class="form-group">
                    <div id="show-error" class="alert alert-danger" role="alert"></div>
                </div>
                <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" autocomplete="off">
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
                    <label for="remember"><input type="checkbox" id="remember"> Remember Me</label>
                </div>
                <div class="form-group">
                    <p>Already registered? <a href="/texas/index.php/home/login">Sign In</a></p>
                </div>
                <div class="form-group">
                    <input type="button" id="submit" value="Sign Up" class="btn btn-primary">
                </div>
            </form>
            <form method="post" id="emailjump" style="visibility: hidden" action="/texas/index.php/home/emailsuccess">
                <input type="text" id="hidusernm" name="hidusernm">
                <input type="text" id="hidpasswd" name="hidpasswd">
                <input type="text" id="hidemail" name="hidemail">
                <input type="submit" id="hidsubmit">
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
    ;(function () {
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

        // Username Specification
        var checkName = function (name) {
            var reg = /^[a-zA-Z0-9_]+$/g;
            if (name.match(reg)) {
                return true;
            }
            else {
                return false;
            }
        };

        // Username Unique Judge
        var uniqueName = function (name) {
            var num = 0;
            $.ajax({
                type : 'get',
                url : '/texas/index.php/home/uniqueName',
                data : 'user='+name,
                async : false,
                success : function(res){
                    num = parseInt(res);
                }
            });
            if(num > 0) {
                return false;
            }
            else {
                return true;
            }
        };

        // Username Rules
        var flagName = false;
        var verifyNameFunc = function() {
            var nameValue = $.trim($("#name").val());
            if (nameValue == '') {
                $("#show-error").text("The username field cannot be set none.");
                $("#show-error").css("display", "block");
                flagName = false;
            }
            else if (nameValue.length > 50) {
                $("#show-error").text("The username field must be at most 50 characters in length.");
                $("#show-error").css("display", "block");
                flagName = false;
            }
            else if (!checkName(nameValue)) {
                $("#show-error").text("Username only supports letters, numbers and underscores.");
                $("#show-error").css("display", "block");
                flagName = false;
            }
            else if (!uniqueName(nameValue)) {
                $("#show-error").text("The username is already in used, please change another one.");
                $("#show-error").css("display", "block");
                flagName = false;
            }
            else {
                $("#show-error").css("display", "none");
                flagName = true;
            }
        };

        var verifyName = function () {
            $('#name').blur(function () {
                verifyNameFunc();
            });
        };
        // E-mail Specification
        var checkEmail = function (email) {
            var reg = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            if (email.match(reg)) {
                return true;
            }
            else {
                return false;
            }
        };

        // E-mail Unique Judge
        var uniqueEmail = function (email) {
            var num = 0;
            $.ajax({
                type : 'get',
                url : '/texas/index.php/home/uniqueEmail',
                data : 'email='+email,
                async : false,
                success : function(res){
                    num = parseInt(res);
                }
            });
            if(num > 0) {
                return false;
            }
            else {
                return true;
            }
        };

        // E-mail Specification
        var flagEmail = false;
        var verifyEmailFunc = function () {
            var emailValue = $.trim($("#email").val());
            if (emailValue == '') {
                $("#show-error").text("The email field cannot be set none.");
                $("#show-error").css("display", "block");
                flagEmail = false;
            }
            else if (emailValue.length > 320) {
                $("#show-error").text("The email field must be at most 320 characters in length.");
                $("#show-error").css("display", "block");
                flagEmail = false;
            }
            else if (!checkEmail(emailValue)) {
                $("#show-error").text("Please enter the corrent email address.");
                $("#show-error").css("display", "block");
                flagEmail = false;
            }
            else if (!uniqueEmail(emailValue)) {
                $("#show-error").text("The email is already registered.");
                $("#show-error").css("display", "block");
                flagEmail = false;
            }
            else {
                $("#show-error").css("display", "none");
                flagEmail = true;
            }
        };
        var verifyEmail = function () {
            $('#email').blur(function () {
                verifyEmailFunc();
            });
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
                verifyNameFunc();
                verifyEmailFunc();
                verifyPasswdFunc();
                verifyRePasswdFunc();
                if (flagName && flagEmail && flagPasswd && flagRePasswd) {
                    $('#hidusernm').val($('#name').val());
                    $('#hidpasswd').val($('#password').val());
                    $('#hidemail').val($('#email').val());
                    $.post("/texas/index.php/home/newuser", {username: $("#name").val(), email: $("#email").val(), password: $("#password").val()}, function (data) {
                        if (data) {
                            console.log('E-mail sent successfully.');
                            $('#emailjump').submit();
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
            verifyName();
            verifyEmail();
            verifyPasswd();
            verifyRePasswd();
            postFormSubmit();
        })
    }());
</script>
</body>
</html>
