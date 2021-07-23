<?php
session_start();
require('php-includes/connect.php');


    $_SESSION['id'] = session_id();
    $_SESSION['login_type'] = "selfRegistration";

    echo '<script>window.location.assign("checkout.php");</script>';
?>
