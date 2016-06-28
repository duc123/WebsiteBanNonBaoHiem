<?php
    $id = $_GET['id'];
    include '../../Controller/ActionController.php';
    $now = getdate();
    $time = $now["year"] . "/" . $now["mon"] . "/" . $now["mday"] ;
    $ac = new ActionController;
    $res = $ac->capnhathd($id,$time);
    header('Location:../Layout/Hoadon.php');
    exit;

?>