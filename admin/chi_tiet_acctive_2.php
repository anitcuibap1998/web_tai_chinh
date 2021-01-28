<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include("common/common.php");
include_once('libs/db.php');
if (isset($_POST['submit'])) {
    $username= $_GET['username'];
    $id_active2 = $_GET['maHoSoActive2'];
    $trangThaiActive2=$_POST['trangThai'];
    // cập nhật trang thái của hồ sơ active 2
    $sql="UPDATE `upload_xac_thuc_2` SET `status_active`='$trangThaiActive2' WHERE `id` = '$id_active2'";
    $result = $conn->query($sql);
    // cap nhat trang thai của user  acctive 2 luon
    $sql1="UPDATE `user` SET `active2`='$trangThaiActive2' WHERE `user_name` = '$username'";
    $result = $conn->query($sql1);

    // xong thong bao thanh cong va chuyen qua trang danh sach active 2
    echo "
    <script>
        alert('Cập Nhật Thành Công');
        window.location='dsActive2.php';
    </script>";
    
}
else if (isset($_GET['active2ID'])) {
    // get chi tiet active 2  từ mã id active 2
    $idActive2 = $_GET['active2ID'];
    $sql = "SELECT ac2.id, us.user_name,ac2.hinh_chup_selfie,ac2.hinh_mat_truoc_cmnd, ac2.hinh_mat_sau_cmnd, ac2.hinh_mat_truoc_bang_lai,ac2.hinh_mat_sau_bang_lai, ac2.ho_va_ten_trong_cmnd, ac2.status_active FROM upload_xac_thuc_2 as ac2 JOIN user as us ON ac2.`id_user` = us.id WHERE ac2.id = '$idActive2'";
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
                    <h3>Chi Tiết Active2 của <?php echo '<span style="color:red;">' . "Hồ Sơ Active " . $idActive2 . '</span>'; ?></h3>
                    <div class="container">
                        <form action="chi_tiet_acctive_2.php?maHoSoActive2=<?php echo $idActive2;?>&username=<?php echo $row['user_name'];?>" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hinh1">Hình 1</label><br>
                                    <img src="<?php echo '../' . $row['hinh_chup_selfie']; ?>" alt="hinh1" width="350" height="200">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hinh2">Hình 2</label><br>
                                    <img src="<?php echo '../' . $row['hinh_mat_truoc_cmnd']; ?>" alt="hinh2" width="350" height="200">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hinh3">Hình 3</label><br>
                                    <img src="<?php echo '../' . $row['hinh_mat_sau_cmnd']; ?>" alt="hinh3" width="350" height="200">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hinh4">Hình 4</label><br>
                                    <img src="<?php echo '../' . $row['hinh_mat_truoc_bang_lai']; ?>" alt="hinh4" width="350" height="200">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="hinh5">Hình 5</label><br>
                                    <img src="<?php echo '../' . $row['hinh_mat_sau_bang_lai']; ?>" alt="hinh5" width="350" height="200">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Trạng Thái</label>
                                    <select id="inputState" name="trangThai" class="form-control" style="max-width: 350px;">
                                        <?php
                                        if ($row['status_active'] == 1) {
                                            echo '<option value="1" selected>Đang Chờ Xác Nhận</option>';
                                        } else {
                                            echo '<option value="1">Đang Chờ Xác Nhận</option>';
                                        }
                                        ?>
                                        <?php
                                        if ($row['status_active'] == 2) {
                                            echo '<option value="2" selected>Hủy</option>';
                                        } else {
                                            echo '<option value="2">Hủy</option>';
                                        }
                                        ?>
                                        <?php
                                        if ($row['status_active'] == 3) {
                                            echo ' <option value="3" selected>Thành Công</option>';
                                        } else {
                                            echo ' <option value="3">Thành Công</option>';
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