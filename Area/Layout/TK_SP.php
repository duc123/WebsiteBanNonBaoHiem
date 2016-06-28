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
        $page = filter_input(INPUT_GET,'page');
        $kt =0;
        if ( !isset($_GET['page']) )
        {
        $page = 0 ;
        }
        if(!isset($_POST['bien']))
        {
            if(empty($_GET['l']))
            {
                $res = $ac->SANPHAMCHUABAN($page);
                $tem ='DANH SÁCH SẢN PHẨM CHƯA BÁN';
                $kt=0;
            }
            else
            {
                if($_GET['l']==2) {
                    $res = $ac->SANPHAMBAN($page);
                    $tem = 'DANH SÁCH SẢN PHẨM ĐÃ BÁN';
                    $kt=2;
                }
                else
                {
                    $res = $db->GetSanPham($page);
                    $tem = 'DANH SÁCH SẢN PHẨM';
                    $kt=1;
                }
            }
        }
        else
        {
            $res = $ac->timkiemsap($_POST['bien']);
            $tem = 'KẾT QUẢ TÌM KIẾM';
            $kt=3;
        }

    ?>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <ul class="nav nav-pills" role="tablist">
                <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                    <center><li role="presentation" class="active"><h1 style="color: white">THỐNG KÊ SẢN PHẨM</h1></li></center>
                </ul>
            </ul>
        </div>
        <div>
            <form method="post" action="TK_SP.php">
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
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <ul class="nav nav-pills" role="tablist">
                <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                    <center><li role="presentation" class="active"><h1 style="color: white"><?php echo $tem ?></h1></li></center>
                </ul>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-4">
                <table class="tblcln table table-striped">
                    <thead>
                    <tr>
                        <th>TỔNG SỐ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $restog = $ac->TONGSANPHAM();
                        while($row = $restog->fetch_assoc())
                        {
                            echo'
                             <tr>
                               <td>'.$row['TONGSP'].' Sản Phẩm <a href="TK_SP.php?l=1"> - Xem</a></td>

                             </tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <table class="tblcln table table-striped">
                    <thead>
                    <tr>
                        <th>CHƯA BÁN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list = $ac->SOLUONGSANPHAMCHUABAN();
                    while($row = $list->fetch_assoc())
                    {
                        echo'
                                 <tr>
                                   <td>'.$row['TONGSP'].' Sản Phẩm <a href="TK_SP.php?l=0"> - Xem</a></td>
                                 </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <table class="tblcln table table-striped">
                    <thead>
                    <tr>
                        <th>BÁN</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list1 = $ac->TONGSANPHAMBAN();
                    while($row = $list1->fetch_assoc())
                    {
                        echo'
                                 <tr>
                                   <td>'.$row['TONGSP'].' Sản Phẩm <a href="TK_SP.php?l=2"> - Xem</a></td>
                                 </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
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
  </div>
    <div class="col-sm-12">
            <?php
                if($kt==1)
                {
                    $sotrang = $db->GetSoTrangsanpham();
                    if($sotrang <1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn  btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn  btn-primary' href='TK_SP.php?page={$page}&l=1'>".($page+1)."</a>";
                        }
                    }
                }
                if($kt==0)
                {
                    $sotrang = $ac->sotrangsanphamchuban();
                    if($sotrang <1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn  btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn  btn-primary' href='TK_SP.php?page={$page}&l=0'>".($page+1)."</a>";
                        }
                    }
                }
                if($kt==2)
                {
                    $sotrang = $ac->sotrangsanphamban();
                    if($sotrang <1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn  btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn  btn-primary' href='TK_SP.php?page={$page}&l=2'>".($page+1)."</a>";
                        }
                    }
                }

            ?>
     </div>
    <div class="col-sm-12" style="margin-top: 2%"></div>
    <?php
	}
	else
	{
		header("location:../../Login.php");
	}
	?>
</body>
</html>