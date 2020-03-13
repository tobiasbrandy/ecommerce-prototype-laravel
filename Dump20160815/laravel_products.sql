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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `ageMin` int(11) NOT NULL,
  `ageMax` int(11) NOT NULL,
  `condition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `productAvatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'Batman Forever',456,10,50,'new',39,12,'1471109347Lighthouse.jpg','hola como va me llamo batman.',1,'2016-08-13 20:29:07','2016-08-15 00:12:14'),(4,'Robin Forever',456,10,50,'new',18,12,'1471109378Hydrangeas.jpg','Hola me llamo Robin.',1,'2016-08-13 20:29:38','2016-08-15 23:35:55'),(5,'Pulp Fiction',675,16,70,'new',29,12,'1471183390Koala.jpg','Una muy buena pelicula de Quentin Tarantino.',1,'2016-08-14 17:03:10','2016-08-15 00:56:44'),(6,'Uncharted 1',675,10,50,'used',18,11,'1471183474Lighthouse.jpg','El primer juego de la excelente trilogía de Nathan Drake.',1,'2016-08-14 17:04:34','2016-08-15 00:12:14'),(7,'Uncharted 2',587,10,50,'new',25,11,'1471183508Chrysanthemum.jpg','El segundo juego de la excelente trilogía de Nathan Drake.',1,'2016-08-14 17:05:08','2016-08-15 23:35:55'),(8,'Uncharted 4',857,10,40,'new',19,11,'1471183566Desert.jpg','El cuarto juego de la excelente trilogía de Nathan Drake.',1,'2016-08-14 17:06:06','2016-08-15 23:35:54'),(9,'El Nombre del Viento',576,10,50,'new',39,10,'1471183662Penguins.jpg','El primer libro de la genial saga de Pat Rothfuss.',1,'2016-08-14 17:07:42','2016-08-15 23:35:55'),(10,'El Temor de un Hombre Sabio',587,10,50,'new',19,10,'1471183705Koala.jpg','El segundo libro de la genial saga.',1,'2016-08-14 17:08:25','2016-08-15 00:12:14'),(11,'Discovery - Daft Punk',746,16,70,'new',0,13,'1471186441Tulips.jpg','Esto es una prueba para el stock.',2,'2016-08-14 17:54:01','2016-08-14 18:04:21'),(15,'Pelota de Futbol',7564,10,60,'new',40,2,'1471307651Tulips.jpg','Pelota de Futbol en excelente estado.',7,'2016-08-16 03:34:11','2016-08-16 03:34:11'),(16,'Mesada de Marmol para Cocina',4856,30,70,'new',20,15,'1471307739Chrysanthemum.jpg','Mesada par cocina en perfecto estado.',7,'2016-08-16 03:35:39','2016-08-16 03:35:39'),(17,'Nintendo wii u',879,5,40,'new',7,8,'1471307796Desert.jpg','La ultima consola de Nintendo.',7,'2016-08-16 03:36:36','2016-08-16 03:36:36'),(18,'The Wall - Pink Floyd',684,16,70,'used',1,13,'1471308048Hydrangeas.jpg','Reventa del clasico disco en perfectas condiciones.',7,'2016-08-16 03:40:48','2016-08-16 03:40:48'),(19,'Television',3000,20,100,'used',1,6,'1471308765Chrysanthemum.jpg','Televisión 32 pulgadas en perfecto estado',3,'2016-08-16 03:52:45','2016-08-16 03:52:45'),(20,'Remera de futbol',500,10,15,'new',4,2,'1471308900Penguins.jpg','Lindas remeras para menores',3,'2016-08-16 03:55:00','2016-08-16 03:55:00'),(21,'Gameboy',2000,12,25,'new',1,8,'1471308977Tulips.jpg','Gameboy coleccionable',3,'2016-08-16 03:56:17','2016-08-16 04:36:17'),(22,'Sillon',2000,20,100,'new',20,16,'1471309130Hydrangeas.jpg','Adorables sillones de pana negra',3,'2016-08-16 03:58:50','2016-08-16 03:58:50'),(23,'Sillas',1200,25,100,'new',40,17,'1471309348Desert.jpg','Sillas de todos los colores',2,'2016-08-16 04:02:28','2016-08-16 04:02:28'),(24,'Zapatillas de basket',950,25,30,'used',1,3,'1471309472Jellyfish.jpg','zapatillas con 2 meses de uso',2,'2016-08-16 04:04:32','2016-08-16 04:04:32'),(25,'Parlante',1467,18,60,'new',4,7,'1471309592Lighthouse.jpg','Parlantes color rojo',2,'2016-08-16 04:06:32','2016-08-16 04:06:32'),(26,'Mesa de Cocina',4000,20,100,'new',10,15,'1471309829Penguins.jpg','Mesa de roble ',4,'2016-08-16 04:10:29','2016-08-16 04:10:29'),(27,'Pelota de volley',300,12,50,'new',5,4,'1471309939Koala.jpg','Pelotas blancas',4,'2016-08-16 04:12:19','2016-08-16 04:12:19'),(28,'Teclado',600,10,100,'used',1,6,'1471310028Hydrangeas.jpg','Teclado en perfecto estado',4,'2016-08-16 04:13:48','2016-08-16 04:13:48'),(29,'Cd',1000,13,70,'used',1,13,'1471310186Koala.jpg','Cd original de los Beatles',4,'2016-08-16 04:16:26','2016-08-16 04:16:26'),(30,'Cama',2300,16,60,'new',23,18,'1471310683Penguins.jpg','Cama queen size',5,'2016-08-16 04:24:43','2016-08-16 04:24:43'),(31,'Medias de futbol',300,10,20,'new',8,2,'1471310731Desert.jpg','Medias en todos los talles',5,'2016-08-16 04:25:31','2016-08-16 04:25:31'),(32,'Película El Gran Pez',80,13,80,'new',12,12,'1471310830Tulips.jpg','Pelicula subtitulada al castellano',5,'2016-08-16 04:27:10','2016-08-16 04:27:10'),(33,'Headphones',2000,15,40,'new',4,7,'1471310929Lighthouse.jpg','Auriculares Bose ',5,'2016-08-16 04:28:49','2016-08-16 04:28:49'),(34,'Mario Kart 8',600,10,50,'new',8,11,'1471311059Desert.jpg','Mario Kart 8 para PLAYSTATION 4',6,'2016-08-16 04:30:59','2016-08-16 04:30:59'),(35,'XBOX 360',3000,12,40,'used',1,8,'1471311164Chrysanthemum.jpg','Xbox con 8 meses de uso',6,'2016-08-16 04:32:44','2016-08-16 04:32:44'),(36,'Escritorio',1500,10,100,'new',6,18,'1471311230Koala.jpg','Escritorio para todas las edades',6,'2016-08-16 04:33:50','2016-08-16 04:33:50'),(37,'Shorts de futbol',300,15,40,'new',9,2,'1471311316Penguins.jpg','Todos los colores',6,'2016-08-16 04:35:16','2016-08-16 04:35:16');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
