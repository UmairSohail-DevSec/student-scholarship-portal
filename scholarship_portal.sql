-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 05:44 PM
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
-- Database: `scholarship_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `degree_level` varchar(100) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `benefits` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `title`, `country`, `degree_level`, `institution`, `benefits`) VALUES
(1, 'Global Undergraduate Exchange', 'USA', 'Bachelors', 'Various Universities', 'Full tuition, living stipend, and airfare.'),
(2, 'Oxford Weidenfeld-Hoffmann', 'United Kingdom', 'Masters', 'University of Oxford', '100% of course fees and a grant for living costs.'),
(3, 'Presidential PhD Fellowship', 'Germany', 'PhD', 'Technical University of Munich', 'Monthly research allowance and health insurance.'),
(4, 'Chinese Government Scholarship', 'China', 'Bachelors', 'Peking University', 'Free accommodation and monthly pocket money.'),
(5, 'Humber Graduate Scholarship', 'Canada', 'Masters', 'Humber College', 'Partial tuition fees waiver for international students.'),
(7, 'Global exchange program', 'UAE', 'PhD', 'UAF', 'Monthly research allowance and health insurances');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`) VALUES
(1, 'MUHAMMAD UMAIR SOHAIL', 'currentom3@gmail.com', '123'),
(2, 'Umair Sohail', 'umair@gmail.com', '123'),
(3, 'MUHAMMAD UMAIR SOHAIL', 'umairsohail@gmail.com', 'sohail123');

-- --------------------------------------------------------

--
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `last_degree` varchar(100) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `marks_percentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_profiles`
--

INSERT INTO `student_profiles` (`id`, `student_id`, `last_degree`, `institution`, `marks_percentage`) VALUES
(2, 1, 'Intermediate', 'uaf', 50),
(3, 1, 'Bachelors', 'uaf', 90),
(4, 2, 'Masters', 'uaf', 90),
(5, 1, 'Masters', 'uaf', 90),
(6, 1, 'Intermediate', 'uaf', 60),
(7, 1, 'Bachelors', 'uaf', 60),
(8, 1, 'Masters', 'uaf', 60),
(9, 1, 'Bachelors', 'uaf', 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `student_profiles_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
