<div class="text-primary text-center mb-3">
    <h3>INFO</h3>
</div>


<div>
    <?php
    foreach ($data['leaves'] as $s) {
    ?>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>ID: </b></div>
            <div class="col-sm-3 text-center"><?= $s->id ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Used_Leaves:</b></div>
            <div class="col-sm-3 text-center"><?= $s->used_leaves ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Unused_Leaves:</b></div>
            <div class="col-sm-3 text-center"><?= $s->total_leaves -  $s->used_leaves ?></div>
            <div class="col-sm-3"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-3 text-center"><b>Total_Leaves:</b></div>
            <div class="col-sm-3 text-center"><?= $s->total_leaves ?></div>
            <div class="col-sm-3"></div>
        </div>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <button data-toggle="modal" data-target="#leaveRequestModal" class="btn btn-primary btn-block mb-5 mt-5">Leave Request</button>
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="modal" id="leaveRequestModal">
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
                                <label for="days">Choose the number of days off:</label>
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
                                <label for="date">Choose the date:</label>
                                <input class="form-control" id="leave-date" name="date_created" type="date">
                            </div>
                            <div class="form-group">
                                <label for="leave-description">Reason:</label>
                                <textarea class="form-control" name="leave-description" rows="3" id="leave-description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">Evidence:</label>
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
                        <button type="submit" id="leave-request-btn" name="submit" class="btn btn-sm btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<div class="text-primary text-center mb-3">
    <h3>HISTORY</h3>
</div>

<table class="table-responsive-sm table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Description</th>
            <th>Days</th>
            <th>Date Created</th>
            <th>Date Wanted</th>
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
                <td><?= $s['status'] ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="?controller=user&action=view&id=<?= $s['id'] ?>">View</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>