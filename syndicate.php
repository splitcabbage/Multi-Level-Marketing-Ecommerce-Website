<?php
    session_start();
    $_SESSION['paid'] = true;

    echo '<script>window.location.assign("checkout.php");</script>';
?>