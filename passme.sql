-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2017 at 09:48 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `passme2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pm_accounts`
--

CREATE TABLE `pm_accounts` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pm_category`
--

CREATE TABLE `pm_category` (
  `id` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pm_category`
--

INSERT INTO `pm_category` (`id`, `name`) VALUES
(1, 'Chung'),
(2, 'Mạng xã hội'),
(3, 'Công việc'),
(4, 'Tài chính/thanh toán'),
(5, 'Dịch vụ trực tuyến');

-- --------------------------------------------------------

--
-- Table structure for table `pm_services`
--

CREATE TABLE `pm_services` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pm_services`
--

INSERT INTO `pm_services` (`id`, `name`, `fullname`, `url`, `img`) VALUES
(0, 'other', 'Loại tài khoản khác', '', 'default.png'),
(1, 'Facebook', 'Facebook', 'https://www.facebook.com', 'facebook.png'),
(2, 'Google', 'Google', 'https://accounts.google.com', 'google.png'),
(3, 'Twitter', 'Twitter', 'https://twitter.com', 'twitter.png'),
(4, 'zingid', 'Zing ID', 'https://id.zing.vn', 'zingid.png'),
(5, 'lop67hoidap', 'Lớp 6/7 Tài Khoản', 'http://lop67.tk/taikhoan/login', 'lop67taikhoan.png'),
(6, 'yahoo', 'Yahoo', 'https://login.yahoo.com/', 'yahoo.png'),
(7, 'instagram', 'Instagram', 'https://instagram.com', 'instagram.png'),
(8, 'wordpress', 'WordPress.com', 'https://wordpress.com/wp-admin', 'wordpress.png'),
(9, 'tinhte', 'Diễn đàn Tinh Tế', 'https://tinhte.vn', 'tinhte.png'),
(10, 'lazada', 'Lazada', 'https://www.lazada.vn/customer/account/login/', 'lazada.png'),
(11, 'vietcombank', 'Vietcombank VCB-iB@nking', 'https://www.vietcombank.com.vn/IBanking2015', 'vietcombank.png'),
(12, 'wikipedia', 'Wikipedia', 'https://wikipedia.org/w/index.php?title=Special:UserLogin', 'wikipedia.png'),
(13, 'govn', 'Go.vn', 'https://id.go.vn/trang-chu', 'govn.png'),
(14, 'violympic', 'Violympic Toán (violympic.vn)', 'http://violympic.vn', 'violympic.png');

-- --------------------------------------------------------

--
-- Table structure for table `pm_users`
--

CREATE TABLE `pm_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userStatus` varchar(1) NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pm_accounts`
--
ALTER TABLE `pm_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_category`
--
ALTER TABLE `pm_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_services`
--
ALTER TABLE `pm_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pm_users`
--
ALTER TABLE `pm_users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pm_accounts`
--
ALTER TABLE `pm_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pm_category`
--
ALTER TABLE `pm_category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pm_services`
--
ALTER TABLE `pm_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pm_users`
--
ALTER TABLE `pm_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
