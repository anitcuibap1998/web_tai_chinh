<?php
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

    <!--content-->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h2 id="tieuDeVayTien">Vay Tiền</h2>
                <?php
                if (!isset($_SESSION['username'])) { //chưa acctive 2 thì thông báo ra dòng phải active2
                ?>
                    <br>
                    <div class="col-12 container">
                        <h4 style="text-align: center !important;" class="text-md-left text-primary text-center">Đăng Nhập <a href="login.php">tại đây</a> để sử dụng dịch vụ của chúng tôi.</h4>
                    </div>
                    <?php
                }
                //get thông tin account lên
                $username = $_SESSION['username'];
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
                                        <select class="custom-select" name="mucVay" id="mucVay">
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
                                        <select class="custom-select" name="kyHanVay" id="kyHanVay" onchange="getValueSelected(this);">
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
                                        <input type="text" class="form-control" name="laiXuat" id="laiXuat" value="2% / tháng" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="img2">Tài Khoản Momo(SĐT)nhận tiền:</label>
                                        <input type="number" class="form-control" name="phoneNhanTien" id="phoneNhanTien">
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
                                if(value=="6 tháng"){
                                    laiXuat.value = "2% / tháng";
                                }else if(value=="12 tháng"){
                                    laiXuat.value = "4% / tháng";
                                }
                                else if(value=="24 tháng"){
                                    laiXuat.value = "6% / tháng";
                                }
                                else if(value=="36 tháng"){
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