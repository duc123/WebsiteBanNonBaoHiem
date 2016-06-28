<!DOCTYPE html>
<html lang="en">
<head>
    <title>CHI TIẾT HÓA ĐƠN</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../IMG/ICON_HOME.jpg" rel=" icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../../JS/jquery-2.2.4.min.js"></script>
    <script src="../../JS/bootstrap.min.js"></script>
    <link href="../../CSS/bootstrap.css" rel="stylesheet" />
    <link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
    <link href="../../CSS/Main.css" rel="stylesheet" >
</head>
<body>
    <?php
        include_once 'MenuAdmin.php';
    ?>
<div class="col-sm-12">
    <ul class="nav nav-pills" role="tablist">
        <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
            <center><li role="presentation" class="active"><h1 style="color: white">DANH SÁCH PHẢN HỒI</h1></li></center>
        </ul>
</div>
<div class="col-sm-12">
    <table class="tblcln table table-striped">
        <thead>
        <tr>
            <th>STT</th>
            <th>Mã Liên Hệ</th>
            <th>Tên Người Phan Hoi</th>
            <th>E-Mail</th>
            <th>Noi Dung</th>
            <th>Xử Lý</th>
        </tr>
        </thead>
        <tbody>
        <?php
                include '../../Controller/ActionController.php';
                $ac = new ActionController();
                $res = $ac->DANHSACHLIENHE();
                $i=1;
                while($row = $res->fetch_assoc())
                {
                    echo'
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$row['MaPH'].'</td>
                        <td>'.$row['TenNguoiPH'].'</td>
                        <td>'.$row['Email'].'</td>
                        <td>'.$row['NoiDung'].'</td>
                        <td>
			 				<a href="../Action/xulylienhe.php ?id='.$row['MaLienHe'].'">Xử Lý </a>
			 			</td>
                    </tr>';
                    $i++;
                }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
