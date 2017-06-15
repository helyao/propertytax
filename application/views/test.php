<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/8/2017
 * Time: 2:24 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/texas/public/images/favicon.ico" type="image/x-icon"/>
    <title>PayFairTax &mdash; Compare Your Property Tax with Neighbors</title>

    <link rel="stylesheet" href="/texas/public/css/animate.css">
    <link rel="stylesheet" href="/texas/public/css/icomoon.css">
    <link rel="stylesheet" href="/texas/public/css/bootstrap.min.css">
    <style type="text/css">
        a:hover, a:active, a:focus {
            outline: none;
            text-decoration: none;
        }
        .navbar {
            background-color: #222222;
        }
        #logo {
            font-size: 24px;
            margin: 0;
            padding: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }
        #logo a {
            padding: 5px 10px;
            color: #fff;
        }
        #setting a {
            font-size: 18px;
            color: #fff;
        }
        #setting ul a {
            color: #000;
        }
        .nav_menu nav ul {
            margin: 0;
        }
        #gmap {
            height: 600px;
        }
        #noticed-info {
            border-left: 3px solid #8c8c8c;
        }
        th {
            text-align: center;
        }
        .type-hidden {
            display: none;
        }
    </style>

    <script src="/texas/public/js/modernizr.min.js"></script>
    <script src="/texas/public/js/respond.min.js"></script>
</head>
<body>
<div class="nav_menu">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="nav toggle col-md-2" id="logo">
            <a href="#">payfairtax.</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li id="setting">
                <a type="button" href="/texas/index.php/home/logout" class="user-profile dropdown-toggle">
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">THE PROPERTY AT <b><?php echo $o_compare_info[0]->address.', '.$o_compare_info[0]->city_zip ?></b></h2>
            <h3 class="text-center">(COUNTY PROPERTY ID: <b><?php echo $o_prop_id ?></b>)</h3>
        </div>
    </div>
    <div class="row <?php if(!$o_flag){echo 'type-hidden';} ?>" style="border: 1px dashed #000000">
        <div class="col-md-12">
            <h3 class="text-center">ANALYSIS RESULT</h3>
            <h3 class="text-center">
                <?php echo $o_compare_info[0]->address ?>'s Noticed Property Value is <b>$<?php if($o_flag){echo ($o_compare_info[0]->appraised_val - $o_total_mid_val);} ?></b> <span class="text-danger">OVER-VALUED</span>
            </h3>
            <h4 class="text-center">vs.</h4>
            <h3 class="text-center">Comparable Properties In The Same Neighborhood</h3>
        </div>
    </div>
    <div class="row <?php if($o_flag){echo 'type-hidden';} ?>" style="border: 1px dashed #000000">
        <div class="col-md-12">
            <h3 class="text-center">ANALYSIS RESULT</h3>
            <h3 class="text-center">
                <?php echo $o_compare_info[0]->address ?>'s Noticed Property Value is <span class="text-primary">REASONBLE</span>
            </h3>
            <h4 class="text-center">vs.</h4>
            <h3 class="text-center">Comparable Properties In The Same Neighborhood</h3>
        </div>
    </div>
    <hr>
    <div class="row <?php if(!$o_flag){echo 'type-hidden';} ?>">
        <h3 class="col-md-12">Summary of the Analysis</h3>
        <div class="col-md-6">
            <div id="comp-info" class="list-group">
                <div class="list-group-item">
                    <p><b><span class="text-danger"><?php echo count($o_compare_info)-1 ?></span></b> comparable properties in the same neighborhood were selected according to their
                        similarities with the property at <b><span class="text-danger"><?php echo $o_compare_info[0]->address ?></span></b> (the "Subject Property") on property
                        grade (±3 Grades), improvement area size (±20%), and year built (±5 years).</p>
                </div>
                <div class="list-group-item">
                    <p>The noticed property value of these selected comparable properties were adjusted to the
                        Subject Property for the differences in land value, quality grade, improvement area size,
                        year built, and extra improvement features (swimming pool, etc.). These adjustments are
                        based on rigorous statistical analysis methods.</p>
                </div>
                <div class="list-group-item">
                    <p>The median value of the comparable properties (adjusted) in the same neighborhood is
                        <b><span class="text-danger">$<?php if($o_flag){echo $o_total_mid_val;} ?></span></b>, or <b><span class="text-danger">$2456</span></b> per sqf verse the noticed property value of <b><span class="text-danger">$<?php echo $o_compare_info[0]->appraised_val ?></span></b>, indicating a
                        valuation gap of <b><span class="text-danger">$<?php if($o_flag){echo ($o_compare_info[0]->appraised_val - $o_total_mid_val);} ?></span></b>.</p>
                </div>
            </div>
        </div>
        <div id="comp-chart" class="col-md-6">
        </div>
    </div>
    <div class="row <?php if(!$o_flag){echo 'type-hidden';} ?>">
        <h3 class="col-md-12">Equity Comparable Analysis (Property Value Adjusted)</h3>
        <div class="col-md-12">
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>C1</th>
                        <th>C2</th>
                        <th>C3</th>
                        <th>C4</th>
                        <th>C5</th>
                        <th>C6</th>
                        <th colspan="6">C7</th>
                        <th>C8</th>
                        <th>C9</th>
                        <th>C10</th>
                        <th>C11</th>
                    </tr>
                    <tr>
                        <th>Property ID</th>
                        <th>Address</th>
                        <th>Grade</th>
                        <th>Living Area</th>
                        <th>Year Built</th>
                        <th>Total Ap</th>
                        <th>Land Adj.</th>
                        <th>Pool Adj.</th>
                        <th>Grade Adj.</th>
                        <th>Age Adj.</th>
                        <th>Size Adj.</th>
                        <th>Other Imprv Adj.</th>
                        <th>Total Adj.</th>
                        <th>Total Adjuested Value</th>
                        <th>Your Property</th>
                        <th>Value Gap</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($o_flag) { ?>
                    <?php foreach ($o_compare_result as $row) { ?>
                        <tr>
                            <td rowspan="2"><?php echo $row->prop_id ?></td>
                            <td rowspan="2"><?php echo $row->address ?></td>
                            <td rowspan="2"><?php echo $row->grade ?></td>
                            <td rowspan="2"><?php echo $row->living_area ?></td>
                            <td rowspan="2"><?php echo $row->year ?></td>
                            <td rowspan="2">$<?php echo $row->appraised_val ?></td>
                            <td rowspan="2">$<?php echo $row->land_adj ?></td>
                            <td rowspan="2">$<?php echo $row->swim_adj ?></td>
                            <td rowspan="2">$<?php echo $row->grade_adj ?></td>
                            <td rowspan="2">$<?php echo $row->age_adj ?></td>
                            <td rowspan="2">$<?php echo $row->size_adj ?></td>
                            <td rowspan="2">$<?php echo $row->other_adj ?></td>
                            <td rowspan="2">$<?php echo $row->total_adj ?></td>
                            <td>$<?php echo $row->cmp_market_val ?></td>
                            <td>$<?php echo $o_compare_info[0]->appraised_val ?></td>
                            <td>$<?php echo $row->value_gap ?></td>
                        </tr>
                        <tr>
                            <td>$<?php echo sprintf("%.2f", ($row->cmp_market_val/$row->living_area)); ?></td>
                            <td>$<?php echo $o_compare_info[0]->appraised_aver_val ?></td>
                            <td>$<?php echo $row->value_aver_gap ?></td>
                        </tr>
                    <?php  } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" rowspan="2" class="text-left"><b>R1</b></td>
                        <td colspan="7" rowspan="2" class="text-right"><b>Median Comparable Property Value</b></td>
                        <td><b>$<?php echo $o_total_mid_val ?></b></td>
                        <td colspan="2" rowspan="2"></td>
                    </tr>
                    <tr>
                        <td><b>$<?php echo $o_total_aver_mid_val ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="6" rowspan="2" class="text-left"><b>R2</b></td>
                        <td colspan="7" rowspan="2" class="text-right"><b>vs. <?php echo $o_compare_info[0]->address ?> Noticed Property Value</b></td>
                        <td><b>$<?php echo $o_compare_info[0]->appraised_val ?></b></td>
                        <td colspan="2" rowspan="2"></td>
                    </tr>
                    <tr>
                        <td><b>$<?php echo $o_compare_info[0]->appraised_aver_val ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-left"><b>R3</b></td>
                        <td colspan="7" class="text-right"><b>Over-valued by</b></td>
                        <td><b>= $<?php echo ($o_compare_info[0]->appraised_val - $o_total_mid_val); ?></b></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                <?php  } ?>
            </table>
        </div>
    </div>
    <div class="row">
        <h3 class="col-md-12 <?php if(!$o_flag){echo 'type-hidden';} ?>">Comparable Property Land and Improvement Details</h3>
        <h3 class="col-md-12 <?php if($o_flag){echo 'type-hidden';} ?>">Self Property Land and Improvement Details</h3>
        <div id="gmap" class="col-md-8"></div>
        <div id="noticed-info" class="col-md-4">
            <table class="table table-hover">
                <tr>
                    <th>Property ID</th>
                    <td><?php echo $o_prop_id ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $o_compare_info[0]->address.', '.$o_compare_info[0]->city_zip ?></td>
                </tr>
                <tr>
                    <th>Neighborhood ID</th>
                    <td><?php echo $o_compare_info[0]->hood_id ?></td>
                </tr>
                <tr>
                    <th>Year Built.Remodeled</th>
                    <td><?php echo $o_compare_info[0]->year ?></td>
                </tr>
                <tr>
                    <th>Grade</th>
                    <td><?php echo $o_compare_info[0]->full_grade ?></td>
                </tr>
                <tr>
                    <th>Improvement Area(sqf)</th>
                    <td><?php echo $o_compare_info[0]->living_area ?></td>
                </tr>
                <tr>
                    <th>Noticed Total Property Value</th>
                    <td>$<?php echo $o_compare_info[0]->appraised_val ?></td>
                </tr>
                <tr>
                    <th>Noticed Property Value $/sqf</th>
                    <td>$<?php echo $o_compare_info[0]->appraised_aver_val ?></td>
                </tr>
                <tr>
                    <th>Noticed Land Value</th>
                    <td>$<?php echo $o_compare_info[0]->land_val ?></td>
                </tr>
                <tr>
                    <th>Noticed Total Improvement Value</th>
                    <td>$<?php echo $o_compare_info[0]->imprv_val ?></td>
                </tr>
                <tr>
                    <th>Noticed Swimming Pool Value</th>
                    <td>$<?php echo $o_compare_info[0]->swim_val ?></td>
                </tr>
                <tr>
                    <th>Noticed Extra Improvement Value</th>
                    <td>$<?php echo $o_compare_info[0]->extra_val ?></td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="row <?php if(!$o_flag){echo 'type-hidden';} ?>">
        <div class="col-md-12">
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th colspan="6"></th>
                        <th colspan="8">Land and Improvement Details</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Property ID</th>
                        <th>Address</th>
                        <th>Grade</th>
                        <th>Living Area</th>
                        <th>Year Built</th>
                        <th>Land Value</th>
                        <th>1st Floor</th>
                        <th>2nd Floor</th>
                        <th>Attached Garage</th>
                        <th>Detached Garage</th>
                        <th>Coverd Porch</th>
                        <th>Open Porch</th>
                        <th>Swimming Pool</th>
                        <th>Other Features Value</th>
                        <th>Total Appraisal Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($o_compare_info as $row) { ?>
                        <?php if($row->prop_id != $o_prop_id) { ?>
                            <tr>
                                <td><?php echo $row->prop_id ?></td>
                                <td><?php echo $row->address ?></td>
                                <td><?php echo $row->grade ?></td>
                                <td><?php echo $row->living_area ?></td>
                                <td><?php echo $row->year ?></td>
                                <td>$<?php echo $row->land_val ?></td>
                                <td><?php echo $row->floor_1_area ?></td>
                                <td><?php echo $row->floor_2_area ?></td>
                                <td><?php echo $row->attached ?></td>
                                <td><?php echo $row->detached ?></td>
                                <td><?php echo $row->covered_p ?></td>
                                <td><?php echo $row->open_porc ?></td>
                                <td><?php echo $row->swim_area ?></td>
                                <td>$<?php echo $row->extra_val ?></td>
                                <td>$<?php echo $row->appraised_val ?></td>
                            </tr>
                        <?php  } ?>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row text-center <?php if(!$o_flag){echo 'type-hidden';} ?>">
        <a role="button" class="btn btn-primary btn-lg" id="report">PDF Report</a>
    </div>
    <form method="post" id="reportjump" style="visibility: hidden" action="/texas/index.php/report/index">
        <input type="text" id="hidporperty" name="hidporperty" value="<?php echo $o_prop_id ?>">
        <input type="submit" id="hidsubmit">
    </form>
</div>

<script type="application/javascript" src="/texas/public/js/jquery-3.2.1.min.js"></script>
<script type="application/javascript" src="/texas/public/js/jquery.easing.min.js"></script>
<script type="application/javascript" src="/texas/public/js/bootstrap.min.js"></script>
<script type="application/javascript" src="/texas/public/js/jquery.waypoints.min.js"></script>
<script type="application/javascript" src="/texas/public/js/echarts.min.js"></script>
<script type="application/javascript" src="/texas/public/js/holder.js"></script>
<script type="application/javascript" src="/texas/public/js/html2canvas.min.js"></script>
<script type="application/javascript" src="/texas/public/js/jspdf.min.js"></script>
<script type="application/javascript">
    var compare_info = [
        <?php foreach ($o_compare_info as $row) {
            echo '[';
            echo $row->prop_id.',';
            echo '\''.$row->address.'\',';
            echo '\''.$row->city_zip.'\',';
            echo '\''.$row->grade.'\',';
            echo '\''.$row->full_grade.'\',';
            echo '\''.$row->hood_id.'\',';
            echo $row->year.',';
            echo $row->floor_1_area.',';
            echo $row->floor_2_area.',';
            echo $row->attached.',';
            echo $row->detached.',';
            echo $row->covered_p.',';
            echo $row->open_porc.',';
            echo $row->swim_area.',';
            echo $row->appraised_val.',';
            echo $row->appraised_aver_val.',';
            echo $row->living_area.',';
            echo $row->land_val.',';
            echo $row->imprv_val.',';
            echo $row->swim_val.',';
            echo $row->extra_val.',';
            echo '],';
        }?>
    ];

    var compare_result = [
        <?php if($o_flag) {
            foreach ($o_compare_result as $row) {
                echo '[';
                echo $row->prop_id.',';
                echo '\''.$row->address.'\',';
                echo '\''.$row->grade.'\',';
                echo $row->living_area.',';
                echo $row->year.',';
                echo $row->appraised_val.',';
                echo $row->land_adj.',';
                echo $row->swim_adj.',';
                echo $row->grade_adj.',';
                echo $row->age_adj.',';
                echo $row->size_adj.',';
                echo $row->other_adj.',';
                echo $row->total_adj.',';
                echo $row->cmp_market_val.',';
                echo $row->value_gap.',';
                echo $row->value_aver_gap.',';
                echo '],';
            }
        }?>
    ];

    $(function () {
        $('#comp-chart').css('height', $('#comp-info').css('height'));
        <?php if($o_flag){echo 'initCompChart();';} ?>
        clickReport();
    });

    // click report button
    var clickReport = function () {
        $("#report").click(function () {
            $('#reportjump').submit();
        });
    };

    // init comparable chart
    var initCompChart = function () {
        var myChart = echarts.init(document.getElementById('comp-chart'));
        var prop_val = [
            <?php foreach ($o_compare_info as $row) {
                echo $row->appraised_val.',';
            }?>
        ];
        var prop_addr = [
            <?php foreach ($o_compare_info as $row) {
                echo '\''.$row->address.'\',';
            }?>
        ];
        var option = {
            backgroundColor: '#ffffff',
            color: ['#f35f55'],
            tooltip: {},
            legend: {
                data:['Total Adjusted']
            },
            xAxis: {
                name: 'Address',
                data: prop_addr
            },
            yAxis: {
                name: 'Value',
                min: <?php echo $o_compare_info[0]->land_val ?>
            },
            series: [{
                name: 'Property Adjusted',
                type: 'bar',
                stack: 'one',
                itemStyle: {
                    normal: {
                        color: function(params) {
                            var colorList = ['#f35f55', '#39DBAC', '#39DBAC', '#39DBAC', '#39DBAC', '#39DBAC', '#39DBAC'];
                            return colorList[params.dataIndex];
                        }
                    }
                },
                markLine: {
                    label: 'Middle Value',
                    lineStyle: {
                        normal: {
                            color: '#5d5d5d',
                            type: 'solid',
                            width: 3
                        }
                    },
                    data: [{
                        name: 'Middle Value',
                        yAxis: <?php if($o_flag){echo $o_total_mid_val;}else{echo 0;} ?>
                    }]
                },
                data: prop_val
            }]
        };
        myChart.setOption(option);
    };

    // update property information
    var updatePropInfo = function (item) {
        $("#noticed-info table tr:eq(0) td")[0].innerHTML = compare_info[item][0];
        $("#noticed-info table tr:eq(1) td")[0].innerHTML = compare_info[item][1] + ', ' + compare_info[item][2];
        $("#noticed-info table tr:eq(2) td")[0].innerHTML = compare_info[item][5];
        $("#noticed-info table tr:eq(3) td")[0].innerHTML = compare_info[item][6];
        $("#noticed-info table tr:eq(4) td")[0].innerHTML = compare_info[item][4];
        $("#noticed-info table tr:eq(5) td")[0].innerHTML = compare_info[item][16];
        $("#noticed-info table tr:eq(6) td")[0].innerHTML = compare_info[item][14];
        $("#noticed-info table tr:eq(7) td")[0].innerHTML = compare_info[item][15];
        $("#noticed-info table tr:eq(8) td")[0].innerHTML = compare_info[item][17];
        $("#noticed-info table tr:eq(9) td")[0].innerHTML = compare_info[item][18];
        $("#noticed-info table tr:eq(10) td")[0].innerHTML = compare_info[item][19];
        $("#noticed-info table tr:eq(11) td")[0].innerHTML = compare_info[item][20];
    };

    // init google map
    var map;
    var markers = [];
    var geocoder;
    var initGoogleMap = function () {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('gmap'), {
            zoom: 15,
            center: {lat: 30.272095, lng: -97.733367}
        });
        for (var i = 0; i < compare_info.length; i++) {
            var full_address = compare_info[i][1] + ', ' + compare_info[i][2];
            if (compare_info[i][0] == <?php echo '\''.$o_prop_id.'\'' ?>) {
                geocoder.geocode({'address': full_address}, function(results, status) {
                    if (status === 'OK') {
                        markers.push(new google.maps.Marker({
                            position: results[0].geometry.location,
                            animation: google.maps.Animation.DROP,
                            map: map
                        }));
                        map.setCenter(results[0].geometry.location);
                    }
                });
            }
            else {
                geocoder.geocode({'address': full_address}, function (results, status) {
                    if (status === 'OK') {
                        markers.push(new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                        }));
                    }
                });
            }
        }
        google.maps.event.addDomListener(window, 'load', function () {
            for(var i = 0; i < markers.length; i++) {
                (function(item){
                    google.maps.event.addListener(markers[i], "click", function() {
                        updatePropInfo(item);
                    });
                })(i);
            }
        });
    };
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPp8rXk8sZibhukpLDkQC0rhKY3s2uhBY&callback=initGoogleMap" async defer></script>
</body>
</html>