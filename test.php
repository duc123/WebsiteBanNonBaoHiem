<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require 'classes/setup.php';

use Model\LoaispQuery;
use Model\ThanhphoQuery;
use Model\PhuongXaQuery;

//$mail = new PHPMailer();
//$mail->isSMTP();
//$mail->SMTPDebug = 4;
//$mail->Debugoutput = 'html';
//$mail->Host = 'smtp.mail.yahoo.com';
//$mail->Port = 465;
//$mail->SMTPSecure = 'ssl';
//$mail->SMTPAuth = true;
//$mail->Username = "banhangnhanvien@yahoo.com";
//$mail->Password = 'deancnpm13dth10';
//$mail->setFrom("banhangnhanvien@yahoo.com", "test email");
//$mail->addReplyTo("banhangnhanvien@yahoo.com", "hong duc");
//$mail->addAddress('hongducphannuyen@yahoo.com', 'duc hong');
//$mail->Subject = "Test mail";
//$mail->msgHTML("hello world");
//$mail->AltBody = "day la AltBody";
//$mail->CharSet = "UTF-8";
//$mail->Encoding = "base64";
//
//if (!$mail->send()) {
//    echo 'co loi khi gui mail: ' . $mail->ErrorInfo;
//} else {
//    echo 'da gui thanh cong';
//}

//$kh = Model\KhachhangQuery::create()->findPk(1);
//$kh->setTenkh("hong duc");
//$row = $kh->save();
//echo $row;
