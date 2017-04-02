-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2017 at 03:11 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `sn` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `institute` varchar(40) NOT NULL,
  `uclassname` varchar(60) NOT NULL,
  `classname` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentclass`
--

CREATE TABLE `studentclass` (
  `sn` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `classname` varchar(40) NOT NULL,
  `uclassname` varchar(50) NOT NULL,
  `teachername` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentclass`
--

INSERT INTO `studentclass` (`sn`, `email`, `classname`, `uclassname`, `teachername`) VALUES
(3, 'sree@gmail.com', 'TOC', 'zade@gmail.com|TOC', 'Zade'),
(5, 'sree@gmail.com', 'DCS', 'anoop@gmail.com|DCS', 'Anoop'),
(6, 'sree@gmail.com', 'MIS', 'anoop@gmail.com|MIS', 'Anoop');

-- --------------------------------------------------------

--
-- Table structure for table `teacherclass`
--

CREATE TABLE `teacherclass` (
  `sn` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `classname` varchar(40) NOT NULL,
  `uclassname` varchar(50) NOT NULL,
  `teachername` varchar(20) NOT NULL,
  `institute` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacherclass`
--

INSERT INTO `teacherclass` (`sn`, `email`, `classname`, `uclassname`, `teachername`, `institute`) VALUES
(36, 'zade@gmail.com', 'TOC', 'zade@gmail.com|TOC', 'Zade', 'JCET'),
(38, 'anoop@gmail.com', 'DCS', 'anoop@gmail.com|DCS', 'Anoop', 'JCET'),
(39, 'anoop@gmail.com', 'MIS', 'anoop@gmail.com|MIS', 'Anoop', 'JCET'),
(40, 'zade@gmail.com', 'DBMS', 'zade@gmail.com|DBMS', 'Zade', 'JCET');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `institute` varchar(70) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `institute`, `password`, `type`) VALUES
(8, 'Navaneetha', 'sree@gmail.com', 'PKDIMS', '21232f297a57a5a743894a0e4a801fc3', 'student'),
(9, 'Zade', 'zade@gmail.com', 'JCET', '21232f297a57a5a743894a0e4a801fc3', 'teacher'),
(10, 'Anoop', 'anoop@gmail.com', 'JCET', '21232f297a57a5a743894a0e4a801fc3', 'teacher'),
(11, 'Ashi', 'ashi@gmail.com', 'MES', '21232f297a57a5a743894a0e4a801fc3', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`email`,`uclassname`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `studentclass`
--
ALTER TABLE `studentclass`
  ADD PRIMARY KEY (`email`,`uclassname`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `teacherclass`
--
ALTER TABLE `teacherclass`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `uclassname` (`uclassname`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD KEY `email_4` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `studentclass`
--
ALTER TABLE `studentclass`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teacherclass`
--
ALTER TABLE `teacherclass`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
