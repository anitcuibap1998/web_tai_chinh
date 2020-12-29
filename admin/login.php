<?php
include_once("libs/db.php");
if(!isset($_SESSION)){
    session_start();
}
//xử lý login tại đây
if (isset($_SESSION['username']) && isset($_SESSION['roleAdmin'])) {
    header('Location:index.php');
}
// xử lý khi nhấn nút đăng nhập 
if (isset($_POST['dangnhap'])) {
    $username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "0";
    $pass = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : "0";
    $password = md5(md5($pass));
    //get thong tin duoi db len
    $sql = "SELECT * FROM user where `user_name` = '$username' and `pass` = '$password' and `role`= 99";

    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] =  $username ;
        $_SESSION['roleAdmin'] = 99;
        header('location:index.php');
    } else {
?>
        <script>
            alert("Đăng Nhập Không Thành Công, Tài Khoản Không Tồn Tại Hoặc Đã Bị Block !!!")
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>
    <div class="login">
        <div class="login-header">
            <h3>Login Admin</h3>
        </div>
        <div class="login-form">
            <form action="login.php" method="post">
                <h3>Username:</h3>
                <input type="text" name="username" placeholder="Username" /><br>
                <h3>Password:</h3>
                <input type="password" name="pass" placeholder="Password" />
                <br>
                <button type="submit" name="dangnhap" class="btn btn-primary">Đăng Nhập</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>