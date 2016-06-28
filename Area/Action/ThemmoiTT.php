<?php

include '../../Controller/ActionController.php';
$ac = new ActionController;

$ten = $_POST["tieude"];
$chitiet = $_POST["noidung"];
$ngay = $_POST['ngay'];
$link = $_POST["link"];
$hinh = $_POST["img"];
$maloai = $_POST["loai"];
$ac->ThemTinTuc($ten,$chitiet,$ngay,$link,$maloai,$hinh);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>