<?php $s = $data['leave_request'];
$file = $s['file'];
$file_name = $s['file_name'];

$href = "href='$file'";
$download = "download='$file_name'";
$title = "title='$file_name'";
$disabled = "";

if (empty($file) || $file === null) {
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
                <div class="info-header">Request Detail</div>
                <div class="info-body">
                    <ul class="info-list">
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">
                                ID:
                            </div>
                            <div class="col-12 col-md-6 info-content" id="leave-request-id">
                                <?= $s['id'] ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Person ID:</div>
                            <div class="col-12 col-md-6 info-content" id="leave-request-personID">
                                <?= $s['leave_id'] ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Full Name:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= User::getFullName($s['leave_id']) ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Number of Days Requested:</div>
                            <div class="col-12 col-md-6 info-content" id="leave-request-daysRequested">
                                <?= $s['days'] ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Description</div>
                            <div class="col-12 col-md-6 info-content">
                                <textarea class="info-content w-100" style="resize: none" rows="5" disabled><?= $s['description']  ?></textarea>

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
                                <?= $s['date_created'] ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Date Wanted:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s['date_wanted'] ?>
                            </div>
                        </li>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary m-2 w-100" data-toggle="modal" data-target="#accept-request-modal">
                                    Accept
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <button class="btn btn-danger m-2 w-100" data-toggle="modal" data-target="#reject-request-modal">
                                    Reject
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
<div class="modal" tabindex="-1" role="dialog" id="accept-request-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to ACCEPT the request?</p>
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
                <button type="button" class="btn btn-primary" id="leave-accept-request">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- REJECT REQUEST MODAL -->
<div class="modal" tabindex="-1" role="dialog" id="reject-request-modal">
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
                <button type="button" class="btn btn-danger" id="leave-reject-request">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>