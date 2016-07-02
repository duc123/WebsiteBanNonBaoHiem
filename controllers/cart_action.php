<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/WebsiteBanHang/classes/setup.php';
//include_once 'classes/setup.php';
require filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/WebsiteBanHang/classes/setup.php';
header('Content-Type: application/json');

use Model\SanphamQuery;

\session_start();
$post = filter_input(INPUT_POST, 'action');
if ($post) {
    $id = filter_input(INPUT_POST, 'id');
    switch ($post) {
        case "add":
            if (empty($_SESSION['dssanpham'])) {
                $dssanpham = SanphamQuery::create()->find();
            } else {
                $dssanpham = $_SESSION['dssanpham'];
            }
            $sl = filter_input(INPUT_POST, 'sl');
            $sanphamById = $dssanpham->getArrayCopy("Masanpham");
            $sanpham = $sanphamById[$id];
            $sanpham->setSoluong($sl);
            if (empty($_SESSION['cart-items'])) {
                $array[$sanpham->getMasanpham()] = $sanpham;
                $_SESSION['cart-items'] = $array;
            } else {
                if (array_key_exists($sanpham->getMasanpham(), $_SESSION['cart-items'])) {
                    $sp = $_SESSION['cart-items'][$sanpham->getMasanpham()];
                    $sp->setSoluong($sl);
                } else {
                    $_SESSION['cart-items'][$sanpham->getMasanpham()] = $sanpham;
                }
            }
            break;
        case "remove":
            unset($_SESSION['cart-items'][$id]);
            break;
        case "empty":
            unset($_SESSION['cart-items']);
            break;
    }
}

$tong_so_luong = 0;
$tong_tien = 0;
if (!empty($_SESSION['cart-items'])) {
    foreach ($_SESSION['cart-items'] as $sp) {
        $tong_so_luong += $sp->getSoluong();
        $tong_tien += ($sp->getSoluong() * $sp->getGiasp());
    }
}

echo '{"tong_so_luong":"' . $tong_so_luong . '","tong_tien":"' . $tong_tien . '","rowid":"sp_' . filter_input(INPUT_POST, "id") . '"}';
