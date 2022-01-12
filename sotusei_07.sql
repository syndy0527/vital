-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-12 19:01:17
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `sotusei_07`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `kaigonitei_id`
--

CREATE TABLE `kaigonitei_id` (
  `ID` int(11) NOT NULL,
  `kaiganitei` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `kaigonitei_id`
--

INSERT INTO `kaigonitei_id` (`ID`, `kaiganitei`) VALUES
(1, 'なし'),
(2, '要支援１'),
(3, '要支援２'),
(4, '要介護１'),
(5, '要介護２'),
(6, '要介護３'),
(7, '要介護４'),
(8, '要介護５');

-- --------------------------------------------------------

--
-- テーブルの構造 `kihon_table`
--

CREATE TABLE `kihon_table` (
  `ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `性別` varchar(64) COLLATE utf8_bin NOT NULL,
  `生年月日` date NOT NULL,
  `住所` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `medical_tabal`
--

CREATE TABLE `medical_tabal` (
  `ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `kaigonintei_ID` int(11) NOT NULL,
  `shougainintei_ID` int(11) NOT NULL,
  `caremana` varchar(128) COLLATE utf8_bin NOT NULL,
  `caredocter` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `member_table`
--

CREATE TABLE `member_table` (
  `memberID` int(11) NOT NULL,
  `mbname` varchar(128) COLLATE utf8_bin NOT NULL,
  `loginID` varchar(128) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_dalete` int(1) NOT NULL,
  `seibetu` varchar(64) COLLATE utf8_bin NOT NULL,
  `barthday` date NOT NULL,
  `mbaddress` varchar(128) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `member_table`
--

INSERT INTO `member_table` (`memberID`, `mbname`, `loginID`, `password`, `is_admin`, `is_dalete`, `seibetu`, `barthday`, `mbaddress`, `created_at`, `update_at`) VALUES
(13, '田中　新治', '0', '0', 2, 0, '男', '1975-05-27', '山口県防府市高井６６６', '2021-12-23 00:40:11', '2022-01-11 00:23:37'),
(16, '田中　奏大', '0', '0', 0, 0, '男', '2006-01-11', '山口市秋穂二島', '2021-12-23 00:41:35', '2021-12-23 00:41:35'),
(21, '田中　菜々子', 'nata', '777777', 0, 0, '女', '2022-05-19', '佐賀県佐賀市666', '2022-01-10 11:31:15', '2022-01-10 15:58:02'),
(22, '幾田　りら', 'rira', '111111', 1, 0, '0', '0000-00-00', '0', '2022-01-10 14:10:05', '2022-01-10 14:10:05'),
(23, '松木　玖生', 'matu', '101010', 2, 0, '0', '0000-00-00', '0', '2022-01-10 21:35:10', '2022-01-10 21:35:10');

-- --------------------------------------------------------

--
-- テーブルの構造 `setai_table`
--

CREATE TABLE `setai_table` (
  `ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `setai_ID` int(11) NOT NULL,
  `setaikousei` varchar(128) COLLATE utf8_bin NOT NULL,
  `setaisuu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `sinzoku_table`
--

CREATE TABLE `sinzoku_table` (
  `ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `sinokuname` varchar(64) COLLATE utf8_bin NOT NULL,
  `sinzokuadd` varchar(128) COLLATE utf8_bin NOT NULL,
  `sinzokugara` varchar(64) COLLATE utf8_bin NOT NULL,
  `sinzokutel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `vital_table`
--

CREATE TABLE `vital_table` (
  `ID` int(11) NOT NULL,
  `member_ID` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `taion` int(11) NOT NULL,
  `ketuatu_up` int(11) NOT NULL,
  `ketuatu_down` int(11) NOT NULL,
  `myakuhaku` int(11) NOT NULL,
  `wight` int(11) NOT NULL,
  `suibun` int(11) NOT NULL,
  `fukuyaku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `vital_table`
--

INSERT INTO `vital_table` (`ID`, `member_ID`, `record_date`, `taion`, `ketuatu_up`, `ketuatu_down`, `myakuhaku`, `wight`, `suibun`, `fukuyaku`) VALUES
(6, 16, '2021-12-26', 37, 99, 55, 70, 54, 1000, 1),
(7, 21, '2022-01-13', 36, 70, 55, 70, 55, 1000, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `kaigonitei_id`
--
ALTER TABLE `kaigonitei_id`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `kihon_table`
--
ALTER TABLE `kihon_table`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `medical_tabal`
--
ALTER TABLE `medical_tabal`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `member_table`
--
ALTER TABLE `member_table`
  ADD PRIMARY KEY (`memberID`);

--
-- テーブルのインデックス `setai_table`
--
ALTER TABLE `setai_table`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `sinzoku_table`
--
ALTER TABLE `sinzoku_table`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `vital_table`
--
ALTER TABLE `vital_table`
  ADD PRIMARY KEY (`ID`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `kaigonitei_id`
--
ALTER TABLE `kaigonitei_id`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `kihon_table`
--
ALTER TABLE `kihon_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `medical_tabal`
--
ALTER TABLE `medical_tabal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `member_table`
--
ALTER TABLE `member_table`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- テーブルの AUTO_INCREMENT `setai_table`
--
ALTER TABLE `setai_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `sinzoku_table`
--
ALTER TABLE `sinzoku_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `vital_table`
--
ALTER TABLE `vital_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
