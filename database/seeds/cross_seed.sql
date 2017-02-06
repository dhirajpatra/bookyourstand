-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2017 at 05:16 PM
-- Server version: 10.0.24-MariaDB-7
-- PHP Version: 7.0.15-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cross`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `add1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `document_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `logo`, `admin`, `email`, `phone`, `add1`, `add2`, `zip`, `document_id`, `created_at`, `updated_at`) VALUES
(1, 'test company', '1.png', 'test company admin', 'admin@gmail.com', 794646464, 'good add1', 'good add2', 44555, 1, '2017-02-03 18:30:00', '2017-02-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_documents`
--

CREATE TABLE `company_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_documents`
--

INSERT INTO `company_documents` (`id`, `document`, `created_at`, `updated_at`) VALUES
(1, '1.docx', '2017-02-03 18:30:00', '2017-02-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whenat` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `location_id`, `name`, `description`, `whenat`, `created_at`, `updated_at`) VALUES
(1, 2, 'Test Event', 'this is a test event to book', '2017-02-07 00:00:00', '2017-02-03 18:30:00', '2017-02-03 18:30:00'),
(2, 3, 'good test for event', 'very good test for event', '2017-02-22 00:00:00', '2017-02-03 18:30:00', '2017-02-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom` int(11) NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `place`, `zoom`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(2, 'US 1', 4, '-33.8905420', '151.2748560', '2017-02-03 18:30:00', '2017-02-03 18:30:00'),
(3, 'US 2', 4, '-33.9230360', '151.2590520', '2017-02-03 18:30:00', '2017-02-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 0),
(2, '2014_10_12_100000_create_password_resets_table', 0),
(3, '2017_02_04_021151_add_company_id_to_users_table', 1),
(4, '2017_02_04_021442_create_events_table', 1),
(6, '2017_02_04_021941_create_venues_table', 1),
(7, '2017_02_04_021956_create_stands_table', 1),
(8, '2017_02_04_022014_create_companies_table', 1),
(9, '2017_02_04_022127_create_company_documents_table', 1),
(10, '2017_02_04_021915_create_locations_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stands`
--

CREATE TABLE `stands` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `free` smallint(6) NOT NULL DEFAULT '0',
  `booked` smallint(6) NOT NULL DEFAULT '0',
  `booked_time` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stands`
--

INSERT INTO `stands` (`id`, `event_id`, `free`, `booked`, `booked_time`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 1, '2017-02-04 11:28:05', 1, '2017-02-03 18:30:00', '2017-02-04 05:58:05'),
(2, 1, 0, 0, '2017-02-06 10:21:40', 0, '2017-02-03 18:30:00', '2017-02-06 04:51:40'),
(3, 1, 1, 0, '0000-00-00 00:00:00', 0, '2017-02-03 18:30:00', '2017-02-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dhiraj', 'dhiraj@gmail.com', '', NULL, '2017-02-03 18:30:00', '2017-02-03 18:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_documents`
--
ALTER TABLE `company_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stands`
--
ALTER TABLE `stands`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `company_documents`
--
ALTER TABLE `company_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `stands`
--
ALTER TABLE `stands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
