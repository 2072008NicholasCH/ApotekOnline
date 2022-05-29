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

        $loginSubmitted = filter_input(type: INPUT_POST, var_name: 'btnLogin');
        if (isset($loginSubmitted)) {
            $email = filter_input(type: INPUT_POST, var_name: 'txtEmail');
            $password = filter_input(INPUT_POST, 'txtPassword');
            $trimEmail = trim($email);
            $trimPass = trim($password);
            $result = $this->userDao->userLogin($trimEmail, $trimPass);
            if ($result == false) {
                echo '<div class="p-2 bg-danger text-white">Invalid Email or Password</div>';
            } else if ($result->getEmail() == $email) {
                $_SESSION['web_user'] = true;
                $_SESSION['web_user_full_name'] = $result->getFirstName() . " " . $result->getLastName();
                $_SESSION['role'] = $result->getRole();
                header('location:index.php');
            }
        }
        include_once 'view/login-view.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
}