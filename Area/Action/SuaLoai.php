<?php 

	$maloai = $_POST['maloai'];
	$ten = $_POST['loai'];
	$dm = $_POST['danhmuc'];

	include '../../Controller/ActionController.php';
 	$ac = new ActionController;
	$ac->SuaLoai($maloai,$ten,$dm);
	header("Location:../Layout/vloaisanpham.php");
	exit;
 ?>