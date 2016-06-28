<?php

    include '../../Controller/ActionController.php';
    $ac = new ActionController;

    $id = $_GET["MaLoaiQuangCao"];
    $ac->XoaLoaiTT($id);
    header('Location:../Layout/LoaiTinTuc.php');

?>