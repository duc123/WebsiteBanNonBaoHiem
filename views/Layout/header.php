<?php
if (isset($_COOKIE['khachhang']) && !isset($_SESSION['khachhang'])) {
    $_SESSION['khachhang'] = $_COOKIE['khachhang'];
}
if (isset($_SESSION['khachhang'])) {
    $username = explode('|', $_SESSION['khachhang'])[1];
}
?>
<header class="header-container">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Header Language -->
                <div class="col-xs-6">
                    <div class="welcome-msg hidden-xs">Chào mừng bạn đã đến với website Safety</div>
                </div>
                <div class="col-xs-6">
                    <!-- Header Top Links -->
                    <div class="toplinks">
                        <div class="links">
                            <div class="myaccount"><a title="Tài khoản" href="/WebsiteBanHang/Account/Profile"><span class="hidden-xs" id="user"><?php echo (isset($username) ? $username : "Tài khoản"); ?></span></a></div>
                            <div class="check"><a title="Thanh toán" href="/WebsiteBanHang/Home/Thanhtoan"><span class="hidden-xs">Thanh toán</span></a></div>
                        </div>
                    </div>
                    <!-- End Header Top Links -->
                </div>
            </div>
        </div>
    </div>
    <div class="header container">
        <div class="row">
            <div class="col-lg-2 col-sm-3 col-md-2 col-xs-12">
                <!-- Header Logo -->
                <a class="logo" title="Safety" href="/WebsiteBanHang/Home"><img alt="Safety" src="/WebsiteBanHang/views/Contents/images/logo2_sm.png"></a>
                <!-- End Header Logo -->
            </div>
            <div class="col-lg-6 col-sm-5 col-md-6 col-xs-12">
                <!-- Search-col -->
                <div class="search-box">
                    <form action="/WebsiteBanHang/Home/" method="get" id="search_mini_form">
                        <input type="text" placeholder="Nhập từ khóa cần tìm kiếm" value="" maxlength="70" class="" name="query" id="search">
                        <button id="submit-button" class="search-btn-bg" type="submit"><span>Tìm kiếm</span></button>
                    </form>
                </div>
                <!-- End Search-col -->
            </div>
            <!-- Top Cart -->
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <?php if (!isset($_SESSION['khachhang'])) { ?>
                    <div class="signup"><a title="Đăng ký" href="/WebsiteBanHang/Account/Register"><span>Đăng ký ngay</span></a></div>
                    <span class="or"> hoặc </span>
                    <div class="login"><a id="modal_trigger" title="Đăng nhập" href="#modal"><span id="dangnhap">Đăng nhập</span></a></div>
                <?php } else { ?>
                    <div class="login"><a title="Đăng xuất" href="/WebsiteBanHang/Account/Logout"><span id="dangxuat">Đăng xuất</span></a></div>
                <?php } ?>
            </div>
            <!-- End Top Cart -->
        </div>
        <!--Pop up login-->
        <div id="modal" class="popupContainer" style="display:none;">
            <header class="popupHeader">
                <span class="header_title">Login</span>
                <span class="modal_close"><i class="fa fa-times"></i></span>
            </header>

            <section class="popupBody">
                <!-- Username & Password Login form -->
                <div class="user_login">
                    <label id="invalid" class="error hidden">Đăng nhập thất bại, bạn nhập sai thông tin hoặc chưa đăng ký</label>
                    <label id="error" class="error hidden">Bạn cần nhập Email với Password đầy đủ</label>
                    <form method="POST" action="/WebsiteBanHang/Account/Login" id="formAjax">
                        <label>Email</label>
                        <input type="email" name="email" required/>
                        <br />

                        <label>Password</label>
                        <input type="password" name="password" required/>
                        <br />

                        <div class="form-group">
                            <input id="remember" type="checkbox" name="remember"/>
                            <label for="remember">Remember me on this computer</label>
                        </div>

                        <div class="action_btns" style="padding-top: 1.2em;">
                            <div class="one_half"><a href="#" class="forgot_password">Forgot password?</a></div>
                            <div class="one_half last"><a href="javascript:;" id="submit" class="btn_popup btn_red">Login</a></div>
                        </div>
                    </form>

                </div>

            </section>
        </div>
    </div>




    <script type="text/javascript">
        $("#modal_trigger").leanModal({top: 200, overlay: 0.6, closeButton: ".modal_close"});

        $("#submit").click(function () {
            $("#formAjax").ajaxSubmit({
                dataType: 'json',
                success: function (data) {
                    //alert(data.success);
                    if (data.success === false) {
                        $("#invalid").removeClass("hidden");
                    } else {
                        if (data.success === "error") {
                            $("#error").removeClass("hidden");
                        } else {
                            window.location = "/WebsiteBanHang/Home";
                        }
                    }
                }
            });
        });


    </script>

</header>
