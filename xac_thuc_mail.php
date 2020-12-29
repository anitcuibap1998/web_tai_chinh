<?php 
error_reporting(E_ERROR);
    if (!isset($_SESSION)) {
        session_start();
    }
    include("libs/db.php");
    if(isset($_SESSION['username'])){
        header('location:index.php');
    }
    else if(isset($_SESSION['username_tmp'])){
        //get thong tin user tam len
        $username_tmp = $_SESSION['username_tmp'];
        $sql = "SELECT * FROM user where `user_name` = '$username_tmp' and `is_block_active_mail` = 0";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $so_lan_kich_hoat=$row['so_lan_kich_hoat'];
            $code_active_mail=$row['code_active_mail'];
        }else {
            header('location:index.php');
        }
        if(isset($_POST['active-submit'])){
            // kiem tra so lan kich hoat 
            if($so_lan_kich_hoat<0){
                //cập nhật trạng thái is_block_active_mail lên bằng 1
                $sql = "UPDATE `user` SET `is_block_active_mail` = 1 WHERE `user_name` = '$username_tmp'";
                $result = $conn->query($sql);
                if($result){
                    //thông báo khóa acc và trả về trang chủ
                     ?>
                     <script>
                         alert('tài khoản của bạn đã bị khóa do nhập mã sai quá 10 lần !!!');
                     </script>
                     <?php
                     header("location:index.php");
                }
               
            }else{
                if($code_active_mail == $_POST['code_active']){
                    //cập nhật trang thái active1 = 1
                    $sql = "UPDATE `user` SET `active1` = 1 WHERE `user_name` = '$username_tmp'";
                    $result = $conn->query($sql);
                    if($result){
                        //thanh cong
                    }
                    // gán session username = session username tạm
                    $_SESSION['username']=$_SESSION['username_tmp'];
                    unset($_SESSION['username_tmp']);
                    //chuyen sang trang chu
                    header("location:index.php");
                }else{
                    //trừ đi 1 lần kích hoạt cập nhật vào database
                    $so_lan_kich_hoat --;
                    $sql = "UPDATE `user` SET `so_lan_kich_hoat` = `so_lan_kich_hoat` - 1 WHERE `user_name` = '$username_tmp'";
                    $result = $conn->query($sql);
                    if($result){
                        //thanh cong
                    }
                }
            }
        }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác Thực Mail</title>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

        <script src="js/xac_thuc_mail.js"></script>
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
                                <div class="col-xs-12">
                                    <p>Mã Kích Hoạt Đã Được Gửi Về Email Của Bạn, Hãy Kiểm Tra Thư (nếu chưa có hãy đợi trong khoảng 30s đến vài phút) và kiểm tra trong mục Spam</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="#" class="active" id="login-form-link">Xác Thực Mail</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p style="color: #456aaa;" >Bạn Còn <?php echo $so_lan_kich_hoat; ?> Lần Kích Hoạt Trước Khi Bị Khóa Acc</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" action="xac_thuc_mail.php" method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                            <input type="text" name="code_active" id="code_active" tabindex="1" class="form-control" placeholder="Mã Xác Thực Mail Kích Hoạt Tài Khoản" value="">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="active-submit" id="active-submit" tabindex="2" class="form-control btn btn-login" value="Xác Thực Mail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        
                                                    </div>
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
    }
    else{
        header('location:index.php');
    }
?>
</html>