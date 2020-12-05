$(function() {

    $('#register-form-link').click(function(e) {
        console.log("render khung dang ky");
        $("#register-form").delay(100).fadeIn(100);
        $(this).addClass('active');
        e.preventDefault();
    });

    //xử lý form đăng ký 
    $("#register-form").submit(function(event) {
        console.log("Handler for .submit() called.");

        let fullname = $('#fullname').val();
        fullname = fullname.replace(/\s/g, '');
        let username = $('#username').val();
        username = username.replace(/\s/g, '');
        let mail = $('#email').val();
        mail = mail.replace(/\s/g, '');
        let phone = $('#phone').val();
        phone = phone.replace(/\s/g, '');
        let pass = $('#password').val();
        pass = pass.replace(/\s/g, '');
        let confirm_pass = $('#confirm-password').val();
        confirm_pass = confirm_pass.replace(/\s/g, '');
        if (fullname.length > 150) {
            alert("Họ Và Tên Không Được 150 Ký Tự !!!");
            event.preventDefault();
        } else if (fullname.length < 3) {
            alert("Họ Và Tên ít nhất 3 Ký Tự !!!");
            event.preventDefault();
        } else if (username.length > 32) {
            alert("Username Không Được 32 Ký Tự !!!");
            event.preventDefault();
        } else if (username.length < 3) {
            alert("Username ít nhất 8 Ký Tự !!!");
            event.preventDefault();
        } else if (!validateEmail(mail)) {
            alert("Email Không Hợp Lệ !!");
            event.preventDefault();
        } else if (!validatePhone(phone) || phone.length > 11) {
            alert("Số Điện Thoại Không Hợp Lệ !!");
            event.preventDefault();
        } else if (pass != confirm_pass) {
            alert("Mật Khẩu Không Khớp Mời Bạn Kiểm Tra Lại !!!");
            event.preventDefault();
        } else if (pass.length < 8 || pass.length > 32) {
            alert("Mật Khẩu Phải Từ 8 Đến 32 Ký Tự !!!");
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePhone(phone) {
        const regex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (regex.test(phone)) {
            return true;
        } else return false;
    }
});