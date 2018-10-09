-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2018 at 07:59 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bvmts`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `f_id` int(100) NOT NULL,
  `f_fname` varchar(30) NOT NULL,
  `f_lname` varchar(30) NOT NULL,
  `f_email` varchar(10) NOT NULL,
  `f_mobile_no` varchar(10) NOT NULL,
  `f_password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `que_id` int(100) NOT NULL,
  `question` varchar(500) NOT NULL,
  `a1` varchar(50) NOT NULL,
  `a2` varchar(50) NOT NULL,
  `a3` varchar(50) NOT NULL,
  `a4` varchar(50) NOT NULL,
  `test_id` int(100) NOT NULL,
  `que_ans` varchar(10) NOT NULL,
  `que_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(100) NOT NULL,
  `student_id` int(100) NOT NULL,
  `test_id` int(100) NOT NULL,
  `result_right` varchar(100) NOT NULL,
  `result_attended` varchar(100) NOT NULL,
  `result_total` varchar(10) NOT NULL,
  `result_left_time` varchar(100) NOT NULL,
  `result_updated_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(100) NOT NULL,
  `student_idno` varchar(100) NOT NULL,
  `student_fname` varchar(30) NOT NULL,
  `student_lname` varchar(30) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `student_mobile_no` varchar(10) NOT NULL,
  `student_password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(100) NOT NULL,
  `test_title` varchar(50) NOT NULL,
  `test_course` varchar(50) NOT NULL,
  `test_subjects` varchar(100) NOT NULL,
  `test_total_num` varchar(50) DEFAULT '0',
  `test_postedby` varchar(100) NOT NULL,
  `test_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `test_duration` varchar(100) DEFAULT '-99'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visited_test`
--

CREATE TABLE `visited_test` (
  `vis_id` int(255) NOT NULL,
  `student_id` int(100) DEFAULT NULL,
  `test_id` int(100) DEFAULT NULL,
  `vis_left_time` varchar(100) DEFAULT NULL,
  `vis_current_id` varchar(100) DEFAULT NULL,
  `vis_attempt` varchar(10) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`f_id`),
  ADD UNIQUE KEY `f_email` (`f_email`),
  ADD UNIQUE KEY `f_mobile_no` (`f_mobile_no`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`que_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_idno` (`student_idno`),
  ADD UNIQUE KEY `student_email` (`student_email`),
  ADD UNIQUE KEY `student_mobile_no` (`student_mobile_no`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `visited_test`
--
ALTER TABLE `visited_test`
  ADD PRIMARY KEY (`vis_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_id` (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `f_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `que_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visited_test`
--
ALTER TABLE `visited_test`
  MODIFY `vis_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `visited_test`
--
ALTER TABLE `visited_test`
  ADD CONSTRAINT `visited_test_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `visited_test_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
