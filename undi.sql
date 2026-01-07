-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2026 年 01 月 07 日 13:24
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `undi`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `idadmin` varchar(3) NOT NULL,
  `password` varchar(8) DEFAULT NULL,
  `namaadmin` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`idadmin`, `password`, `namaadmin`) VALUES
('A00', 'admin123', 'Fatimah'),
('A01', '123', 'Mat');

-- --------------------------------------------------------

--
-- 資料表結構 `calon`
--

CREATE TABLE `calon` (
  `idcalon` varchar(3) NOT NULL,
  `namacalon` varchar(20) DEFAULT NULL,
  `gambar` varchar(20) DEFAULT NULL,
  `harga` double(6,2) DEFAULT NULL,
  `idadmin` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `calon`
--

INSERT INTO `calon` (`idcalon`, `namacalon`, `gambar`, `harga`, `idadmin`) VALUES
('C00', 'Nothing', 'C00.png', 1000.00, 'A00'),
('C01', 'Ali Bin Abu', 'C01.png', 1000.00, 'A00'),
('C02', 'Joshua', 'C02.png', 5000.00, 'A00'),
('C03', 'Peter', 'C03.png', 1000.00, 'A00'),
('C04', 'Simon', 'C04.png', 5000.00, 'A00');

-- --------------------------------------------------------

--
-- 資料表結構 `pengundi`
--

CREATE TABLE `pengundi` (
  `idpengundi` varchar(4) NOT NULL,
  `password` varchar(8) DEFAULT NULL,
  `namapengundi` varchar(30) DEFAULT NULL,
  `idcalon` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `pengundi`
--

INSERT INTO `pengundi` (`idpengundi`, `password`, `namapengundi`, `idcalon`) VALUES
('U00', '1234', 'Fiona', 'C02'),
('U001', '123', 'Grace', 'C02'),
('U01', '12345', 'Fatimah', 'C01'),
('U881', '123', 'Dominic', 'C04'),
('U90', '123', 'City', 'C01'),
('U91', '123', 'Civic', 'C01'),
('U92', '123', 'BRV', 'C01'),
('U93', '123', 'CRV', 'C01'),
('U94', '123', 'CRZ', 'C01'),
('U95', '123', 'Accord', 'C02');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- 資料表索引 `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`idcalon`),
  ADD KEY `calon_admin` (`idadmin`);

--
-- 資料表索引 `pengundi`
--
ALTER TABLE `pengundi`
  ADD PRIMARY KEY (`idpengundi`),
  ADD KEY `idcalon` (`idcalon`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `calon`
--
ALTER TABLE `calon`
  ADD CONSTRAINT `calon_admin` FOREIGN KEY (`idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `pengundi`
--
ALTER TABLE `pengundi`
  ADD CONSTRAINT `pengundi_calon` FOREIGN KEY (`idcalon`) REFERENCES `calon` (`idcalon`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
