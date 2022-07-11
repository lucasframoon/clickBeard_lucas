-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: sampleDb
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `id_attendance` int NOT NULL AUTO_INCREMENT,
  `id_barber` int NOT NULL,
  `dt_attendance` datetime NOT NULL,
  `id_specialty` int NOT NULL,
  `ck_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_attendance`),
  UNIQUE KEY `attendance_UN` (`id_barber`,`dt_attendance`),
  KEY `attendance_FK` (`id_specialty`),
  CONSTRAINT `attendance_FK` FOREIGN KEY (`id_specialty`) REFERENCES `specialty` (`id_specialty`),
  CONSTRAINT `attendance_FK_1` FOREIGN KEY (`id_barber`) REFERENCES `barber` (`id_barber`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (3,4,'2022-10-07 08:00:00',1,1),(4,4,'2022-10-07 08:30:00',1,1),(7,4,'2022-10-07 09:00:00',2,1),(8,4,'2022-10-07 16:30:00',3,1);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barber`
--

DROP TABLE IF EXISTS `barber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barber` (
  `id_barber` int NOT NULL AUTO_INCREMENT,
  `nm_barber` varchar(45) NOT NULL,
  `dt_birthday` date NOT NULL,
  `dt_contract` date NOT NULL,
  `ds_image_path` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_barber`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barber`
--

LOCK TABLES `barber` WRITE;
/*!40000 ALTER TABLE `barber` DISABLE KEYS */;
INSERT INTO `barber` VALUES (1,'Elena','1994-08-08','2022-06-01','https://semantic-ui.com/images/avatar2/small/lena.png'),(2,'Matheus','1992-05-06','2020-03-20','https://semantic-ui.com/images/avatar2/small/matthew.png'),(3,'João','2000-09-06','2022-06-01','https://semantic-ui.com/images/avatar2/small/elyse.png'),(4,'Marcos','1996-07-28','2021-07-18','https://semantic-ui.com/images/avatar2/small/mark.png'),(5,'Anderson','1999-12-06','2021-11-16','https://semantic-ui.com/images/avatar2/small/patrick.png');
/*!40000 ALTER TABLE `barber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barber_specialty`
--

DROP TABLE IF EXISTS `barber_specialty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barber_specialty` (
  `id_barber` int NOT NULL,
  `id_specialty` int NOT NULL,
  UNIQUE KEY `id_barber_UNIQUE` (`id_barber`,`id_specialty`),
  KEY `id_barber_fk_idx` (`id_barber`),
  KEY `id_speciality_fk_idx` (`id_specialty`),
  CONSTRAINT `id_barber_fk` FOREIGN KEY (`id_barber`) REFERENCES `barber` (`id_barber`),
  CONSTRAINT `id_speciality_fk` FOREIGN KEY (`id_specialty`) REFERENCES `specialty` (`id_specialty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barber_specialty`
--

LOCK TABLES `barber_specialty` WRITE;
/*!40000 ALTER TABLE `barber_specialty` DISABLE KEYS */;
INSERT INTO `barber_specialty` VALUES (1,1),(1,3),(1,4),(2,1),(2,2),(2,3),(3,3),(3,4),(4,1),(4,2),(4,3),(5,1),(5,2),(5,4);
/*!40000 ALTER TABLE `barber_specialty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialty`
--

DROP TABLE IF EXISTS `specialty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specialty` (
  `id_specialty` int NOT NULL AUTO_INCREMENT,
  `nm_specialty` varchar(100) NOT NULL,
  PRIMARY KEY (`id_specialty`),
  UNIQUE KEY `specialty_UN` (`nm_specialty`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialty`
--

LOCK TABLES `specialty` WRITE;
/*!40000 ALTER TABLE `specialty` DISABLE KEYS */;
INSERT INTO `specialty` VALUES (2,'Barba'),(1,'Corte'),(3,'Luzes'),(4,'Sobrancelha');
/*!40000 ALTER TABLE `specialty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(100) NOT NULL,
  `ds_email` varchar(100) NOT NULL,
  `ds_login` varchar(100) NOT NULL,
  `tp_user` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `ds_password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UN` (`ds_email`),
  UNIQUE KEY `login_UN` (`ds_login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin','admin@admin.com','admin','admin','secret'),(3,'user','user@user.com','user','user','secret');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sampleDb'
--

--
-- Dumping routines for database 'sampleDb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-11 19:35:08
