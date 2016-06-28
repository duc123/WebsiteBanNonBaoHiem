<?php

	class Database{

		private $servername = "root";
		private $host = "127.0.0.1:3306";
		private $pass = "";
		private $dbname = "QuanLyBanHang";
		var $connclass = null;

		public function ketnoi()
		{
			$conn = new mysqli($this->host , $this->servername , $this->pass , $this->dbname);

			// tieng viet cho moi cau truy van 
			mysqli_set_charset($conn,'utf8');

			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			else{
				$this->connclass = $conn;
			}
		}

		public function huyketnoi()
		{
			$this->connclass->close();
		}
		public function GetSanpham($page)
		{
			$te = $page*9;
			$my_query = "SELECT * FROM Sanpham
						LIMIT $te,9";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GetSoTrangSanpham(){
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query("SELECT * FROM Sanpham");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function GetKhachHang($page)
		{
			$te = $page*9;
			$my_query = "SELECT * From KhachHang
						LIMIT $te,9";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GetSoTrangkh(){
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query("SELECT * From KhachHang");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function GetKhachHangToday($today,$page)
		{
			$te = $page*9;
			$my_query = "select * from KhachHang where MaKH in(select KhachHang_MaKH from PhieuDatHang where date(NgayLap) ='$today')
						LIMIT $te,9";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GetSoTrangkhtoday($today){
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query("select * from KhachHang where MaKH in(select MaKH from PhieuDatHang where NgayLap ='.$today.'");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function GetLoaiTinTuc(){
			$my_query = "SELECT * FROM LoaiQuangCao";
			return $this->connclass->query($my_query);
		}
		public function GetTinTuc1(){
			$my_query = "SELECT * FROM QuangCao LIMIT 0,3";
			return $this->connclass->query($my_query);
		}
		public function GetTinTuc(){
			$my_query = "SELECT * FROM QuangCao";
			return $this->connclass->query($my_query);
		}
		public function xemTinTuc($page){
			$baitren_mottrang = 6;
			$my_qury ='SELECT * FROM QuangCao
				LIMIT '.$page*$baitren_mottrang.','.$baitren_mottrang.'';
			$result = $this->connclass->query($my_qury);

			return $result;
		}
		public function GetSoTrang(){
			$baitren_mottrang = 6;
			$sodulieu = $this->connclass->query('SELECT * FROM QuangCao');
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function GetLoaiSP()
		{
			$my_query = "SELECT * FROM LoaiSP";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GetLoaiSPTHEOMA($maloai){
			$my_query = "SELECT TenLoai FROM LoaiSP WHERE MaLoai =".$maloai;
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GIOITHIEU(){
			$my_query = "SELECT * FROM gioithieu";
			$result = $this->connclass->query($my_query);
			return $result;
		}


	}

?>