<?php
$id = $_GET['id'];
include '../../Controller/ActionController.php';
$ac = new ActionController;
$res = $ac->xuly($id);
header('Location:../Layout/LienHe.php');
exit;

?>