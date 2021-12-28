<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
        </tr>
    </thead>
    <!-- CONTENT -->
    <tbody id="table-body">
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->firstname ?></td>
            <td><?= $user->lastname ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->phone ?></td>
            <td><?= User::getDepartmentName($user->department) ?></td>
        </tr>
    </tbody>
</table>