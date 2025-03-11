-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 27, 2024 lúc 03:56 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_truyen`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `id_binhluan` int(11) NOT NULL,
  `id_truyen` int(11) NOT NULL,
  `noidung` text NOT NULL,
  `thoigian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuong`
--

CREATE TABLE `chuong` (
  `id_chuong` int(11) NOT NULL,
  `tenchuong` varchar(255) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `id_truyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuong`
--

INSERT INTO `chuong` (`id_chuong`, `tenchuong`, `chapter`, `noidung`, `id_truyen`) VALUES
(1, 'chuuong 1', 'chap 1', 'chuuong số 1 nè', 7),
(2, 'chuong 2', 'chap 2', 'fffdgfd', 7),
(3, 'chuong 1 của ', 'chap 1 cua', 'fsdfs', 4),
(4, 'chuong 6', 'chap 6777', 'đâs', 2),
(5, 'c1', 'c11', 'fhuiewhfkjdsnuia', 4),
(6, 'chuong 10000', 'chap 100', '<p>fsdfds</p>\r\n', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitruyen`
--

CREATE TABLE `loaitruyen` (
  `id_loai` int(11) NOT NULL,
  `tenloai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaitruyen`
--

INSERT INTO `loaitruyen` (`id_loai`, `tenloai`) VALUES
(1, 'Truyện Tranh'),
(2, 'Truyện Chữ'),
(3, 'Truyện Full');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `adminemail` varchar(150) NOT NULL,
  `adminuser` varchar(255) NOT NULL,
  `adminpass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminname`, `adminemail`, `adminuser`, `adminpass`, `level`) VALUES
(1, 'tien', 'tien@gmail.com', 'tienadmin', '81dc9bdb52d04dc20036dbd8313ed055', 0),
(3, 'nhi', '', 'nhi', '123456', 0),
(4, 'nhi', 'nhi@tgu.edu.vn', 'nhi', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thdoitruyen`
--

CREATE TABLE `thdoitruyen` (
  `id_theloai` int(11) NOT NULL,
  `id_truyen` int(11) NOT NULL,
  `sdi` varchar(255) NOT NULL,
  `tentruyen` varchar(255) NOT NULL,
  `biatruyen` varchar(255) NOT NULL,
  `chapcuoi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id_theloai` int(11) NOT NULL,
  `tentheloai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id_theloai`, `tentheloai`) VALUES
(5, 'Trinh Thám'),
(6, 'Cổ Đại'),
(8, 'Ngôn Tình');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `truyen`
--

CREATE TABLE `truyen` (
  `id_truyen` int(11) NOT NULL,
  `tentruyen` varchar(255) NOT NULL,
  `tacgia` varchar(255) NOT NULL,
  `id_theloai` int(11) NOT NULL,
  `id_loai` int(11) NOT NULL,
  `kieu` int(11) NOT NULL,
  `biatruyen` varchar(255) NOT NULL,
  `trangthai` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `truyen`
--

INSERT INTO `truyen` (`id_truyen`, `tentruyen`, `tacgia`, `id_theloai`, `id_loai`, `kieu`, `biatruyen`, `trangthai`, `mota`) VALUES
(2, 'Lại gặp được em', 'gghjk', 5, 1, 1, 'efbb549caa.png', 'trangthai', '<p>m&ocirc; tả truyện</p>\r\n'),
(4, 'Khó Dỗ Dành', 'ghj', 5, 1, 1, '6fb8a0470c.jpg', '1', '<p>m&ocirc; tả&nbsp;</p>\r\n'),
(7, 'Cạm Bẫy Của Hồ Ly', 'gghjk', 5, 1, 1, 'a060f4ba51.png', '0', '<p><img alt=\"\" src=\"/ckfinder/userfiles/images/3bb1d51633.png\" style=\"height:1200px; width:835px\" /></p>\r\n');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id_binhluan`),
  ADD UNIQUE KEY `id_truyen` (`id_truyen`);

--
-- Chỉ mục cho bảng `chuong`
--
ALTER TABLE `chuong`
  ADD PRIMARY KEY (`id_chuong`),
  ADD KEY `idx_id_truyen` (`id_truyen`);

--
-- Chỉ mục cho bảng `loaitruyen`
--
ALTER TABLE `loaitruyen`
  ADD PRIMARY KEY (`id_loai`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Chỉ mục cho bảng `thdoitruyen`
--
ALTER TABLE `thdoitruyen`
  ADD PRIMARY KEY (`id_theloai`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id_theloai`);

--
-- Chỉ mục cho bảng `truyen`
--
ALTER TABLE `truyen`
  ADD PRIMARY KEY (`id_truyen`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id_binhluan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chuong`
--
ALTER TABLE `chuong`
  MODIFY `id_chuong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `loaitruyen`
--
ALTER TABLE `loaitruyen`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thdoitruyen`
--
ALTER TABLE `thdoitruyen`
  MODIFY `id_theloai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id_theloai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `truyen`
--
ALTER TABLE `truyen`
  MODIFY `id_truyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chuong`
--
ALTER TABLE `chuong`
  ADD CONSTRAINT `chuong_ibfk_1` FOREIGN KEY (`id_truyen`) REFERENCES `truyen` (`id_truyen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
