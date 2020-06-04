-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 02:57 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazaar`
--
CREATE DATABASE IF NOT EXISTS `bazaar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bazaar`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `slug` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(1, 'Electronics', '', 'electronics');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(2, 'Appliances', '', 'appliances');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(3, 'Clothing', '', 'clothing');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(4, 'Toys & Gaming', '', 'toys_gaming');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(5, 'Furniture', '', 'furniture');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(7, 'Phones', '', 'phones');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(8, 'Phone Accessories', '', 'phone_accessories');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(9, 'Audio', '', 'audio');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(10, 'Collectibles', '', 'collectibles');
INSERT INTO `category` (`id`, `name`, `description`, `slug`) VALUES(16, 'Books', '', 'books');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(80) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`) VALUES(1, 'test', 'test', 'test', 'test');
INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`) VALUES(2, 'Tyler', 'tylerbeland@gmail.com', 'This is my subject', 'thisis my messsage');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `sender` int(8) NOT NULL,
  `receiver` int(8) NOT NULL,
  `subject` varchar(80) CHARACTER SET latin1 NOT NULL,
  `content` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(11, 5, 2, '1 to 2', 'msg1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(12, 5, 7, '1 to 2', 'msg2', '2019-04-01 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(15, 5, 7, '1 to 3', 'msg1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(16, 5, 6, '1 to 3', 'msg2', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(17, 2, 6, '2 to 3', 'msg1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(18, 2, 6, '2 to 3', 'msg2', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(19, 6, 5, '3 to 1', 'msg1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(20, 6, 5, '3 to 1', 'msg2', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(21, 6, 2, '3 to 2', 'msg1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(22, 6, 2, '3 to 2', 'msg2', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(23, 2, 5, '2 to 1', 'msg1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(24, 2, 5, '2 to 1', 'msg2', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(25, 5, 6, 'hello', 'hello 4 from 1', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(26, 5, 6, 'time', 'updated', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(27, 5, 6, 'sadasd', 'sadasd', '0000-00-00 00:00:00');
INSERT INTO `messages` (`id`, `sender`, `receiver`, `subject`, `content`, `datetime`) VALUES(28, 5, 6, 'dafsdasd', 'sadasdasd', '2019-03-28 02:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(25) CHARACTER SET latin1 NOT NULL,
  `category` int(3) NOT NULL,
  `owner_id` int(8) NOT NULL,
  `price` float(5,2) NOT NULL,
  `details` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `status` enum('Active','Suspended','Sold Out') CHARACTER SET latin1 NOT NULL DEFAULT 'Active',
  `photo` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(2, 'Tylers Product', 3, 5, 50.00, 'teststset', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(3, 'The Jungle Book', 16, 5, 50.00, 'The Jungle Book!!!', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(4, 'Gucci Sweater', 3, 5, 599.00, 'Gucci Sweater with red and white stripes.', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(5, 'sdfasdfasf', 16, 7, 4.00, 'safdsafs\r\nasdf\r\ndasfasd\r\nf', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(6, 'sdfasdfasf', 16, 7, 4.00, 'safdsafs\r\nasdf\r\ndasfasd\r\nf', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(7, 'sdfasdfasf', 16, 7, 4.00, 'safdsafs\r\nasdf\r\ndasfasd\r\nf', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(8, 'sdfasdfasf', 16, 7, 4.00, 'safdsafs\r\nasdf\r\ndasfasd\r\nf', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(9, 'sdfasdfasf', 16, 7, 4.00, 'safdsafs\r\nasdf\r\ndasfasd\r\nf', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(10, 'sdfasdfasf', 16, 7, 4.00, 'safdsafs\r\nasdf\r\ndasfasd\r\nf', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(13, 'Test Book', 16, 7, 99.00, 'Book test', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(14, 'testerrr', 16, 7, 44.00, 'baagagg1', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(15, 'This is the newest', 16, 7, 100.00, 'The newest', 'Active', 'image2_3747_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(18, 'Testerere', 16, 7, 12.00, '121231', 'Active', 'image2_0193_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(19, 'Testerere', 16, 7, 12.00, '121231', 'Active', 'image2_6862_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(20, 'LALALALA', 16, 7, 12.00, '121231', 'Active', 'image2_2573.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(22, 'NOKIA', 7, 9, 200.00, 'sajdhksjafhkjsafh', 'Active', 'nokia_0997_400x400.jpeg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(23, 'iPhone', 7, 9, 999.99, 'dklfgsdgbskldbg', 'Active', 'iphone-x-silver_0751_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(24, 'Shirt', 3, 9, 25.00, 'gjhghfgh', 'Active', 'mens_workshop_Q418_product_long_haul_beach_cloth_001_8448_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(25, 'Gown', 3, 9, 32.00, 'safsdafdfa', 'Active', '20-Seamless-Terry-Cloth-Textures_5734_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(26, 'Baby Clothes', 3, 9, 45.00, 'sadsdgdfh dfhjghnm', 'Active', 'ta7759ra_2420_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(27, 'SAMSUNG PHONE', 7, 9, 990.00, 'Good One', 'Active', 'samsung_9095_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(28, 'SAMSUNG PHONE', 7, 9, 990.00, 'Very nice call 1234567890', 'Active', 'samsung-galaxy-s7-always-on-display-3_2315_400x400.jpg');
INSERT INTO `product` (`id`, `name`, `category`, `owner_id`, `price`, `details`, `status`, `photo`) VALUES(29, 'TV', 1, 9, 575.00, 'Smart Andriod TV used for 2 years', 'Active', 'maxresdefault_8606_400x400.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(10) NOT NULL,
  `reporter` int(8) NOT NULL,
  `reported` int(8) NOT NULL,
  `report` varchar(200) CHARACTER SET latin1 NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `reporter`, `reported`, `report`, `datetime`) VALUES(1, 8, 17, 'sadsadsadsad', '2019-04-02 08:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(8) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `username` varchar(25) CHARACTER SET latin1 NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 NOT NULL,
  `type` enum('Admin','User') CHARACTER SET latin1 NOT NULL DEFAULT 'User',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `photo_updated` timestamp NULL DEFAULT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `type`, `created_at`, `last_login`, `photo`, `photo_updated`, `banned`) VALUES(7, 'Tyler', 'tylerbeland@gmail.com', 'tyler', '$2y$12$oB6ae8X6XiSDyMrF72XZ4uBxUHz8MyJ7WxO3G2UTcHSBSxo1PNqRO', 'Admin', '2019-04-02 12:22:00', '2019-04-01 18:29:35', 'image2_9256.jpg', '2019-04-01 23:58:22', '0');
INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `type`, `created_at`, `last_login`, `photo`, `photo_updated`, `banned`) VALUES(8, 'Vijit Atreya', 'atreyavijit@gmail.com', 'atreyavijit', '$2y$12$eCZEqtBrvunao3fq/ZvjH.i62qXv8dspDHl9HveCkzM0W3cdnOJrG', 'Admin', '2019-04-02 12:24:19', '2019-04-02 08:26:11', '', NULL, '0');
INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `type`, `created_at`, `last_login`, `photo`, `photo_updated`, `banned`) VALUES(9, 'Vijit Atreya', 'atreyavijit1@gmail.com', 'atreya', '$2y$12$fSPsMihXfAs7zmbix2afweHd/Cft4FIqWPUm4XhTc6s4rkvHyHShi', 'User', '2019-04-02 12:34:57', '2019-04-02 08:34:57', '', NULL, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1` (`sender`),
  ADD KEY `FK2` (`receiver`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_category` (`category`),
  ADD KEY `FK_user` (`owner_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK1` (`reporter`),
  ADD KEY `FK2` (`reported`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
