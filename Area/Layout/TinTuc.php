<?php
session_start();
?>
<?php
if($_SESSION["user"] && $_SESSION["pass"])
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>TIN TỨC</title>
    <meta charset="utf-8">
    <link href="../../IMG/ICON_HOME.jpg" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<?php
include 'MenuAdmin.php';
?>
<br />
<a data-toggle="modal" data-target="#frmthemmoi" href="#" class="btn btn-default">Thêm Mới</a>
<br />
<table class="tblcln table table-striped">
    <thead>
    <tr>
        <th>Mã QC</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Ngày đăng</th>
        <th>Link</th>
        <th>Hình ảnh</th>
        <th>Mã loại</th>
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
    $res = $db->GetTinTuc();

    while($row = $res->fetch_assoc()) {
        echo'
    <tr>
        <td>'.$row['MaQuangCao'].'</td>
        <td>'.$row['Tieude'].'</td>
        <td>'.$row['NoiDung'].'</td>
        <td>'.$row['NgayDang'].'</td>
        <td>'.$row['Link'].'</td>
        <td>'.$row['HInhAnh'].'</td>
        <td>'.$row['LoaiQuangCao_MaLoaiQuangCao'].'</td>
        <td>
			 <a href="SuaTinTuc.php?MaQuangCao='.$row['MaQuangCao'].'">Sửa</a>
			 ||
			 <a href="../Action/XoaTinTuc.php?MaQuangCao='.$row['MaQuangCao'].'">Xóa</a>
		</td>
    </tr>
    ';
    }
    ?>
    </tbody>

</table>

<script>
    function myFunction() {
        document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
    }
</script>

<div class="modal fade" id="frmthemmoi" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thêm Tin Mới</h4>
            </div>
            <div class="modal-body">

                <form action="../Action/ThemmoiTT.php" method="post">
                    <div>
                        <label>Tiêu đề </label>
                        <br />
                        <input type="text" name="tieude" required />
                    </div>
                    <div>
                        <label>Nội dung </label>
                        <br />
                        <input type="text" name="noidung" required />
                    </div>

                    <div>
                        <label>Ngày</label>
                        <br />
                        <input type="text" name="ngay" required />
                    </div>

                    <div>
                        <label>Link</label>
                        <br />
                        <input type="text" name="link" required />
                    </div>

                    <div>
                        <label>Loại</label>
                        <br />
                        <select name="loai">
                            <?php

                            $list = $ac->GetLoaiTinTuc();
                            while($row = $list->fetch_assoc()) {
                                echo '
                            <option value="'.$row['MaLoaiQuangCao'].'">'.$row['TenLoaiQuangCao'].'</option>
                            ';
                            }
                            ?>
                        </select>
                        <div>
                            <label>Hình Ảnh </label>
                            <br />
                            <select class="sls" name="img">
                                <?php
                                $directory = "../../img/";
                                $images = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
                                $temp = "col-md-4";

                                foreach($images as $image)
                                {
                                    $loc1 = strstr($image , "img/");
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
                            <img class="img-responsive" id="imgshow" src="../../IMG/logo.jpg">
                    <br />
                    <input type="Submit" value="Submit" class="btn btn-default" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="../../JS/jquery-2.2.4.min.js"></script>
<script src="../../JS/bootstrap.min.js"></script>
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