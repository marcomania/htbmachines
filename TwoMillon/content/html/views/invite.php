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
                <div class="container-center centerbox">


            <div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-smile"></i>
                </div>
                <div class="header-title">
                    <h3>Hi!</h3>
                    <small>
                        Feel free to hack your way in :)                    </small>
                </div>
            </div>

            <div class="panel panel-filled">
                <div class="panel-body">
                    <form id="verifyForm"  method="post">
                        <div class="form-group ">
                            <label class="control-label" for="code">Invite Code</label>
                            <input type="text" title="Please enter your invite code" required="" value="" name="code" id="code" class="form-control">
                            <span class="help-block small"></span>
                        </div>
                        <div>
                            <button class="btn btn-accent">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
            <span class="help-block small text-center">If you are already a member click  <a href="/login">here</a> to login.</span>
        </div>
        <div class="particles_full" id="particles-js"></div>
        </section>
        <!-- End main content-->
    
    </div>
    <!-- End wrapper-->
    
    <!-- scripts -->
    <script src="/js/htb-frontend.min.js"></script>
    <script defer src="/js/inviteapi.min.js"></script>
    <script defer>
        $(document).ready(function() {
            $('#verifyForm').submit(function(e) {
                e.preventDefault();

                var code = $('#code').val();
                var formData = { "code": code };

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    url: '/api/v1/invite/verify',
                    success: function(response) {
                        if (response[0] === 200 && response.success === 1 && response.data.message === "Invite code is valid!") {
                            // Store the invite code in localStorage
                            localStorage.setItem('inviteCode', code);

                            window.location.href = '/register';
                        } else {
                            alert("Invalid invite code. Please try again.");
                        }
                    },
                    error: function(response) {
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
</body>
</html>
