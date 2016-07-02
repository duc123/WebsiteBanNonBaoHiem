<?php

require 'classes/setup.php';

use Model\Khachhang;
use Model\KhachhangQuery;

class AccountController extends BaseController {

    public function register() {
        $post = filter_input_array(INPUT_POST);
        if ($post == null) {
            include 'views/Account/Account.php';
        } else {
            $kh = new Khachhang();
            $kh->setEmail($post['InputEmail']);
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
        if($post['email'] === "" && $post['password'] === ""){
            $array["success"] = "error";
        }else{
            $khach = KhachhangQuery::create()->findByEmail($post['email'])->getFirst();
            // nếu email khách không tồn tại
            if(empty($khach)){
                $error += 1;
            }else{
                // nếu tồn tại thì kiểm tra pass
                if(!password_verify($post['password'], $khach->getPassword())){
                    $error += 1;
                }
            }
            
            if(empty($error)){
                session_start();
                $array["success"] = true;
                $_SESSION['user-email'] = $post['email'];
                if(isset($post['remember'])){
                        $_COOKIE['user-email'] = $post['email'];
                        
                    }
            }else{
                $array["success"] = false;
            }
        }
        
        echo json_encode($array);
    }
    
    public function logout(){
        session_start();
        unset($_SESSION['user-email']);
        header('Location: /WebsiteBanHang/Home');
    }

}
