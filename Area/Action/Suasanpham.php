<?php 

	include '../../Controller/ActionController.php';
 	$ac = new ActionController;
 	$id = $_POST["id"];
 	$ten = $_POST["name"];
 	$chitiet = $_POST["detail"];
 	$gia = $_POST["gia"];
 	$maloai = $_POST["loai"];
 	$hinh = $_POST["img"];
	$gianhap = $_POST['gianhap'];
	$hinh = $_POST["img"];
	$dvt= $_POST['dvt'];
 	$ac->SuaSanPham($id,$ten,$chitiet,$gia,$maloai,$hinh,$gianhap,$dvt);
 	header("Location:../Layout/index.php");
	exit;
 ?>