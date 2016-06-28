<html>
<head>
	<title>SỬA THÔNG TIN SẢN PHẨM</title>
	<link href="../../IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../JS/jquery-2.2.4.min.js"></script>
	<script src="../../JS/bootstrap.min.js"></script>
	<link href="../../CSS/bootstrap.css" rel="stylesheet" />
	<link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
</head>
<body>
	<?php 
		include 'MenuAdmin.php';
	 ?>

	 <?php 

	 	include '../../Controller/ActionController.php';
	 	$ac = new ActionController;
	 	$temp = $_GET["id"];
	 	$res = $ac->DetailoneProduct($temp);
	 	$list = $ac->GetLoaiSanPham();

		while($row = $res->fetch_assoc()) {
		echo'
			<div class="col-sm-12">
	 		<form action="../Action/Suasanpham.php" method="post">
	 		<input type="hidden" name="id" value="'.$row['MaSanpham'].'" />
			  <div>
				<label>Tên </label>
				<br />
				<input type="text" name="name" value="'.$row['TenSanpham'].'" required />
			  </div>
			  <div>
				<label>Thông Tin </label>
				<br />
				<input type="text" name="detail" value="'.$row['ThongTin'].'" required />
			  </div>
			  <div>
				<label>Giá Bán</label>
				<br />
				<input type="number" name="gia" min="1" value="'.$row['GiaSP'].'" required />
			  </div>
			  <div>
				<label>Giá Nhập</label>
				<br />
				<input type="number" name="gianhap" min="1" value="'.$row['GiaNhap'].'" required />
			  </div>
			  <div>
				<label>Giá Nhập</label>
				<br />
				<input type="text" name="dvt" value="'.$row['DonViTinh'].'" required />
			  </div>
      	      <div>
				<label>Loại </label>
				<br />
				<select name="loai">
					<option value="'.$row['LoaiSP_MaLoaiSP'].'">'.$row['LoaiSP_MaLoaiSP'].'</option>';
					while($rows = $list->fetch_assoc()) {
						echo '
								<option value="'.$rows['MaLoaiSP'].'">'.$rows['TenLoaiSP'].'</option>
						';
					}
					echo'
						 </select>
				  </div>
				  <div>
					<label>Hình Ảnh </label>
						<br />
						<select class="sls" name="img">
							<option value="'.$row['HInhAnh'].'">'.$row['HInhAnh'].'</option>
							<br/>
							<br />
					';

					$directory = "../../views/Contents/images/";
					$images = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
					foreach($images as $image)
					{
						$loc1 = strstr($image , "views/Contents/images/");
						$loc2 = strstr($loc1 , "/");
						$loc3 = substr($loc2 ,1);

						echo '	          				
							<option value="'.$loc3.'">
								'.$loc3.'
							</option>		
	          			';
					}
					echo'
					</select>
					</div>
				 <div class="col-sm-12">
					 <br />
					  <img class="img-responsive" id="imgshow" src="../../IMG/ICON_HOME.jpg">
						<br />
						<div class="col-sm-12">
							<input type="Submit" value="Hoàn tất" class="btn btn-success" />
						</div>
				 </div>
				 </div>
				 
		</form>
		<br />
		<br />
		  ';
	}
	?>
  	<script type="text/javascript">
		var str = "";
		str +="../../views/Contents/images/" + $(".sls option:selected").text() + " ";
		$('#imgshow').attr('src',str);

  		$('.sls').change(function() {
  			var str = "";
		    $(".sls option:selected").each(function() {
		      str +="../../views/Contents/images/" + $(this).text() + " ";
		    });
		    $('#imgshow').attr('src',str);
  		});

  	</script>
</body>
</html>