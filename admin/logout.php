<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION["username"])){
        unset($_SESSION["username"]);
        unset($_SESSION["roleAdmin"]);
        header("Location:login.php");
    }else{
        header("Location:login.php");
    }
?>