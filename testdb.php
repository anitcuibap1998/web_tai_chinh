<?php 

$ngayTraLaiLanDau = date('Y-m-d H:m', strtotime("+30 days"));

$ngayTraLaiLanTiepTheo = date('Y-m-d H:m', strtotime($ngayTraLaiLanDau ."+30 days"));

echo $ngayTraLaiLanDau;
echo '<br>';
echo $ngayTraLaiLanTiepTheo;
echo '<br>';