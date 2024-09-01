-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 05:11 AM
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
-- Database: `wscube-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `ws_students`
--

CREATE TABLE `ws_students` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ws_students`
--

INSERT INTO `ws_students` (`id`, `fname`, `lname`, `contact`, `email`, `course_name`, `regdate`, `photo`, `status`) VALUES
(31, 'Chetan', 'Patil', '9123456789', 'chetan@gmail.com', 'php', '2024-08-27 03:46:11', 'Chetan Patil image.jpeg', 0),
(32, 'ram', 'Patil', '9579894367', 'ram@gmail.com', 'php', '2024-08-27 03:46:22', 'Krishna image.jpeg', 1),
(33, 'krishna', 'Patil', '7886655609', 'krishna@gmail.com', 'java', '2024-08-27 03:46:23', 'Krishna image.jpeg', 1),
(34, 'keshav', 'Patil', '9489297546', 'keshav@gmail.com', 'java', '2024-08-26 11:20:52', 'nature2.jpg', 0),
(35, 'shiv', 'Patil', '7886655609', 'shiv@gmail.com', 'python', '2024-08-26 11:21:30', 'Shivarjun img.jpeg', 0),
(36, 'om', 'Patil', '9123456789', 'om@gmail.com', 'python', '2024-08-26 11:21:52', 'Shivarjun img.jpeg', 0),
(37, 'somnath', 'Patil', '9489297546', 'om@gmail.com', 'python', '2024-08-27 02:48:23', 'nature1.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ws_students`
--
ALTER TABLE `ws_students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ws_students`
--
ALTER TABLE `ws_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
