<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>status</th>
            <th>date</th>
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
                <td><?= $s->status ?></td>
                <td><?= $s->date ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="?controller=user&action=view&id=<?= $s->id ?>">View</a> <a class="btn btn-sm btn-danger" href="#" onclick="confirmRemoval()">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>