-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2022 at 02:00 PM
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
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`, `activated`, `token`) VALUES
(1, 'tester', '$2a$10$R.6Sws2pD43J6.ZhCauru.Qc6DrJQktCSVWOYflS4KdUgtTXEJvFy', 4, 1, '7f1f92e0bf0177173664a2cc2ea6d9ad'),
(2, 'nhanvien1', '$2y$10$r/tGSEpPKLuUkjLUqE0VSOcnGBFoQ9PJV753HNuKCrnN3GKDb4oTS', 1, 1, 'e8a27d9a877f789105422200e101467b'),
(3, 'nhanvien2', '$2y$10$0ycWfpKJMHUthv6SQRlp9OdIIu1Y1kZpE/9vj9f2MleNEhLbUYtm.', 1, 0, 'fedeee257dba30508875dc095d7c1773');

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
(1, 'Tester', 'Alexander', 'tester@gmail.com', '0329928498', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/avatars/7f1f92e0bf0177173664a2cc2ea6d9ad_dwayne-the-rock-.jpg', 1),
(2, 'Đào', 'Nguyễn Thị', 'nguyenthidao@gmail.com', '02333444521', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/avatars/e8a27d9a877f789105422200e101467b_MAS_6984.jpg', 1),
(3, 'Trúc', 'Nguyễn Kim', 'nguyenkimtruc@gmail.com', '0224551231', NULL, 1);

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
(1, 'Phòng Công Nghệ thông tin'),
(2, 'Phòng Kế Toán');

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
(1, 1, 'Phòng Công Nghệ Thông Tin TDTU', 15),
(2, NULL, 'Phòng kế toán TDTU', 30);

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
(1, 0, 12),
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
(1, 2, 'Phải dự tiệc cưới', 'dssv_xetmoi_tcqp_122021_congbo-(20211215_054414_448).pdf', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/leaves/$2y$10$opmhppMWnpXx4e7h7zQZh.P8I6JDP5eYi3e6KasPfJkdd1fBKHTYq.pdf', 1, '2021-12-01 14:44:40', '2021-12-02 21:45:29', '2022-01-04', 'refused'),
(2, 2, 'Phải đi bệnh viện để chăm sóc cho vợ.', 'DoAnCuoiKi-HK1-2021-2022.pdf', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/leaves/$2y$10$GVr6umKjOK.EDupSee4e.GNEAuvDlL0xqCTp5zIPSCtVb4q4WDPq.pdf', 2, '2021-12-16 14:47:37', '2021-12-17 21:48:34', '2022-01-05', 'approved'),
(8, 2, 'Mệt quá', 'sad.png', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/leaves/$2y$10$kSsQz1qAMVGpYXrTXEAO3eW86OBQHpp1klodp2543q.qJ5TAVN1e.png', 1, '2022-01-03 10:56:24', NULL, '2022-01-05', 'waiting');

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
(3, 'Giám Đốc'),
(4, 'Tester');

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
(1, 1, 2, 'asd', 'sad', 'In progress', NULL, '2022-01-03 11:13:14', '2022-01-04 18:11:07');

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
(1, 1, 1, 'new', NULL, 'MAS_6984.jpg', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/tasks/$2y$10$ptqOZz1yev1A6V7SCcc7PO3eLkd3rHJVth9JXO.FXlUva1.uQLEC.jpg', '2022-01-03 11:13:32'),
(10, 1, 2, 'In progress', NULL, NULL, NULL, '2022-01-03 12:30:16');

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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task_record`
--
ALTER TABLE `task_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
