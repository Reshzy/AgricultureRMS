-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 06:58 AM
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
-- Database: `rsbsa_admin_portal2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `rsbsa_reference_number` varchar(17) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `sex` enum('male','female') NOT NULL,
  `address_house_lot` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_barangay` varchar(255) DEFAULT NULL,
  `address_municipality_city` varchar(255) DEFAULT NULL,
  `address_province` varchar(255) DEFAULT NULL,
  `address_region` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `landline_number` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `highest_formal_education` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `civil_status` enum('single','married','widowed','separated') DEFAULT NULL,
  `name_of_spouse` varchar(255) DEFAULT NULL,
  `mothers_maiden_name` varchar(255) DEFAULT NULL,
  `household_head` tinyint(1) NOT NULL DEFAULT 0,
  `household_head_name` varchar(255) DEFAULT NULL,
  `relationship_to_head` varchar(255) DEFAULT NULL,
  `household_members_total` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `household_members_male` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `household_members_female` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_pwd` tinyint(1) NOT NULL DEFAULT 0,
  `is_four_ps_beneficiary` tinyint(1) NOT NULL DEFAULT 0,
  `is_indigenous_group_member` tinyint(1) NOT NULL DEFAULT 0,
  `indigenous_group_specify` varchar(255) DEFAULT NULL,
  `has_government_id` tinyint(1) NOT NULL DEFAULT 0,
  `government_id_type` varchar(255) DEFAULT NULL,
  `government_id_number` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_number` varchar(255) DEFAULT NULL,
  `main_livelihood` enum('farmer','farmworker','fisherfolk','agri_youth') NOT NULL,
  `farming_activities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`farming_activities`)),
  `other_crop_specify` varchar(255) DEFAULT NULL,
  `livestock_type_specify` varchar(255) DEFAULT NULL,
  `poultry_type_specify` varchar(255) DEFAULT NULL,
  `farmworker_kinds_of_work` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`farmworker_kinds_of_work`)),
  `farmworker_other_work` varchar(255) DEFAULT NULL,
  `fishing_activities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fishing_activities`)),
  `fishing_other_activity` varchar(255) DEFAULT NULL,
  `agriyouth_involvements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`agriyouth_involvements`)),
  `agriyouth_other_involvement` varchar(255) DEFAULT NULL,
  `gross_income_farming` decimal(12,2) DEFAULT NULL,
  `gross_income_non_farming` decimal(12,2) DEFAULT NULL,
  `rotation_farmers_p1` varchar(255) DEFAULT NULL,
  `rotation_farmers_p2` varchar(255) DEFAULT NULL,
  `rotation_farmers_p3` varchar(255) DEFAULT NULL,
  `status` enum('draft','submitted') NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `photo_path`, `rsbsa_reference_number`, `surname`, `first_name`, `middle_name`, `extension_name`, `sex`, `address_house_lot`, `address_street`, `address_barangay`, `address_municipality_city`, `address_province`, `address_region`, `mobile_number`, `landline_number`, `date_of_birth`, `place_of_birth`, `highest_formal_education`, `religion`, `civil_status`, `name_of_spouse`, `mothers_maiden_name`, `household_head`, `household_head_name`, `relationship_to_head`, `household_members_total`, `household_members_male`, `household_members_female`, `is_pwd`, `is_four_ps_beneficiary`, `is_indigenous_group_member`, `indigenous_group_specify`, `has_government_id`, `government_id_type`, `government_id_number`, `emergency_contact_name`, `emergency_contact_number`, `main_livelihood`, `farming_activities`, `other_crop_specify`, `livestock_type_specify`, `poultry_type_specify`, `farmworker_kinds_of_work`, `farmworker_other_work`, `fishing_activities`, `fishing_other_activity`, `agriyouth_involvements`, `agriyouth_other_involvement`, `gross_income_farming`, `gross_income_non_farming`, `rotation_farmers_p1`, `rotation_farmers_p2`, `rotation_farmers_p3`, `status`, `created_at`, `updated_at`) VALUES
(1, 'enrollments/lHaSy9dYTlYbZnfNY6pB8QEf1FofomsEGAP4GnEe.jpg', NULL, 'Viloria', 'Rodge Andru', 'Perdido', NULL, 'male', '69', 'Rico Street', 'Centro Ii (pob.)', 'Claveria', 'Cagayan', 'Cagayan Valley', '0939 752 1414', NULL, '2004-05-08', 'Sanchez-mira, Cagayan, Philippines', 'Post graduate', NULL, 'single', 'Pesca, Lyka P.', 'Perdido, Margarita Escalante', 0, 'Rogelio D. Viloria Jr.', 'Father', 3, 2, 1, 0, 0, 0, NULL, 1, 'National Id', '12345', NULL, NULL, 'farmworker', NULL, NULL, NULL, NULL, '[\"Land preparation\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', '2025-08-31 22:22:02', '2025-10-06 19:35:06'),
(4, 'enrollments/uyZEZ1VUuP6SSBhKIyshQQzKBCLzQDFlgSL0Mxnf.jpg', '87-10-32-470-2389', 'Viloria', 'Rodge Andru', 'Perdido', 'Jr', 'male', '16', 'Marzan Street', 'Centro Ii (pob.)', 'Claveria', 'Cagayan', 'Cagayan Valley', '0939 752 1414', '+63 1234 1234', '2004-05-07', 'Sanchez-mira, Cagayan, Philippines', 'Post graduate', 'Others: Igelsia Filipina Independiente', 'married', 'Pesca, Lyka P.', 'Perdido, Margarita Escalante', 0, 'Rogelio Dreu Viloria Jr.', 'Father', 3, 2, 1, 0, 0, 0, NULL, 1, 'National Id', '12345', 'Peregrino, Gladys P.', '0912 345 6789', 'farmer', '[\"rice\"]', 'Wheat', NULL, 'Chicken', NULL, NULL, NULL, NULL, '[\"part of a farming household\"]', NULL, 12000.00, 5000.00, 'Roger Sanchez', 'Yve', 'Grock', 'submitted', '2025-09-01 01:42:10', '2025-10-06 18:48:21'),
(5, 'enrollments/g7oxL4wMW3i11Xv3kmc1P5nWOgJlvpuHfA54bnqY.jpg', '13-24-12-432-1412', 'Divisoria', 'Alelele', 'Kitaonga', NULL, 'male', NULL, NULL, 'Centro Viii', 'Claveria', 'Cagayan', 'Cagayan Valley', '0984 837 2784', NULL, NULL, 'Sanchez-mira, Cagayan, Philippines', 'Post graduate', 'Others: Thighs', 'single', NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, 'farmworker', NULL, NULL, NULL, NULL, '[\"Land preparation\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'submitted', '2025-10-06 19:01:53', '2025-10-06 19:02:52'),
(6, 'enrollments/1kHy1F7sD1Nbomi1djr7efAilqNfginKWA5IWGKc.jpg', '43-13-46-653-1265', 'Bellalaa', 'Delphine', 'Khalifa', NULL, 'female', NULL, NULL, 'Buenavista', 'Claveria', 'Cagayan', 'Cagayan Valley', '0988 438 2842', NULL, '2003-05-08', 'Tampakan, South Cotabato, Philippines', 'Post graduate', 'Christianity', 'married', NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, 'fisherfolk', NULL, NULL, NULL, NULL, NULL, NULL, '[\"Aquaculture\"]', 'Daklis Gaming', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'submitted', '2025-10-06 19:06:29', '2025-10-06 19:10:01'),
(7, 'enrollments/A206rDrQVIxLJNIC59Visw578dX1D12EqpEaovcY.jpg', '15-35-15-431-5313', 'Mendoza', 'John', 'D', NULL, 'male', 'Purok 1', 'Mabini', 'Centro Vii', 'Claveria', 'Cagayan', 'Cagayan Valley', '0945 645 1211', NULL, '2004-06-10', 'Claveria, Cagayan, Philippines', 'Senior High school (K-12)', 'Christianity', 'married', NULL, NULL, 1, NULL, NULL, 6, 3, 3, 1, 1, 0, NULL, 0, NULL, NULL, 'Kkkkk', '09945623544', 'farmer', '[\"rice\"]', 'Banana, Saba', 'Pig', 'Chicken, Duck', NULL, NULL, NULL, NULL, NULL, NULL, 500.00, NULL, NULL, NULL, NULL, 'submitted', '2025-10-06 20:27:07', '2025-10-06 20:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farm_parcels`
--

CREATE TABLE `farm_parcels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enrollment_id` bigint(20) UNSIGNED NOT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `total_farm_area_ha` decimal(10,2) DEFAULT NULL,
  `ownership_document_no` varchar(255) DEFAULT NULL,
  `within_ancestral_domain` tinyint(1) NOT NULL DEFAULT 0,
  `is_agrarian_reform_beneficiary` tinyint(1) NOT NULL DEFAULT 0,
  `ownership_type` enum('registered_owner','tenant','lessee','others') DEFAULT NULL,
  `land_owner_name` varchar(255) DEFAULT NULL,
  `ownership_other_specify` varchar(255) DEFAULT NULL,
  `crop_commodity` varchar(255) DEFAULT NULL,
  `livestock_poultry_type` varchar(255) DEFAULT NULL,
  `size_ha` decimal(10,2) DEFAULT NULL,
  `num_of_head` int(10) UNSIGNED DEFAULT NULL,
  `farm_type` varchar(255) DEFAULT NULL,
  `is_organic_practitioner` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farm_parcels`
--

INSERT INTO `farm_parcels` (`id`, `enrollment_id`, `barangay`, `municipality`, `total_farm_area_ha`, `ownership_document_no`, `within_ancestral_domain`, `is_agrarian_reform_beneficiary`, `ownership_type`, `land_owner_name`, `ownership_other_specify`, `crop_commodity`, `livestock_poultry_type`, `size_ha`, `num_of_head`, `farm_type`, `is_organic_practitioner`, `remarks`, `created_at`, `updated_at`) VALUES
(21, 4, NULL, NULL, 5.00, '123', 1, 1, 'registered_owner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-10-06 18:48:21', '2025-10-06 18:48:21'),
(22, 4, NULL, NULL, 2.00, '123', 1, 1, 'tenant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-10-06 18:48:21', '2025-10-06 18:48:21'),
(24, 5, 'Calog Sur', 'Abulug', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-10-06 19:02:52', '2025-10-06 19:02:52'),
(26, 6, 'Bacsay Mapulapula', 'Claveria', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-10-06 19:10:01', '2025-10-06 19:10:01'),
(27, 7, 'Kilkiling', 'Claveria', 5.00, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-10-06 20:36:01', '2025-10-06 20:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `farm_parcel_items`
--

CREATE TABLE `farm_parcel_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `farm_parcel_id` bigint(20) UNSIGNED NOT NULL,
  `kind` enum('crop','livestock','poultry') NOT NULL,
  `name` varchar(255) NOT NULL,
  `size_ha` decimal(10,2) DEFAULT NULL,
  `num_of_head` int(10) UNSIGNED DEFAULT NULL,
  `farm_type` varchar(255) DEFAULT NULL,
  `is_organic_practitioner` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farm_parcel_items`
--

INSERT INTO `farm_parcel_items` (`id`, `farm_parcel_id`, `kind`, `name`, `size_ha`, `num_of_head`, `farm_type`, `is_organic_practitioner`, `remarks`, `created_at`, `updated_at`) VALUES
(27, 21, 'crop', 'Wheat', 2.00, NULL, 'Rainfed', 1, 'Good', '2025-10-06 18:48:21', '2025-10-06 18:48:21'),
(28, 21, 'crop', 'Rice', 3.00, NULL, 'Rainfed', 1, 'Eme', '2025-10-06 18:48:21', '2025-10-06 18:48:21'),
(29, 22, 'poultry', 'Chicken', 2.00, 10, 'Egg Farm', 0, 'Good', '2025-10-06 18:48:21', '2025-10-06 18:48:21'),
(30, 27, 'crop', 'Banana', 1.00, NULL, 'saba', 0, 'naimas', '2025-10-06 20:36:01', '2025-10-06 20:36:01'),
(31, 27, 'livestock', 'Pig', 0.50, 5, 'Meat', 0, 'yummy', '2025-10-06 20:36:01', '2025-10-06 20:36:01'),
(32, 27, 'poultry', 'Chicken', 0.25, 10, 'Egg', 0, 'Sunny side up', '2025-10-06 20:36:01', '2025-10-06 20:36:01'),
(33, 27, 'poultry', 'Duck', 10.00, 2, 'Balut', 0, 'Penoy', '2025-10-06 20:36:01', '2025-10-06 20:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_30_093906_add_two_factor_columns_to_users_table', 1),
(5, '2025_07_30_093939_create_personal_access_tokens_table', 1),
(6, '2025_09_01_013854_create_news_table', 2),
(7, '2025_09_01_015251_add_is_admin_to_users_table', 3),
(8, '2025_09_01_015523_create_enrollments_table', 4),
(9, '2025_09_01_015530_create_farm_parcels_table', 4),
(10, '2025_09_01_051022_create_farm_parcel_items_table', 5),
(11, '2025_09_01_052144_update_farm_parcel_items_table_add_columns', 6),
(12, '2025_09_01_061551_add_status_to_enrollments_table', 7),
(13, '2025_10_07_024442_add_rsbsa_reference_number_to_enrollments_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `featured_image_path` varchar(255) DEFAULT NULL,
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`categories`)),
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `audience` varchar(255) NOT NULL DEFAULT 'all',
  `priority` enum('normal','important','urgent') NOT NULL DEFAULT 'normal',
  `status` enum('draft','scheduled','published') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `content`, `featured_image_path`, `categories`, `tags`, `audience`, `priority`, `status`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pagasa Warns of Extended Rainfall, Farmers Urged to Protect Crops', 'pagasa-warns-of-extended-rainfall-farmers-urged-to-protect-crops-QPcuHy', 'The Philippine Atmospheric, Geophysical and Astronomical Services Administration (PAGASA) has issued an advisory warning of extended rainfall across Northern Luzon due to the southwest monsoon. Farmers are advised to secure their rice paddies and vegetable crops against possible flooding and waterlogging.\r\nAgricultural experts recommend using proper drainage systems and monitoring soil conditions to prevent crop damage. PAGASA added that while the rains may benefit some irrigated areas, excessive water could reduce yields if not managed properly.', 'news/T0GZnipFDqGxgTJ8ADMtg6U3vx2txzEmPsEm8GxE.jpg', '[]', '[\"water\",\"liquid\",\"scenery\",\"asf\",\"dasfasdfasdfasdfasgasdg\",\"ashghhhhhhhhhhhhhhhhhhhh hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh\"]', 'all', 'important', 'published', '2025-09-01 06:09:48', NULL, '2025-09-01 06:06:42', '2025-09-01 06:09:48'),
(2, 'Test', 'test-HblTcg', 'TestTestubg', 'news/ghoRWL584AJVz6fCZNSoQyeOsrvPua9m6PwHxLBp.png', '[\"market\"]', '[\"important\",\"maybe\",\"idk\"]', 'all', 'normal', 'published', '2025-10-06 03:13:42', NULL, '2025-10-06 03:13:42', '2025-10-06 03:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DYdBQE8yiY2fLPHiRfJCMBigAJLna6tCxYeT53dP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWkFqWVJCNGJTQVRRNGlPcm1BUlJjUVRObkRnd2QzOUtFR1hEWnVieSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkWC5wdmM1aDhGRXJWUkNISmYybEJuT2VsWFcyOGxvR2pUbzJwWU1MSnNyQnBENFR5THRLbWEiO30=', 1759812665);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@example.com', NULL, '$2y$12$X.pvc5h8FErVRCHJf2lBnOelXW28loGjTo2pYMLJsrBpD4TyLtKma', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-31 18:02:49', '2025-10-06 03:55:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farm_parcels`
--
ALTER TABLE `farm_parcels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farm_parcels_enrollment_id_foreign` (`enrollment_id`);

--
-- Indexes for table `farm_parcel_items`
--
ALTER TABLE `farm_parcel_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farm_parcel_items_farm_parcel_id_foreign` (`farm_parcel_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`),
  ADD KEY `news_published_at_index` (`published_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

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
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farm_parcels`
--
ALTER TABLE `farm_parcels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `farm_parcel_items`
--
ALTER TABLE `farm_parcel_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farm_parcels`
--
ALTER TABLE `farm_parcels`
  ADD CONSTRAINT `farm_parcels_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farm_parcel_items`
--
ALTER TABLE `farm_parcel_items`
  ADD CONSTRAINT `farm_parcel_items_farm_parcel_id_foreign` FOREIGN KEY (`farm_parcel_id`) REFERENCES `farm_parcels` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
