<?php require_once 'templates/header.php'; ?>

<form class="form-group offset-3 col-5" id="login-form" action="/login" method="GET">
    <label class="sr-only" for="username">Username</label>
    <input type="text" class="form-control mb-2 mr-sm-2" 
    id="username-login" placeholder="Username" required>

    <label class="sr-only" for="password">Password</label>
    <div class="input-group mb-2 mr-sm-2">
        <input type="password" class="form-control" 
        id="password-login" placeholder="Password" required>
    </div>
    <input type="submit" class="btn btn-primary mb-3" value="login">
    <button type="button" class="btn btn-primary offset-1 mb-3" data-toggle="modal" 
    data-target="#forgotPasswordModal">
        Forgot Password
    </button>
</form>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" 
                id="forgotPasswordModalLabel">Modal title</h5>
                <button type="button" class="close" 
                data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="forgot-password">
                    <div class="row">
                        <div class="col-xl-4 form-group">
                            <p>
                                Enter your registered email :
                            </p>
                        </div>
                        <div class="col-xl-8 form-group">
                            <input type="email" class="form-control"
                            id="forgot-password-email" name="email"
                            required>
                        </div>
                    </div>
                    <div class="row col-md-2 offset-3">
                        <input type="submit" 
                        class="btn btn-warning" value="Send me password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <small class="text-muted">
                    PS : This will change your current password 
                    and a new password will
                    be sent to your Email ID only if you are registered.*
                </small>
            </div>
        </div>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>