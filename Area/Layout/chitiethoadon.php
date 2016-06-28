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
    <link href="../../css/Main.css" rel="stylesheet" >
</head>
<body>
    <?php
        include_once 'MenuAdmin.php';
        $tong =0;
    ?>
    <div class="col-sm-12">
        <ul class="nav nav-pills" role="tablist">
            <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                <center><li role="presentation" class="active"><h1 style="color: white">CHI TIẾT ĐƠN HÀNG</h1></li></center>
            </ul>
    </div>
    <div class="col-sm-12">
            <table class="tblcln table table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Số Hóa Đơn</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng Mua</th>
                    <th>Giá</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include '../../Controller/ActionController.php';
                $ac = new ActionController;
                $id = $_GET['id'];
                $res = $ac->chitiethoadon($id);
                $i=1;
                while($row = $res->fetch_assoc())
                {
                    $tong += ($row["SoLuong"]*$row["GiaSP"]);
                    echo'
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$row['PhieuDatHang_SoPhieu'].'</td>
                        <td>'.$row['Sanpham_MaSanpham'].'</td>
                        <td>'.$row['TenSanpham'].'</td>
                        <td>'.$row['SoLuong'].'</td>
                        <td>'.$row['GiaSP'].'</td>
                    </tr>';
                    $i++;
                }
                ?>
                </tbody>

            </table>
    </div>
    <div class="col-sm-12">
        <div class="row">
                <div class="btn btn-block pull-right">
                    <?php
                    echo '<h4 style="color: red">TỔNG TIỀN: '. $tong.' VNĐ</h4>';
                    ?>
                </div>
        </div>
    </div>
</body>
</html>
