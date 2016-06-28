<?php
	include '../../Model/pathFile.php';

	class ActionController extends Database {

		function __construct() {
			$this->ketnoi();
		}

		public function SanphamKM(){
			$my_query = "SELECT * FROM Sanpham
							ORDER BY ID ASC
							LIMIT 9";
			$result = $this->connclass->query($my_query);
			return $result;
		}

		public function DetailoneProduct($idSanpham){
			$my_query = "SELECT * FROM Sanpham WHERE MaSanpham = ".$idSanpham;
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function DetailoneNews($idSanpham){
			$my_query = "SELECT * FROM QuangCao WHERE MaQC = ".$idSanpham;
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GetSoTrang($temp){
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query('SELECT * FROM Sanpham  WHERE MaLoaiSP = '.$temp.'');
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public  function shd()
		{
			$temp = "SELECT MaDonHang FROM donhang  order by MaDonHang desc LIMIT 0, 1";
			$result = $this->connclass->query($temp);
			return $result;
		}
		public function ThanhToan($dems,$makh,$ngaylap,$tenkh,$dt,$diachi,$tongtien){

			$my_query = "INSERT INTO donhang
						 VALUES('{$dems}',
						 	'{$makh}',
						 	'{$ngaylap}',
						 	'NULL',
						 	'{$tenkh}',
						 	'{$dt}',
						 	'{$diachi}',
						 	'{$tongtien}',
						 	'0')";


			$this->connclass->query($my_query);
		}
		public function  capnhathd($id,$tem)
		{
			$mysql = "UPDATE PhieuDatHang SET NgayGiao = $tem, NgayGiao ='$tem'  WHERE NgayGiao is null AND SoPhieu =".$id;
			$result = $this->connclass->query($mysql);
			$mysql1 = "UPDATE DONHANG SET TONGTIEN =(SELECT  SUM(s.Gia * d.SoLuong) FROM Sanpham s, chitietdonhang d WHERE s.id = d.MaSanpham AND s.ID IN (SELECT MaSanpham FROM chitietdonhang WHERE MaDonHang =  '$id') AND d.MaDonHang =  '$id') WHERE MaDonHang ='$id'";
			$result1 = $this->connclass->query($mysql1);
		}
		public function XacThuc($shd,$sptemp,$sl){
			$query_string = "INSERT INTO chitietdonhang(`MaDonHang`,`MaSanpham`,`SoLuong`)
							 VALUES('$shd','{$sptemp}','{$sl}')";
			$this->connclass->query($query_string);
		}

		public function GetLoaiSanPham(){
			$my_query = "SELECT * FROM LoaiSP";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		////////////////////////////////

		public function ThemSanpham($ten,$chitiet,$gia,$MaLoaiSP,$hinh,$gianhap,$dvt){
			$my_query = "INSERT INTO Sanpham(`MaSanpham`, `TenSanpham`, `HInhAnh`, `GiaSP`, `DonViTinh`, `ThongTin`, `MaLoaiSP`, `GiaNhap`, `LuotXem`)
						VALUES(NULL,'{$ten}' ,
								'{$hinh}' ,
								'{$gia}' ,
								'{$dvt}',
								'{$chitiet}',
								'{$MaLoaiSP}' ,
								'{$gianhap}',
								  NULL)";
			$this->connclass->query($my_query);
		}
		public function DANGKYTV($user,$pass,$ten,$date,$dt,$mail,$diachi,$quan,$tp){
			$my_query = "INSERT INTO KhachHang(`username`,`password`,`TenKH`,`DT`,`Email`,`DiaChi`,`Quan`,`ThanhPho`)
							VALUES('$user' ,
								'{$pass}' ,
								'{$ten}' ,
								'{$dt}' ,
								'{$mail}',
								'{$diachi}' ,
								'{$quan}',
								'{$tp}')";
			$this->connclass->query($my_query);
		}
		public function ThemTinTuc($ten,$chitiet,$ngay,$link,$MaLoaiSP,$hinh){

			$my_query = "INSERT INTO `QuangCao`(`NoiDung`,`TenQC`,`HInhAnh`,`LoaiQuangCao_MaLQC`)
 						VALUES('{$chitiet}',
 						'{$ten}','{$hinh}','{$MaLoaiSP}')";
			$this->connclass->query($my_query);
		}

		public function SuaSanpham($id,$ten,$chitiet,$gia,$MaLoaiSP,$hinh,$gianhap,$dvt){
			$my_query = "UPDATE Sanpham
						 SET
							TenSanpham = '{$ten}' ,
							ThongTin = '{$chitiet}' ,
							GiaSP = '{$gia}' ,
							GiaNhap = '{$gianhap}' ,
							MaLoaiSP = '{$MaLoaiSP}' ,
							DonViTinh = '{$dvt}' ,
							HInhAnh = '{$hinh}'
						WHERE MaSanpham = '{$id}'";
			$this->connclass->query($my_query);
		}
		public function SuaTinTuc($id,$chitiet,$ten,$ngaydang,$link,$hinh,$MaLoaiSP){
			$my_query = "UPDATE QuangCao
						 SET
							TenQC = '{$ten}' ,
							NoiDung = '{$chitiet}' ,
							LoaiQuangCao_MaLQC = '{$MaLoaiSP}' ,
							HInhAnh = '{$hinh}'
						WHERE MaQC = '{$id}'";
			$this->connclass->query($my_query);
		}


		public function XoaSanpham($id){
			$my_query = "DELETE FROM Sanpham WHERE MaSanpham = '$id'";
			 $this->connclass->query($my_query);
		}
		public  function XoaLoaiTT($id)
		{
			$my_query = "DELETE FROM LoaiQuangCao WHERE MaLQC = '$id'";
			$this->connclass->query($my_query);
		}
		public function XoaTinTuc($id){
			$my_query = "DELETE FROM QuangCao WHERE MaQC = '$id'";
			$this->connclass->query($my_query);
		}

		public function GetAllLoai(){
			$my_query = "SELECT * FROM LoaiSP";
			return $this->connclass->query($my_query);
		}
		public function GetAllDANHMUC(){
			$my_query = "SELECT * FROM danhmuc";
			return $this->connclass->query($my_query);
		}


		public function GetoneLoai($id){
			$my_query = "SELECT * FROM LoaiSP WHERE MaLoaiSP = '{$id}'";
			return $this->connclass->query($my_query);
		}

		public function ThemLoai($ten,$dm){
			$my_query = "INSERT INTO LoaiSP(`TenLoaiSP`,`DanhMuc_MaDM`) VALUES('{$ten}','{$dm}')";
			$this->connclass->query($my_query);
		}
		public function ThemLoaiTin($ten){

			$my_query = "INSERT INTO LoaiQuangCao( `TenLoaiQuangCao`) VALUES('{$ten}')";
			$this->connclass->query($my_query);
		}

		public function XoaLoai($MaLoaiSP){
			$my_query = "DELETE FROM LoaiSP WHERE MaLoaiSP = '{$MaLoaiSP}'";
			$this->connclass->query($my_query);
		}

		public function SuaLoai($MaLoaiSP,$ten,$dm){
			$my_query = "UPDATE LoaiSP
						 SET TenLoaiSP = '{$ten}',DanhMuc_MaDM ='{$dm}'
						 WhERE MaLoaiSP = '{$MaLoaiSP}'";
			$this->connclass->query($my_query);
		}
		public function GetSanpham($page)
		{
			$te = $page*9;
			$my_query = "SELECT * FROM Sanpham
						LIMIT $te,9";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function hoadon($page)
		{
			$te = $page*5;
			$my_query="SELECT * FROM PhieuDatHang
						LIMIT $te,5";
			$result = $this->connclass->query($my_query);
			return $result;
		}
		public function GetSoTranghoadon(){
			$baitren_mottrang = 5;
			$sodulieu = $this->connclass->query("SELECT * FROM PhieuDatHang");
			$sodu_lieu = $sodulieu->num_rows;
			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function hoadondagiao($page)
		{
			$te = $page*5;
			$my_qury ="SELECT * FROM PhieuDatHang WHERE NgayGiao is not null
				LIMIT $te,5";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function SoTrangHoaDonGiao(){
			$baitren_mottrang = 5;
			$sodulieu = $this->connclass->query("SELECT * FROM PhieuDatHang WHERE NgayGiao is not null");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function hoadonchuagiao($page)
		{
			$te = $page*5;
			$my_qury ="SELECT * FROM PhieuDatHang WHERE NgayGiao is null
				LIMIT $te,5";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function SoTrangHoaDonChuaGiao(){
			$baitren_mottrang = 5;
			$sodulieu = $this->connclass->query("SELECT * FROM PhieuDatHang WHERE NgayGiao is null");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function hoadontrongngay($page)
		{
			$te = $page*5;
			$my_qury ="SELECT * FROM PhieuDatHang WHERE  date(NgayLap) =date((SELECT CURRENT_DATE))
				LIMIT $te,5";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function SoTrangHoaDontrongngay(){
			$baitren_mottrang = 5;
			$sodulieu = $this->connclass->query("SELECT * FROM PhieuDatHang WHERE  date(NgayLap) =date((SELECT CURRENT_DATE))");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function timkiemhodon($temp)
		{
			$my_qury ="SELECT * FROM `PhieuDatHang` WHERE `SoPhieu` ='$temp' or `TenNguoiNhan` = '$temp'";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function  timkiemKhachHang($temp)
		{
			$my_qury ="SELECT * FROM `KhachHang` WHERE MaKH ='$temp' or TenKH Like'%$temp%'";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function  timkiemsap($temp)
		{
			$my_qury ="SELECT * FROM `Sanpham` WHERE `MaSanpham` = '$temp' or `TenSanpham` like '%$temp%'";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function chitiethoadon($id){
			$my_query="SELECT CTPDH.*,`Sanpham`.`TenSanpham`,`Sanpham`.`GiaSP` FROM CTPDH,PhieuDatHang,Sanpham
			WHERE `CTPDH`.`PhieuDatHang_SoPhieu`=`PhieuDatHang`.`SoPhieu`
			and `Sanpham`.`MaSanpham`=`CTPDH`.`Sanpham_MaSanpham`
			and `CTPDH`.`PhieuDatHang_SoPhieu` = ".$id."";
			$result = $this->connclass->query($my_query);
			return $result;

		}
		public function Xoahoadon($mahd){
			$query="DELETE FROM CTPDH WHERE SoPhieu = '".$mahd."'";
			$my_query = "DELETE FROM PhieuDatHang WHERE SoPhieu = '".$mahd."'";
			$result =$this->connclass->query($query);
			$result =$this->connclass->query($my_query);
			return $result;
		}
		public  function LienHe($ten,$dt,$mail,$noidung,$date)
		{
			$my_query = "INSERT INTO `LienHe`(`TenNguoiLH`,`DienThoai`,`Email`)
 						VALUES('{$ten}' ,
 						'{$dt}' ,'{$mail}')";
			$this->connclass->query($my_query);
		}
		public function DANHSACHLIENHE()
		{
			$my_qury ="SELECT * FROM PhanHoi";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function xuly($id)
		{
			$my_query = "UPDATE LienHe
						 SET NgayGiao = 1
						 WhERE MaLienHe = '{$id}'";
			$this->connclass->query($my_query);
		}
		public  function UPDATELXSP($id)
		{
			$my_query = "UPDATE Sanpham
						 SET LuotXem = LuotXem +1
						 WhERE MaSanpham = '{$id}'";
			$this->connclass->query($my_query);
		}
		//TH?NG K� SAN PHAM
		public function SanphamCHUABAN($page)
		{
			$te = $page*9;
			$my_qury ="SELECT * FROM `Sanpham` WHERE NOT MaSanpham IN (SELECT Sanpham_MaSanpham FROM CTPDH)
						LIMIT $te,9";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function sotrangSanphamchuban(){
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query("SELECT * FROM `Sanpham` WHERE NOT MaSanpham IN (SELECT Sanpham_MaSanpham FROM CTPDH)");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function TONGSanpham()
		{
			$my_qury ="SELECT COUNT(MaSanpham) as TONGSP FROM `Sanpham`";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function SOLUONGSanphamCHUABAN()
		{
			$my_qury ="SELECT COUNT(MaSanpham) as TONGSP FROM `Sanpham` WHERE NOT MaSanpham IN (SELECT Sanpham_MaSanpham FROM CTPDH)";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function TONGSanphamBAN()
		{
			$my_qury ="SELECT COUNT(MaSanpham) as TONGSP FROM `Sanpham` WHERE MaSanpham IN (SELECT Sanpham_MaSanpham FROM CTPDH)";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function  SanphamBAN($page)
		{
			$te = $page*9;
			$my_qury ="SELECT * FROM `Sanpham` WHERE MaSanpham IN (SELECT Sanpham_MaSanpham FROM CTPDH)
						LIMIT $te,9";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function sotrangSanphamban(){
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query("SELECT * FROM `Sanpham` WHERE MaSanpham IN (SELECT Sanpham_MaSanpham FROM CTPDH");
			$sodu_lieu = $sodulieu->num_rows;

			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function Tonghoadon()
		{
			$my_qury ="SELECT COUNT(SoPhieu) as TONGPHIEU FROM `PhieuDatHang`";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function Tonghoadondagiao()
		{
			$my_qury ="SELECT COUNT(SoPhieu) as TONGPHIEU FROM `PhieuDatHang` WHERE NgayGiao is not null";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function Tonghoadonchuagiao()
		{
			$my_qury ="SELECT COUNT(SoPhieu) as TONGPHIEU FROM `PhieuDatHang` WHERE NgayGiao is null";
			$result = $this->connclass->query($my_qury);
			return $result;
		}

		public function thongkehoadontheothang($date,$page)
		{
			$my_qury ="SELECT * FROM PhieuDatHang WHERE month(NgayLap) =MONTH('$date') AND YEAR(NgayLap) = YEAR('$date')";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function thongketheongay($date,$page)
		{
			$my_qury ="SELECT * FROM PhieuDatHang WHERE date('$date') = date(NgayLap)";
			$result = $this->connclass->query($my_qury);
			return $result;

		}
		public function sotrangthongkehoadontheothang($date)
		{
			$baitren_mottrang = 5;
			$sodulieu = $this->connclass->query("SELECT * FROM PhieuDatHang WHERE month(NgayLap) =MONTH('$date') AND YEAR(NgayLap) = YEAR('$date')");
			$sodu_lieu = $sodulieu->num_rows;
			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function TongKhachHang()
		{
			$my_qury ="SELECT COUNT(MaKH) as TONGKH FROM `KhachHang`";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function sotrangtongKhachHang()
		{
			$baitren_mottrang = 9;
			$sodulieu = $this->connclass->query("SELECT * FROM `KhachHang`");
			$sodu_lieu = $sodulieu->num_rows;
			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function tongsokhachchuamua()
		{
			$my_qury ="SELECT COUNT(MaKH) as TONGKH FROM `KhachHang` WHERE NOT MaKH IN (SELECT KhachHang_MaKH FROM PhieuDatHang) ";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function KhachHangchuamua($page)
		{
			$te = $page*7;
			$my_qury ="SELECT * FROM `KhachHang` WHERE NOT MaKH IN (SELECT KhachHang_MaKH FROM PhieuDatHang)
						LIMIT $te,7 ";
			$result = $this->connclass->query($my_qury);
			return $result;
		}
		public function sotrangKhachHangmua()
		{
			$baitren_mottrang = 6;
			$sodulieu = $this->connclass->query("SELECT * FROM `KhachHang` WHERE MaKH IN (SELECT KhachHang_MaKH FROM PhieuDatHang)");
			$sodu_lieu = $sodulieu->num_rows;
			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function sotrangKhachHangchuamua(){
			$baitren_mottrang = 7;
			$sodulieu = $this->connclass->query("SELECT * FROM `KhachHang` WHERE NOT MaKH IN (SELECT KhachHang_MaKH FROM PhieuDatHang)");
			$sodu_lieu = $sodulieu->num_rows;
			$sotrang = $sodu_lieu/$baitren_mottrang;
			return $sotrang;
		}
		public function KhachHangmua($page)
		{
			$te = $page*6;
			$my_qury ="SELECT * FROM `KhachHang` WHERE MaKH IN (SELECT KhachHang_MaKH FROM PhieuDatHang)
						LIMIT $te,6 ";
			$result = $this->connclass->query($my_qury);
			return $result;
		}



	}

?>