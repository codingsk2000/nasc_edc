-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2022 at 11:52 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17199416_nasc_edc`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `max_stu` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `department`, `max_stu`, `created_at`, `status`) VALUES
(1, 'Multimedia Tools', 2, 1, '2021-12-04 05:59:35', 1),
(2, 'Web Development using HTML', 2, 1, '2021-12-04 05:59:56', 1),
(3, 'Entrepreneurship Development', 3, 0, '2022-01-24 02:48:16', 1),
(4, 'Soft Skill Development', 3, 0, '2022-01-24 02:48:34', 1),
(5, 'Basics of Nutrition', 4, 0, '2022-01-24 02:51:41', 1),
(6, 'Herbal Remedies', 4, 0, '2022-01-24 02:51:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dep_name`, `created_at`, `status`) VALUES
(2, 'bca', '2021-12-04 05:58:44', 1),
(3, 'bba', '2021-12-04 06:05:27', 1),
(4, 'Biochemistry', '2022-01-24 02:51:03', 1),
(5, 'Biotechnology', '2022-01-24 02:52:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_head`
--

CREATE TABLE `department_head` (
  `id` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total_stu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_head`
--

INSERT INTO `department_head` (`id`, `department`, `username`, `password`, `total_stu`, `created_at`, `token`, `status`) VALUES
(1, 2, 'bca@gmail.com', 'b64eab8ce39e013604e243089c687e4f', 108, '2022-01-24 14:49:19', 'c1481fcf0e117c8c03cebac66f12277a', 1),
(2, 3, 'bba@gmail.com', 'b64eab8ce39e013604e243089c687e4f', 100, '2022-01-24 14:46:25', '22c13a9ef88f4913a7d6fc27db3fc1d1', 1),
(3, 4, 'Biochemistry@gmail.com', 'b64eab8ce39e013604e243089c687e4f', 100, '2022-01-24 14:51:16', 'b3a28bdf9ae3d5c1eb6708ff188cde8a', 1),
(4, 5, 'Biotechnology@gmail.com', 'b64eab8ce39e013604e243089c687e4f', 100, '2022-01-24 14:52:44', 'fc34835bb62f25121ea55b8a9cadf3eb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `register_no` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dept` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_head`
--
ALTER TABLE `department_head`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept` (`dept`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department_head`
--
ALTER TABLE `department_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`id`);

--
-- Constraints for table `department_head`
--
ALTER TABLE `department_head`
  ADD CONSTRAINT `department_head_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`dept`) REFERENCES `department` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
