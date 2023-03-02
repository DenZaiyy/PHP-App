-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour store
CREATE DATABASE IF NOT EXISTS `store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `store`;

-- Listage de la structure de table store. product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table store.product : ~4 rows (environ)
INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
	(1, 'iPhone', 'The iPhone is a series of smartphones made by Apple Inc since 2007. It is a mobile phone, meaning that it makes calls and sends text messages without wires. There are many types of iPhones, such as the main models and others, such as the mini or pro editions.', 750),
	(2, 'Computer', 'A computer is a machine that uses electronics to input, process, store, and output data. Data is information such as numbers, words, and lists. Input of data means to read information from a keyboard, a storage device like a hard drive, or a sensor. The computer processes or changes the data by following the instructions in software programs. A computer program is a list of instructions the computer has to perform. Programs usually perform mathematical calculations, modify data, or move it around. The data is then saved on a storage device, shown on a display, or sent to another computer. Computers can be connected together to form a network such as the internet, allowing the computers to communicate with each other.', 1250),
	(3, 'Tablet', 'A tablet computer (sometimes called a tablet) is a type of computer that can be carried easily. Unlike a laptop it has no physical keyboard or trackpad, though users sometimes add those things. Users control a tablet mostly by using its touchscreen with multi-touch technology similar to a smartphone. The screen can be anywhere from 7 inches (18 cm) (sometimes called a phablet) to 12 inches (30 cm) in size, but many have a screen size of about 10 inches (25 cm) diagonal.', 500),
	(4, 'MacBook Air 2017', 'The MacBook Air is a kind of Macintosh laptop computer designed by Apple, known as the "world\'s thinnest notebook." It is positioned as the most portable in Apple\'s MacBook family and was introduced at the Macworld Conference & Expo on January 15, 2008. The MacBook Air was the first laptop to implement Apple\'s precision aluminum unibody enclosure.', 350);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
