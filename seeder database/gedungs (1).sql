-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jul 2022 pada 03.45
-- Versi server: 10.6.5-MariaDB-log
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendataan_sementara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedungs`
--

CREATE TABLE `gedungs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kampus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gedung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gedungs`
--

INSERT INTO `gedungs` (`id`, `kampus`, `gedung`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Kampus 2', 'Umi Hafsoh', NULL, '2022-07-24 05:01:03', '2022-07-24 05:01:03'),
(2, 'Kampus 2', 'Umi Kulsum', NULL, '2022-07-24 05:01:16', '2022-07-24 05:01:16'),
(3, 'Kampus 2', 'Masyitoh', NULL, '2022-07-24 05:01:32', '2022-07-24 05:01:32'),
(4, 'Kampus 2', 'Zaenab', NULL, '2022-07-24 05:01:44', '2022-07-24 05:01:44'),
(5, 'Kampus 2', 'Siti Hajar', NULL, '2022-07-24 05:01:55', '2022-07-24 05:01:55'),
(6, 'Kampus 4', 'Sayyidah Maryam', NULL, '2022-07-24 05:02:21', '2022-07-24 05:02:21'),
(7, 'Kampus 4', 'Khodijah', NULL, '2022-07-24 05:02:38', '2022-07-24 05:02:38'),
(8, 'Kampus 4', 'Sayyidah Robiah', NULL, '2022-07-24 05:03:01', '2022-07-24 05:03:01'),
(9, 'Kampus 4', 'Sayyidah Fatimah', NULL, '2022-07-24 05:03:18', '2022-07-24 05:03:18'),
(10, 'Kampus 3', 'Ibnu Anfas', NULL, '2022-07-24 05:03:55', '2022-07-24 05:03:55'),
(11, 'Kampus 3', 'Imam Syafi\'i', NULL, '2022-07-24 05:04:06', '2022-07-24 05:04:06'),
(12, 'Kampus 3', 'Imam Thobari', NULL, '2022-07-24 05:04:21', '2022-07-24 05:04:21'),
(13, 'Kampus 3', 'Imam Muslim', NULL, '2022-07-24 05:04:38', '2022-07-24 05:04:38'),
(14, 'Kampus 3', 'Imam Bukhori', NULL, '2022-07-24 05:05:00', '2022-07-24 05:05:00'),
(15, 'Kampus 1', 'Umar', NULL, '2022-07-25 17:11:02', '2022-07-25 17:11:02'),
(16, 'Kampus 1', 'Umar Bin Khattab', NULL, '2022-07-25 17:11:14', '2022-07-25 17:11:14'),
(17, 'Kampus 1', 'Imam Ghozali', NULL, '2022-07-25 17:11:31', '2022-07-25 17:11:31'),
(18, 'Kampus 1', 'Ali bin Abi Tholib', NULL, '2022-07-25 17:11:48', '2022-07-25 17:11:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gedungs`
--
ALTER TABLE `gedungs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gedungs`
--
ALTER TABLE `gedungs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
