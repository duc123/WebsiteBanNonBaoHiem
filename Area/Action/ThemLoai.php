<?php 


	$ten = $_POST['loai'];
	$dm = $_POST['danhmuc'];
	include '../../Controller/ActionController.php';
	$ac = new ActionController;

	$ac->ThemLoai($ten,$dm);
	header('Location: ' . $_SERVER["HTTP_REFERER"] );
	exit;


 ?>