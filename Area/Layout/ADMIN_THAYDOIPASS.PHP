<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../../css/stylelogin.css" rel="stylesheet">
    <link href="../../IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
    <title>Thay đổi mật khẩu</title>
</head>
<body>
    <?php
    if($_POST["submit_name"])
    {
        if( strcasecmp($_POST["pass"],$_POST["repass"])!=0) {
            echo "<script>alert('Nhập khẩu mới chưa hợp lệ!!!')</script>";
        }

        else
        {
            if($_POST["user"] && $_POST["pass"])
            {
                $user = $_POST["user"];
                $pass = $_POST["passold"];
                $repass = $_POST["repass"];
                $passnew = $_POST["pass"];
                $pass1 = crc32($passnew);
                $pass2 = crc32($pass);


                $connect_db = mysql_connect("localhost", "root", "");
                $select_db = mysql_select_db("quanlybanhang", $connect_db);
                $set_lang = mysql_query("SET NAMES 'utf8'");

                $sql = "SELECT * FROM admin WHERE UserName = '$user' AND Password = '$pass2'";

                $query = mysql_query($sql);
                $num_row = mysql_num_rows($query);
                if($num_row > 0)
                {
                    $my = "UPDATE admin  SET Password = '$pass1' WHERE UserName ='$user'";
                    $query = mysql_query($my);
                    echo "<script>alert('Cập nhật mật khẩu thành công!!!')</script>";
                }
                else
                {
                    echo "<script>alert('Tài khoản không hợp lệ!!!')</script>";
                }
            }
            }
            }
    ?>
        <form method="post">
            <header>ĐỔI MẬT KHẨU</header>
            <label>TÀI KHOẢN</label>
            <input type="text" name="user" placeholder="USERNAME"/>
            <label>MẬT KHẨU CŨ</label>
            <input type="password" name="passold" placeholder="PASSWORD"/>
            <label>MẬT KHẨU MỚI</label>
            <input type="password" name="pass" placeholder="PASSWORD"/>
            <label>NHẬP LẠI MẬT KHẨU MỚI</label>
            <input type="password" name="repass" placeholder="PASSWORD"/>
            <input class="but" type="submit" value="OK"  name="submit_name"> </input>
        </form>
</body>
</html>