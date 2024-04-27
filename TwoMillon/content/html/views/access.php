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
    <meta property="og:title" content="Access" />
    <meta property="og:image" content="/images/favicon.png" />
    <meta property="og:site_name" content="Hack The Box" />
    <meta property="og:description" content="An online platform to test and advance your skills in penetration testing and cyber security." />

    <!-- Page title -->
    <title>Hack The Box :: Access </title>

    <!-- styles -->
    <link rel="stylesheet" href="/css/htb-backend.css"/>
    <link rel="stylesheet" href="/css/animate.css"/>
    <link rel="icon" href="/images/favicon.png">
</head>
<body>
<!-- Wrapper-->
<div class="wrapper">
    <!-- Navigation-->
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
                            <small>Hack The Box<br>Access<br> <span class="c-white">1.2.8</span></small>
                        </div>
                        <div class="header-icon">
                            <i class="pe page-header-icon pe-7s-share"></i>
                        </div>
                        <div class="header-title">
                            <h3 class="m-b-xs">Access</h3>
                            <small>
                                Lab Access details.
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
    
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel panel-filled">
                        <div class="panel-heading">
                            <div class="panel-tools">
                                <a><i id="refresh" class="fa fa-refresh"></i></a>
                            </div>
                            HTB Lab Access Details
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Server</td>
                                    <td><span id="server_hostname">edge-eu-free-1.hackthebox.eu</span></td>
                                </tr>
                                <tr>
                                    <td>Port</td>
                                    <td><span id="server_port">1337</span></td>
                                </tr>
                                <tr>
                                    <td>Server status</td>
                                    <td><i id="server" class="fa fa-check text-accent"></i></td>
                                </tr>
                                <tr>
                                    <td>Connected</td>
                                    <td><i id="status" class="fa fa-times text-danger"></i></td>
                                </tr>
                                <tr>
                                    <td>HTB Network IPv4</td>
                                    <td><span id="ip4">0.0.0.0</span></td>
                                </tr>
                                <tr>
                                    <td>HTB Network IPv6</td>
                                    <td><span id="ip6">0::</span></td>
                                </tr>
                                <tr>
                                    <td>Traffic</td>
                                    <td><i data-toggle="tooltip" data-title="Upload" class="fa fa-arrow-circle-o-up text-accent"></i> <span id="up">0</span> MB <i data-toggle="tooltip" data-title="Download" class="fa fa-arrow-circle-o-down text-info"></i> <span id="down">0</span> MB</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/api/v1/user/vpn/generate" class="btn btn-w-md btn-default btn-block"><i class="fa fa-cloud-download"></i> Connection Pack</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="/api/v1/user/vpn/regenerate" class="btn btn-w-md btn-warning btn-block" data-toggle="tooltip" title="Warning: This will revoke your current vpn keys and issue new ones."><i class="fa fa-refresh"></i> Regenerate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <h5 class="c-white">Connection to HTB is initiated with openVPN.</h5>
                    <p>By downloading the connection pack from <a href="/api/v1/user/vpn/download">here</a> you have all the settings pre-configured and the only thing you need is to have openVPN client installed in your system.</p>
                    <p>Connection should be performed by command line. Browse to the folder you extracted the files and type <code>openvpn <?php echo $_SESSION["username"]; ?>.ovpn</code>.</p>
                    <p><span class="text-warning">Attention:</span> IPv6 support is required for the vpn to work. Also, in some OSes, the command prompt must be run as Administrator/root otherwise the connection will complete but it will fail to install the required routes to communicate with the machines.</p>
                    <h5>Alternative TCP Connection</h5>
                    <p>In case your firewall/country is restrictive and does not allow UDP/1337, by changing the following two lines in your .ovpn file you can connect using TCP/443</p>
                    <code>proto udp > proto tcp</code><br>
                    <code>remote &lt;server&gt;.hackthebox.eu 1337 > remote &lt;server&gt;.hackthebox.eu 443</code>
                    <h5>Tickets</h5>
                    <p>Below is a list of your active tickets. Each ticket allows access to a specific lab or lab group.</p>
                    <p><i class="fa fa-warning text-warning"></i> <span class="c-white">Warning:</span> Each time you "Switch" your keys are regenerated so a fresh download of your connection pack is required.</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-filled panel-collapse panel-c-success">
                                <div class="panel-heading">
                                    <div class="panel-tools">
                                        <button id="switchBtnfree" onclick="" class="btn btn-xs btn-success">Switch</button>
                                        <a class="panel-toggle"><i class="fa fa-chevron-down"></i></a>
                                    </div>
                                    <i class="fa fa-ticket text-success"></i> EU Lab Free Access
                                </div>
                                <div class="panel-body" style="display: none;">
                                    Access to the free labs in Europe.
                                </div>
                                <div class="panel-footer" style="display: none;">
                                    <i class="fa fa-clock-o"></i> Expires: Never
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End main content-->
</div>

<?php
    include_once "usermodal.php";
?>

<!-- scripts -->
<script src="/js/htb-backend.min.js"></script>
</body>
</html>
