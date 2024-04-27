<?php 

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: /");
    exit;
}

?>
<!-- Header-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <div id="mobile-menu">
                <div class="left-nav-toggle">
                    <a href="#">
                        <i class="stroke-hamburgermenu"></i>
                    </a>
                </div>
            </div>
            <a href="/home"  class="navbar-brand" style="background-image: url('/images/logofull-tr-web.png'); background-color: #000000 !important;"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="left-nav-toggle">
                <a href="">
                    <i class="stroke-hamburgermenu"></i>
                </a>
            </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="gold-link" data-toggle="modal" data-target=""><i class="fa fa-star-o"></i> VIP slots left: <span class="flag flag-eu"></span> <span id="freeEUSlots">393</span> <span class="flag flag-us"></span> <span id="freeUSSlots">175</span> </a>
                    </li>
                    <li>
                        <a href="#" class="menutext" data-toggle="modal" data-target=""><i class="fa fa-lightbulb-o"></i> Feedback</a>
                    </li>
                    <li id="testimonialLink">
                        <a href="#" class="menutext" data-toggle="modal" data-target=""><i class="fa fa-star"></i> Testimonial</a>
                    </li>
                    <li class="profil-link">
                        <a href="#" data-toggle="modal" data-target="#userModal">
                            <span class="profile-address profile-address-dark"><?= htmlspecialchars($_SESSION["username"]); ?></span>
                            <img src="/images/user.png" class="img-rounded avatar_bg" alt="">
                        </a>
                    </li>
                </ul>
        </div>
    </div>
</nav>
<!-- End header-->
