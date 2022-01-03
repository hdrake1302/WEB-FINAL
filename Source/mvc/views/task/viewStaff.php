<?php
$s = $data['task'];

$taskFile = Task::getFile($s->id);

if ($taskFile == null || !empty($taskFile['file'])) {
    $file = $taskFile['file'];
    $file_name = $taskFile['file_name'];

    $href = "href='$file'";
    $download = "download='$file_name'";
    $title = "title='$file_name'";
    $disabled = "";
} else {
    $href = "";
    $download = "";
    $title = "title='NO FILE!'";
    $disabled = "disabled";
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
                            <div class="col-12 col-md-6 info-label">
                                ID:
                            </div>
                            <div class="col-12 col-md-6 info-content" id="task-id">
                                <?= $s->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Task assigner:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= User::getFullName($s->managerID) ?>
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
                            <div class="col-12 col-md-6 info-label">Status:</div>
                            <div class="col-12 col-md-6 info-content text-success font-weight-bold" id="task-viewStaff-status">
                                <?= $s->status ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Attachment:</div>
                            <div class="col-12 col-md-6 info-content">
                                <a <?= $href ?> <?= $download ?> <?= $title ?>>
                                    <button class="btn btn-primary mt-2 <?= $disabled ?>">
                                        <i class='bx bxs-download'></i> Click To Download
                                    </button>
                                </a>
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
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary m-2 w-100" data-toggle="modal" data-target="#task-start-modal">
                                    Start
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="btn btn-success m-2 w-100" id="task-submit-modal-btn" data-toggle="modal" data-target="#task-submit-modal">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ACCEPT REQUEST MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="task-start-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to START the task?</p>
            </div>
            <div class="form-group">
                <div id="fail-alert" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                    Success
                </div>
                <div id="success-alert" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                    Failure
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="task-start-btn">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- REJECT REQUEST MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="task-submit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to REJECT the request?</p>
            </div>
            <div id="fail-alert2" class="alert alert-danger mt-2" style="opacity: 0; display:none">
                Success
            </div>
            <div id="success-alert2" class="alert alert-success mt-2" style="opacity: 0; display:none;">
                Failure
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="task-submit-btn">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>