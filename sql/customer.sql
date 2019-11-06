-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019-11-06 16:49:40
-- 伺服器版本： 10.4.8-MariaDB
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `jhongcorn`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `Customer_Id` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Title` enum('先生','小姐','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `First_Name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Last_Name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Addr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `picture` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OAuth` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OAuth_Id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`Customer_Id`, `Name`, `Title`, `First_Name`, `Last_Name`, `Phone`, `Email`, `password`, `Addr`, `birthday`, `picture`, `OAuth`, `OAuth_Id`) VALUES
(13, '鍾育民', '先生', '育民', '鍾', '0989264810', 'a0423955587@gmail.com', '', '', '2019-10-16', 'https://lh3.googleusercontent.com/a-/AAuE7mAtmSPqTj13glb2R2rQTJBTcm_dlY1k6e-natJVA_s', 'google', '108720019983307745004'),
(20, 'aa', '先生', 'a', 'a', '0989264810', 'a04239555871@gmail.com', '!Q111111', '南投縣名間鄉弓鞋巷', '2019-10-09', '', 'this', '191028210091438'),
(21, 'bbbbbb', '先生', 'bbb', 'bbb', '0989264840', 'a236559@gmail.com', '!Q111111', '苗栗縣造橋鄉小鼓坑', '2019-10-08', '', 'this', '1910292067690173'),
(22, 'zxczxczxcxzc', '先生', 'zxcxzc', 'zxczxc', '0998989898', 'jkjk@gmail.com', '!Q111111', '新竹市北區中華路３段', '2019-10-09', '', 'this', '1910291413561250'),
(23, 'dfgfdgfdgdfg', '先生', 'fdgdfg', 'dfgfdg', '0989264810', 'a04233@gmail.com', '!Q444444', '新竹市北區中華路３段1巷1弄1樓1室', '2019-10-09', '', 'this', '1910291407632794'),
(24, 'asdasdaadasd', '先生', 'aadasd', 'asdasd', '0989264810', 'a04231113@gmail.com', '!Q111111', '新竹市北區中華路３段1巷1弄1樓1室', '2019-10-17', '', 'this', '1910291401020724'),
(26, '鍾育民', '先生', '育民', '鍾', '', 'a0423955587@gmail.com', '', '', '0000-00-00', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3080128792002202&height=200&width=200&ext=1575646817&hash=AeSLcatYFeX9SO-B', 'facebook', '3080128792002202'),
(27, '鍾育民', '先生', '育民', '鍾', '0919555645', 'jhongcorn@gmail.com', 'q!111111', '臺中市太平區新興路35巷22弄4樓', '1987-11-27', '', 'this', '191106624465763');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Id`),
  ADD UNIQUE KEY `OAuth_Id` (`OAuth_Id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
