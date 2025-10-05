-- phpMyAdmin SQL Dump
-- version 6.0.0-dev
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2025 at 10:43 AM
-- Server version: 12.0.2-MariaDB
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro`
--
DROP DATABASE IF EXISTS `pro`;
CREATE DATABASE IF NOT EXISTS `pro` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pro`;

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `genderId` tinyint(1) NOT NULL AUTO_INCREMENT,
  `genderName` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`genderId`),
  UNIQUE KEY `genderName` (`genderName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`genderId`, `genderName`, `created`, `updated`) VALUES
(1, 'female', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(2, 'male', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(3, 'prefer not to say', '2025-10-03 10:39:28', '2025-10-03 10:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roleId` tinyint(1) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`roleId`),
  UNIQUE KEY `roleName` (`roleName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`, `created`, `updated`) VALUES
(1, 'admin', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(2, 'editor', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(3, 'viewer', '2025-10-03 10:39:28', '2025-10-03 10:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `skillId` bigint(10) NOT NULL AUTO_INCREMENT,
  `skillName` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`skillId`),
  UNIQUE KEY `skillName` (`skillName`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skillId`, `skillName`, `created`, `updated`) VALUES
(1, 'PHP', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(2, 'JavaScript', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(3, 'HTML', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(4, 'CSS', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(5, 'MySQL', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(6, 'Python', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(7, 'Java', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(8, 'C#', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(9, 'Ruby', '2025-10-03 10:39:28', '2025-10-03 10:39:28'),
(10, 'Go', '2025-10-03 10:39:28', '2025-10-03 10:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` bigint(10) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `verify_code` varchar(10) NOT NULL,
  `code_expiry_time` datetime DEFAULT NULL,
  `mustchange` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('Active','Inactive','Suspended','Pending','Deleted') DEFAULT 'Pending',
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `roleId` tinyint(1) NOT NULL DEFAULT 1,
  `genderId` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`),
  KEY `users_roleId_fk` (`roleId`),
  KEY `users_genderId_fk` (`genderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

DROP TABLE IF EXISTS `user_skills`;
CREATE TABLE IF NOT EXISTS `user_skills` (
  `user_skillId` bigint(10) NOT NULL AUTO_INCREMENT,
  `userId` bigint(10) NOT NULL,
  `skillId` bigint(10) NOT NULL,
  `proficiency` enum('Beginner','Intermediate','Advanced','Expert') DEFAULT 'Beginner',
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_skillId`),
  KEY `user_skills_userId_fk` (`userId`),
  KEY `user_skills_skillId_fk` (`skillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_genderId_fk` FOREIGN KEY (`genderId`) REFERENCES `genders` (`genderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_roleId_fk` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD CONSTRAINT `user_skills_skillId_fk` FOREIGN KEY (`skillId`) REFERENCES `skills` (`skillId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_skills_userId_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
