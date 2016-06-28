<html>
<head>
	<title>Chi Tiet Hoa Don</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../../CSS/bootstrap.css" rel="stylesheet" />
	<link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
</head>
<body>
	

<table class="tblcln table table-striped">
	<thead>
		<tr>
		<th>ID</th>
		<th>MaHoaDon</th>
		<th>MaSanPham</th>
		<th>TenSanPham</th>
		<th>Gia</th>
		</tr>
	</thead>
	<tbody>

	<?php
			include '../../Controllers/ActionController.php';
			$ac = new ActionController;
			$id = $_GET['id'];
			$res = $ac->chitiethoadon($id);
			while($row = $res->fetch_assoc()) {
					echo'
					<tr>
					<td>'.$row['ID'].'</td>
					<td>'.$row['MaDonHang'].'</td>
					<td>'.$row['MaSanPham'].'</td>
					<td>'.$row['Ten'].'</td>
					<td>'.$row['Gia'].'</td>
					</tr>';



					# code...
				}
	?>
	</tbody>
	</table>
	</body>
</html>
