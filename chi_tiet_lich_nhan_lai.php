<?php
include_once("libs/db.php");
error_reporting(E_ERROR);
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['username'])) {
  header('Location:index.php');
}
if(isset($_GET['maHSDauTu'])){
    $id_ma_hs_dau_tu = $_GET['maHSDauTu'];
}else{
    header('location:index.php');
}
// kiểm tra tính hợp lệ của truy vấn là user này có hồ sơ này hay không
$idUser= $_SESSION['idUser'];
$sql ="SELECT * FROM `dau_tu_so` WHERE `id` = '$id_ma_hs_dau_tu' and `id_user` = '$idUser'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

}else{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  
</head>

<body style="background-color:#DCEBF1;">
    <div class="container" style="text-align: center;">
        <h4>Danh Sách Nhận Lãi</h4>
        <table id="example" class="display" style="width:100%">
        <thead>
                            <tr>
                                <th>Mã HS Trả Lãi</th>
                                <th>Mã HS Đầu Tư</th>
                                <th>Ngày Trả Lãi</th>
                                <th>Ngày Trả Lãi Tiếp Theo</th>
                                <th>Hình Ảnh Giao Dịch</th>
                                <th>Số Tiền Sẽ Nhận</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get danh sách user lên
                            // Câu SQL lấy danh sách user
                            $sql = "SELECT * FROM `chi_tiet_gui_lai_dau_so` where `id_dau_tu_so` = '$id_ma_hs_dau_tu'";
                            // Thực thi câu truy vấn và gán vào $result
                            $result = $conn->query($sql);

                            // Kiểm tra số lượng record trả về có lơn hơn 0
                            // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                            if ($result->num_rows > 0) {
                                // Sử dụng vòng lặp while để lặp kết quả
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th><?php echo"HSTRALAI". $row['id']; ?></th>
                                        <th><?php echo "HSDAUTU". $row['id_dau_tu_so']; ?></th>
                                        <th><?php echo $row['ngay_trai_lai']; ?></th>
                                        <th><?php echo $row['ngay_tra_lai_tiep_theo']; ?></th>
                                        <th><img src="<?php echo $row['hinh_anh_giao_dich']!="0"?$row['hinh_anh_giao_dich']:"images/404.jpg"; ?>" alt="ảnh trả lãi" width="150px" height="70px"></th>
                                        <th><?php echo  $row['so_tien_phai_gui']?></th>
                                        <th><?php

                                            if ($row['trang_thai_tra_lai'] == 0) {
                                                echo "Đang Chờ Xác Thực";
                                            } else if ($row['trang_thai_tra_lai'] == 1){
                                                echo "Đang Chờ Được Trã Lãi";
                                            }
                                            else if ($row['trang_thai_tra_lai'] == 2){
                                                echo "Đã Gửi Lãi";
                                            }

                                            ?></th>
                                        
                                        
                                    </tr>
                            <?php
                                }
                            } ?>
                        </tbody>
           
        </table>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>