<?php
error_reporting(E_ERROR);
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once("libs/db.php");
if (!isset($_SESSION)) {
    session_start();
}
// nếu chưa active 2 thì chuyển về trang chủ 
if (!isset($_SESSION['username'])) {
?>
    <script>
        alert("Bạn Chưa Đăng Nhập!!!");
        window.location = "login.php";
    </script>
    <?php
} else {
    $idUser = $_SESSION['idUser'];
    //kiểm tra đã đóng lãi được chấp nhận hay chưa 
    $sql1 = "SELECT * FROM `phi_tao_ho_so` WHERE `id_user`= '$idUser' and (`trang_thai` = 2 or `trang_thai` = 0) ORDER BY id DESC LIMIT 1";
    // echo $sql1;
    // exit();
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {// nếu có thì không cho vào chuyển về trang chủ
        ?>
            <script>
            alert("Bạn Đã Đóng Phí Hồ Sơ Rồi!!!");
            window.location = "chi_tiet_user.php";
            </script>
        <?php
    }

    $idUser = $_SESSION['idUser'];
    $sql1 = "SELECT * FROM `vay_tien` WHERE `id_user`= '$idUser' ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idVayNo = $row['id'];
        $maHoSoVay = "HSVAY" . $row['id'];
    }
    //get thông tin account lên
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "not";
    $sql = "SELECT * FROM user where `user_name` = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['user_name'];
        $_SESSION['active2'] = $row['active2'];
        $tenDayDu = $row['full_name'];
        // $uer_id = $row['id'];

        if ($row['active2'] == 0) { //chưa acctive 2 thì thông báo ra dòng phải active2
    ?>
            <script>
                alert("Tài Khoản Của Bạn Chưa Xác Thực Bước 2, Hãy Xác Thực Để Sử Dụng Dịch Vụ Của Chúng Tôi!!!");
                window.location = "xac_thuc_cap_2.php";
            </script>
        <?php
        } else if ($row['active2'] == 1) { //chưa acctive 2 thì thông báo ra dòng phải active2
        ?>
            <script>
                alert("Tài Khoản Của Bạn Đang Chờ Xác Thực Bước 2 !!!");
                window.location = "index.php";
            </script>
        <?php
        } else if ($row['active2'] == 2) { //chưa acctive 2 thì thông báo ra dòng phải active2
        ?>
            <script>
                alert("Tài Khoản Của Bạn Bị Hủy Xác Thực Bước 2, Hãy Xác Thực Lại Để Sử Dụng Dịch Vụ Của Chúng Tôi!!!");
                window.location = "xac_thuc_cap_2.php";
            </script>
        <?php
        }
    }
}
// $laiXuat = 3;
// $loaiDauTu = 1; // 1 là đầu tư gold, 2 là đầu tư kim cương 
// Xử Lý Khi Nhấn nút submit
if (isset($_POST['submit'])) {
    $phoneGuiTien = htmlspecialchars($_POST['phoneGuiTien']);
    // $mucGui = htmlspecialchars($_POST['mucGui']);
    $tenNguoiGui = htmlspecialchars($_POST['tenNguoiGui']);

    $maThanhToan = htmlspecialchars($_POST['maThanhToan']);

    $ngayDong250k = date('Y-m-d H:m'); //ngay dong phí 250k

    //thêm vào bảng đóng 250k
    $sql_dong250k = "INSERT INTO `phi_tao_ho_so`( `id_vay_tien`, `ngay_dong_250k`, `ma_giao_dich`,`phoneDongTien`, `trang_thai`,`id_user`) VALUES ('$idVayNo','$ngayDong250k','$maThanhToan','$phoneGuiTien','0','$idUser')";
    // $result = $conn->query($sql_dong250k);
    if ($conn->query($sql_dong250k) === true) {
        //update trạng thái cho đơn vay là đã đóng và đang chờ Duyệt là trang_thai = 0
        $sql_update = "UPDATE `vay_tien` SET `trang_thai_don_vay`= 0 WHERE `id` = '$idVayNo'";
        $conn->query($sql_update);
        ?>
        <script>
            alert("Đóng Phí Thành Công Chờ Xét Duyệt!!!");
            window.location="chi_tiet_user.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Lỗi Mạng Đóng Phí Không Thành Công, Mời Bạn Làm Lại!!!");
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="vn">

<head>
    <?php
    include("head.php");
    ?>
</head>

<body>

    <!--header-->
    <?php
    include("header.php");
    ?>

    <!--content-->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <form id="form_active_2" action="dong_250k.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <h4 style="color:antiquewhite">Nộp Phí Tạo Hồ Sơ <?php echo ($maHoSoVay != "" ? $maHoSoVay : "Rỗng"); ?></h4>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneGuiTien">Số Điện Thoại Tài Khoản Momo Gửi Tiền</label>
                            <input type="number" class="form-control" name="phoneGuiTien" id="phoneGuiTien" min="0" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tenNguoiGui">Tên Người Gửi:</label>
                            <input type="text" class="form-control" name="tenNguoiGui" id="tenNguoiGui" value="<?php echo isset($tenDayDu) ? $tenDayDu : ""; ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="maThanhToan">Mã Thanh Toán:</label>
                            <input type="text" class="form-control" name="maThanhToan" id="maThanhToan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="qrMoMo">QR Gửi Tiền Tiết Kiệm:</label>
                            <img src="momo/momo250k.png" alt="500k momo" width="40%" id="qrMoMo" name="qrMoMo">
                        </div>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Xác Nhận Đã Nộp Phí</button>
                </form>
            </div>
        </div>
        <style>
            #form_active_2 {
                max-width: 80%;
                text-align: center;
            }

            .form-group {
                text-align: left;
            }

            #form_active_2 .form-group label {
                color: whitesmoke;
            }
        </style>

    </section>
    <!--end content-->

    <!--footer-->
    <?php
    include("footer.php");
    ?>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>