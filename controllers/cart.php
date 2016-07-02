<?php

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
/**
 * Description of cart
 *
 * @author duc
 */
require 'classes/setup.php';
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

use Model\ThanhphoQuery;
use Model\QuanHuyenQuery;
use Model\PhuongXaQuery;
use Model\Phieudathang;
use Model\Ctpdh;

class CartController extends BaseController {

    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);
    }

    public function index() {
        session_start();
        if (!empty($_SESSION['cart-items'])) {
            $sanpham = $_SESSION['cart-items'];
        }
        include 'views/Cart/index.php';
    }

    public function thanhtoan() {
        session_start();
        if (!empty($_SESSION['cart-items'])) {
            /* @var $sanpham \Model\Sanpham */
            $sanpham = $_SESSION['cart-items'];
        }
        $thanhpho = ThanhphoQuery::create()->find();
        $quanhuyen = QuanHuyenQuery::create()->find();
        $phuongxa = PhuongXaQuery::create()->find();
        include 'views/Cart/ThanhToan.php';
    }

    public function dathang() {
        session_start();
        $arrayPost = filter_input_array(INPUT_POST);
        $sanpham = $_SESSION['cart-items'];

        $quanhuyen_chiphi = explode("|", $arrayPost['quan_huyen']);
        $arrayPost['quan_huyen'] = $quanhuyen_chiphi[0];

        $arrayPost['tongtien'] = $this->tinhTongTien($sanpham);

        if ($arrayPost['cach_giao_hang'] == "chậm") {
            $arrayPost["chiphi"] = 0;
        } else {
            $arrayPost["chiphi"] = $quanhuyen_chiphi[1];
        }

        $phieudathang = $this->taoPhieuDatHang($arrayPost);
        $this->taoCTPDH($sanpham, $phieudathang);


        $success = $this->send_mail($arrayPost);
        unset($_SESSION['cart-items']);

        include 'views/Cart/DatHang.php';
    }

//    private function filter_keys_array($array, $key_array) {
//        $keys = array_keys($array);
//        foreach ($key_array as $key_array) {
//            if (in_array($key_array, $keys)) {
//                continue;
//            }
//            $array[$key_array] = '';
//        }
//        return $array;
//    }

    private function tinhTongTien($sanpham) {
        $tongtien = 0;
        foreach ($sanpham as $sanpham) {
            $tongtien += $sanpham->getGiasp();
        }
        return $tongtien;
    }

    private function taoPhieuDatHang($arrayPost) {
        $phieudathang = new Phieudathang();
        $phieudathang->setTennguoinhan($arrayPost['ten']);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date('H:i:s d-m-Y');
        $phieudathang->setNgaylap($today);
        $phieudathang->setDiachi($arrayPost['diachi']);
        $phieudathang->setThanhpho($arrayPost['thanhpho']);
        $phieudathang->setQuanHuyen($arrayPost['quan_huyen']);
        $phieudathang->setPhuongXa($arrayPost['phuong_xa']);
        $phieudathang->setChiphi($arrayPost['chiphi']);
        $phieudathang->setTongtien($arrayPost['tongtien']);
        $phieudathang->save();
        return $phieudathang;
    }

    private function taoCTPDH($sanpham, $phieudathang) {
        foreach ($sanpham as $sanpham) {
            $ctpdh = new Ctpdh();
            $ctpdh->setPhieudathang($phieudathang);
            $ctpdh->setSanpham($sanpham);
            $ctpdh->setSoluong($sanpham->getSoluong());
            $ctpdh->save();
        }
    }

    private function send_mail($arrayPost) {
        $to = $arrayPost['email'];
        $subject = 'Phiếu đặt hàng';
        $message = "Tên người nhận: ".$arrayPost['ten']."\r\n"
                . "Địa chỉ: ".$arrayPost['diachi']."\r\n"
                . "Thành phố: ".$arrayPost['thanhpho']."\r\n"
                . "Quận-Huyện: ".$arrayPost['quan_huyen']."\r\n"
                . "Phường-Xã: ".$arrayPost['phuong_xa']."\r\n"
                . "Số điện thoại người nhận: ".$arrayPost['dtthoai']."\r\n"
                . "Cách thanh toán: ".$arrayPost['cach_thanh_toan']."\r\n"
                . "Cách giao hàng:  ".$arrayPost['cach_giao_hang']."\r\n";
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->Host = 'smtp.mail.yahoo.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = "banhangnhanvien@yahoo.com";
        $mail->Password = 'deancnpm13dth10';
        $mail->setFrom("banhangnhanvien@yahoo.com", "Shop Safety");
        $mail->addReplyTo("banhangnhanvien@yahoo.com", "Shop Safety");
        $mail->addAddress($to, $arrayPost['ten']);
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->AltBody = "day la AltBody";
        return $mail->send();
    }

}
