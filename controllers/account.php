<?php

require 'classes/setup.php';

use Model\Khachhang;
use Model\KhachhangQuery;
use Model\ThanhphoQuery;
use Model\QuanHuyenQuery;
use Model\PhuongXaQuery;
use Model\PhieudathangQuery;

class AccountController extends BaseController {

    public function register() {
        session_start();
        $post = filter_input_array(INPUT_POST);
        if ($post == null) {
            include 'views/Account/Account.php';
        } else {
            $kh = new Khachhang();
            $kh->setEmail($post['email']);
            $kh->setUsername($post['username']);
            $pass = $post['InputPassWord'];
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $kh->setPassword($hash);
            $kh->save();
            $success = true;
            include 'views/Account/Account.php';
        }
    }

    public function login() {
        $error = 0;
        $post = filter_input_array(INPUT_POST);
        if ($post['email'] === "" && $post['password'] === "") {
            $array["success"] = "error";
        } else {
            $khach = KhachhangQuery::create()->findByEmail($post['email'])->getFirst();
            // nếu email khách không tồn tại
            if (empty($khach)) {
                $error += 1;
            } else {
                // nếu tồn tại thì kiểm tra pass
                if (!password_verify($post['password'], $khach->getPassword())) {
                    $error += 1;
                }
            }

            if (empty($error)) {
                session_start();
                $array["success"] = true;
                $_SESSION['khachhang'] = $khach->getMakh() . '|' . $khach->getUsername();
                if (isset($post['remember'])) {
                    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
                    setcookie('khachhang', $khach->getMakh() . '|' . $khach->getUsername(), time() + 60 * 60, '/', $domain, FALSE);
                }
            } else {
                $array["success"] = false;
            }
        }

        echo json_encode($array);
    }

    public function logout() {
        session_start();
        setcookie('khachhang', '', time() - 3600, '/');
        unset($_SESSION['khachhang']);
        unset($_COOKIE['khachhang']);
        header('Location: /WebsiteBanHang/Home');
    }

    public function profile() {
        session_start();
        if (isset($_SESSION['khachhang'])) {
            $makh = explode('|', $_SESSION['khachhang'])[0];
            $khachhang = KhachhangQuery::create()->findPk($makh);
            $phieudathang = $khachhang->getPhieudathangs();
            $thanhpho = ThanhphoQuery::create()->find();
            $quanhuyen = QuanHuyenQuery::create()->find();
            $phuongxa = PhuongXaQuery::create()->find();
            include 'views/Account/Profile.php';
        }else{
            include 'views/Error/nologin.php';
        }
    }
    
    public function update(){
        session_start();
        $makh = explode('|', $_SESSION['khachhang'])[0];
        $khachhang = KhachhangQuery::create()->findPk($makh);
        $post = filter_input_array(INPUT_POST);
        $khachhang->setTenkh($post['ten']);
        $khachhang->setUsername($post['username']);
        $khachhang->setDt($post['dt']);
        $khachhang->setDiachi($post['diachi']);
        $khachhang->setThanhpho($post['thanhpho']);
        $khachhang->setQuanHuyen($post['quanhuyen']);
        $khachhang->setPhuongXa($post['phuongxa']);
        $khachhang->save();
        header('Location: /WebsiteBanHang/Account/Profile');
    }
    
    public function chitietdonhang(){
        $ctpdh = PhieudathangQuery::create()->findPk(filter_input(INPUT_POST, 'donhangid'))->getCtpdhs();
        include 'views/Account/Chitietdonhang.php';
    }

}
