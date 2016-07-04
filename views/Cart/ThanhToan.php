<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thanh toán</title>
        <?php include 'views/Layout/head.php' ?>
    </head>
    <body>
        <p id="timeout" class="hidden" style="color:red; font-size: 1.5em">Xe hàng của bản đã hết lượt đang chuyển về trang chủ</p>
        <!--Header-->
        <?php include 'views/Layout/header.php' ?>
        <!--End Header-->

        <!--Content-->
        <!--Form thanh toan -->
        <div class="container">
            <div class="row">
                <div class="ch-box col-xs-6 left-col">
                    <div class="ch-box-inner">
                        <button class="btn btn-primary" onclick="ganthongtin()">Sử dụng thông tin trong tài khoản cho thông tin giao hàng</button>
                        <form role="form" method="POST" action="/WebsiteBanHang/Cart/Dathang" id="form1">
                            <h3>Bước 1: Nhập Email</h3>
                            <?php if (!isset($_SESSION['khachhang'])) { ?>
                                <div class="form-group">
                                    <label for="email" class="mylabel">Email (shop sẽ gửi mail đơn đặt hàng theo địa chỉ email này):</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com">
                                </div>
                            <?php } else { ?>
                                <p>Sử dụng email tài khoản nếu muốn đổi email xin hãy đăng xuất</p>
                            <?php } ?>
                            <hr>
                            <h3>Bước 2: Nhập thông tin giao hàng</h3>

                            <div class="form-group">
                                <label for="ten" class="mylabel">Tên người nhận:</label>
                                <input type="text" id="ten" name="ten" class="form-control" placeholder="Tên người nhận">
                            </div>
                            <div class="form-group">
                                <label for="diachi" class="mylabel">Địa chỉ - số nhà - đường:</label>
                                <textarea type="text" id="diachi" name="diachi" class="form-control" placeholder="Địa chỉ - số nhà - đường"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="thanhpho" class="mylabel">Thành phố:</label><br/>
                                <select id="thanhpho" name="thanhpho" class="selectpicker">
                                    <option value="" >Lựa chọn</option>
                                    <?php
                                    if (!empty($thanhpho)) {
                                        foreach ($thanhpho as $thanhpho) {
                                            ?>
                                            <option value="<?php echo $thanhpho->getTentp(); ?>"><?php echo $thanhpho->getTentp(); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quan_huyen" class="mylabel">Quận-Huyện:</label><br/>
                                <select id="quan_huyen" name="quan_huyen" class="selectpicker" onchange="setChiPhi()">
                                    <option value="">Lựa chọn</option>
                                    <?php
                                    if (!empty($quanhuyen)) {
                                        foreach ($quanhuyen as $quanhuyen) {
                                            ?>
                                            <option value="<?php echo $quanhuyen->getTenquanHuyen(); ?>|<?php echo $quanhuyen->getChiphigiaohang(); ?>"><?php echo $quanhuyen->getTenquanHuyen(); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phuong_xa" class="mylabel">Phường-Xã:</label><br/>
                                <select id="phuong_xa" name="phuong_xa" class="selectpicker">
                                    <option value="">Lựa chọn</option>
                                    <?php
                                    if (!empty($phuongxa)) {
                                        foreach ($phuongxa as $phuongxa) {
                                            ?>
                                            <option value="<?php echo $phuongxa->getTenpX(); ?>"><?php echo $phuongxa->getTenpX(); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dienthoai" class="mylabel">Điện thoại(shop sẽ gọi theo số điện thoại này để kiểm tra):</label>
                                <input type="text" id="dienthoai" name="dtthoai" class="form-control" placeholder="Số điện thoại">
                            </div>
                            <hr>
                            <h3>Bước 3: Chọn phương thức thanh toán</h3>
                            <div id="phuong_thuc_thanh_toan">
                                <ul class="ch-menu">
                                    <li>
                                        <a href="#phuong_thuc_thanh_toan" class="pttt">
                                            <p>Thanh toán khi nhận hàng</p>
                                            <img src="/WebsiteBanHang/views/Contents/images/Icon_Wallet_sm.png" />
                                            <br/>
                                            <input type="radio" checked="true" name="cach_thanh_toan" value="khi nhận hàng" class="my-radio">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#phuong_thuc_thanh_toan" class="pttt">
                                            <p>Thanh toán qua thẻ ngân hàng</p>
                                            <img src="/WebsiteBanHang/views/Contents/images/icon_credit_card_sm.png">
                                            <br/>
                                            <input type="radio" name="cach_thanh_toan" value="bằng thẻ" class="my-radio">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <h3>Bước 4: Chọn cách giao hàng</h3>
                            <label for="cach_giao_hang_nhanh">Nhanh trong vòng 24h (có giá)</label>
                            <input type="radio" checked="true" id="cach_giao_hang_nhanh" name="cach_giao_hang" value="nhanh"><br/>
                            <label for="cach_giao_hang_cham">Chậm (trong vòng 7 ngày miễn phí)</label>
                            <input type="radio" id="cach_giao_hang_cham" name="cach_giao_hang" value="chậm"><br/>
                            <hr>
                            <h3>Bước 5: Kiểm tra kỹ thông tin trên sau đó bấm nút đặt hàng</h3>
                            <button type="submit" class="btn btn-success" id="btn-submit"><span class="glyphicon glyphicon-ok"></span> Đặt hàng</button>
                        </form>
                    </div>
                </div>
                <!--End Form thanh toan -->
                <div class="ch-box right-col col-xs-4">
                    <div class="ch-box-inner">
                        <h4>Thông tin đơn hàng</h4>
                        <hr>
                        <table data-toggle="table" class="ch-table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($sanpham)) {
                                    $tongtien = 0;
                                    foreach ($sanpham as $sanpham) {
                                        $tongtien += $sanpham->getGiasp() * $sanpham->getSoluong();
                                        ?>
                                        <tr>
                                            <td><?php echo $sanpham->getTensanpham(); ?></td>
                                            <td><?php echo $sanpham->getSoluong(); ?></td>
                                            <td><?php echo $sanpham->getGiasp(); ?> VND</td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <hr>
                        <?php if (isset($tongtien)) { ?>
                            <p>Tạm tính <span style="float: right"><span id="tamtinh"><?php echo $tongtien; ?>.000</span> VND</span></p>
                            <p>Phí giao hàng <span style="float: right"><span id="phigiaohang">0</span> VND</span></p>
                            <p style="font-size: 1.5em">Thành tiền <span style="float: right; color: blue"><strong><span id="thanhtien">0</span> VND</strong></span></p>
                                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!--End Content-->
        <!--Footer-->
        <?php include 'views/Layout/footer.php' ?>
        <!--End Footer-->
        <script>
            $(".pttt").click(function (event) {
                $(".my-radio").removeAttr("checked");
                $(this).find('input[type="radio"]').prop("checked", true);

            });
            function setChiPhi() {
                if ($("#cach_giao_hang_nhanh").is(":checked")) {
                    var chiphi = tinhPhiGiaoHang();
                    var tamtinh = parseInt($("#tamtinh").html());
                    tinhThanhTien(tamtinh, chiphi);
                }
            }

            $("#cach_giao_hang_cham").click(function (e) {
                $("#phigiaohang").html(0);
                var tamtinh = parseInt($("#tamtinh").html());
                tinhThanhTien(tamtinh, 0);
            });

            $("#cach_giao_hang_nhanh").click(function (e) {
                var chiphi = tinhPhiGiaoHang();
                var tamtinh = parseInt($("#tamtinh").html());
                tinhThanhTien(tamtinh, chiphi);
            });

            function tinhPhiGiaoHang() {
                var chiphi = $("#quan_huyen").val();
                if (chiphi !== "") {
                    chiphi = chiphi.split("|");
                    chiphi = parseInt(chiphi[1]);
                } else {
                    chiphi = 0;
                }
                $("#phigiaohang").html(chiphi + ".000");
                return chiphi;
            }

            function tinhThanhTien(tamtinh, chiphi) {
                var thanhtien = tamtinh + chiphi;
                $("#thanhtien").html(thanhtien + ".000");
            }

            $("#thanhtien").html(parseInt($("#tamtinh").html()) + ".000");

            function ganthongtin() {
                <?php if (isset($khachhang)) { ?>
                    $("#ten").val('<?php echo $khachhang->getTenkh(); ?>');
                    $("#diachi").val('<?php echo $khachhang->getDiachi(); ?>');
                    $("#dienthoai").val('<?php echo $khachhang->getDt(); ?>');
                <?php } else { ?>
                    alert("Chức năng chỉ tác dụng khi đăng nhập và chỉnh thông tin");
                <?php } ?>
            }
        </script>
        <?php if (!isset($sanpham)) { ?>
            <script type="text/javascript">
                var timeout = window.setTimeout(function () {
                    window.location = "/WebsiteBanHang/Home";
                }, 3000);
                $(document).ready(function () {
                    $("#timeout").removeClass("hidden");
                });
            </script>
        <?php } ?>

    </body>
</html>
