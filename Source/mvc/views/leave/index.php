<?php
$s = $data['leave'];
?>



<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 mb-5">
            <div class="profile-info">
                <div class="info-header">Leaves Information</div>
                <div class="info-body">
                    <ul class="info-list">
                        <li class="row">
                            <div class="col-6 info-label">
                                ID:
                            </div>
                            <div class="offset-4 col-2 info-content" id="personID">
                                <?= $s->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6 info-label">Used_Leaves:</div>
                            <div class="offset-4 col-2 info-content">
                                <?= $s->used_leaves ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6 info-label">Unused_Leaves:</div>
                            <div class="offset-4 col-2 info-content">
                                <?= $s->total_leaves - $s->used_leaves ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-6 info-label">Total_Leaves:</div>
                            <div class="offset-4 col-2 info-content">
                                <?= $s->total_leaves ?>
                            </div>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-12 col-md-4 offset-md-4">
                            <button data-toggle="modal" data-target="#leave-request-modal" class="btn btn-primary btn-block" id="leave-request-btn">Leave Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LEAVE REQUEST MODAL -->
    <div class="modal" id="leave-request-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Leave Application</h3>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <form method="" action="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="leave-days">Choose the number of days off:</label>
                            <select class="form-control" number="leave-days" id="leave-days">
                                <?php
                                $unused_leaves = $s->total_leaves - $s->used_leaves;
                                for ($x = 1; $x <= $unused_leaves; $x++) {
                                ?>
                                    <option value="<?= $x ?>"> <?= $x ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leave-date">Choose the date:</label>
                            <input class="form-control" id="leave-date" name="date_created" type="date">
                        </div>
                        <div class="form-group">
                            <label for="leave-description">Reason:</label>
                            <textarea class="form-control" name="leave-description" rows="3" id="leave-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="leave-file">Evidence:</label>
                            <input type="file" class="form-control-file border" name="leave-file" id="leave-file">
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
                <div class="modal-footer">
                    <button type="submit" id="create-request-btn" name="submit" class="btn btn-sm btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="profile-info">
                <div class="info-header mb-3">Leaves' History</div>
                <div class="info-body">
                    <div class="table-wrapper-scroll-y">
                        <table class="table table-bordered table-hover mt-4 table-responsive-md">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Days</th>
                                    <th>Date Created</th>
                                    <th>Date Wanted</th>
                                    <th>Date Response</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <!-- CONTENT -->
                            <tbody id="table-body">
                                <?php
                                foreach ($data['leaves_record'] as $s) {
                                ?>
                                    <tr>
                                        <td><?= $s['id'] ?></td>
                                        <td><?= $s['description'] ?></td>
                                        <td><?= $s['days'] ?></td>
                                        <td><?= $s['date_created'] ?></td>
                                        <td><?= $s['date_wanted'] ?></td>
                                        <td><?= $s['date_response'] ?></td>
                                        <td class="leave-status"><?= $s['status'] ?></td>
                                    </tr>
                                <?php
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