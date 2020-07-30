
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch("app/Auth/Views/assets/img/backgrounds/1.jpg");
    
    /*
        Form validation
    */

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
    function isValidUsername(username) {
        // var pattern=/^[a-zA-Z0-9]{3,190}$/;
        // return pattern.test(username);
        var length = username.length;
        if (length < 3){
            return false;
        }else if(length >190){
            return false;
        }else{
            return true;
        }
    }
    function isValidPass(pass) {
        var pattern=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,190}$/;
        return pattern.test(pass);
    }
    $('#form-email').change(function(){
        var email=$(this).val();
        if (!isValidEmailAddress(email)){
            $(this).addClass('input-error');
            $('#errors').html('Email phải có định dạng: abc@gmail.com !')
        }else {
            $(this).removeClass('input-error');
            $('#errors').html('')
        }
    });

    $('.login-form').on('submit', function(e) {
        var username=$('#form-username').val();
        var password=$('#form-password').val();
        // console.log(isValidUsername(username));
        if (!isValidUsername(username)){
            $('#form-username').addClass('input-error');
            $('#error-username').html('Tên đăng nhập trong khoảng từ 3 đến 190 ký tự !')
            return false;
        }
        if (!isValidUsername(password)){
            $('#form-password').addClass('input-error');
            $('#error-password').html('Mật khẩu trong khoảng từ 6 đến 30 ký tự, bao gồm chữ và số !')
            return false;
        }
        if (isValidUsername(password) && isValidUsername(username)){
            return true;
        }
    });

    $('.forgot-form').on('submit', function(e) {
        var email=$('#form-email').val();
        if (!isValidEmailAddress(email)){
            $('#form-email').addClass('input-error');
            $('#errors').html('Email phải có định dạng: abc@gmail.com !')
            return false;
        }
    });
});
