<div class="container">

    <div class="popupContainer" style="display: none" id="phanhoi">
        <header class="popupHeader">
            <span class="header_title">Phản hồi</span>
            <span class="modal_close"><i class="fa fa-times"></i></span>
        </header>

        <section class="popupBody">
            <form method="POST" action="/WebsiteBanHang/Home/Phanhoi">
                <div class="form-group">
                    <label>Tên người gửi:</label>
                    <input type="text" name="ten" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="noidung" class="form-control" required>
                    </textarea>
                </div>
                <input type="submit" class="form-control">
            </form>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Safety <?php echo date('Y'); ?></p>
                <?php

                use Model\LienheQuery;
                $lienhe = LienheQuery::create()->findPk(1);
                if(!empty($lienhe)){
                ?>
                <div class="pull-right">
                    <p>Liên hệ: <span><?php echo $lienhe->getTennguoilh(); ?></span></p>
                    <p>Điện thoại: <span><?php echo $lienhe->getDienthoai(); ?>s</span></p>
                    <p>Email: <span><?php echo $lienhe->getEmail(); ?></span></p>
                </div>
                <?php } ?>
            </div>
            <div class="col-sm-4">
                <a href="#phanhoi" id="trigger">Phản hồi</a>
            </div>
        </div>
    </footer>

    <script>
        $("#trigger").leanModal({top: 200, overlay: 0.6, closeButton: ".modal_close"});
    </script>

</div>