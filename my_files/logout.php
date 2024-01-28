<?php
    session_start(); 

    session_unset();

    session_destroy();

    header("Location: inter1.php");
    exit();
?>
