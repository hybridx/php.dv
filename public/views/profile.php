<?php require_once 'templates/header.php'; ?>
<div class="container">
    <form class="form-horizontal" id="edit-profile" 
    role="form" method="POST" action="updateUser">
    <div class="form-group">
            <label for="name" class="col-sm-5 control-label">Username</label>
            <div class="col-sm-9">
                <input required type="text" id="username" 
                 class="form-control"
                name="name" autofocus
                value="<?php echo $userData['username']; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-5 control-label">Name</label>
            <div class="col-sm-9">
                <input required type="text" id="name" 
                 class="form-control"
                name="name" autofocus
                value="<?php echo $userData['fullName']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-5 control-label">Email* </label>
            <div class="col-sm-9">
                <input required type="email" id="email" 
                class="form-control" 
                name="email"
                value="<?php echo $userData['email']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-5 control-label">Password*</label>
            <div class="col-sm-9">
                <input required type="password" id="pass" 
                class="form-control" minlength="6"
                placeholder="password">
            </div>
        </div>
        <div id="message"></div>
        <div class="form-group" id="message"></div>
        <div class="form-group">
            <label for="password" class="col-sm-5 control-label">
                Confirm Password*
            </label>
            <div class="col-sm-9">
                <input required type="password" id="cpass"
                name="password"
                class="form-control" minlength="6"
                placeholder="password">
            </div>
        </div>
        <div class="form-group">
            <label for="phoneNumber" class="col-sm-5 control-label">
                Phone number 
            </label>
            <div class="col-sm-9">
                <input required type="number" id="phone" 
                name="phone" 
                class="form-control"
                value="<?php echo $userData['phone']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-5">Gender</label>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="radio-inline">
                            <input required type="radio" id="femaleRadio"
                            value="f" name="gender"
                            <?php if ($userData['gender']=='f') {
                                echo "checked";
                            } ?>>
                            Female
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-inline">
                            <input required type="radio" id="maleRadio" 
                            value="m" name="gender"
                            <?php if ($userData['gender']=='m') {
                                echo "checked";
                            } ?>>
                            Male
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-inline">
                            <input required type="radio" id="otherRadio" 
                            value="o" name="gender"
                            <?php if ($userData['gender']=='o') {
                                echo "checked";
                            } ?>>
                            Other
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <span class="help-block">*Required fields</span>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-block" 
        value="Update Account">
    </form> 
</div>
<?php require_once 'templates/footer.php'; ?>