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
    <div class="background">
        <h1>Halaman Home</h1>
    </div>
    <!-- Content -->
    <div class="content">
        <!-- open sidebar menu -->
        <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
            <i class="fas fa-bars"></i> <span>Menu</span>
        </a>
        <?php
        if (!isset($_SESSION['web_user']) || $_SESSION['web_user'] == false) {
        ?>
            <div class="float-right p-2">
                <a class="btn btn-primary" href="?ahref=login">Login</a>
                <a class="btn btn-success" href="?ahref=signup">Sign Up</a>
            </div>
        <?php
        } else {
            echo 'Login Success';
        }
        ?>
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