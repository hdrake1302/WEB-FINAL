<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="profile-info">
                <div class="info-header mb-3">Tasks Management</div>
                <div class="info-body">
                    <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#task-createTask-modal">
                        <i class='bx bxs-add-to-queue'></i> Tạo Task
                    </button>
                    <div class="table-wrapper-scroll-y">
                        <table class="table table-bordered table-hover mt-4 table-responsive-md">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- CONTENT -->
                            <tbody id="table-body">
                                <?php
                                foreach ($data['tasks'] as $s) {
                                ?>
                                    <tr>
                                        <td><?= $s->id ?></td>
                                        <td><?= $s->title ?></td>
                                        <td class="text-success font-weight-bold"><?= $s->status ?></td>
                                        <td><?= $s->deadline ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="?controller=task&action=viewManager&id=<?= $s->id ?>">View</a>
                                            <a class="btn btn-sm btn-success" href="#">History</a>

                                        </td>
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
<!-- ADD TASK MODAL -->
<div class="modal" id="task-createTask-modal">
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
                        <label for="days">Choose an employee to assign:</label>
                        <select class="form-control" id="task-create-employee">
                            <?php
                            $users = User::getAllByDepartment(User::getDepartmentID($_SESSION['id']));
                            foreach ($users as $user) {
                                if ($user->id == $_SESSION['id']) {
                                    continue;
                                }
                            ?>
                                <option value="<?= $user->id ?>"><?= $user->id ?> - <?= User::getFullName($user->id) ?></option>

                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="task-create-deadline">Choose the deadline:</label>
                        <input class="form-control" id="task-create-deadline" type="datetime-local">
                    </div>
                    <div class="form-group">
                        <label for="task-create-title">Title:</label>
                        <input class="form-control" id="task-create-title" type="text">
                    </div>
                    <div class="form-group">
                        <label for="task-create-description">Description:</label>
                        <textarea class="form-control" name="task-create-description" rows="3" id="task-create-description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="task-create-file">Attachment:</label>
                        <input type="file" class="form-control-file border" name="task-create-file" id="task-create-file">
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
                <button type="submit" id="create-task-btn" name="submit" class="btn btn-sm btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>