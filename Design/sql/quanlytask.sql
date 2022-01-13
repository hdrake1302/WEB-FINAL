-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 06:31 AM
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
CREATE DATABASE IF NOT EXISTS `quanlytask` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quanlytask`;

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
(5, 'truonghuukhang1', '$2y$10$Zi02LCms3oroMrhJBDQbsuXM0H4K4yzqz7YH8gxZykchsFBrjFk..', 2, 1, '71bce63718312d0ce02cbad22a237c97'),
(6, 'bachquoctuan1', '$2y$10$sZxXKNMbGvIDEWz2pzUF8egGmJ9z4AWU0fVZmBSHyhDuzvSiRCpvu', 1, 1, '7f53ec30f116019f0c30a659b318ba85'),
(7, 'truongthikimloan1', '$2y$10$zkv/mTO1XjzRDWKcR7uSNuNut93RLXfvN82uDyBtEUhOHJLfNFfF6', 1, 1, '267c9d7323480a19ef35fe0a3761b10f'),
(8, 'nguyenhaidang1', '$2y$10$D5IIA4JJt4K3gV9DDZ.1hul/8mFHNlytGcWIpz2xHNtxbAU0bNmfi', 1, 1, '827087380a066776250fba3ac30147fe'),
(9, 'truongngocdiep1', '$2y$10$aesrREOnRyFynIIjfyqam.CWOsxFtha9fC3l5IbVDAAOapvcLPh82', 2, 1, '2ab5a7e5a0869a5f4296874d9e11e8a4'),
(10, 'tranthaibao1', '$2y$10$V0OPr2LdqTTh2L5rzDKWE.Zf/OmVkQj93hu7OCebAj5seOo7RACNO', 1, 0, '6be371a12dcfbd86f0b5fabc56670fa2'),
(11, 'phanminhvuong1', '$2y$10$Khfhz9YsAPb0g2jakcmLjeKQGhIFU8bcO/UWpNMiWcQyqrRUh0G8O', 1, 0, '34ec31e1ae86ac6446a741e5cc44f7a8'),
(12, 'phamthuyanh1', '$2y$10$cGq8k8RuN5OfqTOWVxTHIuTyAdG/AMF3hRO.jRl2xAjd3qrX45hpi', 1, 0, 'b7874659f6835225741fe2ae3d9224ad'),
(13, 'trinhnguyenkhoi1', '$2y$10$C0rE8./av3.JKQ40sbXRu.C.jMHv4JPLn3HCh.nuIQnajGBJ4sso2', 2, 1, 'ec10e7c196c28ad01134689b882f5bdb');

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
(1, 'Khiêm', 'Trần Vĩnh', 'tranvinhkhiem@gmail.com', '02221115487', 'assets/uploads/avatars/7f1f92e0bf0177173664a2cc2ea6d9ad_handsome-confident-smiling-man-with-hands-crossed-chest_176420-18743.jpg', 1),
(2, 'Đào', 'Trần Thị', 'tranthidao@gmail.com', '0335548891', 'assets/uploads/avatars/7174b03f45f185b6cc4fa63a7bdbb4e4_beautiful-woman-with-natural-make-up-897056188-5c2d3aff4cedfd000165bdef-1400x787.jpg', 1),
(3, 'Trúc', 'Nguyễn Thị', 'nguyenthitruc@gmail.com', '0335848795', 'assets/uploads/avatars/3917fcd4f93681107cae549ff50f8b07_girl.jpg', 1),
(4, 'Tiên', 'Nguyễn Thị Kim', 'nguyenthikiemtien0312@gmail.com', '0935554483', 'assets/uploads/avatars/fc03335e22d5ef7100e6c67c95c57b12_girl.jpg', 1),
(5, 'Khang', 'Trương Hữu', 'truonghuukhang2305@gmail.com', '0992284453', 'assets/uploads/avatars/71bce63718312d0ce02cbad22a237c97_jestoni-dadis-Lwf8toc07vo-unsplash.jpg', 2),
(6, 'Tuấn', 'Bạch Quốc', 'bachquoctuan251@gmail.com', '0327788845', NULL, 2),
(7, 'Loan', 'Trương Thị Kim', 'truongthikimloan2105@gmail.com', '0909224425', NULL, 2),
(8, 'Đăng', 'Nguyễn Hải', 'nguyenhaidang@gmail.com', '0912567291', NULL, 3),
(9, 'Diệp', 'Trương Ngọc', 'truongngocdiep@gmail.com', '02838718976', NULL, 3),
(10, 'Bảo', 'Trần Thái', 'tranthaibao@gmail.com', '0128678543', NULL, 3),
(11, 'Vương', 'Phan Minh', 'phanminhvuong@gmail.com', '0289176883', NULL, 4),
(12, 'Anh', 'Phạm Thuỳ', 'phamthuyanh@gmail.com', '0938237485', NULL, 4),
(13, 'Khôi', 'Trịnh Nguyên', 'trinhnguyenkhoi@gmail.com', '0903186925', 'assets/uploads/avatars/ec10e7c196c28ad01134689b882f5bdb_boy.jpg', 4);

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
(3, 9, 'Bộ phận này chịu trách nhiệm về tình hình nhân sự của công ty. Có trách nhiệm theo dõi, đôn đốc, quản lý và tuyển dụng nhân sự, bố trí các lao động ở vị trí việc làm phù hợp để đảm bảo nguồn nhân lực cho sản xuất. Có trách nhiệm về các loại văn bản, giấy tờ, hồ sơ, sổ sách trong công ty. Triển khai các nội quy của công ty, hoạt động khen thưởng, hoạt động phúc lợi.', 10),
(4, 13, 'Xây dựng chiến lược marketing cho doanh nghiệp; điều hành việc triển khai chiến lược marketing; theo dõi, giám sát quá trình thực hiện, kịp thời điều chỉnh và đánh giá, báo cáo kết quả chiến lược marketing.', 10);

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
(3, 1, 12),
(4, 0, 12),
(5, 3, 15),
(6, 0, 12),
(7, 0, 12),
(8, 0, 12),
(9, 1, 15),
(10, 0, 12),
(11, 0, 12),
(12, 0, 12),
(13, 2, 15);

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
(2, 2, 'Em muốn xin nghỉ ngày mai', '908884674-should-your-child-stay.jpg', 'assets/uploads/leaves/$2y$10$OjseiLoO7lh80bfWC1k4EuaENhmoNC2rNSotrnzC4RbhqzCebq7O.jpg', 1, '2021-11-16 12:34:54', '2021-12-17 19:35:26', '2022-01-18', 'refused'),
(3, 2, 'Em bị bệnh nặng, xin anh cho em nghỉ ngày mai ạ.', 'sick.jpg', 'assets/uploads/leaves/$2y$10$.SZP9wqv8b0q0VmbgTeLnez5BnY57y6EUBqDwqCLNwXjSv6.3y.jpg', 1, '2022-01-10 05:55:52', '2022-01-10 13:28:54', '2022-01-11', 'approved'),
(4, 4, 'Em muốn xin nghỉ về quê ạ', NULL, NULL, 2, '2022-01-01 06:49:22', '2022-01-01 16:54:52', '2022-01-02', 'refused'),
(5, 3, 'Em muốn xin nghỉ để dự đám cưới của bạn ạ.', NULL, NULL, 1, '2021-12-21 06:52:38', '2021-12-22 16:53:03', '2021-12-23', 'approved'),
(6, 5, 'Em xin nghỉ phép dưỡng bệnh ạ', 'CB-GTKT-017-1.png', 'assets/uploads/leaves/$2y$10$2WZecUaRyqVXxP8lFli0j.nQd9aAJyk3Qhdv9XdhkZg7J2RhWd8C.png', 2, '2021-05-11 09:28:34', '2021-05-12 16:30:24', '2021-05-13', 'approved'),
(7, 5, 'Em bị cảm xin nghỉ dưỡng bệnh ạ', 'cam-cum.jpg', 'assets/uploads/leaves/$2y$10$qHMOQuEKIiTH3da0nyu9GuV.5C3UIkFQ.G8aPxn3Bdj0697Nj2P9a.jpg', 1, '2022-01-12 09:31:53', '2022-01-12 16:42:48', '2022-01-19', 'approved'),
(8, 9, 'Em xin nghỉ phép đi khám bệnh ạ', 'cam-cum.jpg', 'assets/uploads/leaves/$2y$10$GS6lVUHph1xIXKN1vYAwE.Pps2WlHZDCkMswLLmze4yFZ7CivMb16.jpg', 1, '2021-09-12 09:42:22', '2021-09-13 16:42:59', '2021-09-14', 'approved'),
(9, 9, 'Em xin nghỉ phép về quê ạ.', 'phan-tich-bai-tra-loi-mau-chu-de-hometown-trong-bai-ielts-speaking.jpg', 'assets/uploads/leaves/$2y$10$zgrO38AMaGHo0Js8LrFoEOvSz3seKbkbJG3JvdXhge2eZTfSTZVEy.jpg', 3, '2022-01-12 09:44:46', NULL, '2022-01-26', 'waiting'),
(10, 13, 'Em xin nghỉ phép vì nhập viện.', 'CB-GTKT-017-1.png', 'assets/uploads/leaves/$2y$10$nvLFOiDBdNvHksYcirueAIwy4q.oJrV3qLdFMQZZ6IvcCmRafIW.png', 2, '2021-11-25 09:50:18', '2021-11-26 17:50:32', '2021-11-26', 'approved'),
(11, 13, 'Em xin nghỉ phép ngày mai ạ.', 'cam-cum.jpg', 'assets/uploads/leaves/$2y$10$K2MGBmFy5PP0ZnxDIZ.vquRSQyK1O1Zu0AzqEY380AeRDD1L2kC.jpg', 1, '2022-01-12 09:51:26', '2022-01-26 17:51:34', '2022-01-27', 'refused');

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
(2, 2, 4, 'Đề tài nghiên cứu về áp dụng AI vào việc xử lý ảnh', 'Hoàn thành trước deadline nhé.', 'Completed', 'Good', '2022-01-10 06:24:51', '2022-01-11 13:23:24'),
(3, 2, 3, 'Xây dựng hệ thống bán hàng ', 'Xây dựng website bán hàng cho doanh nghiệp Foodie', 'Rejected', NULL, '2022-01-12 08:48:56', '2022-01-26 16:50:30'),
(4, 2, 4, 'Xây dựng phần mềm quản lý cơ sở dữ liệu khách hàng', 'Cơ sở dữ liệu khách hàng công ty MB, hoàn thiện trong thời gian ngắn', 'New', NULL, '2022-01-12 08:48:56', '2022-01-31 16:50:30'),
(5, 5, 6, 'Thống kê ngân sách công ty', 'Ngân sách công ty quý 4/2021', 'Waiting', NULL, '2022-01-12 08:56:58', '2022-02-16 15:55:03'),
(6, 5, 6, 'Thống kê đầu tư dự án Riverside', 'Dự án quan trọng, cần được thống kê chi tiết và chính xác', 'New', NULL, '2022-01-12 08:58:19', '2022-03-09 15:55:03'),
(7, 5, 7, 'Lập kế hoạch xây dựng quỹ công ty', 'Xây dựng quỹ công ty tháng 1/2022', 'In progress', NULL, '2022-01-12 09:00:14', '2022-02-28 15:55:03'),
(8, 5, 7, 'Thống kê doanh thu dự án View ', 'Thống kê cần được hoàn thành gấp, cố gắng nhé', 'New', NULL, '2022-01-12 09:26:55', '2022-01-19 16:01:47'),
(9, 9, 8, 'Lên kế hoạch nhận dự án Little Park', 'Nhận dự án từ khách hàng và lên cuộc họp', 'In progress', NULL, '2022-01-12 09:37:31', '2022-02-16 16:35:21'),
(10, 9, 8, 'Liên hệ đối tác BVA', 'Bàn bạc với đối tác về quy trình triển khai dự án', 'New', NULL, '2022-01-12 09:40:27', '2022-02-26 16:35:21'),
(11, 9, 10, 'Lên kế hoạch dự án công ty xây dựng Mamimoo', 'Cần xong trước tháng 3', 'New', NULL, '2022-01-12 09:40:58', '2022-03-31 16:35:21'),
(12, 9, 10, 'Tìm nguồn cung ứng cho dự án Street RG', 'Street RG thuộc tập đoàn Santi Mark', 'New', NULL, '2022-01-12 09:41:37', '2022-03-05 16:35:21'),
(13, 13, 11, 'Xây dựng chiến lược hoạch định nguồn nhân lực công ty BMA', 'Chiến lược hoạch định nhân lực', 'New', NULL, '2022-01-12 09:47:51', '2022-01-15 16:45:27'),
(14, 13, 11, 'Xây dựng kế hoạch quảng bá dự án Finderland', 'Dự án Finderland thuộc công ty Biner', 'New', NULL, '2022-01-12 09:48:15', '2022-04-22 16:45:27'),
(15, 13, 12, 'Lên kế hoạch huy động vốn đầu tư cho dự án 1Romnor', 'Huy động vốn đầu tư đợt 1', 'New', NULL, '2022-01-12 09:48:51', '2022-04-07 16:45:27'),
(16, 13, 12, 'Quảng bá dự án Maymac', 'Dự án mới nhận, thuộc nhánh 3 trong chuỗi IM', 'New', NULL, '2022-01-12 09:49:25', '2022-04-21 16:45:27');

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
(1, 1, 2, 'New', NULL, 'webSecurity.docx', 'assets/uploads/tasks/$2y$10$rd1PuZJx5W6NzEP2HcRS.vfDTRGttGPVktKtAw1aMg5.MKm.rdg2.docx', '2022-01-13 04:55:09'),
(2, 1, 3, 'In progress', NULL, NULL, NULL, '2022-01-05 12:36:56'),
(3, 2, 2, 'New', NULL, NULL, NULL, '2022-01-10 06:24:51'),
(8, 2, 4, 'In progress', NULL, NULL, NULL, '2022-01-10 06:29:41'),
(9, 2, 4, 'Waiting', 'Em xong rồi anh ạ.', 'AI.docx', 'assets/uploads/tasks/$2y$10$eOkVHpb8ImKyWoVrwr2dtuCe0fJrtMaL.BvHHDCtGDBYja1uuTivy.docx', '2022-01-13 04:55:02'),
(10, 2, 2, 'Completed', NULL, NULL, NULL, '2022-01-10 06:35:34'),
(11, 3, 2, 'New', NULL, 'Foodie.docx', 'assets/uploads/tasks/$2y$10$FZ4HsODPujF0FlMMmvFyut.pq2MGLXOywwTwETF1bXt5o6nhO56.docx', '2022-01-13 04:54:52'),
(12, 4, 2, 'New', NULL, 'Foodie.docx', 'assets/uploads/tasks/$2y$10$luDOfjw7whsp7R2XUysl.r1sCB34YWnijAmUnqtArF0YI1I99WC.docx', '2022-01-13 04:54:47'),
(13, 5, 5, 'New', NULL, 'Ngân sách.docx', 'assets/uploads/tasks/$2y$10$67vmbn6oxO5SbgQ6DZD0ORf38KAQcP4wwfYxn2wxeCrnOOdMob..docx', '2022-01-13 04:54:37'),
(14, 6, 5, 'New', NULL, 'Riverside.docx', 'assets/uploads/tasks/$2y$10$HSxZfkXTzbzjpJwgE51B4urs2G68kGJxig1ktyJxx9Ed19sqa3ha.docx', '2022-01-13 04:54:32'),
(15, 7, 5, 'New', NULL, 'Quỹ công ty.docx', 'assets/uploads/tasks/$2y$10$HI6feYtiXi2hBdMcvCESleDxI6ZazfPfYiOtkGveXWeZSnVNsIvTS.docx', '2022-01-13 04:54:28'),
(16, 8, 5, 'New', NULL, 'Quỹ công ty.docx', 'assets/uploads/tasks/$2y$10$PBH4y1cl0y6PoljKHSzjEOlab4kkLMiGOsxg3aDBMQYnNXmY05Mq.docx', '2022-01-13 04:54:15'),
(17, 8, 5, 'New', NULL, 'View.docx', 'assets/uploads/tasks/$2y$10$33YJZhhCMdD8erUAqP76AOCwQehkTluZp4EMqgdLMXiAHHHZfVm.docx', '2022-01-13 04:54:24'),
(18, 9, 9, 'New', NULL, 'Little Park.docx', 'assets/uploads/tasks/$2y$10$KHvqNA7k.M08IJ4nMZsGeOyBg5UMgj1nuasrMgGujroxvvLDCdPaq.docx', '2022-01-13 04:54:05'),
(19, 10, 9, 'New', NULL, 'BVA.docx', 'assets/uploads/tasks/$2y$10$SiqDK1NdWERNCsTIqVLifOZKK5mStVTm8UlgcMnoqg9lMYGigKmS.docx', '2022-01-13 04:53:57'),
(20, 11, 9, 'New', NULL, 'Mamimoo.docx', 'assets/uploads/tasks/$2y$10$9gAyUsdC9aBkcFZqjiUOM.vHSIEcBNpLmGVYZTVDJJXp3J1kj4m.docx', '2022-01-13 04:53:52'),
(21, 12, 9, 'New', NULL, 'Street RG.docx', 'assets/uploads/tasks/$2y$10$RaIJsaqWRtFGAhupeyMske3RDOXd7UDjVKuiT1PqQmR1rmDZcX9Wq.docx', '2022-01-13 04:53:41'),
(22, 13, 13, 'New', NULL, 'Nhân lực.docx', 'assets/uploads/tasks/$2y$10$DfflCQWEsUGnBc7ScXQkH.XmVnL.Ce5S2BkkUbxtCCcFf0LjOd0i.docx', '2022-01-13 04:53:32'),
(23, 14, 13, 'New', NULL, 'Nhân lực.docx', 'assets/uploads/tasks/$2y$10$da3grPMxIVr5a6P3UXLe1.Zxf5H7C6UCAyglQzs.d8lktPjDhpwWu.docx', '2022-01-13 04:53:21'),
(24, 15, 13, 'New', NULL, '1Romnor.docx', 'assets/uploads/tasks/$2y$10$u3bPhhe1hIyeLvL.HlO5Des4ARiNP2qm4DYN0jTb8mdWf31biuiVu.docx', '2022-01-13 04:53:16'),
(25, 16, 13, 'New', NULL, 'Maymac.docx', 'assets/uploads/tasks/$2y$10$uQ5NrZ9NGdWj8bz4QDNANekYIL.0Yd3jvKw74j42CrTmyXNMm03X6.docx', '2022-01-13 04:53:12'),
(27, 5, 6, 'In progress', NULL, NULL, NULL, '2022-01-12 09:57:15'),
(28, 5, 6, 'Waiting', 'Đã hoàn thành xong', 'Ngân sách.docx', 'assets/uploads/tasks/$2y$10$gUkmMCyoZuUlDbtiTrqW4eBXNgQo0cpAs1H8ceEUqwdQCiRhAICee.docx', '2022-01-13 04:54:40'),
(29, 7, 7, 'In progress', NULL, NULL, NULL, '2022-01-12 10:02:06'),
(30, 9, 8, 'In progress', NULL, NULL, NULL, '2022-01-12 10:07:11'),
(31, 3, 3, 'In progress', NULL, NULL, NULL, '2022-01-13 02:29:42'),
(32, 3, 3, 'Waiting', 'Em đã hoàn thành xong dự án', 'Dự án cuối kỳ môn Nhập môn học máy.docx', 'assets/uploads/tasks/$2y$10$hK3jFrHTBP9sKvaITjjJU.2hYmPmlVpzGflPqsBLSZZCE0KrNLOJ2.docx', '2022-01-13 04:54:57'),
(33, 3, 2, 'Rejected', 'Hình như em gửi nhầm file rồi, em kiểm tra lại rồi submit lại giúp chị nhé!', NULL, NULL, '2022-01-13 02:30:57');

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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_record`
--
ALTER TABLE `leave_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `task_record`
--
ALTER TABLE `task_record`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
