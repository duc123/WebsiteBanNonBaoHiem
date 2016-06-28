<?php 

	include '../../Controller/ActionController.php';
	$ac = new ActionController;

 	$id = $_GET["id"];
 	$ac->XoaSanPham($id);
// 	header('Location: ' . $_SERVER["HTTP_REFERER"] );
	//exit;


 ?>