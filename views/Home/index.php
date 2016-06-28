
<!DOCTYPE html>
<html lang="vi">

    <head>
        <title>Safety</title>
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

            <!--Silder-->

            <?php include 'views/Layout/banner.php'; ?>

            <!--End Silder-->

            <!--Body page-->
            <div class="container">

                <div class="row">

                    <?php include 'views/Layout/nav_loaisp.php'; ?>

                    <div class="col-md-9">
                        <?php if(!empty($trang_sanpham)) { ?>
                        <div class="row">
                        
                            <?php
                            foreach ($trang_sanpham[$trang_hien_tai] as $sanpham) {
                                ?>
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">
                                        <img src="/WebsiteBanHang/views/Contents/images/<?php echo $sanpham->getHinhanh(); ?>" alt="">
                                        <div class="caption">
                                            <h4 class="pull-right"><?php echo $sanpham->getGiasp(); ?> VND</h4>
                                            <h4><a href="/WebsiteBanHang/Home/Sanpham/<?php echo $sanpham->getMasanpham(); ?>"><?php echo $sanpham->getTensanpham(); ?></a>
                                            </h4>
                                            <p><?php echo $sanpham->getThongtin(); ?></p>
                                            <p><a href="" class="btn btn-info" style="visibility:hidden;"></a> <a href="javascript:;" onclick="cartAction('add', '<?php echo $sanpham->getMasanpham(); ?>')" class="btn btn-primary btn-xs pull-right" role="button">Vao gio</a></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            
                        </div>
                        <?php } ?>
                    </div>

                </div>

                <!--Pagination-->
                <div class="text-center">
                <?php if(!empty($sotrang)) { ?>
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $sotrang; $i++) {
                            echo '<li><a href=/WebsiteBanHang/Home/Index/' . $i . '>' . $i . '</a></li>';
                        }
                        ?>
                    </ul>
                    <?php } ?>
                </div>
                <!--End Pagination-->

            </div>
            <!--End body page-->
        </div>

        <?php include 'views/Layout/footer.php'; ?>

    </body>
</html>