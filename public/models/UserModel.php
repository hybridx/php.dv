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
namespace App\models;

use App\includes\DbConnection;
use App\includes\Validator;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * PHP version 7.2
 *
 * @category Header
 * @package  App
 * @author   hybridX <hybridx18@gmail.com>
 * @license  https://hybridX.cybzilla.com hybridx
 * @link     http://php.dv
 */

class UserModel
{
    /**
     * Constructor with connection object initalized
     */
    public function __construct()
    {
        try {
            $this->dbcon = new DbConnection;
            $this->dbcon = $this->dbcon->getCon();
            $this->validator = new Validator;
            $this->mailer = new PHPMailer(true);
        } catch (\Error $error) {
            echo $error->getMessage();
        }
    }

    /**
     * Register user data into database
     *
     * @param string $username username from Registration from
     * @param string $name     name Registration from
     * @param string $email    source Registration form
     * @param string $password source Registration form
     * @param string $phone    source Registration form
     * @param string $gender   source Registration form
     *
     * @return void
     */
    public function registerUserData(
        $username,
        $name,
        $email,
        $password,
        $phone,
        $gender
    ) {
        try {
            $stmt = $this->validator->validateUserData(
                $username,
                $name,
                $email,
                $password,
                $phone
            );
            $password = crypt($password, 'p@$$w0rD');
            $stmt = $this->dbcon->prepare(
                "INSERT INTO `User` 
                (`username`, 
            `fullName`, 
            `email`, 
            `passwd`, 
            `phone`, 
            `gender`) 
            VALUES 
            ('$username', 
            '$name', 
            '$email', 
            '$password', 
            '$phone', 
            '$gender')"
            );
            return $stmt->execute();
        } catch (\Error $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Login check for users
     *
     * @param mixed $username Username for login
     * @param mixed $password Password form login
     *
     * @return void
     */
    public function getUserLogin($username, $password)
    {
        $password = crypt($password, 'p@$$w0rD');
        $stmt = $this->dbcon->query(
            "SELECT username,passwd FROM User WHERE 
            username='$username' AND passwd='$password'"
        );
        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }
    /**
     * Get user data for edit-profile
     *
     * @param string $username The session username $_SESSION['uname']
     *
     * @return mixed
     */
    public function getUserData($username)
    {
        try {
            $stmt = $this->dbcon->prepare(
                "SELECT * FROM User WHERE username='$username'"
            );
            $stmt->execute();
            $stmt = $stmt->fetch(\PDO::FETCH_ASSOC);
            //var_dump($stmt);
            return $stmt;
        } catch (\Error $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * User model function to update user details
     *
     * @param string $username Username
     * @param string $name     Name
     * @param string $email    email id
     * @param string $password password
     * @param string $phone    phone
     * @param string $gender   enum
     *
     * @return mixed
     */
    public function updateUserDetails(
        $username,
        $name,
        $email,
        $password,
        $phone,
        $gender
    ) {
        $password = crypt($password, 'p@$$w0rD');
        try {
            $stmt = $this->validator->validateUserData(
                $username,
                $name,
                $email,
                $password,
                $phone
            );
            $stmt = $this->dbcon->prepare(
                "UPDATE `User` SET 
                `fullName` = '$name',
                `passwd` = '$password',
                `email` = '$email',
                `phone` = '$phone',
                `gender` = '$gender'
                 WHERE `User`.`username` = '$username'"
            );
            if ($stmt->execute()) {
                return 'ok';
            }
        } catch (\Error $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return 'update not successfull';
    }

    /**
     * Check if user exsist in database
     *
     * @param string $email User email id
     *
     * @return void
     */
    public function resetPassword($email)
    {
        try {
            $stmt = $this->dbcon->prepare(
                "SELECT * FROM User WHERE email='$email'"
            );
            $stmt->execute();
            $stmt = $stmt->fetch(\PDO::FETCH_ASSOC);
            $username = $stmt['username'];
            if ($stmt != false) {
                $password = rand() + rand();
                $plainPassword = $password;
                $password = crypt($password, 'p@$$w0rD');
                $stmt = $this->dbcon->prepare(
                    "UPDATE User 
                    SET 
                    passwd = '$password' 
                    WHERE 
                    email = '$email'"
                );
                if ($stmt->execute()) {
                    $this->mailer->IsSMTP();
                    $this->mailer->SMTPDebug = 1;
                    $this->mailer->SMTPAuth = true;
                    $this->mailer->SMTPSecure = 'ssl';
                    $this->mailer->Host = "";
                    $this->mailer->Port = 465;
                    $this->mailer->IsHTML(true);
                    $this->mailer->Username = "";
                    $this->mailer->Password = "";
                    $this->mailer->SetFrom("");
                    $this->mailer->Subject = "Password reset!";
                    $this->mailer->Body = "Hi,<br> <br> Here are your new
                    credentails to access php.dv<br> username: $username<br>
                    password:$plainPassword ";
                    $this->mailer->AddAddress($email);

                    if ($this->mailer->Send()) {
                        return true;
                    } else {
                        echo "Mailer Error: " . $this->mailer->ErrorInfo;
                        return false;
                    }
                }
            }
            return false;
        } catch (\Error $e) {
            return "THIS ERROR " . $e->getMessage();
        } catch (\Exception $e) {
            return "THIS EXCEPTION" . $e->getMessage();
        }
    }
}
