<ul class="nav-list">
    <li>
        <a href="?controller=login&action=view" data-toggle="tooltip" data-placement="right" title="Home">
            <i class='bx bx-home-alt'></i>
            <span class="links-name">Home</span>
        </a>
    </li>
    <li>
        <a href="?controller=user&action=viewProfile&id=<?= $_SESSION['id'] ?>" data-toggle="tooltip" data-placement="right" title="Profile">
            <i class="bx bxs-user-circle"></i>
            <span class="links-name">Profile</span>
        </a>
    </li>
    <li>
        <a href="#" data-toggle="tooltip" data-placement="right" title="Task Management">
            <i class="bx bx-task"></i>
            <span class="links-name">Tasks Management</span>
        </a>
    </li>
    <li>
        <a href="?controller=leave&action=index" data-toggle="tooltip" data-placement="right" title="Leaves Management">
            <i class="bx bx-run"></i>
            <span class="links-name">Leaves Management</span>
        </a>
    </li>
    <li>
        <a href="?controller=leave&action=index" data-toggle="tooltip" data-placement="right" title="Requests Management">
            <i class='bx bxs-user-voice'></i>
            <span class="links-name">Requests</span>
        </a>
    </li>
    <li>
        <a href="#" data-toggle="tooltip" data-placement="right" title="Users Management">
            <i class="bx bxs-face"></i>
            <span class="links-name">Users Management</span>
        </a>
    </li>
    <li id="res-log-out" class="d-block d-sm-none">
        <a href="#" data-toggle="tooltip" data-placement="right" title="">
            <span class="links-name"><a href="?controller=login&action=logout"><i class="bx bx-log-out"></i> Log out</a></span>
        </a>
    </li>
</ul>