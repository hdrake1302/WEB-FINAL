<!-- VIEW DETAIL OF HISTORY -->
<?php
$s = $data['history'];

$href = "";
$download = "";
$title = "title='NO FILE!'";
$disabled = "disabled";
$lateDisplay = "style = 'display: none;'";

if ($s->file) {
    if (!empty($s->file)) {
        $file = $s->file;
        $file_name = $s->file_name;

        $href = "href='$file'";
        $download = "download='$file_name'";
        $title = "title='$file_name'";
        $disabled = "";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="profile-info">
                <div class="info-header">History's Detail</div>
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
                                <?= Task::getRating($s->task_id) ?>
                            </div>
                        </li>
                        <?php
                        $html = ob_get_clean();
                        if ($s->status == "Completed") {
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
                            <div class="col-12 col-md-6 info-label">Person</div>
                            <div class="col-12 col-md-6 info-content" id="task-person-id">
                                <?= $s->person_id ?> - <?= User::getFullName($s->person_id) ?>
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-12 col-md-6 info-label">Description</div>
                            <div class="col-12 col-md-6 info-content">
                                <textarea class="info-content w-100" style="resize: none" rows="5" disabled><?= $s->note  ?></textarea>

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
                            <div class="col-12 col-md-6 info-label">Date Created:</div>
                            <div class="col-12 col-md-6 info-content">
                                <?= $s->date ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>