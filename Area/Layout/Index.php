<?php
	session_start();
?>
<?php
	if($_SESSION["user"] && $_SESSION["pass"])
{
?>
<html>
<head>

	<title>ADMIN HOME</title>
	<meta charset="utf-8">
	<link href="../../IMG/ICON_HOME.jpg" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="../../JS/jquery-2.2.4.min.js"></script>
	<script src="../../JS/bootstrap.min.js"></script>
	<link href="../../CSS/bootstrap.css" rel="stylesheet" />
	<link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
	<link href="../../CSS/Main.css" rel="stylesheet" >
</head>
<body>

	<?php 
		include 'MenuAdmin.php';
		include_once '../../Model/Dbcontext.php';
		$db = new Database;
		$db->ketnoi();
		include '../../Controller/ActionController.php';
		$ac = new ActionController;
		$page = filter_input(INPUT_GET, 'page');

		if ( !isset($_GET['page']) )
		{
			$page = 0 ;
		}

		if(!isset($_POST['bien']))
		{
			$res = $db->GetSanPham($page);
		}
		else
		{
			$res = $ac->timkiemsap($_POST['bien']);
		}


	 ?>
	<div class="col-sm-12">
		<div class="modal fade" id="frmthemmoi" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">Thoát</button>
						<h1 class="modal-title">Thêm mới sản phẩm</h1>
					</div>
					<div class="modal-body">
						<form action="../Action/Themmoi.php" method="post">
							<div>
								<label>Tên </label>
								<br />
								<input type="text" name="name" required />
							</div>
							<div>
								<label>Chi Tiết </label>
								<br />
								<input type="text" name="detail" required />
							</div>
							<div>
								<label>Giá Nhập </label>
								<br />
								<input type="number" name="gianhap" min="1" required />
							</div>
							<div>
								<label>Giá Bán </label>
								<br />
								<input type="number" name="gia" min="1" required />
							</div>
							<div>
								<label>Đơn Vị Tính </label>
								<br />
								<input type="text" name="dvt" min="1" required />
							</div>
							<div>
								<label>Loại </label>
								<br />
								<select name="loai">
									<?php

									$list = $ac->GetLoaiSanPham();
									while($row = $list->fetch_assoc()) {
										echo '
									<option value="'.$row['MaLoaiSP'].'">'.$row['TenLoaiSP'].'</option>
		          			';
									}
									?>
								</select>
							</div>
							<div>
								<label>Hình Ảnh </label>
								<br />
								<select class="sls" name="img">
									<?php
									$directory = "../../views/Contents/images/";
									$images = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
									$temp = "col-md-4";

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
									?>
								</select>
							</div>
							<img class="img-responsive" id="imgshow" src="../../IMG/ICON_HOME.jpg">
							<br />
							<input type="Submit" value="Thêm" class="btn btn-default" />
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-6">
			<ul class="nav nav-pills" role="tablist">
				<ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
					<center><li role="presentation" class="active"><h1 style="color: white">DANH SÁCH SẢN PHẨM</h1></li></center>
				</ul>
			</ul>
		</div>
		<form method="post" action="Index.php">
			<div class="form-group frmseach row">
				<div class="col-sm-4" >
					<input type="text" class="form-control" placeholder="Nhập mã sản phẩm hoặc tên sản phẩm" name="bien" required />
				</div>
				<div class="col-sm-2">
					<input type="submit" class="btn btn-success" value="Seach" />
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-12">
			<table class="tblcln table table-striped">
				<thead>
				<tr>
					<th>STT</th>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Thông tin</th>
					<th>Giá nhập</th>
					<th>Giá bán</th>
					<th>Đơn vị tính</th>
					<th>Mã loại</th>
					<th>Hình ảnh</th>
					<th>Tùy chọn</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				while($row = $res->fetch_assoc()) {
					echo'
						<tr>
							<td>'.$i.'</td>
							<td>'.$row['MaSanpham'].'</td>
							<td>'.$row['TenSanpham'].'</td>
							<td>'.$row['ThongTin'].'</td>
							<td>'.$row['GiaNhap'].'</td>
							<td>'.$row['GiaSP'].'</td>
							<td>'.$row['DonViTinh'].'</td>
							<td>'.$row['LoaiSP_MaLoaiSP'].'</td>
							<td>'.$row['HInhAnh'].'</td>
							<td>
								<a href="Suasanpham.php?id='.$row['MaSanpham'].'">Sửa</a>
								||
								<a href="../Action/Xoasanpham.php?id='.$row['MaSanpham'].'">Xóa</a>
							</td>
						</tr>
					';
					$i++;
				}
				?>
				</tbody>
			</table>
		</div>

		<div class="col-sm-12">
			<?php
			$sotrang = $db->GetSoTrangsanpham();
			if($sotrang==1 || $sotrang<1)
			{
			}
			else
			{
				echo '<div class="btn  btn-primary">Trang</div>';
                for ( $page = 0; $page < $sotrang; $page ++ ) {
                    $te =$page;
                    echo "<a class='btn  btn-primary' href='Index.php?page={$te}'>".($page+1)."</a>";
                }
			}

			?>
		</div>
	</div>
	<script type="text/javascript">
		$('.sls').change(function() {
			var str = "";
			$(".sls option:selected").each(function() {
				str +="../../views/Contents/images/" + $(this).text() + " ";
			});
			$('#imgshow').attr('src',str);
		});
	</script>

	<?php
	}
	else
	{
		header("location:../../Login.php");
	}
	?>
</body>
</html>