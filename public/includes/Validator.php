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
namespace App\includes;

$data = json_decode(file_get_contents('data.json'));

/**
 * PHP version 7.2
 *
 * @category Header
 * @package  App
 * @author   hybridX <hybridx18@gmail.com>
 * @license  https://hybridX.cybzilla.com hybridx
 * @link     http://php.dv
 */
class Validator
{
    /**
     * Validate User data and throw exception if data invalid
     *
     * @param string $username Alphanumeric
     * @param string $name     Alphabets and whitespace
     * @param string $email    Standard email formats.
     * @param string $password alph, numeric and one special char from !@#$%^&*
     * @param string $phone    Indian mobile numbers
     *
     * @return void
     */
    public function validateUserData(
        $username,
        $name,
        $email,
        $password,
        $phone
    ) {
        if (!ctype_alnum($username)) {
            throw new \Exception("Username is not alphanumeric.");
            return false;
        }

        if (ctype_alpha(str_replace(' ', '', $name)) === false) {
            throw new \Exception('Name must contain letters and spaces only');
            return false;
        }

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email == null) {
            throw new \Exception('Invalid Email address');
        }

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars) {
            throw new \Exception('Weak password');
        }

        if (preg_match('/^[0-9]{10}+$/', $phone)) {
            throw new \Exception('Invalid phone number');
        }
    }
}
