<?php
header('Content-Type: application/json');
require_once '../classes/setup.php';
use Model\KhachhangQuery;
$post = filter_input_array(INPUT_POST);
$kh = KhachhangQuery::create()->findByUsername($post['username']);
$sl = $kh->count();
if($sl > 0){
    echo 'false';
}else{
    echo 'true';
}