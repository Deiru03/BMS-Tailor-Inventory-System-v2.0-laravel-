-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2025 at 04:17 PM
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
-- Database: `bms_tailor_v2025001`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_reports`
--

CREATE TABLE `invoice_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `sale_id` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `issued_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_reports`
--

INSERT INTO `invoice_reports` (`id`, `invoice_number`, `sale_id`, `customer_name`, `total_amount`, `amount_paid`, `balance`, `issued_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'INV-000002', 'SALE-20250416-0002', 'Walk in Customer', 750.00, 0.00, 0.00, '2025-04-16 09:04:37', 'generated', '2025-04-16 09:04:37', '2025-04-16 09:04:37'),
(2, 'INV-000003', 'SALE-20250417-0001', 'Walk in Customer', 2500.00, 0.00, 0.00, '2025-04-17 05:45:41', 'generated', '2025-04-17 05:45:41', '2025-04-17 05:45:41'),
(3, 'INV-000004', 'SALE-20250417-0002', 'Walk in Customer', 1250.00, 0.00, 0.00, '2025-04-17 05:46:43', 'generated', '2025-04-17 05:46:43', '2025-04-17 05:46:43'),
(4, 'INV-000005', 'SALE-20250417-0003', 'Walk in Customer', 1750.00, 0.00, 0.00, '2025-04-17 05:47:00', 'generated', '2025-04-17 05:47:00', '2025-04-17 05:47:00'),
(5, 'INV-000006', 'SALE-20250417-0004', 'Walk in Customer', 1500.00, 0.00, 0.00, '2025-04-17 13:28:41', 'generated', '2025-04-17 13:28:41', '2025-04-17 13:28:41'),
(6, 'INV-20250417-0006', 'SALE-20250417-0004', NULL, 1500.00, 1150.00, 350.00, '2025-04-17 13:54:10', 'partial', '2025-04-17 13:54:10', '2025-04-17 13:54:10'),
(7, 'INV-20250417-0007', 'SALE-20250417-0004', 'Walk in Customer', 1500.00, 1300.00, 200.00, '2025-04-17 13:59:45', 'partial', '2025-04-17 13:59:45', '2025-04-17 13:59:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_reports`
--
ALTER TABLE `invoice_reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_reports`
--
ALTER TABLE `invoice_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
