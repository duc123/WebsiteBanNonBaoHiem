<?php
	session_start();
    $t = $_GET['tt'];
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
	 ?>
    <div class="col-sm-12">
        <table class="tblcln table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Chi tiết</th>
                <th>Giá</th>
                <th>Loại</th>
                <th>Hình ảnh</th>
                <th>Số lượng bán</th>
                <th>Tùy chọn</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include '../../Controller/ActionController.php';
            include_once '../../Model/Dbcontext.php';
            $db = new Database;
            $ac = new ActionController;
            $db->ketnoi();
            if($t == 0)
            {
                $res = $ac->SANPHAMBANCHAY();
                $ten = 'DANH SÁCH SẢN PHẨM BÁN CHẠY NHẤT';
            }
            else
            {
                $res = $ac->SANPHAMBANCHAM();
                $ten = 'DANH SÁCH SẢN PHẨM BÁN CHẬM';
            }
            echo '
                <div class="col-sm-12">
                    <ul class="nav nav-pills" role="tablist">
                        <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                           <center><li role="presentation" class="active"><h1 style="color: white">'.$ten.'</h1></li></center>
                        </ul>
                </div>';
            while($row = $res->fetch_assoc()) {
                echo'
    <tr>
        <td>'.$row['MaSanPham'].'</td>
        <td>'.$row['Ten'].'</td>
        <td>'.$row['ChiTiet'].'</td>
        <td>'.$row['Gia'].'</td>
        <td>'.$row['MaLoai'].'</td>
        <td>'.$row['Hinh'].'</td>
        <td>'.$row['SoLuongBan'].'</td>
        <td>
            <a href="Suasanpham.php?id='.$row['MaSanPham'].'">Sửa</a>
            ||
            <a href="../Action/Xoasanpham.php?id='.$row['ID'].'">Xóa</a>
        </td>
    </tr>
    ';
            }
            ?>
            </tbody>
        </table>
        <div class="modal fade" id="frmthemmoi" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">Thoát</button>
                        <h4 class="modal-title">Thêm mới sản phẩm</h4>
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
                                <label>Giá </label>
                                <br />
                                <input type="number" name="gia" min="1" required />
                            </div>
                            <div>
                                <label>Loại </label>
                                <br />
                                <select name="loai">
                                    <?php

                                    $list = $ac->GetLoaiSanPham();
                                    while($row = $list->fetch_assoc()) {
                                        echo '
                            <option value="'.$row['MaLoai'].'">'.$row['TenLoai'].'</option>
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
                                    $directory = "../../IMG/";
                                    $images = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
                                    $temp = "col-md-4";

                                    foreach($images as $image)
                                    {
                                        $loc1 = strstr($image , "IMG/");
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
                            <img class="img-responsive" id="imgshow" src="../../IMG/logo.jpg">
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

<script type="text/javascript">
    $('.sls').change(function() {
        var str = "";
        $(".sls option:selected").each(function() {
            str +="../../IMG/" + $(this).text() + " ";
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