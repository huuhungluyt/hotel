-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cn_web
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB-

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `username` varchar(32) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `fullName` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin','827ccb0eea8a706c4c34a16891f84e7b','<script>alert(document.cookies)</script>');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `room_id` varchar(4) DEFAULT NULL,
  `bookTime` datetime NOT NULL,
  `beginTime` datetime NOT NULL,
  `endTime` datetime DEFAULT NULL,
  `type` enum('2h','overnight','24h') DEFAULT '2h',
  `fee` int(11) DEFAULT NULL,
  `state` enum('booked','checked in','checked out') DEFAULT 'booked',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_acc` (`id`),
  CONSTRAINT `book_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (16,4,'0201','2017-05-10 07:00:00','2017-05-12 07:00:00',NULL,'24h',NULL,'checked in'),(17,5,'0303','2017-05-10 07:00:00','2017-05-12 07:00:00',NULL,'24h',NULL,'booked'),(18,5,'0204','2017-05-10 07:00:00','2017-05-08 07:00:00','2017-05-10 05:00:00','24h',1000,'checked out'),(19,5,'0206','2017-05-10 07:00:00','2017-05-08 07:00:00',NULL,'2h',NULL,'checked out'),(20,1,'0101','2017-05-12 07:00:00','2017-05-20 07:00:00',NULL,'24h',NULL,'booked');
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `id` varchar(4) NOT NULL,
  `type` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`type`) REFERENCES `room_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES ('0102','double'),('0110','double'),('0301','double'),('0302','double'),('0303','double'),('0304','double'),('1010','double'),('fdsa','double'),('0210','double-vip'),('0305','double-vip'),('0401','double-vip'),('0402','double-vip'),('0403','double-vip'),('0404','double-vip'),('0101','single'),('0103','single'),('0104','single'),('0105','single'),('0106','single'),('0201','single-vip'),('0202','single-vip'),('0203','single-vip'),('0204','single-vip'),('0205','single-vip'),('0206','single-vip'),('1234','single-vip');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_type` (
  `type` varchar(16) NOT NULL,
  `2h_price` int(11) DEFAULT NULL,
  `overnight_price` int(11) DEFAULT NULL,
  `24h_price` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_type`
--

LOCK TABLES `room_type` WRITE;
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
INSERT INTO `room_type` VALUES ('double',200,500,700,100),('double-vip',300,600,900,150),('single',100,300,500,30),('single-vip',200,400,600,50);
/*!40000 ALTER TABLE `room_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_acc`
--

DROP TABLE IF EXISTS `user_acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_acc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `fullName` varchar(64) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT 'other',
  `dateOfBirth` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_acc`
--

LOCK TABLES `user_acc` WRITE;
/*!40000 ALTER TABLE `user_acc` DISABLE KEYS */;
INSERT INTO `user_acc` VALUES (1,'user1','827ccb0eea8a706c4c34a16891f84e7b','Nguyen Huu Hung','male','1995-09-09'),(4,'user4','827ccb0eea8a706c4c34a16891f84e7b','Nguyen Van Hung','other','1996-09-09'),(5,'user5','827ccb0eea8a706c4c34a16891f84e7b','Nguyen Huu User','other','1995-09-10'),(6,'user6','827ccb0eea8a706c4c34a16891f84e7b','Nguyen Thi B','female','1995-10-10'),(7,'user7','827ccb0eea8a706c4c34a16891f84e7b','Nguyen Van C','male','1995-09-09'),(8,'user8','827ccb0eea8a706c4c34a16891f84e7b','Nguyen Thi D','male','1995-08-08'),(10,'user9','827ccb0eea8a706c4c34a16891f84e7b','Le Van Luyen','male','1995-09-09');
/*!40000 ALTER TABLE `user_acc` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-12 11:17:16
