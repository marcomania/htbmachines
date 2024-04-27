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
    <meta property="og:title" content="Rules" />
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
    <?php
        include("header.php");
        include("navigation.php");
    ?>
    <div class="wrapper">
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="view-header">
                <div class="pull-right text-right" style="line-height: 14px">
                  <small>Hack The Box <br>Rules <br>
                    <span class="c-white">2.19.0</span>
                  </small>
                </div>
                <div class="header-icon">
                  <i class="pe page-header-icon pe-7s-note2"></i>
                </div>
                <div class="header-title">
                  <h3 class="m-b-xs">Rules</h3>
                  <small> We expect each and every one of you to comply by the rules. Failure to do so might result in a permanent ban. </small>
                </div>
              </div>
              <hr>
            </div>
          </div>
          <div class="panel panel-filled panel-c-success">
            <div class="panel-heading">
              <div class="panel-tools">
              </div>
              <span class="badge badge-accent">1</span> Dont try to hack anything apart from the HTB Network
            </div>
            <div class="panel-body"> The HTB Network is 10.10.10.0/24 (10.10.10.1-10.10.10.254). Limit all your curiosity in this specific subnet. </div>
            <div class="panel-footer"></div>
          </div>
          <div class="panel panel-filled panel-c-success">
            <div class="panel-heading">
              <div class="panel-tools">
              </div>
              <span class="badge badge-accent">2</span> Dont hack machines apart from the intended ones
            </div>
            <div class="panel-body"> Its not the end of the world if you try to hack gateways and other nodes on HTB Network (10.10.10.0/24) but if you succeed dont do any damage and inform us asap. </div>
            <div class="panel-footer"></div>
          </div>
          <div class="panel panel-filled panel-c-success">
            <div class="panel-heading">
              <div class="panel-tools">
              </div>
              <span class="badge badge-accent">3</span> Any form of DoS (Denial of Service) is forbidden
            </div>
            <div class="panel-body"> There is no reason to use any form of DoS on any machine inside or outside of HTB Network. If you accidentaly perform such an attack let us know asap. </div>
            <div class="panel-footer"></div>
          </div>
          <div class="panel panel-filled panel-c-success">
            <div class="panel-heading">
              <div class="panel-tools">
              </div>
              <span class="badge badge-accent">4</span> Dont try to hack other members
            </div>
            <div class="panel-body"> The network is built in such a way that direct communication between two member systems is prohibited. Although there are ways to attack another member, attacking or even connecting to other member's clients is strictly prohibited. </div>
            <div class="panel-footer"></div>
          </div>
          <div class="panel panel-filled panel-c-success">
            <div class="panel-heading">
              <div class="panel-tools">
              </div>
              <span class="badge badge-accent">5</span> Dont use your production PC to connect to HTB Network
            </div>
            <div class="panel-body"> We strongly recommend not to use your production PC to connect to the HTB Network. Build a VM or physical system just for this purpose. HTB Network is filled with security enthusiasts that have the skills and toolsets to hack systems and no matter how hard we try to secure you, we are likely to fail :P We do not hold any responsibility for any damage, theft or loss of personal data although in such event, we will cooperate fully with the authorities. </div>
            <div class="panel-footer"></div>
          </div>
          <div class="panel panel-filled panel-c-success">
            <div class="panel-heading">
              <div class="panel-tools">
              </div>
              <span class="badge badge-accent">6</span> Dont spoil!
            </div>
            <div class="panel-body"> Dont share how you hacked each machine with other members. This includes the invite code generation and all challenges. </div>
            <div class="panel-footer"></div>
          </div>
        </div>
      </section>
    </div>
    </div>
    <!--User Modal-->
    <?php
        include_once "usermodal.php";
    ?>

<script src="/js/htb-backend.min.js"></script>
</body>
</html>