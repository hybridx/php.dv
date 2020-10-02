<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>phpdv</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.1/dist/sweetalert2.min.css">
    <script 
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script 
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    ></script>
    <script 
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
    <script 
    src="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.1/dist/sweetalert2.all.min.js"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>   
    <script src="/assets/js/home.js"></script>
</head>

<body>
    <div class="nav shadow bg-white">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                Logo
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check"></label>
        </div>

        <div class="nav-links">
            <a href="/home" id="home">Home</a>
            <?php
            /**
             * PHP version 7.2
             *
             * @category Header
             * @package  App
             * @author   hybridX <hybridx18@gmail.com>
             * @license  https://hybridX.cybzilla.com hybridx
             * @link     http://php.dv
             */
            
            if (!isset($_SESSION['uname']) || !isset($_SESSION['passwd'])) {
                echo '
                <a href="/login" id="login">Login</a>
                <a href="/register" id="register">Register</a>';
            }
            ?>
            <?php
            if (isset($_SESSION['uname']) && isset($_SESSION['passwd'])) {
                echo '
                <a href="/logout" id="logout">Logout</a>
                <a href="/profile" id="profile">Profile</a>';
            }
            ?>
        </div>
    </div>
