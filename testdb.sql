-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2017 at 03:49 PM
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
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `sn` int(11) NOT NULL,
  `uclassname` varchar(70) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `foruma`
--

CREATE TABLE `foruma` (
  `sn` int(11) NOT NULL,
  `threadid` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `uclassname` varchar(70) NOT NULL,
  `name` varchar(50) NOT NULL,
  `answer` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foruma`
--

INSERT INTO `foruma` (`sn`, `threadid`, `email`, `uclassname`, `name`, `answer`, `date`) VALUES
(49, '42', 'ashi@gmail.com', 'anoop@gmail.com|DCS', 'Ashi|student', 'uhymjioumjio', '2017-04-08 12:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `forumq`
--

CREATE TABLE `forumq` (
  `threadn` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `uclassname` varchar(60) NOT NULL,
  `thread` text NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forumq`
--

INSERT INTO `forumq` (`threadn`, `name`, `email`, `uclassname`, `thread`, `date`) VALUES
(42, 'Anoop|teacher', 'anoop@gmail.com', 'anoop@gmail.com|DCS', ',lp;mkil;kml', '2017-04-08 12:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `sn` int(11) NOT NULL,
  `uclassname` varchar(70) NOT NULL,
  `embedcode` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`sn`, `uclassname`, `embedcode`) VALUES
(1, 'anoop@gmail.com|DCS', '<iframe src=\"https://docs.google.com/spreadsheets/d/1Aq16ANRVUFJ35Z6FQY6dwMhAYOmkWO_I6UpKWCaWoc8/pubhtml?widget=true&amp;headers=false\"></iframe>');

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
-- Table structure for table `qbank`
--

CREATE TABLE `qbank` (
  `sn` int(11) NOT NULL,
  `uclassname` varchar(70) NOT NULL,
  `question` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qbank`
--

INSERT INTO `qbank` (`sn`, `uclassname`, `question`) VALUES
(10, 'zade@gmail.com|TOC', 'What is a computer?'),
(11, 'zade@gmail.com|TOC', 'What is a CPU?');

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
(65, 'Navaneetha', 'sree@gmail.com', 'PKDIMS', 'zade@gmail.com|DBMS', 'DBMS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentclass`
--

CREATE TABLE `studentclass` (
  `sn` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `studentname` varchar(30) NOT NULL,
  `institute` varchar(70) NOT NULL,
  `classname` varchar(40) NOT NULL,
  `uclassname` varchar(50) NOT NULL,
  `teachername` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentclass`
--

INSERT INTO `studentclass` (`sn`, `email`, `studentname`, `institute`, `classname`, `uclassname`, `teachername`) VALUES
(8, 'sree@gmail.com', 'Navaneetha', 'PKDIMS', 'DCS', 'anoop@gmail.com|DCS', 'Anoop'),
(9, 'sree@gmail.com', 'Navaneetha', 'PKDIMS', 'MIS', 'anoop@gmail.com|MIS', 'Anoop'),
(10, 'ashi@gmail.com', 'Ashi', 'MES', 'MIS', 'anoop@gmail.com|MIS', 'Anoop'),
(11, 'ashi@gmail.com', 'Ashi', 'MES', 'DCS', 'anoop@gmail.com|DCS', 'Anoop'),
(14, 'sree@gmail.com', 'Navaneetha', 'PKDIMS', 'TOC', 'zade@gmail.com|TOC', 'Zade'),
(15, 'ashi@gmail.com', 'Ashi', 'MES', 'TOC', 'zade@gmail.com|TOC', 'Zade'),
(16, 'ashi@gmail.com', 'Ashi', 'MES', 'DBMS', 'zade@gmail.com|DBMS', 'Zade');

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
(11, 'Ashi', 'ashi@gmail.com', 'MES', '21232f297a57a5a743894a0e4a801fc3', 'student'),
(12, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`sn`);

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
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`uclassname`),
  ADD UNIQUE KEY `sn` (`sn`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `qbank`
--
ALTER TABLE `qbank`
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
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `foruma`
--
ALTER TABLE `foruma`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `forumq`
--
ALTER TABLE `forumq`
  MODIFY `threadn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `qbank`
--
ALTER TABLE `qbank`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `studentclass`
--
ALTER TABLE `studentclass`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `teacherclass`
--
ALTER TABLE `teacherclass`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
