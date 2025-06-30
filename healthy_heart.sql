-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2025 at 07:18 AM
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
-- Database: `healthy_heart`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_cek`
--

CREATE TABLE `hasil_cek` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jenis_cek` varchar(50) DEFAULT NULL,
  `hasil` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_cek`
--

INSERT INTO `hasil_cek` (`id`, `user_id`, `jenis_cek`, `hasil`, `tanggal`) VALUES
(1, 1, 'BMI', 'BMI: 18.86 (Normal)', '2025-06-24 21:27:15'),
(2, 1, 'BMI', 'BMI Anda: 816.7 (Obesitas)', '2025-06-25 22:10:04'),
(3, 1, 'BMI', 'BMI Anda: 18.9 (Normal)', '2025-06-25 22:10:16'),
(4, 2, 'Kecemasan', 'Skor Kecemasan: 26 (Berat)', '2025-06-25 23:44:20'),
(5, 2, 'Kecemasan', 'Skor Kecemasan: 26 (Berat)', '2025-06-25 23:44:52'),
(6, 2, 'Stres', 'Skor Stres: 30 (Tinggi)', '2025-06-25 23:45:16'),
(7, 2, 'BMI', 'BMI Anda: 23.8 (Normal)', '2025-06-25 23:53:44'),
(8, 2, 'BMI', 'BMI Anda: 21.6 (Normal)', '2025-06-26 16:38:19'),
(9, 3, 'Kecemasan', 'Skor Kecemasan: 20 (Sedang)', '2025-06-30 11:35:22'),
(10, 3, 'BMI', 'BMI Anda: 18.5 (Normal)', '2025-06-30 11:35:59'),
(11, 3, 'Stres', 'Skor Stres: 24 (Sedang)', '2025-06-30 11:36:57'),
(12, 4, 'Kecemasan', 'Skor Kecemasan: 25 (Sedang)', '2025-06-30 11:38:27'),
(13, 4, 'Stres', 'Skor Stres: 26 (Tinggi)', '2025-06-30 11:39:21'),
(14, 4, 'BMI', 'BMI Anda: 22.8 (Normal)', '2025-06-30 11:39:53'),
(15, 4, 'Stres', 'Skor Stres: 40 (Tinggi)', '2025-06-30 11:40:52'),
(16, 4, 'Stres', 'Skor Stres: 10 (Rendah)', '2025-06-30 11:41:28'),
(17, 1, 'Kecemasan', 'Skor Kecemasan: 22 (Sedang)', '2025-06-30 11:45:20'),
(18, 1, 'Stres', 'Skor Stres: 24 (Sedang)', '2025-06-30 11:46:51'),
(19, 1, 'BMI', 'BMI Anda: 18 (Kurus)', '2025-06-30 11:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'nsslndrii', '$2y$10$zKr0KbHuLaPKhbhSqLNnJeSnx4vmbGKrCTnS1hEX3Pg8wehP/gIK.', 'anisa'),
(2, 'rhmsbrii', '$2y$10$M5NcvEsKnpqkFcMbog/NQ.PnPH/LcGX6sTVV7uBY/SOrgB8EVd0ry', 'rahima'),
(3, 'rrret', '$2y$10$BajVTDtPDYoVj5RDV2y9SOTtC7MWurct2ROAHe5nMy9MkNWLwFReS', 'retnow'),
(4, 'blublu', '$2y$10$oRzgyEiE6vi8eHvPp9/k7Ox/crC5tIPgJDDArAIlF85iQlBuhY2uS', 'ketblublu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_cek`
--
ALTER TABLE `hasil_cek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_cek`
--
ALTER TABLE `hasil_cek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
