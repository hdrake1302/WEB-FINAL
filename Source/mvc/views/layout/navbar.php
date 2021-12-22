<?php
$role = $_SESSION['role'];
?>

<ul class="nav-list">
    <li>
        <a href="?controller=login&action=view" data-toggle="tooltip" data-placement="right" title="Home">
            <i class='bx bx-home'></i>
            <span class="links-name">Home</span>
        </a>
    </li>
    <li>
        <a href="#" data-toggle="tooltip" data-placement="right" title="Profile">
            <i class="bx bxs-user-circle"></i>
            <span class="links-name">Profile</span>
        </a>
    </li>
    <?php
    ob_start();
    ?>
    <li>
        <a href="?controller=task&action=index" data-toggle="tooltip" data-placement="right" title="Task Management">
            <i class="bx bx-task"></i>
            <span class="links-name">Task Management</span>
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
        <a href="#" data-toggle="tooltip" data-placement="right" title="Leaves Management">
            <i class="bx bx-run"></i>
            <span class="links-name">Leaves Management</span>
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
            <span class="links-name">Users Management</span>
        </a>
    </li>
    <?php
    $html = ob_get_clean();
    if ($role == 3) {
        echo $html;
    }
    ?>
</ul>