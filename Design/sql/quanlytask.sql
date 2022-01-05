-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 01:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

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
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`, `activated`, `token`) VALUES
(1, 'admin113', '$2a$10$tlNs1xVG0m59JvzVGMmdbeCOOw4uZgoCd308e0RYYg7op/LfaqbqK', 3, 1, '7f1f92e0bf0177173664a2cc2ea6d9ad'),
(2, 'tranthidao1', '$2y$10$gHLd7e9hgw0T3GhDF6DOcOQDU2GYdjyBx2hqh5dz9.q3QFJH/vn9m', 2, 1, '7174b03f45f185b6cc4fa63a7bdbb4e4'),
(3, 'nguyenthitruc1', '$2y$10$uPWdle4DG/LRgI7Mq3oP8eOCgWQKaHbGStmCKTSeqqKt7OafBIlz.', 1, 1, '3917fcd4f93681107cae549ff50f8b07');

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
  `avatar` varchar(200) DEFAULT NULL,
  `department` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`id`, `firstname`, `lastname`, `email`, `phone`, `avatar`, `department`) VALUES
(1, 'Khiêm', 'Trần Vĩnh', 'tranvinhkhiem@gmail.com', '02221115487', NULL, 1),
(2, 'Đào', 'Trần Thị', 'tranthidao@gmail.com', '0335548891', 'http://localhost/assets/uploads/avatars/7174b03f45f185b6cc4fa63a7bdbb4e4_beautiful-woman-with-natural-make-up-897056188-5c2d3aff4cedfd000165bdef-1400x787.jpg', 1),
(3, 'Trúc', 'Nguyễn Thị', 'nguyenthitruc@gmail.com', '0335848795', NULL, 1);

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
(1, 'Phòng Công Nghệ Thông Tin');

-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `id` int(6) UNSIGNED NOT NULL,
  `managerID` int(6) UNSIGNED DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `roomQuantity` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`id`, `managerID`, `description`, `roomQuantity`) VALUES
(1, 2, 'Phòng Công Nghệ Thông Tin của TDTU', 50);

-- --------------------------------------------------------

--
-- Table structure for table `leave_info`
--

CREATE TABLE `leave_info` (
  `person_id` int(6) UNSIGNED NOT NULL,
  `used_leaves` tinyint(3) UNSIGNED DEFAULT 0,
  `total_leaves` tinyint(3) UNSIGNED DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_info`
--

INSERT INTO `leave_info` (`person_id`, `used_leaves`, `total_leaves`) VALUES
(2, 2, 12),
(3, 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `leave_record`
--

CREATE TABLE `leave_record` (
  `id` int(6) UNSIGNED NOT NULL,
  `leave_id` int(6) UNSIGNED NOT NULL,
  `description` varchar(200) NOT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `days` tinyint(3) UNSIGNED NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_response` datetime DEFAULT NULL,
  `date_wanted` date NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_record`
--

INSERT INTO `leave_record` (`id`, `leave_id`, `description`, `file_name`, `file`, `days`, `date_created`, `date_response`, `date_wanted`, `status`) VALUES
(2, 2, 'Em muốn xin nghỉ ngày mai', '908884674-should-your-child-stay.jpg', 'http://localhost/assets/uploads/leaves/$2y$10$OjseiLoO7lh80bfWC1k4EuaENhmoNC2rNSotrnzC4RbhqzCebq7O.jpg', 1, '2022-01-05 12:34:54', '2022-01-05 19:35:26', '2022-01-06', 'refused');

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
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(6) UNSIGNED NOT NULL,
  `manager_id` int(6) UNSIGNED NOT NULL,
  `staff_id` int(6) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'New',
  `rating` varchar(10) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `manager_id`, `staff_id`, `title`, `description`, `status`, `rating`, `date_created`, `deadline`) VALUES
(1, 2, 3, 'Để tài nghiên cứu về Web Security', 'Đây là một đề tài khá dễ để bắt đầu, hi vọng em hoàn thành nó sớm trước deadline. Chị có đính kèm file để hỗ trợ em trong việc nghiên cứu.', 'In progress', NULL, '2022-01-05 12:20:55', '2022-01-08 19:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `task_record`
--

CREATE TABLE `task_record` (
  `id` int(6) UNSIGNED NOT NULL,
  `task_id` int(6) UNSIGNED NOT NULL,
  `person_id` int(6) UNSIGNED NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'New',
  `note` varchar(200) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_record`
--

INSERT INTO `task_record` (`id`, `task_id`, `person_id`, `status`, `note`, `file_name`, `file`, `date`) VALUES
(1, 1, 2, 'New', NULL, 'webSecurity.docx', 'http://localhost/assets/uploads/tasks/$2y$10$rd1PuZJx5W6NzEP2HcRS.vfDTRGttGPVktKtAw1aMg5.MKm.rdg2.docx', '2022-01-05 12:36:04'),
(2, 1, 3, 'In progress', NULL, NULL, NULL, '2022-01-05 12:36:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `token` (`token`),
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
  ADD PRIMARY KEY (`person_id`);

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
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `task_record`
--
ALTER TABLE `task_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_record`
--
ALTER TABLE `task_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `leave_info_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `leave_record`
--
ALTER TABLE `leave_record`
  ADD CONSTRAINT `leave_record_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `leave_info` (`person_id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `task_record`
--
ALTER TABLE `task_record`
  ADD CONSTRAINT `task_record_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  ADD CONSTRAINT `task_record_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
