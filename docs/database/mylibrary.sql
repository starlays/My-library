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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Autor 1'),(2,'Autor 2'),(3,'Autor 3'),(4,'Autor 4');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` char(20) NOT NULL,
  `id_author` mediumint(9) NOT NULL,
  `description` char(40) NOT NULL,
  `insert_date` date DEFAULT NULL,
  `cvr_img_path` char(50) NOT NULL,
  `e_book_path` char(50) NOT NULL,
  `id_rate` mediumint(9) NOT NULL,
  `id_insert_user` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_rate` (`id_rate`,`id_insert_user`),
  KEY `id_author` (`id_author`),
  KEY `id_insert_user` (`id_insert_user`),
  CONSTRAINT `books_ibfk_4` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `books_ibfk_2` FOREIGN KEY (`id_rate`) REFERENCES `rating_value` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `books_ibfk_3` FOREIGN KEY (`id_insert_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (4,'Book 2',3,'test book 2','2012-09-12','/test/path','/test/path',3,1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating_value`
--

DROP TABLE IF EXISTS `rating_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating_value` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating_value`
--

LOCK TABLES `rating_value` WRITE;
/*!40000 ALTER TABLE `rating_value` DISABLE KEYS */;
INSERT INTO `rating_value` VALUES (1,1),(2,2),(3,3),(4,4),(5,5);
/*!40000 ALTER TABLE `rating_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_book_rating`
--

DROP TABLE IF EXISTS `user_book_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_book_rating` (
  `id_user` mediumint(9) NOT NULL,
  `id_rate` mediumint(9) NOT NULL,
  `id_book` mediumint(9) NOT NULL,
  KEY `id_user` (`id_user`,`id_rate`,`id_book`),
  KEY `id_book` (`id_book`),
  KEY `id_rate` (`id_rate`),
  CONSTRAINT `user_book_rating_ibfk_2` FOREIGN KEY (`id_rate`) REFERENCES `rating_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_book_rating_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_book_rating`
--

LOCK TABLES `user_book_rating` WRITE;
/*!40000 ALTER TABLE `user_book_rating` DISABLE KEYS */;
INSERT INTO `user_book_rating` VALUES (2,4,3),(2,4,3),(3,3,4),(3,3,4);
/*!40000 ALTER TABLE `user_book_rating` ENABLE KEYS */;
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
  `rights` bit(4) NOT NULL DEFAULT b'1',
  KEY `id_user` (`id_user`,`id_book`),
  KEY `id_book` (`id_book`),
  CONSTRAINT `user_book_rights_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_book_rights_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_book_rights`
--

LOCK TABLES `user_book_rights` WRITE;
/*!40000 ALTER TABLE `user_book_rights` DISABLE KEYS */;
INSERT INTO `user_book_rights` VALUES (1,4,''),(1,4,'');
/*!40000 ALTER TABLE `user_book_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
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
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'foo',NULL,NULL,NULL,'foobar',0),(2,'bar',NULL,NULL,NULL,'barfoo',0),(3,'baz',NULL,NULL,NULL,'bazfoo',0);
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

-- Dump completed on 2012-09-05  0:21:44
