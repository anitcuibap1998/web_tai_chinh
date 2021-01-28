<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("libs/db.php");
include("common/common.php");
// xử lý hồ sơ chuyển thành đang chờ
if(isset($_GET['dangCho'])){
    $idHS = $_GET['dangCho'];
    $sql = "UPDATE `dau_tu_so` SET `trang_thai`='0' WHERE `id` = '$idHS'";
    $result = $conn->query($sql);
    ?>
        <script>
            alert('Cập Nhật trạng thái Đang Chờ Cho Hồ Sơ Thành Công');
            window.location="dsDauTu.php";
        </script>
    <?php
}
if(isset($_GET['huy'])){
    $idHS = $_GET['huy'];
    $sql = "UPDATE `dau_tu_so` SET `trang_thai`='1' WHERE `id` = '$idHS'";
    $result = $conn->query($sql);
    ?>
        <script>
            alert('Cập Nhật trạng thái Hủy Cho Hồ Sơ Thành Công');
            window.location="dsDauTu.php";
        </script>
    <?php
}
if(isset($_GET['thanhCong'])){
    $idHS = $_GET['thanhCong'];
    $sql = "UPDATE `dau_tu_so` SET `trang_thai`='2' WHERE `id` = '$idHS'";
    $result = $conn->query($sql);
    ?>
        <script>
            alert('Cập Nhật trạng thái *Thành Công* Cho Hồ Sơ');
            window.location="dsDauTu.php";
        </script>
    <?php
}
//xử lý hồ sơ thành bị hủy 
// xử lý hồ sơ thành hs thành công
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include("sidebar.php");
        ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include("topbar.php");
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h3>Danh Sách Đầu Tư</h3>
                    <table id="tblUser" class="display">
                        <thead>
                            <tr>
                                <th>Mã HS Đầu Tư</th>
                                <th>Phone Gửi Tiền</th>
                                <th>Tên Người Gửi</th>
                                <th>Số Tiền Đầu Tư</th>
                                <th>Loại Đầu Tư</th>
                                <th>Ngày Đầu Tư</th>
                                <th>Mã User</th>
                                <th>Lãi Suất</th>
                                <th>Mã Thanh Toán</th>
                                <th>Trạng Thái</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get danh sách user lên
                            // Câu SQL lấy danh sách user
                            $sql = "SELECT * FROM `dau_tu_so`";

                            // Thực thi câu truy vấn và gán vào $result
                            $result = $conn->query($sql);

                            // Kiểm tra số lượng record trả về có lơn hơn 0
                            // Nếu lớn hơn tức là có kết quả, ngược lại sẽ không có kết quả
                            if ($result->num_rows > 0) {
                                // Sử dụng vòng lặp while để lặp kết quả
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <th><?php echo $row['id']; ?></th>
                                        <th><?php echo $row['phoneGuiTien']; ?></th>
                                        <th><?php echo $row['tenNguoiGui']; ?></th>
                                        <th><?php echo $row['so_tien_dau_tu']; ?></th>
                                        <th><?php 
                                        if($row['loai_dau_tu']==1){
                                            echo "GOLD"; 
                                        }else if($row['loai_dau_tu']==2){
                                            echo "DIAMOND";
                                        }
                                        ?></th>
                                        <th><?php echo $row['ngay_dau_tu']; ?></th>
                                        <th><?php echo $row['id_user']; ?></th>
                                        <th><?php echo $row['lai_xuat']; ?></th>
                                        <th><?php echo $row['maThanhToan']; ?></th>
                                        <th><?php

                                            if ($row['trang_thai'] == 0) {
                                                echo "Chưa Xác Thực Giao Dịch";
                                            } else if ($row['trang_thai'] == 1) {
                                                echo "Đã Hủy";
                                            }
                                            else if ($row['trang_thai'] == 2) {
                                                echo "Thành Công Đang Trả Lãi";
                                            }
                                            ?></th>
                                        <th>
                                            <button type="button" name="active2XuLy" id="active2XuLy" class="btn btn-secondary"><a class="mauChu" href="dsDauTu.php?dangCho=<?php echo $row['id']; ?>">Đang Chờ</a></button>
                                            <button type="button" name="active2XuLy" id="active2XuLy" class="btn btn-danger"><a class="mauChu"href="dsDauTu.php?huy=<?php echo $row['id']; ?>">Hủy</a></button>
                                            <button type="button" name="active2XuLy" id="active2XuLy" class="btn btn-success"><a class="mauChu" href="dsDauTu.php?thanhCong=<?php echo $row['id']; ?>">Thành Công</a></button>
                                            <button type="button" name="active2XuLy" id="active2XuLy" class="btn btn-info"><a class="mauChu" href="chi_tiet_tra_lai.php?maHSDauTu=<?php echo $row['id']; ?>">Chi Tiết Góp Lãi</a></button>
                                        </th>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- datatable.js -->

                <script>
                    $(document).ready(function() {
                        $('#tblUser').DataTable({
                            responsive: true,
                            "columnDefs": [{
                                "width": "60px",
                                "targets": 8
                            }]
                        });
                    });
                </script>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include("footer.php");
            ?>
            <!-- End of Footer -->
                   
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- Xử lý khi bạn muốn thoát khỏi trang admin  -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng rời đi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng Suất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Đăng Suất</a>
                </div>
            </div>
        </div>
    </div>
    <style>
    table{
  margin: 0 auto;
  width: 100%;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed; 
  word-wrap:break-word;
}
        td {
            word-break: break-all !important;
        }
    </style>
    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script> -->
    <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

</body>

</html>