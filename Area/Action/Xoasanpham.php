<?php 

	include '../../Controller/ActionController.php';
	$ac = new ActionController;

 	$id = $_GET["id"];
 	$ac->XoaSanPham($id);
	header('Location:../Layout/index.php');


 ?>