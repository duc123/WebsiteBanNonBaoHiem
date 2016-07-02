<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Gio hang</title>
        <?php include 'views/Layout/head.php'; ?>

    </head>

    <body class="cms-index-index">
        <div class="page">
            <!-- Header -->

            <?php include 'views/Layout/header.php'; ?>

            <!-- end header -->

            <!-- Navbar -->

            <?php include 'views/Layout/navbar.php'; ?>

            <!-- end nav -->


            <!--Body page-->
            <div class="container">

                <div class="row">
                    <br/>
                    <p style="font-size: 160%"><strong>GIỎ HÀNG</strong></p>
                    <button style="float: right" class="btn btn-danger" onclick="cartAction('empty', '')"><span class="glyphicon glyphicon-shopping-cart white"></span><strong> Empty</strong></button>
                    <br/>
                    <br/>
                    <br/>
                    <table data-toggle="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá bán</th>
                                <th>Thành tiền</th>
                                <th>Xóa khỏi giỏ</th>
                            </tr>
                        </thead>

                        <tbody id="tbody">
                            <?php
                            if (isset($sanpham)) {
                                foreach ($sanpham as $sp) {
                                    ?>
                                    <tr id="sp_<?php echo $sp->getMasanpham(); ?>">
                                        <td><?php echo $sp->getMasanpham(); ?></td>
                                        <td><?php echo $sp->getTensanpham(); ?></td>
                                        <td><?php echo $sp->getSoluong(); ?></td>
                                        <td><?php echo $sp->getGiasp(); ?></td>
                                        <td><?php echo $sp->getThanhtien(); ?></td>
                                        <td><button class="btn btn-danger" onclick="cartAction('remove', '<?php echo $sp->getMasanpham(); ?>')"><span class="glyphicon glyphicon-trash"></span><strong> Remove</strong></button></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                echo '<tr></tr>';
                            }
                            ?>

                        </tbody>

                    </table>
                    <br/>
                    <br/>
                    <br/>
                    <a href="/WebsiteBanHang/Cart/Thanhtoan/" role="button" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-ok"></span><strong> Thanh toán</strong></a>
                </div>

            </div>
            <!--End body page-->
        </div>

        <?php include 'views/Layout/footer.php'; ?>

    </body>
</html>
