<?php
session_start();
?>
<?php
if($_SESSION["user"] && $_SESSION["pass"])
{
	?>
<html>
<head>
	<title>ĐƠN HÀNG</title>
	<link href="../../IMG/ICON_HOME.jpg" rel="icon">
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
		include '../../Controller/ActionController.php';
		$ac = new ActionController;
		$page = $_GET['page'];
		$tem =null;
		$sotrang =0;
		if ( !$_GET['page'] )
		{
			$page = 0 ;
		}
		if(!isset($_POST['bien']))
		{
			if($_GET['tt']==2)
			{
				$res = $ac->hoadon($page);
				$sotrang = $ac->GetSoTranghoadon();
				$tt=2;
				$tem = 'DANH SÁCH ĐƠN HÀNG';
			}
			else
			{
				if($_GET['tt']==1)
				{
					$res = $ac->hoadondagiao($page);
					$sotrang = $ac->SoTrangHoaDonGiao();
					$tt=1;
					$tem = 'DANH SÁCH ĐƠN HÀNG ĐÃ GIAO';
				}
				else {
					if ($_GET['tt'] == 0) {
						$res = $ac->hoadonchuagiao($page);
						$sotrang = $ac->SoTrangHoaDonChuaGiao();
						$tt = 0;
						$tem = 'DANH SÁCH ĐƠN HÀNG CHƯA GIAO';
					}
					else
					{
						if($_GET['tt']==3)
						{
							$res = $ac->hoadontrongngay($page);
							$sotrang = $ac->SoTrangHoaDontrongngay();
							$tt = 3;
							$tem = 'DANH SÁCH ĐƠN HÀNG HÔM NAY';
						}
					}
				}

			}
		}
		else
		{
			$res = $ac->timkiemhodon($_POST['bien']);
			$tem = 'KẾT QUẢ TÌM KIẾM';
		}
	 ?>
	<div class="col-sm-12">
		<div class="col-sm-6">
			<ul class="nav nav-pills" role="tablist">
				<ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
					<center><li role="presentation" class="active"><h1 style="color: white"><?php echo $tem ?></h1></li></center>
				</ul>
			</ul>
		</div>
		<div class="col-sm-6" style="margin-top: 2%">
			<form method="post" action="Hoadon.php">
				<div class="form-group frmseach row">
					<div class="col-sm-6" >
						<input type="text" class="form-control" placeholder="Nhập số phiếu hoặc tên khách hàng" name="bien" required />
					</div>
					<div class="col-sm-2">
						<input type="submit" class="btn btn-success" value="Seach" />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-12">
		<table class="tblcln table table-striped">
			<thead>
			<tr>
				<th>STT</th>
				<th>Số HD</th>
				<th>Mã khách hàng</th>
				<th>Tên khách hàng</th>
				<th>Ngày đặt hàng</th>
				<th>Ngày giao hàng</th>
				<th>Điện thoại</th>
				<th>Địa chỉ</th>
				<th>Tiền</th>
				<th>Tình trạng</th>
				<th>Chi tiết</th>
				<th>Xóa</th>
				<th>Cập nhật</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if($res != null)
			{
			$i=1;
			while($row = $res->fetch_assoc())
				{
					echo'
					<tr>
					<td>'.$i.'</td>
					<td>'.$row['SoPhieu'].'</td>
					<td>'.$row['KhachHang_MaKH'].'</td>
					<td>'.$row['TenNguoiNhan'].'</td>
					<td>'.$row['NgayLap'].'</td>
					<td>'.$row['NgayGiao'].'</td>
					<td>'.$row['DienThoai'].'</td>
					<td>'.$row['DiaChi'].'</td>
					<td>'.$row['TongTien'].'</td>
					<td><a href="chitiethoadon.php?id='.$row['SoPhieu'].'">ChiTiết</a></td>
					<td><a href="xoahoadon.php?id='.$row['SoPhieu'].'">Xóa</a></td>
					<td><a href="capnhathd.php?id='.$row['SoPhieu'].'">Update</a></td>
					</tr>';
					$i++;
				}
			}
			else
			{
				echo'
					';
			}
			?>
			</tbody>
		</table>
		</div>
		<div class="col-sm-12">
			<?php
			if($sotrang ==1 || $sotrang<1)
            {
			}
			else
			{
				echo '<div class="btn btn-primary">Trang</div>';
				for ( $page = 0; $page < $sotrang; $page ++ ) {
					echo "<a class='btn btn-primary' href='Hoadon.php?page={$page}&tt=$tt'>".($page+1)."</a>";
				}
			}
			?>
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