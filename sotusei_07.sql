-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-03-03 00:10:56
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
-- テーブルの構造 `communicate_table`
--

CREATE TABLE `communicate_table` (
  `id` int(11) NOT NULL,
  `send_member_id` int(11) NOT NULL,
  `text` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `recieve_member_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `communicate_table`
--

INSERT INTO `communicate_table` (`id`, `send_member_id`, `text`, `image`, `recieve_member_id`, `created_at`) VALUES
(5, 21, '元気ですかー', 'upload/20220127134021501533dd3603b413001140dfc609f6ee.jpg', 16, '2022-01-27 21:40:21'),
(6, 21, '元気ですよー', 'upload/20220127134055050199afb758b42bb1ab75a1ec43e061.jpg', 26, '2022-01-27 21:40:55'),
(13, 16, '元気ですよ！', NULL, 21, '2022-02-02 06:01:03'),
(14, 26, '元気かい', NULL, 21, '2022-02-02 06:02:05'),
(15, 26, '服貸して', NULL, 16, '2022-02-02 06:03:20'),
(16, 26, '１１１\r\n', NULL, 16, '2022-02-02 12:26:50'),
(18, 21, '跳ぶぞー', 'upload/202202041857072a9936101c6c7732fb79a59f5d99f2a6.png', 16, '2022-02-05 02:57:07'),
(19, 16, '遊ぼう！', NULL, 21, '2022-02-05 04:23:27'),
(20, 16, '遊ぼう', NULL, 26, '2022-02-05 04:25:51'),
(21, 21, '遊ぶぞ！', NULL, 16, '2022-02-05 08:23:24'),
(22, 21, '１０時に集合！\r\n', NULL, 16, '2022-02-05 09:53:03'),
(23, 16, 'いまから出ます。', NULL, 21, '2022-02-05 09:57:20'),
(24, 16, 'わかりました。', NULL, 16, '2022-02-05 09:58:20'),
(25, 16, 'いつもの場所で', NULL, 21, '2022-02-05 09:59:45'),
(26, 21, '了解', NULL, 16, '2022-02-05 10:01:35'),
(27, 28, '元気ですか', NULL, 16, '2022-02-05 11:37:42'),
(28, 28, '遊ぼう！', NULL, 21, '2022-02-05 11:38:07'),
(29, 21, 'よう！\r\n', NULL, 16, '2022-02-12 10:47:04'),
(30, 21, 'あのさ', NULL, 16, '2022-02-12 10:47:13'),
(31, 21, '遊ぼう', NULL, 16, '2022-02-12 10:47:24'),
(32, 16, 'いいね！\r\n', NULL, 21, '2022-02-12 10:48:44'),
(33, 21, '遊ぼう', NULL, 16, '2022-02-13 10:47:07'),
(34, 21, 'あああ', NULL, 16, '2022-02-13 10:50:59'),
(35, 21, 'あああ', NULL, 16, '2022-02-13 10:52:21'),
(36, 21, 'あああ', NULL, 16, '2022-02-13 11:10:02'),
(37, 21, 'あああ', NULL, 16, '2022-02-13 11:11:37'),
(38, 21, 'あああ', NULL, 16, '2022-02-13 11:27:20'),
(39, 21, 'あああ', NULL, 16, '2022-02-13 11:27:34'),
(40, 21, 'あああ', '', 16, '2022-02-13 11:28:02'),
(41, 21, 'あああ', '', 16, '2022-02-13 11:28:12'),
(42, 21, 'あああ', '', 16, '2022-02-13 11:29:24'),
(43, 21, 'あああ', NULL, 16, '2022-02-13 11:31:35'),
(44, 21, 'あああ', '2022021303415118f20393631a1f3cb57b918c142ba179.', 16, '2022-02-13 11:41:51'),
(45, 21, 'あああ', NULL, 16, '2022-02-13 11:43:16');

-- --------------------------------------------------------

--
-- テーブルの構造 `friend_table`
--

CREATE TABLE `friend_table` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `friend_check` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `friend_table`
--

INSERT INTO `friend_table` (`id`, `member_id`, `friend_id`, `friend_check`) VALUES
(11, 21, 16, 1),
(12, 21, 26, 1),
(20, 16, 21, 1),
(21, 16, 26, 1),
(22, 26, 16, 1),
(23, 26, 21, 1),
(24, 28, 16, 1),
(25, 28, 21, 1),
(26, 28, 26, 1),
(27, 28, 26, 1),
(28, 21, 13, 1),
(38, 16, 13, 1),
(39, 30, 13, 1),
(40, 30, 21, 1);

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
-- テーブルの構造 `medical_table`
--

CREATE TABLE `medical_table` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `kaigonintei_id` int(11) NOT NULL,
  `shougainintei_id` int(11) NOT NULL,
  `caremane` int(11) NOT NULL,
  `caredocter` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- テーブルのデータのダンプ `medical_table`
--

INSERT INTO `medical_table` (`id`, `member_id`, `kaigonintei_id`, `shougainintei_id`, `caremane`, `caredocter`, `created_at`, `update_at`) VALUES
(1, 21, 2, 16, 24, 27, '2022-01-21 01:35:36', '2022-01-22 13:01:03'),
(13, 28, 2, 1, 22, 27, '2022-02-05 11:35:55', '2022-02-05 11:35:55');

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
(13, '田中　新治', '0', '0', 0, 0, '男', '1975-05-27', '東京都港区', '2021-12-23 00:40:11', '2022-02-05 11:40:07'),
(16, '田中　奏大', 'kana', '111111', 0, 0, '男', '2006-01-11', '山口市秋穂二島', '2021-12-23 00:41:35', '2021-12-23 00:41:35'),
(21, '田中　菜々子', 'nata', '777777', 0, 0, '女', '2022-05-19', '佐賀県佐賀市666', '2022-01-10 11:31:15', '2022-01-10 15:58:02'),
(22, '幾田　りら', 'rira', '111111', 1, 0, '0', '0000-00-00', '東京都港区', '2022-01-10 14:10:05', '2022-01-16 14:54:40'),
(23, '松木　玖生', 'matu', '101010', 2, 0, '0', '0000-00-00', '0', '2022-01-10 21:35:10', '2022-01-10 21:35:10'),
(24, '浅川　結', 'tata', '222222', 1, 0, '女', '2022-01-05', '山口市秋穂', '2022-01-15 12:03:58', '2022-01-15 12:04:40'),
(26, '田中　史奈', 'fumi', '222222', 0, 0, '女', '2021-12-29', '山口県防府市高井', '2022-01-15 13:15:19', '2022-01-15 13:16:02'),
(27, '武豊', 'take', '111111', 1, 0, '0', '0000-00-00', '0', '2022-01-16 14:56:00', '2022-01-16 14:56:00'),
(28, '松木　安太郎', 'yasu', '111111', 0, 0, '男', '1999-04-01', '東京都杉並区', '2022-02-05 11:34:18', '2022-02-05 11:35:01'),
(29, '平野　歩夢', 'hira', '111111', 0, 0, '0', '0000-00-00', '0', '2022-02-11 09:40:35', '2022-02-11 09:40:35'),
(30, '田中　順子', 'taju', '111111', 0, 0, '0', '0000-00-00', '0', '2022-02-13 08:16:22', '2022-02-13 08:16:22'),
(31, '中江　有里', 'yuri', '111111', 0, 0, '0', '0000-00-00', '0', '2022-03-02 04:18:42', '2022-03-02 04:18:42');

-- --------------------------------------------------------

--
-- テーブルの構造 `message_relation_table`
--

CREATE TABLE `message_relation_table` (
  `id` int(11) NOT NULL,
  `send_member_id` int(11) NOT NULL,
  `recieve_member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(1, 21, '田中新治', '防府市高井', '父', 833333333, '2022-01-17 00:59:16', '2022-01-17 00:59:16'),
(2, 28, '松木　梅子', '防府市高井', '母', 833333333, '2022-02-05 11:35:36', '2022-02-05 11:35:36');

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

--
-- テーブルのデータのダンプ `supporter_table`
--

INSERT INTO `supporter_table` (`ID`, `member_id`, `support_id`, `belongs_id`, `created_at`, `update_at`) VALUES
(3, 24, 3, 3, '2022-01-21 00:59:47', '2022-01-21 00:59:47'),
(4, 27, 4, 1, '2022-01-21 01:10:44', '2022-01-21 01:10:44'),
(5, 22, 5, 2, '2022-01-21 12:44:26', '2022-02-05 11:39:22');

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
(11, 21, '2022-01-17', 37, 99, 60, 55, 55, 1000, 2),
(12, 28, '2022-02-05', 37, 99, 70, 80, 60, 1000, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `belongs_table`
--
ALTER TABLE `belongs_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `communicate_table`
--
ALTER TABLE `communicate_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `friend_table`
--
ALTER TABLE `friend_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `kaigonintei_table`
--
ALTER TABLE `kaigonintei_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `medical_table`
--
ALTER TABLE `medical_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `member_table`
--
ALTER TABLE `member_table`
  ADD PRIMARY KEY (`member_id`);

--
-- テーブルのインデックス `message_relation_table`
--
ALTER TABLE `message_relation_table`
  ADD PRIMARY KEY (`id`);

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
-- テーブルの AUTO_INCREMENT `communicate_table`
--
ALTER TABLE `communicate_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- テーブルの AUTO_INCREMENT `friend_table`
--
ALTER TABLE `friend_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- テーブルの AUTO_INCREMENT `kaigonintei_table`
--
ALTER TABLE `kaigonintei_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `medical_table`
--
ALTER TABLE `medical_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `member_table`
--
ALTER TABLE `member_table`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- テーブルの AUTO_INCREMENT `message_relation_table`
--
ALTER TABLE `message_relation_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `supporter_table`
--
ALTER TABLE `supporter_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `support_table`
--
ALTER TABLE `support_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `vital_table`
--
ALTER TABLE `vital_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
