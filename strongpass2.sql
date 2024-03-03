-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2024 at 01:49 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `strongpass`
--

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

DROP TABLE IF EXISTS `main`;
CREATE TABLE IF NOT EXISTS `main` (
  `MainID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `Site` varchar(100) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(512) NOT NULL,
  `LastUpdated` timestamp NOT NULL,
  `Note` text,
  `URL` varchar(100) DEFAULT NULL,
  `VIewerID` int NOT NULL,
  PRIMARY KEY (`MainID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`MainID`, `UserID`, `Site`, `Username`, `Password`, `LastUpdated`, `Note`, `URL`, `VIewerID`) VALUES
(32, 110, 'Reddit', 'redditor', 'R3dd1tUpv0t3', '2024-02-21 01:12:05', 'Community forums', 'https://www.reddit.com', 1010),
(30, 108, 'Stack Overflow', 'stackoverflower', 'S0v3rfl0wRocks', '2024-02-21 01:12:05', 'Developer Q&A', 'https://stackoverflow.com', 1008),
(31, 109, 'Medium', 'blogreader', 'M3d1umBl0gs', '2024-02-21 01:12:05', 'Content platform', 'https://www.medium.com', 1009),
(29, 107, 'Twitter', 'tweetmaster', 'Tw1tt3rPass', '2024-02-21 01:12:05', 'Microblogging platform', 'https://www.twitter.com', 1007),
(28, 106, 'Netflix', 'bingewatcher', 'N3tflix&Chill', '2024-02-21 01:12:05', 'Streaming service', 'https://www.netflix.com', 1006),
(26, 104, 'LinkedIn', 'professional', 'L1nk3d1nC0nn3ct', '2024-02-21 01:12:05', 'Professional network', 'https://www.linkedin.com', 1004),
(27, 105, 'GitHub', 'codegeek', 'G1tHUbRul3s!', '2024-02-21 01:12:05', 'Code repository', 'https://www.github.com', 1005),
(25, 103, 'Amazon', 'shopaholic', 'AmaZ0n$hop', '2024-02-21 01:12:05', 'Online shopping', 'https://www.amazon.com', 1003),
(24, 102, 'Facebook', 'fbuser', 'F@cebook123', '2024-02-21 01:12:05', 'Social media', 'https://www.facebook.com', 1002),
(23, 101, 'Google', 'user123', 'G00gl3P@ss', '2024-02-21 01:12:05', 'Search engine', 'https://www.google.com', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Username` varchar(25) NOT NULL,
  UNIQUE KEY `UserID` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `FirstName`, `LastName`, `Username`) VALUES
(101, 'James', 'Smith', 'jamessmith'),
(115, 'Bob', 'Saget', 'bobsaget'),
(102, 'Hank', 'Hill', 'hankhill');

-- --------------------------------------------------------

--
-- Table structure for table `viewer`
--

DROP TABLE IF EXISTS `viewer`;
CREATE TABLE IF NOT EXISTS `viewer` (
  `ViewerID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `MainID` int NOT NULL,
  PRIMARY KEY (`ViewerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
