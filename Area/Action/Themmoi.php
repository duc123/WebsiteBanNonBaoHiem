<?php 

	include '../../Controller/ActionController.php';
 	$ac = new ActionController;
 	$ten = $_POST["name"];
 	$chitiet = $_POST["detail"];
 	$gia = $_POST["gia"];
	$gianhap = $_POST['gianhap'];
 	$maloai = $_POST["loai"];
 	$hinh = $_POST["img"];
	$dvt= $_POST['dvt'];

 	$ac->ThemSanPham($ten,$chitiet,$gia,$maloai,$hinh,$gianhap,$dvt);
 	header('Location: ' . $_SERVER["HTTP_REFERER"] );
	exit;
 ?>