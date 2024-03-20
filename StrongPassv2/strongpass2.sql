-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 06, 2024 at 05:11 AM
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
  `VIewerID` int DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`MainID`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`MainID`, `UserID`, `Site`, `Username`, `Password`, `LastUpdated`, `Note`, `URL`, `VIewerID`, `Category`) VALUES
(1, 110, 'Reddit', 'redditor', 'R3dd1tUpv0t3', '2024-02-21 01:12:05', 'Community forums', 'https://www.reddit.com', 1010, 'Social'),
(2, 108, 'Stack Overflow', 'stackoverflower', 'S0v3rfl0wRocks', '2024-02-21 01:12:05', 'Developer Q&A', 'https://stackoverflow.com', 1008, 'Education'),
(3, 109, 'Medium', 'blogreader', 'M3d1umBl0gs', '2024-02-21 01:12:05', 'Content platform', 'https://www.medium.com', 1009, 'Social'),
(4, 107, 'Twitter', 'tweetmaster', 'Tw1tt3rPass', '2024-02-21 01:12:05', 'Microblogging platform', 'https://www.twitter.com', 1007, 'Social'),
(5, 106, 'Netflix', 'bingewatcher', 'N3tflix&Chill', '2024-02-21 01:12:05', 'Streaming service', 'https://www.netflix.com', 1006, 'Streaming'),
(6, 104, 'LinkedIn', 'professional', 'L1nk3d1nC0nn3ct', '2024-02-21 01:12:05', 'Professional network', 'https://www.linkedin.com', 1004, 'Social'),
(7, 105, 'GitHub', 'codegeek', 'G1tHUbRul3s!', '2024-02-21 01:12:05', 'Code repository', 'https://www.github.com', 1005, 'Education'),
(8, 103, 'Amazon', 'shopaholic', 'AmaZ0n$hop', '2024-02-21 01:12:05', 'Online shopping', 'https://www.amazon.com', 1003, 'Gaming'),
(9, 102, 'Facebook', 'fbuser', 'F@cebook123', '2024-02-21 01:12:05', 'Social media', 'https://www.facebook.com', 1002, 'Social'),
(10, 101, 'Google', 'user123', 'G00gl3P@ss', '2024-02-21 01:12:05', 'Search engine', 'https://www.google.com', 1001, 'Social'),
(11, 301, 'Codecademy', 'codelearner', 'C0d3c@d3myRocks', '2024-03-05 15:00:00', 'Online coding education', 'https://www.codecademy.com', 1201, 'Education'),
(12, 305, 'Khan Academy', 'khanstudent', 'Kh@nAc@demy', '2024-03-05 15:20:00', 'Free online education', 'https://www.khanacademy.org', 1205, 'Education'),
(13, 631, 'National Geographic', 'natgeokidsreader', 'NGK1dsR34d3r', '2024-03-06 15:00:00', 'Educational content for kids', 'https://nationalgeographic.com', 1631, 'Education'),
(14, 307, 'LeetCode', 'leetcodecoder', 'L33tC0d3Rul3z', '2024-03-05 15:30:00', 'Coding interview preparation', 'https://www.leetcode.com', 1207, 'Education'),
(15, 401, 'Steam', 'gameplayer', 'St34mG@m3r123', '2024-03-05 16:00:00', 'Gaming platform', 'https://store.steampowered.com', 1301, 'Gaming'),
(16, 403, 'Twitch', 'twitchstreamer', 'Tw1tchStr3@m', '2024-03-05 16:10:00', 'Live streaming for gamers', 'https://www.twitch.tv', 1303, 'Streaming'),
(17, 405, 'Xbox Live', 'xboxgamer', 'Xb0xG@m3rLive', '2024-03-05 16:20:00', 'Online gaming service for Xbox users', 'https://www.xbox.com', 1305, 'Gaming'),
(18, 408, 'Snapchat', 'snapgamer', 'Sn@pG@m3R', '2024-03-05 16:35:00', 'Gaming snaps on Snapchat', 'https://www.snapchat.com', 1308, 'Gaming'),
(19, 633, 'ESPN', 'espnsportsfan', 'ESPNF@natic', '2024-03-06 15:20:00', 'Sports network for news and highlights', 'https://www.espn.com/', 1633, 'Streaming'),
(20, 501, 'Epic Games', 'epicgamer', 'Ep1cG@mes123', '2024-03-05 17:00:00', 'Gaming and digital distribution platform', 'https://www.epicgames.com', 1401, 'Gaming'),
(21, 603, 'Spotify', 'musiclover', 'Sp0t1fyMusiC', '2024-03-06 10:20:00', 'Music streaming service', 'https://www.spotify.com', 1603, 'Streaming'),
(22, 605, 'Wikipedia', 'wikieditor', 'W1k1P3diaRules', '2024-03-06 10:40:00', 'Free online encyclopedia', 'https://www.wikipedia.org', 1605, 'Education'),
(23, 607, 'SoundCloud', 'soundclouduser', 'S0undCl0udBeats', '2024-03-06 11:00:00', 'Music streaming and sharing platform', 'https://soundcloud.com', 1607, 'Streaming'),
(24, 608, 'Trello', 'trellofan', 'Tr3ll0B0ard', '2024-03-06 11:10:00', 'Collaboration and project management tool', 'https://trello.com', 1608, 'Education'),
(25, 609, 'Zoom', 'zoomuser', 'Z00mM33ting', '2024-03-06 11:20:00', 'Video conferencing platform', 'https://www.zoom.us', 1609, 'Education'),
(26, 618, 'Slack', 'slackuser', 'Sl@ckCh@t', '2024-03-06 12:50:00', 'Messaging and collaboration platform', 'https://slack.com', 1618, 'Education'),
(27, 623, 'The New York Times', 'nytreader', 'NYT@2024', '2024-03-06 13:40:00', 'American newspaper based in New York City', 'https://www.nytimes.com', 1623, 'Education'),
(28, 624, 'Walmart', 'walmartshopper', 'W@lm@rtSh0pp3r', '2024-03-06 13:50:00', 'Retail corporation for shopping', 'https://www.walmart.com', 1624, 'Social'),
(29, 626, 'Best Buy', 'bestbuyshopper', 'B3stBuyDeals', '2024-03-06 14:10:00', 'Consumer electronics retailer', 'https://www.bestbuy.com', 1626, 'Social'),
(30, 640, 'IMDb', 'moviebuff', 'IMD8M0vieL0ver', '2024-03-06 16:30:00', 'Internet Movie Database', 'https://www.imdb.com/', 1640, 'Entertainment'),
(31, 641, 'Yelp', 'yelpreviewer', 'Y3lpReview3r', '2024-03-06 16:40:00', 'Find and review local businesses', 'https://www.yelp.com/', 1641, 'Social');

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
(01, 'James', 'Smith', 'jamessmith'),
(02, 'Bob', 'Saget', 'bobsaget'),
(03, 'Bob', 'Dylan', 'bobdylan'),
(04, 'Bob', 'Barker', 'bobbarker'),
(05, 'John', 'Doe', 'johndoe'),
(06, 'Jane', 'Doe', 'janedoe'),
(07, 'John', 'Brown', 'johnbrown'),
(08, 'Mehr', 'Anti', 'mehranti'),
(09, 'Hank', 'Hill', 'hankhill'),
(10, 'Burt', 'Gladys', 'burtgladys');

-- --------------------------------------------------------

--
-- Table structure for table `usercolor`
--

DROP TABLE IF EXISTS `usercolor`;
CREATE TABLE IF NOT EXISTS `usercolor` (
  `UserID` int NOT NULL,
  `R` int NOT NULL,
  `G` int NOT NULL,
  `B` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usercolor`
--

INSERT INTO `usercolor` (`UserID`, `R`, `G`, `B`) VALUES
(101, 0, 0, 0),
(102, 0, 0, 0),
(103, 0, 0, 0),
(104, 0, 0, 0),
(105, 0, 0, 0),
(106, 0, 0, 0),
(107, 0, 0, 0),
(108, 0, 0, 0),
(109, 0, 0, 0),
(115, 0, 0, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `viewer`
--

INSERT INTO `viewer` (`ViewerID`, `UserID`, `MainID`) VALUES
(101, 101, 30),
(102, 101, 32),
(103, 101, 31),
(104, 101, 29),
(105, 101, 28),
(106, 101, 27),
(107, 101, 26),
(108, 101, 25),
(109, 101, 24),
(110, 101, 23),
(111, 101, 33),
(112, 101, 34);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
