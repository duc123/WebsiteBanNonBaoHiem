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
        $tong =0;
        $nottong =0;
        $kt =0;
        if ( !isset($_GET['page']) )
        {
        $page = 0 ;
        }

        if(!isset($_POST['bien']))
        {
            if(empty($_GET['l']))
            {
                $res = $ac->khachhangchuamua($page);
                $tem ='DANH SÁCH KHACH CHƯA MUA';
                $kt =0;
            }
            else
            {
                if($_GET['l']==1)
                {
                    $res = $db->GetKhachHang($page);
                    $tem = 'DANHN SÁCH KHÁCH HÀNG';
                    $kt =1;
                }
                else
                {
                    $res = $ac->khachhangmua($page);
                    $tem = 'DANHN SÁCH KHÁCH MUA HÀNG ';
                    $kt =2;
                }

            }
        }
        else
        {
            $res = $ac->timkiemkhachhang($_POST['bien']);
            $tem = 'KẾT QUẢ TÌM KIẾM';
            $kt=3;
        }

    ?>

    <div class="col-sm-12">
        <div class="col-sm-6">
            <ul class="nav nav-pills" role="tablist">
                <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                    <center><li role="presentation" class="active"><h1 style="color: white">THỐNG KÊ KHÁCH HÀNG</h1></li></center>
                </ul>
            </ul>
        </div>
        <div class="col-sm-6">
            <form method="post" action="TK_KH.php">
                <div class="form-group frmseach row">
                    <div class="col-sm-4" >
                        <input type="text" class="form-control" placeholder="Nhập mã hoặc tên  khách hàng" name="bien" required />
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
                        <th>TỔNG SỐ KHÁCH</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $restog = $ac->TongkHachHang();
                    while($row = $restog->fetch_assoc())
                    {
                        $tong =$row['TONGKH'];
                        echo'
                             <tr>
                               <td>'.$row['TONGKH'].' Khách Hàng <a href="TK_KH.php?l=1"> - Xem</a></td>
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
                        <th>KHÁCH CHƯA MUA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $list = $ac->tongsokhachchuamua();
                    while($row = $list->fetch_assoc())
                    {
                        $nottong =$row['TONGKH'];
                        echo'
                                 <tr>
                                   <td>'.$row['TONGKH'].' Khách Hàng <a href="TK_KH.php?l=0"> - Xem</a></td>
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
                        <th>KHÁCH MUA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $tong -= $nottong;
                        echo'<tr>
                                <td>'.$tong.' Khách Hàng <a href="TK_KH.php?l=2"> - Xem</a></td>
                             </tr>';
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
                    <th>Mã KH</th>
                    <th>Tên KH</th>
                    <th>Tài khoản</th>
                    <th>Mật khẩu</th>
                    <th>Điện Thoại</th>
                    <th>Email</th>
                    <th>Địa Chỉ</th>
                    <th>Quận/Huyện</th>
                    <th>Tỉnh/Thành Phố</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if($res != null) {
                    $i=1;
                    while ($row = $res->fetch_assoc()) {
                        echo '
                        <tr>
                            <td>'.$i.'</td>
                            <td>' . $row['MaKH'] . '</td>
                            <td>' . $row['TenKH'] . '</td>
                            <td>' . $row['UserName'] . '</td>
                            <td>' . $row['Password'] . '</td>
                            <td>' . $row['DT'] . '</td>
                            <td>' . $row['Email'] . '</td>
                            <td>' . $row['DiaChi'] . '</td>
                            <td>' . $row['Phuong_Xa'] . '</td>
                            <td>' . $row['Quan_Huyen'] . '</td>
                            <td>' . $row['ThanhPho'] . '</td>
                        </tr>
                        ';
                        $i++;
                    }
                }
                else
                {
                    echo '
                <tr>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                    </tr>
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
                    $sotrang = $db->GetSoTrangkh();
                    if($sotrang <1 || $sotrang==1)
                    {
                    }
                    else
                    {
                        echo '<div class="btn  btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn  btn-primary' href='TK_KH.php?page={$page}&l=1'>".($page+1)."</a>";
                        }
                    }
                }
                if($kt==0)
                {
                    $sotrang = $ac->sotrangkhachhangchuamua();
                    if($sotrang <1 || $sotrang==1)
                    {

                    }
                    else
                    {
                        echo '<div class="btn  btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn  btn-primary' href='TK_KH.php?page={$page}&l=0'>".($page+1)."</a>";
                        }
                    }
                }
                if($kt==2)
                {
                    $sotrang = $ac->sotrangkhachhangmua();
                    if($sotrang <1 || $sotrang==1 )
                    {
                    }
                    else
                    {
                        echo '<div class="btn  btn-primary">Trang</div>';
                        for ( $page = 0; $page < $sotrang; $page ++ )
                        {
                            echo "<a class='btn  btn-primary' href='TK_KH.php?page={$page}&l=2'>".($page+1)."</a>";
                        }
                    }
                }

            ?>
        </div>
    </div>
    <div class="col-sm-12" style="margin-top: 2%;"></div>
<?php
	}
	else
	{
		header("location:../../Login.php");
	}
	?>
</body>
</html>