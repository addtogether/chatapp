-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 12:35 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_msg`
--

CREATE TABLE `group_msg` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sender_msg_id` int(11) NOT NULL,
  `msg` varchar(512) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_msg`
--

INSERT INTO `group_msg` (`id`, `group_id`, `sender_msg_id`, `msg`, `img`) VALUES
(1, 1, 1231, 'sdfsdf', ''),
(2, 2, 1021428023, 'hi', ''),
(3, 2, 1021428023, 'hello', ''),
(4, 2, 1024268667, 'ha na', ''),
(5, 2, 1021428023, '', '1634983240Screenshot (154).png'),
(6, 2, 1024268667, '', '1634983249Screenshot (159).png'),
(7, 2, 733855701, 'hi', ''),
(8, 2, 1024268667, 'hello everyone', ''),
(9, 2, 733855701, 'hello', ''),
(10, 2, 1021428023, 'hello', '');

-- --------------------------------------------------------

--
-- Table structure for table `grp`
--

CREATE TABLE `grp` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `users` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grp`
--

INSERT INTO `grp` (`id`, `group_name`, `users`) VALUES
(1, 'grp1', '112353444675234246752341231'),
(2, 'group1', '1021428023,1024268667,733855701');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `receiver_msg_id` int(255) NOT NULL,
  `sender_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `receiver_msg_id`, `sender_msg_id`, `msg`, `img`) VALUES
(43, 1024268667, 1021428023, 'hey', ''),
(44, 1024268667, 1021428023, '', '1634895131amulmilk.jpg'),
(45, 1021428023, 1024268667, '', '1634896176Mens-Standard-Fit-Heathered-Short-Sleeve-V-Neck-T-Shirt01-600x764.jpg'),
(46, 1024268667, 1021428023, '', '1634896827Screenshot (165).png'),
(47, 1024268667, 1021428023, 'asddddddddddddddddddddddddddddddddddddddddddddddadasdadadad', ''),
(48, 1021428023, 1024268667, 'Hello', ''),
(49, 1024268667, 1021428023, 'heelo', ''),
(50, 1021428023, 1024268667, 'he', ''),
(51, 1024268667, 1021428023, '', '1634981655addingProduct.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(200) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `friend` varchar(512) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `friend`, `status`) VALUES
(21, 1024268667, 'dummy', 'A', 'dummya@gmail.com', '$2y$10$HEctT6uICYvToEgejd5SO./BIYe.jnL1XQuA2Hy/WAWHNygJuqjwi', '1634883322man-31.jpg', '1021428023', 'active'),
(22, 733855701, 'dummy', 'B', 'dummyb@gmail.com', '$2y$10$TDr9/m/PBlw1YDzXkWnta.fxKuiX8HaWPdRPGmwZ8zNB8.N178VwW', '1634883355Mens-Standard-Fit-Crew-T-Shirt01-600x764.jpg', '10214280231024268667', 'active'),
(23, 1021428023, 'dummy', 'C', 'dummyc@gmail.com', '$2y$10$61IzyhLkpe2Y7mswkKj3Nei8eImn9LmWxIBuSc6PJoWLPu76nBFhe', '1634883408Mens-Standard-Fit-Deconstructed-Knit-Blazer01-600x764.jpg', '1024268667', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_msg`
--
ALTER TABLE `group_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grp`
--
ALTER TABLE `grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_msg`
--
ALTER TABLE `group_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grp`
--
ALTER TABLE `grp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
