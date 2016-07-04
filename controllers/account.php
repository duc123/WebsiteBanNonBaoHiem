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
            $kh->setUsername($post['usename']);
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
                $_SESSION['user'] = $khach;
                if(isset($post['remember'])){
                        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
                        setcookie('user',$khach->getMakh() .'|'. $khach->getUsername(),time()+60*60,'/',$domain,FALSE);
                    }
            }else{
                $array["success"] = false;
            }
        }
        
        echo json_encode($array);
    }
    
    public function logout(){
        session_start();
        setcookie('user','',  time()-3600,'/');
        unset($_SESSION['user']);
        unset($_COOKIE['user']);
        header('Location: /WebsiteBanHang/Home');
    }

}
