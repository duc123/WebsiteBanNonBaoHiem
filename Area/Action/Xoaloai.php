<?php 

		$id = $_GET['id'];
		include '../../Controller/ActionController.php';
	 	$ac = new ActionController;
	 	$res = $ac->XoaLoai($id);

	 	header('Location: ' . $_SERVER["HTTP_REFERER"] );
		exit;
		
 ?>