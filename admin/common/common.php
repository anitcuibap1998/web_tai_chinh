<?php 
include_once("libs/db.php");
// khởi tạo session nếu chưa có 
if(!isset($_SESSION)){
    session_start();
}
// echo $_SESSION['username'];
// echo $_SESSION['roleAdmin'];
// exit();
if(!isset($_SESSION['username'])||!isset($_SESSION['roleAdmin'])){
        header('location:login.php');
}
?>