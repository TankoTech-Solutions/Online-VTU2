-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 12:51 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_vtu2`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL,
  `api_owner` varchar(200) NOT NULL,
  `api_purpose` varchar(400) NOT NULL,
  `api_key` varchar(200) NOT NULL,
  `api_secret` varchar(200) NOT NULL,
  `api_token` varchar(200) NOT NULL,
  `api_base_url` varchar(200) NOT NULL,
  `api_mode` varchar(30) NOT NULL,
  `date_add` varchar(40) NOT NULL,
  `date_update` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`api_id`, `api_owner`, `api_purpose`, `api_key`, `api_secret`, `api_token`, `api_base_url`, `api_mode`, `date_add`, `date_update`) VALUES
(1, 'Monnify', 'Authenticating by obtaining Access Token.', 'MK_TEST_WN9FQE2E5X', 'S6N0M0CUKKP9YBELV64BHNUEZ3CKJ8MW', '', 'https://sandbox.monnify.com/api/v1/auth/login', 'Test', '08/11/2024 12:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `app_id` int(11) NOT NULL,
  `app_image` varchar(120) NOT NULL,
  `app_title` varchar(120) NOT NULL,
  `app_description` varchar(400) NOT NULL,
  `app_mobile` mediumtext NOT NULL,
  `app_phone` varchar(20) NOT NULL,
  `app_email` varchar(120) NOT NULL,
  `app_address` mediumtext NOT NULL,
  `app_facebook` mediumtext NOT NULL,
  `app_twitter` mediumtext NOT NULL,
  `app_instergram` mediumtext NOT NULL,
  `app_youtube` mediumtext NOT NULL,
  `app_website` mediumtext NOT NULL,
  `app_copyright` mediumtext NOT NULL,
  `app_status` varchar(1) NOT NULL,
  `app_refer_price` varchar(10) NOT NULL,
  `app_version` varchar(10) NOT NULL,
  `app_color` varchar(10) NOT NULL,
  `app_dev_name` varchar(100) DEFAULT NULL,
  `app_dev_phone` varchar(20) DEFAULT NULL,
  `app_dev_email` varchar(120) DEFAULT NULL,
  `app_acct_name` varchar(120) NOT NULL,
  `app_acct_number` varchar(15) NOT NULL,
  `app_acct_bank` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`app_id`, `app_image`, `app_title`, `app_description`, `app_mobile`, `app_phone`, `app_email`, `app_address`, `app_facebook`, `app_twitter`, `app_instergram`, `app_youtube`, `app_website`, `app_copyright`, `app_status`, `app_refer_price`, `app_version`, `app_color`, `app_dev_name`, `app_dev_phone`, `app_dev_email`, `app_acct_name`, `app_acct_number`, `app_acct_bank`) VALUES
(1, 'logo.png', 'TankoTech VTU', 'Our App is not yet available', '09060202084', '07068700696', 'support@tankotechvtu.com.ng', 'No. 70 Kanti Quarters', 'fc.com/tankotechsolution', 'https://wa.me/+2347015512709', 'https://wa.me/+2347015512709', 'https://wa.me/+2347015512709', 'http://tankotech.com.ng/online_vtu', '2024', '1', '5', '1.0', '#d40f85', 'TankoTech Solutions', '07068700696', 'tankotechsolutions@gmail.com', 'TankoTech Solutions', '0116470087', 'Sterling Bank');

-- --------------------------------------------------------

--
-- Table structure for table `ip`
--

CREATE TABLE `ip` (
  `ip_id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `blacklist` varchar(1) NOT NULL,
  `machine` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `date_add` varchar(40) NOT NULL,
  `date_update` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `otp` varchar(8) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `sent_via` varchar(40) NOT NULL,
  `date_time` varchar(40) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  `password` varchar(100) NOT NULL,
  `balance` varchar(10) NOT NULL,
  `refer_balance` varchar(10) NOT NULL,
  `refer_code` varchar(10) NOT NULL,
  `kyc_update` varchar(1) NOT NULL,
  `date_add` varchar(30) NOT NULL,
  `apikey` varchar(255) NOT NULL,
  `user_bvn` varchar(20) DEFAULT NULL,
  `user_nin` varchar(20) DEFAULT NULL,
  `user_acct_name` varchar(120) DEFAULT NULL,
  `user_bank_name` varchar(120) DEFAULT NULL,
  `user_acct_number` varchar(20) DEFAULT NULL,
  `acct_type` varchar(100) NOT NULL,
  `autofund` varchar(1) DEFAULT NULL,
  `user_ip` varchar(120) NOT NULL,
  `user_pin` varchar(10) DEFAULT NULL,
  `wema_bank` varchar(100) DEFAULT NULL,
  `wema_number` varchar(20) DEFAULT NULL,
  `sterling_bank` varchar(100) DEFAULT NULL,
  `sterling_number` varchar(20) DEFAULT NULL,
  `rolex_bank` varchar(100) DEFAULT NULL,
  `rolex_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`ip_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ip`
--
ALTER TABLE `ip`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
