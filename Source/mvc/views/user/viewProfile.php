<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4 text-center">
            <div class="
                profile-img
                d-flex
                justify-content-center
                align-items-center
              ">
                <img src="<?= $user->avatar ?>" alt="Avatar image" />
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="profile-info">
                <div class="info-header">About</div>
                <div class="info-body">
                    <ul class="info-list">
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">ID:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= $user->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">First name:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= $user->firstname ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Last name:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= $user->lastname ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Email:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= $user->email ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Phone Number:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= $user->phone ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Role:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= USER::getRoleName(USER::getRole($user->id)) ?>
                            </div>
                        </li>
                        <?php
                        ob_start();
                        ?>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Department:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= USER::getDepartmentName($user->department) ?>
                            </div>
                        </li>

                        <?php
                        $html = ob_get_clean();
                        if (User::getRole($user->id) != 3) {
                            echo $html;
                        }
                        ?>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <button class="btn btn-success m-2 w-100" data-toggle="modal" data-target="#changePass-modal">
                                    Change Password
                                </button>
                            </div>
                            <div class="col-12 col-md-3">
                                <button class="btn btn-primary m-2 w-100" data-toggle="modal" data-target="#upload-modal">
                                    Change Avatar
                                </button>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CHANGE PASSWORD MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="changePass-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to change your password?</p>
            </div>
            <div class="modal-footer">
                <a href="?controller=user&action=confirmChange&id=<?= $user->id ?>">
                    <button type="button" class="btn btn-primary" id="confirm-change">
                        Confirm
                    </button>
                </a>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- UPLOAD MODAL -->
<div class="modal" id="upload-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="document">Choose your picture to upload: </label>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="document" />
                            <label class="custom-file-label" for="document">Choose file</label>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>

                    <div class="form-group">
                        <div id="fail-alert" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                            This type of file is not allowed
                        </div>
                        <div id="success-alert" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                            This type of file is allowed
                        </div>
                    </div>
                </form>
            </div>
            <div class=" modal-footer">
                <button class="btn btn-primary" id="upload-btn">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>

</script>