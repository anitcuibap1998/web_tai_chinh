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

<body onload="thongbaopopup()">

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
            <div class="caption" style="text-align: left !important;">
                <h6 style="color:#3b7dd8;">Hướng dẫn sử dụng trang Web</h6><br><br>
                <h6>Bước 1: Đăng ký tài khoản và xác thực gmail, hay còn gọi là xác thực bước 1.</h6><br>
                <h6>Bước 2: Sau khi xác thực bước 1 Bạn sẽ phải xác thực danh tính, Hay còn gọi là xác thực bước 2, bắt buộc trước khi vay tiền hay đầu tư người dùng phải xác thực thành công bước 2.</h6><br>
                <h6>Bước 3: Sau Khi xác thực thành công bước 2, người dùng có thể đăng ký vay tiền hoặc đầu tư lấy lãi (thường quá trình duyệt đơn là từ 30 phút đến 3 ngày tùy vào mức vay và hồ sơ cá nhân) </h6><br>
                <h6>Hồ sơ vay của quý khách sẽ được uy duyệt nhanh nhất có thể.</h6><br>
                <h6>Đối với đầu tư thì khách hàng sẽ nhận lại về mỗi tháng(có thể trễ tối đa 3 ngày do phát sinh quá nhiều giao dịch trong hệ thống)</h6><br>
                <h6>Tỷ lệ hồ sơ thành công là 90% và 10% thất bại do một số yếu tố chủ quan, người dùng có thể thử đăng ký lại.</h6>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->
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