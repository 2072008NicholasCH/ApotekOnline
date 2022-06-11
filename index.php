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

include_once 'dao/UserDaoImpl.php';
include_once 'dao/SupplierDaoImpl.php';
include_once 'dao/ObatDaoImpl.php';

include_once 'controller/UserController.php';
include_once 'controller/SupplierController.php';
include_once 'controller/ObatController.php';

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Toast Notification Assets -->
  <link href="src/bootoast.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="dist/bootoast.min.js"></script>

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

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
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
          <a class="scroll-link" href="?ahref=home"><i class="fas fa-home"></i> Home</a>
        </li>
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
          echo '<li>
            <a class="scroll-link" href="?ahref=supplier"><i class="fas fa-user"></i> Supplier</a>
          </li>';
        }
        ?>
        <li>
          <a class="scroll-link" href="?ahref=obat"><i class="fa-solid fa-capsules"></i> Obat</a>
        </li>
        <li>
          <a class="scroll-link" href="#section-6"><i class="fas fa-envelope"></i> Contact us</a>
        </li>
      </ul>

      <?php
      if (isset($_SESSION['web_user']) && $_SESSION['web_user']) {
        echo '<div class="sign-out">
            <a class="btn btn-danger w-75" role="button" onclick="logOut()">Sign out</a>
            <script>
                function logOut() {
                    const confirm = window.confirm("Are you sure want to sign out?");
                    if (confirm) {
                        window.location = "index.php?ahref=logout";
                    }
                }
            </script>
        </div>';
      }
      ?>

    </nav>
    <!-- End sidebar -->
    <!-- <div class="background">
      <h1>Halaman Home</h1>
    </div> -->
    <!-- Content -->
    <div class="content">
      <!-- open sidebar menu -->
      <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
        <i class="fas fa-bars"></i> <span>Menu</span>
      </a>

    </div>
    <!-- End content -->

  </div>
  <!-- End wrapper -->

  <?php
  $_SESSION['message'] = "";
  // if ($_SESSION['web_user']) {
  //   ob_start();

  $menu = filter_input(INPUT_GET, 'ahref');
  switch ($menu) {
    case 'home':
      include_once 'view/home-view.php';
      break;
    case 'login':
      $userController = new UserController();
      $userController->index();
      break;
    case 'signup':
      $userController = new UserController();
      $userController->signUp();
      break;
    case 'supplier':
      $suppController = new SupplierController();
      $suppController->index();
      $suppController->updateSupp();
      break;
    case 'obat':
      $obatController = new ObatController();
      $obatController->index();
      break;
    case 'logout':
      $userController = new UserController();
      $userController->logout();
      break;
    default:
      include_once 'view/home-view.php';
  }
  // } else {
  //   $userController = new UserController();
  //   $userController->index();
  // }
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

</html>