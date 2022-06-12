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
    if (isset($_SESSION['loginMessage'])) {
        unset($_SESSION['loginMessage']);
    }
    ?>
    <script>
        $(document).ready(function() {
            document.querySelector('title').textContent = "Sign Up | Apotek Online";
        })
    </script>
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
                <input type="email" class="form-control item" id="email" name="txtEmail" placeholder="Email" required>
                <span id='emailMessage'></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="txtPassword" placeholder="Password" required onchange='check_pass();'>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="confirmPass" name="txtConfirmPass" placeholder="Confirm Password" required onchange='check_pass();'>
                <input type="checkbox" id="showPassword"><span style="color:black;"> Show Password</span><br>
                <span id='message'></span>
            </div>
            <div class="form-group">
                <textarea class="form-control item" id="alamat" name="txtAlamat" placeholder="Alamat" required></textarea>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" id="phone" name="txtPhone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <button type="submit" id="btnSignup" name="btnSignup" class="btn btn-block create-account">Sign Up</button>
            </div>
            <p>Already have an account? <a href="?ahref=login">Login here</a></p>
        </form>
    </div>
    <script>
        function check_pass() {
            if (document.getElementById('password').value ==
                document.getElementById('confirmPass').value) {
                document.getElementById('btnSignup').disabled = false;
                document.getElementById('message').innerHTML = '<i class="fa-solid fa-check"></i> Password Match';
                document.getElementById('message').style.color = 'green';
            } else {
                document.getElementById('btnSignup').disabled = true;
                document.getElementById('message').innerHTML = '<i class="fa-solid fa-xmark"></i> Password Not Match';
                document.getElementById('message').style.color = 'red';
            }
        }
        $('#showPassword').click(function() {
            var type = $('#password').attr("type");
            if (type === 'password') {
                $('#password').attr("type", "text");
                $('#confirmPass').attr("type", "text");
            } else {
                $('#password').attr("type", "password");
                $('#confirmPass').attr("type", "password");
            }
        })

        $('#email').on('keyup', function() {
            $.ajax({
                url: 'controller/UserController.php',
                type: 'post',
                data: {
                    method: "checkEmail",
                    email: $('#email').val()
                },
                success: function(responsedata) {
                    if (responsedata == 1) {
                        document.getElementById('btnSignup').disabled = true;
                        document.getElementById('emailMessage').innerHTML = '<i class="fa-solid fa-xmark"></i> Email has already been used';
                        document.getElementById('emailMessage').style.color = 'red';
                    } else {
                        document.getElementById('btnSignup').disabled = false;
                        document.getElementById('emailMessage').innerHTML = '';
                    }
                }
            })
        })
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>