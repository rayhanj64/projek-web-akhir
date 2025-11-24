-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Nov 24, 2025 at 10:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_health_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id_user` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `berat` decimal(5,2) NOT NULL,
  `sistole` int(11) NOT NULL,
  `diastole` int(11) NOT NULL,
  `gula_darah` int(11) NOT NULL,
  `detak_jantung` int(11) NOT NULL COMMENT 'bpm',
  `total_kolesterol` int(11) NOT NULL COMMENT 'mg/dL',
  `hdl_kolesterol` int(11) NOT NULL COMMENT 'mg/dL',
  `catatan_harian` text DEFAULT NULL,
  `id_catatan` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id_user`, `created_at`, `berat`, `sistole`, `diastole`, `gula_darah`, `detak_jantung`, `total_kolesterol`, `hdl_kolesterol`, `catatan_harian`, `id_catatan`) VALUES
(1, '2025-11-09', 66.00, 120, 80, 50, 80, 194, 70, NULL, 1),
(1, '2025-11-01', 77.00, 111, 77, 54, 91, 180, 80, 'makzulkan fufufafa', 2),
(2, '2018-11-08', 124.00, 150, 100, 55, 58, 210, 53, 'yo ndak tau kok tanya saya', 3),
(2, '2021-11-11', 111.00, 121, 85, 54, 44, 187, 70, 'hey ant tech ant tech ahh sing', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tinggi` decimal(5,2) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `rokok_vape` enum('Ya','Tidak') NOT NULL,
  `obat_hipertensi` enum('Ya','Tidak') NOT NULL COMMENT 'buat FRS',
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `tgl_lahir`, `tinggi`, `gender`, `rokok_vape`, `obat_hipertensi`, `role`, `aktif`) VALUES
(1, 'usernameA', '1', 'budi', '1975-12-31', 155.00, 'Laki-laki', 'Ya', 'Tidak', 'user', 1),
(2, 'usernameB', '2', 'siti', '1995-07-18', 155.22, 'Perempuan', 'Tidak', 'Ya', 'user', 1),
(3, 'wujud_aseli_mimin', 'admin', 'rusdi', '2016-11-22', 155.93, 'Laki-laki', 'Ya', 'Ya', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
