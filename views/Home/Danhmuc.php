<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $danhmuc->getTendm(); ?></title>
        <?php include 'views/Layout/head.php'; ?>
    </head>
    <body>
        <?php include 'views/Layout/header.php'; ?>
        <?php include 'views/Layout/navbar.php'; ?>
        <div class="container">

            <div class="row" style="margin-top: 1em">
                <?php include 'views/Layout/nav_loaisp.php'; ?>

                <div class="col-md-9">
                    <div class="row">

                        <?php
                        if (!empty($sanpham)) {
                            foreach ($sanpham as $sanpham) {
                                ?>
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">
                                        <img src="/WebsiteBanHang/views/Contents/images/<?php echo $sanpham->getHinhanh(); ?>" alt="">
                                        <div class="caption">
                                            <h4 class="pull-right"><?php echo $sanpham->getGiasp(); ?> VND</h4>
                                            <h4><a href="/WebsiteBanHang/Home/Sanpham/<?php echo $sanpham->getMasanpham(); ?>"><?php echo $sanpham->getTensanpham(); ?></a>
                                            </h4>
                                            <p><?php echo $sanpham->getThongtin(); ?></p>
                                            <!--<p><a href="" class="btn btn-info" style="visibility:hidden;"></a> <a href="javascript:;" onclick="cartAction('add', '<?php echo $sanpham->getMasanpham(); ?>')" class="btn btn-primary btn-xs pull-right" role="button">Vao gio</a></p>-->
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>

            </div>



        </div>
        <!--End body page-->

<?php include 'views/Layout/footer.php'; ?>
    </body>
</html>