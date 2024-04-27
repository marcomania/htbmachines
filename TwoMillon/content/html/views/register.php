<?php

if ($_SESSION && $_SESSION['loggedin']) {
        header("Location: /home");
        exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An online platform to test and advance your skills in penetration testing and cyber security. Join today and start training in our online labs." />
    <meta name="keywords" content="penetration testing, pen testing, penetration testing labs, pen testing labs, penetration testing training">
    <meta name="author" content="Hack The Box">

    <title>Hack The Box :: Penetration Testing Labs</title>
    <link rel="canonical" href="https://www.hackthebox.eu" />
    <link rel="icon" href="/images/favicon.png">
    <!-- Core CSS -->
    <link href="/css/htb-frontend.css" rel="stylesheet">
</head>
<body class="blank" style="overflow-y:hidden; ">
    <!-- Wrapper-->
    <div class="wrapper">
            <!-- Main content-->
            <section class="content" style="margin:0px; padding:0px;">
                <div class="container-center animated slideInDown centerpage">

            <div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-add-user"></i>
                </div>
                <div class="header-title">
                    <h3>Registration</h3>
                    <small>
                        Type your details below.                </small>
                </div>
            </div>
            <?php
                if (isset($_GET['error'])){
                    echo '<div class="panel panel-filled">';
                    echo '<div class="panel-heading"><span class="text-warning"><i class="fa fa-warning"></i>';
                    echo(htmlspecialchars($_GET['error']));
                    echo '</div></div>';
                }
            ?>
            <div class="panel panel-filled">
                <div class="panel-body">
                    <form id="registerForm" role="form" method="POST" action="/api/v1/user/register">
                        <div class="form-group ">
                            <label class="control-label" for="name">Invite code</label>
                            <input readonly type="text" title="Invite code" required="" value="" name="code" id="code" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label class="control-label" for="name">Username</label>
                            <input type="text" placeholder="" title="Pick a username" required="" value="" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label class="control-label" for="email">E-Mail</label>
                            <input type="email" title="A valid e-mail address" placeholder="" required="" value="" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group ">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Password should contain capital, small, numbers and special chars." placeholder="" required="" name="password" id="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password_confirmation">Confirm password</label>
                            <input type="password" title="Type the same password again." placeholder="" required="" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <button class="btn btn-accent pull-right">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
            <div class="particles_full" id="particles-js"></div>
        </section>
        <!-- End main content-->
    
    </div>
    <!-- End wrapper-->
    
    <!-- scripts -->
    <script src="/js/htb-frontend.min.js"></script>
    <script defer src="/js/inviteapi.min.js"></script>
    <script>
        $(document).ready(function() {
            // Retrieve the invite code from localStorage
            var inviteCode = localStorage.getItem('inviteCode');

            // Fill the input field
            $('#code').val(inviteCode);
        });
    </script>
</body>
</html>
