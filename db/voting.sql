-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 07:13 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `vt_candidate`
--

CREATE TABLE `vt_candidate` (
  `id` int(11) NOT NULL,
  `cname` varchar(100) DEFAULT NULL,
  `classname` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vt_user`
--

CREATE TABLE `vt_user` (
  `user_uid` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_image` varchar(256) NOT NULL,
  `user_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_type` tinyint(1) NOT NULL DEFAULT '3',
  `user_password` varchar(1000) NOT NULL,
  `user_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vt_user`
--

INSERT INTO `vt_user` (`user_uid`, `user_fname`, `user_lname`, `user_email`, `user_image`, `user_active`, `user_type`, `user_password`, `user_date`) VALUES
(1, 'Admin', '', 'admin@voting.com', '', 1, 1, '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vt_vote`
--

CREATE TABLE `vt_vote` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `vdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vt_candidate`
--
ALTER TABLE `vt_candidate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq` (`cname`,`classname`);

--
-- Indexes for table `vt_user`
--
ALTER TABLE `vt_user`
  ADD PRIMARY KEY (`user_uid`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- Indexes for table `vt_vote`
--
ALTER TABLE `vt_vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vt_candidate`
--
ALTER TABLE `vt_candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vt_user`
--
ALTER TABLE `vt_user`
  MODIFY `user_uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vt_vote`
--
ALTER TABLE `vt_vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
