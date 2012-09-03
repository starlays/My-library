-- MySQL dump 10.13  Distrib 5.5.27, for Linux (x86_64)
--
-- Host: localhost    Database: mylibrary
-- ------------------------------------------------------
-- Server version	5.5.27-log

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
-- Table structure for table `Author`
--

DROP TABLE IF EXISTS `Author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Author` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
INSERT INTO `Author` VALUES (1,'Autor 1'),(2,'Autor 2'),(3,'Autor 3'),(4,'Autor 4');
/*!40000 ALTER TABLE `Author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Books`
--

DROP TABLE IF EXISTS `Books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Books` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` char(20) NOT NULL,
  `id_author` mediumint(9) NOT NULL,
  `description` char(40) NOT NULL,
  `isert_date` date DEFAULT NULL,
  `cvr_img_path` char(50) NOT NULL,
  `e_book_path` char(50) NOT NULL,
  `id_rate` mediumint(9) NOT NULL,
  `id_insert_user` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_rate` (`id_rate`,`id_insert_user`),
  KEY `id_author` (`id_author`),
  KEY `id_insert_user` (`id_insert_user`),
  CONSTRAINT `Books_ibfk_3` FOREIGN KEY (`id_rate`) REFERENCES `Rating` (`id`),
  CONSTRAINT `Books_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `Author` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `Books_ibfk_2` FOREIGN KEY (`id_insert_user`) REFERENCES `Users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Books`
--

LOCK TABLES `Books` WRITE;
/*!40000 ALTER TABLE `Books` DISABLE KEYS */;
INSERT INTO `Books` VALUES (3,'Book 1',2,'test book 1','2012-09-06','/test/path','/test.path',2,3),(4,'Book 2',3,'test book 2','2012-09-12','/test/path','/test/path',3,1);
/*!40000 ALTER TABLE `Books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rating`
--

DROP TABLE IF EXISTS `Rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rating` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `value` char(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rating`
--

LOCK TABLES `Rating` WRITE;
/*!40000 ALTER TABLE `Rating` DISABLE KEYS */;
INSERT INTO `Rating` VALUES (1,'lowest'),(2,'low'),(3,'medium'),(4,'high'),(5,'highest');
/*!40000 ALTER TABLE `Rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rights` (
  `code` tinyint(4) NOT NULL,
  `description` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rights`
--

LOCK TABLES `Rights` WRITE;
/*!40000 ALTER TABLE `Rights` DISABLE KEYS */;
INSERT INTO `Rights` VALUES (1,'read'),(2,'edit'),(4,'write'),(8,'delete');
/*!40000 ALTER TABLE `Rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_book_rating`
--

DROP TABLE IF EXISTS `User_book_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User_book_rating` (
  `id_user` mediumint(9) NOT NULL,
  `id_rate` mediumint(9) NOT NULL,
  `id_book` mediumint(9) NOT NULL,
  KEY `id_user` (`id_user`,`id_rate`,`id_book`),
  KEY `id_book` (`id_book`),
  KEY `id_rate` (`id_rate`),
  CONSTRAINT `User_book_rating_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User_book_rating_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `Books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `User_book_rating_ibfk_2` FOREIGN KEY (`id_rate`) REFERENCES `Rating` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_book_rating`
--

LOCK TABLES `User_book_rating` WRITE;
/*!40000 ALTER TABLE `User_book_rating` DISABLE KEYS */;
INSERT INTO `User_book_rating` VALUES (2,4,3),(2,4,3),(3,3,4),(3,3,4);
/*!40000 ALTER TABLE `User_book_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` char(15) DEFAULT NULL,
  `first_name` char(20) DEFAULT NULL,
  `last_name` char(20) DEFAULT NULL,
  `mail` char(30) DEFAULT NULL,
  `password` char(30) DEFAULT NULL,
  `ban_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'foo',NULL,NULL,NULL,'foobar',0),(2,'bar',NULL,NULL,NULL,'barfoo',0),(3,'baz',NULL,NULL,NULL,'bazfoo',0);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_book_rights`
--

DROP TABLE IF EXISTS `user_book_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_book_rights` (
  `id_user` mediumint(9) NOT NULL,
  `id_book` mediumint(9) NOT NULL,
  `computed_rights` smallint(4) NOT NULL DEFAULT '1',
  KEY `id_user` (`id_user`,`id_book`),
  KEY `id_book` (`id_book`),
  CONSTRAINT `user_book_rights_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_book_rights_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `Books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_book_rights`
--

LOCK TABLES `user_book_rights` WRITE;
/*!40000 ALTER TABLE `user_book_rights` DISABLE KEYS */;
INSERT INTO `user_book_rights` VALUES (1,4,127),(2,3,111),(2,3,1111),(1,4,111);
/*!40000 ALTER TABLE `user_book_rights` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-09-03 21:03:27
