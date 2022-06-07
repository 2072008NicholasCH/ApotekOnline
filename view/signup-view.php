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
    <div class="registration-form">
        <form method="post">
            <div class="form-group">
                <h3 class="text-center mb-4">Sign Up</h3>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="firstName" name="txtFName" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="lastName" name="txtLName" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="email" name="txtEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="txtPassword" placeholder="Password" required onchange='check_pass();'>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="confirmPass" name="txtConfirmPass" placeholder="Confirm Password" required onchange='check_pass();'>
                <span id='message'></span>
            </div>
            <div class="form-group">
            <input type="tel" class="form-control item" id="phone" name="txtPhone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <button type="submit" id="btnSignup" name="btnSignup" class="btn btn-block create-account">Sign Up</button>
            </div>
        </form>
    </div>
    <script>
        function check_pass() {
            if (document.getElementById('password').value ==
                document.getElementById('confirmPass').value) {
                document.getElementById('btnSignup').disabled = false;
                document.getElementById('message').innerHTML = 'Password Match';
                document.getElementById('message').style.color = 'green';
            } else {
                document.getElementById('btnSignup').disabled = true;
                document.getElementById('message').innerHTML = 'Password Not Match';
                document.getElementById('message').style.color = 'red';
            }
        }
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>