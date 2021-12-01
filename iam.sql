-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 01:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iam`
--

-- --------------------------------------------------------

--
-- Table structure for table `corrective_action`
--

CREATE TABLE `corrective_action` (
  `id_corrective` int(11) NOT NULL,
  `id_root` int(11) NOT NULL,
  `corrective` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `risk_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `risk_after` varchar(255) DEFAULT NULL,
  `due_date` date NOT NULL,
  `close_date` date DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `fu_corrective` varchar(255) DEFAULT NULL,
  `file_fu` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corrective_action`
--

INSERT INTO `corrective_action` (`id_corrective`, `id_root`, `corrective`, `status`, `department`, `risk_level`, `risk_after`, `due_date`, `close_date`, `comment`, `fu_corrective`, `file_fu`, `updated_at`, `created_at`) VALUES
(24, 36, 'Rekomendasi Tindakan yang harus dilakukan berdasarkan Root Pertama dari Temuan Audit Pertama', 'Open', 'Geotechnical Engineering', 'Low', NULL, '2021-12-15', NULL, NULL, NULL, NULL, '2021-11-30 16:42:39', '2021-11-30 16:42:39'),
(25, 37, 'Rekomendasi Tindakan yang harus dilakukan berdasarkan Root Kedua dari Temuan Audit Kedua', 'Open', 'Facility Preventive Maintenance', 'Medium', NULL, '2021-12-12', NULL, NULL, NULL, NULL, '2021-11-30 16:45:49', '2021-11-30 16:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(255) NOT NULL,
  `nama_department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `nama_department`) VALUES
(77, 'Business Process Improvement & Technology (BPIT)'),
(76, 'Coal Chain'),
(60, 'Coal Hauling'),
(65, 'Coal Terminal Admin & Support'),
(8, 'Development'),
(85, 'External Relation & Technical Support'),
(82, 'External Relations & Sustainability'),
(63, 'Facility Preventive Maintenance'),
(67, 'Finance & Accounting (JKT)'),
(68, 'Finance & Accounting (Mine Site)'),
(84, 'General Affairs'),
(10, 'Geology & Survey'),
(9, 'Geotechnical Engineering'),
(81, 'Human Capital'),
(70, 'Insurance'),
(86, 'Internal Audit'),
(78, 'Legal'),
(79, 'Legal (JKT)'),
(72, 'Marketing'),
(74, 'Marketing Logistics'),
(73, 'Marketing Research'),
(61, 'Mine Facility'),
(59, 'Mining Innovation & Digitalization'),
(83, 'Outsourcing Contract Management'),
(75, 'Planning'),
(64, 'Port Security & Operation'),
(66, 'Procurement & HEM'),
(7, 'Production'),
(71, 'Quality Control'),
(62, 'Road Maintenance'),
(6, 'Safety & Environment'),
(80, 'Security'),
(69, 'Tax, PNBP & ERM');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finding`
--

CREATE TABLE `finding` (
  `id_finding` int(11) NOT NULL,
  `no_audit` bigint(20) NOT NULL,
  `no_laporan_audit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_audit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_audit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_audit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `risk_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria_audit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_audit` year(4) NOT NULL,
  `tanggal_mulai_audit` date NOT NULL,
  `tanggal_akhir_audit` date NOT NULL,
  `auditor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `root` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corrective` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finding`
--

INSERT INTO `finding` (`id_finding`, `no_audit`, `no_laporan_audit`, `judul_audit`, `progress`, `tipe_audit`, `jenis_audit`, `risk_level`, `kriteria_audit`, `tahun_audit`, `tanggal_mulai_audit`, `tanggal_akhir_audit`, `auditor`, `root`, `department`, `corrective`, `due_date`, `updated_at`, `created_at`) VALUES
(45, 15, '012021Audit', 'Audit Pertama', '0%', 'Internal', 'HSE', NULL, 'Minor', 2021, '2021-12-01', '2021-12-15', 'Budi', NULL, NULL, NULL, NULL, '2021-11-30 16:41:27', '2021-11-30 16:41:27'),
(46, 16, '022021Audit', 'Audit Kedua', '0%', 'External', 'HSE', NULL, 'Minor', 2021, '2021-12-02', '2021-12-13', 'Dodi', NULL, NULL, NULL, NULL, '2021-11-30 16:44:43', '2021-11-30 16:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_temuan`
--

CREATE TABLE `jumlah_temuan` (
  `id_jumlah_temuan` int(11) NOT NULL,
  `id_audit` int(11) NOT NULL,
  `id_finding` int(11) NOT NULL,
  `item_finding` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jumlah_temuan`
--

INSERT INTO `jumlah_temuan` (`id_jumlah_temuan`, `id_audit`, `id_finding`, `item_finding`, `updated_at`, `created_at`) VALUES
(21, 15, 45, 'Temuan yang berdasarkan Audit Pertama', '2021-11-30 16:41:27', '2021-11-30 16:41:27'),
(22, 16, 46, 'Temuan yang berdasarkan Audit Kedua', '2021-11-30 16:44:43', '2021-11-30 16:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_audit`
--

CREATE TABLE `laporan_audit` (
  `no_audit` bigint(20) UNSIGNED NOT NULL,
  `no_laporan_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_audit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` int(11) NOT NULL,
  `kriteria_audit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_audit` year(4) NOT NULL,
  `tanggal_mulai_audit` date DEFAULT NULL,
  `tanggal_akhir_audit` date DEFAULT NULL,
  `jumlah_temuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `root_audit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corrective_action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_audit`
--

INSERT INTO `laporan_audit` (`no_audit`, `no_laporan_audit`, `judul_audit`, `status_audit`, `percentage_audit`, `tipe_audit`, `jenis_audit`, `objek`, `auditor`, `department`, `kriteria_audit`, `tahun_audit`, `tanggal_mulai_audit`, `tanggal_akhir_audit`, `jumlah_temuan`, `root_audit`, `corrective_action`, `file`, `created_at`, `updated_at`) VALUES
(15, '012021Audit', 'Audit Pertama', 'On Progress', '0%', 'Internal', 'HSE', 'Objek Audit Pertama', 'Budi', 81, 'Minor', 2021, '2021-12-01', '2021-12-15', NULL, '0', '0', 'Audit Pertama.pdf', '2021-11-30 16:37:34', '2021-11-30 16:37:34'),
(16, '022021Audit', 'Audit Kedua', 'On Progress', '0%', 'External', 'HSE', 'Objek Audit Kedua', 'Dodi', 8, 'Minor', 2021, '2021-12-02', '2021-12-13', NULL, '0', '0', 'Audit Kedua.pdf', '2021-11-30 16:39:55', '2021-11-30 16:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2021_10_21_051022_create_laporan_audits_table', 1),
(7, '2014_10_12_000000_create_users_table', 2),
(8, '2014_10_12_100000_create_password_resets_table', 2),
(9, '2019_08_19_000000_create_failed_jobs_table', 2),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(11, '2021_11_08_021227_create_jenis_laporan_audits_table', 2),
(12, '2021_11_10_005750_create_audit_jenis_audit_table', 3),
(13, '2021_11_10_014811_create_audit_jenis_audit_table', 4),
(14, '2021_11_10_021051_create_audit_jenis_audit_table', 5),
(15, '2021_11_10_033335_create_audit_audit_jenis_table', 6),
(16, '2021_11_10_033751_create_audit_jenis_audit_table', 7),
(17, '2021_11_10_045756_create_jenis_laporan_audits_table', 8),
(18, '2021_11_10_055223_create_audit_jenis_audit_table', 9),
(19, '2021_11_11_013333_create_audit_jenis_audit_table', 10),
(20, '2021_11_11_013635_create_audit_jenis_audit_table', 11),
(21, '2021_11_11_015749_create_audit_jenis_audit_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `root`
--

CREATE TABLE `root` (
  `id_root` int(11) NOT NULL,
  `id_jumlah_temuan` int(11) NOT NULL,
  `root_cause` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `root`
--

INSERT INTO `root` (`id_root`, `id_jumlah_temuan`, `root_cause`, `updated_at`, `created_at`) VALUES
(36, 21, 'Root Pertama yang berdasarkan Temuan Audit Pertama', '2021-11-30 16:41:55', '2021-11-30 16:41:55'),
(37, 22, 'Root Kedua yang berdasarkan Temuan Audit Kedua', '2021-11-30 16:45:01', '2021-11-30 16:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_department` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('auditor','auditee','','') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `id_department`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Toti', 7, NULL, '$2y$10$LgTPiFA7AGbI2y3O2nalT.FX.dYyKAa3XZ/Q2dJ8jpXpaIkfmxkR.', NULL, '2021-11-08 20:45:16', '2021-11-11 22:12:51', 'auditor'),
(2, 'Widya', 86, NULL, '$2y$10$QY1ZN0z/CjU/5639F/i3iu0hoVuhCKon4m.8VtMJ8UfrZ9VArhDKG', NULL, '2021-11-08 20:58:39', '2021-11-30 16:48:07', 'auditor'),
(4, 'Oti', 8, NULL, '$2y$10$PNoH8hJLB9MXpcoMNDmUFe.OQrBh.cBtJk8wCHjARlltXi04FpyEe', NULL, '2021-11-24 19:19:25', '2021-11-24 19:20:26', 'auditee'),
(5, 'Dian', 81, NULL, '$2y$10$JFLSyxgDH1aa4m.XUqQ/TenJUAEULLtP/Tze9iD9ZqWBOANcCiCW.', NULL, '2021-11-24 21:29:01', '2021-11-30 16:47:51', 'auditor'),
(6, 'Auditor', 81, NULL, '$2y$10$ql5BnAQr4KIxxq.1S5.Ozuqs8n30wiSQPFY67az0VK8apVAiDFYgq', NULL, '2021-11-30 16:28:05', '2021-11-30 16:28:05', 'auditor'),
(7, 'Auditee', 61, NULL, '$2y$10$fEJNg5EGESTOpg06k8Xuzew5jhkM04fotdR7K7f.3lihLiX9r3Mw2', NULL, '2021-11-30 16:28:25', '2021-11-30 16:28:25', 'auditee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corrective_action`
--
ALTER TABLE `corrective_action`
  ADD PRIMARY KEY (`id_corrective`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_department` (`nama_department`),
  ADD KEY `id_department` (`id`),
  ADD KEY `nama_department_2` (`nama_department`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finding`
--
ALTER TABLE `finding`
  ADD PRIMARY KEY (`id_finding`);

--
-- Indexes for table `jumlah_temuan`
--
ALTER TABLE `jumlah_temuan`
  ADD PRIMARY KEY (`id_jumlah_temuan`);

--
-- Indexes for table `laporan_audit`
--
ALTER TABLE `laporan_audit`
  ADD PRIMARY KEY (`no_audit`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `root`
--
ALTER TABLE `root`
  ADD PRIMARY KEY (`id_root`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corrective_action`
--
ALTER TABLE `corrective_action`
  MODIFY `id_corrective` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finding`
--
ALTER TABLE `finding`
  MODIFY `id_finding` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `jumlah_temuan`
--
ALTER TABLE `jumlah_temuan`
  MODIFY `id_jumlah_temuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `laporan_audit`
--
ALTER TABLE `laporan_audit`
  MODIFY `no_audit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `root`
--
ALTER TABLE `root`
  MODIFY `id_root` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
