-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 05:53 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT 'TBD',
  `location` varchar(255) NOT NULL DEFAULT 'TBD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `location`) VALUES
(1, 'admin', '$2y$10$8H0ympAjySJfU7RScHcWMOjAGz26kC4x1lLNe2n.erM9PUw5H4geO', 'admin@gmail.com', 'Mars'),
(2, 'liju2', '$2y$10$jYIhGIzszpE9AkVnaSDV4.YCdapOh0QLLTNzSLLXbPlqyCayHgouW', 'wenboye2@illinois.edu', 'Chicago'),
(3, 'user1', '$2y$10$T3lorxS3mzOHDmYhRpCXturoNTZ.okHMsGgZIWj22fUn8IBVJfBhC', 'user1@163.com', 'HongKong'),
(4, 'user2', '$2y$10$8c9MhcyLpFqp.yhwSqd3w.cRoM6ntwa9Lx7EciRcCFB5iGJDhwQpS', 'user2@hotmail.com', 'Abdu\'s office'),
(5, 'user4', '$2y$10$xaRazveMz/hAF1dK/T64n.7GucR/40JQTwu/UaPkXf6IJqx9NL8W2', 'user4ever@illinois.edu', 'Tokoyo'),
(6, 'user5', '$2y$10$o2hJ1DrYzl/BM9JRMW0dxeDSHgMMdfLPkgy9OPByRp5GENmhutnXm', 'user5_music@outlook.com', 'Champaign'),
(7, 'user7', '$2y$10$jFn89c45wef8NMfcJQE7veyz.S6jE0ArPXFwXfBpduSexlwmvJan.', '77_song@126.com', 'Chicago'),
(8, 'user10', '$2y$10$tIZ.efSS.aE.eAKhGr5o8OgoohL8z6h7VTVQGIV4GX4oBSJ8Uzj5W', 'user10@illinois.edu', 'Champaign'),
(9, 'user11', '$2y$10$f6sp7oNgP1BDQ3AOFhI9B.VNvv5.XjgNxKT8vu/4XY2255LL6ETV6', '1single1@hku.edu', 'Hong Kong University'),
(10, 'user100', '$2y$10$Up2geEhPWDcezDqIvyE7CuUGozlhl2XHHIbKN7zwuRwUztWvB/Ifq', 'xzhu15913@gmail.com', 'ShenZhen'),
(11, 'user12', '$2y$10$a3jSZb4k1y/96S3ueuwF7OD96ZuAB00MzQ8EIVkipSAiSiiYonwbm', 'xzhu15913@gmail.com', 'NYC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
