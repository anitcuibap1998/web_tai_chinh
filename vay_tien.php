<?php
error_reporting(E_ERROR);
if (!isset($_SESSION)) {
    session_start();
}
include_once("libs/db.php");
?>
<!DOCTYPE html>
<html lang="en">

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
    <?php
    // xử lý khi đã đăng ký vay (lấy ra hợp đồng vay cuôi cùng của người đó)
    $id_user = $_SESSION['idUser'];
    $sql = "SELECT max(id) as idcuoicung , vt.`trang_thai_don_vay` FROM `vay_tien` as vt where vt.`id_user` = '$id_user'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['trang_thai_don_vay'] == -99) {
    ?>
            <script>
                alert("Hồ Sơ Của Bạn Đang Chờ Duyệt ,Bạn cần đóng 250 ngàn phí tạo hồ sơ !!!");
                window.location = "chi_tiet_user.php";
            </script>
        <?php
        }
        if ($row['trang_thai_don_vay'] == 1 || $row['trang_thai_don_vay'] == 3) {
        ?>
            <script>
                alert("Hồ Sơ Đang Chờ Duyệt, Hoặc Đang Trong Giai Đoạn Đóng Lãi Nên Không Thể Vay Thêm Nữa Hoặc Bạn Chưa Đóng 250 ngàn Tiền Phí Hồ Sơ !!!");
                window.location = "index.php";
            </script>
            <?php

        }
    }


    // xử lý khi nhấn nút submit đang ký form
    if (isset($_POST['submit'])) {
        $mucVay = htmlspecialchars($_POST['mucVay']);
        $kyHanVay = htmlspecialchars($_POST['kyHanVay']);
        $laiXuat = htmlspecialchars($_POST['laiXuat']);
        $phoneNhanTien = htmlspecialchars($_POST['phoneNhanTien']);
        $date = date('Y-m-d');
        $sql = "INSERT INTO `vay_tien`(`id_user`, `muc_vay`, `ky_han_vay`, `phone_momo`, `trang_thai_don_vay`, `ngay_vay_no`,`laixuat`) VALUES ('$id_user','$mucVay','$kyHanVay','$phoneNhanTien','-99','$date','$laiXuat')";
        // $result = $conn->query($sql);
        if ($conn->query($sql) === true) {
            ?>
            <script>
                alert("Đăng ký Vay Tiền Thành Công Bạn Hãy Nộp Phí 250 ngàn phí tạo hồ sơ và Chờ Đợi Xét Duyệt!!!");
                window.location = "chi_tiet_user.php";
            </script>
        <?php
        }
    }

    ?>
    <!--content-->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h2 id="tieuDeVayTien">Vay Tiền</h2>
                <?php
                if (!isset($_SESSION['username'])) { //chưa dang nhap thì thông báo ra dòng phải dang nhap
                ?>
                    <br>
                    <div class="col-12 container">
                        <h4 style="text-align: center !important;" class="text-md-left text-primary text-center">Đăng Nhập <a href="login.php">tại đây</a> để sử dụng dịch vụ của chúng tôi.</h4>
                    </div>
                    <?php
                }
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
                    // echo $row['active2'];
                    // exit();
                    if ($row['active2'] == 0) { //chưa acctive 2 thì thông báo ra dòng phải active2
                    ?>
                        <br>
                        <div class="col-12 container">
                            <h4 style="text-align: center !important;" class="text-md-left text-primary text-center">Tài Khoản của bạn chưa xác thực bước 2. Hãy xác thực <a href="xac_thuc_cap_2.php">tại đây</a> để sử dụng dịch vụ của chúng tôi.</h4>
                        </div>
                    <?php
                    } else if ($row['active2'] == 1) { //chưa acctive 2 thì thông báo ra dòng phải active2
                    ?>
                        <br>
                        <div class="col-12 container">
                            <h4 style="text-align: center !important;" class="text-md-left text-primary text-center">Tài Khoản của bạn đang chờ xác thực bước 2. Vui lòng chờ đợi !!!</h4>
                        </div>
                    <?php
                    } else if ($row['active2'] == 2) { //bị hủy acctive 2 thì thông báo ra dòng phải active2
                    ?>
                        <br>
                        <div class="col-12 container">
                            <h4 style="text-align: center !important;" class="text-md-left text-primary text-center">Tài Khoản của bạn bị hủy xác thực bước 2. Hãy xác thực lại <a href="xac_thuc_cap_2.php">tại đây</a> để sử dụng dịch vụ của chúng tôi.</h4>
                        </div>
                    <?php
                    } else if ($row['active2'] == 3) {
                    ?>
                        <script>
                            $("#tieuDeVayTien").hide();
                        </script>
                        <div class="caption">
                            <form id="form_active_2" action="vay_tien.php" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-12 text-center">
                                        <h4 style="color:antiquewhite">Form Vay Tiền</h4>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="mucVay">Mức Vay</label>
                                        <select class="custom-select" name="mucVay" id="mucVay" required>
                                            <option value="1" selected>1.000.000 VNĐ</option>
                                            <option value="2">2.000.000 VNĐ</option>
                                            <option value="3">3.000.000 VNĐ</option>
                                            <option value="4">4.000.000 VNĐ</option>
                                            <option value="5">5.000.000 VNĐ</option>
                                            <option value="6">6.000.000 VNĐ</option>
                                            <option value="7">7.000.000 VNĐ</option>
                                            <option value="8">8.000.000 VNĐ</option>
                                            <option value="9">9.000.000 VNĐ</option>
                                            <option value="10">10.000.000 VNĐ</option>
                                            <option value="15">15.000.000 VNĐ</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kyHanVay">Gói Kỳ Hạn</label>
                                        <select class="custom-select" name="kyHanVay" id="kyHanVay" onchange="getValueSelected(this);" required>
                                            <option value="6 tháng" selected>6 tháng</option>
                                            <option value="12 tháng">12 tháng</option>
                                            <option value="24 tháng">24 tháng</option>
                                            <option value="36 tháng">36 tháng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="img1">Lãi Suất Mỗi tháng</label>
                                        <input type="text" class="form-control" name="laiXuat" id="laiXuat" value="2% / tháng" readonly required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="img2">Tài Khoản Momo(SĐT)nhận tiền:</label>
                                        <input type="number" class="form-control" name="phoneNhanTien" id="phoneNhanTien" required>
                                    </div>
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Đăng Ký Vay Tiền</button>
                            </form>

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
                                let laiXuat = document.getElementById("laiXuat");
                                if (value == "6 tháng") {
                                    laiXuat.value = "2% / tháng";
                                } else if (value == "12 tháng") {
                                    laiXuat.value = "4% / tháng";
                                } else if (value == "24 tháng") {
                                    laiXuat.value = "6% / tháng";
                                } else if (value == "36 tháng") {
                                    laiXuat.value = "8% / tháng";
                                }
                            }
                        </script>
                <?php
                    }
                }
                ?>
            </div>
        </div>
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
    <!-- <script src="assets/js/custom.js"></script> -->
</body>

</html>