-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 08:10 PM
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
-- Database: `preloved_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `brand` varchar(255) NOT NULL,
  `item_condition` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `deal_method` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `item_name`, `item_description`, `price`, `image_url`, `brand`, `item_condition`, `size`, `location`, `deal_method`, `contact`) VALUES
(3, NULL, 'Carhatt jeans', 'eee', 124.00, 'uploads/675db0f9b30ca5.80422572.jpg', 'Carhatt', 'Good', '32', 'Arau', 'Courier delivery', '124124'),
(4, NULL, 'Puma court', 'Barang baru pakai 10 tahun, masih sempurna', 780.00, 'uploads/675dbf2bdbf987.11611197.jpg', 'Puma', 'So-so', '10uk', 'Kota belud', 'Meet-up', '123456'),
(5, NULL, 'Casio watch', 'Jam dari negara timur tengah untuk dijual', 500.00, 'uploads/675dc160570399.70749407.jpg', 'Casio', 'Good', 'universal', 'Arab Saudi', 'Courier delivery', '12121212'),
(6, NULL, 'Eskem', 'Sedap, dah makan separuh. Nak letgo selebihnya bagi yang lain merasa.', 20.00, 'uploads/6761949b68dea4.08186495.jpg', 'Mixue', 'Used-like new', 'besar', 'Sungai Buloh', 'Courier delivery', '0149998989'),
(7, NULL, 's1000rr', 'Motor bawak ulang alik masjid', 59000.00, 'uploads/67619a95d8b711.39624176.jpg', 'BMW', 'Used-like new', '20', 'Kedah', 'Cash on delivery', '12121212'),
(8, NULL, 'Carhatt jeans', 'bfgf', 7.00, 'uploads/67619d55d0dad5.55343645.jpg', 'Carhatt', 'Used-like new', '10uk', 'ff', 'Courier delivery', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Khafi', 'Kamarulzaman', '123@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, 'abu', 'badai', 'abu@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, 'Hasana', 'Kamarulzaman', 'nana@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
