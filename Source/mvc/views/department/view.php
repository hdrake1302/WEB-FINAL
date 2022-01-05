<?php
$s = $data['department'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="profile-info">
                <div class="info-header">Department's Detail</div>
                <div class="info-body">
                    <ul class="info-list">
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">
                                ID:
                            </div>
                            <div class="col-12 col-md-6 info-content" id="department-id">
                                <?= $s->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Manager:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->managerID ?> - <?= User::getFullName($s->managerID) ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Description:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->description ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Room Quantity:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->roomQuantity ?>
                            </div>
                        </li>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <button class="btn btn-primary m-2 w-100" data-toggle="modal" data-target="#department-edit-modal">
                                    Edit
                                </button>
                            </div>

                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="profile-info">
                <div class="info-header mb-3">Department's Users</div>
                <div class="info-body">
                    <div class="table-wrapper-scroll-y">
                        <table class="table table-bordered table-hover mt-4 table-responsive-md">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- CONTENT -->
                            <tbody id="table-body">
                                <?php
                                $users = User::getAllByDepartment($s->id);
                                if ($users) {
                                    foreach ($users as $user) {
                                ?>
                                        <tr>
                                            <td class="department-id"><?= $user->id ?></td>
                                            <td><?= User::getUsername($user->id) ?></td>
                                            <td class="department-name"><?= User::getFullName($user->id) ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->phone ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="appointManager(this)" data-toggle="modal" data-target="#department-appoint-modal">Appoint</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ACCEPT REQUEST MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="department-edit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Department's Edition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="department-add-name">Name:</label>
                        <input class="form-control" id="department-add-name" type="text" value="<?= Department::getName($s->id) ?>">
                    </div>
                    <div class="form-group">
                        <label for="department-add-description">Description:</label>
                        <textarea class="form-control" name="department-add-description" rows="3" id="department-add-description"><?= $s->description ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="department-add-quantity">Room Quantity:</label>
                        <input class="form-control" id="department-add-quantity" type="number" min="1" value="<?= $s->roomQuantity ?>">
                    </div>
                    <div class="form-group">
                        <div id="fail-alert" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                            Success
                        </div>
                        <div id="success-alert" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                            Failure
                        </div>
                    </div>
                </form>
            </div>
            <div class=" form-group">
                <div id="fail-alert" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                    Success
                </div>
                <div id="success-alert" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                    Failure
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="department-edit-btn">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- APPOINTMENT DEPARTMENT MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="department-appoint-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to APPOINT <span id="department-appoint-name" data-id="1">Kiều</span> to be the Manager?</p>
            </div>
            <div id="fail-alert2" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                Success
            </div>
            <div id="success-alert2" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                Failure
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="department-appoint-btn">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>