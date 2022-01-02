-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2022 at 10:42 AM
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
(1, '3', '$2a$10$0quxCVd2qSCHfWyfxP8w2eQsf0AhLx8ORqAftvFXHLEL3PyiWdG1a', 3, 1, 'e1468c44e22760aa283f55feb2685721'),
(2, 'nhanvien1', '$2y$10$NFDRNhXZhJEaKcdvk3mkQur97NA74SBvJfAGywB1/HMecGDlULc5a', 1, 0, 'c46506f317fd685c0a0b1d82322465f0'),
(3, 'tester', '$2y$10$8K66acEP3xZ5KFU4tjoSI.16V1A0AsPl3Dy/uhKEZbz.DVyDe7oYO', 4, 1, '59ad3b4e8db61ed68cec6ef24ae99a02');

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
(1, 'Phil', 'Jones', 'normie@gmail.com', '01122334455', NULL, 1),
(2, 'Super', 'Normal', 'normie@gmail.com', '0329928498', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/avatars/c46506f317fd685c0a0b1d82322465f0_MAS_6984.jpg', 1),
(3, 'Alexander', 'Tester', 'tester@gmail.com', '0329928498', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/avatars/59ad3b4e8db61ed68cec6ef24ae99a02_dwayne-the-rock-.jpg', 1);

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
  `managerID` int(6) UNSIGNED NOT NULL,
  `description` varchar(100) NOT NULL,
  `roomQuantity` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`id`, `managerID`, `description`, `roomQuantity`) VALUES
(1, 3, 'Phòng công nghệ thông tin của trường TDTU', 5),
(2, 1, 'Phòng Kế Toán TDTU', 20);

-- --------------------------------------------------------

--
-- Table structure for table `leave_info`
--

CREATE TABLE `leave_info` (
  `person_id` int(6) UNSIGNED NOT NULL,
  `role` int(6) UNSIGNED NOT NULL,
  `used_leaves` tinyint(3) UNSIGNED DEFAULT 0,
  `total_leaves` tinyint(3) UNSIGNED DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_info`
--

INSERT INTO `leave_info` (`person_id`, `role`, `used_leaves`, `total_leaves`) VALUES
(2, 1, 5, 12),
(3, 4, 0, 12);

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
  `date_accepted` datetime DEFAULT NULL,
  `date_wanted` date NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_record`
--

INSERT INTO `leave_record` (`id`, `leave_id`, `description`, `file_name`, `file`, `days`, `date_created`, `date_accepted`, `date_wanted`, `status`) VALUES
(3, 2, 'I Don\'t care', 'avatar.jpg', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/leaves/$2y$10$FJuWqJWueIlNUKPZb8qeuupxmVbwkurhFTEmxMJW4B6l8ekXUu4i.jpg', 5, '2022-01-01 09:07:22', '2022-01-01 16:24:07', '2022-01-04', 'refused'),
(4, 3, 'Bored', 'baocao.pdf', 'http://localhost/WEB-FINAL/Source/mvc/assets/uploads/leaves/$2y$10$rrF3Z7gX0.nX9MDfK3FG7uLXcyXGbcM4FgQlZSQ2vywfT2ii8i86.pdf', 1, '2022-01-02 02:55:55', NULL, '2022-01-19', 'waiting');

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
  `managerID` int(6) UNSIGNED NOT NULL,
  `staffID` int(6) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'new',
  `rating` varchar(10) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `managerID`, `staffID`, `title`, `description`, `status`, `rating`, `date`, `deadline`) VALUES
(1, 1, 2, 'Task1', 'asdasdasdsad', 'new', NULL, '2021-12-23 07:53:43', '2021-12-23 07:53:43');

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
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`date`) VALUES
('2022-01-01 09:20:58'),
('2022-01-30 15:20:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`person_id`),
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_record`
--
ALTER TABLE `task_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `leave_info_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `leave_info_ibfk_2` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

--
-- Constraints for table `leave_record`
--
ALTER TABLE `leave_record`
  ADD CONSTRAINT `leave_record_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `leave_info` (`person_id`);

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
