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
    <link href="../../css/Main.css" rel="stylesheet" >
</head>
<body>

    <?php
    include 'MenuAdmin.php';
    include_once '../../Model/Dbcontext.php';
    $db = new Database;
    $db->ketnoi();
    include '../../Controller/ActionController.php';
    $ac = new ActionController;
    $page = $_GET['page'];

    if ( !$_GET['page'] )
    {
        $page = 0 ;
    }

    if(!$_POST['bien'])
    {
        if($_GET['l']==0)
        {
            $res = $ac->SANPHAMCHUABAN($page);
            $tem ='DANH SÁCH SẢN PHẨM CHƯA BÁN';
        }
        else
        {
            $res = $ac->SANPHAMBAN();
            $tem ='DANH SÁCH SẢN PHẨM ĐÃ BÁN';
        }
    }
    else
    {
        $res = $ac->timkiemsap($_POST['bien']);
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
        if($sotrang==1)
        {
        }
        else
        {
            echo '<div class="aphantrang">Trang</div>';
            for ( $page = 0; $page < $sotrang-1; $page ++ )
            {
                $te =$page+1;
                echo "<a class='aphantrang' href='Index.php?page={$te}'>".($page+1)."</a>";
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