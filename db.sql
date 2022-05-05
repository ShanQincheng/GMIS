/*
 Navicat Premium Data Transfer

 Source Server         : raspberry-mysql-remote
 Source Server Type    : MySQL
 Source Server Version : 80029
 Source Host           : 127.0.0.1:3306
 Source Schema         : gmis

 Target Server Type    : MySQL
 Target Server Version : 80029
 File Encoding         : 65001

 Date: 05/05/2022 21:32:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `class_id` int NOT NULL,
  `group_id` int NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `room` varchar(40) NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of class
-- ----------------------------
BEGIN;
INSERT INTO `class` (`class_id`, `group_id`, `day`, `start`, `end`, `room`) VALUES (1, 1, 'Monday', '10:00:00', '12:00:00', 'Room 1');
INSERT INTO `class` (`class_id`, `group_id`, `day`, `start`, `end`, `room`) VALUES (2, 23, 'Wednesday', '10:00:00', '12:00:00', 'Room 2');
COMMIT;

-- ----------------------------
-- Table structure for meeting
-- ----------------------------
DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `meeting_id` int NOT NULL AUTO_INCREMENT,
  `group_id` int NOT NULL,
  `class_id` int NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `room` varchar(40) NOT NULL,
  PRIMARY KEY (`meeting_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of meeting
-- ----------------------------
BEGIN;
INSERT INTO `meeting` (`meeting_id`, `group_id`, `class_id`, `day`, `start`, `end`, `room`) VALUES (1, 1, 0, 'Tuesday', '10:00:00', '12:00:00', 'Room 1');
INSERT INTO `meeting` (`meeting_id`, `group_id`, `class_id`, `day`, `start`, `end`, `room`) VALUES (2, 23, 0, 'Saturday', '12:00:00', '15:00:00', 'Room 5');
COMMIT;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `given_name` varchar(20) NOT NULL,
  `family_name` varchar(20) NOT NULL,
  `group_id` int NOT NULL,
  `title` varchar(10) NOT NULL,
  `campus` enum('Hobart','Launceston') NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `category` enum('Bachelors','Masters') NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of student
-- ----------------------------
BEGIN;
INSERT INTO `student` (`student_id`, `given_name`, `family_name`, `group_id`, `title`, `campus`, `phone`, `email`, `photo`, `category`) VALUES (1, 'Nadine', 'Baadarani', 1, 'Ms', 'Hobart', '0493423101', 'nadineb2@utas.edu.au', 'student_1.png', 'Masters');
INSERT INTO `student` (`student_id`, `given_name`, `family_name`, `group_id`, `title`, `campus`, `phone`, `email`, `photo`, `category`) VALUES (2, 'Bachelor', 'User', 1, 'Ms', 'Hobart', '0493423101', 'bachelor@utas.edu', 'student_2.jpeg', 'Bachelors');
INSERT INTO `student` (`student_id`, `given_name`, `family_name`, `group_id`, `title`, `campus`, `phone`, `email`, `photo`, `category`) VALUES (3, 'Jesse', 'He', 1, 'mr', 'Hobart', '04111111', 'abc@utas.edu', '', 'Masters');
COMMIT;

-- ----------------------------
-- Table structure for studentClassGroup
-- ----------------------------
DROP TABLE IF EXISTS `studentClassGroup`;
CREATE TABLE `studentClassGroup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `class_id` int NOT NULL,
  `group_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- ----------------------------
-- Records of studentClassGroup
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for studentGroup
-- ----------------------------
DROP TABLE IF EXISTS `studentGroup`;
CREATE TABLE `studentGroup` (
  `group_id` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of studentGroup
-- ----------------------------
BEGIN;
INSERT INTO `studentGroup` (`group_id`, `group_name`) VALUES (1, 'Group 1');
INSERT INTO `studentGroup` (`group_id`, `group_name`) VALUES (2, 'Group 2');
COMMIT;

-- ----------------------------
-- Table structure for userAccess
-- ----------------------------
DROP TABLE IF EXISTS `userAccess`;
CREATE TABLE `userAccess` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of userAccess
-- ----------------------------
BEGIN;
INSERT INTO `userAccess` (`id`, `student_id`, `email`, `password`) VALUES (1, 1, 'nadineb2@utas.edu.au', '8f5c853566391602f1a56b305e1d9cd5');
INSERT INTO `userAccess` (`id`, `student_id`, `email`, `password`) VALUES (2, 2, 'bachelor@utas.edu', 'c2b7dae3df98550763dfaa494e550aeb');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
