-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: lepaule
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.19.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admins` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `createur_details`
--

DROP TABLE IF EXISTS `createur_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `createur_details` (
  `users_id` int NOT NULL,
  `sub_id` int NOT NULL,
  KEY `users_id` (`users_id`),
  KEY `sub_id` (`sub_id`),
  CONSTRAINT `createur_details_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  CONSTRAINT `createur_details_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subs` (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `createur_details`
--

LOCK TABLES `createur_details` WRITE;
/*!40000 ALTER TABLE `createur_details` DISABLE KEYS */;
INSERT INTO `createur_details` VALUES (11,42),(18,43),(11,42);
/*!40000 ALTER TABLE `createur_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dislikes`
--

DROP TABLE IF EXISTS `dislikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dislikes` (
  `like_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `users_id` int DEFAULT NULL,
  PRIMARY KEY (`like_id`),
  KEY `post_id` (`post_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `dislikes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  CONSTRAINT `dislikes_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dislikes`
--

LOCK TABLES `dislikes` WRITE;
/*!40000 ALTER TABLE `dislikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `dislikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `like_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `users_id` int DEFAULT NULL,
  PRIMARY KEY (`like_id`),
  KEY `post_id` (`post_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `mature_content` tinyint(1) NOT NULL,
  `nbr_upvotes` int NOT NULL DEFAULT '0',
  `nbr_downvotes` int NOT NULL DEFAULT '0',
  `nbr_reports` int NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_title` (`post_title`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (39,'Projet Réseau','test',0,0,0,0,'Présentation orale du Projet réseau'),(40,'ubuntu','pa92i',0,0,0,0,'nouvelle version de ubuntu !!'),(41,'[balade en Vélo] le 20 juin','test',0,0,0,0,'je vous propose de nous retrouver me 20 juin pour une balade !');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_details`
--

DROP TABLE IF EXISTS `posts_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_details` (
  `post_id` int NOT NULL,
  `sub_id` int NOT NULL,
  `users_id` int NOT NULL,
  KEY `users_id` (`users_id`),
  KEY `post_id` (`post_id`),
  KEY `sub_id` (`sub_id`),
  CONSTRAINT `posts_details_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  CONSTRAINT `posts_details_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  CONSTRAINT `posts_details_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `subs` (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_details`
--

LOCK TABLES `posts_details` WRITE;
/*!40000 ALTER TABLE `posts_details` DISABLE KEYS */;
INSERT INTO `posts_details` VALUES (39,42,11),(40,43,18),(41,44,11);
/*!40000 ALTER TABLE `posts_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `desc` varchar(250) NOT NULL,
  `sub_id` int NOT NULL,
  `username_report` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  UNIQUE KEY `username_report` (`username_report`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subs`
--

DROP TABLE IF EXISTS `subs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subs` (
  `sub_id` int NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(50) NOT NULL,
  `nbr_users` int NOT NULL DEFAULT '0',
  `nbr_reports` int NOT NULL DEFAULT '0',
  `description_sub` varchar(255) DEFAULT NULL,
  `createur` varchar(50) NOT NULL,
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `sub_name` (`sub_name`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subs`
--

LOCK TABLES `subs` WRITE;
/*!40000 ALTER TABLE `subs` DISABLE KEYS */;
INSERT INTO `subs` VALUES (42,'Ynov',0,0,'école Ynov bordeaux','test'),(43,'Unix',0,0,'on parle de linux souvent','pa92i'),(44,'vélo',0,0,'ici on parle de chaîne ','test');
/*!40000 ALTER TABLE `subs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subs_details`
--

DROP TABLE IF EXISTS `subs_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subs_details` (
  `users_id` int NOT NULL,
  `sub_id` int NOT NULL,
  `is_modo` tinyint(1) NOT NULL DEFAULT '0',
  KEY `users_id` (`users_id`),
  KEY `sub_id` (`sub_id`),
  CONSTRAINT `subs_details_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  CONSTRAINT `subs_details_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subs` (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subs_details`
--

LOCK TABLES `subs_details` WRITE;
/*!40000 ALTER TABLE `subs_details` DISABLE KEYS */;
INSERT INTO `subs_details` VALUES (11,42,0),(18,42,0),(18,42,0);
/*!40000 ALTER TABLE `subs_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `totp`
--

DROP TABLE IF EXISTS `totp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `totp` (
  `token_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `token` varchar(4) DEFAULT '0',
  PRIMARY KEY (`token_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `totp`
--

LOCK TABLES `totp` WRITE;
/*!40000 ALTER TABLE `totp` DISABLE KEYS */;
INSERT INTO `totp` VALUES (20,'polo@polo.com','0');
/*!40000 ALTER TABLE `totp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `users_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `money` int NOT NULL,
  `is_warned` int DEFAULT NULL,
  `is_muted` int DEFAULT NULL,
  `is_banned` int DEFAULT NULL,
  `is_totp` varchar(3) DEFAULT NULL,
  `birthdate` datetime NOT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'test','098f6bcd4621d373cade4e832627b4f6','test@test.com',0,NULL,NULL,NULL,'non','8201-02-08 00:00:00'),(12,'paul','098f6bcd4621d373cade4e832627b4f6','paul@paul.com',0,NULL,NULL,NULL,'non','2001-02-08 00:00:00'),(13,'test1','098f6bcd4621d373cade4e832627b4f6','test1@test.com',0,NULL,NULL,NULL,'non','0221-02-08 00:00:00'),(14,'aze','098f6bcd4621d373cade4e832627b4f6','aze@aez.com',0,NULL,NULL,NULL,'non','0808-08-08 00:00:00'),(15,'pa','098f6bcd4621d373cade4e832627b4f6','pa@pa.com',0,NULL,NULL,NULL,'non','0808-08-08 00:00:00'),(16,'sauvage','098f6bcd4621d373cade4e832627b4f6','malgache@gmail.com',0,NULL,NULL,NULL,'non','0808-08-08 00:00:00'),(17,'azeaze','0a5b3913cbc9a9092311630e869b4442','azeaze@aze.com',0,NULL,NULL,NULL,'non','0808-08-08 00:00:00'),(18,'pa92i','098f6bcd4621d373cade4e832627b4f6','po@po.com',0,NULL,NULL,NULL,'non','0808-08-08 00:00:00');
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

-- Dump completed on 2020-06-17 16:02:55
