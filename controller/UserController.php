<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

class UserController
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDaoImpl();
    }

    public function index()
    {

        $loginSubmitted = filter_input(INPUT_POST,  'btnLogin');
        if (isset($loginSubmitted)) {
            $email = filter_input(INPUT_POST,  'txtEmail');
            $password = filter_input(INPUT_POST, 'txtPassword');
            $trimEmail = trim($email);
            $trimPass = trim($password);
            $result = $this->userDao->userLogin($trimEmail, $trimPass);
            if ($result == false) {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Invalid email or password';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            } else if ($result->getEmail() == $email) {
                $_SESSION['web_user'] = true;
                $_SESSION['web_user_full_name'] = $result->getFirstName() . " " . $result->getLastName();
                $_SESSION['role'] = $result->getRole();
                $_SESSION['email'] = $result->getEmail();
                header('location:index.php');
            }
        }
        include_once 'view/login-view.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('location:index.php');
    }

    public function signUp()
    {

        $loginSubmitted = filter_input(INPUT_POST, 'btnSignup');
        if (isset($loginSubmitted)) {
            $firstName = filter_input(INPUT_POST, 'txtFName');
            $lastName = filter_input(INPUT_POST, 'txtLName');
            $email = filter_input(INPUT_POST, 'txtEmail');
            $password = filter_input(INPUT_POST, 'txtPassword');
            $alamat = filter_input(INPUT_POST, 'txtAlamat');
            $phone = filter_input(INPUT_POST, 'txtPhone');
            $trimFName = trim($firstName);
            $trimLName = trim($lastName);
            $trimEmail = trim($email);
            $trimPass = trim($password);
            $trimAlamat = trim($alamat);
            $trimPhone = trim($phone);
            $user = new User();
            $user->setEmail($trimEmail);
            $user->setPassword($trimPass);
            $user->setFirstName($trimFName);
            $user->setLastName($trimLName);
            $user->setAlamat($trimAlamat);
            $user->setPhone($trimPhone);
            $user->setRole('user');
            $result = $this->userDao->userSignUp($user);
            if ($result) {
                if (!session_id()) {
                    session_start();
                }
                if (true) {
                    $message = '<i class="fa-solid fa-circle-check"></i> Sign up successfully. Please login again';
                    $_SESSION['flashMessage'] = "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'success',
                        position: 'top'
                    }); </script>";
                }
                header('location:index.php?ahref=login');
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Error on sign up your account';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            }
        }
        include_once 'view/signup-view.php';
    }

    public function checkEmail($email)
    {
        if (isset($email) && $email != '') {
            $user = $this->userDao->checkEmail($email);
            echo $user;
        }
    }

    public function fetchUser($userEmail)
    {
        if (isset($userEmail) && $userEmail != '') {
            $fetchUser = $this->userDao->fetchUser($userEmail);
            echo json_encode($fetchUser);
        }
    }

    public function updateProfile()
    {
        $btnSubmitted = filter_input(INPUT_POST,  'btnEdit');
        if (isset($btnSubmitted)) {
            $email = filter_input(INPUT_POST,  'txtEmail');
            $firstName = filter_input(INPUT_POST, 'txtFName');
            $lastName = filter_input(INPUT_POST, 'txtLName');
            $alamat = filter_input(INPUT_POST, 'txtAlamat');
            $phone = filter_input(INPUT_POST, 'txtPhone');
            $password = filter_input(INPUT_POST, 'txtPass');
            $trimEmail = trim($email);
            $trimFName = trim($firstName);
            $trimLName = trim($lastName);
            $trimAlamat = trim($alamat);
            $trimPhone = trim($phone);
            $user = new User();
            $user->setEmail($trimEmail);
            $user->setFirstName($trimFName);
            $user->setLastName($trimLName);
            $user->setAlamat($trimAlamat);
            $user->setPhone($trimPhone);
            $user->setPassword($password);
            $result = $this->userDao->updateProfile($user);
            if ($result == 1) {
                $message = '<i class="fa-solid fa-circle-check"></i> Profile successfully updated';
                $_SESSION['profileMessage'] = "<script> bootoast.toast({
                        message: '" . $message . "',
                        type: 'success',
                        position: 'top'
                    }); </script>";
                $_SESSION['web_user_full_name'] = $user->getFirstName() . " " . $user->getLastName();
                header("Refresh:0");
            } else {
                $message = '<i class="fa-solid fa-circle-xmark"></i> Password does not match. Profile update failed';
                echo "<script> bootoast.toast({
                    message: '" . $message . "',
                    type: 'danger',
                    position: 'top'
                }); </script>";
            }
            // if ($result) {
            //     echo '<div class="p-2 bg-danger text-white">Invalid Email or Password</div>';
            // } else if ($result->getEmail() == $email) {
            //     $_SESSION['web_user'] = true;
            //     $_SESSION['web_user_full_name'] = $result->getFirstName() . " " . $result->getLastName();
            //     $_SESSION['role'] = $result->getRole();
            //     $_SESSION['email'] = $result->getEmail();
            //     header('location:index.php');
            // }
        }
    }
}

if (isset($_POST['method']) && $_POST['method'] == "checkEmail") {
    include_once '../entity/User.php';
    include_once '../dao/UserDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new UserController();
    $test->checkEmail($_POST['email']);
}

if (isset($_POST['method']) && $_POST['method'] == "fetchUser") {
    include_once '../entity/User.php';
    include_once '../dao/UserDaoImpl.php';
    include_once '../util/PDOUtil.php';
    $test = new UserController();
    $test->fetchUser($_POST['email']);
}
