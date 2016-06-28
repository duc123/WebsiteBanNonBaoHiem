<?php
session_start();
?>
<?php
if($_SESSION["user"] && $_SESSION["pass"])
{
?>


<html>
<head>
    <title>DANH MỤC TIN TỨC</title>
    <link href="../../IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
    <meta charset="utf-8">
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
        <th>ID</th>
        <th>Tên</th>
    </tr>
    </thead>

    <?php
		 	include '../../Controller/ActionController.php';

		 	$ac = new ActionController;
		 	$res = $ac->GetLoaiTinTuc();
    $i=0;
    while($row = $res->fetch_assoc()) {
    echo'
    <tr>
        <td>'.$row['MaLoaiQuangCao'].'</td>
        <td>'.$row['TenLoaiQuangCao'].'</td>
        <td>
            <a href="SualoaiTin.php?MaLoaiQuangCao='.$row['MaLoaiQuangCao'].'">Sửa</a>
            ||
            <a href="../Action/XoaLoaiTin.php?MaLoaiQuangCao='.$row['MaLoaiQuangCao'].'">Xóa</a>
        </td>
    </tr>
    ';
        $i=1;
    }
    if($i==0)
    {
        echo '<h1>KHÔNG CÓ TIN TỨC</h1>';
    }
    ?>





</table>
<div class="modal fade" id="frmthemmoi" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">THÊM LOẠI TIN MỚI</h4>
            </div>
            <div class="modal-body">

                <form action="../Action/ThemLoaiTin.php" method="post">

                    <div>
                        <label>Tên Loại</label>
                        <br />
                        <input type="text" name="loai" required />
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

<script>
    function myFunction() {
        document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
    }
</script>

<script src="../../js/jquery-2.2.4.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<?php
	}
	else
	{
		header("location:../../Login.php");
	}
	?>
</body>
</html>