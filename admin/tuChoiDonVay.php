<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include("common/common.php");
include_once('libs/db.php');
if (isset($_POST['submit'])) {
    $lydo = $_POST['lydo'];
    $id_DonVay = $_GET['id_DonVay'];
    $trangThaiActive2=$_POST['trangThai'];
    // cập nhật trang thái của hồ sơ active 2
    $lydo = $_POST['lydo'];
    $sql="UPDATE `vay_tien` SET `trang_thai_don_vay`='$trangThaiActive2' ,`ly_do_bi_huy`='$lydo' WHERE `id` = '$id_DonVay'";

    $result = $conn->query($sql);
    

    // xong thong bao thanh cong va chuyen qua trang danh sach active 2
    echo "
    <script>
        alert('Cập Nhật Thành Công');
        window.location='dsVayNo.php';
    </script>";
    
}
else if (isset($_GET['id_DonVay'])) {
    // get chi tiet active 2  từ mã id active 2
    $id_DonVay = $_GET['id_DonVay'];
    $sql = "SELECT * FROM `vay_tien` WHERE `id` = $id_DonVay";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("head.php");
    ?>
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
                    <h3>Chi Tiết Đơn Vay <?php echo '<span style="color:red;">' . "Hồ Sơ Vay " . $id_DonVay . '</span>'; ?></h3>
                    <div class="container">
                        <form action="tuChoiDonVay.php?id_DonVay=<?php echo $id_DonVay;?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="lydo">Lý Do Bị Hủy</label><br>
                                    <input type="text" class="form-control" name="lydo" id="lydo" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Trạng Thái</label>
                                    <select id="inputState" name="trangThai" class="form-control" style="max-width: 350px;">
                                        <?php
                                        if ($row['trang_thai_don_vay'] == -99) {
                                            echo '<option value="-99" selected>Chưa Đóng 250k Phí Hồ Sơ</option>';
                                        } else {
                                            echo '<option value="-99">Chưa Đóng 250k Phí Hồ Sơ</option>';
                                        }
                                        ?>
                                        <?php
                                        if ($row['trang_thai_don_vay'] == 0) {
                                            echo '<option value="0" selected>Đang Chờ Xác Nhận</option>';
                                        } else {
                                            echo '<option value="0">Đang Chờ Xác Nhận</option>';
                                        }
                                        ?>
                                        <?php
                                        if ($row['trang_thai_don_vay'] == 1) {
                                            echo '<option value="1" selected>Hủy</option>';
                                        } else {
                                            echo '<option value="1">Hủy</option>';
                                        }
                                        ?>
                                        <?php
                                        if ($row['trang_thai_don_vay'] == 2) {
                                            echo ' <option value="2" selected>Thành Công</option>';
                                        } else {
                                            echo ' <option value="2">Thành Công</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Xác Nhận</button>
                        </form>
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <img src="" alt="hinh1" width="300" height="200">
                            </div>
                            <div class="col-md-6">
                                <img src="" alt="hinh2" width="300" height="200">
                            </div>
                        </div> -->
                    </div>
                </div>
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
    <script src="vendor/jquery/jquery.min.js"></script>
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