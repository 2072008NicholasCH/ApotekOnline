<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
    if (isset($_SESSION['flashMessage'])) {
        echo '<div class="bg bg-success" style="text-align:center; color:white;">' . $_SESSION["flashMessage"] . '</div>';
        unset($_SESSION['flashMessage']);
    }
    ?>
    <div class="registration-form">
        <form method="post">
            <div class="form-group">
                <h3 class="text-center mb-4">Login</h3>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="email" name="txtEmail" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="txtPassword" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" name="btnLogin" class="btn btn-block create-account">Sign In</button>
            </div>
            <p>Don't have an account? <a href="?ahref=signup">Sign up here</a></p>
        </form>
        
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>