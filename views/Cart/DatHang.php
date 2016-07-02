<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Đặt hàng thành công</title>
        <?php include 'views/Layout/head.php'; ?>
    </head>
    <body>
        <div class="page">
            <!-- Header -->

            <?php include 'views/Layout/header.php'; ?>

            <!-- end header -->

            <!-- Navbar -->

            <?php include 'views/Layout/navbar.php'; ?>

            <!-- end nav -->


            <!--Body page-->
            <div class="container">
                <div style="text-align: center">
                    <?php if ($success) { ?>
                        <h1>Đặt hàng thành công</h1>
                        <p>Shop sẽ kiểm tra thông tin đặt hàng và sẽ giao hàng đúng hẹn</p>
                        <p>Nếu bạn chọn cách giao hàng chậm thì shop sẽ giao hàng trong vòng 7 ngày</p>
                        <p>Nếu bạn chọn cách giao hàng nhanh shop sẽ giao hàng trong vòng 24h kể từ lức đơn đặt hàng được chấp nhận</p>
                        <p>Nếu có vấn đề gì xin hãy bấm phản hồi ở bên góc phải dưới trang web</p>
                        <p>Xin cảm ơn đã mua hàng</p>
                    <?php } ?>
                    <a href="/WebsiteBanHang/Home" class="btn btn-primary" role="button">Tiếp tục mua hàng</a>
                    <div>
                    </div>
                    <!--End body page-->
                    <?php include 'views/Layout/footer.php'; ?>
                </div>
                </body>
                </html>
