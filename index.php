<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

session_start();
include_once 'util/PDOUtil.php';
include_once 'entity/User.php';
include_once 'dao/UserDaoImpl.php';

if (!isset($_SESSION['web_user'])) {
    $_SESSION['web_user'] = false;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Nicholas CH - 2072008">
    <meta name="keywords" content="Colorlib Templates">

    <title>Apotek Online</title>

    <!-- Icons font CSS -->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">


    <link rel="stylesheet" type="text/css" href="css/datatables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3829a87171.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/functional_js.js"></script>
</head>

<body>
    <div class="container">
        <?php
        if ($_SESSION['web_user']) {
        ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                                <a class="navbar-brand fa-light">Apotek Online</a>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-brand fa-light" href="?ahref=home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-brand fa-light" href="?ahref=supplier">Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a class="navbar-brand fa-light" style="font-size:x-large;" href="?ahref=product">Product</a>
                            </li>
                        </ul>
                        <a class="btn btn-danger my-2 my-sm-0" href="?ahref=logout">Logout</a>
                    </div>
                </div>
            </nav>
        <?php
            $menu = filter_input(INPUT_GET, 'ahref');
            switch ($menu) {
                case 'home':
                    include_once 'view/view-home.php';
                    break;
                // case 'genre':
                //     include_once 'view/view-Genre.php';
                //     break;
                // case 'movie':
                //     include_once 'view/view-Movie.php';
                //     break;
                // case 'upGenre':
                //     include_once 'view/view-update-genre.php';
                //     break;
                // case 'upMovie':
                //     include_once 'view/view-update-movie.php';
                //     break;
                // case 'addMovie':
                //     include_once 'view/view-add-movie.php';
                //     break;
                case 'logout':
                    session_unset();
                    session_destroy();
                    header('location:index.php');
                    break;
                default:
                    include_once 'view/view-home.php';
            }
        } else {
            include_once 'view/view-login.php';
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

<!-- Datatable -->
<script type="text/javascript" src="js/datatables.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tableId').DataTable();
    });
</script>

</html>