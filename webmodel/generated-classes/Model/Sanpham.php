<?php

namespace Model;

use Model\Base\Sanpham as BaseSanpham;

/**
 * Skeleton subclass for representing a row from the 'Sanpham' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Sanpham extends BaseSanpham
{
	private $soluong;
    
    
    function __construct() {
        parent::__construct();
        $this->soluong = 1;
    }


    public function getSoluong(){
        return $this->soluong;
    }
    
    public function setSoluong($soluong){
        $this->soluong = $soluong;
    }
    
    public function getThanhtien(){
        return $this->getGiasp() * $this->getSoluong();
    }
}
