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
    //get thông tin account lên
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "not";
    $sql = "SELECT * FROM user where `user_name` = '$username'";
    // echo $sql;
    // exit();
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['user_name'];
        $_SESSION['active2'] = $row['active2'];
        $tenDayDu = $row['full_name'];
        // echo $row['active2'];
        // exit();
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
    $laiXuat = 3;
    $loaiDauTu = 1; // 1 là đầu tư gold, 2 là đầu tư kim cương 
    // Xử Lý Khi Nhấn nút submit
if (isset($_POST['submit'])) {
    $phoneGuiTien = htmlspecialchars($_POST['phoneGuiTien']);
    $mucGui = htmlspecialchars($_POST['mucGui']);
    $tenNguoiGui = htmlspecialchars($_POST['tenNguoiGui']);
    
    $maThanhToan = htmlspecialchars($_POST['maThanhToan']);

    $ngayGuiTienDauTu = date("Y-m-d h:i:sa"); // ngày gửi tiền
    $idUser = $_SESSION['idUser'];
    //insert vào db 
    $sql = "INSERT INTO `dau_tu_so`(`phoneGuiTien`, `tenNguoiGui`, `so_tien_dau_tu`, `loai_dau_tu`, `ngay_dau_tu`, `id_user`, `lai_xuat`, `maThanhToan`,`trang_thai`) VALUES ('$phoneGuiTien','$tenNguoiGui','$mucGui','$loaiDauTu','$ngayGuiTienDauTu','$idUser','$laiXuat','$maThanhToan','0')";
    // $result = $conn->query($sql);

    if ($conn->query($sql) === true) {
        $id_don_gui_tien = $conn->insert_id;
        $ngayTraLaiLanDau = date('Y-m-d H:m', strtotime("+30 days"));

        $ngayTraLaiLanTiepTheo = date('Y-m-d H:m', strtotime($ngayTraLaiLanDau ."+30 days"));

        $trangThaiGuiLai=0; // Chưa Gửi Lãi Đang Chờ Đến Ngày gửi lãi
        $tien_lai = $mucGui * (3/100);
        //insert vào bảng chi tiết trả lãi cho khách hàng
        $sql_update_tra_lai = "INSERT INTO `chi_tiet_gui_lai_dau_so`(`id_dau_tu_so`, `ngay_trai_lai`, `ngay_tra_lai_tiep_theo`,  `trang_thai_tra_lai`,`so_tien_phai_gui`) VALUES ('$id_don_gui_tien','$ngayTraLaiLanDau','$ngayTraLaiLanTiepTheo','$trangThaiGuiLai','$tien_lai')";
        if ($conn->query($sql_update_tra_lai) === true){
            ?>
            <script>
                alert("Đầu Tư Thành Công Chờ Xét Duyệt!!!");
                window.location="chi_tiet_user.php";
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Lỗi Mạng Đăng Ký Không Thành Công!!!");
            </script>
            <?php
        }
        
    } else {
        ?>
            <script>
                alert("Đầu Tư Thất Bại Do Lỗi Mạng!!!");
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
                <form id="form_active_2" action="dau_tu_gold.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <h4 style="color:antiquewhite">Đầu Tư Gửi Tiền Tiết Kiệm</h4>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneGuiTien">Số Điện Thoại Tài Khoản Momo Gửi Tiền</label>
                            <input type="number" class="form-control" name="phoneGuiTien" id="phoneGuiTien" min="0" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kyHanVay">Mức Gửi</label>
                            <select class="custom-select" name="mucGui" id="mucGui" onchange="getValueSelected(this);" required>
                                <option value="500000" selected>500.000 Vnđ</option>
                                <option value="1000000">1.000.000 Vnđ</option>
                                <option value="2000000">2.000.000 Vnđ</option>
                                <option value="5000000">5.000.000 Vnđ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tenNguoiGui">Tên Người Gửi:</label>
                            <input type="text" class="form-control" name="tenNguoiGui" id="tenNguoiGui" value="<?php echo isset($tenDayDu)? $tenDayDu:""; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="laiXuat">Lãi Suất Gửi:</label>
                            <input type="text" class="form-control" name="laiXuat" id="laiXuat" value="3% -> 15%" disabled required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="maThanhToan">Mã Thanh Toán:</label>
                            <input type="text" class="form-control" name="maThanhToan" id="maThanhToan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="qrMoMo">QR Gửi Tiền Tiết Kiệm:</label>
                            <img src="momo/momo500k.png" alt="500k momo" width="40%" id="qrMoMo" name="qrMoMo">
                        </div>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Xác Nhận Đã Gửi Tiền</button>
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
        <script>
            function getValueSelected(selectObject) {
                let value = selectObject.value;
                let qrMoMo = document.getElementById("qrMoMo");
                if (value == 500000) {
                    qrMoMo.src = "momo/momo500k.png";
                } else if (value == 1000000) {
                    qrMoMo.src = "momo/momo1tr.png";
                } else if (value == 2000000) {
                    qrMoMo.src = "momo/momo2tr.png";
                } else if (value == 5000000) {
                    qrMoMo.src = "momo/momo5tr.png";
                }
            }
        </script>
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