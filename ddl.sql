-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2023 at 01:30 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_83395822`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ads`
--

CREATE TABLE IF NOT EXISTS `Ads` (
  `adId` int(11) NOT NULL,
  `adPath` varchar(30) NOT NULL,
  `disabled` binary(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ads`
--

INSERT INTO `Ads` (`adId`, `adPath`, `disabled`) VALUES
(1, 'ads/long/1.png', 0x30),
(2, 'ads/long/2.png', 0x30),
(3, 'ads/long/3.png', 0x30),
(4, 'ads/short/1.png', 0x30),
(5, 'ads/short/2.png', 0x30),
(6, 'ads/short/3.png', 0x30);

-- --------------------------------------------------------

--
-- Table structure for table `Articles`
--

CREATE TABLE IF NOT EXISTS `Articles` (
  `articleId` int(11) NOT NULL,
  `articleTitle` varchar(30) NOT NULL,
  `username` varchar(10) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `tagId` int(11) DEFAULT NULL,
  `articleBody` varchar(300) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `isDisabled` binary(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Articles`
--

INSERT INTO `Articles` (`articleId`, `articleTitle`, `username`, `categoryId`, `tagId`, `articleBody`, `views`, `isDisabled`) VALUES
(1, 'Subway reopens', 'student', 2, 4, 'ajkndskajsakjsd', 10, 0x30),
(2, 'Submit cosc 360 project', 'baru', 1, 1, 'aaaaaajndjsd', 2, 0x30),
(3, 'My Doggo', 'john', 2, 2, 'ojojiwejsakjsd', 21, 0x30),
(4, 'John’s dog', 'student', 2, 2, 'kjjjjjjajsakjsd', 12, 0x30),
(5, 'Welcome', 'yie', 1, 1, 'This is the first blog. Nice to meet you!', 23, 0x30),
(6, 'Study COSC', 'yie', 2, 7, 'I like to study computer science.', 21, 0x30),
(7, 'Professor', 'yie', 1, 1, 'This prof is amazing!', 1, 0x30),
(8, 'Walmart', 'yie', 2, 11, 'Walmart sucks', 4, 0x30),
(9, 'How to Laundry', 'yie', 2, 4, 'asddddddssss fsss sfa jsn ah dfslk oij asd j fjsha ww!', 0, 0x30),
(10, 'My weekend', 'yie', 2, 7, 'asd afsdbf h hghd bd tres cf hjdf d hgd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`categoryId`, `categoryName`) VALUES
(1, 'Academic'),
(2, 'Lifestyle');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `commentId` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `articleId` int(11) NOT NULL,
  `commentBody` varchar(100) NOT NULL,
  `uploadTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`commentId`, `username`, `articleId`, `commentBody`, `uploadTime`) VALUES
(6, 'baru', 2, 'Nice to meet you! My name is Subaru', '2023-03-26 05:19:32'),
(7, 'baru', 5, 'This is a nice article', '2023-03-26 05:28:36'),
(8, 'baru', 5, 'I love it', '2023-03-26 05:29:24'),
(9, 'baru', 8, 'Walmart is great!', '2023-03-26 05:29:33'),
(17, 'yie', 5, 'oui chef', '2023-03-26 22:19:26'),
(18, 'yie', 2, 'un', '2023-03-26 22:32:53'),
(19, 'yie', 5, 'Hi baru', '2023-03-26 23:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE IF NOT EXISTS `Tags` (
  `tagId` int(11) NOT NULL,
  `tagName` varchar(20) NOT NULL,
  `articleNumber` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tags`
--

INSERT INTO `Tags` (`tagId`, `tagName`, `articleNumber`) VALUES
(1, 'COSC360', 1),
(2, 'Dog', 2),
(3, 'UBC', 0),
(4, 'Subway', 2),
(5, 'Prof', 0),
(6, 'Course', 0),
(7, 'Study', 0),
(8, 'Laundry', 0),
(9, 'Emergency', 0),
(10, 'Cooking', 0),
(11, 'Grocery', 0),
(12, 'Event', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `passwords` varchar(10) NOT NULL,
  `phoneNum` int(11) DEFAULT NULL,
  `address` varchar(10) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `following` varchar(10) DEFAULT NULL,
  `isAdmin` binary(1) DEFAULT NULL,
  `isDisabled` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `passwords`, `phoneNum`, `address`, `postalCode`, `following`, `isAdmin`, `isDisabled`) VALUES
('baru', 'barubaru@gmail.com', 'passbaru', NULL, NULL, NULL, NULL, NULL, NULL),
('john', 'john@gmail.com', 'johnpass', NULL, NULL, NULL, NULL, NULL, NULL),
('josh', 'josh@gmail.com', 'josh', 0, '', '', NULL, NULL, NULL),
('student', 'student@gmail.com', 'password', NULL, NULL, NULL, NULL, NULL, NULL),
('subaruthec', 'hey@gmail.com', 'oui', NULL, NULL, NULL, NULL, NULL, NULL),
('yie', 'yie@gmail.com', 'root', 1234, '123 Monash', 'UBC234', NULL, 0x31, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ads`
--
ALTER TABLE `Ads`
  ADD PRIMARY KEY (`adId`);

--
-- Indexes for table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`articleId`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file_path` (`file_path`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ads`
--
ALTER TABLE `Ads`
  MODIFY `adId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
