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
include_once 'entity/ObatHasPenjualan.php';
include_once 'entity/Penjualan.php';
include_once 'entity/Supplier.php';
include_once 'entity/Keranjang.php';

include_once 'dao/UserDaoImpl.php';
include_once 'dao/SupplierDaoImpl.php';
include_once 'dao/ObatDaoImpl.php';
include_once 'dao/KeranjangDaoImpl.php';
include_once 'dao/PenjualanDaoImpl.php';
include_once 'dao/ObatHasPenjualanDaoImpl.php';

include_once 'controller/UserController.php';
include_once 'controller/SupplierController.php';
include_once 'controller/ObatController.php';
include_once 'controller/KeranjangController.php';
include_once 'controller/PenjualanController.php';
include_once 'controller/ObatHasPenjualanController.php';

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

        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == "admin" && $_SESSION['web_user']) {
          echo '<li>
          <a class="scroll-link" href="?ahref=penjualan"><i class="fa-solid fa-envelope-open-text"></i> Penjualan</a>
        </li>';
        }

        if (isset($_SESSION['role']) && $_SESSION['web_user']) {
          echo '<li>
          <a class="scroll-link" href="?ahref=history"><i class="fa-solid fa-capsules"></i> Riwayat Pesanan</a>
        </li>';
        } else {
          echo '<li>
          <a class="scroll-link" href="?ahref=login"><i class="fa-solid fa-capsules"></i> Riwayat Pesanan</a>
        </li>';
        }
        ?>

      </ul>

      <?php
      if (isset($_SESSION['profileMessage'])) {
        echo $_SESSION['profileMessage'];
        unset($_SESSION['profileMessage']);
      }
      ?>

    </nav>
    <!-- End sidebar -->

    <!-- Content -->
    <div class="content">
      <!-- open sidebar menu -->
      <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
        <i class="fas fa-bars"></i> <span>Menu</span>
      </a>

    </div>
    <!-- End content -->
    <?php
    if (isset($_SESSION['web_user']) && $_SESSION['web_user']) {
    ?>
      <div class="d-flex align-items-center justify-content-end" style="position:fixed; z-index:200; right:3rem; top:30px;"><a data-toggle="dropdown" href="" style="text-decoration:none; color: inherit;"><i class="fa-solid fa-circle-user fa-3x"></i></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="text-align:center; padding:20px; margin-right:25px;">
          <?php
          echo '<i class="fa-solid fa-circle-user fa-5x"></i>';
          echo '<li>' . $_SESSION['web_user_full_name'] . '</li>';
          echo '<li>' . $_SESSION['email'] . '</li>';
          echo '<button id="editProfile" onclick="viewProfile(\'' . $_SESSION['email'] . '\')" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>';
          echo '<button class="btn btn-danger mt-2" data-toggle="modal" data-target="#signOutModal">Sign Out</button>';
          ?>
        </ul>
      </div>

      <!-- Edit Profile Modal -->
      <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post">
                <div class="form-group">
                  <blockquote class="blockquote">
                    <p>Email</p>
                  </blockquote>
                  <input type="text" class="form-control" name="txtEmail" placeholder="Email" readonly id="profileEmail">
                </div>
                <div class="form-group">
                  <blockquote class="blockquote">
                    <p>First Name</p>
                  </blockquote>
                  <input type="text" class="form-control" name="txtFName" placeholder="First Name" autofocus required id="profileFName">
                </div>
                <div class="form-group">
                  <blockquote class="blockquote">
                    <p>Last Name</p>
                  </blockquote>
                  <input type="text" class="form-control" name="txtLName" placeholder="Last Name" required id="profileLName">
                </div>
                <div class="form-group">
                  <blockquote class="blockquote">
                    <p>Alamat</p>
                  </blockquote>
                  <textarea class="form-control item" name="txtAlamat" placeholder="Alamat" required id="profileAlamat"></textarea>
                </div>
                <div class="form-group">
                  <blockquote class="blockquote">
                    <p>No. Telp</p>
                  </blockquote>
                  <input type="text" class="form-control" name="txtPhone" placeholder="No. Telp" required id="profilePhone">
                </div>
                <div class="form-group">
                  <blockquote class="blockquote">
                    <p>Confirm Password</p>
                  </blockquote>
                  <input type="password" class="form-control" name="txtPass" placeholder="Confirm Password" required id="profilePassword">
                  <input type="checkbox" id="showPassword"><span style="color:black;"> Show Password</span>
                </div>
            </div>
            <div class="modal-footer">
              <input type="submit" value="Edit Profile" class="btn btn-primary my-2" name="btnEdit" id="btnEdit">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Sign Out Modal -->
      <div class="modal fade" id="signOutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Sign out confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <span style="color:black;">Are you sure want to sign out?</span>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="logOut()" class="btn btn-primary">Sign out</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        function logOut() {
          window.location = "index.php?ahref=logout";
        }
      </script>
    <?php
    }
    ?>
  </div>
  <!-- End wrapper -->
  <script>
    $('#showPassword').click(function() {
      var type = $('#profilePassword').attr("type");
      if (type === 'password') {
        $('#profilePassword').attr("type", "text");
      } else {
        $('#profilePassword').attr("type", "password");
      }
    })

    $(document).on('click', '.dropdown-menu', function(e) {
      e.stopPropagation();
    });
    $('#editProfile').click(function() {
      $('.dropdown-menu').attr('class', 'dropdown-menu');
    })

    function viewProfile(email) {
      $.ajax({
        url: 'controller/UserController.php',
        type: 'post',
        data: {
          method: "fetchUser",
          email: email
        },
        success: function(responsedata) {
          var response = $.parseJSON(responsedata);
          console.log(response.alamat);
          $('#profileEmail').val(response.email);
          $('#profileFName').val(response.first_name);
          $('#profileLName').val(response.last_name);
          $("textarea#profileAlamat").val(response.alamat);
          $('#profilePhone').val(response.phone);
        }
      })
    }
  </script>
  <?php
  $_SESSION['message'] = "";
  // if ($_SESSION['web_user']) {
  //   ob_start();
  $userController = new UserController();
  $userController->updateProfile();
  $menu = filter_input(INPUT_GET, 'ahref');
  switch ($menu) {
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
      $keranjangController = new KeranjangController();
      $obatController->index();
      $obatController->updateObat();
      $keranjangController->index();
      break;
    case 'penjualan':
      $penjualanController = new PenjualanController();
      $penjualanController->fetchPenjualan();
      break;
    case 'history':
      $penjualanController = new PenjualanController();
      $penjualanController->fetchPenjualanUser($_SESSION['email']);
      break;
    case 'checkout':
      $keranjangController = new KeranjangController();
      $penjualanController = new PenjualanController();
      $keranjangController->keranjangCheckout($_SESSION['email']);
      $penjualanController->index();
      break;
    case 'logout':
      $userController = new UserController();
      $userController->logout();
      break;
    case 'logout':
      $userController = new UserController();
      $userController->logout();
      break;
    default:
      $obatController = new ObatController();
      $keranjangController = new KeranjangController();
      $obatController->index();
      $obatController->updateObat();
      $keranjangController->index();
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