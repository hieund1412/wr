
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch("../../app/Auth/Views/assets/img/backgrounds/1.jpg");

    /*
        Form validation
    */
    function isValidPass(pass) {
        var pattern=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,190}$/;
        return pattern.test(pass);
    }

    $('.reset-form').on('submit', function(e) {
        var repassword=$('#form-repassword').val();
        var password=$('#form-password').val();
        if (!isValidPass(password)){
            $('#form-password').addClass('input-error');
            $('#error-username').html('Mật khẩu trong khoảng từ 6 đến 30 ký tự, bao gồm chữ và số !')
            return false;
        }else {
            $('#form-password').removeClass('input-error');
            $('#error-username').html('')
        }
        if (password!=repassword){
            $('#form-repassword').addClass('input-error');
            $('#error-password').html('Mật khẩu và xác nhận mật khẩu phải trùng nhau !')
            return false;
        }
    });
});
