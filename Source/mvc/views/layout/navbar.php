<?php
$role = $_SESSION['role'];
$taskAction = $role == 1 ? 'indexStaff' : 'indexManager';
?>

<ul class="nav-list">
    <?php
    ob_start();
    ?>
    <li>
        <a href="?controller=task&action=<?= $taskAction ?>" data-toggle="tooltip" data-placement="right" title="Task Management">
            <i class="bx bx-task"></i>
            <span class="links-name">Tasks</span>
        </a>
    </li>
    <li>
        <a href="?controller=leave&action=index" data-toggle="tooltip" data-placement="right" title="Leaves Management">
            <i class="bx bx-run"></i>
            <span class="links-name">Leaves</span>
        </a>
    </li>
    <?php
    $html = ob_get_clean();
    if ($role != 3) {
        echo $html;
    }
    ?>
    <?php
    ob_start();
    ?>
    <li>
        <a href="?controller=user&action=index" data-toggle="tooltip" data-placement="right" title="Users Management">
            <i class="bx bxs-face"></i>
            <span class="links-name">Users</span>
        </a>
    </li>
    <li>
        <a href="?controller=department&action=index" data-toggle="tooltip" data-placement="right" title="Department Management">
            <i class='bx bx-building-house'></i>
            <span class="links-name">Department</span>
        </a>
    </li>

    <?php
    $html = ob_get_clean();
    if ($role >= 3) {
        echo $html;
    }
    ?>
    <?php
    ob_start();
    ?>
    <li>
        <a href="?controller=leave&action=indexRequest" data-toggle="tooltip" data-placement="right" title="Requests Management">
            <i class='bx bxs-user-voice'></i>
            <span class="links-name">Requests</span>
        </a>
    </li>

    <?php
    $html = ob_get_clean();
    if ($role != 1) {
        echo $html;
    }
    ?>
    <li>
        <a href="?controller=user&action=viewProfile" data-toggle="tooltip" data-placement="right" title="Profile">
            <i class="bx bxs-user-circle"></i>
            <span class="links-name">Profile</span>
        </a>
    </li>
    <li id="res-log-out" class="d-block d-sm-none">
        <a href="#" data-toggle="tooltip" data-placement="right" title="">
            <span class="links-name"><a href="?controller=login&action=logout"><i class="bx bx-log-out"></i> Log out</a></span>
        </a>
    </li>
</ul>