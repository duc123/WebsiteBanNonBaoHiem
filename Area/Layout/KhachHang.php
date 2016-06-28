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
    <title>KHÁCH HÀNG</title>
    <meta charset="utf-8">
    <link href="../../IMG/ICON_HOME.jpg" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../CSS/bootstrap.css" rel="stylesheet" />
    <link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
    <script src="../../JS/jquery-2.2.4.min.js"></script>
    <script src="../../JS/bootstrap.min.js"></script>
    <link href="../../CSS/Main.css" rel="stylesheet" >
</head>
<body>

    <?php
    include 'MenuAdmin.php';
    include '../../Controller/ActionController.php';
    include_once '../../Model/Dbcontext.php';

    $db = new Database;
    $db->ketnoi();
    $ac = new ActionController();
    $now = getdate();
    $time = $now["year"] . "/" . $now["mon"] . "/" . $now["mday"] ;
    $page = filter_input(INPUT_GET,'page');
    if ( !isset($_GET['page']) )
    {
        $page = 0 ;
    }
    $kt=0;
    if(!isset($_POST['bien'])) {
        if ($_GET['today'] == 1)
        {
            $res = $db->GetKhachHang($page);
            $kt=1;
        }
        else {

            $res = $db->GetKhachHangToday($time, $page);
        }
    }
    else
    {
        $res = $ac->timkiemkhachhang($_POST['bien']);
    }


    ?>
    <div class="col-sm-12">
        <div class="col-sm-6">
            <ul class="nav nav-pills" role="tablist">
                <ul class="nav nav-pills" role="tablist" style="background-color:#337AB7">
                    <center><li role="presentation" class="active"><h1 style="color: white">DANH SÁCH KHÁCH HÀNG HÀNG</h1></li></center>
                </ul>
            </ul>
        </div>
        <form method="post" action="KhachHang.php">
            <div class="form-group frmseach row">
                <div class="col-sm-4" >
                    <input type="text" class="form-control" placeholder="Nhập mã hoặc tên khách hàng" name="bien" required />
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
                if($sotrang <1||$sotrang==1)
                {
                }
                else
                {
                    echo '<div class="btn btn-primary">Trang</div>';
                    for ( $page = 0; $page < $sotrang; $page ++ )
                    {
                        echo "<a class='btn btn-primary' href='KhachHang.php?page={$page}&today=1'>".($page+1)."</a>";
                    }
                }
            }
            else
            {
                 $sotrang = $db->GetSoTrangkhtoday($time);
                if($sotrang <1||$sotrang==1)
                {
                }
                else
                {
                    echo '<div class="btn btn-primary">Trang</div>';
                    for ( $page = 0; $page < $sotrang; $page ++ )
                    {
                        echo "<a class='btn btn-primary' href='KhachHang.php?page={$page}&today=0'>".($page+1)."</a>";
                    }
                }
            }
            ?>
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