CREATE DATABASE  IF NOT EXISTS `parking` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci */;
USE `parking`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: parking
-- ------------------------------------------------------
-- Server version	5.5.21-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `number_plates`
--

DROP TABLE IF EXISTS `number_plates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `number_plates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `number` varchar(8) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `user_id_i` (`user_id`),
  CONSTRAINT `user_id_f` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `number_plates`
--

LOCK TABLES `number_plates` WRITE;
/*!40000 ALTER TABLE `number_plates` DISABLE KEYS */;
INSERT INTO `number_plates` VALUES (1,6,'RZE5XY78'),(2,6,'RZE251AB'),(3,7,'PRZ123D7'),(4,7,'KIAABCDE'),(17,14,'KLA64YU9'),(18,14,'WE32768A');
/*!40000 ALTER TABLE `number_plates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parkings`
--

DROP TABLE IF EXISTS `parkings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parkings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `image` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parkings`
--

LOCK TABLES `parkings` WRITE;
/*!40000 ALTER TABLE `parkings` DISABLE KEYS */;
INSERT INTO `parkings` VALUES (1,'Galeria Rzeszów','res/images/006302.jpg'),(2,'Rynek','http://www.polskaniezwykla.pl/pictures/original/271379.jpg'),(3,'Podpromie','http://s3.flog.pl/media/foto/677956_hala-podpromie-w-rzeszowie-hdr.jpg'),(4,'Politechnika Rzeszów','http://www.rzeszow4u.pl/upload/Aktualnosci/remont-akademikow-politechniki.jpg');
/*!40000 ALTER TABLE `parkings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` int(11) NOT NULL,
  `id_parking` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `state` int(11) DEFAULT '0',
  `number_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`id_parking`,`user_id`,`number_id`),
  KEY `id_parking_i` (`id_parking`),
  KEY `id_user_i` (`user_id`),
  CONSTRAINT `id_parking_f` FOREIGN KEY (`id_parking`) REFERENCES `parkings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` VALUES (1,1,1,0,1,''),(2,2,1,6,2,'1'),(3,3,1,14,2,'17'),(4,4,1,7,2,'4'),(5,5,1,0,0,'1'),(6,1,2,0,0,''),(7,2,2,0,0,'1'),(8,3,2,0,1,''),(9,4,2,0,0,''),(10,1,3,0,0,''),(11,2,3,0,0,'1'),(12,3,3,0,0,'17'),(13,1,4,0,1,''),(14,2,4,0,1,''),(15,3,4,0,0,''),(16,4,4,0,0,''),(17,5,4,0,0,''),(18,6,4,0,1,''),(19,7,4,0,0,''),(20,8,4,0,1,''),(21,9,4,0,0,'1'),(22,10,4,0,1,'');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places_history`
--

DROP TABLE IF EXISTS `places_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `places_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `id_place` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `state` int(11) DEFAULT '0',
  `number_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_user`,`id_place`,`number_id`),
  KEY `id_place_i` (`id_place`),
  KEY `id_user_i` (`id_user`),
  KEY `number_id_i` (`number_id`),
  CONSTRAINT `id_place_f` FOREIGN KEY (`id_place`) REFERENCES `places` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_user_f` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `number_id` FOREIGN KEY (`number_id`) REFERENCES `number_plates` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 PACK_KEYS=1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places_history`
--

LOCK TABLES `places_history` WRITE;
/*!40000 ALTER TABLE `places_history` DISABLE KEYS */;
INSERT INTO `places_history` VALUES (1,'2015-06-10 10:58:24','2015-06-10 10:58:54',2,14,0,1),(2,'2015-06-10 11:34:06','2015-06-10 11:34:36',4,7,0,4),(3,'2015-06-10 11:42:32','2015-06-10 11:43:02',11,6,0,1),(4,'2015-06-10 11:42:46','2015-06-10 11:43:16',21,6,0,1),(5,'2015-06-10 11:43:04','2015-06-10 11:43:34',5,6,0,1),(6,'2015-06-10 11:47:45','2015-06-10 11:48:15',7,6,0,1),(7,'2015-06-10 11:50:49','2015-06-10 11:51:19',2,6,0,1),(8,'2015-06-10 21:36:59','2015-06-10 09:37:29',3,14,0,1),(9,'2015-06-10 21:37:46','2015-06-10 09:38:16',3,14,0,1),(10,'2015-06-10 21:38:07','2015-06-10 09:38:37',3,14,0,1),(11,'2015-06-10 21:38:15','2015-06-10 09:38:45',3,14,0,1),(12,'2015-06-10 21:45:00','2015-06-10 09:45:30',3,14,0,1),(13,'2015-06-10 21:48:02','2015-06-10 09:48:32',3,14,0,17),(14,'2015-06-10 21:48:18','2015-06-10 09:48:48',3,14,0,18),(15,'2015-06-10 21:52:01','2015-06-10 09:52:31',3,14,0,17),(16,'2015-06-10 21:54:47','2015-06-10 09:55:17',3,14,0,18),(17,'2015-06-10 21:54:50','2015-06-10 09:55:20',3,14,0,17),(18,'2015-06-10 21:56:02','2015-06-10 09:56:32',12,14,0,17);
/*!40000 ALTER TABLE `places_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `reset_pass` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'nanotest321@gmail.com','b31ef2c556479f501b02ccd23fc3d088267dc236',''),(7,'dawid.wilu@gmail.com','53649f6e45138ef119c955d04bf042562f6e2946',NULL),(8,'user@nanomatic.pl','45f106ef4d5161e7aa38cf6c666607f25748b6ca',NULL),(14,'admin@nanomatic.pl','74913f5cd5f61ec0bcfdb775414c2fb3d161b620',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-10 22:07:45
