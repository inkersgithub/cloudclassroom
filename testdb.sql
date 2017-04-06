-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2017 at 02:47 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `sn` int(11) NOT NULL,
  `uclassname` varchar(70) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `reply` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`sn`, `uclassname`, `sname`, `email`, `feedback`, `reply`, `status`) VALUES
(10, 'anoop@gmail.com|DCS', 'Navaneetha', 'sree@gmail.com', 'zdfvdfvsdfvds', 'sdfvdfsv', 1);

-- --------------------------------------------------------

--
-- Table structure for table `foruma`
--

CREATE TABLE `foruma` (
  `sn` int(11) NOT NULL,
  `threadid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `answer` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forumq`
--

CREATE TABLE `forumq` (
  `threadn` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `uclassname` varchar(60) NOT NULL,
  `thread` text NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `sn` int(11) NOT NULL,
  `uclassname` varchar(50) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`sn`, `name`, `email`, `institute`, `uclassname`, `classname`, `status`) VALUES
(66, 'Navaneetha', 'sree@gmail.com', 'PKDIMS', 'zade@gmail.com|TOC', 'TOC', 0),
(65, 'Navaneetha', 'sree@gmail.com', 'PKDIMS', 'zade@gmail.com|DBMS', 'DBMS', 0),
(69, 'Ashi', 'ashi@gmail.com', 'MES', 'zade@gmail.com|TOC', 'TOC', 0),
(70, 'Ashi', 'ashi@gmail.com', 'MES', 'zade@gmail.com|DBMS', 'DBMS', 0);

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
(8, 'sree@gmail.com', 'DCS', 'anoop@gmail.com|DCS', 'Anoop'),
(9, 'sree@gmail.com', 'MIS', 'anoop@gmail.com|MIS', 'Anoop'),
(10, 'ashi@gmail.com', 'MIS', 'anoop@gmail.com|MIS', 'Anoop'),
(11, 'ashi@gmail.com', 'DCS', 'anoop@gmail.com|DCS', 'Anoop');

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
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`uclassname`,`email`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `foruma`
--
ALTER TABLE `foruma`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `forumq`
--
ALTER TABLE `forumq`
  ADD PRIMARY KEY (`threadn`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`sn`);

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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `foruma`
--
ALTER TABLE `foruma`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `forumq`
--
ALTER TABLE `forumq`
  MODIFY `threadn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `studentclass`
--
ALTER TABLE `studentclass`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
