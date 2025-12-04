-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 08:35 AM
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
-- Database: `budget_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount_limit` decimal(15,2) NOT NULL,
  `month_year` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `category_id`, `amount_limit`, `month_year`) VALUES
(3, 7, 95000.00, '2025-12'),
(4, 5, 1000000.00, '2025-12'),
(6, 4, 1002500.00, '2025-12'),
(7, 8, 150000.00, '2025-12'),
(8, 9, 45000.00, '2025-12'),
(9, 10, 150000.00, '2025-12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` enum('income','expense') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`) VALUES
(2, 'Kiriman Orang Tua', 'income'),
(4, 'Kost', 'expense'),
(5, 'Makan', 'expense'),
(6, 'Freelance', 'income'),
(7, 'Laundry', 'expense'),
(8, 'Transportasi', 'expense'),
(9, 'Air Galon', 'expense'),
(10, 'Refreshing', 'expense'),
(11, 'Hujan Uang', 'income'),
(12, 'Kuota Internet', 'expense');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `wallet_id`, `category_id`, `amount`, `description`, `transaction_date`, `created_at`) VALUES
(1, 6, 2, 125000.00, 'Kiriman tambahan dari orang tua karena perlu beli rak sepatu', '2025-12-03', '2025-12-03 18:23:50'),
(4, 8, 4, 1002500.00, 'Bayar sewa kost bulan Desember', '2025-12-04', '2025-12-03 18:41:50'),
(5, 8, 6, 675000.00, 'Alhamdulillah yah', '2025-12-03', '2025-12-03 19:38:06'),
(6, 9, 5, 23600.00, 'Makan sama beli es krim', '2025-12-01', '2025-12-03 19:39:24'),
(7, 6, 8, 12000.00, 'Naik gojek kemana ya kepo deh', '2025-12-02', '2025-12-03 19:39:52'),
(8, 8, 8, 130000.00, 'Beli tiket travel sama gojek', '2025-12-02', '2025-12-03 19:40:30'),
(9, 8, 5, 49000.00, 'Makan siang di luar jadi boncos lol', '2025-12-02', '2025-12-03 19:42:35'),
(10, 8, 10, 124000.00, 'Main hohohoho', '2025-12-01', '2025-12-03 19:54:41'),
(11, 8, 10, 39400.00, 'hehe main bentar', '2025-12-02', '2025-12-03 19:55:11'),
(12, 8, 11, 50000000.00, 'trimakasih pak jokowi', '2025-12-03', '2025-12-03 20:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `initial_balance` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `name`, `initial_balance`, `created_at`) VALUES
(6, 'Dana', 76650.00, '2025-12-03 16:33:12'),
(8, 'BCA', 2493000.00, '2025-12-03 18:41:01'),
(9, 'Gopay', 86900.00, '2025-12-03 19:36:28'),
(10, 'ShopeePay', 34200.00, '2025-12-03 19:36:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_id` (`wallet_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
