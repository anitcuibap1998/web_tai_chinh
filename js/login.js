$(function() {

    $('#login-form-link').click(function(e) {
        console.log("render khung dang nhap");
        $("#login-form").delay(100).fadeIn(100);
        $(this).addClass('active');
        e.preventDefault();
    });


    // xử lý sự kiện submit form đăng nhập



});