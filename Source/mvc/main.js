$(document).ready(() => {
    const home_url = "http://localhost/WEB-FINAL/Source/mvc/";
    const MAX_FILE_SIZE = 500 * 1024 * 1024;

    // --------------- START OF LOGIN -----------------
    $('#login-button').click((e) => {
        e.preventDefault();
        let userName = $("#username").val();
        let pwd = $("#password").val();

        if(userName.length === 0 || pwd.length === 0) {
            let focus_target = "";
            if(userName.length === 0){
                focus_target = "#username";
            } else if(pwd.length === 0){
                focus_target = "#password";
            }
            $(focus_target).focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        }  else if (pwd.length < 6) {
            showError("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
            throw new Error("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
        } 
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
            throw new Error("Vui lòng nhập đầy đủ các thông tin");

        } else if(currentPassword.length < 6 || newPassword.length < 6 || confirmPassword.length < 6) {
            showError("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
            throw new Error("Độ dài mật khẩu không phù hợp! (Ít nhất 6 kí tự)");
        } else if (newPassword != confirmPassword) {
            showError("Mật khẩu không khớp với nhau!");
            throw new Error("Mật khẩu không khớp với nhau!");
        }else if (currentPassword === newPassword) {
            showError("Mật khẩu mới không được trùng với mật khẩu cũ!");
            throw new Error("Mật khẩu mới không được trùng với mật khẩu cũ!");
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
    

    // --------------- START OF USER MANAGEMENT -------------------
    $("#user-addAccount-btn").click(function(){
        // Lấy dữ liệu của các ô input
        let username = $("#add-user-username").val();
        let firstname = $("#add-user-firstname").val();
        let lastname = $("#add-user-lastname").val();
        let email = $("#add-user-email").val();
        let phone = $("#add-user-phone").val();
        let department = $("#add-user-department").val();

        let data = {
            'username': username,
            'firstname': firstname,
            'lastname': lastname,
            'email': email,
            'phone': phone,
            'department': department
        };

        // Validate data
        if(username.length === 0){
            showError("Không được để trống thông tin");
            $("#add-user-username").focus();
            throw new Error("Không được để trống thông tin");
        }else if(firstname.length === 0){
            showError("Không được để trống thông tin");
            $("#add-user-firstname").focus();
            throw new Error("Không được để trống thông tin");
        }else if(lastname.length === 0){
            showError("Không được để trống thông tin");
            $("#add-user-lastname").focus();
            throw new Error("Không được để trống thông tin");
        }else if(email.length === 0){
            showError("Không được để trống thông tin");
            $("#add-user-email").focus();
            throw new Error("Không được để trống thông tin");
        }else if(phone.length === 0){
            showError("Không được để trống thông tin");
            $("#add-user-phone").focus();
            throw new Error("Không được để trống thông tin");
        }else if(department.length === 0){
            showError("Không được để trống thông tin");
            $("#add-user-phone").focus();
            throw new Error("Không được để trống thông tin");
        }
        else if(username.length < 6 || username.length > 30){
            showError("Độ dài của username không được dưới 6 và không được quá 30 ký tự");
            throw new Error("Độ dài của username không được dưới 6 và không được quá 30 ký tự");
        }else if(!validateEmail(email)){
            showError("Email không hợp lệ!");
            throw new Error("Email không hợp lệ!");
        }

        $.ajax({
            url: "?controller=user&action=createAccount",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);
                if(result.code === 0){
                    success(result.message);
                    appendUserToTable(data);
                    setTimeout(function(){
                    $("#user-addAccount-modal").modal('hide');
                }, 2000);
                }else{
                    showError(result.message)
                }
            }
        })
    });

    $("#user-reset-password").click(function(){
        let userID = parseInt($("#user-id").text());

        $.ajax({
            url: "?controller=user&action=confirmChange&id="+userID,
            method: "POST",
            success: function(result){
                result = JSON.parse(result);

                if(result.code === 0){
                    success(result.message);
                }else{
                    showError(result.message);
                }
            }
        });
    });
    // --------------- END OF USER MANAGEMENT -------------------

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

        if (size >= MAX_FILE_SIZE) {
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

        xhr.onload = function() {
            if (xhr.readyState === xhr.DONE) {
                if (xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
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

        if (description.length === 0){
            $('#leave-description').focus();
            showError("Không được bỏ trống mục lý do");
            throw new Error("Không được bỏ trống mục lý do");
        }
        let data = new FormData();

        if (input.files[0]) {
            let file = input.files[0];
            let extension = getExtension(file.name);
            let size = file.size;

            if (size >= MAX_FILE_SIZE) {
                showError("File size exceeds the maximum size");
                throw new Error("File size exceeds the maximum size");
            }
            if (!suppported_extensions.includes(extension)) {
                showError("File type is not supported!");
                throw new Error("File type is not supported!");
            }
            data.append("file_name", file.name);
            data.append("file", file);
        }
        
        data.append("leave_id", personID);
        data.append("days", days);
        data.append("date_wanted", dateWanted);
        data.append("description", description);
        
        
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
                    let response = JSON.parse(xhr.responseText);
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
    function getTime(dayAdded=0){
        /*
        Function that return date time at the moment
        */
        let taskDate = new Date();
        taskDate.setDate(taskDate.getDate() + dayAdded);
        today = taskDate.toISOString().slice(0, 10);

        let hours = taskDate.getHours()
        let taskHours = hours - 10 < 0 ? '0'+ hours.toString(): hours.toString();
        
        let minutes = taskDate.getMinutes();
        let taskMinutes = minutes - 10 < 0 ? '0'+ minutes.toString(): minutes.toString();
        
        let seconds = taskDate.getSeconds();
        let taskSeconds = seconds - 10 < 0 ? '0'+ seconds.toString(): seconds.toString();

        let taskTime = taskHours + ':' + taskMinutes + ':' + taskSeconds;

        return today + 'T' + taskTime;
    }

     // --------------- START OF TASK MANAGEMENT -------------------

        // indexManager.php
        // LIMIT DEADLINE DATE
        todayTime = getTime(1);
        $('#task-create-deadline').attr('min', todayTime);
        $('#task-create-deadline').val(todayTime);

        $("#create-task-btn").click(function(){
            let staffID = $("#task-create-employee").val();
            let deadline = formatDate($("#task-create-deadline").val());
            let title = $("#task-create-title").val();
            let description = $("#task-create-description").val();
            let input = document.getElementById('task-create-file');
            
            let data_json = {
                'staffID': staffID,
                'deadline': deadline,
                'title': title,
                'description': description,
                'input': input,
                'status': 'New'
            };

            const suppported_extensions = [
            "jpg",
            "png",
            "docx",
            "pdf"
            ];
            
            let data = new FormData();

            if (input.files[0]) {
                let file = input.files[0];
                let extension = getExtension(file.name);
                let size = file.size;

                if (size >= MAX_FILE_SIZE) {
                    showError("File size exceeds the maximum size");
                    throw new Error("File size exceeds the maximum size");
                }
                if (!suppported_extensions.includes(extension)) {
                    showError("File type is not supported!");
                    throw new Error("File type is not supported!");
                }
                data.append("file_name", file.name);
                data.append("file", file);
            }

            data.append("staff_id", staffID);
            data.append("deadline", deadline);
            data.append("title", title);
            data.append("description", description);


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
                        let response = JSON.parse(xhr.responseText);
                        if (response.code === 0) {
                            // SUCCESS
                            success(response.message);
                            appendTaskToTable(data_json);
                        }else{
                            // FAIL
                            showError(response.message);
                        }
                        // RESET PROGRESS BAR
                        setTimeout(function(){
                            $(".progress-bar").attr("style", "width: 0");
                            $("#task-createTask-modal").modal('hide');
                        }, 2000);
                    }
                }
        };

        xhr.open("POST", "?controller=task&action=createTask", true);
        xhr.send(data);
        });

        $("#task-cancel-confirm-btn").click(function(){
            let id = parseInt($("#task-cancel-id").text());
            data = {'id': id};
            $.ajax({
            url: "?controller=task&action=cancelTask",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);
                if(result.code === 0){
                    $("#success-alert2").text(result.message);
                    $("#success-alert2").fadeTo(2000, 500).slideUp(500, function() {
                        $("#success-alert2").slideUp(500);
                    });
                }else{
                    $("#fail-alert2").text(result.message);
                    $("#fail-alert2").fadeTo(2000, 500).slideUp(500, function() {
                        $("#fail-alert2").slideUp(500);
                    });
                    }
                }
            });
        });

        // viewManager.php
        let taskStatusManager = $('#task-viewManager-status').text().trim();
        if(taskStatusManager != "Waiting"){
            $("#task-review-modal-btn").attr("disabled", true);
        }

        $("#task-accept-btn").click(function(){
            let rating = $("#task-review-rating").val();
            let taskID = parseInt($("#task-id").text());

            let data = {'id': taskID, 'rating': rating};

            if(!rating){
                $("#task-review-rating").focus();
                showError2("#fail-alert-accept", "Vui lòng chọn mức độ đánh giá!");
                throw new Error("Vui lòng chọn mức độ đánh giá!");
            }

            $.ajax({
            url: "?controller=task&action=approveTask",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);

                if(result.code === 0){
                    success2("#success-alert-accept", result.message);
                    $("#task-viewManager-status").text("Completed");
                    $("#task-review-modal-btn").attr("disabled", true);
                    
                    setTimeout(function(){
                            $("#task-review-modal").modal("hide");
                            $("#task-accept-modal").modal("hide");
                    }, 2000);
                }else{
                     showError2("#fail-alert-accept", result.message);
                    }
                }
            });
            
        }); 

        $("#task-reject-btn").click(function(){
            let note = $("#task-reject-description").val();
            let taskID = parseInt($("#task-id").text());
            
            console.log(note)
            if(!note){
                $("#task-reject-description").focus();
                showError2("#fail-alert-reject", "Vui lòng thêm mô tả!");
                throw new Error("Vui lòng thêm mô tả!");
            }

            let input = document.getElementById('task-reject-file');

            const suppported_extensions = [
            "jpg",
            "png",
            "docx",
            "pdf"
            ];
            
            let data = new FormData();

            if (input.files[0]) {
                let file = input.files[0];
                let extension = getExtension(file.name);
                let size = file.size;

                if (size >= MAX_FILE_SIZE) {
                    showError2("#fail-alert-reject", "File size exceeds the maximum size");
                    throw new Error("File size exceeds the maximum size");
                }
                if (!suppported_extensions.includes(extension)) {
                    showError2("#fail-alert-reject", "File type is not supported!");
                    throw new Error("File type is not supported!");
                }
                data.append("file_name", file.name);
                data.append("file", file);
            }

            data.append("id", taskID);
            data.append("note", note);

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
                        let response = JSON.parse(xhr.responseText);
                        if (response.code === 0) {
                            // SUCCESS
                            success2("#success-alert-reject", response.message);
                            $('#task-review-modal-btn').attr("disabled", true);
                            $('#task-viewManager-status').text("Rejected");
                        }else{
                            // FAIL
                            showError2("#fail-alert-reject", response.message);
                        }
                        // RESET PROGRESS BAR
                        setTimeout(function(){
                            $(".progress-bar").attr("style", "width: 0");
                            $('#task-review-modal').modal('hide');
                            $('#task-reject-modal').modal('hide');
                        }, 2000);
                    }
                }
            }

            xhr.open("POST", "?controller=task&action=rejectTask", true);
            xhr.send(data); 
        }); 
    
        // start task viewStaff.php
        let taskStatus = $('#task-viewStaff-status').text().trim();
        if(taskStatus != "In progress" && taskStatus != "Rejected"){
            $("#task-submit-modal-btn").attr("disabled", true);
        }
        if(taskStatus != "New"){
            $("#task-start-modal-btn").attr("disabled", true);
        }

        $("#task-start-btn").click(function(){
            let id = parseInt($("#task-id").text());
            data = {'id': id};
            $.ajax({
            url: "?controller=task&action=startTask",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);

                if(result.code === 0){
                    success(result.message);
                    $("#task-viewStaff-status").text("In progress");
                    $("#task-submit-modal-btn").attr("disabled", false);
                    $("#task-start-modal-btn").attr("disabled", true);
                }else{
                    showError(result.message);
                    }
                }
            });
        });

        $("#task-submit-btn").click(function(){
            let taskID = parseInt($("#task-id").text());
            let description = $("#task-submit-description").val();
            let input = document.getElementById('task-submit-file');

            if (description.length === 0){
                $('#task-submit-description').focus();
                showError2("#fail-alert2", "Không được bỏ trống mục lý do");
                throw new Error("Không được bỏ trống mục lý do");
            }

            if (!input.files[0]){
                showError2("#fail-alert2", "Phải có file đính kèm!");
                throw new Error("Phải có file đính kèm!");
            }

            const suppported_extensions = [
            "jpg",
            "png",
            "docx",
            "pdf"
            ];
        
            let data = new FormData();
            let file = input.files[0];
            let extension = getExtension(file.name);
            let size = file.size;

            if (size >= MAX_FILE_SIZE) {
                showError("File size exceeds the maximum size");
                throw new Error("File size exceeds the maximum size");
            }

            if (!suppported_extensions.includes(extension)) {
                showError("File type is not supported!");
                throw new Error("File type is not supported!");
            }

            data.append("file_name", file.name);
            data.append("file", file);

            data.append("task_id", taskID);
            data.append("note", description);

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
                        let response = JSON.parse(xhr.responseText);
                        if (response.code === 0) {
                            // SUCCESS
                            success2("#success-alert2", response.message);
                            $("#task-viewStaff-status").text("Waiting");
                            $("#task-submit-modal-btn").attr("disabled", true);
                            $("#task-rejected-detail-btn").attr("disabled", true);
                            $("#task-rejected-detail-modal").modal("hide");
                        }else{
                            // FAIL
                            showError2("#fail-alert2", response.message);
                        }
                        // RESET PROGRESS BAR
                        setTimeout(function(){
                            $(".progress-bar").attr("style", "width: 0");
                            $("#task-start-modal").modal("hide");

                        }, 2000);
                    }
                }
            };

            xhr.open("POST", "?controller=task&action=submitTask", true);
            xhr.send(data);
        });
        
    // --------------- END OF TASK MANAGEMENT -------------------

    
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

    // --------------------- START OF DEPARTMENT MANAGEMENT ---------------------


    $("#department-add-btn").click(function(){
        let name = $("#department-add-name").val();
        let description = $("#department-add-description").val();
        let roomQuantity = $("#department-add-quantity").val();

        let data ={
            'name': name,
            'description': description,
            'roomQuantity': roomQuantity
        };

        if(name.length === 0){
            $("#department-add-name").focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        } else if(description.length === 0){
            $("#department-add-description").focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        } else if(roomQuantity.length === 0){
            $("#department-add-quantity").focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        } else if(roomQuantity < 1){
            $("#department-add-quantity").focus();
            showError("Số phòng không được bé hơn 1");
            throw new Error("Số phòng không được bé hơn 1");
        }

        $.ajax({
            url: "?controller=department&action=createDepartment",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);
                if(result.code === 0){
                    success(result.message);
                    appendDepartmentToTable(data);
                    setTimeout(function(){
                    $("#department-add-modal").modal('hide');
                    }, 2000);
                }else{
                    showError(result.message)
                }
            }
        })
    });

    $("#department-edit-btn").click(function(){
        let id = parseInt($("#department-id").text());
        let name = $("#department-add-name").val();
        let description = $("#department-add-description").val();
        let roomQuantity = $("#department-add-quantity").val();

        let data ={
            'id': id,
            'name': name,
            'description': description,
            'roomQuantity': roomQuantity
        };

        console.log(data);
        if(name.length === 0){
            $("#department-add-name").focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        } else if(description.length === 0){
            $("#department-add-description").focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        } else if(roomQuantity.length === 0){
            $("#department-add-quantity").focus();
            showError("Vui lòng nhập đầy đủ các thông tin");
            throw new Error("Vui lòng nhập đầy đủ các thông tin");
        } else if(roomQuantity < 1){
            $("#department-add-quantity").focus();
            showError("Số phòng không được bé hơn 1");
            throw new Error("Số phòng không được bé hơn 1");
        }

        $.ajax({
            url: "?controller=department&action=editDepartment",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);
                if(result.code === 0){
                    success(result.message);
                    updateDepartmentDetail(data);
                    setTimeout(function(){
                    $("#department-edit-modal").modal('hide');
                }, 2000);
                }else{
                    showError(result.message)
                }
            }
        })
    });

    $("#department-appoint-btn").click(function(){
        let userID = parseInt($("#department-appoint-name").attr("data-id"));
        let departmentID = parseInt($("#department-id").text());

        let data = {'user_id': userID, 'department_id': departmentID};

        $.ajax({
            url: "?controller=department&action=appointManager",
            method: "POST",
            data: data,
            success: function(result){
                result = JSON.parse(result);
                if(result.code === 0){
                    success2("#success-alert2" ,result.message);

                    $("#department-manager").text($("#department-appoint-name").text());
                    setTimeout(function(){
                        $("#department-appoint-modal").modal('hide');
                    }, 2000);
                }else{
                    showError2("#fail-alert2" ,result.message)
                }
            }
        })
    });
    // --------------------- END OF DEPARTMENT MANAGEMENT ---------------------
});

function getNextUserID(){
    /*
    Function to get next user id in the table
    */
    let usersID = $(".user-id").text();
    return parseInt(usersID.charAt(usersID.length-1)) + 1
}

function getNextDepartmentID(){
    /*
    Function to get next department id in the table
    */
    let departmentID = $(".department-id").text();
    return parseInt(departmentID.charAt(departmentID.length-1)) + 1
}

function getNextTaskID(){
    /*
    Function to get next task id in the table
    */
    let taskID = $(".task-id").text();
    return parseInt(taskID.charAt(taskID.length-1)) + 1
}

function updateDepartmentDetail(data){
    $("#department-description").val(data.description);
    $("#department-quantity").text(data.roomQuantity);
}

// USER MANAGEMENT
function appendUserToTable(data){
    let userID = getNextUserID();
    let tableCell = $("<tr> \
                        <td>"+`${userID}`+"</td> \
                        <td>"+`${data.username}`+"</td> \
                        <td>"+`${data.firstname}`+"</td> \
                        <td>"+`${data.email}`+"</td> \
                        <td>"+`${data.phone}`+"</td> \
                        <td> \
                            <a class='btn btn-sm btn-primary' href='?controller=user&action=view&id="+`${userID}`+"'>View</a>\
                        </td> \
                    </tr>")
    $("#table-body").append(tableCell)
}

// DEPARTMENT MANAGEMENT
function appendDepartmentToTable(data){
    let departmentID = getNextDepartmentID();
    let tableCell = $("<tr> \
                        <td>"+`${departmentID}`+"</td> \
                        <td>"+`${data.name}`+"</td> \
                        <td> \
                            <a class='btn btn-sm btn-primary' href='?controller=department&action=view&id="+`${departmentID}`+"'>View</a>\
                        </td> \
                    </tr>")
    $("#table-body").append(tableCell)
}

// USER MANAGEMENT
function appendTaskToTable(data){
    let taskID = getNextTaskID();
    let tableCell = $("<tr> \
                        <td>"+`${taskID}`+"</td> \
                        <td>"+`${data.title}`+"</td> \
                        <td>"+`${data.status}`+"</td> \
                        <td>"+`${data.deadline}`+"</td> \
                        <td> \
                            <a class='btn btn-sm btn-primary' href='?controller=task&action=viewManager&id="+`${taskID}`+"'>View</a>\
                            <a class='btn btn-sm btn-success' href='?controller=task&action=indexHistory&id="+`${taskID}`+"'>History</a>\
                            <a class='btn btn-sm btn-danger' data-toggle='modal' data-target='#task-cancel-modal' data="+`${taskID}`+">Cancel</a>\
                        </td> \
                    </tr>")
    $("#table-body").append(tableCell)
}

// Cancel Task
function cancelTask(e){
    let id = parseInt(e.getAttribute('data'));
    $("#task-cancel-id").text(id);
}

function appointManager(e){
    tr = e.parentNode.parentNode;
    let id = parseInt(tr.getElementsByClassName('department-id')[0].innerText);
    let name = tr.getElementsByClassName('department-name')[0].innerText;

    $("#department-appoint-name").text(`${id}` + " - " + name);
    $("#department-appoint-name").attr("data-id", id);
}

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

function showError2(id, text) {
    $(id).text(text);
    $(id).fadeTo(2000, 500).slideUp(500, function() {
        $(id).slideUp(500);
    });
}

function success2(id, text){
    $(id).text(text);
    $(id).fadeTo(2000, 500).slideUp(500, function() {
        $(id).slideUp(500);
    });
}

function validateEmail(email){
        return String(email).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    }

function convertTime12to24(time12h){
    let [time, modifier] = time12h.split(" ");
    
    let [hours, minutes, seconds] = time.split(":");
    
    if (hours === "12") {
        hours = "00";
    }
    
    if (modifier === "PM") {
        hours = parseInt(hours, 10) + 12;
    }
    
    return `${hours}:${minutes}:${seconds}`;
}

function formatDate(dateTime){
    let [date, time] = dateTime.split("T");
    let formatTime = convertTime12to24(time);

    return `${date} ${formatTime}`;
}