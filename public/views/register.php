<?php require_once 'templates/header.php'; ?>

<div class="container">
    <form class="form-horizontal" id="registration_form" 
    role="form" method="POST" action="#">
        <h2>Registration</h2>
        <div class="form-group">
            <label for="name" class="col-sm-5 control-label">Name</label>
            <div class="col-sm-12">
                <input required type="text" id="name" 
                placeholder="Name" class="form-control"
                name="name" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-5 control-label">Username* </label>
            <div class="col-sm-12">
                <input required type="text" id="username" 
                placeholder="username" class="form-control" 
                name="username">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-5 control-label">Email* </label>
            <div class="col-sm-12">
                <input required type="email" id="email" 
                placeholder="email@example.com" class="form-control" 
                name="email">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-5 control-label">Password*</label>
            <div class="col-sm-12">
                <input required type="password" id="pass" 
                placeholder="Password" class="form-control" minlength="6">
            </div>
        </div>
        <div id="message"></div>
        <div class="form-group">
            <label for="password" class="col-sm-5 control-label">
                Confirm Password*
            </label>
            <div class="col-sm-12">
                <input required type="password" id="cpass"
                name="password" placeholder="Password" 
                class="form-control" minlength="6">
            </div>
        </div>
        <div class="form-group">
            <label for="phoneNumber" class="col-sm-5 control-label">
                Phone number 
            </label>
            <div class="col-sm-12">
                <input required type="number" id="phone" 
                placeholder="Phone number" name="phone" 
                class="form-control" minlength="10">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-5">Gender</label>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="radio-inline">
                            <input required type="radio" id="femaleRadio"
                            value="f" name="gender">
                            Female
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-inline">
                            <input required type="radio" id="maleRadio" 
                            value="m" name="gender">
                            Male
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-inline">
                            <input required type="radio" id="otherRadio" 
                            value="o" name="gender">
                            Other
                        </label>
                    </div>
                </div>
            </div>
        </div> <!-- /.form-group -->
        <div class="form-group">
            <div class="col-sm-12 col-sm-offset-3">
                <span class="help-block">*Required fields</span>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Register">
    </form> <!-- /form -->
</div>

<?php require_once 'templates/footer.php'; ?>