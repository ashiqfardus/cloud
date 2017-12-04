-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2017 at 12:17 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloud_storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `file_size` varchar(15) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `file_name`, `username`, `file_size`, `file_type`, `date`) VALUES
(34, 'angry_alien_ru3351.jpg', 'ashiq', '0.028912', 'image/jpeg', '2017-11-28 19:18:18'),
(35, 'provisional_card_19969318527000015.pdf', 'ashiq', '0.134182', 'application/pdf', '2017-11-28 19:18:27'),
(37, 'Read Me.txt', 'ashiq', '0.000332', 'text/plain', '2017-11-28 19:19:10'),
(39, 'aaa.jpg', 'bappy', '0.053199', 'image/jpeg', '2017-11-28 21:50:10'),
(40, 'CrazyHD.com-Duvvada Jagannadham (2017) 720p Hindi HDTV-AAC _Ranvijay.torrent', 'bappy', '0.011362', 'application/x-bittor', '2017-11-28 21:50:16'),
(41, '22549481_281073699068656_3268305738938195703_n.jpg', 'bappy', '0.006391', 'image/jpeg', '2017-11-28 21:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `profile_details`
--

CREATE TABLE `profile_details` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `profile_name` varchar(25) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `gender` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_details`
--

INSERT INTO `profile_details` (`id`, `username`, `profile_name`, `profile_pic`, `dob`, `gender`) VALUES
(5, 'ashiq', 'Ashiq Fardus', 'Arjun-Reddy-Review.jpg', '2017-11-16', 'Male'),
(6, 'bappy', 'Bappy Ahmed', 'Ershadbest-1444267133-dc939a6_xlarge.jpg', '2017-12-14', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `shared`
--

CREATE TABLE `shared` (
  `id` int(11) NOT NULL,
  `file_name` varchar(300) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `shared_by` varchar(30) NOT NULL,
  `shared_to` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shared`
--

INSERT INTO `shared` (`id`, `file_name`, `file_size`, `file_type`, `shared_by`, `shared_to`, `date`) VALUES
(6, 'Read Me.txt', '0.000332', 'text/plain', 'ashiq', 'Ashiq ', '2017-11-28 21:15:01'),
(8, 'provisional_card_19969318527000015.pdf', '0.134182', 'application/pdf', 'ashiq', 'ashiq ', '2017-11-28 21:23:01'),
(9, '22549481_281073699068656_3268305738938195703_n.jpg', '0.006391', 'image/jpeg', 'bappy', 'Ashiq ', '2017-11-28 21:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

CREATE TABLE `trash` (
  `id` int(11) NOT NULL,
  `file_name` varchar(300) NOT NULL,
  `username` varchar(30) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trash`
--

INSERT INTO `trash` (`id`, `file_name`, `username`, `file_size`, `file_type`, `date`) VALUES
(36, '[TorrentGear.com]The Son of Bigfoot 2017 1080p WEB-DL H264 AC3-EVO.torrent', 'ashiq', '0.514413', 'application/x-bittor', '2017-11-28 21:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `username`, `email`, `password`, `date`) VALUES
(15, 'ashiq', 'ashiqfardus@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2017-11-28 19:14:00'),
(16, 'bappy', 'piashahmed304@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2017-11-28 21:49:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_details`
--
ALTER TABLE `profile_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared`
--
ALTER TABLE `shared`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash`
--
ALTER TABLE `trash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `profile_details`
--
ALTER TABLE `profile_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `shared`
--
ALTER TABLE `shared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `trash`
--
ALTER TABLE `trash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
