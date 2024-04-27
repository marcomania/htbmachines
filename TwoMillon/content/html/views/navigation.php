<?php 

if (!$_SESSION["loggedin"] || !$_SESSION["username"]) {
    header("Location: /");
    exit;
}

?>
<!-- Navigation-->
<aside class="navigation">
    <nav>
        <ul class="nav luna-nav">
                <li class="nav-info" style="margin-top:0px !important; background-color: transparent !important;">
                    <div>
                        Server: <span class="text-success" id="vpnServer">EU FREE 1</span><br>
                        Load: <span class="text-success"><span id="vpnLoad"></span>49%</span><br>
                        <span id="vipLink"></span>
                    </div>
                </li>
            <li class="nav-category">
                <i class="pe-7s-box2"></i> Main
            </li>
            <li class="<?= ($_SERVER['REQUEST_URI'] == '/home' ? 'active' : '') ?>">
                <a href="/home">Dashboard</a>
            </li>

            <li class="<?= ($_SERVER['REQUEST_URI'] == '/home/rules' ? 'active' : '') ?>">
                <a href="/home/rules">Rules</a>
            </li>

            <li class="<?= ($_SERVER['REQUEST_URI'] == '/home/changelog' ? 'active' : '') ?>">
                <a href="/home/changelog">Change Log</a>
            </li>
            <li class="">
                <a href="#">
                    <span class="badge pull-right badge-accent">32</span>
                    Ideas & Feedback
                </a>
            </li>

            <li class="#">
                <a href="#">Support</a>
            </li>

            <li class="nav-category">
                <i class="pe-7s-portfolio"></i> Careers
            </li>
            <li class="">
                <a href="#">Looking for a Job?</a>
            </li>
            <li class="">
                <a href="#">Job Offers
                    <span class="badge pull-right">11</span>
                </a>
            </li>
            <li class="">
                <a href="#">Companies</a>
            </li>
            

            <li class="nav-category">
                <i class="pe-7s-graph2"></i> Rankings
            </li>
            <li class="">
                <a href="#"><i class="fa fa-trophy text-warning"></i> Hall of Fame</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-users text-info"></i> Team Rankings</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-globe text-success"></i> Country Rankings</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-star-o text-gold"></i> VIP Rankings</a>
            </li>
            
            <li class="nav-category">
                <i class="pe-7s-network"></i> Labs
            </li>
            <li class="<?= ($_SERVER['REQUEST_URI'] == '/home/access' ? 'active' : '') ?>">
                <a href="/home/access">Access</a>
            </li>
            <li>
                <a href="#machines_nav" data-toggle="collapse" aria-expanded="false">
                    Machines <span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                </a>
                <ul id="machines_nav" class="nav nav-second collapse ">
                    <li class=""><a href="#"><span class="badge pull-right">32</span>Active</a></li>
                    <li class=""><a href="#"><span class="badge pull-right">5</span>Retired</a></li>
                    <li class=""><a href="#"><span class="badge pull-right">1</span>Unreleased</a></li>
                    <li class=""><a href="#"><span class="badge pull-right">0</span>Owned</a></li>
                    <li class=""><a href="#"><span class="badge pull-right">10</span>Submissions</a></li>
                    <li class=""><a href="#">New Submission</a></li>
                </ul>
            </li>
            <li>
                <a href="#challenges_nav" data-toggle="collapse" aria-expanded="false">
                    Challenges <span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>
                </a>
                <ul id="challenges_nav" class="nav nav-second collapse ">
                    <li class=""><a href="#"><span class="badge pull-right">10</span>Reversing </a></li>
                    <li class=""><a href="#"><span class="badge pull-right">17</span>Crypto </a></li>
                    <li class=""><a href="#"><span class="badge pull-right">17</span>Stego </a></li>
                    <li class=""><a href="#"><span class="badge pull-right">4</span>Pwn </a></li>
                    <li class=""><a href="#"><span class="badge pull-right">5</span>Web </a></li>
                    <li class=""><a href="#"><span class="badge pull-right">4</span>Misc </a></li>
                    <li class=""><a href="#"><span class="badge pull-right">7</span>Forensics </a></li>
                </ul>
            </li>

            <li class="nav-category">
                <i class="pe-7s-smile"></i> Social
            </li>
            <li class="">
                <a href="#">Member Finder</a>
            </li>
            <li class="">
                <a href="#">Shoutbox</a>
            </li>
            <li class="">
                <a href="#">Team Shoutbox</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-comments"></i> Forum</a>
            </li>
            <li>
                <a class="twitter-link" href="https://twitter.com/hackthebox_eu" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
            </li>
            <li>
                <a class="facebook-link" style="color:#3B5998;" href="https://www.facebook.com/hackthebox.eu" target="_blank"><i class="fa fa-facebook-square"></i> Facebook</a>
            </li>
            <li class="nav-info">
                <i class="pe pe-7s-box2 text-accent"></i>

                <div class="m-t-xs">
                    <span class="c-white">Hack The Box</span> is an online platform allowing you to test and advance your skills in cyber security. Use it responsibly and don't hack your fellow members...                        </div>
            </li>
        </ul>
    </nav>
</aside>
<!-- End navigation-->