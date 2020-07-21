-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 05:36 AM
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
-- Database: `cs411`
--

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `SongID` int(11) NOT NULL,
  `SongName` varchar(127) DEFAULT NULL,
  `Singer` varchar(127) DEFAULT NULL,
  `ReleaseDate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`SongID`, `SongName`, `Singer`, `ReleaseDate`) VALUES
(1, 'Mojito', 'Jay Chou', 2020),
(2, 'Always Online', 'JJ Lin', 2008),
(3, 'Look What You Made Me Do', 'Taylor Swift', 2017),
(4, 'Mine Mine', 'Jay Chou', 2011),
(5, 'Love Yourself', 'Justin Bieber', 2015),
(6, 'Now You See Me', 'Jay Chou', 2016),
(7, 'Love Story', 'Taylor Swift', 2008),
(8, 'Yi Jian Mei', 'Fei Yu-Ching', 1983),
(9, 'Godzilla', 'Eminem', 2020),
(10, 'Problem', 'Ariana Grande', 2014);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`SongID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `SongID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
