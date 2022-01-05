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
                            <div class="col-12 col-md-6 info-content" id="leave-request-id">
                                <?= $s->id ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Manager:</div>
                            <div class="col-12 col-md-6 info-content" id="leave-request-personID">
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
                            <div class="col-12 col-md-6 info-content" id="leave-request-daysRequested">
                                <?= $s->roomQuantity ?>
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
                <button type="button" class="btn btn-danger" id="modal-reject-request">
                    Confirm
                </button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>