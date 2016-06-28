<?php
session_start();
?>
<?php
if($_SESSION["user"] && $_SESSION["pass"])
{
?>


<html>
<head>
	<title>DANH MỤC SẢN PHẨM</title>
	<link href="../../IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../JS/jquery-2.2.4.min.js"></script>
	<script src="../../JS/bootstrap.min.js"></script>
	<link href="../../CSS/bootstrap.css" rel="stylesheet" />
	<link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
	<link href="../../CSS/Main.css" rel="stylesheet" >

</head>
<body>

	<?php 
		include 'MenuAdmin.php';
	 ?>
	<div class="col-sm-8" style="margin: 0% 20% 0% 20%">
		<ul class="nav nav-pills" role="tablist">
			<ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
				<center><li role="presentation" class="active"><h1 style="color: white">DANH SÁCH LOẠI SẢN PHẨM</h1></li></center>
			</ul>
		</ul>
		<br />
		<a data-toggle="modal" data-target="#frmthemmoi" href="#" class="btn btn-info">Thêm Mới</a>
		<br />
		<div class="col-sm-8" style="margin: 0% 20% 0% 20%">
			<table class="tblcln table table-striped">
				<thead>
				<tr>
					<th>STT</th>
					<th>Mã Loại</th>
					<th>Tên Loại</th>
					<th>Mã Danh Mục</th>
					<th>Tùy Chọn</th>
				</tr>
				</thead>

				<?php
				include '../../Controller/ActionController.php';

				$ac = new ActionController;
				$res = $ac->GetAllLoai();
				$list =$ac->GetAllDANHMUC();
				$i=1;
				while($row = $res->fetch_assoc()) {
					echo'
			 		<tr>
			 			<td>'.$i.'</td>
			 			<td>'.$row['MaLoaiSP'].'</td>
			 			<td>'.$row['TenLoaiSP'].'</td>
			 			<td>'.$row['DanhMuc_MaDM'].'</td>
			 			<td>
			 				<a href="Sualoai.php?id='.$row['MaLoaiSP'].'">Sửa </a>
			 				||
			 				<a href="../Action/Xoaloai.php?id='.$row['MaLoaiSP'].'"> Xóa</a>
			 			</td>
			 		</tr>
		 		';
					$i++;
				}
				?>
			</table>
		</div>
	</div>
	 <div class="modal fade" id="frmthemmoi" role="dialog">
	    <div class="modal-dialog">
	    
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Thêm Sản Phẩm Mới</h4>
	        </div>
	        <div class="modal-body">

	          <form action="../Action/ThemLoai.php" method="post">

	          	  <div>
		          	<label>Tên Loại </label>
		          	<br />
		          	<input type="text" name="loai" required />
	          	  </div>
				  <div>
					  <label>Danh Mục </label>
					  <br />
					  <select name="danhmuc">
						  <?php

						  $list = $ac->GetAllDANHMUC();
						  while($row = $list->fetch_assoc()) {
							  echo '
									<option value="'.$row['MaDM'].'">'.$row['TenDM'].'</option>
		          			';
						  }
						  ?>
					  </select>
				  </div>
	          	  <input type="Submit" value="Submit" class="btn btn-default" />
	          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	<?php
	}
	else
	{
		header("location:../../Login.php");
	}
	?>
</body>
</html>