<?php

$maloai = $_POST['MaLoaiQuangCao'];
$ten = $_POST['TenLoaiQuangCao'];

include '../../Controller/ActionController.php';
$ac = new ActionController;
$ac->SuaLoaiTT($maloai , $ten);
header("Location:../Layout/LoaiTinTuc.php");
exit;
?>