-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 05:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `product image` varchar(30) NOT NULL,
  `product name` varchar(30) NOT NULL,
  `auction time` datetime NOT NULL,
  `product price` varchar(30) NOT NULL,
  `product description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `product image`, `product name`, `auction time`, `product price`, `product description`) VALUES
(21, 'auction-1.jpg', 'Nissan GT 2023', '2023-07-13 19:50:00', '4,50,000', 'Nissan description '),
(22, 'auction-3.jpg', '2019 Mercedees Benz,E', '2023-08-25 20:03:00', '4,50,000', 'GT Neo 55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` int(100) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `email_address`, `password`) VALUES
(1, 'Tyrone', 'David', 1, 'Magni in aute facili', 'kafycy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(2, '', '', 98989898, '', '', 'Pa$$w0rd!'),
(3, 'Eagan', 'Fox', 2147483647, 'Repellendus Atque c', 'tivaf@mailinator.com', 'Pa$$w0rd!'),
(4, 'Felicia', 'Maynard', 945, 'Qui consequatur Vel', 'favujo@mailinator.com', 'Pa$$w0rd!'),
(5, 'Jamalia', 'Hatfield', 940, 'Architecto velit con', 'decugagyby@mailinator.com', 'Pa$$w0rd!7878787878'),
(6, 'Geoffrey', 'Witt', 683, 'Necessitatibus enim ', 'jylogepo@mailinator.com', 'Pa$$w0rd!123'),
(7, 'Hamish', 'Gill', 325, 'Sint cupiditate enim', 'kinarojur@mailinator.com', 'Pa$$w0rd!'),
(8, 'Nash', 'Hobbs', 2147483647, 'Ad qui qui dolore fa', 'patusel@mailinator.com', 'Pa$$w0rd!'),
(10, 'Jolene', 'Clemons', 629, 'Mollitia ut nesciunt', 'jozenix@mailinator.com', '$2y$10$DbMnMz4OkJ9ziQ/NiCdSqewf89qB9bTKwFpegl6UjSniXi47VOZVi'),
(11, 'pragya', 'kayastha', 2147483647, 'banepa', 'pragya@gmail.com', 'd4dc86f22f862cfd6afbe8f412f9c956'),
(12, 'pragya', 'kayastha', 87788, 'banepa', 'pragya@gmail.com', '$2y$10$5HdDyZPoEHhvyXqtCtcGEetMuMszYU2zxtHWO4Zym19zIkkVm00A6'),
(13, 'pragya', 'kayastha', 8878, 'Incidunt laborum re', 'pragya1@gmail.com', '$2y$10$oAsckDM3EmeJ9oVYvdzeQOh/bEQov4C1ZKeRSw7gViZVCHn7QTCoO'),
(14, 'pragya', 'kayastha', 887, 'banepa', 'pragya2@gmail.com', '$2y$10$6.K5XilbrBR6EnGxCnUBS.Vm9CaKp8pFGNFJmTNs907SenAv11jQC'),
(15, 'Hadassah', 'Alston', 866, 'Ratione vel totam au', 'bamyle@mailinator.com', '$2y$10$Eqr7ia17e7x2t/Bo5K7ygOOhDniIi0o3OCK5xh0lNakZ4A6EBX7VO'),
(16, 'sdf', 'fsf', 123, 'fsd', 'sdf@gmail.com', '$2y$10$ruKSutRQeAOLCL0hpxd7CewWjFqqy2HLi.yZfXpGIflsDH2nwrsem'),
(17, 'pragya', 'kayastha', 983567288, 'banepa', 'pragyakayastha56@gmail.com', '$2y$10$5tR7D1bj82u7UisuW.iqn.VwzRbv1gShKeE22KEKMsVQ/5nkhGhvW'),
(18, 'pragya', 'kayastha', 777, 'banepa', 'test@gmail.com', '$2y$10$..ZZnp8LYksPNe1mlb1WJeVYU46S4IDBESwa9mw9EtmnZF2SbxpJi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
