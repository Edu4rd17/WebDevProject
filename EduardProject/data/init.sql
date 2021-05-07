-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.22 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for webdevserver
CREATE DATABASE IF NOT EXISTS `webdevserver` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `webdevserver`;

-- Dumping structure for table webdevserver.books
CREATE TABLE IF NOT EXISTS `books` (
  `bookID` int unsigned NOT NULL AUTO_INCREMENT,
  `bookTitle` varchar(40) NOT NULL,
  `authorName` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `genre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `publicationDate` timestamp NULL DEFAULT NULL,
  `ageClassification` int DEFAULT NULL,
  `bookLanguage` varchar(30) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table webdevserver.books: ~9 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`bookID`, `bookTitle`, `authorName`, `price`, `genre`, `publicationDate`, `ageClassification`, `bookLanguage`, `date`) VALUES
	(2, 'Rapture', 'Carol Ann Duffy', 9.99, 'Romance', '2005-03-15 23:04:09', 12, 'English', '2021-04-07 23:08:05'),
	(3, 'Tenth of December', 'George Saunders', 14.99, 'Crime', '2013-02-15 23:04:09', 10, 'English', '2021-04-07 23:09:59'),
	(4, 'Wolf Hall', 'Hilary Mantel', 15.99, 'Adventure', '2009-03-15 23:04:09', 8, 'English', '2021-04-08 00:27:07'),
	(5, 'Life After Life', 'Kate Atkinson', 13.5, 'Adventure', '2013-04-21 00:26:13', NULL, 'English', '2021-04-08 00:27:07'),
	(6, 'The Road', 'Cormac McCarthy', 7.49, 'Adventure', '2006-04-15 23:04:09', 12, 'English', '2021-04-08 00:29:42'),
	(7, 'The Sixth Extinction', 'Elizabeth Kolbert', 12.33, 'Crime', '2014-02-15 23:04:09', NULL, 'English', '2021-04-08 00:29:56'),
	(8, 'Autumn', 'Ali Smith', 20.5, 'Crime', '2020-04-15 23:04:09', 5, 'English', '2021-04-08 00:37:21'),
	(9, 'Between the World and Me', 'Ta-Nehisi Coates', 12.33, 'Crime', '2015-04-15 23:04:09', 18, 'English', '2021-04-08 12:38:12'),
	(10, 'The Amber Spyglass', 'Philip Pullman', 16.45, 'Adventure', '2000-03-15 23:04:09', 5, 'English', '2021-04-08 12:38:32'),
	(11, 'Austerlitz', 'WG Sebald', 12.33, 'Adventure', '2001-03-15 23:04:09', NULL, 'French', '2021-04-08 12:38:46'),
	(12, 'Normal People', 'Sally Rooney', 16.99, 'Adventure', '2018-02-15 23:04:09', 8, 'English', '2021-04-08 19:41:04'),
	(13, 'Never Let Me Go', 'Kazuo Ishiguro', 10.99, 'Adventure', '2005-06-15 23:04:09', 12, 'English', '2021-04-08 21:20:31');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table webdevserver.users
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int unsigned NOT NULL AUTO_INCREMENT,
  `firstname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `age` int DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table webdevserver.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userID`, `firstname`, `lastname`, `username`, `email`, `password`, `age`, `location`, `date`) VALUES
	(2, 'Maria', 'Johnson', 'mjohnson', 'maria@gmail.com', 'maria1234', 21, 'Dublin', '2020-04-22 21:02:18'),
	(4, '', '', 'admin', '', 'admin1234', NULL, NULL, NULL),
	(11, 'Eduard', 'Iacob', 'eiacob', 'iacobed2001@gmail.com', 'eduard', 26, 'Dublin', '2021-04-21 21:34:09'),
	(39, 'Anabelle', 'Jamil', 'annaj', 'anna@gmail.com', 'anna1234', 1, '', '2021-04-25 14:27:54'),
	(40, 'Cristian', 'Partac', 'cristip', 'cristi@gmail.com', 'cristi1234', 20, 'Cork', '2021-04-25 14:47:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
