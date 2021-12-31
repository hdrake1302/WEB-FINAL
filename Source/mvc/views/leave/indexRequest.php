<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-8 offset-md-2">
            <div class="profile-info">
                <div class="info-header mb-3">Requests Management</div>
                <div class="info-body">
                    <table class="table-responsive-sm table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full name</th>
                                <th>Number of Days Requested</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <!-- CONTENT -->
                        <tbody id="table-body">
                            <?php
                            foreach ($data['leave_requests'] as $s) {
                            ?>
                                <tr>
                                    <td><?= $s['id'] ?></td>
                                    <td><?= User::getFullName($s['leave_id']) ?></td>
                                    <td><?= $s['days'] ?></td>
                                    <td><?= $s['date_created'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="?controller=leave&action=viewRequest&id=<?= $s['id'] ?>">View</a>
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