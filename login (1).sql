-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql209.infinityfree.com
-- Generation Time: Aug 06, 2023 at 03:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_34559758_tybca_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Last_Used_Date` varchar(50) NOT NULL,
  `Last_Used_Time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `First_Name`, `Last_Name`, `Email`, `Password`, `TimeStamp`, `Last_Used_Date`, `Last_Used_Time`) VALUES
(1, 'Liam', 'Neeson', 'liamneeson28@gmail.com', '$2y$10$r9zv2TGzVql5pVRA1KYDu.3GLsB965B7DDkiE9yTuND8druhRTLDS', '2023-07-19 19:17:54', '', ''),
(2, 'Sara', 'Satam', 'sara.cooper@gmail.com', '$2y$10$GU6mzNIxiqo5hTL8cxSzPusVvFWl5eTS7j3UrfI7MG4Z3wbYeE7QG', '2023-07-19 19:17:54', '', ''),
(3, 'Sid', 'Surve', 'siddharthsurve29@gmail.com', '$2y$10$Tl9ajqVKwJIUQDCxUWDF4Ol6sLmQVe75FTbJGy/ggDLLd2MzDu.jm', '2023-07-19 19:17:54', '2023/08/05', '09:03:45'),
(4, 'Ashwini ', 'Jain ', 'ashjain123@gmail.com', '$2y$10$mffx.bsHiDYocXXVpW7KLutSn5YykomSbtotO0z4ZxHOHASIOUol.', '2023-07-19 19:17:54', '', ''),
(5, 'Rekha', 'Surve', 'surve.rekha54@gmail.com', '$2y$10$t4MZO8yF1qJp/0BCptIdZuBk3cYa8vBeoLZwMGw64H2iHRiGJXHnm', '2023-07-19 19:17:54', '2023/08/06', '12:47:39'),
(6, 'Lata', 'Mahadik', 'mahadiklata303@gmail.com', '$2y$10$bY6phuK2k/gd6l/VebaZ4OtHkM1z1HGRWN2zc9isHQq85jTp3m9D2', '2023-07-19 19:17:54', '2023/07/30', '08:40:07'),
(7, 'Sara', 'Satam', 'sarasatam23@gmail.com', '$2y$10$4vwSXfG1GFoTYDEEksl8UuT6l4ouGvXhcmYtmCJkG8nrA5TA.YR8q', '2023-07-19 19:17:54', '', ''),
(8, 'Sirajuddin ', 'Syed Qadri ', 'siraj6246@gmail.com', '$2y$10$KfvKp3yFlv.CWqFB1QIpDOYTsUELC8beYRTGn9nBsSSH68sFJfpI.', '2023-07-19 19:17:54', '', ''),
(9, 'Anthony ', 'Hopkins ', 'clashwithsid58@gmail.com', '$2y$10$ySgAmup4.9YOlAhba4qefuBsng053mvziMPr/2yWm/31z/GbtWuK2', '2023-07-19 19:17:54', '', ''),
(10, 'Cash', 'Check', 'cashcheck0707@gmail.com', '$2y$10$Ss8ZrfaU38S0Em59kfoe1uFWOyP4vvwk1DHgSa95Tg0SfjPLQ1LpK', '2023-07-19 19:17:54', '', ''),
(11, 'Ashwini ', 'Jain ', 'ashwinijain1103@gmail.com', '$2y$10$26AjZpaVB29nPhYSgvLWU.zw3edVACQjADlfg06RurdcqukK5..NG', '2023-07-19 19:17:54', '2023/07/25', '12:36:27'),
(12, 'Siddhesh', 'Thombare', 'sin60cos90@gmail.com', '$2y$10$ZcrP2o6tSmAtFpWebaFSReTzvmjaIyOA0Hx.ovXuaPRK2Kz6nGn1W', '2023-07-19 19:17:54', '', ''),
(13, 'Eshaan ', 'Paralkar ', 'eshaanparalkar3@gmail.com', '$2y$10$roNxTViofNpQeFpCUiuZFeZ8S754oaUnqNTgOEp1wHpM/wmV5/4hm', '2023-07-29 14:30:18', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
