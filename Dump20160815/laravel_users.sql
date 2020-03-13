-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravel
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatarPath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Tobias','Brandy','tobiasbrandy@hotmail.com','$2y$10$l8xVJcZ.tByx/5Oj7JPPxefnKPUUpoX5QNRq6qRTdB6sahkuLzsUS','default.jpg','sTLToQDfW2NscaPfmI2itkvU8t4NkR951u63AYm1I5sKedc338NnP6zMIKyC','2016-08-11 01:03:06','2016-08-15 01:07:51'),(2,'Pablo','Smolkin','pablosmolkin@gmail.com','$2y$10$z4xscQf3cQgD2pmAwK9hKeSj1LwhnD5SJlCaQ8PnKOVIl.KzIZWku','1470881987Penguins.jpg','Lya7jTll22oqEZ5rB0AHH1i2bsh3g1ybXePySYRSLiaCqfZHBs7IEaRkbDgN','2016-08-11 01:03:24','2016-08-16 04:07:37'),(3,'Camila','Ahuat','camilaahuat@gmail.com','$2y$10$.v2VPuRdEIe8lrjvfIZH1OSnDxZ6vKYXn9qyP5yFJTVYPlImGtvpa','default.jpg','FabdMGwGMYnAv7cO6zdixLeEeYUy20prhOddbO1tlci6RP8kyg4p3RBDAdYf','2016-08-11 01:03:53','2016-08-16 03:59:40'),(4,'Nick','Damico','nickdamico@gmail.com','$2y$10$9JP.Z2DFVrKqOU2gYtni.eksN5t1pgyNJ8/frdWwg3SpZiJqrjola','default.jpg','7MIm5nZUhw10trVwskMVdG93wRTLZ2xHQPwLzvt4csPuHhFKyEYEGm3s6Uok','2016-08-11 01:04:22','2016-08-16 04:16:33'),(5,'Dario','Susinsky','darosus@gmail.com','$2y$10$MD9UChWxGUf0L/cPT9zXHOlfl3YkbBZYTQxHlBYZz.4EH.E9zq9FS','default.jpg','NdpCBT4LrP9a6gzLphHerhfGAktMkf4cvfD8zZFaVz5SOp8kgHBFynaKdmH5','2016-08-11 01:04:42','2016-08-16 04:28:57'),(6,'Malena','Brandy','malebrandy@gmail.com','$2y$10$1quiyHPdFJ5FRWw/VxxJPuIAcK7EHTVXJh.J16JSCJnPEjs4qQ992','1471293152Jellyfish.jpg','uXJGevtIOsIPkcMXoNM3OtZYJYxwsswBtA37OPGrqpE5B7s3OoMUZL8egzeF','2016-08-11 01:05:00','2016-08-16 04:35:28'),(7,'Gerardo','Brandy','gb@nippurmedia.com','$2y$10$broEBwUb/7eu1jyFr1XXDOIEoV6n7lXEPUp6F47Ah8a6Ljnz8oeuC','default.jpg','hwRGFfgoGIC5immgQto4D2EF0roIMvjZlwOmoAY9YGLXEDAwCUoSKMvZpAsK','2016-08-11 01:05:30','2016-08-16 03:42:07');
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

-- Dump completed on 2016-08-15 22:51:33
