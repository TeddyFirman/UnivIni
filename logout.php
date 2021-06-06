<?php
    session_start();
    //logout
    $_SESSION=[];
    session_destroy();
    session_unset();
    // arahkan ke halaman index.php
    header("location: index.php");
?>