-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 08:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlytask`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(6) UNSIGNED DEFAULT 1,
  `activated` tinyint(4) DEFAULT 0,
  `token` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`, `activated`, `token`) VALUES
(1, 'admin', '$2a$10$0quxCVd2qSCHfWyfxP8w2eQsf0AhLx8ORqAftvFXHLEL3PyiWdG1a', 3, 1, '1'),
(2, 'nhanvien1', '$2y$10$.oz/.AD4SXN3A4F9j6v8ZehKCDnz32NhXKFpZIyga2hzAuxKElvUC', 1, 1, 'token1');

-- --------------------------------------------------------

--
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `department` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`id`, `firstname`, `lastname`, `email`, `phone`, `avatar`, `department`) VALUES
(1, 'Super', 'Admin', 'nguyenminhthien@gmail.com', '01122334455', 'asd', 1),
(2, 'Super', 'Person', 'normie@gmail.com', '01122334455', 'asd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Phòng Công Nghệ thông tin');

-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `id` int(6) UNSIGNED NOT NULL,
  `managerID` int(6) UNSIGNED NOT NULL,
  `description` varchar(100) NOT NULL,
  `roomQuantity` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`id`, `managerID`, `description`, `roomQuantity`) VALUES
(1, 1, 'Phòng công nghệ thông tin của trường TDTU', 5);

-- --------------------------------------------------------

--
-- Table structure for table `leave_info`
--

CREATE TABLE `leave_info` (
  `id` int(6) UNSIGNED NOT NULL,
  `personID` int(6) UNSIGNED NOT NULL,
  `role` int(6) UNSIGNED NOT NULL,
  `used_leaves` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `total_leaves` tinyint(3) UNSIGNED NOT NULL DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_record`
--

CREATE TABLE `leave_record` (
  `id` int(6) UNSIGNED NOT NULL,
  `leave_id` int(6) UNSIGNED NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(30) NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(6) UNSIGNED NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Nhân Viên'),
(2, 'Trưởng phòng'),
(3, 'Giám Đốc');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `age`) VALUES
(1, 'Lam Truong', 20),
(2, 'Dan Truong', 21),
(3, 'Cam Ly', 19);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(6) UNSIGNED NOT NULL,
  `managerID` int(6) UNSIGNED NOT NULL,
  `staffID` int(6) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'new',
  `rating` varchar(10) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_record`
--

CREATE TABLE `task_record` (
  `id` int(6) UNSIGNED NOT NULL,
  `task_id` int(6) UNSIGNED NOT NULL,
  `personID` int(6) UNSIGNED NOT NULL,
  `role` int(6) UNSIGNED NOT NULL,
  `status` varchar(30) NOT NULL,
  `note` varchar(100) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialty` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `specialty`) VALUES
(1, 'Tuan Hung', 'Toan'),
(2, 'Bang Kieu', 'Ly'),
(3, 'Hong Nhung', 'Hoa'),
(4, 'Quang Vinh', 'Sinh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_info`
--
ALTER TABLE `department_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `managerID` (`managerID`);

--
-- Indexes for table `leave_info`
--
ALTER TABLE `leave_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personID` (`personID`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `leave_record`
--
ALTER TABLE `leave_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_id` (`leave_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `managerID` (`managerID`),
  ADD KEY `staffID` (`staffID`);

--
-- Indexes for table `task_record`
--
ALTER TABLE `task_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `personID` (`personID`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_info`
--
ALTER TABLE `leave_info`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_record`
--
ALTER TABLE `task_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

--
-- Constraints for table `account_info`
--
ALTER TABLE `account_info`
  ADD CONSTRAINT `account_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `account_info_ibfk_2` FOREIGN KEY (`department`) REFERENCES `department` (`id`);

--
-- Constraints for table `department_info`
--
ALTER TABLE `department_info`
  ADD CONSTRAINT `department_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `department_info_ibfk_2` FOREIGN KEY (`managerID`) REFERENCES `account` (`id`);

--
-- Constraints for table `leave_info`
--
ALTER TABLE `leave_info`
  ADD CONSTRAINT `leave_info_ibfk_1` FOREIGN KEY (`personID`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `leave_info_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

--
-- Constraints for table `leave_record`
--
ALTER TABLE `leave_record`
  ADD CONSTRAINT `leave_record_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `leave_info` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`managerID`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`staffID`) REFERENCES `account` (`id`);

--
-- Constraints for table `task_record`
--
ALTER TABLE `task_record`
  ADD CONSTRAINT `task_record_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  ADD CONSTRAINT `task_record_ibfk_2` FOREIGN KEY (`personID`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `task_record_ibfk_3` FOREIGN KEY (`role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
