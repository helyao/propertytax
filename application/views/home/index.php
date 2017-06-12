<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/29/2017
 * Time: 4:36 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <title>PayFairTax &mdash; Compare Your Property Tax with Neighbors</title>

    <link rel="stylesheet" href="<?php echo site_url('../public/css/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('../public/css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('../public/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('../public/css/jquery-ui.min.css'); ?>">

    <style type="text/css">
        @font-face {
            font-family: 'icomoon';
            src: url("<?php echo site_url('../public/font/icomoon/icomoon.eot?srf3rx'); ?>");
            src: url("<?php echo site_url('../public/font/icomoon/icomoon.eot?srf3rx#iefix'); ?>") format("embedded-opentype"),
            url("<?php echo site_url('../public/font/icomoon/icomoon.ttf?srf3rx'); ?>") format("truetype"),
            url("<?php echo site_url('../public/font/icomoon/icomoon.woff?srf3rx'); ?>") format("woff"),
            url("<?php echo site_url('../public/font/icomoon/icomoon.svg?srf3rx#icomoon'); ?>") format("svg");
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <link rel="stylesheet" href="<?php echo site_url('../public/css/style.css'); ?>">

    <script src="<?php echo site_url('../public/js/modernizr.min.js'); ?>"></script>
    <script src="<?php echo site_url('../public/js/respond.min.js'); ?>"></script>
</head>
<body>
<div class="fh5co-loader" style="background: url(<?php echo site_url('../public/images/loader.gif'); ?>) center no-repeat #fff;"></div>
<div id="page">
    <?php $this->load->view("home/navbar") ?>
    <?php $this->load->view("home/header") ?>
    <?php $this->load->view("home/detail") ?>
    <?php $this->load->view("home/step") ?>
    <?php $this->load->view("home/support") ?>
<!--    --><?php //$this->load->view("home/contact") ?>
    <?php $this->load->view("home/footer") ?>
    <?php $this->load->view("home/modal") ?>
</div>
<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>
<script type="application/javascript" src="<?php echo site_url('../public/js/jquery-3.2.1.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/jquery.easing.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/jquery-ui.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/bootstrap.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/jquery.waypoints.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/echarts.min.js'); ?>"></script>
<script type="application/javascript" src="<?php echo site_url('../public/js/main.js'); ?>"></script>
<script type="application/javascript">
    $(function () {
        $('#answer').click(function () {
            if ($('#address').val()) {
                $('#myModal').modal('show');
            } else {
                $('#myModal2').modal('show');
            }
        })
    });

    $(function () {
        $('#confirm').click(function () {
            console.log('confirm clicked');
            $("#para1").val($('#address').val());
            $("#form").submit();
        })
    });

    var map;
    var marker;
    var geocoder;

    var initPreviewMap = function () {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('preview-map'), {
            zoom: 18
        });
    };

    var initGoogleMap = function () {
        console.log('initGoogleMap');
        initPreviewMap();
        $("#myModal").on("shown.bs.modal", function(e) {
            google.maps.event.trigger(map, "resize");
            geocodeAddress(geocoder, map, $('#address').val());
            return map.setCenter(marker);
        });
    };

    function geocodeAddress(geocoder, resultsMap, address) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }

    $(function() {
        $("#address").autocomplete({
            source: '/texas/index.php/home/autocomplete'
        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPp8rXk8sZibhukpLDkQC0rhKY3s2uhBY&callback=initGoogleMap" async defer></script>
</body>
</html>
