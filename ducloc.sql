-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2017 at 01:33 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ducloc`
--

-- --------------------------------------------------------

--
-- Table structure for table `bang_gia`
--

CREATE TABLE IF NOT EXISTS `bang_gia` (
  `id` int(11) NOT NULL,
  `treo_nick` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bot_cx` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bot_cmt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `auto_post` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bang_gia`
--

INSERT INTO `bang_gia` (`id`, `treo_nick`, `bot_cx`, `bot_cmt`, `auto_post`) VALUES
(1, '5000', '5000', '50000', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `bot_cmt`
--

CREATE TABLE IF NOT EXISTS `bot_cmt` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `time_use` int(11) NOT NULL,
  `check_male` int(11) NOT NULL,
  `check_female` int(11) NOT NULL,
  `check_pg` int(11) NOT NULL,
  `check_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `h_start` int(11) NOT NULL,
  `h_end` int(11) NOT NULL,
  `time_creat` int(11) NOT NULL,
  `user_creat` int(11) NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bot_cmt`
--

INSERT INTO `bot_cmt` (`id`, `fb_id`, `name`, `access_token`, `time_use`, `check_male`, `check_female`, `check_pg`, `check_uid`, `h_start`, `h_end`, `time_creat`, `user_creat`, `note`, `active`) VALUES
(8, '100013424266949', 'Hải Sơn', 'EAAAAUaZA8jlABAFhhfnXci88O3pGZAX1In6tovZBv7yQljNFXU5yIGIHbpH2EXYZA4AWKVxPKn8jtVth5gSje5ZAzCOzj6Hc4biY424dWr6QpZAnuwhTwc1gvGt1zWhbbW5J8lW4kTxCNjsoDxUnPLZAscoOw3ZBFJo2SPeZAuGo11o1Fsacll6DTXx09LrDueFUZD', 1516623119, 1, 1, 1, '', 6, 23, 1514031119, 1, 'dsasdas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bot_login`
--

CREATE TABLE IF NOT EXISTS `bot_login` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fb_dtsg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cookie` text COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `time_use` int(11) NOT NULL,
  `time_creat` int(11) NOT NULL,
  `user_creat` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bot_login`
--

INSERT INTO `bot_login` (`id`, `fb_id`, `name`, `fb_dtsg`, `cookie`, `note`, `time_use`, `time_creat`, `user_creat`, `active`) VALUES
(13, '100013424266949', 'Hải Sơn', 'AQHJGt-IUptV:AQHARBxWIiXq', 'sb=Azg7Wtog1v4wPOo0Lb9Jesks; datr=Azg7WmB2ROfpUOM-a07m4W1v; c_user=100013424266949; xs=22:3V032wHLVhhP5Q:2:1513830457:8397:6222; pl=n; fr=0kpE4ZsmPp6iyjtNO.AWXKZ4yH8TQmeiCpgTkm-Clp0sA.BaKRGi.vA.Fo7.0.0.BaPFtq.AWUwfQuz; presence=EDvF3EtimeF1513907604EuserFA21B13424266949A2EstateFDutF1513907604517CEchFDp_5f1B13424266949F8CC; wd=811x662; act=1513907614392/9; x-src=/|pagelet_bluebar; pnl_data2=eyJhIjoib25hZnRlcmxvYWQiLCJjIjoiL3Byb2ZpbGVfYm9vay5waHA6dGltZWxpbmUiLCJiIjpmYWxzZSwiZCI6Ii8iLCJlIjpbXX0=', 'á', 1516584352, 1513992352, 1, 1),
(14, '100009126175131', 'Nguyễn Minh Trí', 'AQFOyltlfcql:AQEDUBr2dz39', 'datr=YzO5WclxlkIxZqGJ3FC2Effr; sb=djO5WaZNDNGKHgXim1BiTQxv; pl=n; c_user=100009126175131; xs=33:0zPM6oKfMRNXJg:2:1512216441:8397:6232; dpr=1.100000023841858; fr=0qI5tk6v2rEAUaW4a.AWXOX5Z8a6TNzMhh4CYBZ-6xeBk.BaIpdO.Tx.Fo9.0.0.BaPcTy.AWUCbWnV; presence=EDvF3EtimeF1513999832EuserFA21B09126175131A2EstateFDt3F_5b_5dG513999832196CEchFDp_5f1B09126175131F291CC; act=1513999894462/41; wd=795x579', '', 1516591995, 1513999995, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bot_reactions`
--

CREATE TABLE IF NOT EXISTS `bot_reactions` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reactions` int(11) NOT NULL,
  `access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `time_use` int(11) NOT NULL,
  `check_male` int(11) NOT NULL,
  `check_female` int(11) NOT NULL,
  `check_pg` int(11) NOT NULL,
  `check_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `h_start` int(11) NOT NULL,
  `h_end` int(11) NOT NULL,
  `time_creat` int(11) NOT NULL,
  `user_creat` int(11) NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bot_reactions`
--

INSERT INTO `bot_reactions` (`id`, `fb_id`, `name`, `reactions`, `access_token`, `time_use`, `check_male`, `check_female`, `check_pg`, `check_uid`, `h_start`, `h_end`, `time_creat`, `user_creat`, `note`, `active`) VALUES
(7, '100013424266949', 'Hải Sơn', 7, 'EAAAAUaZA8jlABAFhhfnXci88O3pGZAX1In6tovZBv7yQljNFXU5yIGIHbpH2EXYZA4AWKVxPKn8jtVth5gSje5ZAzCOzj6Hc4biY424dWr6QpZAnuwhTwc1gvGt1zWhbbW5J8lW4kTxCNjsoDxUnPLZAscoOw3ZBFJo2SPeZAuGo11o1Fsacll6DTXx09LrDueFUZD', 1516617490, 1, 1, 0, '', 6, 23, 1514025490, 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL,
  `fb_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `money` int(11) NOT NULL,
  `time_creat` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `fb_id`, `email`, `password`, `full_name`, `phone_number`, `money`, `time_creat`, `last_login`, `admin`, `active`) VALUES
(1, '100013424266949', 'tinhcamvonco@gmail.com', '1efb3a691f4c1f3e2da0d1e30984d577', 'Hải Sơn', '0971010421', 2240000, 1513841361, 1513841361, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bang_gia`
--
ALTER TABLE `bang_gia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bot_cmt`
--
ALTER TABLE `bot_cmt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bot_login`
--
ALTER TABLE `bot_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bot_reactions`
--
ALTER TABLE `bot_reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bang_gia`
--
ALTER TABLE `bang_gia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bot_cmt`
--
ALTER TABLE `bot_cmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bot_login`
--
ALTER TABLE `bot_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `bot_reactions`
--
ALTER TABLE `bot_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
