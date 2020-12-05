<?php 

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
                                <p>Mã Kích Hoạt Đã Được Gửi Về Email Của Bạn, Hãy Kiểm Tra Thư (nếu chưa có hãy đợi trong khoảng 30s đến vài phút)</p>
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
                                <p>Bạn Còn 5 Lần Kích Hoạt Trước Khi Bị Khóa Acc</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
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

?>

</html>