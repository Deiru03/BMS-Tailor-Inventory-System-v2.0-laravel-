-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 14, 2025 at 04:02 AM
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
-- Database: `bms_tailor`
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
-- Table structure for table `category_products`
--

CREATE TABLE `category_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers_infos`
--

CREATE TABLE `customers_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `notes` text DEFAULT NULL,
  `purchased_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customer_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers_infos`
--

INSERT INTO `customers_infos` (`id`, `name`, `email`, `phone`, `address`, `sex`, `notes`, `purchased_amount`, `amount_paid`, `balance`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Dale Decain', 'dale@example.com', '09123456789', 'San Jose, Occidental Mindoro', 'male', 'nothing to say here just testing data and nothing more updated 2.01', 11.11, 111.19, 300.10, 'C123', '2025-03-23 23:46:27', '2025-03-23 22:01:53'),
(2, 'Dei Ru', 'deiru@gg.com', '09123456788', 'San Jose, Occidental Mindoro', 'male', 'Nothing To Say', 0.00, 0.00, 0.00, 'CUST-DFBPQR', '2025-03-23 16:33:06', '2025-03-23 17:15:44'),
(4, 'Julian Bernard', NULL, '09123456787', 'San Jose, Occidental Mindoro', 'male', 'Nothing Code say Say to me', 0.00, 0.00, 0.00, 'CUST-XRSTIR', '2025-03-23 16:34:52', '2025-03-23 21:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `customer_measurements`
--

CREATE TABLE `customer_measurements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_info_id` bigint(20) UNSIGNED NOT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `neck` decimal(5,2) DEFAULT NULL,
  `shoulder` decimal(5,2) DEFAULT NULL,
  `chest` decimal(5,2) DEFAULT NULL,
  `bust` decimal(5,2) DEFAULT NULL,
  `waist` decimal(5,2) DEFAULT NULL,
  `hip` decimal(5,2) DEFAULT NULL,
  `sleeve_length` decimal(5,2) DEFAULT NULL,
  `bicep` decimal(5,2) DEFAULT NULL,
  `wrist` decimal(5,2) DEFAULT NULL,
  `back_width` decimal(5,2) DEFAULT NULL,
  `shirt_length` decimal(5,2) DEFAULT NULL,
  `armhole_depth` decimal(5,2) DEFAULT NULL,
  `thigh` decimal(5,2) DEFAULT NULL,
  `knee` decimal(5,2) DEFAULT NULL,
  `calf` decimal(5,2) DEFAULT NULL,
  `ankle` decimal(5,2) DEFAULT NULL,
  `inseam` decimal(5,2) DEFAULT NULL,
  `outseam` decimal(5,2) DEFAULT NULL,
  `crotch_depth` decimal(5,2) DEFAULT NULL,
  `front_rise` decimal(5,2) DEFAULT NULL,
  `back_rise` decimal(5,2) DEFAULT NULL,
  `pants_length` decimal(5,2) DEFAULT NULL,
  `jacket_length` decimal(5,2) DEFAULT NULL,
  `collar` decimal(5,2) DEFAULT NULL,
  `shorts_length` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `customer_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `final_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','card','transfer','other') NOT NULL DEFAULT 'cash',
  `payment_status` enum('paid','partial','pending') NOT NULL DEFAULT 'paid',
  `notes` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_sales`
--

CREATE TABLE `invoice_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notes` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_sales`
--

INSERT INTO `invoice_sales` (`id`, `sale_id`, `invoice_number`, `total_amount`, `issued_at`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(17, 26, 'INV-000026', 400.00, '2025-04-12 22:17:23', NULL, 1, '2025-04-12 22:17:23', '2025-04-12 22:17:23'),
(18, 27, 'INV-000027', 250.00, '2025-04-12 22:18:30', NULL, 1, '2025-04-12 22:18:30', '2025-04-12 22:18:30'),
(19, 28, 'INV-000028', 200.00, '2025-04-12 23:29:26', NULL, 1, '2025-04-12 23:29:26', '2025-04-12 23:29:26'),
(20, 29, 'INV-000029', 200.00, '2025-04-12 23:30:31', NULL, 1, '2025-04-12 23:30:31', '2025-04-12 23:30:31'),
(21, 30, 'INV-000030', 150.00, '2025-04-12 23:31:20', NULL, 1, '2025-04-12 23:31:20', '2025-04-12 23:31:20'),
(22, 31, 'INV-000031', 100.00, '2025-04-12 23:31:46', NULL, 1, '2025-04-12 23:31:46', '2025-04-12 23:31:46'),
(23, 32, 'INV-000032', 450.00, '2025-04-12 23:33:07', NULL, 1, '2025-04-12 23:33:07', '2025-04-12 23:33:07'),
(24, 33, 'INV-000033', 450.00, '2025-04-12 23:33:20', NULL, 1, '2025-04-12 23:33:20', '2025-04-12 23:33:20'),
(25, 34, 'INV-000034', 900.00, '2025-04-13 05:50:36', NULL, 1, '2025-04-13 05:50:36', '2025-04-13 05:50:36'),
(26, 35, 'INV-000035', 1750.00, '2025-04-13 06:31:26', NULL, 1, '2025-04-13 06:31:26', '2025-04-13 06:31:26'),
(27, 36, 'INV-000036', 4500.00, '2025-04-13 06:33:30', NULL, 1, '2025-04-13 06:33:30', '2025-04-13 06:33:30'),
(28, 37, 'INV-000037', 7150.00, '2025-04-13 14:48:52', NULL, 1, '2025-04-13 14:48:52', '2025-04-13 14:48:52');

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
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_type_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `composition` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `quality_grade` varchar(255) DEFAULT NULL,
  `stock_quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit` varchar(255) NOT NULL DEFAULT 'meter',
  `unit_price` decimal(10,2) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `reorder_level` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('in_stock','low_stock','out_of_stock','discontinued') NOT NULL DEFAULT 'in_stock',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `material_code`, `name`, `supplier_id`, `category_id`, `supplier_type_name`, `description`, `type`, `color`, `pattern`, `composition`, `width`, `weight`, `quality_grade`, `stock_quantity`, `unit`, `unit_price`, `cost_price`, `reorder_level`, `location`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ASD-123i', 'Whitish Black Thread', 4, NULL, 'thread', 'No description provided', 'Unknown', NULL, NULL, NULL, NULL, NULL, NULL, 12.00, '1123', 4432.00, 1233.00, 12.00, NULL, 'in_stock', 1, '2025-03-29 21:55:35', '2025-03-29 21:55:35'),
(2, 'MRTL-123', 'Fabrici 12 Blue', 4, NULL, 'fabric', 'No description provided', 'Unknown', NULL, NULL, NULL, NULL, NULL, NULL, 10.00, '123', 43.00, 43.00, 12.00, NULL, 'in_stock', 1, '2025-03-29 21:56:50', '2025-03-29 21:56:50');

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
(4, '2025_03_23_215324_create_customers_infos_table', 1),
(5, '2025_03_23_220336_create_customer_measurements_table', 1),
(6, '2025_03_23_220826_create_supplier_infos_table', 1),
(9, '2025_03_23_223552_create_invoice_and_sold_items_table', 2),
(12, '2025_03_24_041111_update_customer_infos_table_new_column_purchased_amount_amount_paid_balanace', 4),
(13, '2025_03_30_043500_create_supplier_types_table', 5),
(14, '2025_03_30_045226_fix_supplier_supplier_type_pivot_table', 6),
(15, '2025_03_23_224252_create_materials_table', 7),
(18, '2025_04_01_222353_create_sizes_table', 8),
(19, '2025_04_01_222520_create_product_size_table', 8),
(20, '2025_04_02_003430_create_product_types_table', 9),
(21, '2025_03_23_221602_create_category_products_table', 10),
(26, '2025_03_23_221751_create_products_table', 11),
(27, '2025_04_06_235543_create_sales_table', 12),
(28, '2025_04_06_235618_create_sale_items_table', 12),
(29, '2025_04_06_235728_create_invoice_sales_table', 12),
(30, '2025_04_06_235750_create_return_sales_table', 12),
(31, '2025_04_13_045436_add_custom_id_to_sales_table', 13),
(32, '2025_04_13_051305_add_payment_fields_to_sales_table', 14);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `stock_quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `unit` varchar(255) NOT NULL DEFAULT 'piece',
  `unit_price` decimal(10,2) NOT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `reorder_level` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('in_stock','low_stock','out_of_stock','discontinued') NOT NULL DEFAULT 'in_stock',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `product_type`, `supplier_id`, `description`, `stock_quantity`, `unit`, `unit_price`, `cost_price`, `color`, `size`, `material`, `brand`, `pattern`, `reorder_level`, `location`, `status`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PDC-100123', 'Company Uniform', 'Workwear Dresses', NULL, 'assfsdfsdfsdfsdf', 70.00, 'piece', 450.00, 470.00, 'White with Black', 'Medium', 'Unknown', 'Elvix', 'Plain', NULL, NULL, 'in_stock', 1, '2025-04-05 22:12:04', '2025-04-13 14:48:52'),
(2, 'PDC-100121', 'School MCA Uniform', NULL, 3, NULL, 1.00, 'piece', 200.00, 250.00, 'White Bluish', 'Small', 'Silk', 'Unknown', 'Stripes', NULL, NULL, 'low_stock', 1, '2025-04-05 22:42:21', '2025-04-13 14:48:52'),
(3, 'PDC-100111', 'White-Top-Shirt', NULL, 3, 'ASD', 5.00, 'piece', 100.00, 100.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'low_stock', 1, '2025-04-05 22:45:40', '2025-04-12 23:31:46'),
(4, 'PDC-100113', 'MCA Pant\'s', NULL, NULL, NULL, 6.00, 'piece', 150.00, 160.00, 'black bluish', 'meduim', NULL, NULL, NULL, NULL, NULL, 'low_stock', 1, '2025-04-05 22:51:38', '2025-04-12 23:31:20'),
(5, 'PDC-100120', 'MCA Blouse Kids', 'Workwear Dresses', 3, NULL, 1.00, 'piece', 200.00, 150.00, 'Light Blue', 'Small', NULL, NULL, NULL, NULL, NULL, 'low_stock', 1, '2025-04-05 23:01:02', '2025-04-12 22:05:37'),
(6, 'PDC-100100', 'OMSC Male Uniform', 'Workwear Dresses', 1, 'OMSC', 2.00, 'piece', 200.00, 205.00, 'white', 'small', 'unknown', 'Unknown', 'plain', NULL, NULL, 'low_stock', 1, '2025-04-05 23:07:00', '2025-04-12 22:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Casual Dresses v1.0', 'Comfortable and versatile dresses designed for everyday wear. These include sundresses, t-shirt dresses, and shift dresses made from breathable fabrics.', '2025-04-05 20:41:17', '2025-04-05 21:28:38'),
(3, 'Workwear Dresses', 'Professional and polished dresses designed for office or business settings, such as sheath dresses, wrap dresses, and shirt dresses.', '2025-04-05 20:50:42', '2025-04-05 20:50:42'),
(4, 'Party Dresses', 'Fun and stylish dresses perfect for celebrations, including mini dresses, sequined dresses, and bodycon styles.', '2025-04-05 20:54:13', '2025-04-05 20:54:13'),
(5, 'Traditional Dresses', 'Dresses inspired by cultural and traditional attire, such as kimonos, saris, or Filipinianas, crafted with intricate designs.', '2025-04-05 20:59:30', '2025-04-05 20:59:30'),
(6, 'Bridal Dresses', 'Beautiful and intricate dresses for brides, including wedding gowns, bridal party dresses, and reception dresses.', '2025-04-05 20:59:41', '2025-04-05 20:59:41'),
(7, 'Seasonal Dresses', 'Dresses designed for specific seasons, like lightweight summer dresses or cozy sweater dresses for colder months.', '2025-04-05 20:59:50', '2025-04-05 20:59:50'),
(8, 'Sando (Tank Tops)', 'Sleeveless shirts ideal for casual wear, gym attire, or layering.', '2025-04-05 21:01:07', '2025-04-05 21:01:07'),
(9, 'T-Shirts', 'Classic, versatile shirts with short sleeves, available in various styles like crew neck, V-neck, or graphic designs.', '2025-04-05 21:01:18', '2025-04-05 21:01:18'),
(10, 'Dress Shirts', 'Formal button-down shirts, often paired with suits or worn for professional settings.', '2025-04-05 21:01:28', '2025-04-05 21:01:28'),
(11, 'Polo Shirts', 'Short-sleeved shirts with a collared neck and button placket, combining casual and semi-formal looks.', '2025-04-05 21:01:36', '2025-04-05 21:01:36'),
(12, 'Long-Sleeve Shirts', 'Comfortable shirts with full-length sleeves, available in casual or formal styles.', '2025-04-05 21:01:47', '2025-04-05 21:01:47'),
(13, 'Jackets', 'Lightweight or heavy coats designed for style or protection from cold weather, such as denim jackets, bombers, or parkas.', '2025-04-05 21:01:55', '2025-04-05 21:01:55'),
(14, 'Blazers', 'Formal outerwear often worn over dress shirts for business or semi-formal events.', '2025-04-05 21:02:10', '2025-04-05 21:02:10'),
(15, 'Hoodies', 'Casual outerwear with a hood, great for lounging or layering.', '2025-04-05 21:02:16', '2025-04-05 21:02:16'),
(16, 'Cardigans', 'Open-front knitwear, perfect for adding warmth and style.', '2025-04-05 21:02:27', '2025-04-05 21:02:27'),
(17, 'Trousers', 'Formal or professional pants made from woven fabric, ideal for business or dressier occasions.', '2025-04-05 21:02:41', '2025-04-05 21:02:41'),
(19, 'Jeans', 'Durable and casual denim pants, available in various cuts like slim, bootcut, or straight.', '2025-04-05 21:03:19', '2025-04-05 21:03:19'),
(20, 'Shorts', 'Lightweight and comfortable bottoms, perfect for warm weather or athletic activities.', '2025-04-05 21:03:26', '2025-04-05 21:03:26'),
(21, 'Joggers', 'Relaxed-fit pants with an elastic waistband, great for leisure or exercise.', '2025-04-05 21:03:49', '2025-04-05 21:03:49'),
(22, 'Chinos', 'Semi-formal pants made from soft, cotton twill fabric, bridging the gap between casual and formal wear.', '2025-04-05 21:03:55', '2025-04-05 21:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `return_sales`
--

CREATE TABLE `return_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `processed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_id` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `change_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` enum('paid','unpaid','partial') NOT NULL DEFAULT 'unpaid',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `custom_id`, `customer_id`, `total_amount`, `amount_paid`, `change_due`, `balance`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(26, 'SALE-20250413-0002', 4, 400.00, 1000.00, 600.00, 0.00, 'paid', 1, '2025-04-12 22:17:23', '2025-04-12 22:17:23'),
(27, 'SALE-20250413-0003', 4, 250.00, 300.00, 50.00, 0.00, 'paid', 1, '2025-04-12 22:18:30', '2025-04-12 22:18:30'),
(28, 'SALE-20250413-0004', 2, 200.00, 100.00, 0.00, 100.00, 'partial', 1, '2025-04-12 23:29:26', '2025-04-12 23:29:26'),
(29, 'SALE-20250413-0005', 1, 200.00, 150.00, 0.00, 50.00, 'partial', 1, '2025-04-12 23:30:30', '2025-04-12 23:30:30'),
(30, 'SALE-20250413-0006', 2, 150.00, 100.00, 0.00, 50.00, 'partial', 1, '2025-04-12 23:31:20', '2025-04-12 23:31:20'),
(31, 'SALE-20250413-0007', 2, 100.00, 150.00, 50.00, 0.00, 'paid', 1, '2025-04-12 23:31:46', '2025-04-12 23:31:46'),
(32, 'SALE-20250413-0008', 2, 450.00, 150.00, 0.00, 300.00, 'partial', 1, '2025-04-12 23:33:07', '2025-04-12 23:33:07'),
(33, 'SALE-20250413-0009', 1, 450.00, 500.00, 50.00, 0.00, 'paid', 1, '2025-04-12 23:33:19', '2025-04-12 23:33:19'),
(34, 'SALE-20250413-0010', 1, 900.00, 1000.00, 100.00, 0.00, 'paid', 1, '2025-04-13 05:50:35', '2025-04-13 05:50:35'),
(35, 'SALE-20250413-0011', 4, 1750.00, 2000.00, 250.00, 0.00, 'paid', 1, '2025-04-13 06:31:25', '2025-04-13 06:31:25'),
(36, 'SALE-20250413-0012', 1, 4500.00, 5000.00, 500.00, 0.00, 'paid', 1, '2025-04-13 06:33:29', '2025-04-13 06:33:29'),
(37, 'SALE-20250413-0013', 1, 7150.00, 4000.00, 0.00, 3150.00, 'partial', 1, '2025-04-13 14:48:52', '2025-04-13 14:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `quantity`, `unit_price`, `subtotal`, `status`, `created_at`, `updated_at`) VALUES
(24, 26, 6, 2, 200.00, 400.00, 1, '2025-04-12 22:17:23', '2025-04-12 22:17:23'),
(25, 27, 4, 1, 150.00, 150.00, 1, '2025-04-12 22:18:30', '2025-04-12 22:18:30'),
(26, 27, 3, 1, 100.00, 100.00, 1, '2025-04-12 22:18:30', '2025-04-12 22:18:30'),
(27, 28, 2, 1, 200.00, 200.00, 1, '2025-04-12 23:29:26', '2025-04-12 23:29:26'),
(28, 29, 2, 1, 200.00, 200.00, 1, '2025-04-12 23:30:30', '2025-04-12 23:30:30'),
(29, 30, 4, 1, 150.00, 150.00, 1, '2025-04-12 23:31:20', '2025-04-12 23:31:20'),
(30, 31, 3, 1, 100.00, 100.00, 1, '2025-04-12 23:31:46', '2025-04-12 23:31:46'),
(31, 32, 1, 1, 450.00, 450.00, 1, '2025-04-12 23:33:07', '2025-04-12 23:33:07'),
(32, 33, 1, 1, 450.00, 450.00, 1, '2025-04-12 23:33:19', '2025-04-12 23:33:19'),
(33, 34, 1, 2, 450.00, 900.00, 1, '2025-04-13 05:50:35', '2025-04-13 05:50:35'),
(34, 35, 1, 3, 450.00, 1350.00, 1, '2025-04-13 06:31:25', '2025-04-13 06:31:25'),
(35, 35, 2, 2, 200.00, 400.00, 1, '2025-04-13 06:31:25', '2025-04-13 06:31:25'),
(36, 36, 1, 10, 450.00, 4500.00, 1, '2025-04-13 06:33:29', '2025-04-13 06:33:29'),
(37, 37, 2, 2, 200.00, 400.00, 1, '2025-04-13 14:48:52', '2025-04-13 14:48:52'),
(38, 37, 1, 15, 450.00, 6750.00, 1, '2025-04-13 14:48:52', '2025-04-13 14:48:52');

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
('DE8uauQleuKhZvd1MoG3YrBofktm6zRh1uYydyWC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieEJ4SWhnWUkxQ2dUekpPZjAwODdPTHUxSmtCalRBWFhraVlROEVYSSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjk0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVwb3J0cy9zYWxlcz9kYXRlX2Zyb209JmRhdGVfdG89Jmludm9pY2Vfc3RhdHVzPSZwYXltZW50X3N0YXR1cz1wYXJ0aWFsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1744592633),
('NeOvgsQwwskihbFEvyPupUbWJiMLp66FE2Z1Jh8B', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjdCcnpVdlViSFlabmJ6RTA5ekxlSzJJSkpiODFuSHRob2xiN005RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3QvJWUyJTgwJWEyJTIwT3RoZXItUHJvamVjdHMlMjAlZTIlODAlYTIvYm1zX3RhaWxvci9wdWJsaWMvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1744596004);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sold_items`
--

CREATE TABLE `sold_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `item_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_infos`
--

CREATE TABLE `supplier_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `tin` varchar(255) DEFAULT NULL,
  `supplier_type` enum('fabric','accessories','thread','buttons','zippers','equipment','other') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_infos`
--

INSERT INTO `supplier_infos` (`id`, `supplier_id`, `name`, `contact_person`, `email`, `phone`, `address`, `city`, `province`, `tin`, `supplier_type`, `is_active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'SUP-YC0VMR', 'Dei Comp', 'Dei Ru', 'dei.comp@example.com', '09123456789', 'Bahayan San Jose', 'San Jose', 'Occidental Mindoro', '0123', 'buttons', 1, 'nothing in my company', '2025-03-24 00:54:58', '2025-03-24 03:08:00'),
(2, 'SUP-FDVXCT', 'Dei Ru Comps', 'Dale D', NULL, '0987654321', 'Bagong Sikat', 'San Jose', 'Occidental Mindoro', '5100', 'equipment', 1, 'Sewing Equipments', '2025-03-24 01:01:08', '2025-03-24 01:01:08'),
(3, 'SUP-NYQVHX', 'Julian Company', 'Julian Bernard', NULL, '091234567', 'San Jose', 'San Jose', 'Occidental Mindoro', '5100', 'accessories', 1, 'Hand Made, D.I.Y\'s, Designs', '2025-03-24 01:04:30', '2025-03-24 01:04:30'),
(4, 'SUP-CSTY7N', 'ASD', 'ASD', 'asdsadasdasd@gmail.com', 'asd asd sa', 'ASD', 'ASD', 'ASD', 'asd123', 'fabric', 1, NULL, '2025-03-29 21:01:09', '2025-03-29 21:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_supplier_type`
--

CREATE TABLE `supplier_supplier_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_supplier_type`
--

INSERT INTO `supplier_supplier_type` (`id`, `supplier_id`, `supplier_type_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL),
(2, 4, 3, NULL, NULL),
(4, 3, 1, NULL, NULL),
(5, 3, 2, NULL, NULL),
(6, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_types`
--

CREATE TABLE `supplier_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_types`
--

INSERT INTO `supplier_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'fabric', '2025-03-29 20:43:57', '2025-03-29 20:43:57'),
(2, 'accessories', '2025-03-29 20:43:57', '2025-03-29 20:43:57'),
(3, 'thread', '2025-03-29 20:43:57', '2025-03-29 20:43:57'),
(4, 'buttons', '2025-03-29 20:43:57', '2025-03-29 20:43:57'),
(5, 'zippers', '2025-03-29 20:43:57', '2025-03-29 20:43:57'),
(6, 'equipment', '2025-03-29 20:43:57', '2025-03-29 20:43:57'),
(7, 'other', '2025-03-29 20:43:57', '2025-03-29 20:43:57');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dei Ru', 'deiru@example.com', NULL, '$2y$12$uIsmpefJSw2ULq475PNzo.zGPv6erkrv1C4N.Aj9q3v6UQH2hlemG', NULL, '2025-03-23 15:01:58', '2025-03-23 15:01:58'),
(2, 'Test User', 'test@example.com', '2025-03-29 20:43:57', '$2y$12$nO4GPkiHJ70SBTr8m/qDseBYDNACM6xppL2.yNQY6Bm4nNeSozWmO', '2tA62S4WqU', '2025-03-29 20:43:57', '2025-03-29 20:43:57');

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
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_products_slug_unique` (`slug`),
  ADD KEY `category_products_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `customers_infos`
--
ALTER TABLE `customers_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_infos_customer_id_unique` (`customer_id`);

--
-- Indexes for table `customer_measurements`
--
ALTER TABLE `customer_measurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_measurements_customer_info_id_foreign` (`customer_info_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_customer_info_id_foreign` (`customer_info_id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoice_sales`
--
ALTER TABLE `invoice_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_sales_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoice_sales_sale_id_foreign` (`sale_id`);

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
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `materials_material_code_unique` (`material_code`),
  ADD KEY `materials_supplier_id_foreign` (`supplier_id`),
  ADD KEY `materials_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_types_name_unique` (`name`);

--
-- Indexes for table `return_sales`
--
ALTER TABLE `return_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_sales_sale_id_foreign` (`sale_id`),
  ADD KEY `return_sales_product_id_foreign` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_custom_id_unique` (`custom_id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold_items`
--
ALTER TABLE `sold_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sold_items_invoice_id_product_id_unique` (`invoice_id`,`product_id`),
  ADD KEY `sold_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `supplier_infos`
--
ALTER TABLE `supplier_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_infos_supplier_id_unique` (`supplier_id`);

--
-- Indexes for table `supplier_supplier_type`
--
ALTER TABLE `supplier_supplier_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_supplier_type_supplier_id_foreign` (`supplier_id`),
  ADD KEY `supplier_supplier_type_supplier_type_id_foreign` (`supplier_type_id`);

--
-- Indexes for table `supplier_types`
--
ALTER TABLE `supplier_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_types_name_unique` (`name`);

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
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers_infos`
--
ALTER TABLE `customers_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_measurements`
--
ALTER TABLE `customer_measurements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_sales`
--
ALTER TABLE `invoice_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `return_sales`
--
ALTER TABLE `return_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sold_items`
--
ALTER TABLE `sold_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_infos`
--
ALTER TABLE `supplier_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier_supplier_type`
--
ALTER TABLE `supplier_supplier_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier_types`
--
ALTER TABLE `supplier_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_products`
--
ALTER TABLE `category_products`
  ADD CONSTRAINT `category_products_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `category_products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `customer_measurements`
--
ALTER TABLE `customer_measurements`
  ADD CONSTRAINT `customer_measurements_customer_info_id_foreign` FOREIGN KEY (`customer_info_id`) REFERENCES `customers_infos` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_info_id_foreign` FOREIGN KEY (`customer_info_id`) REFERENCES `customers_infos` (`id`),
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_sales`
--
ALTER TABLE `invoice_sales`
  ADD CONSTRAINT `invoice_sales_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category_products` (`id`),
  ADD CONSTRAINT `materials_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_infos` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_infos` (`id`);

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_sales`
--
ALTER TABLE `return_sales`
  ADD CONSTRAINT `return_sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_sales_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers_infos` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sold_items`
--
ALTER TABLE `sold_items`
  ADD CONSTRAINT `sold_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sold_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `supplier_supplier_type`
--
ALTER TABLE `supplier_supplier_type`
  ADD CONSTRAINT `supplier_supplier_type_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_infos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplier_supplier_type_supplier_type_id_foreign` FOREIGN KEY (`supplier_type_id`) REFERENCES `supplier_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
