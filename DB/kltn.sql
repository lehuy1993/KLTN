-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2017 at 05:15 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kltn`
--

-- --------------------------------------------------------

--
-- Table structure for table `ct_hoadon`
--

CREATE TABLE `ct_hoadon` (
  `id_hd` int(11) NOT NULL,
  `id_truyen` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia_ban` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ct_hoadon`
--

INSERT INTO `ct_hoadon` (`id_hd`, `id_truyen`, `so_luong`, `gia_ban`) VALUES
(1, 18, 3, 12000),
(1, 21, 1, 15000),
(2, 18, 1, 12000),
(3, 18, 2, 12000),
(3, 21, 3, 15000),
(4, 18, 1, 12000),
(5, 18, 2, 12000),
(6, 21, 2, 15000),
(6, 18, 1, 12000),
(7, 18, 2, 12000),
(8, 18, 1, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `ct_thue`
--

CREATE TABLE `ct_thue` (
  `id` int(11) NOT NULL,
  `id_thue` int(11) NOT NULL,
  `id_truyen` int(11) NOT NULL,
  `tong_tien` float NOT NULL,
  `tien_cuoc` float NOT NULL,
  `so_luong` int(5) NOT NULL,
  `ngay_thue` date NOT NULL,
  `ngay_tra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ct_thue`
--

INSERT INTO `ct_thue` (`id`, `id_thue`, `id_truyen`, `tong_tien`, `tien_cuoc`, `so_luong`, `ngay_thue`, `ngay_tra`) VALUES
(1, 1, 21, 2000, 3214, 1, '2017-05-15', '2017-05-14'),
(2, 1, 23, 2000, 2000, 1, '2017-05-15', '2017-05-22'),
(3, 2, 21, 2000, 3214, 1, '2017-05-15', '2017-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `ct_truyen`
--

CREATE TABLE `ct_truyen` (
  `id` int(11) NOT NULL,
  `id_truyen` varchar(150) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `anh_bia` varchar(100) NOT NULL,
  `gia_moi` float NOT NULL,
  `gia_cu` float NOT NULL,
  `gia_thue` float NOT NULL,
  `anh_slide` varchar(100) NOT NULL,
  `trang_thai` varchar(50) NOT NULL,
  `id_truyen2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ct_truyen`
--

INSERT INTO `ct_truyen` (`id`, `id_truyen`, `ten`, `so_luong`, `anh_bia`, `gia_moi`, `gia_cu`, `gia_thue`, `anh_slide`, `trang_thai`, `id_truyen2`) VALUES
(20, 'ABC12 ', '12321', 99, '1491318082_page1-img8.jpg', 12000, 0, 2000, '', 'CÃ²n hÃ ng', 18),
(21, 'fdsfds ', 'fdsfds', 94, '1491318135_page1-img10.jpg', 12000, 10000, 2000, '', 'Äá»§ hÃ ng', 22),
(22, 'ID123 ', 'ABC123', 91, '1491318186_page1-img10.jpg', 15000, 10000, 2000, '', 'Äá»§ hÃ ng', 21),
(23, 'ID1 ', 'Chuyá»‡n con mÃ¨o dáº¡y háº£i Ã¢u bay (tÃ¡i báº£n 2014)', 85, '1493033849_img-308.gif', 26000, 24000, 2000, '', 'Äá»§ hÃ ng', 23),
(24, 'id2 ', 'CÃ  PhÃª CÃ¹ng Tony', 98, '1493040486_cafesangtony1.gif', 54000, 72000, 3000, '', 'Äá»§ hÃ ng', 24),
(25, 'id3 ', 'BÃªn Nhau Trá»n Äá»i - TÃ¡i Báº£n 2015', 81, '1493040993_bennhautrondoi1.gif', 88000, 90000, 5000, '', 'Äá»§ hÃ ng', 25);

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` int(11) NOT NULL,
  `id_kh` int(11) NOT NULL,
  `ngay_hd` date NOT NULL,
  `ten` varchar(150) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment` varchar(150) NOT NULL,
  `ngay_gh` date NOT NULL,
  `ghi_chu` varchar(250) NOT NULL,
  `tong_tien` float NOT NULL,
  `trang_thai` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `id_kh`, `ngay_hd`, `ten`, `sdt`, `dia_chi`, `email`, `payment`, `ngay_gh`, `ghi_chu`, `tong_tien`, `trang_thai`) VALUES
(1, 0, '2017-04-16', '', '01675003037', 'HÃ  ná»™i', 'lehuy722@gmail.com', 'tructiep', '0000-00-00', '', 51, 1),
(2, 0, '2017-04-16', '', '01675003037', 'HÃ  ná»™i', 'linhloglanh@gmail.com', 'tructiep', '0000-00-00', '', 12, 1),
(3, 1, '2017-04-16', 'lÃª vÄƒn huy', '01675003037', 'HÃ  ná»™i', 'lehuy722@gmail.com', 'tructiep', '2017-04-29', '', 69000, 1),
(4, 0, '2017-04-16', 'lÃª vÄƒn huy', '01675003037', 'HÃ  ná»™i', 'lehuy722@gmail.com', 'baokim', '2017-04-27', '', 12000, 1),
(5, 0, '2017-04-16', 'lÃª vÄƒn huy', '01675000307', 'YYeen viÃªn gia lam hÃ  ná»™i', 'lehuy722@gmail.com', 'tructiep', '2017-04-24', '', 24000, 0),
(6, 0, '2017-04-16', 'lÃª vÄƒn huy', '01675000307', 'YYeen viÃªn gia lam hÃ  ná»™i', 'lehuy722@gmail.com', 'tructiep', '2017-04-17', '', 42000, 0),
(7, 0, '2017-04-16', 'lehuy', '01675000307', 'YYeen viÃªn gia lam hÃ  ná»™i', 'lehuy722@gmail.com', 'tructiep', '2017-04-18', '', 24000, 0),
(8, 1, '2017-04-16', 'lÃª vÄƒn huy', '01675000307', 'YYeen viÃªn gia lam hÃ  ná»™i', 'lehuy722@gmail.com', 'tructiep', '2017-04-16', '', 12000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` int(11) NOT NULL,
  `tai_khoan` varchar(50) NOT NULL,
  `mat_khau` varchar(50) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ngay_tao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `tai_khoan`, `mat_khau`, `ten`, `dia_chi`, `sdt`, `email`, `ngay_tao`) VALUES
(1, 'lehuy123', '7115581e2b2a282bde075d28977011e0', 'lehuy', 'hà nội', '01675000307', 'lehuy722@gmail.com', '2017-03-22'),
(2, 'lehuy123', 'lehuy123', '', 'HÃ  ná»™i', '01675003037', 'lehuy722@gmail.com', '2017-04-16'),
(3, 'lehuy123', '7115581e2b2a282bde075d28977011e0', '', 'HÃ  ná»™i', '01675003037', 'linhloglanh@gmail.com', '2017-04-16'),
(4, 'lehuy123', '7115581e2b2a282bde075d28977011e0', '', 'HÃ  ná»™i', '01675003037', 'lehuy722@gmail.com', '2017-04-16'),
(5, 'gfdfgdgfd', 'd9aeba5e7bcdacec33d2504cfcbfc33b', '', 'fdsfdsfds', '01675000307', 'lehuy722@gmail.com', '2017-04-16'),
(6, 'lehuy123', '97a2973f9d99598b0c9df509b5217dab', '', 'fdsfdsfds', '01675000307', 'lehuy722@gmail.com', '2017-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `loai_truyen`
--

CREATE TABLE `loai_truyen` (
  `id` int(11) NOT NULL,
  `id_loai` varchar(10) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `ngay_tao` timestamp NULL DEFAULT NULL,
  `ngay_sua` timestamp NULL DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loai_truyen`
--

INSERT INTO `loai_truyen` (`id`, `id_loai`, `ten`, `ngay_tao`, `ngay_sua`, `trang_thai`) VALUES
(3, 'KH1', 'Truyá»‡n kiáº¿m hiá»‡p', '2017-03-09 16:07:28', '2017-03-09 16:13:46', 1),
(7, 'TC', 'Truyá»‡n CÆ°á»i', '2017-03-21 16:36:14', '2017-03-21 16:36:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ncc`
--

CREATE TABLE `ncc` (
  `id` int(11) NOT NULL,
  `id_ncc` varchar(10) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `ngay_sua` datetime NOT NULL,
  `trang_thai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ncc`
--

INSERT INTO `ncc` (`id`, `id_ncc`, `ten`, `diachi`, `sdt`, `ngay_tao`, `ngay_sua`, `trang_thai`) VALUES
(1, 'ABC', 'ABCC', 'hÃ  ná»™i', '1243321321', '2017-03-11 08:01:43', '2017-03-11 08:09:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nha_xuat_ban`
--

CREATE TABLE `nha_xuat_ban` (
  `id` int(11) NOT NULL,
  `id_nxb` varchar(10) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `ngay_sua` datetime NOT NULL,
  `trang_thai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nha_xuat_ban`
--

INSERT INTO `nha_xuat_ban` (`id`, `id_nxb`, `ten`, `diachi`, `ngay_tao`, `ngay_sua`, `trang_thai`) VALUES
(3, 'KD', 'Kim Äá»“ng', 'SÃ i GÃ²n', '2017-03-21 23:56:13', '2017-03-21 23:56:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phieu_thue`
--

CREATE TABLE `phieu_thue` (
  `id` int(11) NOT NULL,
  `sdt` varchar(15) NOT NULL,
  `ten_kh` varchar(100) NOT NULL,
  `hinh_thuc` tinyint(4) NOT NULL,
  `tien_coc` float NOT NULL,
  `ngay_thue` date NOT NULL,
  `ngay_tra` date NOT NULL,
  `tong_tien` float NOT NULL,
  `tien_thue` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieu_thue`
--

INSERT INTO `phieu_thue` (`id`, `sdt`, `ten_kh`, `hinh_thuc`, `tien_coc`, `ngay_thue`, `ngay_tra`, `tong_tien`, `tien_thue`) VALUES
(1, '01675000307', 'lehuy', 1, 5214, '2017-05-15', '2017-05-22', 9214, 4000),
(2, '01675000307', 'lehuy', 1, 3214, '2017-05-15', '2017-05-22', 5214, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `phieu_tra`
--

CREATE TABLE `phieu_tra` (
  `id` int(11) NOT NULL,
  `id_thue` varchar(10) NOT NULL,
  `ten_kh` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `tien_phat` float NOT NULL,
  `hinh_thuc` tinyint(4) NOT NULL,
  `tien_coc` float NOT NULL,
  `ngay_thue` date NOT NULL,
  `ngay_tra` date NOT NULL,
  `trang_thai` varchar(50) NOT NULL,
  `tien_thue` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phieu_tra`
--

INSERT INTO `phieu_tra` (`id`, `id_thue`, `ten_kh`, `sdt`, `tien_phat`, `hinh_thuc`, `tien_coc`, `ngay_thue`, `ngay_tra`, `trang_thai`, `tien_thue`) VALUES
(129, '31', 'lehuy1', ' 01675000307', 0, 1, 12000, '2017-05-14', '2017-05-14', '+7 ', 5000),
(130, '31', 'lehuy1', ' 01675000307', 0, 1, 57857, '2017-05-14', '2017-05-14', '+7 ', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `quan_tri`
--

CREATE TABLE `quan_tri` (
  `id` int(11) NOT NULL,
  `tai_khoan` varchar(50) NOT NULL,
  `mat_khau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quan_tri`
--

INSERT INTO `quan_tri` (`id`, `tai_khoan`, `mat_khau`) VALUES
(4, 'admin', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Table structure for table `truyen`
--

CREATE TABLE `truyen` (
  `id` int(11) NOT NULL,
  `id_truyen` varchar(10) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `tom_tat` varchar(5000) NOT NULL,
  `nxb` varchar(100) NOT NULL,
  `tac_gia` varchar(100) NOT NULL,
  `the_loai` varchar(100) NOT NULL,
  `gia_bia` float NOT NULL,
  `gia_cuoc` float NOT NULL,
  `vi_tri` varchar(10) NOT NULL,
  `Luot_xem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `truyen`
--

INSERT INTO `truyen` (`id`, `id_truyen`, `ten`, `tom_tat`, `nxb`, `tac_gia`, `the_loai`, `gia_bia`, `gia_cuoc`, `vi_tri`, `Luot_xem`) VALUES
(18, 'ABC12', '12321', '<p>fdsfds</p>\r\n', 'KD', 'fdsfds', 'KH1', 2344, 3245, 'bgc56', 34),
(21, 'ID123', 'ABC123', '<p>hgfhgf</p>\r\n', 'KD', 'hgfhgf', 'TC', 1254, 3214, 'fdsfds3', 0),
(22, 'fdsfds', 'fdsfds', '<p>dfsfds</p>\r\n', 'KD', 'fdsfds', 'KH1', 12432, 54643, 'bt345', 1),
(23, 'ID1', 'Chuyá»‡n con mÃ¨o dáº¡y háº£i Ã¢u bay (tÃ¡i báº£n 2014)', '<p>C&oacute; tá»“n táº¡i kh&ocirc;ng t&igrave;nh thÆ°Æ¡ng y&ecirc;u giá»¯a m&egrave;o v&agrave; háº£i &acirc;u?</p>\r\n\r\n<p>Tháº¿ giá»›i n&agrave;y Ä‘áº§y nhá»¯ng nghá»‹ch l&yacute; v&agrave; kh&aacute;c biá»‡t, nhÆ°ng bá» qua nhá»¯ng kh&aacute;c biá»‡t Ä‘&oacute; Ä‘á»ƒ hÆ°á»›ng Ä‘áº¿n t&igrave;nh y&ecirc;u thÆ°Æ¡ng th&igrave; cuá»™c sá»‘ng sáº½ tá»‘t Ä‘áº¹p hÆ¡n.&ldquo;Chuyá»‡n con m&egrave;o dáº¡y háº£i &acirc;u bay&rdquo; cá»§a nh&agrave; vÄƒn Chi L&ecirc; ná»•i tiáº¿ng Luis S&eacute;Pulveda l&agrave; má»™t c&acirc;u chuyá»‡n tháº¥m Ä‘áº«m t&igrave;nh m&egrave;o, t&igrave;nh ngÆ°á»i nhÆ° tháº¿.</p>\r\n\r\n<p>C&acirc;u chuyá»‡n l&agrave; cuá»™c h&agrave;nh tr&igrave;nh d&agrave;i Ä‘i thá»±c hiá»‡n ba lá»i há»©a cá»§a ch&uacute; m&egrave;o máº­p Zorba: &ldquo;sáº½ kh&ocirc;ng Äƒn quáº£ trá»©ng&rdquo;, sáº½ &ldquo;chÄƒm lo cho quáº£ trá»©ng Ä‘áº¿n khi ch&uacute; chim non ra Ä‘á»i&rdquo;, v&agrave; Ä‘iá»u cuá»‘i dÆ°á»ng nhÆ° kh&ocirc;ng tÆ°á»Ÿng l&agrave; &ldquo;dáº¡y n&oacute; bay&rdquo;. Nhá»¯ng ráº¯c rá»‘i li&ecirc;n tiáº¿p áº­p Ä‘áº¿n, liá»‡u má»™t b&agrave; m&aacute; ráº¥t &ldquo;xá»‹n&rdquo; nhÆ° Zorba c&oacute; thá»±c hiá»‡n Ä‘&uacute;ng Ä‘Æ°á»£c ba lá»i há»©a?<img src=\"https://bizweb.dktcdn.net/thumb/large/100/004/541/products/img_308.gif\" /></p>\r\n\r\n<p>T&igrave;nh thÆ°Æ¡ng gi&uacute;p thay Ä‘á»•i Ä‘á»‹nh kiáº¿n.</p>\r\n\r\n<p>Má»i kh&oacute; khÄƒn Ä‘&atilde; chá»©ng minh ráº±ng sau tháº³m b&ecirc;n trong ch&uacute; m&egrave;o Zorba l&agrave; má»™t tr&aacute;i tim nh&acirc;n háº­u, tr&agrave;n trá» thá»© t&igrave;nh cáº£m gá»i l&agrave; &ldquo;y&ecirc;u thÆ°Æ¡ng ch&acirc;n th&agrave;nh&rdquo;. Ch&iacute;nh thá»© t&igrave;nh cáº£m n&agrave;y Ä‘&atilde; k&eacute;o c&ocirc; b&eacute; chim háº£i &acirc;u nhá» gáº§n láº¡i vá»›i m&egrave;o Zorba, bá»Ÿi &ldquo;Tháº­t dá»… d&agrave;ng Ä‘á»ƒ cháº¥p nháº­n v&agrave; y&ecirc;u thÆ°Æ¡ng má»™t káº» n&agrave;o Ä‘&oacute; giá»‘ng m&igrave;nh, nhÆ°ng Ä‘á»ƒ y&ecirc;u thÆ°Æ¡ng ai Ä‘&oacute; kh&aacute;c m&igrave;nh thá»±c sá»± ráº¥t kh&oacute; khÄƒn..&rdquo;. Váº­y Ä‘áº¥y, y&ecirc;u thÆ°Æ¡ng l&agrave; há»c c&aacute;ch cháº¥p nháº­n sá»± kh&aacute;c biá»‡t v&agrave; kh&ocirc;ng c&oacute; &yacute; Ä‘á»‹nh muá»‘n biáº¿n ngÆ°á»i Ä‘&oacute; trá»Ÿ n&ecirc;n giá»‘ng m&igrave;nh. Khi ch&uacute;ng ta y&ecirc;u thÆ°Æ¡ng ai Ä‘&oacute; báº±ng táº¥t cáº£ sá»± ch&acirc;n th&agrave;nh, th&igrave; má»i Ä‘á»‹nh kiáº¿n v&agrave; kh&aacute;c biá»‡t chá»‰ l&agrave; Ä‘iá»ƒm tá»±a cho t&igrave;nh cáº£m cao Ä‘áº¹p trong lo&agrave;i m&egrave;o, lo&agrave;i ngÆ°á»i áº¥y Ä‘Æ°á»£c s&acirc;u sáº¯c hÆ¡n th&ocirc;i.</p>\r\n\r\n<p><img src=\"https://bizweb.dktcdn.net/thumb/large/100/004/541/products/img_310.gif\" /></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n', 'KD', 'Linh tinh', 'TC', 26000, 2000, 'bt23', 8),
(24, 'id2', 'CÃ  PhÃª CÃ¹ng Tony', '<p>C&agrave; ph&ecirc; c&ugrave;ng Tony l&agrave; sá»± táº­p há»£p c&aacute;c b&agrave;i viáº¿t tr&ecirc;n tráº¡ng máº¡ng x&atilde; há»™i cá»§a t&aacute;c giáº£ Tony Buá»•i S&aacute;ng (TnBS) vá» nhá»¯ng b&agrave;i há»c, c&acirc;u chuyá»‡n anh Ä‘&atilde; tráº£i nghiá»‡m trong cuá»™c sá»‘ng. Ä&oacute; c&oacute; thá»ƒ l&agrave; c&aacute;ch anh chia sáº» vá»›i c&aacute;c báº¡n tráº» vá» nhá»¯ng chuyá»‡n to t&aacute;t nhÆ° khá»Ÿi nghiá»‡p,Ä‘áº¡o Ä‘á»©c kinh doanh, há»c táº­p Ä‘áº¿n nhá»¯ng viá»‡c nhá» nháº·t nhÆ° Äƒn máº·c, giao tiáº¿p, vá»‡ sinh cÆ¡ thá»ƒ&hellip; sao cho vÄƒn minh, lá»‹ch sá»±. Hay chá»‰ Ä‘Æ¡n giáº£n thuáº­t láº¡i nhá»¯ng tráº£i nghiá»‡m thá»±c táº¿ cá»§a anh trong qu&aacute; tr&igrave;nh sá»‘ng, kinh doanh á»Ÿ trong v&agrave; ngo&agrave;i nÆ°á»›c.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"https://bizweb.dktcdn.net/thumb/large/100/004/541/products/cafesangtony1.gif?v=1437788997043\" /></p>\r\n\r\n<p>Xuy&ecirc;n suá»‘t cuá»‘n s&aacute;ch, c&aacute;c c&acirc;u chuyá»‡n Ä‘Æ°á»£c ká»ƒ vá»›i giá»ng Ä‘iá»‡u tr&agrave;o ph&uacute;ng, h&agrave;i hÆ°á»›c láº¡i Ä‘Æ°á»£c thá»ƒ hiá»‡n báº±ng ng&ocirc;n ngá»¯ &ldquo;cÆ° d&acirc;n máº¡ng&rdquo; táº¡o sá»± gáº§n gÅ©i Ä‘á»ƒ c&aacute;c báº¡n tráº» c&oacute; thá»ƒ dá»… d&agrave;ng tiáº¿p nháº­n. Máº·c d&ugrave; t&aacute;c giáº£ lu&ocirc;n kháº³ng Ä‘á»‹nh nhá»¯ng th&ocirc;ng tin, chi tiáº¿t trong c&acirc;u chuyá»‡n l&agrave; hÆ° cáº¥u v&agrave; tháº­m xÆ°ng nhÆ°ng Ä‘iá»u Ä‘&oacute; kh&ocirc;ng c&oacute; nghÄ©a l&agrave;m cuá»‘n s&aacute;ch bá»›t Ä‘i sá»± th&uacute; vá»‹.</p>\r\n\r\n<p>Chia sáº» vá» sá»± ra Ä‘á»i cá»§a cuá»‘n s&aacute;ch, t&aacute;c giáº£ t&acirc;m niá»‡m kh&ocirc;ng muá»‘n nhá»¯ng Ä‘iá»u anh t&acirc;m Ä‘áº¯c v&agrave; Ä‘&uacute;c káº¿t chá»‰ dá»«ng láº¡i á»Ÿ máº¡ng x&atilde; há»™i. Anh hi vá»ng nhá»¯ng c&acirc;u chuyá»‡n cá»§a m&igrave;nh th&ocirc;ng qua C&agrave; ph&ecirc; c&ugrave;ng Tony c&oacute; thá»ƒ thá»•i nguá»“n cáº£m há»©ng tá»›i nhá»¯ng Ä‘á»™c giáº£ kh&ocirc;ng c&oacute; Ä‘iá»u kiá»‡n sá»­ dá»¥ng internet, Ä‘á»“ng thá»i khuyáº¿n kh&iacute;ch vÄƒn h&oacute;a Ä‘á»c á»Ÿ c&aacute;c báº¡n tráº» trong thá»i Ä‘áº¡i m&agrave; vÄƒn h&oacute;a nghe nh&igrave;n Ä‘ang &nbsp;dáº§n chiáº¿m Æ°u tháº¿. ÄÆ¡n giáº£n v&agrave; kh&ocirc;ng cáº§u k&igrave;, Ä‘á»c C&agrave; ph&ecirc; c&ugrave;ng Tony, Ä‘á»™c giáº£ sáº½ cáº£m tháº¥y nhÆ° Ä‘ang kh&aacute;m ph&aacute; c&acirc;u chuyá»‡n cá»§a ch&iacute;nh m&igrave;nh qua c&aacute;ch ká»ƒ &nbsp;cá»§a má»™t ngÆ°á»i kh&aacute;c.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n', 'KD', 'h5434', 'TC', 54000, 1233, 'vds34', 3),
(25, 'id3', 'BÃªn Nhau Trá»n Äá»i - TÃ¡i Báº£n 2015', '<p>&quot;Giá» Ä‘&acirc;y, cuá»‘i c&ugrave;ng t&ocirc;i Ä‘&atilde; biáº¿t y&ecirc;u, tiáº¿c ráº±ng em Ä‘&atilde; rá»i xa, Ä‘&atilde; máº¥t h&uacute;t trong biá»ƒn ngÆ°á»i m&ecirc;nh m&ocirc;ng&hellip;&rdquo;&nbsp;</p>\r\n\r\n<p>T&igrave;nh y&ecirc;u giá»‘ng nhá»¯ng ná»‘t nháº¡c cá»§a Ä‘iá»‡u valse, nháº¹ nh&agrave;ng m&agrave; tha thiáº¿t tá»›i kh&oacute; qu&ecirc;n. Váº«n c&oacute; nhá»¯ng ná»‘t cao, ná»‘t tráº§m h&ograve;a quyá»‡n trong báº£n nháº¡c cá»§a t&igrave;nh y&ecirc;u.&nbsp;Ngay tá»« c&aacute;i náº¯m tay Ä‘áº§u ti&ecirc;n c&ugrave;ng s&aacute;nh bÆ°á»›c tr&ecirc;n con Ä‘Æ°á»ng Ä‘á»i, hai ngÆ°á»i lu&ocirc;n cáº§u mong sáº½ sá»‘ng b&ecirc;n nhau trá»n Ä‘á»i, cho tá»›i khi c&aacute;i cháº¿t chia l&igrave;a nhÆ° vá»‹ cha xá»© tuy&ecirc;n bá»‘ h&ocirc;n Æ°á»›c tr&ecirc;n th&aacute;nh Ä‘Æ°á»ng váº«n n&oacute;i.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"https://bizweb.dktcdn.net/thumb/large/100/004/541/products/bennhautrondoi1.gif?v=1437789420373\" /></p>\r\n\r\n<p>Háº¡nh ph&uacute;c cá»§a t&igrave;nh y&ecirc;u giáº£n dá»‹ l&agrave; sá»± vÆ°á»£t qua má»i khá»• Ä‘au, chÆ°á»›ng ngáº¡i, náº¯m tay nhau tá»›i Ä‘áº§u báº¡c rÄƒng long. Ä&oacute; cÅ©ng l&agrave; th&ocirc;ng Ä‘iá»‡p m&agrave; Cá»‘ Máº¡n mang tá»›i cho Ä‘á»™c giáº£ cá»§a c&ocirc; qua cuá»‘n s&aacute;ch &quot;B&ecirc;n nhau trá»n Ä‘á»i&quot;.&nbsp;NhÆ° má»™t Ä‘iá»‡u valse duy&ecirc;n d&aacute;ng, &quot;B&ecirc;n nhau trá»n Ä‘á»i&quot; Ä‘i v&agrave;o l&ograve;ng Ä‘á»™c giáº£ vá»›i cá»‘t truyá»‡n nháº¹ nh&agrave;ng nhÆ°ng chá»©a Ä‘á»±ng táº¥t cáº£ cung báº­c cáº£m x&uacute;c cá»§a t&igrave;nh y&ecirc;u: cÄƒm háº­n, nhá»› nhung da diáº¿t, ghen tu&ocirc;ng, háº¡nh ph&uacute;c tu&ocirc;n tr&agrave;o v&agrave; cáº£ nhá»¯ng ká»‰ niá»‡m ngá»t ng&agrave;o cá»§a má»‘i t&igrave;nh Ä‘áº§u kh&oacute; qu&ecirc;n.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img src=\"https://bizweb.dktcdn.net/thumb/large/100/004/541/products/bennhautrondoi2.gif?v=1437789420410\" /></p>\r\n', 'KD', '', 'TC', 0, 12000, 'bs34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ct_thue`
--
ALTER TABLE `ct_thue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ct_truyen`
--
ALTER TABLE `ct_truyen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_truyen`
--
ALTER TABLE `loai_truyen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_loai` (`id_loai`),
  ADD KEY `id_loai_2` (`id_loai`);

--
-- Indexes for table `ncc`
--
ALTER TABLE `ncc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nha_xuat_ban`
--
ALTER TABLE `nha_xuat_ban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phieu_thue`
--
ALTER TABLE `phieu_thue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phieu_tra`
--
ALTER TABLE `phieu_tra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quan_tri`
--
ALTER TABLE `quan_tri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truyen`
--
ALTER TABLE `truyen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ct_thue`
--
ALTER TABLE `ct_thue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ct_truyen`
--
ALTER TABLE `ct_truyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `loai_truyen`
--
ALTER TABLE `loai_truyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ncc`
--
ALTER TABLE `ncc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `nha_xuat_ban`
--
ALTER TABLE `nha_xuat_ban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `phieu_thue`
--
ALTER TABLE `phieu_thue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `phieu_tra`
--
ALTER TABLE `phieu_tra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `quan_tri`
--
ALTER TABLE `quan_tri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `truyen`
--
ALTER TABLE `truyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
