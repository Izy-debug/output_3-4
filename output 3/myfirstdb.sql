-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2024 at 10:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myfirstdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `person_fname` varchar(250) NOT NULL,
  `person_mname` varchar(250) NOT NULL,
  `person_lname` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `person_fname`, `person_mname`, `person_lname`) VALUES
(1, 'Marlon Juhn', 'Marsado', 'Timogan'),
(2, 'Jose Protacio', 'Alonzo', 'Rizal'),
(3, 'Bongbong', 'Romualdez', 'Marcos'),
(4, 'Leni', 'Gerona', 'Robredo');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_fname` varchar(250) NOT NULL,
  `student_mname` varchar(250) DEFAULT NULL,
  `student_lname` varchar(250) NOT NULL,
  `student_gender` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_fname`, `student_mname`, `student_lname`, `student_gender`) VALUES
(70, 'Kyle', 'Marsado', 'Timogan', 'F'),
(72, 'Ferdinand', 'Romualdez', 'Marcos', 'F'),
(78, 'Marlon', 'Marsado', 'Timogan', 'M'),
(80, 'Leni', 'Gerona', 'Robredo', 'F'),
(81, 'Gloria', 'Macapagal', 'Arroyo', 'F'),
(105, 'asd', 'asd', 'asd', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
