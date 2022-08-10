-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2022 at 01:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_futsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `klien_id` int(11) NOT NULL,
  `klien_nama` varchar(255) NOT NULL DEFAULT '',
  `klien_hp` varchar(255) NOT NULL DEFAULT '',
  `klien_email` varchar(255) NOT NULL DEFAULT '',
  `klien_pt` varchar(255) NOT NULL DEFAULT '',
  `klien_aktif` int(11) NOT NULL DEFAULT 1,
  `klien_ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `klien_tsa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`klien_id`, `klien_nama`, `klien_hp`, `klien_email`, `klien_pt`, `klien_aktif`, `klien_ts`, `klien_tsa`) VALUES
(1, 'Jajang Nurjaman', '087812979164', 'jajangnurjaman@gmail.com', 'PT. PERSIB', 1, '2022-08-06 13:54:19', '2022-08-07 05:56:17'),
(2, 'Samsul Arifin', '0829292929', 'samsul@gmail.com', '', 1, '2022-08-07 08:42:12', '2022-08-07 08:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `lapangan_id` int(11) NOT NULL,
  `lapangan_nama` varchar(255) NOT NULL DEFAULT '',
  `lapangan_biaya_sewa` decimal(16,2) NOT NULL DEFAULT 0.00,
  `lapangan_aktif` int(11) NOT NULL DEFAULT 1,
  `lapangan_ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `lapangan_tsa` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `lapangan_jam_buka` varchar(255) NOT NULL DEFAULT '',
  `lapangan_jam_tutup` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`lapangan_id`, `lapangan_nama`, `lapangan_biaya_sewa`, `lapangan_aktif`, `lapangan_ts`, `lapangan_tsa`, `lapangan_jam_buka`, `lapangan_jam_tutup`) VALUES
(1, 'Lapangan 1', '100000.00', 1, '2022-08-06 06:23:44', '2022-08-06 13:32:40', '07:00', '21:00'),
(2, 'Lapangan 2', '100000.00', 1, '2022-08-06 06:25:00', '0000-00-00 00:00:00', '07:00', '21:00'),
(3, 'Lapangan 3', '100000.00', 1, '2022-08-06 07:45:37', '0000-00-00 00:00:00', '07:00', '21:00');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `sewa_id` int(11) NOT NULL,
  `lapangan_id` int(11) NOT NULL DEFAULT 0,
  `klien_id` int(11) NOT NULL DEFAULT 0,
  `sewa_tgl` varchar(255) NOT NULL DEFAULT '',
  `sewa_aktif` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sewa_detail`
--

CREATE TABLE `sewa_detail` (
  `sewa_detail_id` int(11) NOT NULL,
  `sewa_id` int(11) NOT NULL DEFAULT 0,
  `sewa_detail_jam` varchar(255) NOT NULL DEFAULT '',
  `sewa_detail_aktif` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_password`) VALUES
(1, 'admin', 'n4rut0uc1h4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`klien_id`),
  ADD UNIQUE KEY `klien_hp` (`klien_hp`) USING HASH;

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`lapangan_id`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`sewa_id`);

--
-- Indexes for table `sewa_detail`
--
ALTER TABLE `sewa_detail`
  ADD PRIMARY KEY (`sewa_detail_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `klien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `lapangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `sewa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sewa_detail`
--
ALTER TABLE `sewa_detail`
  MODIFY `sewa_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
