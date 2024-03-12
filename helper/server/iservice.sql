-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2024 at 12:22 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget_source`
--

DROP TABLE IF EXISTS `budget_source`;
CREATE TABLE IF NOT EXISTS `budget_source` (
  `budget_source_id` int NOT NULL AUTO_INCREMENT,
  `budget_source_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`budget_source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget_source`
--

INSERT INTO `budget_source` (`budget_source_id`, `budget_source_name`) VALUES
(1, 'เงินบำรุง'),
(2, 'เงินงบประมาณ'),
(3, 'เงินบริจาค'),
(4, 'เงินประกันสังคม'),
(5, 'เงินมูลนิธิ');

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
CREATE TABLE IF NOT EXISTS `building` (
  `building_id` int NOT NULL AUTO_INCREMENT,
  `building_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `building_name`) VALUES
(1, 'อาคารเลิศประชารักษ์'),
(2, 'อาคารอนุรักษ์'),
(3, 'อาคารพัสดุและบำรุงรักษา'),
(4, 'อาคารช่างซ่อมบำรุง'),
(5, 'อาคารวิศวกรรม');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'อุปกรณ์คอมพิวเตอร์'),
(2, 'อุปกรณ์การแพทย์');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `work_group_id` int DEFAULT NULL,
  `department_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`department_id`),
  KEY `FK_department_work_group` (`work_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `work_group_id`, `department_name`) VALUES
(1, 1, 'งานธุรการและสารบรรณ'),
(2, 1, 'งานอาคารสถานที่'),
(3, 1, 'งานประชาสัมพันธ์'),
(4, 1, 'งานเลขานุการ'),
(5, 1, 'งานซักฟอก'),
(6, 1, 'งานยานพาหนะ'),
(7, 1, 'งานรักษาความปลอดภัย'),
(8, 1, 'งานสวัสดิการหอพัก'),
(9, 3, 'งานบริหารบุคลากร'),
(10, 3, 'งานพัฒนาบุคลากร'),
(11, 5, 'งานการเงินจุดเก็บเงินชั้น 1 ชั้น 2 ชั้น M ชั้น 3 '),
(12, 6, 'งานตรวจสอบใบสาคัญ'),
(13, 6, 'งานเรียกเก็บค่ารักษาพยาบาลสิทธิข้าราชการและต้นสังกัด'),
(14, 7, 'งานจัดหา'),
(15, 7, 'หน่วยควบคุม'),
(16, 7, 'งานช่างซ่อมบำรุง'),
(17, 7, 'งานช่างอุปกรณ์การแพทย์'),
(18, 11, 'งานบริการการศึกษา'),
(19, 11, 'งานวิจัยและพัฒนาการพยาบาล'),
(20, 11, 'งานถ่ายทอดทางการพยาบาล'),
(21, 11, 'งานการพยาบาลส่งเสริมคุณภาพชีวิต'),
(22, 11, 'งานการพยาบาลป้องกันและควบคุมการติดเชื้อ'),
(23, 11, 'งานจ่ายกลาง'),
(24, 12, 'งานการพยาบาลตรวจรักษาพิเศษ'),
(25, 12, 'งานการพยาบาลผู้ป่วยนอกจักษุ'),
(26, 12, 'งานการพยาบาลผู้ป่วยนอกอายุรกรรม ศัลยกรรม'),
(27, 12, 'งานการพยาบาลผู้ป่วยอุบัติเหตุและฉุกเฉิน'),
(28, 12, 'งานพยาบาลผู้ป่วยเลเซอร์และตรวจพิเศษจักษุ'),
(29, 12, 'งานการพยาบาลตรวจรักษาพิเศษไตเทียม'),
(30, 13, 'งานการพยาบาลผู้ป่วยหนัก'),
(31, 13, 'งานการพยาบาลผู้ป่วยผ่าตัด'),
(32, 13, 'งานการพยาบาลวิสัญญี'),
(33, 13, 'งานการพยาบาลผู้ป่วยใน'),
(34, 13, 'หอผู้ป่วย 5/1'),
(35, 13, 'หอผู้ป่วย 5/2'),
(36, 13, 'หอผู้ป่วยพิเศษ ชั้น 7'),
(37, 13, 'หอผู้ป่วยพิเศษ ชั้น 8'),
(38, 13, 'งานหอผู้ป่วย ODS'),
(39, 14, 'งานทัศนมาตรศาสตร์'),
(40, 14, 'คลินิกตาสดใส'),
(41, 14, 'ศูนย์เลนส์แก้วตาเทียม'),
(42, 14, 'ศูนย์เลสิก'),
(43, 14, 'ศูนย์จอตาและวุ้นตา'),
(44, 14, 'โครงการธนาคารแว่นตา'),
(45, 15, 'งานธุรการ'),
(46, 20, 'งานนโยบายและยุทธศาสตร์'),
(47, 20, 'งานพัฒนาเขตสุขภาพ'),
(48, 21, 'งานวิจัยและประเมินเทคโนโลยีทางการแพทย์และสาธารณสุข'),
(49, 21, 'งานห้องสมุด'),
(50, 21, 'งานถ่ายทอดเทคโนโลยีทางการแพทย์'),
(51, 21, 'งานส่งเสริมสุขภาพและสนับสนุนบริการ'),
(52, 21, 'งานโสตทัศนูปกรณ์'),
(53, 22, 'งานคอมพิวเตอร์'),
(54, 22, 'งานเวชระเบียนและสถิติ'),
(55, 22, 'งานสารสนเทศทางการแพทย์'),
(56, 23, 'งานพัฒนาคุณภาพ (HA)'),
(57, 23, 'งานเรียกเก็บประกันสุขภาพของรัฐ'),
(58, 25, 'งานกายภาพบำบัด'),
(59, 25, 'งานกิจกรรมบำบัด'),
(60, 29, 'งานบริการเภสัชกรรม'),
(61, 29, 'งานบริหารเวชภัณฑ์ '),
(62, 29, 'งานเภสัชกรรมการผลิต '),
(63, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `mission_group_id` int NOT NULL,
  `work_group_id` int NOT NULL,
  `department_id` int DEFAULT NULL,
  `building_id` int NOT NULL,
  `floor_id` int DEFAULT NULL,
  `type_id` int NOT NULL,
  `brand` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `regis_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `responsible` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `year_received` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `budget_year` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `budget_source_id` int NOT NULL,
  `regis_date` date DEFAULT NULL,
  `old_department` int DEFAULT NULL,
  `service_life` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `depreciation` decimal(5,2) DEFAULT NULL,
  `netbook_value` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serialnumber` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transfer_date` date DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `change_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `shop` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warranty_start` date DEFAULT NULL,
  `warranty` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warranty_end` date DEFAULT NULL,
  `note` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`device_id`) USING BTREE,
  KEY `FK_device_work_group` (`work_group_id`) USING BTREE,
  KEY `FK_device_type` (`type_id`) USING BTREE,
  KEY `FK_device_status` (`status_id`) USING BTREE,
  KEY `FK_device_building` (`building_id`) USING BTREE,
  KEY `FK_device_floor` (`floor_id`) USING BTREE,
  KEY `FK_device_budget_source` (`budget_source_id`),
  KEY `FK_device_mission_group` (`mission_group_id`),
  KEY `FK_device_department` (`department_id`),
  KEY `FK_device_category` (`category_id`),
  KEY `FK_device_department_2` (`old_department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `device_broken`
--

DROP TABLE IF EXISTS `device_broken`;
CREATE TABLE IF NOT EXISTS `device_broken` (
  `device_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mission_group_id` int NOT NULL,
  `work_group_id` int NOT NULL,
  `department_id` int DEFAULT NULL,
  `building_id` int NOT NULL,
  `floor_id` int DEFAULT NULL,
  `type_id` int NOT NULL,
  `regis_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `broken` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_report_broken` date DEFAULT NULL,
  `date_success_fix` date DEFAULT NULL,
  `history_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `history_des` longtext COLLATE utf8mb4_general_ci,
  `history_date` date DEFAULT NULL,
  `status_repair_id` int NOT NULL DEFAULT '3',
  PRIMARY KEY (`device_id`) USING BTREE,
  KEY `FK_device_broken_building` (`building_id`),
  KEY `FK_device_broken_floor` (`floor_id`),
  KEY `FK_device_broken_type` (`type_id`),
  KEY `FK_device_broken_status_repair` (`status_repair_id`),
  KEY `FK_device_broken_work_group` (`work_group_id`),
  KEY `FK_device_broken_mission_group` (`mission_group_id`),
  KEY `FK_device_broken_department` (`department_id`),
  KEY `FK_device_broken_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

DROP TABLE IF EXISTS `floor`;
CREATE TABLE IF NOT EXISTS `floor` (
  `floor_id` int NOT NULL AUTO_INCREMENT,
  `building_id` int DEFAULT NULL,
  `floor_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`floor_id`),
  KEY `FK_floor_building` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`floor_id`, `building_id`, `floor_name`) VALUES
(1, 1, 'ชั้น 1'),
(2, 1, 'ชั้น 2'),
(3, 1, 'ชั้น 3'),
(4, 1, 'ชั้น 4'),
(5, 1, 'ชั้น 5'),
(6, 1, 'ชั้น 6'),
(7, 1, 'ชั้น 7'),
(8, 1, 'ชั้น 8'),
(9, 1, 'ชั้น 9'),
(10, 1, 'ชั้น M'),
(11, 2, 'ชั้น 1'),
(12, 2, 'ชั้น 2'),
(13, 2, 'ชั้น 3'),
(14, 2, 'ชั้น 4'),
(15, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `mission_group`
--

DROP TABLE IF EXISTS `mission_group`;
CREATE TABLE IF NOT EXISTS `mission_group` (
  `mission_group_id` int NOT NULL AUTO_INCREMENT,
  `mission_group_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`mission_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mission_group`
--

INSERT INTO `mission_group` (`mission_group_id`, `mission_group_name`) VALUES
(1, 'ด้านอำนวยการ'),
(2, 'ด้านการพยาบาล'),
(3, 'ด้านจักษุวิทยา'),
(4, 'ด้านการพัฒนาระบบสุขภาพ'),
(5, 'ด้านวิชาการและการแพทย์');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'guest'),
(2, 'repairman'),
(3, 'admin'),
(4, 'system');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'ปกติ'),
(2, 'จำหน่าย'),
(3, 'รอจำหน่าย'),
(4, 'ชำรุดเสียหาย'),
(5, 'ไม่มีความจำเป็นใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `status_repair`
--

DROP TABLE IF EXISTS `status_repair`;
CREATE TABLE IF NOT EXISTS `status_repair` (
  `status_repair_id` int NOT NULL AUTO_INCREMENT,
  `status_repair_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`status_repair_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_repair`
--

INSERT INTO `status_repair` (`status_repair_id`, `status_repair_name`) VALUES
(1, 'ซ่อมเรียบร้อย'),
(2, 'ดำเนินการซ่อม'),
(3, 'รอดำเนินการซ่อม'),
(4, 'จำหน่าย'),
(5, 'ไม่มีความจำเป็นใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `type_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`type_id`),
  KEY `FK_type_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `category_id`, `type_name`) VALUES
(1, 1, 'เครื่องคอมพิวเตอร์ (PC)'),
(2, 1, 'มอนิเตอร์ (จอภาพคอมพิวเตอร์)'),
(3, 1, 'เครื่องคอมพิวเตอร์โน้ตบุ๊ก (Notebook)'),
(4, 1, 'เครื่องคอมพิวเตอร์ All In One'),
(5, 1, 'เครื่องพิมพ์ (Printer)'),
(6, 1, 'คอมพิวเตอร์แท็บเล็ต'),
(7, 1, 'เครื่องอ่านรหัส Barcode'),
(8, 1, 'เครื่องสำรองกระแสไฟฟ้า (UPS)'),
(9, 2, 'เครื่องมือแพทย์ทั่วไป'),
(10, 2, 'เครื่องมือแพทย์จักษุ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `FK_user_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `phone`, `profile_pic`, `role_id`) VALUES
(1, 'user', '1234', 'ผู้ใช้', '', '', 4),
(2, 'repairman', '1234', 'ช่างซ่อม', '', '2_ช่าง.png', 2),
(3, 'admin', '1234', 'แอดมิน', '0910135312', '3_nichoe-val Shop _ Redbubble.jpg', 3),
(4, 'system', '1234', 'ระบบ', '', '4_ระบบ.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `work_group`
--

DROP TABLE IF EXISTS `work_group`;
CREATE TABLE IF NOT EXISTS `work_group` (
  `work_group_id` int NOT NULL AUTO_INCREMENT,
  `mission_group_id` int NOT NULL DEFAULT '0',
  `work_group_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`work_group_id`),
  KEY `FK_work_group_mission_group` (`mission_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='กลุ่มงาน';

--
-- Dumping data for table `work_group`
--

INSERT INTO `work_group` (`work_group_id`, `mission_group_id`, `work_group_name`) VALUES
(1, 1, 'งานบริหารทั่วไป'),
(2, 1, 'งานยุทธศาสตร์และแผนงาน'),
(3, 1, 'งานทรัพยากรบุคคล'),
(4, 1, 'งานการเงินบัญชีและพัสดุ'),
(5, 1, 'งานการเงิน'),
(6, 1, 'งานบัญชี '),
(7, 1, 'งานพัสดุและบำรุงรักษา '),
(8, 2, 'หัวหน้ากลุ่มงานการบริการผู้ป่วยใน'),
(9, 2, 'หัวหน้ากลุ่มงานการบริการผู้ป่วยนอก'),
(10, 2, 'หัวหน้ากลุ่มงานวิชาการพยาลบาล'),
(11, 2, 'งานวิชาการพยาบาล'),
(12, 2, 'งานการพยาบาลผู้ป่วยนอก'),
(13, 2, 'งานการพยาบาลผู้ป่วยใน'),
(14, 3, 'ศูนย์การแพทย์เฉพาะทางด้านจักษุวิทยา'),
(15, 3, 'ศูนย์แพทยศาสตร์ศึกษา'),
(16, 3, 'ศูนย์ส่งต่อทางจักษุวิทยา'),
(17, 3, 'ศูนย์โรคตา สาขาสุขุมวิท'),
(18, 3, 'ศูนย์เครื่องมือพิเศษและเลเซอร์'),
(19, 3, 'ศูนย์ส่งต่อทางจักษุวิทยา'),
(20, 4, 'งานพัฒนานโยบายและยุทธศาสตร์การแพทย์'),
(21, 4, 'งานวิจัยถ่ายทอดและสนับสนุนวิชาการ'),
(22, 4, 'งานดิจิทัลการแพทย์'),
(23, 4, 'งานพัฒนาคุณภาพ'),
(24, 5, 'งานสูติ-นรีเวชศาสตร์'),
(25, 5, 'งานศัลยศาสตร์และออร์โธปิดิกส์'),
(26, 5, 'งานอายุรศาสตร์'),
(27, 5, 'งานกุมารเวชศาสตร์'),
(28, 5, 'งานทันตกรรม'),
(29, 5, 'งานเภสัชกรรม'),
(30, 5, 'งานโสต ศอ นาสิก'),
(31, 5, 'งานวิสัญญีวิทยา'),
(32, 5, 'งานพยาธิวิทยาคลินิกและเทคนิคการแพทย์ '),
(33, 5, 'งานโภชนาการ'),
(34, 5, 'งานการแก้ไขการสื่อความหมายและการได้ยิน');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `FK_department_work_group` FOREIGN KEY (`work_group_id`) REFERENCES `work_group` (`work_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_3` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_ibfk_4` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`floor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_ibfk_7` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_ibfk_8` FOREIGN KEY (`work_group_id`) REFERENCES `work_group` (`work_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_budget_source` FOREIGN KEY (`budget_source_id`) REFERENCES `budget_source` (`budget_source_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_department_2` FOREIGN KEY (`old_department`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_mission_group` FOREIGN KEY (`mission_group_id`) REFERENCES `mission_group` (`mission_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `device_broken`
--
ALTER TABLE `device_broken`
  ADD CONSTRAINT `FK_device_broken_building` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_floor` FOREIGN KEY (`floor_id`) REFERENCES `floor` (`floor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_mission_group` FOREIGN KEY (`mission_group_id`) REFERENCES `mission_group` (`mission_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_status_repair` FOREIGN KEY (`status_repair_id`) REFERENCES `status_repair` (`status_repair_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_type` FOREIGN KEY (`type_id`) REFERENCES `type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_device_broken_work_group` FOREIGN KEY (`work_group_id`) REFERENCES `work_group` (`work_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `floor`
--
ALTER TABLE `floor`
  ADD CONSTRAINT `FK_floor_building` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `FK_type_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_group`
--
ALTER TABLE `work_group`
  ADD CONSTRAINT `FK_work_group_mission_group` FOREIGN KEY (`mission_group_id`) REFERENCES `mission_group` (`mission_group_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
