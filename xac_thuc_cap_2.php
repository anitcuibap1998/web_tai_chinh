<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once('libs/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("head.php");
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <!--header-->
    <?php
    include("header.php");
    ?>
    <?php
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $fullTen =  htmlspecialchars($_POST['fullName']);

        $target_dir = "images/";
        $target_file1 = $target_dir . basename($_FILES["img1"]["name"]);
        $target_file2 = $target_dir . basename($_FILES["img2"]["name"]);
        $target_file3 = $target_dir . basename($_FILES["img3"]["name"]);
        $target_file4 = $target_dir . basename($_FILES["img4"]["name"]);
        $target_file5 = $target_dir . basename($_FILES["img5"]["name"]);

        $uploadOk = 1;

        $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
        $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
        $imageFileType3 = strtolower(pathinfo($target_file3, PATHINFO_EXTENSION));
        $imageFileType4 = strtolower(pathinfo($target_file4, PATHINFO_EXTENSION));
        $imageFileType5 = strtolower(pathinfo($target_file5, PATHINFO_EXTENSION));

        $check1 = getimagesize($_FILES["img1"]["tmp_name"]);
        $check2 = getimagesize($_FILES["img2"]["tmp_name"]);
        $check3 = getimagesize($_FILES["img3"]["tmp_name"]);
        $check4 = getimagesize($_FILES["img4"]["tmp_name"]);
        $check5 = getimagesize($_FILES["img5"]["tmp_name"]);

        if ($check1 !== false && $check2 !== false && $check3 !== false && $check4 !== false && $check5 !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo 'alert("Upload không thành công")';
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file1) && file_exists($target_file2) && file_exists($target_file3) && file_exists($target_file4) && file_exists($target_file5)) {
            // echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["img1"]["size"] > 3000000 && $_FILES["img2"]["size"] > 3000000 && $_FILES["img3"]["size"] > 3000000 && $_FILES["img4"]["size"] > 3000000 && $_FILES["img5"]["size"] > 3000000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
            && $imageFileType1 != "gif"

            &&  $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
            && $imageFileType1 != "gif"

            &&  $imageFileType3 != "jpg" && $imageFileType3 != "png" && $imageFileType3 != "jpeg"
            && $imageFileType3 != "gif"

            &&  $imageFileType4 != "jpg" && $imageFileType4 != "png" && $imageFileType4 != "jpeg"
            && $imageFileType4 != "gif"

            &&  $imageFileType5 != "jpg" && $imageFileType5 != "png" && $imageFileType5 != "jpeg"
            && $imageFileType5 != "gif"
        ) {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<script> alert("Upload không thành công, hãy kiểm tra lại xem bạn đã úp đúng định dạng hay chưa, có up trùng hình hay không và chắc rằng hình không vượt quá 2,86 MB một hình !!!");</script>';
            // if everything is ok, try to upload file
        } else {
            if (
                move_uploaded_file($_FILES["img1"]["tmp_name"], $target_file1) &&
                move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file2) &&
                move_uploaded_file($_FILES["img3"]["tmp_name"], $target_file3) &&
                move_uploaded_file($_FILES["img4"]["tmp_name"], $target_file4) &&
                move_uploaded_file($_FILES["img5"]["tmp_name"], $target_file5)
            ) {
                //kiểm tra tên
                if ($fullTen == "") {
                    echo '<script> alert("Không được bỏ trông họ và tên!!!");</script>';
                } else {
                    $id_user = $_SESSION['idUser'];
                    //cập nhật tất cả thông tin trên vào db
                }
                echo '<script> alert("Bạn Đã Tải Lên Thành Công, Vui Lòng Chờ Xét Duyệt Hồ Sơ Xác Thực Danh Tính !!!");</script>';
            } else {
                echo '<script> alert("Sự cố mạng dẫn đến upload không thành công, vui lòng thử lại !!!");</script>';
            }
        }
    }
    ?>
    <!--content-->
    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/course-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text" style="bottom:0px;">
            <div class="caption">
                <form id="form_active_2" action="xac_thuc_cap_2.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <h4 style="color:antiquewhite">Form xác thực danh tính</h4>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="img1">Ảnh Mặt Trước CMND</label>
                            <input type="file" class="form-control" name="img1" id="img1" accept="image/x-png,image/jpeg" onchange="validateFileType('img1');" placeholder="Ảnh CMND Mặt Trước" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="img2">Ảnh Mặt Sau CMND</label>
                            <input type="file" class="form-control" name="img2" id="img2" accept="image/x-png,image/jpeg" onchange="validateFileType('img2');" placeholder="Ảnh CMND Mặt Sau" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="img3">Ảnh Mặt Trước Bằng Lái Xe</label>
                            <input type="file" class="form-control" name="img3" id="img3" accept="image/x-png,image/jpeg" onchange="validateFileType('img3');" placeholder="Ảnh Bằng Lái Xe Mặt Trước" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="img4">Ảnh Mặt Trước Bằng Lái Xe</label>
                            <input type="file" class="form-control" name="img4" id="img4" accept="image/x-png,image/jpeg" onchange="validateFileType('img4');" placeholder="Ảnh Mặt Trước Bằng Lái Xe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img5">Ảnh Chụp mặt kèm chứng minh nhân dân</label>
                        <input type="file" class="form-control" name="img5" id="img5" accept="image/x-png,image/jpeg" onchange="validateFileType('img5');" placeholder="Ảnh Chụp mặt kèm chứng minh nhân dân" required>
                    </div>
                    <div class="form-group">
                        <label for="fullName">Họ Và Tên Đầy Đủ(theo CMND ở trên)</label>
                        <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Họ Và Tên Đầy Đủ" required>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Xác Thực</button>
                </form>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        function validateFileType(idName) {
            var fileName = document.getElementById(idName).value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                console.log("file style hop le.");
            } else {
                alert("Only jpg/jpeg and png files are allowed!");
            }
        }
    </script>
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
    <!--footer-->
    <?php
    include("footer.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
</body>

</html>