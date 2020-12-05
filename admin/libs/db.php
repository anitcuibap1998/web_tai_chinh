<?php
	$host='localhost';
	$user='root';
	$pass='';
	$db='web_tu_doi_2';
	//error_reporting(0);//Chan thong bao loi

	$conn=mysqli_connect($host,$user,$pass,$db) or die('Lỗi kết nối');
	//Dong bo charset (collation)
	mysqli_query($conn,'set names utf8');
?>
