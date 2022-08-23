-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 06:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin_tb`
--

CREATE TABLE `adminlogin_tb` (
  `a_login_id` int(11) NOT NULL,
  `a_name` varchar(60) NOT NULL,
  `a_email` varchar(60) NOT NULL,
  `a_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin_tb`
--

INSERT INTO `adminlogin_tb` (`a_login_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records_tb`
--

CREATE TABLE `attendance_records_tb` (
  `id` int(11) NOT NULL,
  `student_class` varchar(60) NOT NULL,
  `student_subject` varchar(60) NOT NULL,
  `student_name` varchar(60) NOT NULL,
  `student_roll` varchar(60) NOT NULL,
  `student_att_status` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_records_tb`
--

INSERT INTO `attendance_records_tb` (`id`, `student_class`, `student_subject`, `student_name`, `student_roll`, `student_att_status`, `date`, `teacher_id`) VALUES
(146, 'bca1styear', 'ds', 'Akhil', '01', 'Present', '2021-06-01 00:00:00', 31),
(147, 'bca1styear', 'ds', 'Ajit', '02', 'Absent', '2021-06-01 00:00:00', 31),
(148, 'bca1styear', 'ds', 'Sourav', '03', 'Absent', '2021-06-01 00:00:00', 31),
(149, 'bca1styear', 'ds', 'Jagat', '04', 'Present', '2021-06-01 00:00:00', 31);

-- --------------------------------------------------------

--
-- Table structure for table `registration_tb`
--

CREATE TABLE `registration_tb` (
  `id` int(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `fpassword` varchar(60) NOT NULL,
  `cpassword` varchar(60) NOT NULL,
  `token` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_tb`
--

INSERT INTO `registration_tb` (`id`, `username`, `email`, `mobile`, `fpassword`, `cpassword`, `token`, `status`, `register_date`) VALUES
(31, 'U Govind', 'akhilkumar7853@gmail.com', '8786875765', '$2y$10$QWM6k3BHO0jFGK3yjZI31u57Acd8yGJtO1fsmrRHxXybIeDULeewG', '$2y$10$Kkg7AfV3Qh7f7rBneNG/GuQ/2AM0/S2xCiu/kzb.BGQsuY.nCdMWm', '8449e3402c962160d00da66db689bf', 'Active', '2021-02-16 14:01:06'),
(34, 'Akhil', 'akhilkumar785300@gmail.com', '8768775577', '$2y$10$/WrMti8Uz531dS8kNwA5VeDGfpbBIFt6Ic857OOlJpJqVwDiacEpC', '$2y$10$H4X3tzm9..1ogVaNfj9gm.GDDW38scEjuchcpseT.P/Lw8.52RRqW', 'f5aa2a849df1901762b28412bd4e44', 'Active', '2021-05-30 16:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(60) NOT NULL,
  `student_roll` varchar(60) NOT NULL,
  `student_gender` varchar(15) NOT NULL,
  `student_parent` varchar(60) NOT NULL,
  `student_mobile` varchar(11) NOT NULL,
  `teacher_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tb`
--

INSERT INTO `student_tb` (`student_id`, `student_name`, `student_roll`, `student_gender`, `student_parent`, `student_mobile`, `teacher_id`) VALUES
(71, 'Akhil', '01', 'MALE', 'AKhil', '8868687676', 31),
(72, 'Ajit', '02', 'MALE', 'Ajit', '8867676888', 31),
(73, 'Sourav', '03', 'MALE', 'Sourav', '7678686887', 31),
(74, 'Jagat', '04', 'MALE', 'Jagat', '7865776778', 31),
(75, 'Akhil', '01', 'MALE', 'Ka', '6767657656', 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin_tb`
--
ALTER TABLE `adminlogin_tb`
  ADD PRIMARY KEY (`a_login_id`);

--
-- Indexes for table `attendance_records_tb`
--
ALTER TABLE `attendance_records_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_tb`
--
ALTER TABLE `registration_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin_tb`
--
ALTER TABLE `adminlogin_tb`
  MODIFY `a_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_records_tb`
--
ALTER TABLE `attendance_records_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `registration_tb`
--
ALTER TABLE `registration_tb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `student_tb`
--
ALTER TABLE `student_tb`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
