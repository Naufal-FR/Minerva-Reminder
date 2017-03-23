-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2017 at 10:25 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id944815_minerva_storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `full_name` varchar(35) NOT NULL,
  `division` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `full_name`, `division`) VALUES
(1, 'Richie', 'Richie Richardus Tokan', 'Pemimpin Umum'),
(12, 'naufal', 'Naufal Faza Rusdi', 'Editorial'),
(2, 'dayinta', 'Dayinta Warih W', 'Pemimpin Perusahaan'),
(9, 'wahyu', 'Wahyu Mega', 'KWU'),
(8, 'randa', 'Randa Alverdian Binsar Tambunan', 'Humas'),
(4, 'dhena', 'Dhena Kamalia Fu\'adi', 'Admin'),
(10, 'firdaus', 'Firdaus Rahman', 'Reportase'),
(3, 'primarizki', 'Dimas Bhayu Primarizki', 'Pemimpin Redaksi'),
(22, 'Rasepta', 'Rahman Arul Septiawan', 'Reportase'),
(13, 'rhevitta', 'Rhevitta Widyaning P', 'KDP'),
(11, 'amalia', 'Amalia K A', 'Sastra'),
(14, 'nimah', 'Ni\'mah F', 'Multimedia'),
(7, 'irma', 'Irma Ramadanti Fitriyani', 'PSDM'),
(17, 'mashuda', 'Mashuda Bahtiar', 'Humas'),
(31, 'nadzir', 'Muhammad Nadzir', 'Multimedia'),
(30, 'indah', 'Indah Puspitasari', 'KDP'),
(6, 'seila', 'Seila Riska Faricha Daerina', 'Bendahara Umum'),
(27, 'jengar', 'Ajeng Ardhia Arya Kusuma Putri', 'Sastra'),
(25, 'Enggar', 'Ani Enggarwati', 'Reportase'),
(32, 'ghasa', 'Ghasa Faraasyatul \'Alam', 'Multimedia'),
(23, 'cindy', 'Cindy Inka Sari', 'Reportase'),
(18, 'febriana', 'Febriana Ranta Lidya', 'Humas'),
(33, 'hanif', 'Hanif Irfan Syah', 'Multimedia'),
(26, 'hanifa', 'Hanifa Dantya Kurniasari', 'Sastra'),
(29, 'fatimah', 'Fatimah Az Zahra', 'Editorial'),
(5, 'nabilalubna', 'Nabila Lubna Irbakanisa', 'Reportase'),
(16, 'nafiani', 'Nafiani', 'PSDM'),
(19, 'nelli', 'Nelli Nur Rahma', 'KWU'),
(24, 'nian', 'Nian Dini Arti', 'Reportase'),
(20, 'Putri', 'Putri Harnis', 'KWU'),
(28, 'regita', 'Regita Yustania Esyaganitha', 'Editorial'),
(21, 'suryaniagstn', 'Suryani Agustin', 'KWU'),
(15, 'Yuni', 'Tri Rahayuni', 'PSDM');

-- --------------------------------------------------------

--
-- Table structure for table `BOT_FUNCTION`
--

CREATE TABLE `BOT_FUNCTION` (
  `FUNCTION_ID` int(11) NOT NULL,
  `FUNCTION_NAME` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DESCRIPTION` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `BOT_FUNCTION`
--

INSERT INTO `BOT_FUNCTION` (`FUNCTION_ID`, `FUNCTION_NAME`, `DESCRIPTION`) VALUES
(1, 'ping', 'Notified every acc who link their\'s to specific ping keyword');

-- --------------------------------------------------------

--
-- Table structure for table `GROUP_FUNCTION`
--

CREATE TABLE `GROUP_FUNCTION` (
  `GF_ID` int(11) NOT NULL,
  `UNIQUE_ID` int(11) DEFAULT NULL,
  `ID_FUNCTION` int(11) DEFAULT NULL,
  `KEYWORD` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `GROUP_FUNCTION`
--

INSERT INTO `GROUP_FUNCTION` (`GF_ID`, `UNIQUE_ID`, `ID_FUNCTION`, `KEYWORD`, `CREATED_ON`) VALUES
(1012, 1002, 1, 'humas', '2017-03-07 12:10:39'),
(1013, 1002, 1, 'editor', '2017-03-07 12:10:39'),
(1014, 1002, 1, 'reporter', '2017-03-07 12:10:39'),
(1015, 1002, 1, 'sastra', '2017-03-07 12:10:39'),
(1017, 1002, 1, 'kdp', '2017-03-07 12:10:39'),
(1018, 1002, 1, 'mm', '2017-03-07 12:10:39'),
(1019, 1002, 1, 'redaksi', '2017-03-07 12:10:39'),
(1020, 1004, 1, 'Hallooo', '2017-03-07 12:10:39'),
(1021, 1004, 1, 'reporter', '2017-03-07 12:10:39'),
(1049, 1002, 1, 'pimred', '2017-03-10 00:05:41'),
(1056, 1018, 1, 'share', '2017-03-11 22:25:58'),
(1057, 1018, 1, 'Mons', '2017-03-21 22:57:37'),
(1058, 1018, 1, 'editor', '2017-03-21 00:41:40'),
(1059, 1018, 1, 'ed', '2017-03-23 08:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `GROUP_INFORMATION`
--

CREATE TABLE `GROUP_INFORMATION` (
  `UNIQUE_ID` int(11) NOT NULL,
  `GROUP_ID` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASS` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GROUP_DESCRIPTION` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `GROUP_INFORMATION`
--

INSERT INTO `GROUP_INFORMATION` (`UNIQUE_ID`, `GROUP_ID`, `PASS`, `GROUP_DESCRIPTION`, `CREATED_ON`) VALUES
(1002, 'C7103388573d2a713748de24a7396a662', '12345', 'Redaksi Display 2017', '2017-03-06 03:41:06'),
(1004, 'C645d37dfa46a5a9555fb881f00badc9a', '12345', 'Reporter Display 2017', '2017-03-06 04:02:53'),
(1007, 'C1d48b262a2595cda5662cb62986ece40', '12345', 'Editor Display 2017', '2017-03-06 03:41:06'),
(1018, 'Cb66cda35473c6e6773255b2eccfe0219', '54321', 'Group Name', '2017-03-22 02:12:47'),
(1019, 'Cd155ae64ec5c5d0f594bdee406188056', '12345', 'BCR48', '2017-03-13 01:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_piket`
--

CREATE TABLE `jadwal_piket` (
  `id_jadwal_piket` int(11) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `jam` varchar(100) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_piket`
--

INSERT INTO `jadwal_piket` (`id_jadwal_piket`, `hari`, `jam`, `kuota`) VALUES
(1, 'Senin', '09.30 - 11.59', 8),
(2, 'Senin', '12.50 - 15.19', 8),
(3, 'Senin', '15.20 - 17.49', 7),
(4, 'Selasa', '09.30 - 11.59', 8),
(5, 'Selasa', '12.50 - 15.19', 8),
(6, 'Selasa', '15.20 - 17.49', 4),
(7, 'Rabu', '09.30 - 11.59', 8),
(8, 'Rabu', '12.50 - 15.19', 8),
(9, 'Rabu', '15.20 - 17.49', 7),
(10, 'Kamis', '09.30 - 11.59', 8),
(11, 'Kamis', '12.50 - 15.19', 8),
(12, 'Kamis', '15.20 - 17.49', 7),
(13, 'Jumat', '09.30 - 11.59', 6),
(14, 'Jumat', '12.50 - 15.19', 6),
(15, 'Jumat', '15.20 - 17.49', 4);

-- --------------------------------------------------------

--
-- Table structure for table `LINKED_ACC`
--

CREATE TABLE `LINKED_ACC` (
  `LINKED_ID` int(11) NOT NULL,
  `PERSONAL_ID` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GF_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `LINKED_ACC`
--

INSERT INTO `LINKED_ACC` (`LINKED_ID`, `PERSONAL_ID`, `GF_ID`) VALUES
(1015, 'U7d6114fe03ac9c6d8245f82f624e069a', 1012),
(1016, 'Ua53e460a4fd50e714f5a8964d38f6ef4', 1014),
(1018, 'Ucf2626aaa00c39f57408667151b4e753', 1015),
(1020, 'Uc7871461db4f5476b1d83f71ee559bf0', 1013),
(1021, 'U924c47eb283db93bd16ee3d552fb669b', 1013),
(1022, 'U39e030be571450d4c2a3f3ebc5ab7f8d', 1018),
(1023, 'Uc7871461db4f5476b1d83f71ee559bf0', 1019),
(1024, 'U39e030be571450d4c2a3f3ebc5ab7f8d', 1019),
(1025, 'Ue07feca744876f67a3190ea6849fad5f', 1018),
(1026, 'U07a08bd4f64122bf1fd5690c83e254d4', 1018),
(1027, 'U07a08bd4f64122bf1fd5690c83e254d4', 1019),
(1028, 'U56f5da3c3fc62bd4ae08162278b679c4', 1015),
(1029, 'U985ead53afea60eac52a992b23c58768', 1015),
(1030, 'U97f5e6272749378ac7e8da558390be54', 1017),
(1031, 'U91f813fde918ed03f48d110bc0f51392', 1014),
(1032, 'U985ead53afea60eac52a992b23c58768', 1019),
(1034, 'Ue575d4135b290e662d0d765aed66aa86', 1019),
(1035, 'U56f5da3c3fc62bd4ae08162278b679c4', 1019),
(1038, 'Ucf2626aaa00c39f57408667151b4e753', 1019),
(1041, 'Ue0971df312ab49f48401eec0ea57e6d3', 1019),
(1042, 'Ua53e460a4fd50e714f5a8964d38f6ef4', 1019),
(1044, 'U72ce6715309af2dc787691578fbd1d53', 1017),
(1045, 'U72ce6715309af2dc787691578fbd1d53', 1019),
(1059, 'U6604f6315e49a2390862516b3df39939', 1013),
(1066, 'U7d6114fe03ac9c6d8245f82f624e069a', 1019),
(1067, 'U6604f6315e49a2390862516b3df39939', 1019),
(1068, 'Ue0971df312ab49f48401eec0ea57e6d3', 1049),
(1074, 'Uc7871461db4f5476b1d83f71ee559bf0', 1059);

-- --------------------------------------------------------

--
-- Table structure for table `piket`
--

CREATE TABLE `piket` (
  `id_piket` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_jadwal_piket` int(11) NOT NULL,
  `day` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piket`
--

INSERT INTO `piket` (`id_piket`, `id_akun`, `id_jadwal_piket`, `day`) VALUES
(374, 8, 7, 3),
(373, 8, 14, 5),
(372, 5, 13, 5),
(358, 18, 13, 5),
(357, 18, 11, 4),
(356, 17, 10, 4),
(371, 23, 11, 4),
(369, 6, 10, 4),
(368, 24, 15, 5),
(367, 24, 6, 2),
(366, 20, 2, 1),
(365, 33, 13, 5),
(362, 27, 12, 4),
(361, 17, 10, 4),
(360, 9, 12, 4),
(359, 9, 1, 1),
(364, 33, 11, 4),
(370, 6, 3, 1),
(342, 22, 10, 4),
(341, 22, 8, 3),
(339, 11, 8, 3),
(340, 4, 4, 2),
(337, 11, 5, 2),
(336, 4, 8, 3),
(335, 23, 1, 1),
(334, 12, 1, 1),
(333, 12, 9, 3),
(332, 20, 4, 2),
(330, 28, 4, 2),
(329, 28, 1, 1),
(328, 7, 9, 3),
(327, 7, 3, 1),
(326, 16, 12, 4),
(325, 16, 3, 1),
(324, 31, 3, 1),
(322, 26, 11, 4),
(321, 26, 8, 3),
(320, 3, 11, 4),
(319, 3, 1, 1),
(318, 5, 2, 1),
(317, 21, 1, 1),
(316, 21, 4, 2),
(315, 14, 8, 3),
(314, 14, 5, 2),
(313, 13, 8, 3),
(312, 13, 5, 2),
(311, 2, 8, 3),
(310, 2, 5, 2),
(309, 19, 5, 2),
(308, 19, 2, 1),
(307, 32, 14, 5),
(306, 30, 14, 5),
(305, 32, 2, 1),
(304, 30, 2, 1),
(303, 10, 9, 3),
(302, 29, 5, 2),
(301, 10, 7, 3),
(300, 29, 2, 1),
(299, 25, 10, 4),
(298, 25, 7, 3),
(297, 1, 4, 2),
(323, 31, 12, 4),
(295, 1, 7, 3),
(294, 15, 9, 3),
(293, 15, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `BOT_FUNCTION`
--
ALTER TABLE `BOT_FUNCTION`
  ADD PRIMARY KEY (`FUNCTION_ID`);

--
-- Indexes for table `GROUP_FUNCTION`
--
ALTER TABLE `GROUP_FUNCTION`
  ADD PRIMARY KEY (`GF_ID`),
  ADD KEY `FKGI` (`UNIQUE_ID`),
  ADD KEY `FKBF` (`ID_FUNCTION`);

--
-- Indexes for table `GROUP_INFORMATION`
--
ALTER TABLE `GROUP_INFORMATION`
  ADD PRIMARY KEY (`UNIQUE_ID`);

--
-- Indexes for table `jadwal_piket`
--
ALTER TABLE `jadwal_piket`
  ADD PRIMARY KEY (`id_jadwal_piket`);

--
-- Indexes for table `LINKED_ACC`
--
ALTER TABLE `LINKED_ACC`
  ADD PRIMARY KEY (`LINKED_ID`),
  ADD KEY `FKGF` (`GF_ID`);

--
-- Indexes for table `piket`
--
ALTER TABLE `piket`
  ADD PRIMARY KEY (`id_piket`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_jadwal_piket` (`id_jadwal_piket`),
  ADD KEY `id_akun_2` (`id_akun`),
  ADD KEY `id_jadwal_piket_2` (`id_jadwal_piket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `BOT_FUNCTION`
--
ALTER TABLE `BOT_FUNCTION`
  MODIFY `FUNCTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `GROUP_FUNCTION`
--
ALTER TABLE `GROUP_FUNCTION`
  MODIFY `GF_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1060;
--
-- AUTO_INCREMENT for table `GROUP_INFORMATION`
--
ALTER TABLE `GROUP_INFORMATION`
  MODIFY `UNIQUE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1020;
--
-- AUTO_INCREMENT for table `jadwal_piket`
--
ALTER TABLE `jadwal_piket`
  MODIFY `id_jadwal_piket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `LINKED_ACC`
--
ALTER TABLE `LINKED_ACC`
  MODIFY `LINKED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1075;
--
-- AUTO_INCREMENT for table `piket`
--
ALTER TABLE `piket`
  MODIFY `id_piket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `GROUP_FUNCTION`
--
ALTER TABLE `GROUP_FUNCTION`
  ADD CONSTRAINT `FKBF` FOREIGN KEY (`ID_FUNCTION`) REFERENCES `BOT_FUNCTION` (`FUNCTION_ID`),
  ADD CONSTRAINT `FKGI` FOREIGN KEY (`UNIQUE_ID`) REFERENCES `GROUP_INFORMATION` (`UNIQUE_ID`);

--
-- Constraints for table `LINKED_ACC`
--
ALTER TABLE `LINKED_ACC`
  ADD CONSTRAINT `FKGF` FOREIGN KEY (`GF_ID`) REFERENCES `GROUP_FUNCTION` (`GF_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
