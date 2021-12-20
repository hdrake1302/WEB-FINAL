<table class="table table-hover" border="1" style="width: 100%; text-align: center">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Specialty</td>
    </tr>
    <?php
    foreach ($data['teachers'] as $s) {
        ?>
        <tr>
            <td><a href="?controller=teacher&action=view&id=<?= $s->id ?>"><?= $s->id ?></a></td>
            <td><?= $s->name ?></td>
            <td><?= $s->specialty ?></td>
        </tr>
        <?php
    }
    ?>

</table>