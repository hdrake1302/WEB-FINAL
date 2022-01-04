<?php
$s = $data['task'];

$taskFile = Task::getFile($s->id);

$href = "";
$download = "";
$title = "title='NO FILE!'";
$disabled = "disabled";
$lateDisplay = "style = 'display: none;'";

if ($taskFile) {
    if (!empty($taskFile['file'])) {
        $file = $taskFile['file'];
        $file_name = $taskFile['file_name'];

        $href = "href='$file'";
        $download = "download='$file_name'";
        $title = "title='$file_name'";
        $disabled = "";
    }
}

$submitData = null;
if ($s->status == 'Waiting') {
    $submitData = Task::getSubmit($s->id);

    $isLate = False;
    if (Task::isLate($submitData->person_id, $s->id)) {
        $isLate = True;
        $lateDisplay = "";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="profile-info">
                <div class="info-header">Task Detail</div>
                <div class="info-body">
                    <ul class="info-list">
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Status:</div>
                            <div class="col-12 col-md-6 info-content text-success font-weight-bold" id="task-viewManager-status">
                                <?= $s->status ?>
                            </div>
                        </li>
                        <?php
                        ob_start();
                        ?>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Rating:</div>
                            <div class="col-12 col-md-6 info-content text-success font-weight-bold" id="task-viewManager-status">
                                <?= $s->rating ?>
                            </div>
                        </li>
                        <?php
                        $html = ob_get_clean();
                        if ($s->rating) {
                            echo $html;
                        }
                        ?>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">
                                ID:
                            </div>
                            <div class="col-12 col-md-6 info-content" id="task-id">
                                <?= $s->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Employee assigned:</div>
                            <div class="col-12 col-md-6 info-content" id="task-person-id">
                                <?= $s->staffID ?> - <?= User::getFullName($s->staffID) ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Title:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->title ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Description</div>
                            <div class="col-12 col-md-6 info-content">
                                <textarea class="info-content w-100" style="resize: none" rows="5" disabled><?= $s->description  ?></textarea>

                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Attachment:</div>
                            <div class="col-12 col-md-6 info-content">
                                <a <?= $href ?> <?= $download ?> <?= $title ?>>
                                    <button type="button" class="btn btn-primary mt-2" <?= $disabled ?>>
                                        <i class='bx bxs-download'></i> Click To Download
                                    </button>
                                </a>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">User Submit:</div>
                            <div class="col-12 col-md-6 info-content">
                                <button class="btn btn-primary mt-2" id="task-review-modal-btn" data-toggle="modal" data-target="#task-review-modal">
                                    <i class='bx bx-conversation'></i> Review
                                </button>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Date Created:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->date ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Deadline:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->deadline ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- USER SUBMIT MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="task-review-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Submit's Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype=" multipart/form-data">
                    <div class="form-group">
                        <label for="task-create-deadline">Date Submitted:</label>
                        <input class="form-control" id="task-review-date" type="type" value="<?php if ($submitData) echo $submitData->date ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="task-review-description">Description:</label>
                        <textarea class="form-control" name="task-create-description" rows="3" id="task-review-description" disabled><?php if ($submitData) echo $submitData->note ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="task-review-file">Attachment:</label>
                        <a href="<?php if ($submitData) echo $submitData->file ?>" download="<?php if ($submitData) echo $submitData->file_name ?>">
                            <button type="button" class="btn btn-primary mt-2">
                                <i class='bx bxs-download'></i> Click To Download
                            </button>
                        </a>
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
                <button type="button" class="btn btn-primary" id="task-accept-modal-btn" data-toggle="modal" data-target="#task-accept-modal">
                    Approve
                </button>

                <button type="button" class="btn btn-danger" id="task-reject-modal-btn" data-toggle="modal" data-target="#task-reject-modal">Reject</button>
            </div>
        </div>
    </div>
</div>

<!-- REJECT TASK MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="task-reject-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Task's Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to REJECT the task?</p>
                <form method="" action="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="task-reject-description">Description:</label>
                        <textarea class="form-control" name="task-reject-description" rows="3" id="task-reject-description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="task-reject-file">Attachment:</label>
                        <input type="file" class="form-control-file border" name="task-reject-file" id="task-reject-file">
                    </div>

                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>

                    <div class="form-group">
                        <div id="fail-alert-reject" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                            This type of file is not allowed
                        </div>
                        <div id="success-alert-reject" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                            This type of file is allowed
                        </div>
                    </div>
                </form>
            </div>
            <div id="fail-alert2" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                Success
            </div>
            <div id="success-alert2" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                Failure
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="task-reject-btn">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- APPROVE TASK MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="task-accept-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Task's Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-2">
                <p>Are you sure you want to APPROVE the task?</p>
                <form method="POST">
                    <div class="form-group">
                        <div class="alert alert-danger mt-2" <?= $lateDisplay ?>>
                            Nộp không đúng hạn!
                        </div>
                        <div class="form-group">
                            <label for="task-review-rating">Rate:</label>
                            <select class="form-control" id="task-review-rating">
                                <option value="default" selected disabled> -- please select an option -- </option>
                                <option value="Bad">Bad</option>
                                <option value="OK">OK</option>
                                <?php
                                if (!$isLate) echo "<option value='Good'>Good</option>"
                                ?>

                            </select>
                        </div>
                </form>
            </div>
            <div id="fail-alert-accept" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                FAIL
            </div>
            <div id="success-alert-accept" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                SUCCESS
            </div>
            <div class="modal-footer mb-5">
                <button type="button" class="btn btn-primary" id="task-accept-btn">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>