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
namespace App\controllers;

use App\models\UserModel;

/**
 * PHP version 7.2
 *
 * @category Header
 * @package  App
 * @author   hybridX <hybridx18@gmail.com>
 * @license  https://hybridX.cybzilla.com hybridx
 * @link     http://php.dv
 */
class UserController
{
    public $redirectUri;
    public $user;

    /**
     * PHP version 7.2
     *
     * @param string $redirectUri This is the Server redirect string
     */
    public function __construct($redirectUri)
    {
        $this->user = new UserModel;
        $this->redirectUri = $redirectUri;
        session_start();
    }

    /**
     * Router function
     *
     * @param string $redirectUri redirect string
     *
     * @return void
     */
    public function route($redirectUri)
    {
        $arr = explode('/', $redirectUri);

        if (count($arr) >= 2 && $arr[1] != '') {
            try {
                self::{$arr[1]}();
            } catch (\Error $e) {
                include_once "views/404.php";
                // var_dump($e);
            }
        } else {
            include_once "views/index.php";
        }
    }

    /**
     * View index
     *
     * @return void
     */
    public function home()
    {
        include_once 'views/index.php';
    }
    
    /**
     * View profile
     *
     * @return void
     */
    public function profile()
    {
        if (!isset($_SESSION['uname'])) {
            header('Location: /login');
            return false;
        }
        try {
            $userData = $this->user->getUserData($_SESSION['uname']);
            $userData = $userData;
        } catch (\Error $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        include_once 'views/profile.php';
    }

    /**
     * Update user details
     *
     * @return void
     */
    public function updateUser()
    {
        if (isset($_SESSION['uname'])) {
            $status = $this->user->updateUserDetails(
                $_SESSION['uname'],
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['email']),
                htmlspecialchars($_POST['password']),
                htmlspecialchars($_POST['phone']),
                htmlspecialchars($_POST['gender'])
            );
        }
        echo $status;
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
    /**
     * Register user
     *
     * @return void
     */
    public function registerUser()
    {
        $status = $this->user->registerUserData(
            htmlspecialchars($_POST['username']),
            htmlspecialchars($_POST['name']),
            htmlspecialchars($_POST['email']),
            htmlspecialchars($_POST['password']),
            htmlspecialchars($_POST['phone']),
            htmlspecialchars($_POST['gender'])
        );
        if ($status == 1) {
            echo 'ok';
        } else {
            echo $status;
        }
    }
    /**
     * Show include view
     *
     * @return void
     */
    public function register()
    {
        include_once 'views/register.php';
    }
    /**
     * Login View
     *
     * @return void
     */
    public function login()
    {
        include_once 'views/login.php';
    }

    /**
     * Login Function for Users
     *
     * @return void
     */
    public function loginCheck()
    {
        
        $this->user = $this->user->getUserLogin(
            htmlspecialchars($_POST['username']),
            htmlspecialchars($_POST['password'])
        );
        if (true === $this->user) {
            $_SESSION['uname'] = htmlspecialchars($_POST['username']);
            $_SESSION['passwd'] = htmlspecialchars($_POST['password']);
            echo 'login-success';
        } else {
            echo "Username or Password incorrect";
        }
    }
    /**
     * Check if user is registed and then email username and new password
     *
     * @return void
     */
    public function forgotPassword()
    {
        $status = $this->user->resetPassword(htmlspecialchars($_POST['email']));
        if (true === $status) {
            echo "email-sent";
        } else {
            echo "$status";
        }
    }
}
