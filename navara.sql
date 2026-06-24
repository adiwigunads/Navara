-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 09:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `navara`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `action`, `created_at`) VALUES
(1, 4, 'Login ke dashboard administrator', '2026-06-11 06:08:23'),
(2, 4, 'Menghapus pengguna: admin2@spkwisata.id', '2026-06-11 07:09:51'),
(3, 4, 'Menghapus pengguna: admin@spkwisata.id', '2026-06-11 07:09:55'),
(4, 4, 'Menghapus pengguna: verif@spkwisata.id', '2026-06-11 07:09:59'),
(5, 4, 'Menambah pengguna baru: rema@gmail.com', '2026-06-11 07:10:41'),
(6, 4, 'Menambah pengguna baru: trisna@gmail.com', '2026-06-11 07:11:22'),
(7, 4, 'Menambah pengguna baru: gita@gmail.com', '2026-06-11 07:12:43'),
(8, 4, 'Logout dari sistem', '2026-06-11 07:40:20'),
(9, 5, 'Login ke dashboard verifikator', '2026-06-11 07:40:40'),
(10, 5, 'Mengunduh hasil ranking objek wisata', '2026-06-11 07:40:53'),
(11, 5, 'Logout dari sistem', '2026-06-11 07:54:17'),
(12, 6, 'Login ke dashboard administrative', '2026-06-11 07:54:29'),
(13, 6, 'Melakukan perhitungan MOORA', '2026-06-11 07:55:01'),
(14, 6, 'Menambah objek wisata: A11', '2026-06-11 08:03:56'),
(15, 6, 'Mengubah nilai alternatif: A11', '2026-06-11 08:04:41'),
(16, 6, 'Logout dari sistem', '2026-06-11 08:07:10'),
(17, 5, 'Login ke dashboard verifikator', '2026-06-11 08:07:28'),
(18, 6, 'Login ke dashboard administrative', '2026-06-22 01:00:00'),
(19, 6, 'Logout dari sistem', '2026-06-22 01:01:09'),
(20, 7, 'Login ke dashboard administrative', '2026-06-22 01:01:42'),
(21, 7, 'Mengubah objek wisata: A1', '2026-06-22 01:02:20'),
(22, 7, 'Mengubah objek wisata: A2', '2026-06-22 01:57:31'),
(23, 7, 'Mengubah objek wisata: A4', '2026-06-22 01:57:54'),
(24, 7, 'Mengubah objek wisata: A8', '2026-06-22 01:58:16'),
(25, 7, 'Mengubah objek wisata: A6', '2026-06-22 01:58:33'),
(26, 7, 'Login ke dashboard administrative', '2026-06-22 05:10:04'),
(27, 7, 'Mengubah objek wisata: A10', '2026-06-22 05:13:32'),
(28, 7, 'Menghapus objek wisata: A11', '2026-06-22 05:13:44'),
(29, 7, 'Mengubah objek wisata: A3', '2026-06-22 05:15:37'),
(30, 7, 'Mengubah objek wisata: A5', '2026-06-22 05:17:55'),
(31, 7, 'Mengubah objek wisata: A7', '2026-06-22 05:18:31'),
(32, 7, 'Mengubah objek wisata: A9', '2026-06-22 05:20:03'),
(33, 7, 'Logout dari sistem', '2026-06-22 06:04:47'),
(34, 7, 'Login ke dashboard administrative', '2026-06-22 06:08:28'),
(35, 7, 'Logout dari sistem', '2026-06-22 06:13:00'),
(36, 4, 'Login ke dashboard administrator', '2026-06-22 06:13:32'),
(37, 7, 'Login ke dashboard administrative', '2026-06-23 06:01:57'),
(38, 7, 'Melakukan perhitungan MOORA', '2026-06-23 06:02:17'),
(39, 7, 'Melakukan perhitungan MOORA', '2026-06-23 06:02:23'),
(40, 7, 'Melakukan perhitungan MOORA', '2026-06-23 07:29:04'),
(41, 7, 'Logout dari sistem', '2026-06-23 07:38:41'),
(42, 4, 'Login ke dashboard administrator', '2026-06-23 07:38:55'),
(43, 4, 'Backup database: backup_2026-06-23_074343.sql', '2026-06-23 07:43:43'),
(44, 4, 'Logout dari sistem', '2026-06-23 07:55:21'),
(45, 7, 'Login ke dashboard administrative', '2026-06-23 07:55:30'),
(46, 7, 'Melakukan perhitungan MOORA', '2026-06-23 07:55:36'),
(47, 7, 'Melakukan perhitungan MOORA', '2026-06-23 08:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode`, `nama`, `lokasi`, `deskripsi`, `gambar`) VALUES
(1, 'A1', 'Tirta Gangga', 'Ababi, Abang, Karangasem', 'Taman air kerajaan dengan kolam suci dan panorama sawah berundak', 'a1-1782090140.png'),
(2, 'A2', 'Taman Soekasada Ujung', 'Ujung, Karangasem', 'Istana air bersejarah peninggalan Raja Karangasem', 'a2-1782093451.png'),
(3, 'A3', 'Bukit Asah', 'Bugbug, Karangasem', 'Bukit dengan pemandangan laut dan perbukitan hijau', 'a3-1782105337.jpg'),
(4, 'A4', 'Virgin Beach', 'Bugbug, Karangasem', 'Pantai tersembunyi dengan pasir putih bersih dan air jernih', 'a4-1782093474.png'),
(5, 'A5', 'Taman Edelweis Bali', 'Karangasem', 'Taman bunga edelweis dengan pemandangan alam pegunungan', 'a5-1782105475.jpg'),
(6, 'A6', 'Desa Adat Tenganan', 'Tenganan, Manggis, Karangasem', 'Desa Bali Aga tertua dengan tradisi dan kerajinan unik', 'a6-1782093513.png'),
(7, 'A7', 'Pantai Amed', 'Amed, Abang, Karangasem', 'Pantai dengan snorkeling dan diving terbaik di Bali timur', 'a7-1782105511.jpg'),
(8, 'A8', 'Blue Lagoon', 'Padangbai, Manggis, Karangasem', 'Teluk tersembunyi dengan air biru jernih dan terumbu karang', 'a8-1782093496.png'),
(9, 'A9', 'Pemandian Telaga Surya', 'Karangasem', 'Pemandian alam dengan sumber mata air alami', 'a9-1782105603.jpg'),
(10, 'A10', 'Bukit Cinta Pangi', 'Karangasem', 'Bukit romantis dengan pemandangan panoramik Karangasem', 'a10-1782105212.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('navara-karangasem-cache-admin@spkwisata.id|127.0.0.1', 'i:2;', 1781157817),
('navara-karangasem-cache-admin@spkwisata.id|127.0.0.1:timer', 'i:1781157817;', 1781157817);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_hasil`
--

CREATE TABLE `detail_hasil` (
  `id` bigint UNSIGNED NOT NULL,
  `hasil_id` bigint UNSIGNED NOT NULL,
  `alternatif_id` bigint UNSIGNED NOT NULL,
  `yi` decimal(12,8) NOT NULL,
  `ranking` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_hasil`
--

INSERT INTO `detail_hasil` (`id`, `hasil_id`, `alternatif_id`, `yi`, `ranking`) VALUES
(1, 1, 2, 0.11014072, 1),
(2, 1, 10, 0.07500028, 2),
(3, 1, 8, 0.07320425, 3),
(4, 1, 1, 0.05397747, 4),
(5, 1, 7, 0.05328736, 5),
(6, 1, 4, 0.04724995, 6),
(7, 1, 3, 0.03875401, 7),
(8, 1, 6, 0.00351913, 8),
(9, 1, 9, -0.02120982, 9),
(10, 1, 5, -0.04246331, 10);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_perhitungan`
--

CREATE TABLE `hasil_perhitungan` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_perhitungan`
--

INSERT INTO `hasil_perhitungan` (`id`, `tanggal`, `created_by`) VALUES
(1, '2026-06-10 23:40:53', 5);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama`, `tipe`, `bobot`) VALUES
(1, 'C1', 'Harga Tiket Masuk', 'cost', 0.25),
(2, 'C2', 'Fasilitas', 'benefit', 0.20),
(3, 'C3', 'Jarak dari Kota Amlapura', 'cost', 0.20),
(4, 'C4', 'Rating Google Maps', 'benefit', 0.20),
(5, 'C5', 'Jumlah Ulasan', 'benefit', 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_11_023635_create_activity_logs_table', 1),
(5, '2026_06_11_023635_create_alternatifs_table', 1),
(6, '2026_06_11_023635_create_kriterias_table', 1),
(7, '2026_06_11_023636_create_hasil_perhitungans_table', 1),
(8, '2026_06_11_023636_create_nilai_alternatifs_table', 1),
(9, '2026_06_11_023637_create_detail_hasils_table', 1),
(10, '2026_06_11_030639_add_gambar_to_alternatif_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_alternatif`
--

CREATE TABLE `nilai_alternatif` (
  `id` bigint UNSIGNED NOT NULL,
  `alternatif_id` bigint UNSIGNED NOT NULL,
  `kriteria_id` bigint UNSIGNED NOT NULL,
  `nilai` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_alternatif`
--

INSERT INTO `nilai_alternatif` (`id`, `alternatif_id`, `kriteria_id`, `nilai`) VALUES
(1, 1, 1, 45000.00),
(2, 1, 2, 3.00),
(3, 1, 3, 7.10),
(4, 1, 4, 4.60),
(5, 1, 5, 22755.00),
(6, 2, 1, 15000.00),
(7, 2, 2, 3.00),
(8, 2, 3, 5.90),
(9, 2, 4, 4.60),
(10, 2, 5, 10198.00),
(11, 3, 1, 15000.00),
(12, 3, 2, 3.00),
(13, 3, 3, 10.40),
(14, 3, 4, 4.50),
(15, 3, 5, 581.00),
(16, 4, 1, 10000.00),
(17, 4, 2, 2.00),
(18, 4, 3, 12.50),
(19, 4, 4, 4.60),
(20, 4, 5, 3350.00),
(21, 5, 1, 20000.00),
(22, 5, 2, 3.00),
(23, 5, 3, 33.00),
(24, 5, 4, 4.50),
(25, 5, 5, 2826.00),
(26, 6, 1, 20000.00),
(27, 6, 2, 3.00),
(28, 6, 3, 17.20),
(29, 6, 4, 4.50),
(30, 6, 5, 1902.00),
(31, 7, 1, 5000.00),
(32, 7, 2, 3.00),
(33, 7, 3, 21.20),
(34, 7, 4, 4.50),
(35, 7, 5, 1984.00),
(36, 8, 1, 0.00),
(37, 8, 2, 3.00),
(38, 8, 3, 26.10),
(39, 8, 4, 4.20),
(40, 8, 5, 5331.00),
(41, 9, 1, 15000.00),
(42, 9, 2, 3.00),
(43, 9, 3, 30.20),
(44, 9, 4, 4.60),
(45, 9, 5, 1089.00),
(46, 10, 1, 0.00),
(47, 10, 2, 1.00),
(48, 10, 3, 4.10),
(49, 10, 4, 4.50),
(50, 10, 5, 423.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('na0cP6T8Z9oSt3SSY4eGkR4q6Owo2kC4pgzqlw1e', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJWTVRsOTdVczVXQm9OOFdLMGxJWHZBcVNkSlB1U2VXanpqdlBaaDlvIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9iYWNrdXAiLCJyb3V0ZSI6ImFkbWluLmJhY2t1cC5pbmRleCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NH0=', 1782112191),
('QfouV5w4zL9MlgiAICpniyCFKDiVXWdr4dl6LYnV', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ0MkJMMG9EbHZmUWExajJpWWhVWFB5Qzd2N3U0Q0I4ZlpVekt3V0tWIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluaXN0cmF0aXZlXC9yYW5raW5nIiwicm91dGUiOiJhZG1pbmlzdHJhdGl2ZS5yYW5raW5nLmluZGV4In0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo3fQ==', 1782204426);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Adi', 'adi@admin.com', NULL, '$2y$12$rbRFZdLmhuUQPdk5dXQDw.FSxQrcN3txxyLZIxjFk1SCDTt7ferDq', 'administrator', NULL, '2026-06-10 22:07:41', '2026-06-10 22:07:41'),
(5, 'rema', 'rema@gmail.com', NULL, '$2y$12$WbsHpfUUwcomAt3Ms0bEK.Wt2BEIhR.V82BPwqkw4hmt2sDTyuL1S', 'verifikator', '0X4vVDa0QngA3z28PTOLiCTdU2cUqyCb2yqNXWizlu3ytuTPOFM3HcAoatDy', '2026-06-10 23:10:41', '2026-06-10 23:10:41'),
(6, 'trisna', 'trisna@gmail.com', NULL, '$2y$12$BZtid5k7e4BwLlEKPQ2r.uK3P0LAHbomMjD9wt4s2YZVYtTzCS.TO', 'administrative', NULL, '2026-06-10 23:11:22', '2026-06-10 23:11:22'),
(7, 'gita', 'gita@gmail.com', NULL, '$2y$12$3UnObDDtjTkRUslQU0CV7.RNyL0qQOpl69Dh3mZKgI4EV8PpG6J5q', 'administrative', NULL, '2026-06-10 23:12:43', '2026-06-10 23:12:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_user_id_foreign` (`user_id`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alternatif_kode_unique` (`kode`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_hasil`
--
ALTER TABLE `detail_hasil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `detail_hasil_hasil_id_alternatif_id_unique` (`hasil_id`,`alternatif_id`),
  ADD KEY `detail_hasil_alternatif_id_foreign` (`alternatif_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `hasil_perhitungan`
--
ALTER TABLE `hasil_perhitungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_perhitungan_created_by_foreign` (`created_by`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kriteria_kode_unique` (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nilai_alternatif_alternatif_id_kriteria_id_unique` (`alternatif_id`,`kriteria_id`),
  ADD KEY `nilai_alternatif_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_hasil`
--
ALTER TABLE `detail_hasil`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_perhitungan`
--
ALTER TABLE `hasil_perhitungan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_hasil`
--
ALTER TABLE `detail_hasil`
  ADD CONSTRAINT `detail_hasil_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_hasil_hasil_id_foreign` FOREIGN KEY (`hasil_id`) REFERENCES `hasil_perhitungan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_perhitungan`
--
ALTER TABLE `hasil_perhitungan`
  ADD CONSTRAINT `hasil_perhitungan_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `nilai_alternatif`
--
ALTER TABLE `nilai_alternatif`
  ADD CONSTRAINT `nilai_alternatif_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_alternatif_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
