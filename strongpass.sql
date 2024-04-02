-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2024 at 02:30 AM
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
-- Table structure for table `adminset`
--

DROP TABLE IF EXISTS `adminset`;
CREATE TABLE IF NOT EXISTS `adminset` (
  `PassAge` int NOT NULL,
  `PassLength` int NOT NULL,
  `Color` int NOT NULL,
  `Algo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adminset`
--

INSERT INTO `adminset` (`PassAge`, `PassLength`, `Color`, `Algo`) VALUES
(60, 8, 0, '');

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
  `ShareLock` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MainID`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`MainID`, `UserID`, `Site`, `Username`, `Password`, `LastUpdated`, `Note`, `URL`, `VIewerID`, `Category`, `ShareLock`) VALUES
(1, 2, 'Reddit', 'redditor', 'R3dd1tUpv0t3', '2024-03-24 01:26:19', 'Community forums', 'https://www.reddit.com', 1, 'Social', 0),
(2, 1, 'Stack Overflow', 'stackoverflower', 'S0v3rfl0wRocks', '2024-03-24 01:27:23', 'Developer Q&A', 'https://stackoverflow.com', 2, 'Education', 0),
(3, 1, 'Medium', 'blogreader', 'M3d1umBl0gs', '2024-03-24 01:27:23', 'Content platform', 'https://www.medium.com', 2, 'Social', 0),
(4, 1, 'Twitter', 'tweetmaster', 'Tw1tt3rPass', '2024-03-24 01:27:23', 'Microblogging platform', 'https://www.twitter.com', 2, 'Social', 0),
(5, 1, 'Netflix', 'bingewatcher', 'N3tflix&Chill', '2024-03-24 01:27:23', 'Streaming service', 'https://www.netflix.com', 2, 'Streaming', 0),
(6, 1, 'LinkedIn', 'professional', 'L1nk3d1nC0nn3ct', '2024-03-24 01:27:23', 'Professional network', 'https://www.linkedin.com', 2, 'Social', 0),
(7, 1, 'GitHub', 'codegeek', 'G1tHUbRul3s!', '2024-03-24 01:27:23', 'Code repository', 'https://www.github.com', 2, 'Education', 0),
(8, 1, 'Amazon', 'shopaholic', 'AmaZ0n$hop', '2024-04-02 06:27:29', 'Online shopping', 'https://www.amazon.com', 4, 'Gaming', 0),
(9, 1, 'Facebook', 'fbuser', 'F@cebook123', '2024-03-24 01:27:23', 'Social media', 'https://www.facebook.com', 2, 'Social', 0),
(10, 1, 'Google', 'user123', 'G00gl3P@ss', '2024-03-24 01:27:23', 'Search engine', 'https://www.google.com', 2, 'Social', 0),
(11, 1, 'Codecademy', 'codelearner', 'C0d3c@d3myRocks', '2024-03-28 04:12:10', 'Online coding education', 'https://www.codecademy.com', 3, 'Education', 0),
(12, 1, 'Khan Academy', 'khanstudent', 'Kh@nAc@demy', '2024-03-24 01:27:23', 'Free online education', 'https://www.khanacademy.org', 2, 'Education', 0),
(13, 1, 'National Geographic', 'natgeokidsreader', 'NGK1dsR34d3r', '2024-03-24 01:27:23', 'Educational content for kids', 'https://nationalgeographic.com', 2, 'Education', 0),
(14, 1, 'LeetCode', 'leetcodecoder', 'L33tC0d3Rul3z', '2024-03-24 01:27:23', 'Coding interview preparation', 'https://www.leetcode.com', 2, 'Education', 0),
(15, 1, 'Steam', 'gameplayer', 'St34mG@m3r123', '2024-03-24 01:27:23', 'Gaming platform', 'https://store.steampowered.com', 2, 'Gaming', 0),
(16, 1, 'Twitch', 'twitchstreamer', 'Tw1tchStr3@m', '2024-03-05 16:10:00', 'Live streaming for gamers', 'https://www.twitch.tv', 2, 'Streaming', 0),
(17, 1, 'Xbox Live', 'xboxgamer', 'Xb0xG@m3rLive', '2024-03-05 16:20:00', 'Online gaming service for Xbox users', 'https://www.xbox.com', 2, 'Gaming', 0),
(18, 1, 'Snapchat', 'snapgamer', 'Sn@pG@m3R', '2024-03-05 16:35:00', 'Gaming snaps on Snapchat', 'https://www.snapchat.com', 2, 'Gaming', 0),
(19, 1, 'ESPN', 'espnsportsfan', 'ESPNF@natic', '2024-03-06 15:20:00', 'Sports network for news and highlights', 'https://www.espn.com/', 2, 'Streaming', 0),
(20, 1, 'Epic Games', 'epicgamer', 'Ep1cG@mes123', '2024-03-05 17:00:00', 'Gaming and digital distribution platform', 'https://www.epicgames.com', 2, 'Gaming', 0),
(21, 1, 'Spotify', 'musiclover', 'Sp0t1fyMusiC', '2024-03-06 10:20:00', 'Music streaming service', 'https://www.spotify.com', 2, 'Streaming', 0),
(22, 1, 'Wikipedia', 'wikieditor', 'W1k1P3diaRules', '2024-03-06 10:40:00', 'Free online encyclopedia', 'https://www.wikipedia.org', 2, 'Education', 0),
(23, 1, 'SoundCloud', 'soundclouduser', 'S0undCl0udBeats', '2024-03-06 11:00:00', 'Music streaming and sharing platform', 'https://soundcloud.com', 2, 'Streaming', 0),
(24, 1, 'Trello', 'trellofan', 'Tr3ll0B0ard', '2024-03-06 11:10:00', 'Collaboration and project management tool', 'https://trello.com', 2, 'Education', 0),
(25, 1, 'Zoom', 'zoomuser', 'Z00mM33ting', '2024-03-06 11:20:00', 'Video conferencing platform', 'https://www.zoom.us', 2, 'Education', 0),
(26, 1, 'Slack', 'slackuser', 'Sl@ckCh@t', '2024-03-06 12:50:00', 'Messaging and collaboration platform', 'https://slack.com', 3, 'Education', 0),
(27, 1, 'The New York Times', 'nytreader', 'NYT@2024', '2024-03-06 13:40:00', 'American newspaper based in New York City', 'https://www.nytimes.com', 3, 'Education', 0),
(28, 1, 'Walmart', 'walmartshopper', 'W@lm@rtSh0pp3r', '2024-03-06 13:50:00', 'Retail corporation for shopping', 'https://www.walmart.com', 3, 'Social', 0),
(29, 1, 'Best Buy', 'bestbuyshopper', 'B3stBuyDeals', '2024-04-02 06:17:27', 'Consumer electronics retailer', 'https://www.bestbuy.com', 3, 'Social', 0),
(30, 1, 'IMDb', 'moviebuff', 'IMD8M0vieL0ver', '2024-03-06 16:30:00', 'Internet Movie Database', 'https://www.imdb.com/', 3, 'Entertainment', 0),
(31, 1, 'Yelp', 'yelpreviewer', 'Y3lpReview3r', '2024-03-06 16:40:00', 'Find and review local businesses', 'https://www.yelp.com/', 3, 'Social', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `UserID` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `FirstName`, `LastName`, `Username`, `Admin`) VALUES
(1, 'James', 'Smith', 'jamessmith', 1),
(2, 'Bob', 'Saget', 'bobsaget', 0),
(3, 'Bob', 'Dylan', 'bobdylan', 0),
(4, 'Bob', 'Barker', 'bobbarker', 0),
(5, 'John', 'Doe', 'johndoe', 0),
(6, 'Jane', 'Doe', 'janedoe', 0),
(7, 'John', 'Brown', 'johnbrown', 0),
(8, 'Mehr', 'Anti', 'mehranti', 0),
(9, 'Hank', 'Hill', 'hankhill', 0),
(10, 'Burt', 'Gladys', 'burtgladys', 0);

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
