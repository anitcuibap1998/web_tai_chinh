<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("libs/db.php");
include("common/common.php");

if(isset($_GET['id'])){
    $id_vay_tien = $_GET['id_vay_tien'];
    $id_Vay250k = $_GET['id'];
    $trangthai = $_GET['trang_thai'];
    //update vào db 
    if($trangthai==1){
        // upadate vào bảng 250k  = 1 và update vào bảng vay là -99
        $sql="UPDATE `phi_tao_ho_so` SET `trang_thai`= '1' WHERE `id` = '$id_Vay250k'";
        $result = $conn->query($sql);
        $sql1="UPDATE `vay_tien` SET `trang_thai_don_vay`= '-99',`ly_do_bi_huy` = '0' WHERE `id` = '$id_vay_tien'";
        $result = $conn->query($sql1);
        echo "
        <script>
            alert('Cập Nhật Thành Công');
            window.location='dsDong250k.php';
        </script>";
    }else if($trangthai==2){
        // upadate vào bảng 250k  = 2 và update vào bảng 0
        $sql="UPDATE `phi_tao_ho_so` SET `trang_thai`= '2' WHERE `id` = '$id_Vay250k'";
        $result = $conn->query($sql);
        $sql1="UPDATE `vay_tien` SET `trang_thai_don_vay`= '0',`ly_do_bi_huy` = '0' WHERE `id` = '$id_vay_tien'";
        $result = $conn->query($sql1);
        echo "
        <script>
            alert('Cập Nhật Thành Công');
            window.location='dsDong250k.php';
        </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("head.php");
    ?>
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
                    <h3>Danh Sách Đóng 250k</h3>
                    <table id="tblUser" class="display">
                        <thead>
                            <tr>
                                <th>Mã Đóng 250k</th>
                                <th>Mã Hồ Sơ Vay</th>
                                <th>Ngày Đóng 250k</th>
                                <th>Mã Giao Dịch</th>
                                <th>Phone Đóng Tiền</th>
                                <th>Trạng Thái</th>
                                <th>Id User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //get danh sách user lên
                            // Câu SQL lấy danh sách user
                            $sql = "SELECT * FROM `phi_tao_ho_so` ORDER BY `id` DESC";

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
                                        <th><?php echo $row['id_vay_tien']; ?></th>
                                        <th><?php echo $row['ngay_dong_250k']; ?></th>
                                        <th><?php echo $row['ma_giao_dich']; ?></th>
                                        <th><?php echo $row['phoneDongTien']; ?></th>
                                        <th><?php

                                            if ($row['trang_thai'] == 0) {
                                                echo "Đang Chờ Xác Thực";
                                            } else if ($row['trang_thai'] == 1){
                                                echo "Bị Hủy";
                                            }
                                            else if ($row['trang_thai'] == 2){
                                                echo "Thành Công";
                                            }

                                            ?></th>
                                        <th><?php echo $row['id_user']; ?></th>
                                        <th>
                                            <button type="button"  name="active2XuLy" id="active2XuLy" class="btn btn-success btn-sm" ><a class="mauChu" href="dsDong250k.php?id=<?php echo $row['id']?>&trang_thai=2&id_vay_tien=<?php echo $row['id_vay_tien']; ?>">Thành Công</a></button>
                                            <button type="button"  name="active2XuLy" id="active2XuLy" class="btn-outline-dark btn-sm" ><a class="mauChu" href="dsDong250k.php?id=<?php echo $row['id']?>&trang_thai=1&id_vay_tien=<?php echo $row['id_vay_tien']; ?>">Thất Bại</a></button>
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
                            responsive: true
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