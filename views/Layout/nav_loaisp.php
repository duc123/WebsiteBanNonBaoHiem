<?php
//include_once $_SERVER['DOCUMENT_ROOT'] . '/WebsiteBanHang/setup.php';

$loaiSp = $_SESSION['loai_sp'];
?>

<div class="col-md-3">
    <p class="lead">Safety</p>
    <div class="list-group">
    <?php if(!empty($loaiSp)){ ?>
        <?php foreach ($loaiSp as $loai) { ?>
            <a href="#" class="list-group-item"> <?php echo $loai->getTenloaisp(); ?></a>
        <?php } ?>
    <?php } ?>
    </div>
</div>