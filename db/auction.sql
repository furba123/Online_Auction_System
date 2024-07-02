-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 03:29 PM
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
-- Table structure for table `bid_products`
--

CREATE TABLE `bid_products` (
  `SN` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `bid_products` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bid_products`
--

INSERT INTO `bid_products` (`SN`, `user_id`, `bid_products`) VALUES
(1, 33, 'a:2:{i:62;s:7:\"1000017\";i:58;s:5:\"60000\";}'),
(5, 34, 'a:1:{i:58;s:5:\"65000\";}'),
(6, 42, 'a:5:{i:66;s:5:\"80000\";i:65;s:5:\"60000\";i:67;s:2:\"90\";i:69;s:3:\"200\";i:58;s:5:\"80000\";}'),
(7, 30, 'a:1:{i:65;s:5:\"50000\";}'),
(8, 41, 'a:2:{i:65;s:5:\"50002\";i:58;s:5:\"70000\";}'),
(9, 40, 'a:1:{i:66;s:6:\"100000\";}'),
(10, 45, 'a:1:{i:70;s:4:\"2000\";}'),
(11, 47, 'a:1:{i:71;s:5:\"12000\";}');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `first_name`, `last_name`, `email`, `subject`, `message`) VALUES
(8, 'pragya', 'kayastha', 'pragya@gmail.com', 'want to be a seller', 'please reply'),
(16, 'Samantha', 'Pittman', 'cyvyzuky@mailinator.com', 'Ipsa molestiae hic ', 'Sapiente qui est aut'),
(17, 'Idona', 'Richmond', 'sapoxe@mailinator.com', 'Magna culpa et cupid', 'Sed provident eos c');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_image` tinyblob NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `auction_time` datetime NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `starting_bid` bigint(20) NOT NULL,
  `highest_bid` bigint(20) DEFAULT NULL,
  `highest_bid_user_id` bigint(20) DEFAULT NULL,
  `product_description` varchar(255) NOT NULL,
  `created_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_image`, `product_name`, `auction_time`, `product_price`, `starting_bid`, `highest_bid`, `highest_bid_user_id`, `product_description`, `created_by`) VALUES
(56, 0x61756374696f6e2d322e6a7067, '2018 Nissan Versa,T', '2023-07-27 14:05:00', '9,50,000', 30000, 60000, 34, 'The 2018 Nissan Versa S is a compact sedan known for its affordability, fuel efficiency, and practicality. It offers a comfortable interior, a decent amount of cargo space, and a straightforward design. The Versa S is often favored for its affordability a', NULL),
(57, 0x61756374696f6e2d332e6a7067, '2018 Honda Accord, Sport', '2023-07-23 16:07:00', '32,00,000', 1000000, 1000005, 33, 'The 2018 Honda Accord Sport is a midsize sedan that offers a balance of performance, comfort, and practicality. It features a stylish exterior design, a refined and spacious interior, and a range of advanced technology and safety features. The Accord Spor', NULL),
(58, 0x6c6164792e6a7067, ' Vintage rolex', '2023-08-05 15:22:00', '3,00,000', 50000, 80000, 42, 'The Rolex Datejust, which has been a popular and iconic watch model since its introduction in 1945. The Datejust is known for its timeless design, precision, and durability. It features a classic round case, typically made of stainless steel or precious m', NULL),
(59, 0x6469616d6f6e642e6a7067, 'Retro diamond', '2023-07-18 15:24:00', '9,00,000', 60000, 0, NULL, 'Retro refers to a design style popular during the 1940s and 1950s. It emerged after World War II and was characterized by bold and glamorous designs. Retro diamond jewelry often features large, chunky designs with colorful gemstones, including diamonds, a', NULL),
(62, 0xe0a5a8e0a5a6e0a5a7e0a5ae20e0a4a6e0a58be0a4a6e0a58de0a497e0a58720e0a497e0a58de0a4b0e0a4bee0a4a8e0a58de0a4a12c205378742e706e67, '2018 Dodge Grand, Sxt', '2023-08-15 10:24:00', '28,00,000', 90000, 1000017, 33, 'The 2018 Dodge Grand Caravan SXT is a minivan that offers seating for up to seven passengers. It is known for its versatile interior space, comfortable ride, and family-friendly features. ', NULL),
(64, 0x3078302e6a7067, 'Jaguar 2023', '2023-07-27 20:43:00', '200000', 50000, NULL, NULL, 'Sports cars are motorized vehicles, either combustion or electrically powered, that are engineered to deliver superior driving dynamics through enhanced handling and performance. Some people mistakably consider all road going “sports cars” to be the same,', NULL),
(65, 0x62616a616a2070756c7361722e6a7067, 'Bajaj Pulsar', '2023-08-06 20:17:00', '1,50,000', 50, 60000, 42, 'The Bajaj Pulsar is a popular range of motorcycles offered by Bajaj Auto, an Indian two-wheeler manufacturer. The Pulsar series is known for its sporty design, performance, and reliability. ', NULL),
(66, 0x726f73652d676f6c642d77617463682d666f722d776f6d656e2e6a7067, 'Rose gold watch', '2023-07-30 10:25:00', '80,000', 30, 100000, 40, 'A rose gold watch is a type of timepiece that features a rose or pinkish-gold hue in its casing and often the bracelet or strap. Rose gold is an alloy of gold and copper, which gives it the distinctive warm and rosy color. It has become a popular choice f', NULL),
(67, 0x706f72736368652e706e67, 'Porsche 911', '2023-08-20 09:25:00', '2,00,000', 80, 90, 42, 'The Porsche 911 is an iconic sports car known for its timeless design, powerful performance, and rear-engine layout. It comes in various trim levels, offering different engine options and performance capabilities.', NULL),
(69, 0x686f6e64612063697669632e6a7067, 'Honda civic', '2023-08-01 20:35:00', '1,50,000', 80, 200, 42, 'The Honda Civic is a popular compact car known for its reliability, fuel efficiency, and practicality. It has been one of Hondas most successful and long-standing models, offering a comfortable ride and a range of features to suit various preferences. ', NULL),
(70, 0x77616c6c20636c6f636b2e6a7067, 'Wall clock', '2023-09-28 08:04:00', '8000', 1000, 2000, 45, 'The Large Wall Clock with a \"No-Ticking\" feature and a modern metal Ginkgo Leaf art design is a stylish and functional addition to your living room, cafe, restaurant, or any space where you want to add a touch of sophistication. ', NULL),
(71, 0x616e6f64726f69642e706e67, 'Samsung', '2023-08-16 14:09:00', '15000', 9000, 12000, 47, 'This is an android', 45),
(73, 0x6261636b67726f756e642e6a706567, '2018 Hyundai Sonata', '2023-08-17 14:31:00', '1000', 2000, NULL, NULL, '121', 46),
(75, 0x69706f6e652e706e67, 'IPhone X', '2023-08-23 14:46:00', '120000', 95000, NULL, NULL, 'This is an apple product ', 46);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `email_address`, `password`, `role`) VALUES
(30, 'pragya', 'kayastha', '9813455267', 'banepa', 'test@gmail.com', '$2y$10$2qJ8S3Lyf46ZHvwlGiHoj.uZqAWLEWIy2xT1BocD9pSkSFrmC5.KC', 'admin'),
(33, 'Mr.', 'Nobody', '12121222', 'cus', '123@gmail.com', '$2y$10$zJHujMdkoUg7omXtNB2SJu2g9pXGq64qWitGOtvHNZR2dTxFSqeoa', 'customer'),
(34, 'Customer', 'kayastha', '21123123', 'Incidunt laborum re', 'cus@taicher.com', '$2y$10$Wbx2jmfGiLNGd35b9Kti5uM0ZRfOFoMINDmNqEUlqzvgEeUztXNQi', 'customer'),
(40, 'Whoopi', 'Mcpherson', '813', 'Quia quibusdam non c', '456@gmail.com', '$2y$10$4/zSHfVEL2DrdUAT28t.AuAnSEFCa0aabX4hPyaW6/D7YKyUM4WBi', 'customer'),
(41, 'Brittany', 'Dalton', '985', 'Voluptates mollit vo', 'xyz@gmail.com', '$2y$10$S5ufYKIA/NgE/ExaAYA5AOAVN15L6u/h/Nb4zvGW9MU6P60Fo1SLm', 'customer'),
(42, 'Alvin', 'Puckett', '7', 'Mollitia corporis ve', '789@gmail.com', '$2y$10$08.eyNPJ/peIG8E9jibZV.Ma8dYksuIQvBiFhx0Evnv.po7iNl4yO', 'customer'),
(45, 'Seller', 'First', '9813220022', 'KTM', 'sell@gmail.com', '$2y$10$n693DYBicAaCKbo6OjjnHO0AzVFOhuO3GmsOhiAl.N9hTkRvi3VFK', 'seller'),
(46, 'Seller', 'Second', '9816790345', 'bhaktapur', 'second@gmail.com', '$2y$10$WSjAaKvDiHBxmq1wGJuIP.hIX74JvjJhkdyX38Wv9OTjztBtVqq3q', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid_products`
--
ALTER TABLE `bid_products`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid_products`
--
ALTER TABLE `bid_products`
  MODIFY `SN` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
