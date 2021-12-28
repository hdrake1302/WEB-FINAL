$(document).ready(() => {
    function showError(text) {
        $("#fail-alert").text(text);
        $("#fail-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#fail-alert").slideUp(500);
        });
    }

    function success(text){
        $("#success-alert").text(text);
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    }

    // --------------- START OF LOGIN -----------------
    $('#login-button').click((e) => {
        e.preventDefault();
        let userName = $("#username").val();
        let pwd = $("#password").val();
        let r = /(?=.*[A-Z])/

        if(userName.length === 0 || pwd.length === 0) {
            let focus_target = "";
            if(userName.length === 0){
                focus_target = "#username";
            } else if(pwd.length === 0){
                focus_target = "#password";
            }
            $(focus_target).focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
        }  else if (pwd.length < 6) {
            showError("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
        } 
        // else if (!r.test(pwd)) {
        //     showError("Mật khẩu phải có ít nhất 1 kí tự viết hoa");
        // } 
        else {
            $(this).unbind('click');
            $.post("?controller=login&action=login", {username: userName, password: pwd, submit: true}, function(data){
                try {
                    data = JSON.parse(data);
                    showError(data.message);
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

        let currentPassword = $("#currentPwd").val();
        let newPassword = $("#newPwd").val();
        let confirmPassword = $("#confirmPwd").val();

        if(currentPassword.length === 0 || newPassword.length === 0 || confirmPassword.length === 0) {
            let focus_target = "";
            if(currentPassword.length === 0){
                focus_target = "#currentPwd";
            } else if(newPassword.length === 0){
                focus_target = "#newPwd";
            } else if(confirmPassword.length === 0){
                focus_target = "#confirmPwd"
            }
            $(focus_target).focus();
            showError("Vui lòng nhập đầy đủ các thông tin");

        } else if(currentPassword.length < 6 || newPassword.length < 6 || confirmPassword.length < 6) {
            showError("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
        } else if (newPassword != confirmPassword) {
            showError("Mật khẩu không khớp với nhau!");
        } else {
            $(this).unbind('click');
            $.post("?controller=changePass&action=changePassword", {currentPwd: currentPassword, newPwd: newPassword, confirmPwd: confirmPassword, submit: true}, function(data){
                try {
                    data = JSON.parse(data);
                    showError(data.message);
                } catch (error) {
                    success("Đổi mật khẩu thành công");
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
            });
        }
    })
    // --------------- END OF CHANGE PASSWORD -----------------
    
    // START OF TEMPLATE
    $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    $(".menu i").click(function() {
        $(".sidebar").toggleClass("active");
    });

    $(".modal #confirm-change").click(function(e){
        console.log(sessionStorage.getItem('id'));
    });
    // END OF TEMPLATE
    
    // START OF VIEW PROFILE

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
    });
    const suppported_extensions = [
        "jpg",
        "png",
    ];

    $("#upload-btn").click(function(evt) {
        evt.preventDefault();
        let input = document.getElementById("document");

        if (!input.files[0]) {
            // alert("Please select a file before clicking upload");
            showError("Please select a file before clicking upload");
            throw new Error("Please select a file before clicking upload");
        }
        let file = input.files[0];
        let extension = getExtension(file.name);
        let size = file.size;

        if (size >= 500 * 1024 * 1024) {
            showError("File size exceeds the maximum size");
            throw new Error("File size exceeds the maximum size");
        }
        if (!suppported_extensions.includes(extension)) {
            showError("File type is not supported!");
            throw new Error("File type is not supported!");
        }
        let data = new FormData();
        data.append("name", file.name);
        data.append("file", file);

        let xhr = new XMLHttpRequest();

        xhr.upload.addEventListener("progress", function(e) {
            let loaded = e.loaded;
            let total = e.total;
            let progress = (loaded * 100) / total;

            $(".progress-bar").attr("style", "width: " + progress + "%;");
        });

        let path = "http://localhost/WEB-FINAL/Source/mvc/assets/"

        xhr.onload = function() {
            if (xhr.readyState === xhr.DONE) {
                if (xhr.status === 200) {
                    response = JSON.parse(xhr.responseText);
                    if (response.code === 0) {
                        // SUCCESS
                        success("Uploaded Successfully!")
                        $(".profile-img img").attr('src', path + "uploads/" + file.name);
                    }else{
                        // FAIL
                        showError(response.message);
                    }
                    // RESET PROGRESS BAR
                    setTimeout(function(){
                        $(".progress-bar").attr("style", "width: 0");
                    }, 2000);
                }
            }
        };

        xhr.open("POST", path + "api/" + "upload.php", true);
        xhr.send(data);
    });

    function getExtension(filename) {
        return filename.split(".").pop();
    }
    // END OF VIEW PROFILE
});






