<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="profile-info">
                <div class="info-header mb-3">Tasks Management</div>
                <div class="info-body">
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
                                            <a class="btn btn-sm btn-primary" href="?controller=task&action=viewStaff&id=<?= $s->id ?>">View</a>
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