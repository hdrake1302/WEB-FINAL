-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2022 at 08:01 AM
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
(1, 'admin113', '$2a$10$tlNs1xVG0m59JvzVGMmdbeCOOw4uZgoCd308e0RYYg7op/LfaqbqK', 3, 1, '7f1f92e0bf0177173664a2cc2ea6d9ad'),
(2, 'tranthidao1', '$2y$10$/r463wLpiJpoRg/1dRuHmuPx.hVgg.nkfJCe7WoJxXMdsgMeihtjq', 2, 1, '7174b03f45f185b6cc4fa63a7bdbb4e4'),
(3, 'nguyenthitruc1', '$2y$10$uPWdle4DG/LRgI7Mq3oP8eOCgWQKaHbGStmCKTSeqqKt7OafBIlz.', 1, 1, '3917fcd4f93681107cae549ff50f8b07'),
(4, 'nguyenthikimtien1', '$2y$10$c7lyrkzvg6WIVjxN3dnDpOBKhNqf55SzpjdBvX3ScM24n6cvvck4e', 1, 1, 'fc03335e22d5ef7100e6c67c95c57b12'),
(5, 'truonghuukhang1', '$2y$10$K2pZbK5TLdn8IglHgC0h3u1ffza96J1JFNd1qxbsbPsFcnxEfA.Ge', 2, 0, '71bce63718312d0ce02cbad22a237c97'),
(6, 'bachquoctuan1', '$2y$10$8yEYMVq5xUFAyiurT0sMceoTGuMSRu8.O81cyU/4qGNGQ2pgzd4L2', 1, 0, '7f53ec30f116019f0c30a659b318ba85'),
(7, 'truongthikimloan1', '$2y$10$m/Rkbk53kPWuWYEiiX0fduVlnZ7geHXURlwGG9y2L9PEdopWQSBju', 1, 0, '267c9d7323480a19ef35fe0a3761b10f');

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
(3, 'Trúc', 'Nguyễn Thị', 'nguyenthitruc@gmail.com', '0335848795', NULL, 1),
(4, 'Tiên', 'Nguyễn Thị Kim', 'nguyenthikiemtien0312@gmail.com', '0935554483', NULL, 1),
(5, 'Khang', 'Trương Hữu', 'truonghuukhang2305@gmail.com', '0992284453', NULL, 2),
(6, 'Tuấn', 'Bạch Quốc', 'bachquoctuan251@gmail.com', '0327788845', NULL, 2),
(7, 'Loan', 'Trương Thị Kim', 'truongthikimloan2105@gmail.com', '0909224425', NULL, 2);

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
(1, 'Phòng Công Nghệ Thông Tin'),
(2, 'Phòng Kế Toán'),
(3, 'Phòng Hành Chính'),
(4, 'Phòng Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `id` int(6) UNSIGNED NOT NULL,
  `managerID` int(6) UNSIGNED DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `roomQuantity` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`id`, `managerID`, `description`, `roomQuantity`) VALUES
(1, 2, 'Tham mưu và tổ chức, triển khai thực hiện quản lý toàn bộ hệ thống công nghệ thông tin (CNTT) thuộc Trường; bao gồm: Quản lý hệ thống mạng, hệ thống ứng dụng CNTT phục vụ hoạt động nghiên cứu, đào tạo và quản trị Trường.', 20),
(2, 5, 'Bộ phận này có trách nhiệm đảm bảo cho công ty các chế độ như lương, thưởng, thu, chi,…', 10),
(3, NULL, 'Bộ phận này chịu trách nhiệm về tình hình nhân sự của công ty. Có trách nhiệm theo dõi, đôn đốc, quản lý và tuyển dụng nhân sự, bố trí các lao động ở vị trí việc làm phù hợp để đảm bảo nguồn nhân lực cho sản xuất. Có trách nhiệm về các loại văn bản, giấy tờ, hồ sơ, sổ sách trong công ty. Triển khai các nội quy của công ty, hoạt động khen thưởng, hoạt động phúc lợi.', 10),
(4, NULL, 'Xây dựng chiến lược marketing cho doanh nghiệp; điều hành việc triển khai chiến lược marketing; theo dõi, giám sát quá trình thực hiện, kịp thời điều chỉnh và đánh giá, báo cáo kết quả chiến lược marketing.', 10);

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
(2, 1, 15),
(3, 0, 12),
(4, 0, 12),
(5, 0, 15),
(6, 0, 12),
(7, 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `leave_record`
--

CREATE TABLE `leave_record` (
  `id` int(6) UNSIGNED NOT NULL,
  `leave_id` int(6) UNSIGNED NOT NULL,
  `description` varchar(1000) NOT NULL,
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
(2, 2, 'Em muốn xin nghỉ ngày mai', '908884674-should-your-child-stay.jpg', 'http://localhost/assets/uploads/leaves/$2y$10$OjseiLoO7lh80bfWC1k4EuaENhmoNC2rNSotrnzC4RbhqzCebq7O.jpg', 1, '2022-01-02 12:34:54', '2022-01-02 19:35:26', '2022-01-06', 'refused'),
(3, 2, 'Em bị bệnh nặng, xin anh cho em nghỉ ngày mai ạ.', 'sick.jpg', 'http://localhost/assets/uploads/leaves/$2y$10$.SZP9wqv8b0q0VmbgTeLnez5BnY57y6EUBqDwqCLNwXjSv6.3y.jpg', 1, '2022-01-10 05:55:52', '2022-01-10 13:28:54', '2022-01-11', 'approved'),
(4, 4, 'Em muốn xin nghỉ về quê ạ', NULL, NULL, 2, '2022-01-10 06:49:22', NULL, '2022-01-11', 'waiting'),
(5, 3, 'Em muốn xin nghỉ để dự đám cưới của bạn ạ.', NULL, NULL, 1, '2022-01-10 06:52:38', NULL, '2022-01-12', 'waiting');

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
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'New',
  `rating` varchar(10) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `manager_id`, `staff_id`, `title`, `description`, `status`, `rating`, `date_created`, `deadline`) VALUES
(1, 2, 3, 'Để tài nghiên cứu về Web Security', 'Đây là một đề tài khá dễ để bắt đầu, hi vọng em hoàn thành nó sớm trước deadline. Chị có đính kèm file để hỗ trợ em trong việc nghiên cứu.', 'In progress', NULL, '2022-01-05 12:20:55', '2022-01-08 19:18:41'),
(2, 2, 4, 'Đề tài nghiên cứu về áp dụng AI vào việc xử lý ảnh', 'Hoàn thành trước deadline nhé.', 'Completed', 'Good', '2022-01-10 06:24:51', '2022-01-11 13:23:24');

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
(2, 1, 3, 'In progress', NULL, NULL, NULL, '2022-01-05 12:36:56'),
(3, 2, 2, 'New', NULL, NULL, NULL, '2022-01-10 06:24:51'),
(8, 2, 4, 'In progress', NULL, NULL, NULL, '2022-01-10 06:29:41'),
(9, 2, 4, 'Waiting', 'Em xong rồi anh ạ.', 'AI.docx', 'http://localhost/assets/uploads/tasks/$2y$10$eOkVHpb8ImKyWoVrwr2dtuCe0fJrtMaL.BvHHDCtGDBYja1uuTivy.docx', '2022-01-10 06:34:03'),
(10, 2, 2, 'Completed', NULL, NULL, NULL, '2022-01-10 06:35:34');

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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_record`
--
ALTER TABLE `task_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
