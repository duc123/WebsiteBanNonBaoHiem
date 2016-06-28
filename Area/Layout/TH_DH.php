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
        $now = getdate();
        $time = $now["year"] . "/" . $now["mon"] . "/" . $now["mday"] ;
        if(!isset($_GET['i']))
        {
            $i=0;
        }
        if ( !isset($_GET['page']) )
        {
        $page = 0 ;
        }
        if(!isset($_POST['bien']) && !isset($_POST['bien1']))
        {
            if(empty($_GET['l']))
            {
                $res = $ac->hoadonchuagiao($page);
                $tem ='DANH SÁCH ĐƠN HÀNG CHƯA GIAO';
                $kt=0;
            }
            else
            {
                if($_GET['l']==2) {
                    $res = $ac->hoadondagiao($page);
                    $tem = 'DANH SÁCH ĐƠN HÀNG ĐÃ GIAO';
                    $kt=2;
                }
                else
                {
                    $res = $ac->hoadon($page);
                    $tem = 'DANH SÁCH ĐƠN HÀNG';
                    $kt=1;
                }
            }
        }
        else
        {
            if (!$_POST['bien1'] && $i ==0)
            {
                $nthang = $_POST["bien"];
                $res = $ac->thongkehoadontheothang($nthang, $page);
                $tem = 'KẾT QUẢ THỐNG KÊ';
                $tem  = $tem." THÁNG: ".$_POST["bien"];
                $kt = 3;
            }
            else
            {
                $datetime = date('Y-m-d', strtotime($_POST["bien1"]));
                $res = $ac->thongketheongay($datetime, $page);
                $tem = 'KẾT QUẢ THỐNG KÊ';
                $tem  = $tem." NGÀY: ".$_POST["bien1"];
                $kt = 4;

            }
        }

    ?>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <ul class="nav nav-pills" role="tablist">
                <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                    <center><li role="presentation" class="active"><h1 style="color: white">THỐNG KÊ ĐƠN HÀNG</h1></li></center>
                </ul>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-4">
                <table class="tblcln table table-striped">
                    <thead>
                    <tr>
                        <th>TỔNG PHIẾU</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list1 = $ac->Tonghoadon();
                    while($row = $list1->fetch_assoc())
                    {
                        echo'
                                 <tr>
                                   <td>'.$row['TONGPHIEU'].' PHIẾU <a href="TH_DH.php?l=1"> - Xem</a></td>
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
                        <th>ĐÃ GIAO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list = $ac->Tonghoadondagiao();
                    while($row = $list->fetch_assoc())
                    {
                        echo'
                                 <tr>
                                   <td>'.$row['TONGPHIEU'].' PHIẾU <a href="TH_DH.php?l=2"> - Xem</a></td>
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
                        <th>CHƯA GIAO</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list1 = $ac->Tonghoadonchuagiao();
                    while($row = $list1->fetch_assoc())
                    {
                        echo'
                                 <tr>
                                   <td>'.$row['TONGPHIEU'].' PHIẾU <a href="TH_DH.php?l=0"> - Xem</a></td>
                                 </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <ul class="nav nav-pills" role="tablist">
                <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                    <center><li role="presentation" class="active"><h4 style="color: white"><?php echo $tem ?></h4></li></center>
                </ul>
            </ul>
        </div>
        <div class="col-sm-3">
            <form method="post" action="TH_DH.php">
                <label>THỐNG KÊ THEO NGÀY</label>
                <div class="form-group frmseach row">
                    <div class="col-sm-8" >
                        <input type="date" class="form-control" name="bien1" required />
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-success" value="OK" />
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-3">
            <form method="post" action="TH_DH.php">
                <label>THỐNG KÊ THEO THÁNG</label>
                <div class="form-group frmseach row">
                    <div class="col-sm-8" >
                        <input type="date" class="form-control" name="bien" required />
                    </div>
                    <div class="col-sm-1">
                        <input type="submit" class="btn btn-success" value="OK" />
                    </div>
                </div>
            </form>
        </div>
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
            if($kt==1)
                {
                    $sotrang = $ac->GetSoTranghoadon();
                    if($sotrang <1 || $sotrang ==1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn btn-primary' href='TH_DH.php?page={$page}&l=1'>".($page+1)."</a>";
                        }
                    }
                }
             if($kt==0)
                {
                    $sotrang = $ac->SoTrangHoaDonChuaGiao();
                    if($sotrang <1 || $sotrang ==1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn btn-primary' href='TH_DH.php?page={$page}&l=0'>".($page+1)."</a>";
                        }
                    }
                }
             if($kt==2)
                {
                    $sotrang = $ac->SoTrangHoaDonGiao();
                    if($sotrang <1 || $sotrang ==1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn btn-primary' href='TH_DH.php?page={$page}&l=2'>".($page+1)."</a>";
                        }
                    }
                }
            ?>
        </div>
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