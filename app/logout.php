<?php
    session_start();
    if(isset( $_SESSION["USER_ID"]) && isset($_SESSION["USERNAME"])){
        session_unset();
        session_destroy();
        header("Location:../app/login.php");
        // alert message
        exit();
    }else{
        header("Location:../app/login.php");
        exit();
    }
?>