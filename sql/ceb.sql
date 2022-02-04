-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 09:51 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ceb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(220) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `nicF` varchar(250) NOT NULL,
  `idno` varchar(15) NOT NULL,
  `nicB` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(50) NOT NULL DEFAULT '',
  `rememberme` varchar(255) NOT NULL DEFAULT '',
  `role` enum('Member','Admin') NOT NULL DEFAULT 'Admin',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `name`, `first_name`, `last_name`, `image`, `photo`, `nicF`, `idno`, `nicB`, `password`, `email`, `activation_code`, `rememberme`, `role`, `status`, `created_at`) VALUES
(1, 'admin', '', 'Amila1', 'last name', '1418110078.jpg', '', '1471739663.jpg', 'd', '83910466.jpg', '$2y$10$jHpHsO7c8zT5BIAPjpU8q.jH5U43dlaChkXkZ2PWovxYbivYbB.jy', 'n.dissanayaka4244@gmail.com', 'activated', '', 'Admin', 1, '2021-03-20 14:51:54'),
(88, 'IUyWq7fDO2_2', '', 'gfh---', 'ghfh', '', '', '', '', '', '$2y$10$wukeoEAAeuoGWsc.i07ubuRA.YWItRMm6spu63A/alQMZ.6VpAVLW', 'nalinda@gmail.com', 'activated', '', 'Member', 1, '2021-03-20 04:25:54'),
(89, 'sXg54lF1Ob_89', '', 'new', 'one', '', '', '', '', '', '$2y$10$ETxFgHYqsEGCLZpm8D8Pj.4/s04XsIG.PgrUxvV4X/0WrK9Tgyal6', 'nalindasda@gmail.com', 'activated', '', 'Member', 1, '2021-03-21 05:01:35'),
(90, 'WbqViYOA8K_90', '', 'newdsfsdf', 'dsfsdfs', '', '', '', '', '', '$2y$10$KKw3VCqxbG5cBHbw.i8UJeR.297BhGu/eqjaXflsSOA6aQOYeXm8u', 'sdfsdfnalinda@gmail.com', 'activated', '', 'Member', 1, '2021-04-06 07:03:31'),
(91, 'N7PrhWEFhm_91', '', 'new', 'one', '', '', '', '', '', '$2y$10$BeYU27k4jwe0JTiaCRyWzeUlFhTwmSiwUqYFOYPKQwlvKcz2KZbzK', 'sdfsdfdsdsfsdfnalinda@gmail.com', 'activated', '', 'Member', 1, '2021-03-30 07:04:33'),
(92, 'nTHsNtb22t_92', '', 'new', 'sdsde', '', '', '', '', '', '$2y$10$nC2AelkbaoJVvqAi7a6OpOXpczu1lk83/rvWKR3HNOjsEHj7tsr2q', 'nalinsda@gmail.com', 'activated', '', 'Member', 1, '2021-04-16 07:06:47'),
(93, 'vfb9hchRGZ_93', '', 'new', 'sdsde', '', '', '', '', '', '$2y$10$.2s9DmpA9Z0KguAe0n20Leahgd.W/MGmIDQ.INZGCTXFVamN30.wC', 'nalinda@gmail.comsdf', 'activated', '', 'Member', 1, '2021-03-30 07:07:35'),
(94, 'fA98B2yITO_94', '', 'news', 'sdsde', '', '', '', '', '', '$2y$10$mAZo3644Rk4/nYjVFfHJ3uilmEueUBzqMuAiP1r7VsWYN1IQVDfJm', 'nalisnda@gmail.com', 'activated', '', 'Member', 1, '2021-03-21 07:55:18'),
(96, 'E3pICBiqeB_96', '', 'c', 'd', '', '', '', '', '', '$2y$10$V32dImc3znftFF0VSNmVkekOH6DWM5/TQqGZWXcgarZgZsmAsHeL6', 'nalinda@gmail.comd', 'activated', '', 'Member', 1, '2021-04-15 09:44:37'),
(97, '8to3ECMp4S_97', '', '', '', '', '', '', '', '', '$2y$10$F.huwDNhfDZpMyafS1XGM.7QqbyR8.qkPdae39sqHoNt8uArWARbW', 'nalindda@gmail.com', 'activated', '', 'Member', 1, '2021-04-12 09:45:28'),
(98, 'Y4yzUMn29Z_98', '', 'new', 'sdsde', '', '', '', '', '', '$2y$10$7dIYWAWrjivv3ZTsPnXN9esM2nf1LvZVPIlqTD7TAz.ttxlsR4ZzC', 'nalinda1111@gmail.com', 'activated', '', 'Member', 1, '2021-04-06 10:02:29'),
(99, 'cJrAlsiATb_99', '', 'new', 'sdsde', '', '', '', '', '', '$2y$10$aXYgCvV6CzAYCA.iPir4mOQXOHbFK6TAi7APJtv8lg2I10SGbszt2', 'nalihnda@gmail.com', 'activated', '', 'Member', 1, '2021-04-07 10:04:14'),
(100, 'fPz5Jd7EpA_100', '', 'new', 'one', '', '', '', '', '', '$2y$10$OoRZgFQrvvYqrRxi3IgVvujRQEgiAqufSPl8IyVWMVDOdbyc2yTXi', 'naleinda@gmail.com', 'activated', '', 'Member', 1, '2021-04-12 10:06:41'),
(101, 'K4mLPFwAuD_101', '', 'new', 'one', '', '', '', '', '', '$2y$10$xof4yaAZscUui.0OvNeqIegVX1hbyeOxkRpfFPZEfby8.B8SazE7.', 'nalinddddda@gmail.com', 'activated', '', 'Member', 1, '2021-04-11 10:07:34'),
(143, 'nalinda424ssss', '', 'new', 'sdsde', '', '', '', '', '', '$2y$10$/5/ghlmhIt.3JV95PDrVtu3DvXyJ9b7CO2G/EFdXFmrnJbClS2MSC', 'naeelinda@gmail.com', '', '', 'Member', 1, '2021-04-06 00:28:51'),
(150, 'adminjj', '', 'new', 'ghfh-', '', '', '', '', '', '$2y$10$QB0TEDuQv5kSWkojNNNxZuvdpXCjTIp0CIKS7GnWGyzH5hOz3yyLu', 'nalindajjjjjjj@gmail.com', '605bdc8b2c26a', '', 'Member', 1, '2021-03-30 00:42:51'),
(151, 'jhkhjk', '', 'Nalinda', 'Dissanayaka', '', '', '', '', '', '$2y$10$XB8GHLPdtZLnav3x3bXRlOSFS8IBDQN69SUCm3bbkwj06cYghCIia', 'nalinda@gmail.comjhkhjkjhk', '605c3120b5d71', '', 'Member', 1, '2021-03-21 00:46:22'),
(156, 'fffff', '', 'ffffff', 'ffff', '', '', '', '', '', '$2y$10$Ke1zgmUlLufdChhZ/HChQOof6UNdxnu2p9ba/wO1Ue9qFHJY4RFuu', 'nalindaffff@gmail.com', 'activated', '', 'Member', 1, '2021-04-15 12:51:21'),
(165, 'naliteyteyteynda424', '', 'new', 'tytyetytyety', '', '', '', '', '', '$2y$10$ns03/9.JznF5Cd0VFHVeye62fNLniY4D2cOnd1vkE3oKDt.y9hFjK', 'n.dissandayaka424@gmail.com', 'activated', '', 'Member', 1, '2021-04-16 04:29:50'),
(168, 'ssss', '', 'ssss', 'ssssssssss', '', '', '', '', '', '$2y$10$FHMxAGhZLkuGGCJUK77dMeczpenFU6om9J.8gZ0TehB3tGpPjPHGy', 'nalinda@gmail.comssssss', '', '', 'Member', 1, '2021-04-13 00:56:36'),
(169, 'nalindgfhfayyy424', '', 'hgfhgf', 'fdsfds', '', '', '', '', '', '$2y$10$6zZXzP5J.2L/qzqz66MZtOQXDuA.jF9qhwoUJqyxqcB4JIGCGBCHm', 'nalinda424@gfdgfd.hhh', 'activated', '', 'Member', 1, '2021-04-14 07:51:42'),
(170, 'nalinda424ds', '', 'dsdqdq', 'dsdsd', '', '', '', '', '', '$2y$10$YHW3Wc6DEcVDP.1Y8UMPcurPI2ZVZiup80QsctwWAvYaiRi6UaySK', 'nalinda@gmail.codddm', '6077f1f1e7a84', '', 'Member', 1, '2021-04-07 07:57:38'),
(171, 'nalinda424aa', '', 'ddd', 'ddddddd', '', '', '', '', '', '$2y$10$R/Dh8Ltw8E1EgJ5TYao4aOQaSmNqg1SgZBKfJy2Mcgc6925Y6uEz6', 'nalindssssa@gmail.com', '607ac4949d48a', '', 'Member', 1, '2021-04-17 11:20:52'),
(172, 'nalinda424', '', 'new', 'werwr', '', '', '1471470162.JPG', '941151663V', '2095131540.JPG', '$2y$10$A5qmeqIjYdZIUk3i.4iLB.Thlv0Qkv7X5.ybrPHisEnS0Qy8iOO2G', 'nalinda@gmail.comhghgh', 'activated', '', 'Admin', 1, '2021-04-17 12:08:42'),
(173, 'ooooo', '', 'new', 'sdsde', '', '', '', '', '', '$2y$10$9E3MzBdxGYzTCo2dmViqEuXhzS7tbv/L8TmAGP2/iI5HKMt9uv6aG', 'nalindyyyya@gmail.comhghgh', '', '', 'Admin', 1, '2021-04-17 12:10:50'),
(218, 'oooooooop', '', 'jkjh', 'kjhjh', '', '', '', '', '', '$2y$10$1fR3QRMc9zrhW6IwCC6XGu/4FR4ofIGzHbickGcb0AYJrRRXXx6mW', 'nalinda@gmail.comhgjghjg', 'activated', '', 'Admin', 1, '2021-04-23 07:03:06'),
(219, 'ADMIN123', '', 'new', 'sdsde', '1338759341.JPG', '', '', '', '', '$2y$10$2R/l1wMXRFoUDYvCQxtjO.i7JXPT7/U4fnfenkYaDvA77PMR2J8tK', 'nalinda424', 'activated', '', 'Admin', 0, '2021-07-02 07:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `registration_no` varchar(250) NOT NULL,
  `u_name` varchar(300) NOT NULL,
  `cat_id` varchar(250) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `remarks` varchar(400) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `registration_no`, `u_name`, `cat_id`, `first_name`, `last_name`, `image`, `address`, `phone_no`, `remarks`, `created_at`) VALUES
(101, 'rg', 'sss', 'PB', '', '', '', 'sdasd', '0767663536', 'this is working', '2021-04-23 05:24:37'),
(102, 'd', 'd', 'CU', '', '', '', 'd', '07676635361', 'dd', '2021-04-23 05:24:53'),
(103, '00154', 'Nalinda Dissanayaka1', 'OT', '', '', '112601288.jpg', '111koonwewa', '07676635361', 'this is working1', '2021-04-23 05:26:21'),
(104, 'hhjj', 'hjkhjjhh', 'WL', '', '', '1795073195.JPG', 'hjhhjhhhjh', '0767663536', '44', '2021-07-02 07:49:58'),
(98, 'dsfdsfsdf', 'sdfdsfdsf', 'WL', '', '', '', 'dsfsdfsd', '07676635361dsfd', 'sdfsdf', '2021-04-23 05:17:54'),
(88, ' A Better Place To Work', '45000', 'MB', '', '', '2052695913.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Donec Sodales Sagittis Magna.', 'https://sourcec', '25', '2021-04-23 02:45:53'),
(99, 'sssssd', 'sss', 'MC', '', '', '786441806.JPG', 'ss', '0767663536', 'sss', '2021-04-23 05:23:55'),
(92, 'tretst', '8', 'WL', '', '', '875329524.png', 'des            \r\n          ', 's6MwGeOm8iI', '0', '2021-04-23 02:45:53'),
(100, 's', 'sss', 'PS', '', '', '', 's', '07676635361', 'asdsadasd', '2021-04-23 05:24:21'),
(95, 'rg', '1111', 'LS', '', '', '1413480857.png', 'add            \r\n          ', 'phoe', '', '2021-04-23 03:01:58'),
(97, '00154', 'adsadas', 'OT', '', '', '', 'sadasda', '0767663536', 'asdsadasd', '2021-04-23 05:17:39'),
(96, '001541111', 'Nalinda Dissanayaka1', 'SW', '', '', '1721802978.jpg', 'Koonwewa 1', '07676635361', 'this is working1', '2021-04-23 03:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userIp` varchar(255) NOT NULL,
  `action` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `username`, `userIp`, `action`, `created_at`) VALUES
(1, 3, 'nalinda424', '127.0.0.1', 'login', '2021-01-29 17:42:05'),
(2, 3, 'nalinda424', '127.0.0.1', 'login', '2021-01-29 17:42:23'),
(3, 3, 'nalinda424', '127.0.0.1', 'login', '2021-01-29 17:42:41'),
(4, 3, 'nalinda424', '127.0.0.1', 'login', '2021-01-29 17:46:03'),
(5, 3, 'nalinda424', '127.0.0.1', 'login', '2021-01-29 17:46:12'),
(6, 4, 'nalinda', '127.0.0.1', 'login', '2021-01-29 17:46:41'),
(7, 4, 'nalinda', '127.0.0.1', 'login', '2021-01-29 17:46:51'),
(8, 4, 'nalinda', '::1', 'login', '2021-01-30 00:39:42'),
(9, 3, 'nalinda424', '::1', 'login', '2021-01-30 03:12:05'),
(10, 4, 'nalinda', '::1', 'login', '2021-01-30 03:21:49'),
(11, 4, 'nalinda', '::1', 'login', '2021-01-30 03:52:12'),
(12, 1, 'admin', '::1', 'login', '2021-01-30 03:52:50'),
(13, 3, 'nalinda424', '::1', 'login', '2021-01-30 15:38:42'),
(14, 3, 'nalinda424', '::1', 'login', '2021-02-15 09:47:20'),
(15, 3, 'nalinda424', '::1', 'login', '2021-02-19 10:35:09'),
(16, 3, 'nalinda424', '::1', 'login', '2021-02-19 10:35:54'),
(17, 25, 'nalinda425', '::1', 'login', '2021-02-19 10:43:15'),
(18, 3, 'nalinda424', '::1', 'login', '2021-02-19 11:22:10'),
(19, 3, 'nalinda424', '::1', 'login', '2021-02-19 14:10:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
