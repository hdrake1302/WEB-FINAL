<?php
if ($_SESSION['avatar'] !== null) {
    $src = strval($_SESSION['avatar']);
} else {
    $src = "https://www.nj.com/resizer/zovGSasCaR41h_yUGYHXbVTQW2A=/1280x0/smart/cloudfront-us-east-1.images.arcpublishing.com/advancelocal/SJGKVE5UNVESVCW7BBOHKQCZVE.jpg";
}
?>
<div class="sidebar">
    <div class="avatar">
        <img src=<?= $src ?> alt="Avatar" class="avatar-img" />
        <h4 class="avatar-name"><?= $_SESSION['fullname'] ?></h4>
    </div>
    <div class="menu">
        <i class="bx bx-menu d-none d-sm-inline-block" id="menu-btn"></i>
    </div>
    <?php include_once('navbar.php') ?>
</div>