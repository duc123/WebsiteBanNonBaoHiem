<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/WebsiteBanHang/setup.php';
//include_once 'classes/setup.php';
require 'classes/setup.php';

use Model\LoaispQuery;
use Model\SanphamQuery;
use Model\DanhmucQuery;
use Model\Phanhoi;

/**
 * Home Controller cho Home View
 */
class HomeController extends BaseController {

    //số sản phẩm dành cho 1 trang
    const SO_SP_1_TRANG = 6;

    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);
    }

    /**
     * Tạo trang HomeView/index.php
     */
    protected function index() {
        $trang_hien_tai = 0;

        session_start();
        //thay doi thanh !isset($_SESSION['dssanpham'])) khi up len host
        if (!isset($_SESSION['dssanpham'])) {
            //lấy danh sách loại sản phẩm
            $_SESSION['loai_sp'] = LoaispQuery::create()->find();
            $_SESSION['danhmuc'] = DanhmucQuery::create()->find();
            //lấy danh sách sản phẩm
            $dssanpham = SanphamQuery::create()->find();
            
            $q = filter_input(INPUT_GET, 'query');
            if($q != null){
                $dssanpham = SanphamQuery::create()->findByTensanpham($q);
            }
            $sotrang = $this->so_trang($dssanpham->count(), self::SO_SP_1_TRANG);
            //tạo 1 mảng chứa các mảng sản phẩm
            $trang_sanpham = $this->Tao_sanpham_theo_trang($sotrang, $dssanpham->getArrayCopy());
            //lưu các giá trị đã tính vào session
            $_SESSION['trang_sanpham'] = $trang_sanpham;
            $_SESSION['so_trang'] = $sotrang;
            $_SESSION['dssanpham'] = $dssanpham;
        } else {
            $trang_sanpham = $_SESSION['trang_sanpham'];
            $sotrang = $_SESSION['so_trang'];
            if (isset($this->urlvalues['id'])) {
                $trang_hien_tai = empty($this->urlvalues['id']) ? 0 : $this->urlvalues['id'] - 1;
            }
        }

        //tao view
        include 'views/Home/index.php';
    }

    /**
     * Tính số trang
     * @so_sanpham Số sản phẩm
     * @sanpham_1_trang Số sản phẩm cho 1 trang
     * @return Số trang
     */
    private function so_trang($so_sanpham, $sanpham_1_trang) {
        return ceil($so_sanpham / $sanpham_1_trang);
    }

    /**
     * Phân các sản phẩm theo trang
     * @sotrang Số trang hiện có
     * @dssanpham Danh sách sản phẩm
     * @return array chứa array sản phẩm
     */
    private function Tao_sanpham_theo_trang($sotrang, $dssanpham) {
        $trang_sanpham = [];
        $offset = 0;
        for ($i = 1; $i <= $sotrang; $i++) {
            $trang_sanpham[] = array_slice($dssanpham, $offset, self::SO_SP_1_TRANG);
            $offset += self::SO_SP_1_TRANG;
        }

        return $trang_sanpham;
    }

    public function sanpham() {
        $sp = SanphamQuery::create()->findPk($this->urlvalues['id']);
        include 'views/Home/Sanpham.php';
    }

    public function danhmuc() {
        session_start();
        $idloai = filter_input(INPUT_GET, 'l');
        $iddm = $this->urlvalues['id'];
        if($iddm != null){
            $_SESSION['id-danhmuc'] = $iddm;
        }
        $danhmuc = DanhmucQuery::create()->findPk($_SESSION['id-danhmuc']);
        $loaisp = $danhmuc->getLoaisps()->getArrayCopy('Maloaisp');
        $_SESSION['loai_sp'] = $loaisp;
        $sanpham = [];
        if ($idloai != null) {
            $l = $loaisp[$idloai];
            $sanpham = $l->getSanphams();
        } else {
            foreach ($loaisp as $loaisp) {
                $sanpham = array_merge($sanpham, $loaisp->getSanphams()->getArrayCopy());
            }
        }
//        $sotrang = $this->so_trang(count($sanpham), self::SO_SP_1_TRANG); 
//        $trang_sanpham = $this->Tao_sanpham_theo_trang($sotrang, $sanpham);
        include 'views/Home/Danhmuc.php';
    }
    
    public function phanhoi(){
        $post = filter_input_array(INPUT_POST);
        $phanhoi = new Phanhoi();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = date('H:i:s d-m-Y');
        $phanhoi->setNgayph($today);
        $phanhoi->setTennguoiph($post['ten']);
        $phanhoi->setEmail($post['email']);
        $phanhoi->setNoidung($post['noidung']);
        $phanhoi->save();
        header("Location: /WebsiteBanHang/Home");
    }

}
