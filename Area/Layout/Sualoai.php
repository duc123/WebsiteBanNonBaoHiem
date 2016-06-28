<html>
<head>
	<title>SỬA DANH MỤC SẢN PHẨM</title>
	<link href="../../IMG/ICON_HOME.jpg" rel="icon">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php 

		$id = $_GET['id'];
		include '../../Controller/ActionController.php';
	 	$ac = new ActionController;
	 	$res = $ac->GetoneLoai($id);
		$list =$ac->GetAllDANHMUC();

	 	while($row = $res->fetch_assoc()) {
	 		echo'
	 		 <form action="../Action/SuaLoai.php" method="post">
	 		 	<input type="hidden" name="maloai" value="'.$row['MaLoaiSP'].'" required />
	          	  <div>
		          	<label>Tên Loại </label>
		          	<br />
		          	<input type="text" name="loai" value="'.$row['TenLoaiSP'].'" required />
		          	<br />
		          	<label>Danh Mục </label>
		          	<br />
					<select name="danhmuc">
						<option value="'.$row['DanhMuc_MaDM'].'">'.$row['DanhMuc_MaDM'].'</option>';
						while($rows1 = $list->fetch_assoc()) {
							echo '
											<option value="'.$rows1['MaDM'].'">'.$rows1['TenDM'].'</option>
									';
						}
						echo'
						 </select>
				  </div>
	          	  </div>

	          	  <input type="Submit" value="Submit" class="btn btn-default" />
	          </form>
	 		';
	 	}
	 ?>
</body>
</html>