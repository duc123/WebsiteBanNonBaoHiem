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
        <?php include 'views/Layout/header.php'; ?>
        <!--End header-->

        <!--Navbar-->
        <?php include 'views/Layout/navbar.php'; ?>
        <!--End Navbar-->


        <div class="container">
            <div class="row well" style="margin-top: 1em">
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked well">
                        <li class="active"><a href="#thongtin" data-toggle="tab"><i class="fa fa-home"></i> Thông tin</a></li>
                        <li><a href="#lichsu" data-toggle="tab"><i class="fa fa-user" ></i> Lịch sử thanh toán</a></li>
                    </ul>
                </div>

                <div class="col-md-10 tab-content">
                    <div id="thongtin" class="tab-pane active">
                        <fieldset>
                            <legend>Thông tin tài khoản</legend>
                            <label>Tên:</label><span id="pten"> <?php echo ( empty($khachhang->getTenkh()) ? "" : $khachhang->getTenkh()); ?></span><br>
                            <label>Username:</label><span id="pusername"> <?php echo ( empty($khachhang->getUsername()) ? "" : $khachhang->getUsername()); ?></span><br>
                            <label>Điện thoại:</label><span id="pdienthoai"> <?php echo ( empty($khachhang->getDt()) ? "" : $khachhang->getDt()); ?></span><br>
                            <label>Email:</label><span id="pemail"> <?php echo ( empty($khachhang->getEmail()) ? "" : $khachhang->getEmail()); ?></span><br>
                            <label>Địa chỉ:</label><span id="pdiachi"> <?php echo ( empty($khachhang->getDiachi()) ? "" : $khachhang->getDiachi()); ?></span><br>
                            <label>Thành phố:</label><span id="pthanhpho"> <?php echo ( empty($khachhang->getThanhpho()) ? "" : $khachhang->getThanhpho()); ?></span><br>
                            <label>Quận huyện:</label><span id="pquan_huyen"> <?php echo ( empty($khachhang->getQuanHuyen()) ? "" : $khachhang->getQuanHuyen()); ?></span><br>
                            <label>Phường xã:</label><span id="pphuong_xa"> <?php echo ( empty($khachhang->getPhuongXa()) ? "" : $khachhang->getPhuongXa()); ?></span><br>
                            <a href="#edit" data-toggle="tab">Edit</a>
                        </fieldset>
                    </div>

                    <div id="lichsu" class="tab-pane">
                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th>Số phiếu</th>
                                    <th>Ngày lập</th>
                                    <th>Tên người nhận</th>
                                    <th>Địa chỉ</th>
                                    <th>Thành phố</th>
                                    <th>Quận huyện</th>
                                    <th>Phường xã</th>
                                    <th>Chi phí</th>
                                    <th>Tỏng tiền</th>
                                    <th>Ngày giao</th>
                                    <th>Tình trạng</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($phieudathang)) {
                                    foreach ($phieudathang as $pdh) {
                                        ?>
                                        <tr>
                                            <td><?php echo $pdh->getSophieu(); ?></td>
                                            <td><?php echo $pdh->getNgaylap()->format('d-m-Y'); ?></td>
                                            <td><?php echo $pdh->getTennguoinhan(); ?></td>
                                            <td><?php echo $pdh->getDiachi(); ?></td>
                                            <td><?php echo $pdh->getThanhpho(); ?></td>
                                            <td><?php echo $pdh->getQuanHuyen(); ?></td>
                                            <td><?php echo $pdh->getPhuongXa(); ?></td>
                                            <td><?php echo $pdh->getChiphi(); ?></td>
                                            <td><?php echo $pdh->getTongtien(); ?></td>
                                            <td><?php echo $pdh->getNgaygiao(); ?></td>
                                            <td><?php echo $pdh->getTinhtrang(); ?></td>
                                            <td><a href="javascript:;" onclick="chitietdonhang('<?php echo $pdh->getSophieu(); ?>')" class="coichitiet">Chi tiết</a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <p style="text-align: center; padding-top: 1em">Chi tiết đơn hàng</p>
                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody id="tbchitiet">
                                
                            </tbody>
                        </table>
                    </div>

                    <div id="edit" class="tab-pane">
                        <form method="POST" action="/WebsiteBanHang/Account/Update">
                            <fieldset>
                                <legend>Thông tin tài khoản (Edit)</legend>
                                <label>Tên: </label><input type="text" id="input_ten" name="ten"><br>
                                <label>Username:</label><input type="text" id="input_username" name="username"><br>
                                <label>Điện thoại:</label><input type="text" id="input_dt" name="dt"><br>
                                <label>Địa chỉ:</label><input type="text" id="input_diachi" name="diachi"><br>
                                <label>Thành phố:</label>
                                <select class="selectpicker" id="input_thanhpho" name="thanhpho">
                                    <option value="">Lựa chọn</option>
                                    <?php foreach ($thanhpho as $tp) { ?>
                                        <option value="<?php echo $tp->getTentp(); ?>"><?php echo $tp->getTentp(); ?></option>
                                    <?php } ?>
                                </select><br>
                                <label>Quận huyện:</label>
                                <select class="selectpicker" id="input_quanhuyen" name="quanhuyen">
                                    <option value="">Lựa chọn</option>
                                    <?php foreach ($quanhuyen as $qh) { ?>
                                        <option value="<?php echo $qh->getTenquanHuyen(); ?>"><?php echo $qh->getTenquanHuyen(); ?></option>
                                    <?php } ?>
                                </select><br>
                                <label>Phường xã:</label>
                                <select class="selectpicker" id="input_phuongxa" name="phuongxa">
                                    <option value="">Lựa chọn</option>
                                    <?php foreach ($phuongxa as $px) { ?>
                                        <option value="<?php echo $px->getTenpX(); ?>"><?php echo $px->getTenpX(); ?></option>
                                    <?php } ?>
                                </select><br>
                                <input type="submit" value="Update">
                            </fieldset>
                        </form>
                        <a href="#thongtin" data-toggle="tab">Back</a>
                    </div>
                </div>

            </div>
        </div>

        <!--Footer-->
        <?php include 'views/Layout/footer.php'; ?>
        <!--End Footer-->

        <script>
            $(function () {
                $("#input_ten").val($("#pten").html());
                $("#input_username").val($("#pusername").html());
                $("#input_dt").val($("#pdienthoai").html());
                $("#input_diachi").val($("#pdiachi").html());
                $("#input_thanhpho").val($("#pthanhpho").html());
                $("#input_quanhuyen").val($("#pquan_huyen").html());
                $("#input_phuongxa").val($("#pphuong_xa").html());
            });
            
            
            function chitietdonhang(donhangid){
                $.ajax({
                    url: "/WebsiteBanHang/Account/Chitietdonhang",
                    type: 'POST',
                    data: 'donhangid=' + donhangid,
                    success: function (data, textStatus, jqXHR) {
                        $("#tbchitiet").html(data);
                    }
                })
            };
        </script>
    </body>
</html>
