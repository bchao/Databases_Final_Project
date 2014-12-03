<?php 
    require("config.php"); 
    unset($_SESSION['Person']);
    header("Location: index.php"); 
    die("Redirecting to: index.php");
?>