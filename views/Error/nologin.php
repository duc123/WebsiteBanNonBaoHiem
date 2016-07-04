<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <?php include 'views/Layout/head.php' ?>
    </head>
    <body>
        <!--Header-->
        <?php include 'views/Layout/header.php' ?>
        <!--End Header-->
        
        <!--Navbar-->
        <?php include 'views/Layout/navbar.php' ?>
        <!--End Navbar-->
        
        <div class="container" style="text-align: center; margin-top: 1em">
            <p>Bạn phải đăng nhập mới xem được thông tin tài khoản</p>
            <a href="/WebsiteBanHang/Home" class="btn btn-primary">Về Trang chủ</a>
        </div>
        <?php include 'views/Layout/footer.php' ?>
    </body>
</html>
