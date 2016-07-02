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
                            <div class="myaccount"><a title="Tài khoản" href="/account"><span class="hidden-xs" id="user">Tài khoản</span></a></div>
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

                <div class="signup"><a title="Đăng ký" href="/WebsiteBanHang/Account/Register"><span>Đăng ký ngay</span></a></div>
                <span class="or"> hoặc </span>
                <?php if (!isset($_SESSION['user'])) { ?>
                    <div class="login"><a title="Đăng nhập" href="/WebsiteBanHang/Account/Login"><span id="dangnhap">Đăng nhập</span></a></div>
                <?php } else { ?>
                    <div class="login"><a title="Đăng xuất" href="/WebsiteBanHang/Account/Logout"><span id="dangxuat">Đăng xuất</span></a></div>
                <?php } ?>
            </div>
            <!-- End Top Cart -->
        </div>
    </div>



</header>
