-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2021 at 11:18 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2p_pd`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `visualdate` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `username`, `datetime`, `visualdate`, `content`) VALUES
(26, 'admin', '2019-11-27 21:44:57', '27.11.2019 21:44', 'ooofff'),
(27, 'admin', '2019-11-27 21:48:01', '27 Nov 19 21:48', 'aaaaa'),
(28, 'admin', '2019-11-27 21:48:40', '27 Nov 19   21:48', 'dddd'),
(29, 'admin', '2019-11-27 21:50:08', '27 Nov 19 ∙ 21:50', 'ssss'),
(30, 'admin', '2019-11-27 21:50:54', '21:50 ∙ 27 Nov 19', 'd'),
(31, 'admin', '2019-11-27 21:51:21', '21:51 ∙ 27 Nov 19', 'sss'),
(32, 'admin', '2019-11-27 21:51:35', '21:51 ∙ 27 Nov 19', 'ssss'),
(33, 'admin', '2019-11-27 21:54:10', '21:54 ∙ 27 Nov 19', 'vvvv'),
(34, 'admin', '2019-11-27 22:02:16', '22:02 ∙ 27 Nov 19', 'ddd'),
(35, 'admin', '2019-11-27 23:03:05', '23:03 ∙ 27 Nov 19', 'ccc'),
(36, 'admin', '2019-11-29 22:13:42', '22:13 ∙ 29 Nov 19', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddd'),
(37, 'admin', '2019-11-29 22:20:19', '22:20 ∙ 29 Nov 19', 'ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss ssss '),
(38, 'admin', '2019-11-29 22:22:13', '22:22 ∙ 29 Nov 19', 'aaaaa\r\naaa'),
(39, 'admin', '2019-11-29 22:23:42', '22:23 ∙ 29 Nov 19', ''),
(40, 'admin', '2019-11-29 22:26:48', '22:26 ∙ 29 Nov 19', 'fcfcffcff\r\n      fcf\r\nfcfc\r\nfc\r\nfc\r\nfc\r\nfcffffffffffffffff'),
(41, 'admin', '2019-11-29 22:27:10', '22:27 ∙ 29 Nov 19', 'fvdfv\r\ndvffdv\r\n          fdvdfv\r\n fdfvdfv\r\n   fdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(8) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `role`, `password`, `phone`, `image`) VALUES
(4, 'admin', 'abc', 'admin', '$2y$10$.v65YDd2HYIqbXWIS0aXTeWybZJZqK.ughYmc2nc.Zg9OcW/bVlni', 12345678, 'placeholder.png'),
(5, 'filips', 'useris', 'user', '$2y$10$jQxMpSFKQWNKnRAYhQgu.eMrkne/Aoie/Wq8W0NiSVdV2CbmGFmVO', 12345687, '../croppie/cropped/bc062762df3e88bc163a1a88e4d6ea7d.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
