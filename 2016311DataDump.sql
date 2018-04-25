-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for library
CREATE DATABASE IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `library`;

-- Dumping structure for table library.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(25) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table library.books: ~5 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `Title`, `Author`, `ISBN`, `Quantity`) VALUES
	(1, 'Generation X', 'Douglas Coupland', '349108390', 5),
	(2, 'Introducing HTML5', 'Remy Sharp', '321687299', 3),
	(3, 'Handcrafted CSS', 'Dan Cederholm', '321643380', 14),
	(4, 'Bulletproof Webdesign', 'Dan Cederholm', '321509021', 0),
	(5, 'The Tipping Point', 'Malcolm Gladwell', '349113467', 8);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table library.checked_by
CREATE TABLE IF NOT EXISTS `checked_by` (
  `bookid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `checkDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dueDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `studentkey` (`studentid`),
  KEY `bookkey` (`bookid`),
  CONSTRAINT `bookkey` FOREIGN KEY (`bookid`) REFERENCES `books` (`id`),
  CONSTRAINT `studentkey` FOREIGN KEY (`studentid`) REFERENCES `users` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table library.checked_by: ~0 rows (approximately)
/*!40000 ALTER TABLE `checked_by` DISABLE KEYS */;
INSERT INTO `checked_by` (`bookid`, `studentid`, `checkDate`, `dueDate`) VALUES
	(3, 2016311, '2017-12-23 00:24:15', '2017-12-30 00:24:15'),
	(1, 2016311, '2017-12-23 00:24:19', '2017-12-30 00:24:19'),
	(4, 2016311, '2017-12-23 00:24:21', '2017-12-30 00:24:21'),
	(3, 2017334, '2017-12-23 00:24:34', '2017-12-30 00:24:34'),
	(2, 2017334, '2017-12-23 00:24:38', '2017-12-30 00:24:38'),
	(4, 2017889, '2017-12-23 00:25:00', '2017-12-30 00:25:00'),
	(2, 2017889, '2017-12-23 00:25:05', '2017-12-30 00:25:05'),
	(1, 2016446, '2017-12-23 00:25:25', '2017-12-30 00:25:25'),
	(2, 2016446, '2017-12-23 00:25:28', '2017-12-30 00:25:28'),
	(3, 2016446, '2017-12-23 00:25:32', '2017-12-30 00:25:32'),
	(4, 2016446, '2017-12-23 00:25:35', '2017-12-30 00:25:35');
/*!40000 ALTER TABLE `checked_by` ENABLE KEYS */;

-- Dumping structure for table library.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(25) NOT NULL,
  `student_id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table library.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`username`, `student_id`, `password`) VALUES
	('miguelsansigolo', 2016311, 'f355de37b9fe3e648ca7435ad3c56f31'),
	('TiagoCarmona', 2016446, 'f355de37b9fe3e648ca7435ad3c56f31'),
	('RaquelCarvalho', 2017334, '16af9486876bc313d27bac33d9ca1e19'),
	('LuigiFortunato', 2017889, 'dc9dde252c72907abac16015df1ff112'),
	('miguelmota', 2018311, 'f355de37b9fe3e648ca7435ad3c56f31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
