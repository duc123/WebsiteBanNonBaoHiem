<?php


$ten = $_POST['loai'];
include '../../Controller/ActionController.php';
$ac = new ActionController;

$ac->ThemLoaiTin($ten);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;


?>