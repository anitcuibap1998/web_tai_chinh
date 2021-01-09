<?php

if (!isset($_SESSION)) {
    session_start();
}

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
                <form id="form_active_2" action="dau_tu_gold.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <h4 style="color:antiquewhite">Đầu Tư Gửi Tiền Tiết Kiệm</h4>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneGuiTien">Số Điện Thoại Tài Khoản Momo Gửi Tiền</label>
                            <input type="number" class="form-control" name="phoneGuiTien" id="phoneGuiTien" required>
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
                            <input type="text" class="form-control" name="tenNguoiGui" id="tenNguoiGui" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tenNguoiGui">Lãi Xuất Gửi:</label>
                            <input type="text" class="form-control" name="tenNguoiGui" id="tenNguoiGui" value="3%" disabled required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="qrMoMo">QR Gửi Tiền Tiết Kiệm:</label>
                            <img src="momo/momo500k.png" alt="500k momo" width="40%" id="qrMoMo">
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