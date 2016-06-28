<html>
<head>
    <title>S?A DANH M?C S?N PH?M</title>
    <link href="../../IMG/ICON_HOME.jpg" rel="icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php

$id = $_GET['MaLoaiQuangCao'];
include '../../Controller/ActionController.php';
$ac = new ActionController;
$res = $ac->GetoneLoai($id);

while($row = $res->fetch_assoc()) {
    echo'
	 		 <form action="../Action/SuaLoaiTinTuc.php" method="post">
	 		 	<input type="hidden" name="MaLoaiQuangCao" value="'.$row['MaLoai'].'" required />
	          	  <div>
		          	<label>Tên Lo?i </label>
		          	<br />
		          	<input type="text" name="TenLoaiQuangCao" value="'.$row['TenLoai'].'" required />
	          	  </div>

	          	  <input type="Submit" value="Submit" class="btn btn-default" />
	          </form>
	 		';
}


?>

</body>
</html>