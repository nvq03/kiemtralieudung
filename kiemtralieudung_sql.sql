-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 06, 2023 lúc 05:07 PM
-- Phiên bản máy phục vụ: 10.1.37-MariaDB
-- Phiên bản PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `kiemtralieudung`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `doctor`
--

INSERT INTO `doctor` (`id`, `name`) VALUES
(46, 'Nguyá»…n QuÃ½'),
(47, 'LÃª HoÃ ng VÅ©'),
(48, 'Tráº§n NguyÃªn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dosemax` float DEFAULT NULL,
  `dosemin` float DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `dosemax`, `dosemin`, `frequency`) VALUES
(10, 'Paradol Extra', 120, 20, 4),
(11, 'Biolactomin', 200, 20, 10),
(12, 'Thuá»‘c An Tháº§n', 300, 30, 3),
(13, 'Thuá»‘c Giáº£m Äau', 100, 10, 2),
(14, 'Dexitol', 500, 30, 5),
(15, 'Furaca', 100, 10, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `patient`
--

INSERT INTO `patient` (`id`, `name`) VALUES
(41, 'HoÃ ng Háº£i'),
(42, 'Cao Anh'),
(43, 'TrÆ°Æ¡ng Nhi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `iddoctor` int(11) DEFAULT NULL,
  `idpatient` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `prescription`
--

INSERT INTO `prescription` (`id`, `iddoctor`, `idpatient`, `date`) VALUES
(38, 46, 41, '2023-12-06'),
(39, 47, 42, '2023-12-06'),
(40, 48, 43, '2023-12-06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `prescription_detail`
--

CREATE TABLE `prescription_detail` (
  `id` int(11) NOT NULL,
  `idprescription` int(11) DEFAULT NULL,
  `idmedicine` int(11) DEFAULT NULL,
  `dose` float DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `prescription_detail`
--

INSERT INTO `prescription_detail` (`id`, `idprescription`, `idmedicine`, `dose`, `frequency`, `quantity`) VALUES
(64, 38, 10, 100, 3, 100),
(65, 39, 14, 300, 3, 20),
(66, 40, 12, 200, 3, 20),
(67, 40, 12, 250, 3, 30);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prescription_doctor` (`iddoctor`),
  ADD KEY `fk_prescription_patient` (`idpatient`);

--
-- Chỉ mục cho bảng `prescription_detail`
--
ALTER TABLE `prescription_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prescription_detail_prescription` (`idprescription`),
  ADD KEY `fk_prescription_detail_medicine` (`idmedicine`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `prescription_detail`
--
ALTER TABLE `prescription_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `fk_prescription_doctor` FOREIGN KEY (`iddoctor`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `fk_prescription_patient` FOREIGN KEY (`idpatient`) REFERENCES `patient` (`id`);

--
-- Các ràng buộc cho bảng `prescription_detail`
--
ALTER TABLE `prescription_detail`
  ADD CONSTRAINT `fk_prescription_detail_medicine` FOREIGN KEY (`idmedicine`) REFERENCES `medicine` (`id`),
  ADD CONSTRAINT `fk_prescription_detail_prescription` FOREIGN KEY (`idprescription`) REFERENCES `prescription` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
