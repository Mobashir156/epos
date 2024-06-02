-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 06:47 AM
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
-- Database: `epos`
--

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`) VALUES
(1, 'Sundarban'),
(2, 'Redx'),
(3, 'Janani');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `balance` decimal(11,2) NOT NULL DEFAULT 0.00,
  `due` decimal(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `balance`, `due`) VALUES
(1, 'Rahim', '0123456789', 0.00, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `buy_rate` decimal(11,2) NOT NULL,
  `retail_price` decimal(11,2) NOT NULL,
  `whole_price` decimal(11,2) NOT NULL,
  `opening` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `pname`, `category_id`, `unit`, `buy_rate`, `retail_price`, `whole_price`, `opening`, `image`) VALUES
(2, '1716783719192', 'Rice', 1, 'KG', 50.00, 55.00, 52.00, '10', 'uploads/2600728.jpg'),
(3, '1716784805022', 'Master Oil', 2, 'KG', 55.00, 60.00, 57.00, '20', 'uploads/best-and-worst-oils-for-your-health-1440x810.jpg'),
(4, '1716798095145', 'Meat', 2, 'KG', 700.00, 650.00, 650.00, '20', 'uploads/2600728.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `d_ate` date NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `sub_total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `commission` decimal(11,2) NOT NULL DEFAULT 0.00,
  `shipping` decimal(11,2) NOT NULL DEFAULT 0.00,
  `paid` decimal(11,2) NOT NULL DEFAULT 0.00,
  `due` decimal(11,2) NOT NULL DEFAULT 0.00,
  `comment` varchar(350) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `exp_date` date NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL DEFAULT 1,
  `payable` decimal(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `d_ate`, `invoice_no`, `supplier_id`, `sub_total`, `total`, `commission`, `shipping`, `paid`, `due`, `comment`, `product_id`, `exp_date`, `qty`, `payable`) VALUES
(4, '0000-00-00', '55115', 1, 50.00, 51.00, 0.00, 1.00, 100.00, 51.00, 'jj', 1, '0000-00-00', 1, 0.00),
(5, '0000-00-00', '55115', 1, 50.00, 51.00, 0.00, 1.00, 100.00, 51.00, 'jj', 2, '2024-05-29', 1, 0.00),
(6, '0000-00-00', '55115', 1, 750.00, 751.00, 0.00, 1.00, 800.00, 51.00, 'jj', 2, '2024-05-29', 1, 0.00),
(7, '0000-00-00', '55115', 1, 750.00, 751.00, 0.00, 1.00, 800.00, 51.00, 'jj', 4, '2024-05-29', 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` decimal(11,2) NOT NULL,
  `discount` decimal(11,2) NOT NULL DEFAULT 0.00,
  `shipping` decimal(11,2) NOT NULL DEFAULT 0.00,
  `c_paid` decimal(11,2) NOT NULL DEFAULT 0.00,
  `due` decimal(11,2) NOT NULL DEFAULT 0.00,
  `sales_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=complete,2=draft',
  `remark` varchar(255) DEFAULT NULL,
  `total` decimal(11,2) NOT NULL DEFAULT 0.00,
  `salesman` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `barcode`, `pname`, `user_id`, `qty`, `price`, `discount`, `shipping`, `c_paid`, `due`, `sales_id`, `status`, `remark`, `total`, `salesman`, `product_id`, `courier_id`) VALUES
(1, '1716798095145', 'Meat', 1, 1, 650.00, 2.00, 50.00, 753.00, 0.00, 1, 1, '', 7.00, 0, 4, 1),
(2, '1716783719192', 'Rice', 1, 1, 55.00, 2.00, 50.00, 753.00, 0.00, 1, 1, '', 5.00, 0, 2, 1),
(3, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 55.00, 0.00, 2, 1, 'check', 5.00, 0, 2, 1),
(4, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 55.00, 0.00, 3, 1, 'check', 5.00, 0, 2, 1),
(5, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 65.00, 0.00, 4, 1, 'test', 5.00, 0, 2, 1),
(6, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 65.00, 0.00, 5, 1, 'test', 5.00, 0, 2, 1),
(7, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 65.00, 0.00, 6, 1, 'test', 5.00, 0, 2, 1),
(8, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 705.00, 0.00, 7, 1, 'test', 7.00, 0, 2, 1),
(9, '1716798095145', 'Meat', 1, 1, 650.00, 0.00, 0.00, 705.00, 0.00, 7, 1, 'test', 0.00, 0, 4, 1),
(10, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 605.00, 100.00, 8, 1, 'test', 7.00, 0, 2, 1),
(11, '1716798095145', 'Meat', 1, 1, 650.00, 0.00, 0.00, 605.00, 100.00, 8, 1, 'test', 0.00, 0, 4, 1),
(12, '1716783719192', 'Rice', 1, 1, 55.00, 0.00, 0.00, 605.00, 200.00, 9, 2, 'test', 7.00, 0, 2, 1),
(13, '1716798095145', 'Meat', 1, 1, 650.00, 0.00, 0.00, 605.00, 200.00, 9, 2, 'test', 0.00, 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `due` decimal(11,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `due`) VALUES
(1, 'MD Mehedi Hasan', 100.00),
(2, 'Rony Hasan', 90.00),
(3, 'Fahim', 0.00),
(4, 'Rana Sheikh', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
