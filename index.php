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
    <?php
    include("content.php");
    ?>

    <!--footer-->
    <?php
    include("footer.php");
    ?>
    <!-- Thong bao pupup -->
    <div class="tbpopup" id="tbpopup-1">
        <div class="tboverlay"></div>
        <div class="tbcontent">
            <div class="tbclose-btn" onclick="thongbaopopup()">&times;</div>
            <div style="font-size:30px;font-weight:bold">Chào Mừng Bạn Đến Với Chúng Tôi</div>
            <h4 style="color:darkorange">Nhân dịp tết đến xuân về, chúng tôi tặng bạn nhiều phần quà hấp dẫn và cơ hội vay tiền để mua sắm ngày tết siêu khủng lên đến 10 triệu VNĐ. Nhanh tay đăng ký tài khoản và vay tiền ngay nào. </h4>
        </div>
    </div>
    <!-- js thong bao popup -->
    <script>
        function thongbaopopup() {
            document.getElementById("tbpopup-1").classList.toggle("active");
        }
    </script>
    <style>
        /* Thong bao Popup  */
        .tbpopup .tboverlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .tbpopup .tbcontent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #fff;
            max-width: 800px;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
            border-radius: 20px;
            display: block;
            position: fixed;
            box-shadow: 0px 0px 10px #111;
        }

        @media (max-width: 700px) {
            .tbpopup .tbcontent {
                width: 90%;
            }
        }

        .tbpopup .tbclose-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 35px;
            height: 35px;
            color: #ff4444;
            font-size: 30px;
            font-weight: 600;
            line-height: 35px;
            text-align: center;
            border-radius: 50%;
        }

        .tbpopup.active .tboverlay {
            display: block;
        }

        .tbpopup.active .tbcontent {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }

        .tbbuttom {
            background: #00cc00;
            color: #fff
        }
    </style>
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