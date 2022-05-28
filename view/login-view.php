<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

?>

<?php
// $loginSubmitted = filter_input(type: INPUT_POST, var_name: 'btnLogin');
// if (isset($loginSubmitted)) {
//     $email = filter_input(type: INPUT_POST, var_name: 'txtEmail');
//     $password = filter_input(INPUT_POST, 'txtPassword');
//     // $result = userLogin($email, $password);
//     if ($result[0]['email'] == $email) {
//         $_SESSION['user'] = true;
//         $_SESSION['web_user_full_name'] = $result[0]['name'];
//         $_SESSION['role'] = $result[0]['role'];
//         header('location:index.php');
//     } else {
//         echo '<div class="bg-danger">Invalid ID or Password</div>';
//     }
// }
?>
<!-- <div class="container">
    <form method="post">
        <h1>Login</h1>
        <div class="form-group">
            <label for="emailId">Email</label>
            <input type="email" class="form-control" id="emailId" name="txtEmail" required autofocus>
        </div>
        <div class="form-group">
            <label for="passwordId">Password</label>
            <input type="password" class="form-control" id="passwordId" name="txtPassword" required>
        </div>
        <button type="submit" class="btn btn-primary my-2" name="btnLogin">Login</button>
    </form>
</div> -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-wrap p-5">
                    <h3 class="text-center mb-4">Login</h3>
                    <form method="post" action="" class="login-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" id="emailId" name="txtEmail" required autofocus>
                        </div>
                        <div class="form-group d-flex">
                            <input type="password" class="form-control" placeholder="Password" id="passwordId" name="txtPassword" required>
                        </div>
                        <div class="form-group row justify-content-center">
                            <button type="submit" class="btn btn-primary w-50" name="btnLogin">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div
        >
    </div>
</body>
</html>