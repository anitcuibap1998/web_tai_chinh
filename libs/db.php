<?php
	error_reporting(E_ERROR);
	$host='localhost';
	$user='root';
	$pass='';
	$db='ho_tro_tai_chinh';
	//error_reporting(0);//Chan thong bao loi

	$conn=mysqli_connect($host,$user,$pass,$db) or die('Lỗi kết nối');
	//Dong bo charset (collation)
	mysqli_query($conn,'set names utf8');
?>
