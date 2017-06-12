<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/1/2017
 * Time: 11:52 AM
 */
?>

<header id="fh5co-header" class="fh5co-cover" role="banner" style="background: url(<?php echo site_url('../public/images/home-1.jpg'); ?>) center no-repeat #fff;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="display-t">
                    <div class="display-tc animate-box" data-animate-effect="fadeIn">
                        <h1>Your Tax is Fair?</h1>
                        <h2>Help you analyze your property tax by a comprehensive comparison with neighbors.</h2>
                        <div class="row">
                            <form class="form-inline" id="fh5co-header-subscribe">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="address" placeholder="Entering Your Property Address Now.">
                                        <button id="answer" type="button" class="btn btn-default">answer</button>
                                    </div>
                                </div>
                            </form>
                            <form style="display: none" action="result" method="POST" id="form">
                                <input type="hidden" id="para1" name="para1" value=""/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
