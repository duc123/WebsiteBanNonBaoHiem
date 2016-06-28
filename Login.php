<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="views/Contents/css/stylelogin.css" rel="stylesheet">
    <link href="IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
    <title>Login</title>
</head>
<body>
<?php
if(isset($_POST["submit_name"])){
    if($_POST["user"] && $_POST["pass"]){
        $user = $_POST["user"];
        $pass1 = $_POST["pass"];
        $pass = crc32($pass1);
        $connect_db = mysql_connect("127.0.0.1:3306", "root", "");
        $select_db = mysql_select_db("QuanLyBanHang", $connect_db);
        $set_lang = mysql_query("SET NAMES 'utf8'");

        $sql = "SELECT * FROM Admin WHERE UserName = '$user' AND Password = '$pass'";
        $query = mysql_query($sql);
        $num_row = mysql_num_rows($query);

        if($num_row > 0){
            $_SESSION["user"] = $user;
            $_SESSION["pass"] = $pass;
            header("location:Area/Layout/Index.php");
        }
        else{
            echo "<script>alert('Tai khoan khong hop le!!!')</script>";
            
        }
    }
}
?>
<?php
if(!isset($_SESSION["user"]) && !isset($_SESSION["pass"])){
    ?>
    <form method="post">
        <header>LOGIN</header>
        <label>UserName <span>*</span></label>
        <input type="text" name="user" placeholder="USERNAME"/>
        <label>PassWord <span>*</span></label>
        <input type="password" name="pass" placeholder="PASSWORD"/>
        <input class="but" type="submit" value="Login"  name="submit_name"> </input>
    </form>
    <?php
}
else{
    header("location:Area/Layout/Index.php");
}
?>

</body>
</html>