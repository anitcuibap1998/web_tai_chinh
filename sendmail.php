<?php 

include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/OAuth.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($mailNhan='anitcuibap1998@gmail.com',$maKichHoat){
    $mail = new PHPMailer(true); 
    $mailGui = 'vaynhanhvn365@gmail.com';
    $password_mail = 'Tudoi47246@';                               // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $mailGui;                 // SMTP username
        $mail->Password = $password_mail;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->CharSet ='UTF-8';
        $mail->setFrom($mailGui, 'Hỗ Trợ Tài Chính Nhanh');
        $mail->addAddress($mailNhan, 'Khách Hàng VIP');     // Add a recipient
        $mail->addReplyTo($mailGui, 'Hỗ Trợ Khách Hàng');
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Đây Là Mail Kèm Theo Mã Kích Hoạt Tài Khoản Của Bạn !!!';
        $mail->Body    = 'Mã Kích Hoạt Của Bạn LÀ: '.$maKichHoat;
        $mail->AltBody = 'Chúc Bạn Gặp Nhiều May Nắm Trong Cuộc Sống!!!';
    
        
        return $mail->send();;
    } catch (Exception $e) {
        return false;
    }
}
function sendMailReSetPass($mailNhan='anitcuibap1998@gmail.com',$maKichHoat){
    $mail = new PHPMailer(true); 
    $mailGui = 'vaynhanhvn365@gmail.com';
    $password_mail = 'Tudoi47246@';                             // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $mailGui;                 // SMTP username
        $mail->Password = $password_mail;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->CharSet ='UTF-8';
        $mail->setFrom($mailGui, 'Hỗ Trợ Tài Chính Nhanh');
        $mail->addAddress($mailNhan, 'Khách Hàng VIP');     // Add a recipient
        $mail->addReplyTo($mailGui, 'Hỗ Trợ Khách Hàng');
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Đây Là Mail Kèm Theo Mật Khẩu Mới Của Bạn !!!';
        $mail->Body    = 'Mật Khẩu Mới Của Bạn LÀ: '.$maKichHoat;
        $mail->AltBody = 'Chúc Bạn Gặp Nhiều May Nắm Trong Cuộc Sống!!!';
    
        
        return $mail->send();;
    } catch (Exception $e) {
        return false;
    }
}
function mt_random_float($min=50, $max=100000) {
    $float_part = mt_rand(0, mt_getrandmax())/mt_getrandmax();
    $integer_part = mt_rand($min, $max - 1);
    return $integer_part + $float_part;
}
?>