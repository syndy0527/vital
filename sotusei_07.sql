-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-20 15:37:56
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
-- テーブルの構造 `belongs_table`
--

CREATE TABLE `belongs_table` (
  `id` int(11) NOT NULL,
  `belongs_id` int(11) NOT NULL,
  `belongs` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `belongs_table`
--

INSERT INTO `belongs_table` (`id`, `belongs_id`, `belongs`) VALUES
(1, 0, ''),
(2, 1, '田中クリニック'),
(3, 2, 'デイサービス田中'),
(4, 3, '訪問介護たなか');

-- --------------------------------------------------------

--
-- テーブルの構造 `kaigonintei_table`
--

CREATE TABLE `kaigonintei_table` (
  `id` int(11) NOT NULL,
  `kaigonintei_id` int(11) NOT NULL,
  `kaigonintei` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `kaigonintei_table`
--

INSERT INTO `kaigonintei_table` (`id`, `kaigonintei_id`, `kaigonintei`) VALUES
(1, 0, 'なし'),
(2, 1, '要支援１'),
(3, 2, '要支援２'),
(4, 3, '要介護１'),
(5, 4, '要介護２'),
(6, 5, '要介護３'),
(7, 6, '要介護４'),
(8, 7, '要介護５');

-- --------------------------------------------------------

--
-- テーブルの構造 `medical_tabal`
--

CREATE TABLE `medical_tabal` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `kaigonintei_id` int(11) NOT NULL,
  `shougainintei_id` int(11) NOT NULL,
  `caremana` varchar(128) COLLATE utf8_bin NOT NULL,
  `caredocter` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `member_table`
--

CREATE TABLE `member_table` (
  `member_id` int(11) NOT NULL,
  `mbname` varchar(128) COLLATE utf8_bin NOT NULL,
  `login_id` varchar(128) COLLATE utf8_bin NOT NULL,
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

INSERT INTO `member_table` (`member_id`, `mbname`, `login_id`, `password`, `is_admin`, `is_dalete`, `seibetu`, `barthday`, `mbaddress`, `created_at`, `update_at`) VALUES
(13, '田中　新治', '0', '0', 2, 0, '男', '1975-05-27', '山口県防府市高井６６６', '2021-12-23 00:40:11', '2022-01-11 00:23:37'),
(16, '田中　奏大', '0', '0', 0, 0, '男', '2006-01-11', '山口市秋穂二島', '2021-12-23 00:41:35', '2021-12-23 00:41:35'),
(21, '田中　菜々子', 'nata', '777777', 0, 0, '女', '2022-05-19', '佐賀県佐賀市666', '2022-01-10 11:31:15', '2022-01-10 15:58:02'),
(22, '幾田　りら', 'rira', '111111', 1, 0, '0', '0000-00-00', '東京都港区', '2022-01-10 14:10:05', '2022-01-16 14:54:40'),
(23, '松木　玖生', 'matu', '101010', 2, 0, '0', '0000-00-00', '0', '2022-01-10 21:35:10', '2022-01-10 21:35:10'),
(24, '浅川　結', 'tata', '222222', 0, 0, '女', '2022-01-05', '山口市秋穂', '2022-01-15 12:03:58', '2022-01-15 12:04:40'),
(26, '田中　史奈', 'nana', '222222', 0, 0, '女', '2021-12-29', '山口県防府市高井', '2022-01-15 13:15:19', '2022-01-15 13:16:02'),
(27, '武豊', 'take', '111111', 0, 0, '0', '0000-00-00', '0', '2022-01-16 14:56:00', '2022-01-16 14:56:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `setai_table`
--

CREATE TABLE `setai_table` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `setai_id` int(11) NOT NULL,
  `setaikousei` varchar(128) COLLATE utf8_bin NOT NULL,
  `setaisuu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `shougai_table`
--

CREATE TABLE `shougai_table` (
  `id` int(11) NOT NULL,
  `shougai_id` int(11) NOT NULL,
  `shougai` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `shougai_table`
--

INSERT INTO `shougai_table` (`id`, `shougai_id`, `shougai`) VALUES
(1, 0, 'なし'),
(2, 1, '視覚障がい'),
(3, 2, '聴覚障がい'),
(4, 3, '肢体不自由'),
(5, 4, '肝臓機能障がい'),
(6, 5, '小腸機能障がい'),
(7, 6, '膀胱・直腸機能障がい'),
(8, 7, '平行機能障がい'),
(9, 8, '言語機能障がい'),
(10, 9, 'そしゃく機能障がい'),
(11, 10, '呼吸器機能障がい'),
(12, 11, '心臓機能障がい'),
(13, 12, '腎臓機能障がい'),
(14, 13, '知的障がい'),
(15, 14, '精神障がい'),
(16, 15, '発達障がい'),
(17, 16, '難病');

-- --------------------------------------------------------

--
-- テーブルの構造 `sinzoku_table`
--

CREATE TABLE `sinzoku_table` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `sinzokuname` varchar(64) COLLATE utf8_bin NOT NULL,
  `sinzokuadd` varchar(128) COLLATE utf8_bin NOT NULL,
  `sinzokugara` varchar(64) COLLATE utf8_bin NOT NULL,
  `sinzokutel` int(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `sinzoku_table`
--

INSERT INTO `sinzoku_table` (`id`, `member_id`, `sinzokuname`, `sinzokuadd`, `sinzokugara`, `sinzokutel`, `created_at`, `update_at`) VALUES
(1, 21, '田中新治', '防府市高井', '父', 833333333, '2022-01-17 00:59:16', '2022-01-17 00:59:16');

-- --------------------------------------------------------

--
-- テーブルの構造 `supporter_table`
--

CREATE TABLE `supporter_table` (
  `ID` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `belongs_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `support_table`
--

CREATE TABLE `support_table` (
  `id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `support` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `support_table`
--

INSERT INTO `support_table` (`id`, `support_id`, `support`) VALUES
(1, 1, '自治会長'),
(2, 2, '民生委員'),
(3, 3, 'ケアマネジャー'),
(4, 4, 'かかりつけ医師'),
(5, 0, ''),
(6, 5, '福祉員');

-- --------------------------------------------------------

--
-- テーブルの構造 `vital_table`
--

CREATE TABLE `vital_table` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
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

INSERT INTO `vital_table` (`id`, `member_id`, `record_date`, `taion`, `ketuatu_up`, `ketuatu_down`, `myakuhaku`, `wight`, `suibun`, `fukuyaku`) VALUES
(6, 16, '2021-12-26', 37, 99, 55, 70, 54, 1000, 1),
(7, 21, '2022-01-13', 36, 70, 55, 70, 55, 1000, 1),
(8, 24, '2022-01-15', 35, 77, 44, 79, 60, 1000, 1),
(9, 25, '2022-01-15', 36, 70, 50, 50, 70, 1000, 1),
(10, 21, '2022-01-16', 36, 98, 70, 65, 55, 1000, 1),
(11, 21, '2022-01-17', 37, 99, 60, 55, 55, 1000, 2);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `belongs_table`
--
ALTER TABLE `belongs_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `kaigonintei_table`
--
ALTER TABLE `kaigonintei_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `medical_tabal`
--
ALTER TABLE `medical_tabal`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `member_table`
--
ALTER TABLE `member_table`
  ADD PRIMARY KEY (`member_id`);

--
-- テーブルのインデックス `setai_table`
--
ALTER TABLE `setai_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `shougai_table`
--
ALTER TABLE `shougai_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `sinzoku_table`
--
ALTER TABLE `sinzoku_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `supporter_table`
--
ALTER TABLE `supporter_table`
  ADD PRIMARY KEY (`ID`);

--
-- テーブルのインデックス `support_table`
--
ALTER TABLE `support_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `vital_table`
--
ALTER TABLE `vital_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `belongs_table`
--
ALTER TABLE `belongs_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `kaigonintei_table`
--
ALTER TABLE `kaigonintei_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `medical_tabal`
--
ALTER TABLE `medical_tabal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `member_table`
--
ALTER TABLE `member_table`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- テーブルの AUTO_INCREMENT `setai_table`
--
ALTER TABLE `setai_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `shougai_table`
--
ALTER TABLE `shougai_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `sinzoku_table`
--
ALTER TABLE `sinzoku_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `supporter_table`
--
ALTER TABLE `supporter_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `support_table`
--
ALTER TABLE `support_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `vital_table`
--
ALTER TABLE `vital_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
