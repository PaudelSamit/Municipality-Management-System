-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 04:49 AM
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
-- Database: `municipality`
--

-- --------------------------------------------------------

--
-- Table structure for table `addproject`
--

CREATE TABLE `addproject` (
  `Project_No` int(20) NOT NULL,
  `Project_Name` varchar(50) NOT NULL,
  `Department_No` int(20) NOT NULL,
  `Budget` varchar(20) NOT NULL,
  `Project_Company` varchar(50) NOT NULL,
  `Project_Location` varchar(50) NOT NULL,
  `Project_Completed` varchar(50) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addproject`
--

INSERT INTO `addproject` (`Project_No`, `Project_Name`, `Department_No`, `Budget`, `Project_Company`, `Project_Location`, `Project_Completed`, `Start_Date`, `End_Date`) VALUES
(32, 'Electricity', 5000, '50000', 'ACHARYA BROTHERS', 'POkhara', '40', '2023-12-27', '2023-12-18'),
(33, 'Electricity', 1234, '10000', 'Citymax', 'POkhara', '40', '2023-12-13', '2023-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_details`
--

CREATE TABLE `citizen_details` (
  `First_name` varchar(50) NOT NULL,
  `Middle_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `Family_name` varchar(40) NOT NULL,
  `Date_of_Birth` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `Citizen_ID` varchar(50) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Marriage_ID` int(50) NOT NULL,
  `Phone_Number` int(30) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Zip_code` varchar(20) NOT NULL,
  `House_No` int(20) NOT NULL,
  `Street_Name` varchar(30) NOT NULL,
  `Street_Number` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen_details`
--

INSERT INTO `citizen_details` (`First_name`, `Middle_name`, `Last_name`, `Family_name`, `Date_of_Birth`, `Citizen_ID`, `Gender`, `Marriage_ID`, `Phone_Number`, `City`, `Zip_code`, `House_No`, `Street_Name`, `Street_Number`) VALUES
('Shyam', 'hari', ' gurung', 'Sandesh Gurung', '2023-12-23 03:51:15.141519', '1234567', 'male', 0, 2147483647, ' Syangja', ' 33800', 9012, 'Birauta', 1234),
(' Shreedhar', 'wee', ' gurung', 'Sandesh Gurung', '2023-12-11 18:15:00.000000', '12345673', 'male', 1245, 2147483647, ' Syangja', ' 33800', 9012, 'Birauta', 1234),
(' Ankit', '', 'Poudel', 'Shiva poudel', '2023-12-27 11:59:18.869536', '11111111', 'male', 0, 2147483647, ' Syangja', ' 33800', 987, 'Birauta', 12343);

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `Citizen_ID` int(30) NOT NULL,
  `Complain` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`Citizen_ID`, `Complain`) VALUES
(1234567, 'kfnsdkjnfklsdanfslkdnvkjsrngoir'),
(1234567, 'fgfdf'),
(11111111, 'i dont like this.\r\n'),
(1234567, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `emp_register`
--

CREATE TABLE `emp_register` (
  `emp_username` varchar(50) NOT NULL,
  `emp_password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_register`
--

INSERT INTO `emp_register` (`emp_username`, `emp_password`) VALUES
('SamitPaudel', 'Samit@123'),
('AnkitPoudel', 'Ankit@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addproject`
--
ALTER TABLE `addproject`
  ADD PRIMARY KEY (`Project_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addproject`
--
ALTER TABLE `addproject`
  MODIFY `Project_No` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
