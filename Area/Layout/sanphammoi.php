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
        ?>
    <div class="col-sm-12">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">Thoát</button>
                        <h1 class="modal-title">Thêm mới sản phẩm</h1>
                    </div>
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
                            <input type="Submit" value="Thêm" class="btn btn-primary" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
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