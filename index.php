<?php

/**
 * @author Nicholas CH 2072008
 * @author Juan Sterling 2072009
 * @author Kevin Laurence 2072030
 */

session_start();
include_once 'util/PDOUtil.php';

include_once 'entity/User.php';
include_once 'entity/Obat.php';
include_once 'entity/Obat_has_Penjualan.php';
include_once 'entity/Penjualan.php';
include_once 'entity/Supplier.php';
include_once 'entity/Transaksi.php';
include_once 'entity/Obat.php';

include_once 'dao/UserDaoImpl.php';

include_once 'controller/UserController.php';

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

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="assetsmenu/css/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="assetsmenu/css/animate.css">
  <link rel="stylesheet" href="assetsmenu/css/style.css">
  <link rel="stylesheet" href="assetsmenu/css/media-queries.css">

  <!-- Favicon and touch icons -->
  <link rel="shortcut icon" href="assetsmenu/ico/favicon.png">

  <!-- Javascript -->
  <script src="assetsmenu/js/jquery-3.3.1.min.js"></script>
  <script src="assetsmenu/js/jquery-migrate-3.0.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="assetsmenu/js/jquery.backstretch.min.js"></script>
  <script src="assetsmenu/js/wow.min.js"></script>
  <script src="assetsmenu/js/jquery.waypoints.min.js"></script>
  <script src="assetsmenu/js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="assetsmenu/js/scripts.js"></script>

</head>

<body>
  <?php
  if ($_SESSION['web_user']) {
    ob_start();
  ?>

    <!-- Wrapper -->
    <div class="wrapper">

      <!-- Sidebar -->
      <nav class="sidebar">

        <!-- close sidebar menu -->
        <div class="dismiss">
          <i class="fas fa-arrow-left"></i>
        </div>

        <div class="to-top">
          <a href="index.php" style="color:white;">Apotek Online</a>
        </div>

        <ul class="list-unstyled menu-elements">
          <li>
            <a class="scroll-link" href="#top-content"><i class="fas fa-home"></i> Home</a>
          </li>
          <li>
            <a class="scroll-link" href="#section-2"><i class="fas fa-user"></i> Supplier</a>
          </li>
          <li>
            <a class="scroll-link" href="#section-5"><i class="fas fa-pencil-alt"></i> Portfolio</a>
          </li>
          <li>
            <a class="scroll-link" href="#section-6"><i class="fas fa-envelope"></i> Contact us</a>
          </li>
        </ul>

        <div class="sign-out">
          <a class="btn btn-danger w-75" role="button" onclick="logOut()">Sign out</a>
          <script>
            function logOut() {
              const confirm = window.confirm("Are you sure want to sign out?");
              if (confirm) {
                window.location = "index.php?ahref=logout";
              }
            }
          </script>
        </div>

      </nav>
      <!-- End sidebar -->

      <!-- Dark overlay -->
      <div class="overlay"></div>

      <!-- Content -->
      <div class="content">

        <!-- open sidebar menu -->
        <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
          <i class="fas fa-bars"></i> <span>Menu</span>
        </a>

        <!-- Top content -->
        <!-- <div class="top-content section-container" id="top-content">
          <div class="container">
            <div class="row">
              <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <h1 class="wow fadeIn">Bootstrap 4 Template with <strong>Sidebar Menu</strong></h1>
                <div class="description wow fadeInLeft">
                  <p>
                    A template with Sidebar Menu made with the Bootstrap 4 framework. Download the template or learn how to create it, step by step, on
                    <a href="https://azmind.com"><strong>AZMIND</strong></a>.
                  </p>
                </div>
                <div class="buttons wow fadeInUp">
                  <a class="btn btn-primary btn-customized scroll-link" href="#section-1" role="button">
                    <i class="fas fa-book-open"></i> Learn More
                  </a>
                  <a class="btn btn-primary btn-customized-2 scroll-link" href="#section-3" role="button">
                    <i class="fas fa-pencil-alt"></i> Our Projects
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div> -->

      </div>
      <!-- End content -->

    </div>
    <!-- End wrapper -->



  <?php
    $menu = filter_input(INPUT_GET, 'ahref');
    switch ($menu) {
      case 'home':
        include_once 'view/home-view.php';
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
        include_once 'view/home-view.php';
    }
  } else {
    $userController = new UserController();
    $userController->index();
  }
  ?>
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

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</html>