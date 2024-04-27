<?php 

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: /");
    exit;
}

?>
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title">Control Panel: <?php echo $_SESSION["username"]; ?></h4>
                <small>Manage and view settings related to your account.</small><br>
            </div>
            <div class="modal-body">
                <h4>Actions</h4>
                <p><i class="fa fa-user"></i> <a href="#">View My Profile</a></p>
                <p><i class="fa fa-cog"></i> <a href="#">Account Settings & Team Management</a></p>
                <p><i class="fa fa-lock"></i> <a href="/logout">Log Out</a></p>
                <br>
                <h4>Subscription</h4>
                <span class="subscriptionInfo"></span>
                <br>
                <p><i class="fa fa-question-circle-o text-info"></i> <a href="#" data-toggle="modal" data-target="#vipModal" data-dismiss="modal">What is VIP?</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
</div>
