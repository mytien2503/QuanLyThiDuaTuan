-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 30, 2021 lúc 11:22 AM
-- Phiên bản máy phục vụ: 5.7.25
-- Phiên bản PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlthidua`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocsinh`
--

CREATE TABLE `hocsinh` (
  `id` int(11) NOT NULL,
  `ho` varchar(50) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `gioitinh` varchar(3) NOT NULL,
  `ngaysinh` datetime NOT NULL,
  `namhoc_id` int(11) NOT NULL,
  `lop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hocsinh`
--

INSERT INTO `hocsinh` (`id`, `ho`, `ten`, `gioitinh`, `ngaysinh`, `namhoc_id`, `lop_id`) VALUES
(1, 'Lê Thị Mỹ', 'Tiên', 'Nữ', '2010-03-25 00:00:00', 1, 7),
(2, 'Nguyễn Văn', 'A', 'Nam', '2010-07-20 00:00:00', 1, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoi`
--

CREATE TABLE `khoi` (
  `id` int(11) NOT NULL,
  `khoi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `khoi`
--

INSERT INTO `khoi` (`id`, `khoi`) VALUES
(1, 6),
(2, 7),
(3, 8),
(4, 9),
(5, 10),
(7, 11),
(8, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `id` int(11) NOT NULL,
  `lop` varchar(10) NOT NULL,
  `khoi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`id`, `lop`, `khoi_id`) VALUES
(7, '6A1', 1),
(8, '6A2', 1),
(9, '7A1', 2),
(10, '7A2', 2),
(11, '8A1', 3),
(12, '8A2', 3),
(13, '9A1', 4),
(14, '9A2', 4),
(32, '10A1', 5),
(33, '10A2', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mucvipham`
--

CREATE TABLE `mucvipham` (
  `id` int(11) NOT NULL,
  `mucvipham` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `mucvipham`
--

INSERT INTO `mucvipham` (`id`, `mucvipham`) VALUES
(1, 'Đi trễ'),
(2, 'Vắng có phép'),
(3, 'Vắng không phép'),
(4, 'Không đồng phục'),
(5, 'Mất trật tự');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `namhoc`
--

CREATE TABLE `namhoc` (
  `id` int(11) NOT NULL,
  `namhoc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `namhoc`
--

INSERT INTO `namhoc` (`id`, `namhoc`) VALUES
(1, '2022-2023'),
(3, '2023-2024'),
(4, '2024-2025');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `id` int(11) NOT NULL,
  `ngaydang` datetime NOT NULL,
  `noidung` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`id`, `ngaydang`, `noidung`) VALUES
(1, '2021-10-11 00:00:00', 'Thông báo lịch học mới');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tructuan`
--

CREATE TABLE `tructuan` (
  `id` int(11) NOT NULL,
  `solan` int(11) NOT NULL,
  `tongdiemtru` float NOT NULL,
  `tuan_id` int(11) NOT NULL,
  `hocsinh_id` int(11) NOT NULL,
  `vipham_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tructuan`
--

INSERT INTO `tructuan` (`id`, `solan`, `tongdiemtru`, `tuan_id`, `hocsinh_id`, `vipham_id`) VALUES
(1, 1, 0.5, 1, 1, 4),
(2, 1, 0.5, 1, 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuan`
--

CREATE TABLE `tuan` (
  `id` int(11) NOT NULL,
  `tuan` int(11) NOT NULL,
  `namhoc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tuan`
--

INSERT INTO `tuan` (`id`, `tuan`, `namhoc_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vipham`
--

CREATE TABLE `vipham` (
  `id` int(11) NOT NULL,
  `vipham` varchar(100) NOT NULL,
  `mucvipham_id` int(11) NOT NULL,
  `diemtru` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vipham`
--

INSERT INTO `vipham` (`id`, `vipham`, `mucvipham_id`, `diemtru`) VALUES
(1, 'Mang dép lê', 4, 1),
(2, 'Không đeo khăn quàng', 4, 1),
(3, 'Đi trễ', 1, 0.5),
(4, 'Vắng có phép', 2, 0.5),
(5, 'Vắng không phép', 3, 1),
(6, 'Mất trật tự', 5, 0.5),
(7, 'abc', 5, 0.5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xephang`
--

CREATE TABLE `xephang` (
  `id` int(11) NOT NULL,
  `diemSDB` float NOT NULL,
  `tongdiemtru` float NOT NULL,
  `diemdatduoc` float NOT NULL,
  `sotiet` int(11) NOT NULL,
  `trungbinh` float NOT NULL,
  `tructuan_id` int(11) NOT NULL,
  `lop_id` int(11) NOT NULL,
  `khoi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `xephang`
--

INSERT INTO `xephang` (`id`, `diemSDB`, `tongdiemtru`, `diemdatduoc`, `sotiet`, `trungbinh`, `tructuan_id`, `lop_id`, `khoi_id`) VALUES
(1, 300, 1, 299, 30, 9.967, 1, 7, 1),
(2, 300, 0, 300, 30, 10, 1, 8, 1),
(3, 300, 1, 299, 30, 9.967, 1, 9, 2),
(4, 300, 3, 297, 30, 9.9, 1, 10, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hocsinh`
--
ALTER TABLE `hocsinh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `namhoc_id` (`namhoc_id`),
  ADD KEY `lop_id` (`lop_id`);

--
-- Chỉ mục cho bảng `khoi`
--
ALTER TABLE `khoi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `khoi_id` (`khoi_id`);

--
-- Chỉ mục cho bảng `mucvipham`
--
ALTER TABLE `mucvipham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `namhoc`
--
ALTER TABLE `namhoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tructuan`
--
ALTER TABLE `tructuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hocsinh_id` (`hocsinh_id`),
  ADD KEY `vipham_id` (`vipham_id`),
  ADD KEY `tuan_id` (`tuan_id`);

--
-- Chỉ mục cho bảng `tuan`
--
ALTER TABLE `tuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `namhoc_id` (`namhoc_id`);

--
-- Chỉ mục cho bảng `vipham`
--
ALTER TABLE `vipham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mucvipham_id` (`mucvipham_id`);

--
-- Chỉ mục cho bảng `xephang`
--
ALTER TABLE `xephang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tructuan_id` (`tructuan_id`),
  ADD KEY `lop_id` (`lop_id`),
  ADD KEY `khoi_id` (`khoi_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hocsinh`
--
ALTER TABLE `hocsinh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `khoi`
--
ALTER TABLE `khoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lop`
--
ALTER TABLE `lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `mucvipham`
--
ALTER TABLE `mucvipham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `namhoc`
--
ALTER TABLE `namhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tructuan`
--
ALTER TABLE `tructuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tuan`
--
ALTER TABLE `tuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `vipham`
--
ALTER TABLE `vipham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `xephang`
--
ALTER TABLE `xephang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `hocsinh`
--
ALTER TABLE `hocsinh`
  ADD CONSTRAINT `hocsinh_ibfk_1` FOREIGN KEY (`namhoc_id`) REFERENCES `namhoc` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hocsinh_ibfk_2` FOREIGN KEY (`lop_id`) REFERENCES `lop` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`khoi_id`) REFERENCES `khoi` (`id`);

--
-- Các ràng buộc cho bảng `tructuan`
--
ALTER TABLE `tructuan`
  ADD CONSTRAINT `tructuan_ibfk_1` FOREIGN KEY (`tuan_id`) REFERENCES `tuan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tructuan_ibfk_2` FOREIGN KEY (`hocsinh_id`) REFERENCES `hocsinh` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tructuan_ibfk_3` FOREIGN KEY (`vipham_id`) REFERENCES `vipham` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tuan`
--
ALTER TABLE `tuan`
  ADD CONSTRAINT `tuan_ibfk_1` FOREIGN KEY (`namhoc_id`) REFERENCES `namhoc` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `vipham`
--
ALTER TABLE `vipham`
  ADD CONSTRAINT `vipham_ibfk_1` FOREIGN KEY (`mucvipham_id`) REFERENCES `mucvipham` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `xephang`
--
ALTER TABLE `xephang`
  ADD CONSTRAINT `xephang_ibfk_1` FOREIGN KEY (`lop_id`) REFERENCES `lop` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `xephang_ibfk_2` FOREIGN KEY (`tructuan_id`) REFERENCES `tuan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `xephang_ibfk_3` FOREIGN KEY (`khoi_id`) REFERENCES `khoi` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
