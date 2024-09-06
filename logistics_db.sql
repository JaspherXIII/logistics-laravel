-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 04:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `for` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `for`, `email`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Warehouse', 'tatawoj@mailinator.com', '+1 (563) 281-96482', 'Volu4535', '2024-09-02 04:32:20', '2024-09-06 02:51:16'),
(2, 'Store', 'store@gmail.com', '123123123123', '#1 akldklasjkajd', '2024-09-03 12:17:26', '2024-09-05 16:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryreceipts`
--

CREATE TABLE `deliveryreceipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deliveryreceipt_no` varchar(255) NOT NULL,
  `picklist_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drproducts`
--

CREATE TABLE `drproducts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deliveryreceipt_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `product_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('Active','Inactive','Delisted') NOT NULL DEFAULT 'Active',
  `incoming` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `quantity`, `price`, `status`, `incoming`, `created_at`, `updated_at`) VALUES
(10, 6, '189', '150.00', 'Active', '26', '2024-09-05 17:20:42', '2024-09-06 06:39:06'),
(11, 5, '1', '200.00', 'Active', '13', '2024-09-05 20:52:30', '2024-09-06 06:39:06'),
(12, 4, '200', '105.00', 'Inactive', '266', '2024-09-06 03:38:25', '2024-09-06 06:39:06'),
(13, 7, '201', '180.00', 'Inactive', '12', '2024-09-06 03:38:25', '2024-09-06 12:14:14'),
(14, 8, '27', '5000.00', 'Active', '11', '2024-09-06 03:44:02', '2024-09-06 09:54:07'),
(15, 9, '20', '8000.00', 'Inactive', '12', '2024-09-06 03:44:02', '2024-09-06 09:52:50');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_09_02_061303_create_suppliers_table', 1),
(7, '2024_09_02_082657_create_products_table', 1),
(8, '2024_09_02_091835_modify_products_table', 2),
(9, '2024_09_02_114445_create_addresses_table', 3),
(10, '2024_09_02_114741_create_orders_table', 4),
(11, '2024_09_02_115227_create_orderproducts_table', 5),
(12, '2024_09_02_161031_modify_orders_table', 6),
(13, '2024_09_02_180610_create_receivestocks_table', 7),
(14, '2024_09_03_041610_create_inventories_table', 8),
(15, '2024_09_03_084914_create_picklists_table', 9),
(16, '2024_09_03_120608_modify_addresses_table', 10),
(17, '2024_09_03_122054_create_picklistproducts_table', 11),
(18, '2024_09_03_142522_create_deliveryreceipts_table', 12),
(19, '2024_09_03_170441_create_returnlists_table', 13),
(20, '2024_09_04_072555_modify_returnlist_table', 14),
(21, '2024_09_04_171629_create_drproducts_table', 15),
(22, '2024_09_04_172142_modify_drproducts_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderproducts`
--

INSERT INTO `orderproducts` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(80, 58, 4, 1, '2024-09-06 06:39:06', '2024-09-06 06:39:06'),
(81, 58, 5, 3, '2024-09-06 06:39:06', '2024-09-06 06:39:06'),
(82, 58, 6, 4, '2024-09-06 06:39:06', '2024-09-06 06:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_no` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'To Deliver',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `supplier_id`, `address_id`, `purchase_order_no`, `status`, `created_at`, `updated_at`) VALUES
(58, 3, 1, 'PO-0001', 'To Deliver', '2024-09-06 06:39:06', '2024-09-06 06:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picklistproducts`
--

CREATE TABLE `picklistproducts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picklist_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picklists`
--

CREATE TABLE `picklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picklist_no` varchar(255) NOT NULL,
  `order_from` varchar(255) NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `unit`, `image`, `price`, `supplier_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Milo 24g / 12’s', 'Dry Goods', 'SCK', 'businesses/images/image_1725449632.jpg', '105.00', 3, 'Active', '2024-09-04 03:33:52', '2024-09-04 07:45:14'),
(5, 'C2 Solo Apple 230 ml 6s', 'Beverage', 'BXS', 'businesses/images/image_1725450571.png', '200.00', 3, 'Active', '2024-09-04 03:49:31', '2024-09-04 07:45:14'),
(6, 'Dutchmill Yoghurt Strawberry 90ml', 'Beverage', 'BXS', 'businesses/images/image_1725452438.jpg', '150.00', 3, 'Inactive', '2024-09-04 04:20:38', '2024-09-06 02:40:07'),
(7, 'Coke Regular Mismo', 'Beverage', 'SCK', 'businesses/images/image_1725452543.jpg', '180.00', 3, 'Active', '2024-09-04 04:22:23', '2024-09-04 07:45:14'),
(8, 'Delicious Crispy Honey-glazed flakes', 'Dry Goods', 'BXS', 'businesses/images/image_1725552360.png', '5000.00', 4, 'Active', '2024-09-05 16:06:00', '2024-09-05 16:06:00'),
(9, 'Modess all night wing 4s', 'Dry Goods', 'BXS', 'businesses/images/image_1725552848.jpg', '8000.00', 4, 'Active', '2024-09-05 16:14:08', '2024-09-05 16:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `receivestocks`
--

CREATE TABLE `receivestocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `receive_purchase_no` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returnlists`
--

CREATE TABLE `returnlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `return_purchase_order_no` varchar(255) NOT NULL,
  `shipping_date` date NOT NULL,
  `return_note` text NOT NULL,
  `status` enum('In Transit','Returned') NOT NULL DEFAULT 'In Transit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Mark Jaspher Juan', 'mjdesigns2023@gmail.com', '09499761196', 'Victory Sur', 'Active', '2024-09-04 03:27:26', '2024-09-05 14:43:32'),
(4, 'ck', 'k@gmail.com', '098281928891', 'hegydsbsk', 'Active', '2024-09-05 15:50:57', '2024-09-05 15:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(1) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `picture`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Manager', 'avatar.png', 'manager@gmail.com', 1, NULL, '$2y$12$Tf.V99HFJVTfABI6IRVxB.jTXfgmFBUVhpQEPbKLFrqs./oo9vZka', NULL, '2024-09-02 08:37:19', '2024-09-02 08:37:19', NULL),
(2, 'Clerk', 'avatar.png', 'clerk@gmail.com', 2, NULL, '$2y$12$Tf.V99HFJVTfABI6IRVxB.jTXfgmFBUVhpQEPbKLFrqs./oo9vZka', NULL, '2024-09-02 08:37:19', '2024-09-02 08:37:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryreceipts`
--
ALTER TABLE `deliveryreceipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveryreceipts_picklist_id_foreign` (`picklist_id`);

--
-- Indexes for table `drproducts`
--
ALTER TABLE `drproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drproducts_deliveryreceipt_id_foreign` (`deliveryreceipt_id`),
  ADD KEY `drproducts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_receivestock_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderproducts_order_id_foreign` (`order_id`),
  ADD KEY `orderproducts_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_address_id_foreign` (`address_id`),
  ADD KEY `orders_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `picklistproducts`
--
ALTER TABLE `picklistproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `picklistproducts_picklist_id_foreign` (`picklist_id`),
  ADD KEY `picklistproducts_product_id_foreign` (`product_id`);

--
-- Indexes for table `picklists`
--
ALTER TABLE `picklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `picklists_address_id_foreign` (`address_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `receivestocks`
--
ALTER TABLE `receivestocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receivestocks_order_id_foreign` (`order_id`);

--
-- Indexes for table `returnlists`
--
ALTER TABLE `returnlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returnlists_address_id_foreign` (`address_id`),
  ADD KEY `returnlists_order_id_foreign` (`order_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deliveryreceipts`
--
ALTER TABLE `deliveryreceipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `drproducts`
--
ALTER TABLE `drproducts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `picklistproducts`
--
ALTER TABLE `picklistproducts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `picklists`
--
ALTER TABLE `picklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receivestocks`
--
ALTER TABLE `receivestocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `returnlists`
--
ALTER TABLE `returnlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliveryreceipts`
--
ALTER TABLE `deliveryreceipts`
  ADD CONSTRAINT `deliveryreceipts_picklist_id_foreign` FOREIGN KEY (`picklist_id`) REFERENCES `picklists` (`id`);

--
-- Constraints for table `drproducts`
--
ALTER TABLE `drproducts`
  ADD CONSTRAINT `drproducts_deliveryreceipt_id_foreign` FOREIGN KEY (`deliveryreceipt_id`) REFERENCES `deliveryreceipts` (`id`),
  ADD CONSTRAINT `drproducts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_receivestock_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `orderproducts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderproducts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `picklistproducts`
--
ALTER TABLE `picklistproducts`
  ADD CONSTRAINT `picklistproducts_picklist_id_foreign` FOREIGN KEY (`picklist_id`) REFERENCES `picklists` (`id`),
  ADD CONSTRAINT `picklistproducts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `picklists`
--
ALTER TABLE `picklists`
  ADD CONSTRAINT `picklists_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `receivestocks`
--
ALTER TABLE `receivestocks`
  ADD CONSTRAINT `receivestocks_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `returnlists`
--
ALTER TABLE `returnlists`
  ADD CONSTRAINT `returnlists_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `returnlists_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
