-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 06, 2021 lúc 05:13 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dathang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `sodondh` int(11) NOT NULL,
  `mshh` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giadathang` int(11) NOT NULL,
  `giamgia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`sodondh`, `mshh`, `soluong`, `giadathang`, `giamgia`) VALUES
(1, 22, 2, 278000, 0),
(1, 46, 1, 509000, 0),
(2, 24, 1, 83000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `sodondh` int(11) NOT NULL,
  `mskh` int(11) NOT NULL,
  `msnv` char(6) DEFAULT NULL,
  `ngaydh` date DEFAULT NULL,
  `ngaygh` date DEFAULT NULL,
  `giadonhang` int(11) NOT NULL,
  `diachigiaohang` varchar(200) NOT NULL,
  `trangthai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`sodondh`, `mskh`, `msnv`, `ngaydh`, `ngaygh`, `giadonhang`, `diachigiaohang`, `trangthai`) VALUES
(1, 1, 'ADMIN', '2021-12-06', '2021-12-13', 1065000, 'Thuận Hưng, Thốt Thốt, Cần Thơ', 0),
(2, 2, 'ADMIN', '2021-12-06', '2021-12-13', 83000, 'Phụng Hiệp, Hậu Giang', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `madc` int(11) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `mskh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`madc`, `diachi`, `mskh`) VALUES
(1, 'Thuận Hưng, Thốt Thốt, Cần Thơ', 1),
(2, 'Phụng Hiệp, Hậu Giang', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `mshh` int(11) NOT NULL,
  `tenhh` varchar(255) NOT NULL,
  `quycach` text DEFAULT NULL,
  `gia` int(11) NOT NULL,
  `soluonghang` int(11) NOT NULL,
  `maloaihang` char(6) NOT NULL,
  `location` text DEFAULT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`mshh`, `tenhh`, `quycach`, `gia`, `soluonghang`, `maloaihang`, `location`, `ghichu`) VALUES
(1, 'Son Kem Lì, Mịn Mượt Môi Black Rouge Air Fit Velvet Tint Version 7 4.5ml', 'Thỏi', 129000, 50, 'LH001', 'location/son1.jpg', '					Son kem lì Black Rouge Air Fit Velvet Tint Version 7 nằm trong bộ sưu tập Velvert Crown thuộc Air Fit Velvet Tint của thương hiệu Black Rouge, mang sức hút mạnh mẽ từ vẻ đẹp của nữ hoàng, sự lôi cuốn đến từ vẻ tinh tế, thu hút tựa như đang bước chân vào vương quốc mộng mơ, quyến rũ	\r\n					'),
(2, 'Son Tint Siêu Lì Lên Màu Chuẩn Laneige Tattoo Lip Tint', 'Thỏi', 399000, 100, 'LH001', 'location/son2.jpg', '				Son kem lì Black Rouge Air Fit Velvet Tint Version 7 nằm trong bộ sưu tập Velvert Crown thuộc Air Fit Velvet Tint của thương hiệu Black Rouge, mang sức hút mạnh mẽ từ vẻ đẹp của nữ hoàng, sự lôi cuốn đến từ vẻ tinh tế, thu hút tựa như đang bước chân vào vương quốc mộng mơ, quyến rũ		\r\n					'),
(3, 'Son Kem Lì, Lên Màu Chuẩn Etude House Powder Rouge Tint 2.7g (Vỏ Nâu)', 'Thỏi', 111000, 100, 'LH001', 'location/son2.jpg', '						\r\n					'),
(4, '[Mini 50g] Sữa Tẩy Trang Rửa Mặt 3 Trong 1 Dưỡng Ẩm Mịn Da Bioré', 'Chai', 35000, 80, 'LH002', 'location/t5.jpg', '						\r\n					Sữa Tẩy Trang Rửa Mặt 3 Trong 1 Dưỡng Ẩm Mịn Da Bioré là sữa tẩy trang rửa mặt thuộc thương hiệu Bioré với lớp bọt siêu mịn làm sạch nhẹ nhàng lớp trang điểm mỏng hiệu quả mà không gây khô da, cho cảm giác tươi mát sau khi sử dụng. Công thức chứa chiết xuất sữa ong chúa và thành phần Sodium Hyaluronate giúp tăng cường dưỡng ẩm sâu cho làn da ẩm mịn hơn'),
(5, '[MUHLY ROMANCE] Son Tint Lì Cho Môi Căng Mọng Etude House Dear Darling Water Gel Tint 5g', 'Thỏi', 99000, 80, 'LH001', 'location/son4.jpg', '						Son tint lì với cảm hứng từ ánh hoàng hôn mùa thu rực rỡ, những gam màu ngọt ngào cùng chiết xuất từ hương vị trái cây thơm mát cho bạn nguồn cảm xúc dâng trào của một câu chuyện tình lãng mạn sắp nở rộ trong bầu không khí hoàng hôn \r\n\r\n					'),
(6, 'Son Tint Siêu Lì Lên Màu Chuẩn Laneige Tattoo Lip Tint', 'Thỏi', 59000, 90, 'LH001', 'location/son5.jpg', '						\r\n					'),
(7, '[50g] Kem Chống Nắng Giảm Dầu, Nâng Tone Da Sáng Hồng The Saem Pink Sun Cream EX SPF50+/PA++++', 'Chai', 90000, 67, 'LH006', 'location/c1.jpg', '					Kem Chống Nắng Giảm Dầu, Giúp Da Sáng Hồng Tự Nhiên The Saem Pink Sun Cream EX SPF50+/PA++++ với công thức kem chống nắng dịu nhẹ cho làn da nhạy cảm, bảo vệ da thoải mái khỏi tia UV và làm dịu da bằng các tia UV vật lý 100% ngăn chặn công thức và bột làm dịu calamine màu hồng	\r\n					'),
(8, 'Son Kem Lì Merzy The First Velvet Tint Limited Edition - V6 Ver Đỏ', 'Thỏi', 148000, 80, 'LH001', 'location/son6.jpg', '						\r\n					Son kem lì Merzy The First Velvet Tint Limited Edition là son kem lì thuộc dòng Velvet tint của thương hiệu Merzy có chất son mịn hơn, rất lì và và lâu trôi hơn nhiều giờ cùng độ lên màu chuẩn, mịn mướt không hề làm bay màu hay lộ vân môi, độ bám màu hoàn hảo giúp đôi môi bạn luôn đẹp suốt cả ngày '),
(9, 'Sont Tint Cho Đôi Môi Căng Mọng Iam Meme Mystery Volume Tint', 'Thỏi', 169000, 68, 'LH001', 'location/son7.jpg', '						\r\n					'),
(10, 'Son Tint Siêu Lì Có Dưỡng Cho Đôi Môi Mềm Mại Iam Meme Mystery Satin Tint ', 'Thỏi', 41000, 80, 'LH001', 'location/son8.jpg', '						\r\n					'),
(11, 'Son Tint Lì, Lên Màu Siêu Chuẩn Berrisom Real Me Water Glow Tint 6g', 'Thỏi', 76000, 70, 'LH001', 'location/son9.jpg', '						Son tint bóng Berrisom Real Me Water Glow Tint là dòng son tint của thương hiệu Berrisom với kết cấu dạng tint nước mang lại hiệu ứng bóng mà không gây cảm giác bết dính, màu son lên môi tự nhiên và phù hợp với màu môi của bạn, tạo cho bạn một đôi môi căng mọng rạng rỡ, thu hút mọi ánh nhìn \r\n					'),
(12, 'Son Tint Nước Siêu Lì, Lâu Trôi Romand Glasting Water Tint 4g', 'Thỏi', 139000, 60, 'LH001', 'location/son10.jpg', '						Son tint lì Romand Glasting Water Tint là son tint lì của thương hiệu Romand có chất son tint bóng tự như một lớp màng nước lướt nhẹ trên môi, chứa nhiều dưỡng chất giúp nuôi dưỡng đôi môi, son lên môi nhẹ và mướt mịn, dễ tán đều cùng với bảng màu rực rỡ đa dạng mang đến cho bạn đôi môi căng mọng tràn đầy sức sống, tự tin cả ngày dài \r\n					'),
(13, '[Màu 14 - 17] Son Tint Bóng Siêu Lì Romand New Juicy Lasting Tint - Sparkling Juicy 5.5g', 'Thỏi', 139000, 50, 'LH001', 'location/son11.jpg', '						Son tint bóng Romand New Juicy Lasting là son tint của thương hiệu Romand nay được khoác lên mình chiếc áo mới có tên gọi Sparkling Juicy mang cảm hứng của mùa hè tươi mát, giúp đôi môi của bạn trông ngọt ngào mà rạng rỡ hơn, căng mọng tràn đầy sức sống \r\n					'),
(14, '[Màu 14 - 17] Son Tint Bóng Siêu Lì Romand New Juicy Lasting Tint - Sparkling Juicy 5.5g', 'Thỏi', 139000, 50, 'LH001', 'location/son11.jpg', '						Son tint bóng Romand New Juicy Lasting là son tint của thương hiệu Romand nay được khoác lên mình chiếc áo mới có tên gọi Sparkling Juicy mang cảm hứng của mùa hè tươi mát, giúp đôi môi của bạn trông ngọt ngào mà rạng rỡ hơn, căng mọng tràn đầy sức sống \r\n					'),
(15, '[Màu 14 - 17] Son Tint Bóng Siêu Lì Romand New Juicy Lasting Tint - Sparkling Juicy 5.5g', 'Thỏi', 139000, 50, 'LH001', 'location/son11.jpg', '						Son tint bóng Romand New Juicy Lasting là son tint của thương hiệu Romand nay được khoác lên mình chiếc áo mới có tên gọi Sparkling Juicy mang cảm hứng của mùa hè tươi mát, giúp đôi môi của bạn trông ngọt ngào mà rạng rỡ hơn, căng mọng tràn đầy sức sống \r\n					'),
(16, 'Son Kem Lì Mịn Mượt, Nhẹ Môi B.O.M OMG Matt Lip Lacquer 4g', 'Thỏi', 259000, 70, 'LH001', 'location/son12.jpg', '						\r\n				Son kem lì B.O.M OMG Matt Lip Lacquer là son kem lì đến từ thương hiệu B.OM với sự kết hợp giữa son bóng và son lì cho công thức son đặc biệt cho hiệu ứng đôi môi căng bóng mềm mại cùng độ bám màu, lâu trôi cho bạn đôi môi rạng rỡ quyến rũ bất chấp thời gian.	'),
(17, 'Son Kem Lì Mịn Mượt, Nhẹ Môi B.O.M OMG Matt Lip Lacquer 4g', 'Thỏi', 259000, 70, 'LH001', 'location/son12.jpg', '						\r\n				Son kem lì B.O.M OMG Matt Lip Lacquer là son kem lì đến từ thương hiệu B.OM với sự kết hợp giữa son bóng và son lì cho công thức son đặc biệt cho hiệu ứng đôi môi căng bóng mềm mại cùng độ bám màu, lâu trôi cho bạn đôi môi rạng rỡ quyến rũ bất chấp thời gian.	'),
(18, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 499000, 40, 'LH001', 'location/son13.jpg', '						\r\n					Son kem lì 3CE Soft Lip Lacquer là son kem lì thuộc thương hiệu 3CE phiên bản nâng cấp của son lì truyền thống, lì vừa phải, có độ trơn mềm nhất định chứ không khô hẳn, là dòng son mang kết cấu chất son đặc biệt đầu tiên của hãng cùng với bảng màu đa dạng, dễ dùng cho bạn đôi môi mượt mà không kém phần quyến rũ '),
(19, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 499000, 40, 'LH001', 'location/son13.jpg', '						\r\n					Son kem lì 3CE Soft Lip Lacquer là son kem lì thuộc thương hiệu 3CE phiên bản nâng cấp của son lì truyền thống, lì vừa phải, có độ trơn mềm nhất định chứ không khô hẳn, là dòng son mang kết cấu chất son đặc biệt đầu tiên của hãng cùng với bảng màu đa dạng, dễ dùng cho bạn đôi môi mượt mà không kém phần quyến rũ '),
(20, '[Phiên Bản Nâng Cấp] Lăn Khử Mùi Mờ Thâm, Dưỡng Trắng Da Angel', 'Lọ', 278000, 65, 'LH007', 'location/k1.jpg', '						\r\n					'),
(21, '[Phiên Bản Nâng Cấp] Lăn Khử Mùi Mờ Thâm, Dưỡng Trắng Da Angel', 'Lọ', 278000, 65, 'LH007', 'location/k1.jpg', '						\r\n					'),
(22, '[Phiên Bản Nâng Cấp] Lăn Khử Mùi Mờ Thâm, Dưỡng Trắng Da Angel', 'Lọ', 278000, 63, 'LH007', 'location/k1.jpg', '						\r\n					'),
(23, 'Sáp Ngăn Mùi Ngọc Trai Nivea Anti-Perspirant Roll On Pearl & Beauty 40ml', 'Chai', 83000, 70, 'LH007', 'location/k2.jpg', '						\r\n					Sáp Ngăn Mùi Ngọc Trai Nivea Anti-Perspirant Roll On Pearl & Beauty là sản phẩm khử mùi dạng sáp với chiết xuất từ ngọc trai gấp 4 lần được bào chế theo công thức độc đáo của thương hiệu Nivea giúp làm sáng vùng da dưới cánh tay trở nên sáng mịn và mang đến hương thơm quyến rũ, khô thoáng suốt 48 giờ.'),
(24, 'Sáp Ngăn Mùi Ngọc Trai Nivea Anti-Perspirant Roll On Pearl & Beauty 40ml', 'Chai', 83000, 69, 'LH007', 'location/k2.jpg', '						\r\n					Sáp Ngăn Mùi Ngọc Trai Nivea Anti-Perspirant Roll On Pearl & Beauty là sản phẩm khử mùi dạng sáp với chiết xuất từ ngọc trai gấp 4 lần được bào chế theo công thức độc đáo của thương hiệu Nivea giúp làm sáng vùng da dưới cánh tay trở nên sáng mịn và mang đến hương thơm quyến rũ, khô thoáng suốt 48 giờ.'),
(25, ' Xịt Chống Nắng Cấp Nước, Dưỡng Ẩm Jmsolution Marine Luminous Pearl Sun Spray là xịt chống nắng thuộc thương hiệu Jmsolution. Sản phẩm có chỉ số chống nắng cao SPF 50+/PA +++ giúp cho da chống lại các tác hại của tia UV từ ánh nắng mặt trời gây thâm sạm, ', 'Chai', 89000, 50, 'LH006', 'location/c1.jpg', '						\r\n					'),
(26, ' Xịt Chống Nắng Cấp Nước, Dưỡng Ẩm Jmsolution Marine Luminous Pearl Sun Spray là xịt chống nắng thuộc thương hiệu Jmsolution. Sản phẩm có chỉ số chống nắng cao SPF 50+/PA +++ giúp cho da chống lại các tác hại của tia UV từ ánh nắng mặt trời gây thâm sạm, ', 'Chai', 89000, 50, 'LH006', 'location/c1.jpg', '						\r\n					'),
(27, 'Gel Chống Nắng Màng Nước Dưỡng Ẩm Bioré UV Aqua Rich Watery Gel Cool SPF50+/PA++++ 90ml', 'Chai', 129000, 70, 'LH006', 'location/c3.jpg', '						\r\n					'),
(28, 'Gel Chống Nắng Màng Nước Dưỡng Ẩm Bioré UV Aqua Rich Watery Gel Cool SPF50+/PA++++ 90ml', 'Chai', 129000, 70, 'LH006', 'location/c3.jpg', '						\r\n					'),
(29, 'Gel Chống Nắng Màng Nước Dưỡng Ẩm Bioré UV Aqua Rich Watery Gel Cool SPF50+/PA++++ 90ml', 'Chai', 129000, 70, 'LH006', 'location/c3.jpg', '						\r\n					'),
(30, 'Gel Chống Nắng Màng Nước Dưỡng Ẩm Bioré UV Aqua Rich Watery Gel Cool SPF50+/PA++++ 90ml', 'Chai', 129000, 70, 'LH006', 'location/c3.jpg', '						\r\n					'),
(31, 'Gel Chống Nắng Màng Nước Dưỡng Ẩm Bioré UV Aqua Rich Watery Gel Cool SPF50+/PA++++ 90ml', 'Chai', 129000, 70, 'LH006', 'location/c3.jpg', '						\r\n					'),
(32, '[100ml] [BIG SIZE] Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream', 'Chai', 59000, 80, 'LH005', 'location/k1.jpg', '				Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream là sản phẩm dưỡng da tay đến từ thương hiệu Jkosmec với sự kết hợp hoàn hảo của chiết xuất các hương hoa tự nhiên và tinh chất ốc sên làm giảm tình trạng khô da, giúp đôi tay được cấp ẩm, mịn màng cùng mùi hương nhẹ nhàng, thẩm thấu nhanh mang lại cảm giác thoải mái khi sử dụng.		\r\n					'),
(33, '[100ml] [BIG SIZE] Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream', 'Chai', 59000, 80, 'LH005', 'location/k1.jpg', '				Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream là sản phẩm dưỡng da tay đến từ thương hiệu Jkosmec với sự kết hợp hoàn hảo của chiết xuất các hương hoa tự nhiên và tinh chất ốc sên làm giảm tình trạng khô da, giúp đôi tay được cấp ẩm, mịn màng cùng mùi hương nhẹ nhàng, thẩm thấu nhanh mang lại cảm giác thoải mái khi sử dụng.		\r\n					'),
(34, '[100ml] [BIG SIZE] Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream', 'Chai', 59000, 80, 'LH005', 'location/k1.jpg', '				Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream là sản phẩm dưỡng da tay đến từ thương hiệu Jkosmec với sự kết hợp hoàn hảo của chiết xuất các hương hoa tự nhiên và tinh chất ốc sên làm giảm tình trạng khô da, giúp đôi tay được cấp ẩm, mịn màng cùng mùi hương nhẹ nhàng, thẩm thấu nhanh mang lại cảm giác thoải mái khi sử dụng.		\r\n					'),
(35, '[100ml] [BIG SIZE] Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream', 'Chai', 59000, 80, 'LH005', 'location/k1.jpg', '				Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream là sản phẩm dưỡng da tay đến từ thương hiệu Jkosmec với sự kết hợp hoàn hảo của chiết xuất các hương hoa tự nhiên và tinh chất ốc sên làm giảm tình trạng khô da, giúp đôi tay được cấp ẩm, mịn màng cùng mùi hương nhẹ nhàng, thẩm thấu nhanh mang lại cảm giác thoải mái khi sử dụng.		\r\n					'),
(36, '[100ml] [BIG SIZE] Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream', 'Chai', 250000, 70, 'LH005', 'location/k3.jpg', '						Kem Dưỡng Ẩm Da Tay Hương Hoa Jkosmec Hand Cream là sản phẩm dưỡng da tay đến từ thương hiệu Jkosmec với sự kết hợp hoàn hảo của chiết xuất các hương hoa tự nhiên và tinh chất ốc sên làm giảm tình trạng khô da, giúp đôi tay được cấp ẩm, mịn màng cùng mùi hương nhẹ nhàng, thẩm thấu nhanh mang lại cảm giác thoải mái khi sử dụng.\r\n					'),
(37, '[50g] Kem Dưỡng Da Tay Chiết Xuất Từ Thiên Nhiên Pure Mind Botanical Hand Cream', 'Chai', 49000, 60, 'LH005', 'location/k4.jpg', '						\r\n					Kem Dưỡng Da Tay Chiết Xuất Từ Thiên Nhiên Pure Mind Botanical Hand Cream là kem dưỡng da tay với chiết xuất từ thiên nhiên sẽ đem lại hiệu quả làm đẹp tuyệt vời có hương hoa dịu nhẹ giúp dưỡng ẩm cho da tay khô ráp mà không gây cảm giác bết dính thuộc thương hiệu Pure Mind đến từ Hàn Quốc '),
(38, '[50g] Kem Dưỡng Da Tay Chiết Xuất Từ Thiên Nhiên Pure Mind Botanical Hand Cream', 'Chai', 49000, 60, 'LH005', 'location/k4.jpg', '						\r\n					Kem Dưỡng Da Tay Chiết Xuất Từ Thiên Nhiên Pure Mind Botanical Hand Cream là kem dưỡng da tay với chiết xuất từ thiên nhiên sẽ đem lại hiệu quả làm đẹp tuyệt vời có hương hoa dịu nhẹ giúp dưỡng ẩm cho da tay khô ráp mà không gây cảm giác bết dính thuộc thương hiệu Pure Mind đến từ Hàn Quốc '),
(39, '[50g] Kem Dưỡng Da Tay Chiết Xuất Từ Thiên Nhiên Pure Mind Botanical Hand Cream', 'Chai', 49000, 60, 'LH005', 'location/k4.jpg', '						\r\n					Kem Dưỡng Da Tay Chiết Xuất Từ Thiên Nhiên Pure Mind Botanical Hand Cream là kem dưỡng da tay với chiết xuất từ thiên nhiên sẽ đem lại hiệu quả làm đẹp tuyệt vời có hương hoa dịu nhẹ giúp dưỡng ẩm cho da tay khô ráp mà không gây cảm giác bết dính thuộc thương hiệu Pure Mind đến từ Hàn Quốc '),
(40, '[Trị Mụn Chỉ Trong 30 Ngày] Nước Hoa Hồng \"Thần Kỳ\" Some By Mi AHA-BHA-PHA 30 Days Miracle Toner 150ml', 'Chai', 209000, 80, 'LH004', 'location/n1.jpg', '				Nước hoa hồng Some By Mi giúp loại bỏ bã nhờn và điều trị mụn không chứa 20 thành phần gây hại cho da. Là nước cân bằng thuộc dòng AHA-BHA-PHA của thương hiệu Some By Mi với sự kết hợp của 3 thành phần này giúp da nhanh chóng khô còi mụn, thu nhỏ lỗ chân lông trả lại làn da mịn màng và căng bóng. Sản phẩm còn là sự kết hợp của 2% niacinamide và các chiết xuất thực vật giúp làm giảm khả năng kích ứng do mụn gây ra,da không còn ửng đỏ căng rát sau khi sử dụng các sản phẩm làm sạch		\r\n					'),
(41, '[Trị Mụn Chỉ Trong 30 Ngày] Nước Hoa Hồng \"Thần Kỳ\" Some By Mi AHA-BHA-PHA 30 Days Miracle Toner 150ml', 'Chai', 209000, 80, 'LH004', 'location/n1.jpg', '				Nước hoa hồng Some By Mi giúp loại bỏ bã nhờn và điều trị mụn không chứa 20 thành phần gây hại cho da. Là nước cân bằng thuộc dòng AHA-BHA-PHA của thương hiệu Some By Mi với sự kết hợp của 3 thành phần này giúp da nhanh chóng khô còi mụn, thu nhỏ lỗ chân lông trả lại làn da mịn màng và căng bóng. Sản phẩm còn là sự kết hợp của 2% niacinamide và các chiết xuất thực vật giúp làm giảm khả năng kích ứng do mụn gây ra,da không còn ửng đỏ căng rát sau khi sử dụng các sản phẩm làm sạch		\r\n					'),
(42, '[Trị Mụn Chỉ Trong 30 Ngày] Nước Hoa Hồng \"Thần Kỳ\" Some By Mi AHA-BHA-PHA 30 Days Miracle Toner 150ml', 'Chai', 209000, 80, 'LH004', 'location/n1.jpg', '				Nước hoa hồng Some By Mi giúp loại bỏ bã nhờn và điều trị mụn không chứa 20 thành phần gây hại cho da. Là nước cân bằng thuộc dòng AHA-BHA-PHA của thương hiệu Some By Mi với sự kết hợp của 3 thành phần này giúp da nhanh chóng khô còi mụn, thu nhỏ lỗ chân lông trả lại làn da mịn màng và căng bóng. Sản phẩm còn là sự kết hợp của 2% niacinamide và các chiết xuất thực vật giúp làm giảm khả năng kích ứng do mụn gây ra,da không còn ửng đỏ căng rát sau khi sử dụng các sản phẩm làm sạch		\r\n					'),
(43, 'Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner 140ml', 'Chai', 509000, 90, 'LH004', 'location/n2.jpg', '					Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner là nước hoa hồng với các thành phần như bí đao, rau má và tràm trà và công thức không chứa cồn có tác dụng cân bằng pH. giảm dầu, làm sạch lỗ chân lông và cải thiện tình trạng mụn, được bổ sung thêm vitamin B3 và HA giúp cấp ẩm cho làn da luôn mịn màng thuộc thương hiệu  mỹ phẩm thuần chay Cocoon đến từ Việt Nam.	\r\n					'),
(44, 'Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner 140ml', 'Chai', 509000, 90, 'LH004', 'location/n2.jpg', '					Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner là nước hoa hồng với các thành phần như bí đao, rau má và tràm trà và công thức không chứa cồn có tác dụng cân bằng pH. giảm dầu, làm sạch lỗ chân lông và cải thiện tình trạng mụn, được bổ sung thêm vitamin B3 và HA giúp cấp ẩm cho làn da luôn mịn màng thuộc thương hiệu  mỹ phẩm thuần chay Cocoon đến từ Việt Nam.	\r\n					'),
(45, 'Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner 140ml', 'Chai', 509000, 90, 'LH004', 'location/n2.jpg', '					Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner là nước hoa hồng với các thành phần như bí đao, rau má và tràm trà và công thức không chứa cồn có tác dụng cân bằng pH. giảm dầu, làm sạch lỗ chân lông và cải thiện tình trạng mụn, được bổ sung thêm vitamin B3 và HA giúp cấp ẩm cho làn da luôn mịn màng thuộc thương hiệu  mỹ phẩm thuần chay Cocoon đến từ Việt Nam.	\r\n					'),
(46, 'Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner 140ml', 'Chai', 509000, 89, 'LH004', 'location/n2.jpg', '					Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner là nước hoa hồng với các thành phần như bí đao, rau má và tràm trà và công thức không chứa cồn có tác dụng cân bằng pH. giảm dầu, làm sạch lỗ chân lông và cải thiện tình trạng mụn, được bổ sung thêm vitamin B3 và HA giúp cấp ẩm cho làn da luôn mịn màng thuộc thương hiệu  mỹ phẩm thuần chay Cocoon đến từ Việt Nam.	\r\n					'),
(47, 'Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner 140ml', 'Chai', 509000, 90, 'LH004', 'location/n2.jpg', '					Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner là nước hoa hồng với các thành phần như bí đao, rau má và tràm trà và công thức không chứa cồn có tác dụng cân bằng pH. giảm dầu, làm sạch lỗ chân lông và cải thiện tình trạng mụn, được bổ sung thêm vitamin B3 và HA giúp cấp ẩm cho làn da luôn mịn màng thuộc thương hiệu  mỹ phẩm thuần chay Cocoon đến từ Việt Nam.	\r\n					'),
(48, 'Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner 140ml', 'Chai', 509000, 90, 'LH004', 'location/n2.jpg', '					Nước Hoa Hồng Cân Bằng Da Chiết Xuất Bí Đao The Cocoon Winter Melon Toner là nước hoa hồng với các thành phần như bí đao, rau má và tràm trà và công thức không chứa cồn có tác dụng cân bằng pH. giảm dầu, làm sạch lỗ chân lông và cải thiện tình trạng mụn, được bổ sung thêm vitamin B3 và HA giúp cấp ẩm cho làn da luôn mịn màng thuộc thương hiệu  mỹ phẩm thuần chay Cocoon đến từ Việt Nam.	\r\n					'),
(49, 'Nước Hoa Hồng Dưỡng Da Cấp Ẩm Chuyên Sâu II Curél Intensive Moisture Care Moisture Facial Lotion II 150ml', 'Chai', 457000, 80, 'LH004', 'location/n3.jpg', '						Nước Hoa Hồng Dưỡng Da Cấp Ẩm Chuyên Sâu II Curél Intensive Moisture Care Moisture Facial Lotion II là nước hoa hồng với độ cấp ẩm ở mức vừa cho làn da khô ráp trong dòng sản phẩm cấp ẩm chuyên sâu của thương hiệu Curél giúp tăng cường dưỡng ẩm cho da, cải thiện nhanh chóng tình trạng da khô bong tróc hiệu quả thuộc thương hiệu dược mỹ phẩm Curél đến từ Nhật Bản\r\n					'),
(50, 'Nước Hoa Hồng Dưỡng Da Cấp Ẩm Chuyên Sâu II Curél Intensive Moisture Care Moisture Facial Lotion II 150ml', 'Chai', 457000, 80, 'LH004', 'location/n3.jpg', '						Nước Hoa Hồng Dưỡng Da Cấp Ẩm Chuyên Sâu II Curél Intensive Moisture Care Moisture Facial Lotion II là nước hoa hồng với độ cấp ẩm ở mức vừa cho làn da khô ráp trong dòng sản phẩm cấp ẩm chuyên sâu của thương hiệu Curél giúp tăng cường dưỡng ẩm cho da, cải thiện nhanh chóng tình trạng da khô bong tróc hiệu quả thuộc thương hiệu dược mỹ phẩm Curél đến từ Nhật Bản\r\n					'),
(51, 'Nước Hoa Hồng Dưỡng Da Cấp Ẩm Chuyên Sâu II Curél Intensive Moisture Care Moisture Facial Lotion II 150ml', 'Chai', 457000, 80, 'LH004', 'location/n3.jpg', '						Nước Hoa Hồng Dưỡng Da Cấp Ẩm Chuyên Sâu II Curél Intensive Moisture Care Moisture Facial Lotion II là nước hoa hồng với độ cấp ẩm ở mức vừa cho làn da khô ráp trong dòng sản phẩm cấp ẩm chuyên sâu của thương hiệu Curél giúp tăng cường dưỡng ẩm cho da, cải thiện nhanh chóng tình trạng da khô bong tróc hiệu quả thuộc thương hiệu dược mỹ phẩm Curél đến từ Nhật Bản\r\n					'),
(52, 'Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner 355ml', 'Chai', 199000, 80, 'LH004', 'location/n4.jpg', '						Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner là dòng nước hoa hồng thuộc thương hiệu Thayers được người Mỹ bản xứ ưa chuộng từ lâu đời bởi công nghệ độc quyền không qua chưng cất nhưng vẫn giữ được những tinh chất tự nhiên tốt nhất của nha đam và cây phỉ giúp cấp ẩm cho da khỏe mạnh tự nhiên và se khít lỗ chân lông\r\n					'),
(53, 'Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner 355ml', 'Chai', 199000, 80, 'LH004', 'location/n4.jpg', '						Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner là dòng nước hoa hồng thuộc thương hiệu Thayers được người Mỹ bản xứ ưa chuộng từ lâu đời bởi công nghệ độc quyền không qua chưng cất nhưng vẫn giữ được những tinh chất tự nhiên tốt nhất của nha đam và cây phỉ giúp cấp ẩm cho da khỏe mạnh tự nhiên và se khít lỗ chân lông\r\n					'),
(54, 'Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner 355ml', 'Chai', 199000, 80, 'LH004', 'location/n4.jpg', '						Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner là dòng nước hoa hồng thuộc thương hiệu Thayers được người Mỹ bản xứ ưa chuộng từ lâu đời bởi công nghệ độc quyền không qua chưng cất nhưng vẫn giữ được những tinh chất tự nhiên tốt nhất của nha đam và cây phỉ giúp cấp ẩm cho da khỏe mạnh tự nhiên và se khít lỗ chân lông\r\n					'),
(55, 'Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner 355ml', 'Chai', 199000, 80, 'LH004', 'location/n4.jpg', '						Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner là dòng nước hoa hồng thuộc thương hiệu Thayers được người Mỹ bản xứ ưa chuộng từ lâu đời bởi công nghệ độc quyền không qua chưng cất nhưng vẫn giữ được những tinh chất tự nhiên tốt nhất của nha đam và cây phỉ giúp cấp ẩm cho da khỏe mạnh tự nhiên và se khít lỗ chân lông\r\n					'),
(56, 'Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner 355ml', 'Chai', 199000, 80, 'LH004', 'location/n4.jpg', '						Nước Hoa Hồng Không Cồn Giúp Làm Sạch, Dịu Da Thayers Witch Hazel Aloe Vera Formula Facial Toner là dòng nước hoa hồng thuộc thương hiệu Thayers được người Mỹ bản xứ ưa chuộng từ lâu đời bởi công nghệ độc quyền không qua chưng cất nhưng vẫn giữ được những tinh chất tự nhiên tốt nhất của nha đam và cây phỉ giúp cấp ẩm cho da khỏe mạnh tự nhiên và se khít lỗ chân lông\r\n					'),
(57, 'Son Dưỡng Môi Có Nhũ Unleashia Glittery Wave Lip Balm 4.5g', 'Thỏi', 159000, 90, 'LH001', 'location/son14.jpg', '					Son dưỡng môi có màu Unleashia Glittery Wave Lip Balm là son dưỡng đến từ thương hiệu Unleashia được mệnh danh là son nhũ \"siêu mẫu vũ trụ\" của thương hiệu Unleashia chứa các hạt glitter đem lại đôi môi mong manh cùng thành phần thiên nhiên dưỡng môi căng bóng, mềm mại, lấp lánh quyến rũ 	\r\n					'),
(58, 'Son Dưỡng Môi Có Nhũ Unleashia Glittery Wave Lip Balm 4.5g', 'Thỏi', 159000, 90, 'LH001', 'location/son14.jpg', '					Son dưỡng môi có màu Unleashia Glittery Wave Lip Balm là son dưỡng đến từ thương hiệu Unleashia được mệnh danh là son nhũ \"siêu mẫu vũ trụ\" của thương hiệu Unleashia chứa các hạt glitter đem lại đôi môi mong manh cùng thành phần thiên nhiên dưỡng môi căng bóng, mềm mại, lấp lánh quyến rũ 	\r\n					'),
(59, 'Son Dưỡng Môi Có Nhũ Unleashia Glittery Wave Lip Balm 4.5g', 'Thỏi', 159000, 90, 'LH001', 'location/son14.jpg', '					Son dưỡng môi có màu Unleashia Glittery Wave Lip Balm là son dưỡng đến từ thương hiệu Unleashia được mệnh danh là son nhũ \"siêu mẫu vũ trụ\" của thương hiệu Unleashia chứa các hạt glitter đem lại đôi môi mong manh cùng thành phần thiên nhiên dưỡng môi căng bóng, mềm mại, lấp lánh quyến rũ 	\r\n					'),
(60, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 139000, 80, 'LH001', 'location/son17.jpg', '						Son Kem Lì 3CE Soft Lip Lacquer 6g\r\n					'),
(61, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 139000, 80, 'LH001', 'location/son17.jpg', '						Son Kem Lì 3CE Soft Lip Lacquer 6g\r\n					'),
(62, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 139000, 80, 'LH001', 'location/son17.jpg', '						Son Kem Lì 3CE Soft Lip Lacquer 6g\r\n					'),
(63, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 139000, 80, 'LH001', 'location/son17.jpg', '						Son Kem Lì 3CE Soft Lip Lacquer 6g\r\n					'),
(64, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 139000, 80, 'LH001', 'location/son17.jpg', '						Son Kem Lì 3CE Soft Lip Lacquer 6g\r\n					'),
(65, 'Son Kem Lì 3CE Soft Lip Lacquer 6g', 'Thỏi', 139000, 80, 'LH001', 'location/son17.jpg', '						Son Kem Lì 3CE Soft Lip Lacquer 6g\r\n					'),
(66, 'Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml', 'Chai', 180000, 80, 'LH002', 'location/t2.jpg', '				Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml		\r\n					'),
(67, 'Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml', 'Chai', 180000, 80, 'LH002', 'location/t2.jpg', '				Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml		\r\n					'),
(68, 'Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml', 'Chai', 180000, 80, 'LH002', 'location/t2.jpg', '				Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml		\r\n					'),
(69, 'Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml', 'Chai', 80000, 80, 'LH002', 'location/t2.jpg', '						\r\n			Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover là nước tẩy trang chuyên nghiệp dùng cho vùng da quanh mắt và môi, chứa tinh chát hoa hồng có tác dụng dưỡng da, làm mềm da và tránh tình trạng khô rát sau khi tẩy trang thuộc thương hiệu Maybelline đến từ Mỹ 		'),
(70, 'Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover 150ml', 'Chai', 80000, 80, 'LH002', 'location/t2.jpg', '						\r\n			Nước Tẩy Trang Dành Cho Mắt Môi Maybelline Eye & Lip Makeup Remover là nước tẩy trang chuyên nghiệp dùng cho vùng da quanh mắt và môi, chứa tinh chát hoa hồng có tác dụng dưỡng da, làm mềm da và tránh tình trạng khô rát sau khi tẩy trang thuộc thương hiệu Maybelline đến từ Mỹ 		'),
(71, 'Dầu Tẩy Trang Giúp Làm Sạch Sâu Bioré Make Up Remover Perfect Oil 150ml', 'Chai', 80000, 90, 'LH002', 'location/t3.jpg', '						\r\n					Dầu Tẩy Trang Giúp Làm Sạch Sâu Bioré Make Up Remover Perfect Oil 150ml'),
(72, 'Dầu Tẩy Trang Giúp Làm Sạch Sâu Bioré Make Up Remover Perfect Oil 150ml', 'Chai', 80000, 90, 'LH002', 'location/t3.jpg', '						\r\n					Dầu Tẩy Trang Giúp Làm Sạch Sâu Bioré Make Up Remover Perfect Oil 150ml'),
(73, 'Dầu Tẩy Trang Giúp Làm Sạch Sâu Bioré Make Up Remover Perfect Oil 150ml', 'Chai', 80000, 90, 'LH002', 'location/t3.jpg', '						\r\n					Dầu Tẩy Trang Giúp Làm Sạch Sâu Bioré Make Up Remover Perfect Oil 150ml'),
(74, '[Tiết Kiệm Với Phiên Bản 1000ml] Nước Tẩy Trang Làm Sạch Da, Kháng Khuẩn, Dịu Nhẹ Derladie Cleansing Water Witch Hazel Micellar', 'Chai 429', 90000, 90, 'LH002', 'location/t4.jpg', '						\r\n				Nước Tẩy Trang Làm Sạch Da, Kháng Khuẩn, Dịu Nhẹ Derladie Cleansing Water Witch Hazel Micellar là nước tẩy trang thuộc thương hiệu Derladie phiên bản cái tiến tăng cường hiệu quả làm sạch nhờ phân tử Micellar giúp loại bỏ bụi bẩn, lớp trang điềm, dầu thừa một cách hoàn hảo, bổ sung độ ẩm, chống oxy hóa và kháng khuẩn hiệu quả. Thành phần chiết xuất từ cây phỉ - một loại thảo dược quý hiếm có chức nắng kháng khuẩn và tại tạo da, một thành phần tuyệt vời cho da nhạy cảm	'),
(75, '[Tiết Kiệm Với Phiên Bản 1000ml] Nước Tẩy Trang Làm Sạch Da, Kháng Khuẩn, Dịu Nhẹ Derladie Cleansing Water Witch Hazel Micellar', 'Chai 429', 90000, 90, 'LH002', 'location/t4.jpg', '						\r\n				Nước Tẩy Trang Làm Sạch Da, Kháng Khuẩn, Dịu Nhẹ Derladie Cleansing Water Witch Hazel Micellar là nước tẩy trang thuộc thương hiệu Derladie phiên bản cái tiến tăng cường hiệu quả làm sạch nhờ phân tử Micellar giúp loại bỏ bụi bẩn, lớp trang điềm, dầu thừa một cách hoàn hảo, bổ sung độ ẩm, chống oxy hóa và kháng khuẩn hiệu quả. Thành phần chiết xuất từ cây phỉ - một loại thảo dược quý hiếm có chức nắng kháng khuẩn và tại tạo da, một thành phần tuyệt vời cho da nhạy cảm	'),
(76, 'Dầu Tẩy Trang Làm Sạch Sâu, Dịu Nhẹ Chiết Xuất Rau Má Skin1004 Madagascar Centella Light Cleansing Oil 200ml', 'Chai', 900000, 80, 'LH002', 'location/t6.jpg', '						\r\n					Dầu Tẩy Trang Làm Sạch Sâu, Dịu Nhẹ Chiết Xuất Rau Má Skin1004 Madagascar Centella Light Cleansing Oil  là dầu tẩy trang giúp làm sạch sâu làn da và làm sạch lớp trang điểm cứng đầu với chiết xuất rau má Madagascar tinh khiết kết hợp cùng 6 loại dầu quý được chắt lọc kỹ lưỡng, mang lại làn da sạch tận sâu lỗ chân lông và mềm mịn ngay tức thì  thuộc thương hiệu Skin1004 đến từ Hàn Quốc'),
(77, 'Dầu Tẩy Trang Làm Sạch Sâu, Dịu Nhẹ Chiết Xuất Rau Má Skin1004 Madagascar Centella Light Cleansing Oil 200ml', 'Chai', 900000, 80, 'LH002', 'location/t6.jpg', '						\r\n					Dầu Tẩy Trang Làm Sạch Sâu, Dịu Nhẹ Chiết Xuất Rau Má Skin1004 Madagascar Centella Light Cleansing Oil  là dầu tẩy trang giúp làm sạch sâu làn da và làm sạch lớp trang điểm cứng đầu với chiết xuất rau má Madagascar tinh khiết kết hợp cùng 6 loại dầu quý được chắt lọc kỹ lưỡng, mang lại làn da sạch tận sâu lỗ chân lông và mềm mịn ngay tức thì  thuộc thương hiệu Skin1004 đến từ Hàn Quốc'),
(78, 'Dầu Tẩy Trang Làm Sạch Sâu, Dịu Nhẹ Chiết Xuất Rau Má Skin1004 Madagascar Centella Light Cleansing Oil 200ml', 'Chai', 900000, 80, 'LH002', 'location/t6.jpg', '						\r\n					Dầu Tẩy Trang Làm Sạch Sâu, Dịu Nhẹ Chiết Xuất Rau Má Skin1004 Madagascar Centella Light Cleansing Oil  là dầu tẩy trang giúp làm sạch sâu làn da và làm sạch lớp trang điểm cứng đầu với chiết xuất rau má Madagascar tinh khiết kết hợp cùng 6 loại dầu quý được chắt lọc kỹ lưỡng, mang lại làn da sạch tận sâu lỗ chân lông và mềm mịn ngay tức thì  thuộc thương hiệu Skin1004 đến từ Hàn Quốc'),
(79, 'Sữa Rửa Mặt Dạng Gel Dịu Nhẹ Cosrx Low pH Good Morning Gel Cleanser', 'Chai', 89000, 80, 'LH003', 'location/s1.jpg', '						Sữa Rửa Mặt Dạng Gel Dịu Nhẹ Cosrx Low pH Good Morning Gel Cleanser\r\n					'),
(80, 'Sữa Rửa Mặt Dạng Gel Dịu Nhẹ Cosrx Low pH Good Morning Gel Cleanser', 'Chai', 89000, 80, 'LH003', 'location/s1.jpg', '						Sữa Rửa Mặt Dạng Gel Dịu Nhẹ Cosrx Low pH Good Morning Gel Cleanser\r\n					'),
(81, 'Sữa Rửa Mặt Dịu Nhẹ, Lành Tính Không Tạo Bọt Cetaphil Gentle Skin Cleanser', 'Chai', 278000, 90, 'LH003', 'location/s2.jpg', '						\r\n					Sữa Rửa Mặt Dịu Nhẹ, Lành Tính Không Tạo Bọt Cetaphil Gentle Skin Cleanser  là sữa rửa mặt với công thức lành tính giúp loại bỏ bụi bẩn một cách nhẹ nhàng. Bên cạnh đó, Cetaphil Skin Cleanser còn không gây bít tắc lỗ chân lông, có khả năng duy trì độ ẩm tự nhiên và phù hợp với mọi loại da, kể cả làn da mỏng manh của bé sơ sinh thuộc thương Cetaphil được bác sĩ da liễu khuyên dùng đến từ Canada.'),
(82, 'Sữa Rửa Mặt Dịu Nhẹ, Lành Tính Không Tạo Bọt Cetaphil Gentle Skin Cleanser', 'Chai', 278000, 90, 'LH003', 'location/s2.jpg', '						\r\n					Sữa Rửa Mặt Dịu Nhẹ, Lành Tính Không Tạo Bọt Cetaphil Gentle Skin Cleanser  là sữa rửa mặt với công thức lành tính giúp loại bỏ bụi bẩn một cách nhẹ nhàng. Bên cạnh đó, Cetaphil Skin Cleanser còn không gây bít tắc lỗ chân lông, có khả năng duy trì độ ẩm tự nhiên và phù hợp với mọi loại da, kể cả làn da mỏng manh của bé sơ sinh thuộc thương Cetaphil được bác sĩ da liễu khuyên dùng đến từ Canada.'),
(83, 'Sữa Rửa Mặt Dịu Nhẹ, Lành Tính Không Tạo Bọt Cetaphil Gentle Skin Cleanser', 'Chai', 278000, 90, 'LH003', 'location/s2.jpg', '						\r\n					Sữa Rửa Mặt Dịu Nhẹ, Lành Tính Không Tạo Bọt Cetaphil Gentle Skin Cleanser  là sữa rửa mặt với công thức lành tính giúp loại bỏ bụi bẩn một cách nhẹ nhàng. Bên cạnh đó, Cetaphil Skin Cleanser còn không gây bít tắc lỗ chân lông, có khả năng duy trì độ ẩm tự nhiên và phù hợp với mọi loại da, kể cả làn da mỏng manh của bé sơ sinh thuộc thương Cetaphil được bác sĩ da liễu khuyên dùng đến từ Canada.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `mskh` int(11) NOT NULL,
  `hotenkh` varchar(40) NOT NULL,
  `matkhau` char(40) NOT NULL,
  `anhkh` text DEFAULT NULL,
  `tencongty` varchar(50) DEFAULT NULL,
  `sodienthoai` char(11) NOT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`mskh`, `hotenkh`, `matkhau`, `anhkh`, `tencongty`, `sodienthoai`, `email`) VALUES
(1, 'Dương Phương Cương', 'cf4d87e50be6390ee9bd8ad6e7498cae', 'anhkh/1242_10-9.jpg', 'DPC Cần Thơ, Thốt Nốt, Thuận Hưng', '0385974437', 'cuong@gmail.com'),
(2, 'Nguyễn Văn A', '224e86b329a794892bfa2afe7824e681', 'anhkh/1242_10-9.jpg', 'NguyenVanA Cần Thơ', '0901032815', 'a@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `maloaihang` char(6) NOT NULL,
  `tenloaihang` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`maloaihang`, `tenloaihang`) VALUES
('LH001', 'Son'),
('LH002', 'Tẩy trang'),
('LH003', 'Sửa rửa mặt'),
('LH004', 'Nước hoa hồng'),
('LH005', 'Kem/Dầu Dưỡng'),
('LH006', 'Chống nắng'),
('LH007', 'Khử mùi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `msnv` char(6) NOT NULL,
  `hotennv` varchar(40) NOT NULL,
  `matkhau` char(40) NOT NULL,
  `chucvu` varchar(40) NOT NULL,
  `anhnv` text DEFAULT NULL,
  `diachi` varchar(200) NOT NULL,
  `sodienthoai` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`msnv`, `hotennv`, `matkhau`, `chucvu`, `anhnv`, `diachi`, `sodienthoai`) VALUES
('ADMIN', 'Dương Phương Cương', '21232f297a57a5a743894a0e4a801fc3', 'Quản trị', '', 'Phường Thuận Hưng, Quận Thốt Nốt, Thành Phố Cần Thơ', '0385974437'),
('NV001', 'Dương Phương Cương', '224e86b329a794892bfa2afe7824e681', 'Quản Lý', 'anhnv/1242_10-9.jpg', 'Thuận Hưng, Thốt Nốt, Cần Thơ', '0901032815'),
('NV002', 'Nguyễn Văn A', '224e86b329a794892bfa2afe7824e681', 'Nhân viên bán hàng', 'anhnv/1242_10-9.jpg', 'Trung Kiên, Thốt Nốt, Cần Thơ', '0901057628'),
('NV003', 'Nguyễn Văn C', '224e86b329a794892bfa2afe7824e681', 'Nhân viên bán hàng', 'anhnv/1242_10-9.jpg', 'Xuân Khánh, Ninh Kiều, TP Cần Thơ', '0385974437');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`sodondh`,`mshh`),
  ADD KEY `FK_chitet_hanghoa` (`mshh`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`sodondh`),
  ADD KEY `FK_dathang_nhanvien` (`msnv`),
  ADD KEY `FK_dathang_khachhang` (`mskh`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`madc`),
  ADD KEY `FK_diachikhachhang` (`mskh`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`mshh`),
  ADD KEY `FK_hanghoa_loaihanghoa` (`maloaihang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`mskh`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`maloaihang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`msnv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `sodondh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `madc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `mshh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `mskh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `FK_chitet_dathang` FOREIGN KEY (`sodondh`) REFERENCES `dathang` (`sodondh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_chitet_hanghoa` FOREIGN KEY (`mshh`) REFERENCES `hanghoa` (`mshh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `FK_dathang_khachhang` FOREIGN KEY (`mskh`) REFERENCES `khachhang` (`mskh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dathang_nhanvien` FOREIGN KEY (`msnv`) REFERENCES `nhanvien` (`msnv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `FK_diachikhachhang` FOREIGN KEY (`mskh`) REFERENCES `khachhang` (`mskh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `FK_hanghoa_loaihanghoa` FOREIGN KEY (`maloaihang`) REFERENCES `loaihanghoa` (`maloaihang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
