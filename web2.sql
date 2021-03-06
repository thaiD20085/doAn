-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for web2
CREATE DATABASE IF NOT EXISTS `doqqwyfj_web2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `doqqwyfj_web2`;

-- Dumping structure for table web2.chudegopy
CREATE TABLE IF NOT EXISTS `chudegopy` (
  `cdgy_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cdgy_ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cdgy_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.chudegopy: ~5 rows (approximately)
/*!40000 ALTER TABLE `chudegopy` DISABLE KEYS */;
INSERT INTO `chudegopy` (`cdgy_ma`, `cdgy_ten`) VALUES
	(1, 'Dịch vụ'),
	(2, 'Sản phẩm'),
	(3, 'Giao hàng'),
	(4, 'Hình thức thanh toán');
/*!40000 ALTER TABLE `chudegopy` ENABLE KEYS */;

-- Dumping structure for table web2.dondathang
CREATE TABLE IF NOT EXISTS `dondathang` (
  `dh_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dh_ngaylap` datetime NOT NULL,
  `dh_ngaygiao` datetime DEFAULT NULL,
  `dh_noigiao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dh_trangthaithanhtoan` int(11) NOT NULL,
  `httt_ma` int(11) unsigned NOT NULL,
  `kh_tendangnhap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dh_ma`),
  KEY `FK_dondathang_hinhthucthanhtoan` (`httt_ma`),
  KEY `FK_dondathang_khachhang` (`kh_tendangnhap`),
  CONSTRAINT `FK_dondathang_hinhthucthanhtoan` FOREIGN KEY (`httt_ma`) REFERENCES `hinhthucthanhtoan` (`httt_ma`),
  CONSTRAINT `FK_dondathang_khachhang` FOREIGN KEY (`kh_tendangnhap`) REFERENCES `khachhang` (`kh_tendangnhap`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.dondathang: ~3 rows (approximately)
/*!40000 ALTER TABLE `dondathang` DISABLE KEYS */;
INSERT INTO `dondathang` (`dh_ma`, `dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `dh_trangthaithanhtoan`, `httt_ma`, `kh_tendangnhap`) VALUES
	(19, '2021-02-27 20:03:52', '0000-00-00 00:00:00', 'Vĩnh Long', 1, 5, 'admin1'),
	(20, '2021-02-27 20:11:13', '2021-02-27 20:11:13', 'Hậu Giang', 1, 7, 'admin1'),
	(23, '2021-02-27 20:14:06', '2021-02-27 20:14:06', 'Vĩnh Long', 1, 6, 'admin1');
/*!40000 ALTER TABLE `dondathang` ENABLE KEYS */;

-- Dumping structure for table web2.gopy
CREATE TABLE IF NOT EXISTS `gopy` (
  `gy_ma` int(11) NOT NULL AUTO_INCREMENT,
  `gy_hoten` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gy_email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gy_diachi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gy_dienthoai` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gy_tieude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gy_noidung` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `gy_ngaygopy` datetime DEFAULT NULL,
  `cdgy_ma` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`gy_ma`),
  KEY `FK_gopy_chudegopy` (`cdgy_ma`),
  CONSTRAINT `FK_gopy_chudegopy` FOREIGN KEY (`cdgy_ma`) REFERENCES `chudegopy` (`cdgy_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.gopy: ~0 rows (approximately)
/*!40000 ALTER TABLE `gopy` DISABLE KEYS */;
INSERT INTO `gopy` (`gy_ma`, `gy_hoten`, `gy_email`, `gy_diachi`, `gy_dienthoai`, `gy_tieude`, `gy_noidung`, `gy_ngaygopy`, `cdgy_ma`) VALUES
	(1, 'Trương Quốc Thái', 'thaitruong1605@gmail.com', 'Cần Thơ', '0706823275', 'Card màn hình ', 'Xin chào Admin. Cho tôi hỏi card màn hình nào tốt nhất năm 2021?', '2021-02-27 00:00:00', 2);
/*!40000 ALTER TABLE `gopy` ENABLE KEYS */;

-- Dumping structure for table web2.hinhsanpham
CREATE TABLE IF NOT EXISTS `hinhsanpham` (
  `hsp_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hsp_tentaptin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_ma` int(11) unsigned NOT NULL,
  PRIMARY KEY (`hsp_ma`),
  KEY `FK_hinhsanpham_sanpham` (`sp_ma`),
  CONSTRAINT `FK_hinhsanpham_sanpham` FOREIGN KEY (`sp_ma`) REFERENCES `sanpham` (`sp_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.hinhsanpham: ~11 rows (approximately)
/*!40000 ALTER TABLE `hinhsanpham` DISABLE KEYS */;
INSERT INTO `hinhsanpham` (`hsp_ma`, `hsp_tentaptin`, `sp_ma`) VALUES
	(30, '20210226105706_unnamed.webp', 11),
	(31, '20210227112859_mainasus.webp', 14),
	(32, '20210226110656_Main_msi.webp', 15),
	(33, '20210226110744_main_GIGABYTE.webp', 16),
	(34, '20210226164410_Ram.webp', 19),
	(35, '20210226164616_corei5.webp', 20),
	(36, '20210226164717_cardmsi.webp', 17),
	(37, '20210227035554_cardasus.webp', 18),
	(38, '20210227034539_manhinh.webp', 21),
	(43, '20210227144543_chuot.webp', 22),
	(46, '20210227145106_banphim.webp', 23);
/*!40000 ALTER TABLE `hinhsanpham` ENABLE KEYS */;

-- Dumping structure for table web2.hinhthucthanhtoan
CREATE TABLE IF NOT EXISTS `hinhthucthanhtoan` (
  `httt_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `httt_ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`httt_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.hinhthucthanhtoan: ~4 rows (approximately)
/*!40000 ALTER TABLE `hinhthucthanhtoan` DISABLE KEYS */;
INSERT INTO `hinhthucthanhtoan` (`httt_ma`, `httt_ten`) VALUES
	(5, 'Tiền mặt'),
	(6, 'Intenet Banking'),
	(7, 'Chuyển khoản');
/*!40000 ALTER TABLE `hinhthucthanhtoan` ENABLE KEYS */;

-- Dumping structure for table web2.khachhang
CREATE TABLE IF NOT EXISTS `khachhang` (
  `kh_tendangnhap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kh_matkhau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kh_gioitinh` int(11) NOT NULL,
  `kh_diachi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `kh_dienthoai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kh_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kh_ngaysinh` int(11) DEFAULT NULL,
  `kh_thangsinh` int(11) DEFAULT NULL,
  `kh_namsinh` int(11) NOT NULL,
  `kh_cmnd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kh_trangthai` int(11) NOT NULL,
  `kh_quantri` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`kh_tendangnhap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.khachhang: ~7 rows (approximately)
/*!40000 ALTER TABLE `khachhang` DISABLE KEYS */;
INSERT INTO `khachhang` (`kh_tendangnhap`, `kh_matkhau`, `kh_ten`, `kh_gioitinh`, `kh_diachi`, `kh_dienthoai`, `kh_email`, `kh_ngaysinh`, `kh_thangsinh`, `kh_namsinh`, `kh_cmnd`, `kh_trangthai`, `kh_quantri`) VALUES
	('admin1', 'e10adc3949ba59abbe56e057f20f883e', 'Quản trị', 1, 'Số 01 - Lý Tự Trọng - Cần Thơ', '0912.123.567', 'admin@salomon.vn', 2, 2, 1985, NULL, 1, 1),
	('tqthai', 'e10adc3949ba59abbe56e057f20f883e', 'Trương Quốc Thái', 1, 'Cần Thơ', '0706823275', 'thaitruong1605@gmail.com', 3, 9, 1999, '', 1, 1);
/*!40000 ALTER TABLE `khachhang` ENABLE KEYS */;

-- Dumping structure for table web2.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `km_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `km_ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `km_noidung` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `km_tungay` date DEFAULT NULL,
  `km_denngay` date DEFAULT NULL,
  PRIMARY KEY (`km_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.khuyenmai: ~3 rows (approximately)
/*!40000 ALTER TABLE `khuyenmai` DISABLE KEYS */;
INSERT INTO `khuyenmai` (`km_ma`, `km_ten`, `km_noidung`, `km_tungay`, `km_denngay`) VALUES
	(1, 'Khuyến mãi xuân 2021', 'Nội dung km xuân', '2021-01-01', '2021-01-23'),
	(2, 'Giảm giá đầu năm', 'Giảm giá đầu năm', '2021-02-04', '2021-03-04');
/*!40000 ALTER TABLE `khuyenmai` ENABLE KEYS */;

-- Dumping structure for table web2.loaisanpham
CREATE TABLE IF NOT EXISTS `loaisanpham` (
  `lsp_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lsp_ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lsp_mota` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lsp_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.loaisanpham: ~6 rows (approximately)
/*!40000 ALTER TABLE `loaisanpham` DISABLE KEYS */;
INSERT INTO `loaisanpham` (`lsp_ma`, `lsp_ten`, `lsp_mota`) VALUES
	(18, 'Mainboard', 'Bo mạch chủ'),
	(19, 'Ram ', 'Bộ nhớ trong'),
	(20, 'VGA', 'Card màn hình'),
	(21, 'Chuột', ''),
	(22, 'Bàn phím', ''),
	(23, 'Màn hình', ''),
	(24, 'CPU', '');
/*!40000 ALTER TABLE `loaisanpham` ENABLE KEYS */;

-- Dumping structure for table web2.nhasanxuat
CREATE TABLE IF NOT EXISTS `nhasanxuat` (
  `nsx_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nsx_ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`nsx_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.nhasanxuat: ~5 rows (approximately)
/*!40000 ALTER TABLE `nhasanxuat` DISABLE KEYS */;
INSERT INTO `nhasanxuat` (`nsx_ma`, `nsx_ten`) VALUES
	(9, 'Gigabyte'),
	(12, 'Asus'),
	(14, 'MSI'),
	(20, 'KINGMAX'),
	(21, 'INTEL'),
	(22, 'Logitech');
/*!40000 ALTER TABLE `nhasanxuat` ENABLE KEYS */;

-- Dumping structure for table web2.sanpham
CREATE TABLE IF NOT EXISTS `sanpham` (
  `sp_ma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sp_ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sp_gia` decimal(12,2) DEFAULT NULL,
  `sp_giacu` decimal(12,2) DEFAULT NULL,
  `sp_mota_ngan` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `sp_mota_chitiet` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `sp_ngaycapnhat` datetime NOT NULL,
  `sp_soluong` int(11) DEFAULT NULL,
  `lsp_ma` int(11) unsigned NOT NULL,
  `nsx_ma` int(11) unsigned NOT NULL,
  `km_ma` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`sp_ma`),
  KEY `FK_sanpham_loaisanpham` (`lsp_ma`),
  KEY `FK_sanpham_nhasanxuat` (`nsx_ma`),
  KEY `FK_sanpham_khuyenmai` (`km_ma`),
  CONSTRAINT `FK_sanpham_khuyenmai` FOREIGN KEY (`km_ma`) REFERENCES `khuyenmai` (`km_ma`),
  CONSTRAINT `FK_sanpham_loaisanpham` FOREIGN KEY (`lsp_ma`) REFERENCES `loaisanpham` (`lsp_ma`),
  CONSTRAINT `FK_sanpham_nhasanxuat` FOREIGN KEY (`nsx_ma`) REFERENCES `nhasanxuat` (`nsx_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.sanpham: ~11 rows (approximately)
/*!40000 ALTER TABLE `sanpham` DISABLE KEYS */;
INSERT INTO `sanpham` (`sp_ma`, `sp_ten`, `sp_gia`, `sp_giacu`, `sp_mota_ngan`, `sp_mota_chitiet`, `sp_ngaycapnhat`, `sp_soluong`, `lsp_ma`, `nsx_ma`, `km_ma`) VALUES
	(11, 'Mainboard ASUS TUF Gaming B460M-PLUS', 2750000.00, 2750000.00, 'Chuẩn mainboard: Micro-ATX ', '- Chuẩn mainboard: Micro-ATX - Socket: 1200 , Chipset: B460 - Hỗ trợ RAM: 4 khe DDR4, tối đa 128GB - Lưu trữ: 1 x M.2 NVMe, Hỗ trợ Intel Optane, 1 x M.2 SATA/NVMe, 6 x SATA 3 6Gb/s - Cổng xuất hình: 1 x HDMI, 1 x DVI-D, 1 x DisplayPort', '2021-02-13 00:00:00', 11, 18, 12, 1),
	(14, 'Mainboard ASUS H410M-CS', 1810000.00, 1810000.00, '- Chuẩn mainboard: Micro-ATX', '- Chuẩn mainboard: Micro-ATX\r\n- Socket: 1200 , Chipset: H410\r\n- Hỗ trợ RAM: 2 khe DDR4, tối đa 64GB\r\n- Lưu trữ: 4 x SATA 3 6Gb/s\r\n- Cổng xuất hình: 1 x HDMI, 1 x VGA/D-sub', '2021-02-25 00:00:00', 213, 18, 12, NULL),
	(15, 'Mainboard MSI H410M PRO', 1790000.00, 1790000.00, '- Chuẩn mainboard: Micro-ATX', '- Chuẩn mainboard: Micro-ATX\r\n- Socket: 1200 , Chipset: H410\r\n- Hỗ trợ RAM: 2 khe DDR4, tối đa 64GB\r\n- Lưu trữ: 4 x SATA 3 6Gb/s, 1 x M.2 SATA/NVMe\r\n- Cổng xuất hình: 1 x HDMI, 1 x DVI-D, 1 x VGA/D-sub', '2021-02-25 00:00:00', 15, 18, 14, NULL),
	(16, 'Mainboard GIGABYTE Z370XP SLI', 3990000.00, 3990000.00, '- Chuẩn mainboard: ATX', '- Chuẩn mainboard: ATX\r\n- Socket: LGA 1151-v2 , Chipset: Z370\r\n- Hỗ trợ RAM: DDR4 , tối đa 64GB\r\n- Cổng cắm lưu trữ: 1 x M.2 NVMe; 1 x M.2 SATA/NVMe; 6 x SATA 3 6Gb/s; Hỗ trợ Intel Optane\r\n- Cổng xuất hình: 1 x HDMI', '2021-02-23 00:00:00', 141, 18, 9, NULL),
	(17, 'Card màn hình MSI GeForce GT 1030 2GB', 2300000.00, 2300000.00, '- Chip đồ họa: NVIDIA GeForce GT 1030', '- Chip đồ họa: NVIDIA GeForce GT 1030\r\n- Bộ nhớ: 2GB GDDR5 ( 64-bit )\r\n- GPU clock 1518 MHz / 1265 MHz\r\n- Nguồn phụ: Không nguồn phụ', '2021-02-25 00:00:00', 17, 20, 14, 2),
	(18, 'Card màn hình ASUS TUF Gaming GeForce GTX 1660', 11390000.00, 11390000.00, '- Chip đồ họa: GeForce GTX 1660 Super', '- Chip đồ họa: GeForce GTX 1660 Super\r\n- Bộ nhớ: 6GB GDDR6 (192-bit)\r\n- OC Mode - 1845 MHz (Boost Clock)\r\n- Gaming Mode (Default) - GPU Boost Clock : 1815 MHz , GPU Base Clock : 1530 MHz\r\n- Nguồn phụ: 1 x 8-pin', '2021-02-13 00:00:00', 150, 20, 12, NULL),
	(19, 'RAM desktop KINGMAX', 590000.00, 590000.00, '- Dung lượng: 1 x 4GB', '- Dung lượng: 1 x 4GB\r\n- Thế hệ: DDR3\r\n- Bus: 1600MHz', '2021-02-23 00:00:00', 100, 19, 20, 2),
	(20, 'CPU Intel Core I5-7500 ', 6000000.00, 6000000.00, '- Socket: LGA 1151 , Intel Core thế hệ thứ 7', '- Socket: LGA 1151 , Intel Core thế hệ thứ 7\r\n- Tốc độ xử lý: 3.4 GHz - 3.8 GHz ( 4 nhân, 4 luồng)\r\n- Bộ nhớ đệm: 6MB\r\n- Đồ họa tích hợp: Intel HD Graphics 630', '2021-02-25 00:00:00', 20, 24, 21, 2),
	(21, 'Màn Hình ASUS 23.8" VZ249HE', 3790000.00, 3790000.00, '- Kích thước: 23.8"', '- Kích thước: 23.8"\r\n- Độ phân giải: 1920 x 1080 ( 16:9 )\r\n- Công nghệ tấm nền: IPS\r\n- Góc nhìn: 178 (H) / 178 (V)\r\n- Thời gian phản hồi: 5 ms', '2021-02-25 00:00:00', 50, 23, 12, NULL),
	(22, 'Chuột không dây Logitech M170', 250000.00, 250000.00, '- Kiểu kết nối: Wireless', '- Kiểu kết nối: Wireless\r\n- Dạng cảm biến: Optical\r\n- Độ phân giải: 1000 DPI\r\n- Màu sắc: Đen', '2021-02-25 00:00:00', 22, 21, 22, NULL),
	(23, 'Bàn phím Logitech K270', 400000.00, 400000.00, '- Bàn phím thường', '- Bàn phím thường\r\n- Kết nối 2.4 GHz Wireless', '2021-02-25 00:00:00', 30, 22, 22, NULL);
/*!40000 ALTER TABLE `sanpham` ENABLE KEYS */;

-- Dumping structure for table web2.sanpham_dondathang
CREATE TABLE IF NOT EXISTS `sanpham_dondathang` (
  `sp_ma` int(11) unsigned NOT NULL,
  `dh_ma` int(11) unsigned NOT NULL,
  `sp_dh_soluong` int(11) NOT NULL,
  `sp_dh_dongia` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table web2.sanpham_dondathang: ~8 rows (approximately)
/*!40000 ALTER TABLE `sanpham_dondathang` DISABLE KEYS */;
INSERT INTO `sanpham_dondathang` (`sp_ma`, `dh_ma`, `sp_dh_soluong`, `sp_dh_dongia`) VALUES
	(15, 19, 6, 1790000.00),
	(20, 19, 5, 6000000.00),
	(15, 20, 6, 1790000.00),
	(20, 20, 5, 6000000.00),
	(14, 23, 2, 1810000.00);
/*!40000 ALTER TABLE `sanpham_dondathang` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
