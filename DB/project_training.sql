-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2026 at 07:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'รหัสไฟล์',
  `name` varchar(100) DEFAULT NULL COMMENT 'ชื่อไฟล์',
  `type` varchar(50) DEFAULT NULL COMMENT 'ประเภทไฟล์',
  `size` int(11) DEFAULT NULL COMMENT 'ขนาดไฟล์',
  `training_id` int(5) DEFAULT NULL COMMENT 'รหัสโครงการ',
  `file_path` varchar(255) NOT NULL COMMENT 'ที่อยุ่ไฟล์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `type`, `size`, `training_id`, `file_path`) VALUES
(21, 'บทความ (1).pdf', 'pdf', 161745, 573, '../files/บทความ (1).pdf'),
(23, 'บทความ (1).pdf', 'pdf', 161745, 574, '../files/บทความ (1).pdf'),
(24, 'ระบบบริหารค่าจ้าง-กรณีศึกษา-สวนกิตติยา.pdf', 'pdf', 4408415, 578, '../files/ระบบบริหารค่าจ้าง-กรณีศึกษา-สวนกิตติยา.pdf'),
(25, 'license_v3_pba.pdf', 'pdf', 629116, 578, '../files/license_v3_pba.pdf'),
(26, 'เว็บบริหารจัดการการฝึกอบรมม.pdf', 'pdf', 486423, 573, '../files/เว็บบริหารจัดการการฝึกอบรมม.pdf'),
(27, 'license_v3_pba.pdf', 'pdf', 629116, 573, '../files/license_v3_pba.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `his_id` int(11) NOT NULL COMMENT 'รหัสรายการ',
  `his_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อรายการ',
  `user_id` int(11) DEFAULT NULL COMMENT 'รหัสผู้เข้าอบรม',
  `his_time` datetime DEFAULT NULL COMMENT 'เวลาที่ทำรายการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`his_id`, `his_name`, `user_id`, `his_time`) VALUES
(8, 'ลงทะเบียนสมัครอบรม ทดสอบ เมื่อผู้ดูแลระบบอนุมัติจะแจ้งเตือนไปยังอีเมล', 58, '2025-03-02 14:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL COMMENT 'รหัสการจอง',
  `training_id` int(11) DEFAULT NULL COMMENT 'รหัสโครงการ',
  `user_id` int(11) DEFAULT NULL COMMENT 'รหัสผู้ใช้',
  `order_date` date DEFAULT NULL COMMENT 'วันที่จอง',
  `order_total` int(11) DEFAULT NULL COMMENT 'ค่าสมัคร',
  `order_slip` varchar(255) DEFAULT NULL COMMENT 'ไฟล์หลักฐานการจอง',
  `order_status` tinyint(4) DEFAULT 0 COMMENT 'อนุมัติการลงทะเบียน',
  `order_result` varchar(20) DEFAULT 'ไม่มีผล' COMMENT 'ผลการอบรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `training_id`, `user_id`, `order_date`, `order_total`, `order_slip`, `order_status`, `order_result`) VALUES
(111, 573, 55, '2024-04-30', 20, '414470448_1320091071984658_7821062294895124401_n.jpg', 1, 'ผ่าน'),
(122, 575, 58, '2025-03-02', 20, '412049437_340821278722353_416937548640411656_n.jpg', 1, 'ผ่าน');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(5) NOT NULL,
  `admin_username` varchar(255) DEFAULT NULL COMMENT 'ชื่อ',
  `admin_password` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `admin_pname` varchar(20) DEFAULT NULL COMMENT 'คำนำหน้า',
  `admin_fname` varchar(255) DEFAULT NULL COMMENT 'ชื่อจริง',
  `admin_lname` varchar(255) DEFAULT NULL COMMENT 'นามสกุล',
  `admin_image` varchar(255) DEFAULT 'admin.png' COMMENT 'ไฟล์รูป'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_pname`, `admin_fname`, `admin_lname`, `admin_image`) VALUES
(1, 'ongdlwlrma', '12345678', 'นาย', 'ธนกร', 'ประสานรัมย์', NULL),
(2, 'ong', '111', NULL, NULL, NULL, NULL),
(3, 'admin', '12345678', '', NULL, NULL, 'admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `training_id` int(5) NOT NULL,
  `training_name` varchar(50) DEFAULT NULL COMMENT 'ชื่อโครงการ',
  `training_details` varchar(255) DEFAULT NULL COMMENT 'รายละเอียดโครงการ',
  `training_limit` int(11) DEFAULT NULL COMMENT 'จำนวนที่รับ',
  `training_price` varchar(10) DEFAULT NULL COMMENT 'ค่าสมัคร',
  `training_date` date DEFAULT NULL COMMENT 'วันที่จัดอบรม',
  `training_place` varchar(255) DEFAULT NULL COMMENT 'สถานที่',
  `training_image` varchar(500) DEFAULT 'training.jpg' COMMENT 'ไฟล์รูป',
  `training_lecturer` varchar(255) DEFAULT NULL COMMENT 'วิทยากร',
  `training_enddate` date DEFAULT NULL COMMENT 'วันสุดท้ายที่อบรม',
  `training_budget` varchar(255) DEFAULT NULL COMMENT 'คิวอาโค้ด',
  `training_map` varchar(255) DEFAULT NULL COMMENT 'link map'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`training_id`, `training_name`, `training_details`, `training_limit`, `training_price`, `training_date`, `training_place`, `training_image`, `training_lecturer`, `training_enddate`, `training_budget`, `training_map`) VALUES
(573, 'Cs Young Programmer 2024', 'ร่วมเปิดประสบการณ์ มาเรียนรู้โลกของการเรียนวิทยาการคอมพิวเตอร์', 4, '20', '2024-05-07', 'ตึก 5 มหาวิทยาลัยราชภัฏบุรีรัมย์', '365785508_794023752515416_9177068016201623010_n.jpg', 'สาขาวิทยาการคอมพิวเตอร์', '2024-05-10', '440497064_990389912760080_446622283207305993_n.jpg', 'ddddddd'),
(574, 'CS Young Programer 2025', 'ทดสอบรายละเอียดแก้ไข', 10, '20', '2024-05-10', 'ตึก 5 มหาวิทยาลัยราชภัฏบุรีรัมย์', '365785508_794023752515416_9177068016201623010_n.jpg', 'สาขาวิทยาการคอมพิวเตอร์', '2024-05-13', '440497064_990389912760080_446622283207305993_n.jpg', 'https://maps.app.goo.gl/FEUuAmqDX5Xr21oi6'),
(575, 'ทดสอบ', 'ทดสอบ', 1, '20', '2024-04-29', 'ตึก 5 มหาวิทยาลัยราชภัฏบุรีรัมย์', '365785508_794023752515416_9177068016201623010_n.jpg', 'สาขาวิทยาการคอมพิวเตอร์', '2024-05-01', '440497064_990389912760080_446622283207305993_n.jpg', 'หหหหห'),
(578, 'CS Young Programer 2027', 'test', 11, '11', '2024-05-31', ' ตึก 5 มรภ.', '365785508_794023752515416_9177068016201623010_n.jpg', 'สาขาวิทยาการคอมพิวเตอร์', '2024-05-31', '440497064_990389912760080_446622283207305993_n.jpg', 'ddddddd'),
(579, 'ทดสอบชื่อแก้', 'ทดสอบรายละเอียดแก้', 3, '20', '2024-05-25', 'ตึก 5', '365785508_794023752515416_9177068016201623010_n.jpg', 'สาขาวิทยาการคอมพิวเตอร์', '2024-05-26', '440497064_990389912760080_446622283207305993_n.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `user_pname` varchar(255) DEFAULT NULL COMMENT 'คำนำหน้า',
  `user_fname` varchar(255) DEFAULT NULL COMMENT 'ชิ่อ',
  `user_lname` varchar(255) DEFAULT NULL COMMENT 'นามสกุล',
  `user_tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์',
  `user_sex` varchar(20) DEFAULT NULL COMMENT 'เพศ',
  `user_email` varchar(255) DEFAULT NULL COMMENT 'อีเมล',
  `user_contact` varchar(255) DEFAULT NULL COMMENT 'ที่อยู่',
  `user_file` varchar(255) DEFAULT 'userprofile.png' COMMENT 'ชื่อไฟล์',
  `user_birthday` date DEFAULT NULL COMMENT 'วันเกิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_password`, `user_pname`, `user_fname`, `user_lname`, `user_tel`, `user_sex`, `user_email`, `user_contact`, `user_file`, `user_birthday`) VALUES
(55, '25d55ad283aa400af464c76d713c07ad', 'นาย', 'ธนกร', 'ประสานรัมย์', '0837056400', 'ชาย', 'ongrov3@gmail.com', '12 หมู่ 1 ต.คูหา อ.คูเมือง จ.คูน้ำ 31000', '365785508_794023752515416_9177068016201623010_n.jpg', '2024-05-11'),
(56, 'b59c67bf196a4758191e42f76670ceba', 'นาย', 'ธนกร', 'ประสานรัมย์', '0987654321', 'ชาย', 'ongtama@gmail.com', '12 ต.คูหา อ.คูเมือง จ.คูน้ำ 31000', 'userprofile.png', '2024-05-04'),
(57, 'b59c67bf196a4758191e42f76670ceba', 'นาย', 'ธนกร', 'ประสานรัมย์', '0837056400', 'ชาย', 'ong@gmail.com', '12 หมู่ 1 ต.คูหา อ.คูเมือง จ.บุรีรัมย์ 31000', 'userprofile.png', '2024-05-12'),
(58, '81dc9bdb52d04dc20036dbd8313ed055', 'นาย', 'ธนกร', 'ประสานรัมย์', '0837056400', 'ชาย', 'ongtama.ong@gmail.com', '12 ต.คูหา อ.คูเมือง จ.คูน้ำ 31000', '☆.jpg', '2001-09-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trainingfile` (`training_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`his_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_ortraining` (`training_id`),
  ADD KEY `fk_oruser` (`user_id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'รหัสไฟล์', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `his_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการ', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการจอง', AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `training_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=582;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_trainingfile` FOREIGN KEY (`training_id`) REFERENCES `training` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_ortraining` FOREIGN KEY (`training_id`) REFERENCES `training` (`training_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_oruser` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
