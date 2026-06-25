-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260624.b53049675a
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 08:26 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year_level` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `course`, `year_level`, `created_at`) VALUES
(1, 'Alice Smith', 'Computer Science', 1, '2026-06-25 07:00:01'),
(2, 'Bob Jones', 'Information Technology', 3, '2026-06-25 07:00:01'),
(6, 'Dan Mikel Llenares', 'BSIT', 4, '2026-06-25 07:05:40'),
(7, 'Boss Atan', 'BSCS', 2, '2026-06-25 07:11:44'),
(8, 'Ron Iverson Parcon', 'BSIT', 1, '2026-06-25 07:12:23'),
(9, 'Roque Navarro', 'BSIT', 2, '2026-06-25 07:12:52'),
(10, 'Efren Elomi', 'BSCS', 1, '2026-06-25 07:13:17'),
(11, 'Carol', 'BSHM', 2, '2026-06-25 07:27:41'),
(12, 'Nike Adidas', 'BSHM', 2, '2026-06-25 07:44:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
