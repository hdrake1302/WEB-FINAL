$(document).ready(() => {
    function showError(text) {
        $('.errorText').html(text);
    }

    function success(text){
         $('.modal-header').removeClass('bg-danger').addClass('bg-success');
         $('.errorText').html(text);
    }
    // --------------- START OF LOGIN -----------------
    $('#login-button').click((e) => {
        e.preventDefault();
        let userName = $("#username").val();
        let pwd = $("#password").val();
        let r = /(?=.*[A-Z])/
        if(userName.length === 0 || pwd.length === 0) {
           showError("Vui lòng nhập đầy đủ các thông tin");
        }  else if (pwd.length < 6) {
            showError("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
        } else if (!r.test(pwd)) {
            showError("Mật khẩu phải có ít nhất 1 kí tự viết hoa");
        } else {
            $(this).unbind('click');
            $.post("?controller=login&action=login", {username: userName, password: pwd, submit: true}, function(data){
                try {
                    data = JSON.parse(data);
                    showError("Đăng nhập thất bại");
                } catch (error) {
                    success("Đăng nhập thành công");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
    })

    // --------------- END OF LOGIN -----------------

    // --------------- START OF CHANGE PASSWORD -----------------
     $('#changePass-button').click((e) => {
        e.preventDefault();
        let newPassword = $("#newPwd").val();
        let confirmPassword = $("#confirmPwd").val();
        let r = /(?=.*[A-Z])/

        if(newPassword.length === 0 || confirmPassword.length === 0) {
            showError("Vui lòng nhập đầy đủ các thông tin");
        } else if(newPassword.length < 6 || confirmPassword.length < 6) {
            showError("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
        } else if (!r.test(newPassword) || !r.test(confirmPassword)) {
            showError("Mật khẩu phải có ít nhất 1 kí tự viết hoa");
        } else if (newPassword != confirmPassword) {
            showError("Mật khẩu không khớp với nhau!");
        } else {
            showError("Thay đổi mật khẩu thành công");
        }
    })

    // --------------- START OF CHANGE PASSWORD -----------------
    
});






