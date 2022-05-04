-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2022 at 06:47 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `gmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `room` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `group_id`, `day`, `start`, `end`, `room`) VALUES
(1, 1, 'Monday', '10:00:00', '12:00:00', 'Room 1'),
(2, 23, 'Wednesday', '10:00:00', '12:00:00', 'Room 2');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `room` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meeting_id`, `group_id`, `day`, `start`, `end`, `room`) VALUES
(1, 1, 'Tuesday', '10:00:00', '12:00:00', 'Room 1'),
(2, 23, 'Saturday', '12:00:00', '15:00:00', 'Room 5');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `given_name` varchar(20) NOT NULL,
  `family_name` varchar(20) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` varchar(10) NOT NULL,
  `campus` enum('Hobart','Launceston') NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `category` enum('Bachelors','Masters') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `given_name`, `family_name`, `group_id`, `title`, `campus`, `phone`, `email`, `photo`, `category`) VALUES
(1, 'Nadine', 'Baadarani', 1, 'Ms', 'Hobart', '0493423101', 'nadineb2@utas.edu.au', 'student_1.png', 'Masters'),
(2, 'Bachelor', 'User', 1, 'Ms', 'Hobart', '0493423101', 'bachelor@utas.edu', 'student_2.jpeg', 'Bachelors'),
(3, 'Jesse', 'He', 1, 'mr', 'Hobart', '04111111', 'abc@utas.edu', '', 'Masters');

-- --------------------------------------------------------

--
-- Table structure for table `studentGroup`
--

CREATE TABLE `studentGroup` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentGroup`
--

INSERT INTO `studentGroup` (`group_id`, `group_name`) VALUES
(1, 'Group 1'),
(2, 'Group 2');

-- --------------------------------------------------------

--
-- Table structure for table `userAccess`
--

CREATE TABLE `userAccess` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userAccess`
--

INSERT INTO `userAccess` (`id`, `student_id`, `email`, `password`) VALUES
(1, 1, 'nadineb2@utas.edu.au', '8f5c853566391602f1a56b305e1d9cd5'),
(2, 2, 'bachelor@utas.edu', 'c2b7dae3df98550763dfaa494e550aeb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meeting_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `studentGroup`
--
ALTER TABLE `studentGroup`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `userAccess`
--
ALTER TABLE `userAccess`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentGroup`
--
ALTER TABLE `studentGroup`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userAccess`
--
ALTER TABLE `userAccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;