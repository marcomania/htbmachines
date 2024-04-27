<?php 

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: /");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An online platform to test and advance your skills in penetration testing and cyber security." />
    <meta property="og:title" content="Dashboard" />
    <meta property="og:image" content="/images/favicon.png" />
    <meta property="og:site_name" content="Hack The Box" />
    <meta property="og:description" content="An online platform to test and advance your skills in penetration testing and cyber security." />

    <!-- Page title -->
    <title>Hack The Box :: Dashboard </title>

    <!-- styles -->
    <link rel="stylesheet" href="/css/htb-backend.css"/>
    <link rel="stylesheet" href="/css/animate.css"/>
    <link rel="icon" href="/images/favicon.png">
</head>
<body>
<!-- Wrapper-->
<div class="wrapper">

    <?php
        include("header.php");
        include("navigation.php");
    ?>

    <!-- Main content-->
    <section class="content">
                <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                        <div class="pull-right text-right" style="line-height: 14px">
                            <small>Hack The Box<br>Dashboard<br> <span class="c-white">1.2.8</span></small>
                        </div>
                        <div class="header-icon">
                            <i class="pe page-header-icon pe-7s-box2"></i>
                        </div>
                        <div class="header-title">
                            <h3 class="m-b-xs">Hack The Box</h3>
                            <small>
                                Hack The Box is an online platform allowing you to test and advance your skills in cyber security. Use it responsibly and don't hack your fellow members...                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2 col-xs-6">
                    <div class="panel panel-filled">

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="pe pe-7s-display1" style="font-size: 48px;"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h2 class="m-n" id="machines">32</h2>
                                    <div class="small">Machines</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-6">
                    <div class="panel panel-filled">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="pe pe-7s-users" style="font-size: 48px;"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h2 class="m-n" id="sessions">803</h2>
                                    <div class="small">Online Members</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-6">
                    <div class="panel panel-filled">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="pe pe-7s-network" style="font-size: 48px;"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h2 class="m-n" id="vpn">693</h2>
                                    <div class="small">Connections</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xs-6">
                    <div class="panel panel-filled">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="pe pe-7s-share" style="font-size: 48px;"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h2 class="m-n">
                                        <span id="latency">1.54</span><span class="slight">ms</span>
                                    </h2>
                                    <div class="small">Response Time</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="panel panel-filled" style="position:relative;">
                        <div style="position: absolute;bottom: 0;left: 0;right: 0; z-index: -1">
                            <span class="sparkline"></span>
                        </div>
                        <div class="panel-body">
                            <div class="m-t-sm">
                                <div class="c-white">30384 New Members</div>
                                <span class="small c-white">2003495 Members <i class="fa fa-play fa-rotate-270 text-accent"> </i> 2%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-filled">
                        <div class="panel-heading"><i class="fa fa-users"></i> Top Teams</div>
                        <div class="panel-body">
                            <i class="fa-solid fa-screen-users"></i>
                            <span class=""><i class="fa fa-users"></i>&nbsp;<a href="#">DuckTeam</a> <span class="text-success pull-right"><i class="fa fa-crosshairs"></i> 28</span> <span class="text-info pull-right"><i class="fa fa-user"></i> 28&nbsp;</span> </span>
                                <br>
                            <span class=""><i class="fa fa-users"></i>&nbsp;<a href="#">Testers</a> <span class="text-success pull-right"><i class="fa fa-crosshairs"></i> 15</span> <span class="text-info pull-right"><i class="fa fa-user"></i> 14&nbsp;</span> </span>
                                <br>
                            <span class=""><i class="fa fa-users"></i>&nbsp;<a href="#">Admins</a> <span class="text-success pull-right"><i class="fa fa-crosshairs"></i> 5</span> <span class="text-info pull-right"><i class="fa fa-user"></i> 5&nbsp;</span> </span>
                                <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="panel panel-filled">
                    <div class="panel-heading"><span class="text-warning"><i class="fa fa-warning"></i> Important Announcement: We are currently performing database migrations. For this reason some of the website's features will be unavailable. We apologize for the inconvenience.</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Lab Service Status</h4>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 small">
                    <div id="panel1" class="panel panel-filled panel-c-white">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a href="#" data-toggle="tooltip" title="Status">
                                    <i id="icon1" class="fa fa-circle"></i>
                                </a>
                            </div>
                            eu-free-1 <span class="pull-right m-r-sm"><i data-toggle="tooltip" title="Active Users" class="fa fa-user-circle-o text-info"></i> <span id="count1"><i class="fa fa-circle-o-notch fa-spin"></i></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End main content-->
</div>
<!-- End wrapper-->

<!--Modals-->
<!--User Modal-->
<?php
    include_once "usermodal.php";
?>

<!-- scripts -->
<script src="/js/htb-backend.min.js"></script>
<script>
    async function getServerStatus() {
        await new Promise(res => setTimeout(res, 1000));
        $('#panel1').attr('class','panel panel-filled panel-c-success');
        $('#icon1').attr('class','fa fa-circle text-success');
        $('#count1').html('10');
    }

    $(document).ready(function () {
        getServerStatus();
    });
</script>
</body>
</html>
