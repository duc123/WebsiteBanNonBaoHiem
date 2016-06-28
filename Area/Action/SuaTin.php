<?php

include '../../Controller/ActionController.php';
$ac = new ActionController;

$id = $_POST["MaQuangCao"];
$ten = $_POST["Tieude"];
$chitiet = $_POST["NoiDung"];
$ngaydang =$_POST["NgayDang"];
$link = $_POST["Link"];
$maloai = $_POST["loai"];
$hinh = $_POST["img"];
$ac->SuaTinTuc($id,$chitiet,$ten,$ngaydang,$link,$hinh,$maloai);
header("Location:../Layout/TinTuc.php");
exit;
?>