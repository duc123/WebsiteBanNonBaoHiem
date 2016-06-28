<?php 

$name = $_POST['us'];
$pass = $_POST['ps'];

if($name == "khoa" && $pass == "12345")
{
	session_start();
	$_SESSION['us'] = "khoa";
	print_r($_SESSION['us']);
}
else{
	header('Location:../../Index.php');
}

?>