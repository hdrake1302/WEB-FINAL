$(document).ready(() => {
    let home_url = "http://localhost/WEB-FINAL/Source/mvc/";
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
        }else if (currentPassword === newPassword) {
            showError("Mật khẩu mới không được trùng với mật khẩu cũ!");
        } else {
            $(this).unbind('click');
            $.post("?controller=login&action=changePassword", {currentPwd: currentPassword, newPwd: newPassword, confirmPwd: confirmPassword, submit: true}, function(data){
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
    
    // --------------- START OF TEMPLATE ----------------------
    $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    $(".menu i").click(function() {
        $(".sidebar").toggleClass("active");
    });
    // --------------- END OF TEMPLATE -------------------------
    
    // --------------- START OF VIEW PROFILE -------------------

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this)
            .siblings(".custom-file-label")
            .addClass("selected")
            .html(fileName);
    });

    $("#upload-btn").click(function(evt) {
        evt.preventDefault();
        const suppported_extensions = [
        "jpg",
        "png",
        ];
        let input = document.getElementById("document");

        if (!input.files[0]) {
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
                        $(".profile-img img").attr('src', response.avatar);
                        $(".avatar img").attr('src', response.avatar);
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
        xhr.open("POST", '?controller=user&action=uploadAvatar', true);
        xhr.send(data);
    });

    function getExtension(filename) {
        return filename.split(".").pop();
    }
    // END OF VIEW PROFILE

    // ----------- START OF LEAVES MANAGEMENT ---------------

    // LIMIT REQUEST DATE
    let today = new Date();
    today.setDate(today.getDate() + 1);
    today = today.toISOString().slice(0, 10);
    $('#leave-date').attr('min', today);
    $('#leave-date').val(today);

    // Status == waiting then we don't let user request
    let leaveStatuses = $(".leave-status");
    for (let i = 0; i < leaveStatuses.length; i++) {
        s = leaveStatuses[i].innerText;
        if (s === 'waiting'){
            $('#leave-request-btn').attr("disabled", true);
            break;
        }
    }

    // WHEN USER CLICK CREATE BUTTON
    $('#create-request-btn').click(function(evt) {
        
        const suppported_extensions = [
        "jpg",
        "png",
        "docx",
        "pdf"
        ];

        let personID = parseInt($('#personID').text());
        let days = $('#leave-days').val();
        let dateWanted = $('#leave-date').val();
        let description = $('#leave-description').val();
        let input = document.getElementById('leave-file');

        if (!input.files[0]) {
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
        data.append("leave_id", personID);
        data.append("days", days);
        data.append("date_wanted", dateWanted);
        data.append("description", description);
        data.append("file_name", file.name);
        data.append("file", file);
        
        let xhr = new XMLHttpRequest();

        xhr.upload.addEventListener("progress", function(e) {
            let loaded = e.loaded;
            let total = e.total;
            let progress = (loaded * 100) / total;

            $(".progress-bar").attr("style", "width: " + progress + "%;");
        });

        xhr.onload = function() {
            if (xhr.readyState === xhr.DONE) {
                if (xhr.status === 200) {
                    response = JSON.parse(xhr.responseText);
                    if (response.code === 0) {
                        // SUCCESS
                        success(response.message);
                    }else{
                        // FAIL
                        showError(response.message);
                    }
                    // RESET PROGRESS BAR
                    setTimeout(function(){
                        $(".progress-bar").attr("style", "width: 0");
                        $('#leave-request-modal').modal('hide');
                    }, 2000);
                }
            }
        };

        xhr.open("POST", "?controller=leave&action=createRequest", true);
        xhr.send(data);
    });
    // --------------------- END OF LEAVES MANAGEMENT ---------------------

    // --------------------- START OF VIEW REQUEST ---------------------

    // ACCEPT REQUEST
    $("#leave-accept-request").click(function(evt) {
        evt.preventDefault();

        let id = parseInt($("#leave-request-id").text());
        let personID = parseInt($("#leave-request-personID").text());
        let daysRequested = parseInt($("#leave-request-daysRequested").text());

        let data = {'id': id, 'leave_id': personID, 'days': daysRequested};

        $.ajax({
            url: "?controller=leave&action=acceptRequest",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);

                if(result.code === 0){
                    success(result.message);
                    setTimeout(function(){
                        window.location.href = "?controller=leave&action=indexRequest";
                    }, 2000);
                }else{
                    showError(result.message);
                }
            }
        });
    });

    // REJECT REQUEST
    $("#leave-reject-request").click(function(evt) {
        evt.preventDefault();

        let id = parseInt($("#leave-request-id").text());
        let data = {'id': id};

        $.ajax({
            url: "?controller=leave&action=rejectRequest",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);

                if(result.code === 0){
                    $("#success-alert2").text(result.message);
                    $("#success-alert2").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert2").slideUp(500);
                    });
                    setTimeout(function(){
                        window.location.href = "?controller=leave&action=indexRequest";
                    }, 2000);
                }else{
                    $("#fail-alert2").text(result.message);
                    $("#fail-alert2").fadeTo(2000, 500).slideUp(500, function() {
                        $("#fail-alert2").slideUp(500);
                    });
                }
            }
        });
    });

    // --------------------- END OF VIEW REQUEST ---------------------
});






