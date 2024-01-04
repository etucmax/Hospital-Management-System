-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 08:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@mail.com', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_description` varchar(40) DEFAULT NULL,
  `solution` varchar(30) DEFAULT NULL,
  `test` varchar(30) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `appointment_doctor_id` int(11) DEFAULT NULL,
  `appointment_patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `appointment_date`, `appointment_description`, `solution`, `test`, `fee`, `appointment_doctor_id`, `appointment_patient_id`) VALUES
(1, '2023-12-13', 'I have an 2 weeks flue', 'take bioflue 2x a day', 'Blood Test', 5000, 1, 1),
(6, '2023-12-21', 'i have flue', 'Take a medicine', 'Covid19 Test', 1000, 3, 1),
(7, '2023-12-07', 'vhjjhkj', NULL, NULL, 5000, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `appointment_view`
-- (See below for the actual view)
--
CREATE TABLE `appointment_view` (
`appointment_id` int(11)
,`appointment_date` date
,`appointment_description` varchar(40)
,`solution` varchar(30)
,`test` varchar(30)
,`fee` int(11)
,`appointment_doctor_id` int(11)
,`appointment_patient_id` int(11)
,`patient_id` int(11)
,`patient_name` varchar(20)
,`patient_mobile` varchar(20)
,`patient_gender` varchar(1)
,`patient_email` varchar(30)
,`patient_password` varchar(255)
,`patient_address` varchar(30)
,`patient_blood_group` varchar(3)
,`doctor_id` int(11)
,`doctor_name` varchar(20)
,`doctor_specialist` varchar(20)
,`doctor_cost` int(11)
,`doctor_mobile` varchar(11)
,`doctor_gender` varchar(1)
,`doctor_email` varchar(55)
,`doctor_password` varchar(255)
,`doctor_address` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `bloodgroup`
--

CREATE TABLE `bloodgroup` (
  `blood_id` int(11) NOT NULL,
  `blood_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bloodgroup`
--

INSERT INTO `bloodgroup` (`blood_id`, `blood_name`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(20) DEFAULT NULL,
  `doctor_specialist` varchar(20) DEFAULT NULL,
  `doctor_cost` int(11) DEFAULT NULL,
  `doctor_mobile` varchar(11) DEFAULT NULL,
  `doctor_gender` varchar(1) DEFAULT NULL,
  `doctor_email` varchar(55) DEFAULT NULL,
  `doctor_password` varchar(255) DEFAULT NULL,
  `doctor_address` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_name`, `doctor_specialist`, `doctor_cost`, `doctor_mobile`, `doctor_gender`, `doctor_email`, `doctor_password`, `doctor_address`) VALUES
(1, 'Jastrel Acebu', 'General', 5000, '09123456789', 'M', 'jastrelacebu@yahoo.com', 'ba1708aa4c059903051953ac2872f81d', 'Davila'),
(3, 'Santi Reyes', 'General', 1000, '09123456789', 'M', 'santi@mail.com', 'f501a8928398ff5210fd486a248e1a52', 'Davila'),
(4, 'Cardo Dalisay', 'General', 1000, '09123456789', 'M', 'cardo@mail.com', 'babe151e6524404d55272d73e97322dc', 'Davila'),
(5, 'rj reyes', 'General ', 100, '09123456789', 'M', 'rj@mail.com', '57703b9f43d44d89c6a7e7e1d6c772aa', 'Davila');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(20) DEFAULT NULL,
  `patient_mobile` varchar(20) DEFAULT NULL,
  `patient_gender` varchar(1) DEFAULT NULL,
  `patient_email` varchar(30) DEFAULT NULL,
  `patient_password` varchar(255) DEFAULT NULL,
  `patient_address` varchar(30) DEFAULT NULL,
  `patient_blood_group` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `patient_mobile`, `patient_gender`, `patient_email`, `patient_password`, `patient_address`, `patient_blood_group`) VALUES
(1, 'Gabriel Rabara', '09987654321', 'F', 'gab@gmail.com', '8806c91d77adc92cfac74f121224077c', 'Batac', 'O+');

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `specialist_id` int(11) NOT NULL,
  `specialist_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`specialist_id`, `specialist_name`) VALUES
(1, 'General'),
(2, 'Neurologist'),
(3, 'Ophthalmologists'),
(4, 'Radiologists');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `test_name`) VALUES
(4, 'Blood Test'),
(7, 'Xray Test'),
(8, 'Covid19 Test'),
(9, 'HIV test');

-- --------------------------------------------------------

--
-- Structure for view `appointment_view`
--
DROP TABLE IF EXISTS `appointment_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `appointment_view`  AS SELECT `appointment`.`appointment_id` AS `appointment_id`, `appointment`.`appointment_date` AS `appointment_date`, `appointment`.`appointment_description` AS `appointment_description`, `appointment`.`solution` AS `solution`, `appointment`.`test` AS `test`, `appointment`.`fee` AS `fee`, `appointment`.`appointment_doctor_id` AS `appointment_doctor_id`, `appointment`.`appointment_patient_id` AS `appointment_patient_id`, `patient`.`patient_id` AS `patient_id`, `patient`.`patient_name` AS `patient_name`, `patient`.`patient_mobile` AS `patient_mobile`, `patient`.`patient_gender` AS `patient_gender`, `patient`.`patient_email` AS `patient_email`, `patient`.`patient_password` AS `patient_password`, `patient`.`patient_address` AS `patient_address`, `patient`.`patient_blood_group` AS `patient_blood_group`, `doctor`.`doctor_id` AS `doctor_id`, `doctor`.`doctor_name` AS `doctor_name`, `doctor`.`doctor_specialist` AS `doctor_specialist`, `doctor`.`doctor_cost` AS `doctor_cost`, `doctor`.`doctor_mobile` AS `doctor_mobile`, `doctor`.`doctor_gender` AS `doctor_gender`, `doctor`.`doctor_email` AS `doctor_email`, `doctor`.`doctor_password` AS `doctor_password`, `doctor`.`doctor_address` AS `doctor_address` FROM ((`appointment` join `patient` on(`appointment`.`appointment_patient_id` = `patient`.`patient_id`)) join `doctor` on(`appointment`.`appointment_doctor_id` = `doctor`.`doctor_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointment_doctor_id` (`appointment_doctor_id`),
  ADD KEY `appointment_patient_id` (`appointment_patient_id`);

--
-- Indexes for table `bloodgroup`
--
ALTER TABLE `bloodgroup`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`specialist_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bloodgroup`
--
ALTER TABLE `bloodgroup`
  MODIFY `blood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `specialist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`appointment_doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`appointment_patient_id`) REFERENCES `patient` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
