<?php
if (!isset($_SESSION['web_user']) || $_SESSION['web_user'] == false) {
?>
    <div class="float-right p-2">
        <a class="btn btn-primary" href="?ahref=login">Login</a>
        <a class="btn btn-success" href="?ahref=signup">Sign Up</a>
    </div>
<?php
} else {
    echo '';
}
?>