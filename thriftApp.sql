-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2022 at 11:50 AM
-- Server version: 8.0.31
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thriftApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupMember`
--

CREATE TABLE `groupMember` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `groupId` int NOT NULL,
  `dateJoined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `groupMember`
--

INSERT INTO `groupMember` (`id`, `userId`, `groupId`, `dateJoined`) VALUES
(54, 47, 5, '2022-12-22 18:30:17'),
(55, 48, 3, '2022-12-22 18:36:00'),
(56, 49, 3, '2022-12-22 18:37:59'),
(57, 50, 3, '2022-12-22 18:38:37'),
(58, 50, 4, '2022-12-22 18:38:37'),
(59, 51, 4, '2022-12-22 18:41:09'),
(60, 51, 6, '2022-12-22 18:41:09'),
(61, 52, 5, '2022-12-22 19:45:47'),
(62, 53, 4, '2022-12-23 02:04:00'),
(63, 53, 5, '2022-12-23 02:04:00'),
(64, 53, 6, '2022-12-23 02:04:00'),
(65, 55, 5, '2022-12-23 09:45:32'),
(66, 55, 6, '2022-12-23 09:45:32'),
(67, 56, 3, '2022-12-23 10:33:18'),
(68, 56, 5, '2022-12-23 10:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `thrift`
--

CREATE TABLE `thrift` (
  `id` int NOT NULL,
  `memberId` int NOT NULL,
  `paymentDate` date NOT NULL,
  `groupId` int NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thrift`
--

INSERT INTO `thrift` (`id`, `memberId`, `paymentDate`, `groupId`, `createdAt`) VALUES
(15, 54, '2022-11-03', 5, '2022-12-23 01:15:23'),
(16, 59, '2022-11-21', 4, '2022-12-23 01:34:03'),
(17, 60, '2022-12-21', 6, '2022-12-23 01:34:03'),
(18, 57, '2022-11-15', 3, '2022-12-23 01:55:17'),
(19, 58, '2022-11-15', 4, '2022-12-23 01:55:17'),
(20, 61, '2022-12-11', 5, '2022-12-23 01:58:33'),
(21, 62, '2022-12-12', 4, '2022-12-23 02:08:42'),
(22, 63, '2022-11-12', 5, '2022-12-23 02:08:42'),
(23, 55, '2022-12-21', 3, '2022-12-23 02:09:37'),
(24, 61, '2022-11-04', 5, '2022-12-23 02:13:00'),
(25, 55, '2022-09-09', 3, '2022-12-23 03:10:58'),
(26, 61, '2022-12-14', 5, '2022-12-23 03:31:11'),
(27, 62, '2022-12-07', 4, '2022-12-23 03:41:25'),
(28, 64, '2022-12-07', 6, '2022-12-23 03:41:25'),
(29, 65, '2022-12-21', 5, '2022-12-23 09:46:33'),
(30, 66, '2022-12-21', 6, '2022-12-23 09:46:33'),
(31, 60, '2022-12-22', 6, '2022-12-23 10:50:28'),
(32, 57, '2022-12-23', 3, '2022-12-23 10:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `thriftGroup`
--

CREATE TABLE `thriftGroup` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `thriftAmount` float NOT NULL,
  `currentNoMembers` int NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thriftGroup`
--

INSERT INTO `thriftGroup` (`id`, `name`, `thriftAmount`, `currentNoMembers`, `dateCreated`) VALUES
(3, 'Group-3000', 3000, 4, '2022-12-21 01:30:38'),
(4, 'Group-5000', 5000, 3, '2022-12-21 01:30:38'),
(5, 'Group-10000', 10000, 5, '2022-12-21 01:30:43'),
(6, 'Group-15000', 15000, 3, '2022-12-21 01:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `doesThrift` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `isAdmin`, `doesThrift`, `createdAt`) VALUES
(16, 'fasasi', 'fasasi', 'fasasi@test.com', '$2y$10$s4wYSdSDjj4vq5KvTpdssepk8lX/oiwWYRIsV8/Ec/T9vOOL.csBi', 1, 0, '2022-12-20 17:32:15'),
(43, 'Rea', 'Shoa', 'sho@test.com', '$2y$10$l0.0E2dyuD3YX/7PX6qys.ZOR5U8nDVT4PGLpqw0Z7Z/zSSaeUHUO', 1, 0, '2022-12-21 23:18:59'),
(47, 'Wes', 'Niox', 'niox@ya.com', '', 0, 1, '2022-12-22 18:30:17'),
(48, 'Pya', 'Jackson', 'jack@test.com', '', 0, 1, '2022-12-22 18:36:00'),
(49, 'Enzo', 'Paul', 'paulo@test.com', '$2y$10$saDJOmIvJ8jt4ER.nZSsUOZkq3PgUEIebUW2SMnH6r/JyogXhV8ny', 1, 1, '2022-12-22 18:37:59'),
(50, 'Jona', 'Liam', 'lia@tes.com', '', 0, 1, '2022-12-22 18:38:37'),
(51, 'Thomas', 'Kyle', 'kay@ws.com', '', 0, 1, '2022-12-22 18:41:09'),
(52, 'Yuri', 'Magenta', 'fred@yr.com', '$2y$10$.bhsQ1CnTZknDOuFL1a1geYTY7ynGvusXZEVEhakMvpf6eDdCKi9G', 1, 1, '2022-12-22 19:45:47'),
(53, 'Rega', 'Liam', 'loaa@at.com', '$2y$10$x1gt7TxDQ9kJQCXY0ribi.ajhRmahila.H7CiqNYFa2xxhxOcTcru', 1, 1, '2022-12-23 02:04:00'),
(54, 'Charles', 'Dury', 'Durydury@test.com', '$2y$10$9f3ni88zQNe56SDjosKYWeJEASXlO.mwX0h0KR2GjphB.hvce27VO', 1, 0, '2022-12-23 09:44:26'),
(55, 'Lola', 'Joye', 'lola@test.com', '$2y$10$VxRxxuA67adt0trbhueH2.1m6GmkJUzIO.SBbw7/Hg2rgUglRfIqS', 1, 1, '2022-12-23 09:45:32'),
(56, 'Sola', 'Anik', 'aniks@as.com', '', 0, 1, '2022-12-23 10:33:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupMember`
--
ALTER TABLE `groupMember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thrift`
--
ALTER TABLE `thrift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thriftGroup`
--
ALTER TABLE `thriftGroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupMember`
--
ALTER TABLE `groupMember`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `thrift`
--
ALTER TABLE `thrift`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `thriftGroup`
--
ALTER TABLE `thriftGroup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
