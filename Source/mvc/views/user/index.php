<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    </thead>
    <!-- CONTENT -->
    <tbody id="table-body">
        <?php
        foreach ($data['users'] as $s) {
                ?>
                    <tr>
                        <td><?= $s->id ?></td>
                        <td><?= $s->lastname . $s->firstname?></td>
                        <td><?= $s->email ?></td>
                        <td><?= $s->phone ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="?controller=user&action=view&id=<?=$s->id?>">View</a>  <a class="btn btn-sm btn-danger" href="#" onclick="confirmRemoval()">Delete</a>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>
