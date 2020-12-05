<?php
if (!isset($_SESSION)) {
    session_start();
}
include("libs/db.php");
include("sendmail.php");
if(isset($_POST['register-submit'])){

    $fullname = htmlspecialchars($_POST['fullname']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $password = htmlspecialchars($_POST['fullname']);

    $password = md5(md5($password));

    $sql = "SELECT id, `user_name`, `pass` FROM user where (`user_name` = '$username' or `email` = '$email' or `phone` = '$phone') and `is_block_active_mail` = 0 ";

    $result = $conn->query($sql);
      
    if ($result->num_rows > 0) {
       ?>
        <script>
            alert("User Name hoặc Email Hoặc Số điện thoại đã được đã được đăng ký, vui lòng đổi lại !!!");
        </script>
       <?php
    } else {
        // tạo mã active 
        $code_active = mt_random_float(50,1000);
        // thêm vào database và tạo ra mã kích hoạt lưu vào database 
        $sql = "INSERT INTO `user`(`full_name`, `user_name`, `pass`, `email`, `phone`,`code_active_mail`) VALUES ('$fullname','$username','$password','$email','$phone','$code_active')";

        $result = $conn->query($sql);
          
        if ($result->num_rows > 0) {
            
            // gửi mã vừa tạo vào email của người dùng (send mail)
            sendMail($email,$code_active);

            // thông báo và chuyển qua trang active mail cho người dùng
            ?>
            <script>
                alert("Đăng Ký Thành Công Và Chuyển Qua Xác Thực Mail");
            </script>
            <?php
            header("location:xac_thuc_mail.php");
        }
        else{
            ?>
            <script>
                alert("Đăng Ký Không Thành Công Mời Bạn Đăng Ký Lại");
            </script>
            <?php
        }
      
    }
    $conn->close();


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script src="js/dangky.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="register-form" action="dangky.php" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="fullname" id="fullname" tabindex="1" class="form-control" placeholder="Họ Và Tên" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="2" class="form-control" placeholder="Username" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="3" class="form-control" placeholder="Email Address" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="phone" id="phone" tabindex="4" class="form-control" placeholder="Số Điện Thoại" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="5" class="form-control" placeholder="Password" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="6" class="form-control" placeholder="Confirm Password" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="7" class="form-control btn btn-register" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php

?>

</html>