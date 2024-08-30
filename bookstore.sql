-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 07:37 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `qty`, `added_at`) VALUES
(4, 12, 10, 1, '2024-08-30 17:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(2555) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `author`, `price`, `description`, `qty`, `img`) VALUES
(1, 'The Last Wish', 'Andrzej Sapkowski', '13', 'The Last Wish details the life of Geralt of Rivia. Geralt is a witcher, someone who has undergone an intensive process to become capable of fighting monsters. Each chapter alternates between a story from Geralt\'s past and his present stay at the temple of Melitele.', 3, '66bf7da6dc22d.jpg'),
(2, 'The Hobbit', 'J.R.R. Tolkien', '10.99', 'A fantasy novel about the adventure of Bilbo Baggins.', 50, 'hobbit.jpg'),
(3, 'The Lord of the Rings', 'J.R.R. Tolkien', '15.99', 'An epic fantasy trilogy set in Middle-earth.', 30, 'lotr.jpg'),
(4, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', '9.99', 'The first book in the Harry Potter series, where magic begins.', 40, 'hp1.jpg'),
(5, 'A Game of Thrones', 'George R.R. Martin', '12.99', 'The first book in the A Song of Ice and Fire series, full of political intrigue and dragons.', 35, 'got.jpg'),
(6, 'The Name of the Wind', 'Patrick Rothfuss', '11.99', 'The story of Kvothe, a magically gifted young man.', 25, 'name_of_the_wind.jpg'),
(7, 'Meditations', 'Marcus Aurelius', '7.99', 'A series of personal writings by the Roman Emperor on Stoic philosophy.', 60, 'meditations.jpg'),
(8, 'Beyond Good and Evil', 'Friedrich Nietzsche', '8.99', 'A philosophical work by Nietzsche challenging conventional morality.', 45, 'beyond_good_and_evil.jpg'),
(9, 'The Republic', 'Plato', '6.99', 'Plato’s dialogue concerning justice and the ideal state.', 70, 'republic.jpg'),
(10, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '14.99', 'An exploration of the history and impact of Homo sapiens.', 55, 'sapiens.jpg'),
(11, 'The Myth of Sisyphus', 'Albert Camus', '9.49', 'A philosophical essay that explores the concept of the absurd and existentialism.', 50, 'myth_of_sisyphus.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(120) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pwd`, `profile_pic`, `phone`, `country`, `role`) VALUES
(8, 'admin', 'admin@gmail.com', '$2y$10$AUny658axdaFMNDtfgcMhefnvwW.C4.ATZr0LhiJSc7PgcjH1tbmu', '66cf3f8cdf293.gif', '+373777777', 'Poland', 'admin'),
(9, 'otter', 'otter@gmail.com', '$2y$10$s/7ucQu/WarHDAB/NMA3xuzq.M1TSwqOmFhNlZeJjrkfSUWV6d8Dq', '66bf6e14b695f.gif', '+373666666', 'Asia', 'admin'),
(10, 'chipi', 'chipichapa@gmail.com', '$2y$10$5l.p19f.4J0Ou8ckor32GuNuzFffHhLSNVMSpcgIhasVmfvxk.UWy', '66cf40ef0dc86.gif', '+37388888', 'Poland', 'user'),
(12, 'bobrik', 'bobrik@bobrik.com', '$2y$10$DeTNMa3mtZMHFbUGb1kT3edKb8SUWsy6aXU.YQNu7YAwoisFr5Z86', '66d1fb3888495.gif', '+3737777777', 'Poland', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
