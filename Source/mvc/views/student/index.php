<table class="table table-hover" border="1" style="width: 100%; text-align: center">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Age</td>
    </tr>
    <?php
        foreach ($data['students'] as $s) {
            ?>
                <tr>
                    <td><a href="?controller=student&action=view&id=<?= $s->id ?>"><?= $s->id ?></a></td>
                    <td><a href="?controller=student&action=view&id=<?= $s->id ?>"><?= $s->name ?></a></td>
                    <td><a href="?controller=student&action=view&id=<?= $s->id ?>"><?= $s->age ?></a></td>
                </tr>
            <?php
        }
    ?>

</table>