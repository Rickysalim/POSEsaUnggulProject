-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: fakekopi_db
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `bahan_baku`
--

DROP TABLE IF EXISTS `bahan_baku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahan_baku` (
  `nama_bahan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_bahan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `satuan_bahan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pemakaian` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`nama_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_baku`
--

LOCK TABLES `bahan_baku` WRITE;
/*!40000 ALTER TABLE `bahan_baku` DISABLE KEYS */;
INSERT INTO `bahan_baku` VALUES ('Bubuk Kopi','800','gram',10),('Bubuk Macha','800','gram',10),('Gula','1000','gram',10),('Susu','1000','Mili',10);
/*!40000 ALTER TABLE `bahan_baku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_pemesan` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_pemesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_pesanan` int NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `order_FK` (`nama_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'Kopi','RICKYSALIM','2023-07-06 12:41:09',2),(2,'Kentang','JUNIUS ','2023-07-06 14:21:23',1),(3,'Kopi','JUNIUS ','2023-07-08 03:15:58',3),(4,'Susu','RICKYSALIM','2023-07-14 12:35:09',1),(5,'Kentang Goreng','JUNIUS ','2023-07-14 15:04:59',5),(6,'Teh Macha Manis','JUNIUS ','2023-07-14 15:04:59',1),(7,'Kentang Goreng','RICKYSALIM','2023-07-14 15:06:45',5),(8,'Teh Macha Manis','RICKYSALIM','2023-07-14 15:06:45',1),(9,'Kentang Goreng','JUNIUS ','2023-07-14 15:08:18',2),(10,'Kentang Goreng','JUNIUS ','2023-07-14 15:11:23',1),(11,'Teh Macha Manis','JUNIUS ','2023-07-14 15:11:23',1),(12,'Kentang Goreng','JUNIUS ','2023-07-14 15:16:43',2),(13,'Teh Macha Manis','JUNIUS ','2023-07-14 15:16:43',1),(16,'Kentang Goreng','JUNIUS ','2023-07-14 15:21:23',2),(17,'Kopi','JUNIUS ','2023-07-14 15:21:23',1),(18,'Kentang Goreng','RICKYSALIM','2023-07-14 15:25:02',5),(19,'Kopi','RICKYSALIM','2023-07-14 15:25:02',1),(20,'Kentang Goreng','RICKYSALIM','2023-07-14 15:27:01',5),(21,'Kopi','RICKYSALIM','2023-07-14 15:27:01',1),(22,'Kentang Goreng','RICKYSALIM','2023-07-14 15:33:32',5),(23,'Kopi','RICKYSALIM','2023-07-14 15:33:32',1),(24,'Kentang Goreng','JUNIUS ','2023-07-14 15:34:21',3),(25,'Kentang Goreng','RICKYSALIM','2023-07-14 15:36:05',3),(26,'Kopi','RICKYSALIM','2023-07-14 15:36:05',1),(27,'Kentang Goreng','RICKYSALIM','2023-07-14 15:36:29',2),(28,'Kopi','RICKYSALIM','2023-07-14 15:36:29',1),(35,'Kentang Goreng','JUNIUS ','2023-07-14 23:52:28',2),(36,'Kopi','JUNIUS ','2023-07-14 23:52:28',1),(37,'Kentang Goreng','JUNIUS ','2023-07-14 23:53:55',5),(38,'Teh Macha Manis','JUNIUS ','2023-07-14 23:53:55',1),(39,'Kopi','JUNIUS ','2023-07-14 23:57:53',1),(40,'Kentang Goreng','JUNIUS ','2023-07-14 23:57:53',3),(41,'Kopi','RICKYSALIM','2023-07-15 00:00:35',1),(42,'Kentang Goreng','RICKYSALIM','2023-07-15 00:00:35',2),(43,'Kopi','JUNIUS ','2023-07-15 00:00:58',1),(44,'Kentang Goreng','JUNIUS ','2023-07-15 00:00:58',2),(45,'Kopi','Ricky Salim','2023-07-15 00:02:36',1),(46,'Kentang Goreng','Ricky Salim','2023-07-15 00:02:36',2),(47,'Kopi','Ricky Salim','2023-07-15 00:03:07',1),(48,'Kentang Goreng','Ricky Salim','2023-07-15 00:03:07',2),(49,'Kopi','Ricky Salim','2023-07-15 00:05:17',1),(50,'Kentang Goreng','Ricky Salim','2023-07-15 00:05:17',2),(51,'Kopi','Ricky Salim','2023-07-15 00:07:00',1),(52,'Kentang Goreng','Ricky Salim','2023-07-15 00:07:00',2),(53,'Kopi','Ricky Salim','2023-07-15 00:07:27',1),(54,'Kentang Goreng','Ricky Salim','2023-07-15 00:07:27',2),(55,'Kopi','Ricky Salim','2023-07-15 00:09:25',1),(56,'Kentang Goreng','Ricky Salim','2023-07-15 00:09:25',2),(57,'Kentang Goreng','RICKYSALIM','2023-07-15 00:14:05',1),(58,'Kopi','RICKYSALIM','2023-07-15 00:14:05',1),(59,'Kentang Goreng','RICKYSALIM','2023-07-15 00:14:23',1),(60,'Kopi','RICKYSALIM','2023-07-15 00:14:23',1),(61,'Kentang Goreng','JUNIUS ','2023-07-15 00:19:19',1),(62,'Kopi','JUNIUS ','2023-07-15 00:19:19',1),(63,'Teh Macha','JUNIUS ','2023-07-15 00:19:48',1),(64,'Kentang Goreng','JUNIUS ','2023-07-15 00:19:48',1),(65,'Kentang Goreng','JUNIUS ','2023-07-15 00:20:20',2),(66,'Teh Macha','JUNIUS ','2023-07-15 00:20:20',1),(67,'Kentang Goreng','JUNIUS ','2023-07-15 00:21:43',1),(68,'Kopi','JUNIUS ','2023-07-15 00:21:43',1),(69,'Kopi','JUNIUS ','2023-07-15 00:22:12',1),(70,'Kentang Goreng','JUNIUS ','2023-07-15 00:22:12',2),(71,'Kentang Goreng','JUNIUS ','2023-07-15 00:25:13',1),(72,'Kopi','JUNIUS ','2023-07-15 00:25:13',1),(73,'Kopi','RICKYSALIM','2023-07-15 00:25:35',2),(74,'Kentang Goreng','RICKYSALIM','2023-07-15 00:25:35',1),(75,'Kentang Goreng','RICKYSALIM','2023-07-15 00:30:31',2),(76,'Kopi','RICKYSALIM','2023-07-15 00:30:31',1),(77,'Kentang Goreng','RICKYSALIM','2023-07-15 00:30:51',2),(78,'Kopi','RICKYSALIM','2023-07-15 00:30:51',1),(79,'Kopi','','2023-07-15 00:31:15',1),(80,'Kentang Goreng','','2023-07-15 00:31:15',2),(81,'Kentang Goreng','RICKYSALIM','2023-07-15 00:35:00',2),(82,'Kopi manis','RICKYSALIM','2023-07-15 00:35:00',1),(83,'Kentang Goreng','RICKYSALIM','2023-07-15 00:36:18',5),(84,'Kopi','RICKYSALIM','2023-07-15 00:36:18',1),(85,'Kentang Goreng','RICKYSALIM','2023-07-15 00:36:50',5),(86,'Kopi','RICKYSALIM','2023-07-15 00:36:50',1),(87,'Kentang Goreng','RICKYSALIM','2023-07-15 00:40:02',3),(88,'Kopi','RICKYSALIM','2023-07-15 00:40:02',1),(89,'Kentang Goreng','JUNIUS ','2023-07-15 00:41:01',3),(90,'Kopi','JUNIUS ','2023-07-15 00:41:01',1),(91,'Kentang Goreng','RICKYSALIM','2023-07-15 00:42:19',2),(92,'Kopi','RICKYSALIM','2023-07-15 00:42:19',1),(93,'Kentang Goreng','RICKYSALIM','2023-07-15 00:43:47',3),(94,'Kopi','RICKYSALIM','2023-07-15 00:43:47',1),(95,'Kopi','RICKYSALIM','2023-07-15 00:44:10',1),(96,'Kentang Goreng','RICKYSALIM','2023-07-15 00:44:10',5),(97,'Kentang Goreng','JUNIUS ','2023-07-15 00:48:36',5),(98,'Kopi','JUNIUS ','2023-07-15 00:48:36',1),(99,'Kentang Goreng','JUNIUS ','2023-07-15 00:49:03',5),(100,'Kopi','JUNIUS ','2023-07-15 00:49:03',1),(101,'Kentang Goreng','JUNIUS ','2023-07-15 00:50:37',3),(102,'Kopi','JUNIUS ','2023-07-15 00:50:37',1),(103,'Kentang Goreng','RICKYSALIM','2023-07-15 00:50:56',3),(104,'Kopi','RICKYSALIM','2023-07-15 00:50:56',1),(105,'Kentang Goreng','JUNIUS ','2023-07-15 00:52:17',5),(106,'Kopi','JUNIUS ','2023-07-15 00:52:17',1),(107,'Kentang Goreng','JUNIUS ','2023-07-15 00:52:41',5),(108,'Kopi','JUNIUS ','2023-07-15 00:52:41',1),(119,'Kentang Goreng','RICKYSALIM','2023-07-15 01:12:26',4),(120,'Kopi manis','RICKYSALIM','2023-07-15 01:12:26',1),(121,'Kentang Goreng','JUNIUS ','2023-07-15 01:12:51',3),(122,'Kopi','JUNIUS ','2023-07-15 01:12:51',1),(123,'Kentang Goreng','RICKYSALIM','2023-07-15 01:13:41',5),(124,'Kopi','RICKYSALIM','2023-07-15 01:13:41',1),(125,'Kentang Goreng','JUNIUS ','2023-07-15 01:14:05',5),(126,'Kopi','JUNIUS ','2023-07-15 01:14:05',1),(127,'Kentang Goreng','JUNIUS ','2023-07-15 01:17:30',5),(128,'Kopi','JUNIUS ','2023-07-15 01:17:30',1),(129,'Kentang Goreng','JUNIUS ','2023-07-15 01:17:57',5),(130,'Kopi','JUNIUS ','2023-07-15 01:17:57',1),(131,'Kentang Goreng','JUNIUS ','2023-07-15 01:19:00',5),(132,'Kopi','JUNIUS ','2023-07-15 01:19:01',1),(133,'Kentang Goreng','JUNIUS ','2023-07-15 01:19:51',5),(134,'Kopi','JUNIUS ','2023-07-15 01:19:52',1),(135,'Kentang Goreng','JUNIUS ','2023-07-15 01:20:07',5),(136,'Kopi','JUNIUS ','2023-07-15 01:20:07',1),(137,'Kentang Goreng','JUNIUS ','2023-07-15 01:20:29',5),(138,'Kopi','JUNIUS ','2023-07-15 01:20:29',1),(139,'Kentang Goreng','JUNIUS ','2023-07-15 01:21:04',5),(140,'Kopi','JUNIUS ','2023-07-15 01:21:04',1),(141,'Kentang Goreng','JUNIUS ','2023-07-15 01:28:06',5),(142,'Kopi','JUNIUS ','2023-07-15 01:28:06',1),(143,'Kentang Goreng','JUNIUS ','2023-07-15 01:28:30',5),(144,'Kopi','JUNIUS ','2023-07-15 01:28:30',1),(145,'Kentang Goreng','JUNIUS ','2023-07-15 01:48:19',5),(146,'Kopi','JUNIUS ','2023-07-15 01:48:19',1),(147,'Kentang Goreng','JUNIUS ','2023-07-15 01:49:42',5),(148,'Kopi','JUNIUS ','2023-07-15 01:49:42',1),(149,'Kentang Goreng','JUNIUS ','2023-07-15 01:50:55',5),(150,'Kopi','JUNIUS ','2023-07-15 01:50:55',1),(151,'Kentang Goreng','JUNIUS ','2023-07-15 01:52:20',5),(152,'Kopi','JUNIUS ','2023-07-15 01:52:20',1),(153,'Kentang Goreng','JUNIUS ','2023-07-15 01:55:08',5),(154,'Kopi','JUNIUS ','2023-07-15 01:55:08',1),(155,'Kentang Goreng','JUNIUS ','2023-07-15 01:55:20',5),(156,'Kopi','JUNIUS ','2023-07-15 01:55:20',1),(157,'Kentang Goreng','JUNIUS ','2023-07-15 01:55:46',5),(158,'Kopi','JUNIUS ','2023-07-15 01:55:46',1),(159,'Kentang Goreng','JUNIUS ','2023-07-15 01:58:09',5),(160,'Kopi','JUNIUS ','2023-07-15 01:58:09',1),(161,'Kentang Goreng','JUNIUS ','2023-07-15 01:58:43',5),(162,'Kopi','JUNIUS ','2023-07-15 01:58:43',1),(163,'Kentang Goreng','JUNIUS ','2023-07-15 01:59:03',5),(164,'Kopi','JUNIUS ','2023-07-15 01:59:03',1),(165,'Kentang Goreng','JUNIUS ','2023-07-15 02:03:52',5),(166,'Kopi','JUNIUS ','2023-07-15 02:03:52',1),(167,'Kentang Goreng','RICKYSALIM','2023-07-15 02:04:17',5),(168,'Kopi manis','RICKYSALIM','2023-07-15 02:04:17',1),(169,'Kentang Goreng','RICKYSALIM','2023-07-15 02:04:34',2),(170,'Kopi','RICKYSALIM','2023-07-15 02:04:34',4),(171,'Kopi','RICKYSALIM','2023-07-15 02:05:14',1),(172,'Kentang Goreng','RICKYSALIM','2023-07-15 02:05:14',3),(173,'Kopi manis','JUNIUS ','2023-07-15 02:06:53',3),(174,'Teh Macha','JUNIUS ','2023-07-15 02:06:53',3),(175,'Kentang Goreng','RICKYSALIM','2023-07-15 02:08:29',100),(176,'Kopi','RICKYSALIM','2023-07-15 02:08:29',1),(177,'Kentang Goreng','RICKYSALIM','2023-07-15 04:06:36',2),(178,'Kopi','RICKYSALIM','2023-07-15 04:06:36',1),(179,'Kopi','RICKYSALIM','2023-07-15 06:38:34',30),(182,'Kopi','Ricky Salim','2023-07-17 12:31:30',5),(183,'Teh Macha','Ricky Salim','2023-07-17 12:31:30',5),(184,'Kopi','JUNIUS ','2023-07-17 12:32:57',1),(185,'Teh Macha','JUNIUS ','2023-07-17 12:32:57',10),(186,'Kopi','JUNIUS ','2023-07-17 12:35:32',1),(187,'Teh Macha','JUNIUS ','2023-07-17 12:35:32',10),(188,'Kopi','RICKYSALIM','2023-07-17 23:27:16',20),(189,'Teh Macha','RICKYSALIM','2023-07-17 23:27:16',20);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL AUTO_INCREMENT,
  `email` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES (1,'rickysalim81@gmail.com','superadmin','123'),(2,'juniusCreampie@gmail.com','admin','123'),(4,'hbiriziPounded@gmail.com','admin','123'),(5,'omarCumshot@gmail.com','admin','123');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produk` (
  `nama_produk` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bahan_produk` json NOT NULL,
  `harga_produk` bigint NOT NULL DEFAULT '1',
  `gambar_produk` varchar(500) NOT NULL,
  PRIMARY KEY (`nama_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES ('Kopi','[\"Bubuk Kopi\", \"Bubuk Macha\", \"Gula\", \"Susu\"]',5000,'images/Kopi.jpeg'),('Kopi Asal','[\"Bubuk Kopi\"]',123,'images/Kopi Asal.JPG'),('Kopi manis','[\"Bubuk Kopi\", \"Gula\"]',6000,'images/Kopi manis.jpeg'),('Kopi Susu','[\"Bubuk Kopi\", \"Gula\", \"Susu\"]',15000,'images/Kopi Susu.jpeg'),('Kopi Xnxx','[\"Bubuk Kopi\"]',12000,'images/Kopi Xnxx.jpg'),('Teh Macha','[\"Bubuk Macha\"]',10000,'images/Teh Macha.jpeg');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'fakekopi_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-11 21:07:35
