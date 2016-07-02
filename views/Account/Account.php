<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <?php include 'views/Layout/head.php'; ?>
    </head>
    <body>
        <?php include 'views/Layout/header.php'; ?>
        <?php if (isset($error)) { ?>
            <p>Đăng nhập sai hãy đăng nhập lại</p>
        <?php } ?>
        <div class="container">
            <div class="row">
                <form role="form" action="/WebsiteBanHang/Account/<?php echo $action;?>" method="POST">
                    <div class="col-lg-6">
                        <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                        <div class="form-group">
                            <label for="InputEmail">Nhập Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="InputEmailFirst" name="InputEmail" placeholder="Enter Email" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputPassWord">Nhập Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="" name="InputPassWord" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                    </div>
                </form>
            </div>
        </div>
        <?php include 'views/Layout/footer.php'; ?>
    </body>
</html>
