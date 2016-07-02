<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Safety</title>
        <?php include_once 'views/Layout/head.php'; ?>

    </head>

    <body>
        <!--Header-->

        <?php include_once 'views/Layout/header.php'; ?>

        <!-- Navigation -->

        <?php include_once 'views/Layout/navbar.php'; ?>

        <!--Slider-->



        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <?php include 'views/Layout/nav_loaisp.php'; ?>

                <div class="col-md-9" style="margin-top: 1em">

                    <div class="thumbnail">
                        <img class="img-responsive" src="/WebsiteBanHang/views/Contents/images/<?php echo $sp->getHinhanh(); ?>" alt="">
                        <div class="caption-full" style="margin: 1em">
                            <h4 class="pull-right"><?php echo $sp->getGiasp(); ?> VND</h4>
                            <h4><a href="#"><?php echo $sp->getTensanpham(); ?></a>
                            </h4>
                            <p><?php echo $sp->getThongtin(); ?></p>
                            <p><input type="number" id="soluong" value="1" min="1"> <a href="javascript:;" onclick="cartAction('add', '<?php echo $sp->getMasanpham(); ?>')" class="btn btn-primary btn-xs pull-right" style="font-size: 1.2em" role="button"><strong>Vào giỏ</strong></a></p>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        <!-- /.container -->

        <div class="container">

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; Your Website 2014</p>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.container -->

    </body>

</html>
