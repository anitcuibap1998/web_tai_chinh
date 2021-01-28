<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include("common/common.php");
include_once('libs/db.php');
// bắt data từ ngoài gửi vào
if (!isset($_GET['id_tra_lai'])) {
    echo "
    <script>
        window.location='dsVayNo.php';
    </script>";
} else {
    $id_tra_lai = $_GET['id_tra_lai'];
    $id_vay_von = $_GET['id_vay_von'];
}
// xử lý nút submit
if (isset($_POST['submit'])) {
    $id_tra_lai = $_GET['id_tra_lai'];
    $id_vay_von = $_GET['id_vay_von'];
    $ngay_gui_lai_thuc_te = date("Y-m-d h:i:sa");

    // xử lý ảnh được gửi lên
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        // echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>
        alert('Ảnh Trùng Tên Hoặc Vượt Quá Giới Hạn 13MB');
        window.location='dsTraLai.php';
    </script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //update vào db 
            $sql = "UPDATE `chi_tiet_gui_lai_dau_so` SET`ngay_tra_lai_thuc_te`='$ngay_gui_lai_thuc_te',`hinh_anh_giao_dich`='$target_file',`trang_thai_tra_lai`='2' WHERE `id`='$id_tra_lai'";
            $result = $conn->query($sql);

            //lấy ra chi tiết gửi lãi cuối cùng và cộng tiếp 30 ngày vào  
            $sql = "SELECT * FROM `chi_tiet_gui_lai_dau_so` WHERE `id` = '$id_tra_lai'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            //và sau đó tạo thêm 1 hàng nữa insert vào db của lần trả lãi tiếp theo
            $idDauTuSo = $row['id_dau_tu_so']; 
            $ngayTraLai = $row['ngay_tra_lai_tiep_theo']; 
            $so_tien_phai_gui = $row['so_tien_phai_gui']; 
            $ngayTraLaiTiepTheo =  date('Y-m-d H:m', strtotime($ngayTraLai ."+30 days"));

            // insert vào db
            $sql="INSERT INTO `chi_tiet_gui_lai_dau_so`( `id_dau_tu_so`, `ngay_trai_lai`, `ngay_tra_lai_tiep_theo`,  `so_tien_phai_gui`, `trang_thai_tra_lai`) VALUES ('$idDauTuSo','$ngayTraLai','$ngayTraLaiTiepTheo','$so_tien_phai_gui','0')";
            $result = $conn->query($sql);
            // thông báo
            echo "<script>
            alert('Cập Nhật Ảnh Giao Dịch Thành Công');
            window.location='dsTraLai.php';
        </script>";
        } else {

            echo "<script>
            alert('Sự Cố Mạng Khi Tải Ảnh Lên');
            window.location='dsTraLai.php';
        </script>";
        }
    }

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
                    <h3>Chi Tiết Gửi Lãi <?php echo '<span style="color:red;">' . "Hồ Sơ Trả Lãi " . $id_tra_lai . '</span>'; ?></h3>
                    <h3>Của Hồ Sơ Đầu Tư: <?php echo '<span style="color:red;">' . "Hồ Sơ Đầu Tư " . $id_vay_von . '</span>'; ?></h3>
                    <div class="container">
                        <form action="tra_lai.php?id_tra_lai=<?php echo $id_tra_lai; ?>&id_vay_von=<?php echo $id_vay_von; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="anhChuyenKhoan">Hình Ảnh Giao Dịch</label><br>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Xác Nhận</button>
                        </form>

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