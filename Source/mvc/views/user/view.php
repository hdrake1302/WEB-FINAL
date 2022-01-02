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
                            <div class="col-12 col-md-8 info-content" id="user-id">
                                <?= $user->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Username:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= User::getUsername($user->id) ?>
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
                        <li class="row">
                            <div class="col-12 col-md-4 info-label">Department:</div>
                            <div class="col-12 col-md-8 info-content">
                                <?= USER::getDepartmentName($user->department) ?>
                            </div>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <button class="btn btn-primary m-2 w-100" data-toggle="modal" data-target="#changePass-modal">
                                Reset Password
                            </button>
                        </div>
                    </div>
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
                <p>Are you sure you want to reset <?= $user->firstname ?>'s password?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="user-reset-password">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>