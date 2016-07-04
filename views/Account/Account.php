<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Đăng ký</title>
        <?php include 'views/Layout/head.php'; ?>
    </head>
    <body>
        <?php include 'views/Layout/header.php'; ?>
        <div class="container" style="margin-top: 1em">
            <div class="row">
                <div class="col-lg-6">
                    <form role="form" action="/WebsiteBanHang/Account/Register" method="POST" id="formdangky">

                        <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Thông tin bắt buộc</strong></div>
                        <div class="form-group">
                            <label for="email">Nhập Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Nhập Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputPassWord">Nhập Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="InputPassWord" name="InputPassWord">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputRePassWord">Nhập lại Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="InputRePassWord" name="InputRePassWord">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                    </form>
                </div>
                
                <?php if(isset($success)) { ?>
                <div id="success" class="col-lg-6" style="text-align: center;" >
                    <span class="label label-success" style="color: white; font-size: 2em">
                        <span class="glyphicon glyphicon-ok"></span>
                        Đăng ký thành công
                        hãy bấm đăng nhập
                    </span>
                </div>
                <?php } ?>


            </div>
        </div>
        <?php include 'views/Layout/footer.php'; ?>
        <script>
            $(document).ready(function () {
                $("#formdangky").validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                            remote: {
                                url: "/WebsiteBanHang/controllers/check-email.php",
                                type: "POST"
                            }
                        },
                        InputPassWord: "required",
                        username : {
                            required: true,
                            remote:{
                                url: "/WebsiteBanHang/controllers/check-username.php",
                                type: "POST"
                            }
                        },
                        InputRePassWord: {
                            required: true,
                            equalTo: "#InputPassWord"
                        }
                    },
                    messages: {
                        email: {
                            required: "Thông tin bắt buộc",
                            remote: "Email đã có tài khoản xin hãy đăng nhập",
                            email: "Email phải đúng định dạng vd: example@domain.com"
                        },
                        InputPassWord: "Cần có mật khẩu để đăng nhập",
                        username: {
                            required: "Cần nhập username",
                            remote: "username đã tồn tại"
                        },
                        InputRePassWord: {
                            required: "Cần phải nhập lại mật khẩu",
                            equalTo: "Mật khẩu nhập lại phải giống mật khẩu gốc"
                        }
                    }
                });
            });
        </script>
    </body>
</html>
