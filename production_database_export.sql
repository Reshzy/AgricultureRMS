-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: rsbsa_admin_portal2
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('agriculture-rms-cache-dc44958e29ffba8b810d21377ae366b5','i:1;',1760247943),('agriculture-rms-cache-dc44958e29ffba8b810d21377ae366b5:timer','i:1760247943;',1760247943),('agriculture-rms-cache-psgc:province:021500000:cities','a:29:{i:0;a:11:{s:4:\"code\";s:9:\"021501000\";s:4:\"name\";s:6:\"Abulug\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201501000\";}i:1;a:11:{s:4:\"code\";s:9:\"021502000\";s:4:\"name\";s:6:\"Alcala\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201502000\";}i:2;a:11:{s:4:\"code\";s:9:\"021503000\";s:4:\"name\";s:9:\"Allacapan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201503000\";}i:3;a:11:{s:4:\"code\";s:9:\"021504000\";s:4:\"name\";s:7:\"Amulung\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201504000\";}i:4;a:11:{s:4:\"code\";s:9:\"021505000\";s:4:\"name\";s:6:\"Aparri\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201505000\";}i:5;a:11:{s:4:\"code\";s:9:\"021506000\";s:4:\"name\";s:6:\"Baggao\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201506000\";}i:6;a:11:{s:4:\"code\";s:9:\"021507000\";s:4:\"name\";s:11:\"Ballesteros\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201507000\";}i:7;a:11:{s:4:\"code\";s:9:\"021508000\";s:4:\"name\";s:6:\"Buguey\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201508000\";}i:8;a:11:{s:4:\"code\";s:9:\"021509000\";s:4:\"name\";s:7:\"Calayan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201509000\";}i:9;a:11:{s:4:\"code\";s:9:\"021510000\";s:4:\"name\";s:12:\"Camalaniugan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201510000\";}i:10;a:11:{s:4:\"code\";s:9:\"021511000\";s:4:\"name\";s:8:\"Claveria\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511000\";}i:11;a:11:{s:4:\"code\";s:9:\"021512000\";s:4:\"name\";s:6:\"Enrile\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201512000\";}i:12;a:11:{s:4:\"code\";s:9:\"021513000\";s:4:\"name\";s:8:\"Gattaran\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201513000\";}i:13;a:11:{s:4:\"code\";s:9:\"021514000\";s:4:\"name\";s:7:\"Gonzaga\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201514000\";}i:14;a:11:{s:4:\"code\";s:9:\"021515000\";s:4:\"name\";s:5:\"Iguig\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201515000\";}i:15;a:11:{s:4:\"code\";s:9:\"021516000\";s:4:\"name\";s:6:\"Lal-Lo\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201516000\";}i:16;a:11:{s:4:\"code\";s:9:\"021517000\";s:4:\"name\";s:5:\"Lasam\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201517000\";}i:17;a:11:{s:4:\"code\";s:9:\"021518000\";s:4:\"name\";s:8:\"Pamplona\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518000\";}i:18;a:11:{s:4:\"code\";s:9:\"021519000\";s:4:\"name\";s:11:\"Peñablanca\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201519000\";}i:19;a:11:{s:4:\"code\";s:9:\"021520000\";s:4:\"name\";s:4:\"Piat\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201520000\";}i:20;a:11:{s:4:\"code\";s:9:\"021521000\";s:4:\"name\";s:5:\"Rizal\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201521000\";}i:21;a:11:{s:4:\"code\";s:9:\"021522000\";s:4:\"name\";s:12:\"Sanchez-Mira\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522000\";}i:22;a:11:{s:4:\"code\";s:9:\"021523000\";s:4:\"name\";s:9:\"Santa Ana\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201523000\";}i:23;a:11:{s:4:\"code\";s:9:\"021524000\";s:4:\"name\";s:14:\"Santa Praxedes\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524000\";}i:24;a:11:{s:4:\"code\";s:9:\"021525000\";s:4:\"name\";s:14:\"Santa Teresita\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201525000\";}i:25;a:11:{s:4:\"code\";s:9:\"021526000\";s:4:\"name\";s:11:\"Santo Niño\";s:7:\"oldName\";s:5:\"Faire\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201526000\";}i:26;a:11:{s:4:\"code\";s:9:\"021527000\";s:4:\"name\";s:6:\"Solana\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201527000\";}i:27;a:11:{s:4:\"code\";s:9:\"021528000\";s:4:\"name\";s:4:\"Tuao\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201528000\";}i:28;a:11:{s:4:\"code\";s:9:\"021529000\";s:4:\"name\";s:15:\"Tuguegarao City\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:1;s:6:\"isCity\";b:1;s:14:\"isMunicipality\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201529000\";}}',1760333825),('agriculture-rms-cache-psgc:region:010000000:provinces','a:4:{i:0;a:5:{s:4:\"code\";s:9:\"012800000\";s:4:\"name\";s:12:\"Ilocos Norte\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0102800000\";}i:1;a:5:{s:4:\"code\";s:9:\"012900000\";s:4:\"name\";s:10:\"Ilocos Sur\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0102900000\";}i:2;a:5:{s:4:\"code\";s:9:\"013300000\";s:4:\"name\";s:8:\"La Union\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0103300000\";}i:3;a:5:{s:4:\"code\";s:9:\"015500000\";s:4:\"name\";s:10:\"Pangasinan\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0105500000\";}}',1760333824),('agriculture-rms-cache-psgc:region:020000000:provinces','a:5:{i:0;a:5:{s:4:\"code\";s:9:\"020900000\";s:4:\"name\";s:7:\"Batanes\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0200900000\";}i:1;a:5:{s:4:\"code\";s:9:\"021500000\";s:4:\"name\";s:7:\"Cagayan\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201500000\";}i:2;a:5:{s:4:\"code\";s:9:\"023100000\";s:4:\"name\";s:7:\"Isabela\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203100000\";}i:3;a:5:{s:4:\"code\";s:9:\"025000000\";s:4:\"name\";s:13:\"Nueva Vizcaya\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0205000000\";}i:4;a:5:{s:4:\"code\";s:9:\"025700000\";s:4:\"name\";s:7:\"Quirino\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0205700000\";}}',1760333823),('agriculture-rms-cache-psgc:regions','a:17:{i:0;a:5:{s:4:\"code\";s:9:\"010000000\";s:4:\"name\";s:13:\"Ilocos Region\";s:10:\"regionName\";s:8:\"Region I\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0100000000\";}i:1;a:5:{s:4:\"code\";s:9:\"020000000\";s:4:\"name\";s:14:\"Cagayan Valley\";s:10:\"regionName\";s:9:\"Region II\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0200000000\";}i:2;a:5:{s:4:\"code\";s:9:\"030000000\";s:4:\"name\";s:13:\"Central Luzon\";s:10:\"regionName\";s:10:\"Region III\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0300000000\";}i:3;a:5:{s:4:\"code\";s:9:\"040000000\";s:4:\"name\";s:10:\"CALABARZON\";s:10:\"regionName\";s:11:\"Region IV-A\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0400000000\";}i:4;a:5:{s:4:\"code\";s:9:\"170000000\";s:4:\"name\";s:15:\"MIMAROPA Region\";s:10:\"regionName\";s:15:\"MIMAROPA Region\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"1700000000\";}i:5;a:5:{s:4:\"code\";s:9:\"050000000\";s:4:\"name\";s:12:\"Bicol Region\";s:10:\"regionName\";s:8:\"Region V\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0500000000\";}i:6;a:5:{s:4:\"code\";s:9:\"060000000\";s:4:\"name\";s:15:\"Western Visayas\";s:10:\"regionName\";s:9:\"Region VI\";s:15:\"islandGroupCode\";s:7:\"visayas\";s:15:\"psgc10DigitCode\";s:10:\"0600000000\";}i:7;a:5:{s:4:\"code\";s:9:\"070000000\";s:4:\"name\";s:15:\"Central Visayas\";s:10:\"regionName\";s:10:\"Region VII\";s:15:\"islandGroupCode\";s:7:\"visayas\";s:15:\"psgc10DigitCode\";s:10:\"0700000000\";}i:8;a:5:{s:4:\"code\";s:9:\"080000000\";s:4:\"name\";s:15:\"Eastern Visayas\";s:10:\"regionName\";s:11:\"Region VIII\";s:15:\"islandGroupCode\";s:7:\"visayas\";s:15:\"psgc10DigitCode\";s:10:\"0800000000\";}i:9;a:5:{s:4:\"code\";s:9:\"090000000\";s:4:\"name\";s:19:\"Zamboanga Peninsula\";s:10:\"regionName\";s:9:\"Region IX\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"0900000000\";}i:10;a:5:{s:4:\"code\";s:9:\"100000000\";s:4:\"name\";s:17:\"Northern Mindanao\";s:10:\"regionName\";s:8:\"Region X\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1000000000\";}i:11;a:5:{s:4:\"code\";s:9:\"110000000\";s:4:\"name\";s:12:\"Davao Region\";s:10:\"regionName\";s:9:\"Region XI\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1100000000\";}i:12;a:5:{s:4:\"code\";s:9:\"120000000\";s:4:\"name\";s:12:\"SOCCSKSARGEN\";s:10:\"regionName\";s:10:\"Region XII\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1200000000\";}i:13;a:5:{s:4:\"code\";s:9:\"130000000\";s:4:\"name\";s:3:\"NCR\";s:10:\"regionName\";s:23:\"National Capital Region\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"1300000000\";}i:14;a:5:{s:4:\"code\";s:9:\"140000000\";s:4:\"name\";s:3:\"CAR\";s:10:\"regionName\";s:32:\"Cordillera Administrative Region\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"1400000000\";}i:15;a:5:{s:4:\"code\";s:9:\"160000000\";s:4:\"name\";s:6:\"Caraga\";s:10:\"regionName\";s:11:\"Region XIII\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1600000000\";}i:16;a:5:{s:4:\"code\";s:9:\"150000000\";s:4:\"name\";s:5:\"BARMM\";s:10:\"regionName\";s:47:\"Bangsamoro Autonomous Region in Muslim Mindanao\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1900000000\";}}',1760333822);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_is_read_index` (`is_read`),
  KEY `contact_messages_created_at_index` (`created_at`),
  KEY `contact_messages_is_read_created_at_index` (`is_read`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Rodge Andru Viloria','reshzy581@gmail.com','Test','Good boi',1,'2025-10-11 22:42:26','2025-10-11 22:42:39');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(255) DEFAULT NULL,
  `rsbsa_reference_number` varchar(17) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `sex` enum('male','female') NOT NULL,
  `address_house_lot` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_barangay` varchar(255) DEFAULT NULL,
  `address_municipality_city` varchar(255) DEFAULT NULL,
  `address_province` varchar(255) DEFAULT NULL,
  `address_region` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `landline_number` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `highest_formal_education` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `civil_status` enum('single','married','widowed','separated') DEFAULT NULL,
  `name_of_spouse` varchar(255) DEFAULT NULL,
  `mothers_maiden_name` varchar(255) DEFAULT NULL,
  `household_head` tinyint(1) NOT NULL DEFAULT 0,
  `household_head_name` varchar(255) DEFAULT NULL,
  `relationship_to_head` varchar(255) DEFAULT NULL,
  `household_members_total` int(10) unsigned NOT NULL DEFAULT 0,
  `household_members_male` int(10) unsigned NOT NULL DEFAULT 0,
  `household_members_female` int(10) unsigned NOT NULL DEFAULT 0,
  `is_pwd` tinyint(1) NOT NULL DEFAULT 0,
  `is_four_ps_beneficiary` tinyint(1) NOT NULL DEFAULT 0,
  `is_indigenous_group_member` tinyint(1) NOT NULL DEFAULT 0,
  `indigenous_group_specify` varchar(255) DEFAULT NULL,
  `has_government_id` tinyint(1) NOT NULL DEFAULT 0,
  `government_id_type` varchar(255) DEFAULT NULL,
  `government_id_number` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_number` varchar(255) DEFAULT NULL,
  `main_livelihood` enum('farmer','farmworker','fisherfolk','agri_youth') NOT NULL,
  `farming_activities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`farming_activities`)),
  `other_crop_specify` varchar(255) DEFAULT NULL,
  `livestock_type_specify` varchar(255) DEFAULT NULL,
  `poultry_type_specify` varchar(255) DEFAULT NULL,
  `farmworker_kinds_of_work` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`farmworker_kinds_of_work`)),
  `farmworker_other_work` varchar(255) DEFAULT NULL,
  `fishing_activities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fishing_activities`)),
  `fishing_other_activity` varchar(255) DEFAULT NULL,
  `agriyouth_involvements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`agriyouth_involvements`)),
  `agriyouth_other_involvement` varchar(255) DEFAULT NULL,
  `gross_income_farming` decimal(12,2) DEFAULT NULL,
  `gross_income_non_farming` decimal(12,2) DEFAULT NULL,
  `rotation_farmers_p1` varchar(255) DEFAULT NULL,
  `rotation_farmers_p2` varchar(255) DEFAULT NULL,
  `rotation_farmers_p3` varchar(255) DEFAULT NULL,
  `status` enum('draft','submitted') NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
INSERT INTO `enrollments` VALUES (1,'enrollments/lHaSy9dYTlYbZnfNY6pB8QEf1FofomsEGAP4GnEe.jpg',NULL,'Viloria','Rodge Andru','Perdido',NULL,'male','69','Rico Street','Centro Ii (pob.)','Claveria','Cagayan','Cagayan Valley','0939 752 1414',NULL,'2004-05-08','Sanchez-mira, Cagayan, Philippines','Post graduate',NULL,'single','Pesca, Lyka P.','Perdido, Margarita Escalante',0,'Rogelio D. Viloria Jr.','Father',3,2,1,0,0,0,NULL,1,'National Id','12345',NULL,NULL,'farmworker',NULL,NULL,NULL,NULL,'[\"Land preparation\"]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'draft','2025-08-31 22:22:02','2025-10-06 19:35:06'),(4,'enrollments/uyZEZ1VUuP6SSBhKIyshQQzKBCLzQDFlgSL0Mxnf.jpg','87-10-32-470-2389','Viloria','Rodge Andru','Perdido','Jr','male','16','Marzan Street','Centro Ii (pob.)','Claveria','Cagayan','Cagayan Valley','0939 752 1414','+63 1234 1234','2004-05-07','Sanchez-mira, Cagayan, Philippines','Post graduate','Others: Igelsia Filipina Independiente','married','Pesca, Lyka P.','Perdido, Margarita Escalante',0,'Rogelio Dreu Viloria Jr.','Father',3,2,1,0,0,0,NULL,1,'National Id','12345','Peregrino, Gladys P.','0912 345 6789','farmer','[\"rice\"]','Wheat',NULL,'Chicken',NULL,NULL,NULL,NULL,'[\"part of a farming household\"]',NULL,12000.00,5000.00,'Roger Sanchez','Yve','Grock','submitted','2025-09-01 01:42:10','2025-10-06 18:48:21'),(5,'enrollments/g7oxL4wMW3i11Xv3kmc1P5nWOgJlvpuHfA54bnqY.jpg','13-24-12-432-1412','Divisoria','Alelele','Kitaonga',NULL,'male',NULL,NULL,'Centro Viii','Claveria','Cagayan','Cagayan Valley','0984 837 2784',NULL,NULL,'Sanchez-mira, Cagayan, Philippines','Post graduate','Others: Thighs','single',NULL,NULL,0,NULL,NULL,0,0,0,0,0,0,NULL,0,NULL,NULL,NULL,NULL,'farmworker',NULL,NULL,NULL,NULL,'[\"Land preparation\"]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'submitted','2025-10-06 19:01:53','2025-10-06 19:02:52'),(6,'enrollments/1kHy1F7sD1Nbomi1djr7efAilqNfginKWA5IWGKc.jpg','43-13-46-653-1265','Bellalaa','Delphine','Khalifa',NULL,'female',NULL,NULL,'Buenavista','Claveria','Cagayan','Cagayan Valley','0988 438 2842',NULL,'2003-05-08','Tampakan, South Cotabato, Philippines','Post graduate','Christianity','married',NULL,NULL,0,NULL,NULL,0,0,0,0,0,0,NULL,0,NULL,NULL,NULL,NULL,'fisherfolk',NULL,NULL,NULL,NULL,NULL,NULL,'[\"Aquaculture\"]','Daklis Gaming',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'submitted','2025-10-06 19:06:29','2025-10-06 19:10:01'),(7,'enrollments/A206rDrQVIxLJNIC59Visw578dX1D12EqpEaovcY.jpg','15-35-15-431-5313','Mendoza','John','D',NULL,'male','Purok 1','Mabini','Centro Vii','Claveria','Cagayan','Cagayan Valley','0945 645 1211',NULL,'2004-06-10','Claveria, Cagayan, Philippines','Senior High school (K-12)','Christianity','married',NULL,NULL,1,NULL,NULL,6,3,3,1,1,0,NULL,0,NULL,NULL,'Kkkkk','09945623544','farmer','[\"rice\"]','Banana, Saba','Pig','Chicken, Duck',NULL,NULL,NULL,NULL,NULL,NULL,500.00,NULL,NULL,NULL,NULL,'submitted','2025-10-06 20:27:07','2025-10-06 20:36:01');
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_parcel_items`
--

DROP TABLE IF EXISTS `farm_parcel_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_parcel_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farm_parcel_id` bigint(20) unsigned NOT NULL,
  `kind` enum('crop','livestock','poultry') NOT NULL,
  `name` varchar(255) NOT NULL,
  `size_ha` decimal(10,2) DEFAULT NULL,
  `num_of_head` int(10) unsigned DEFAULT NULL,
  `farm_type` varchar(255) DEFAULT NULL,
  `is_organic_practitioner` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_parcel_items_farm_parcel_id_foreign` (`farm_parcel_id`),
  CONSTRAINT `farm_parcel_items_farm_parcel_id_foreign` FOREIGN KEY (`farm_parcel_id`) REFERENCES `farm_parcels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_parcel_items`
--

LOCK TABLES `farm_parcel_items` WRITE;
/*!40000 ALTER TABLE `farm_parcel_items` DISABLE KEYS */;
INSERT INTO `farm_parcel_items` VALUES (27,21,'crop','Wheat',2.00,NULL,'Rainfed',1,'Good','2025-10-06 18:48:21','2025-10-06 18:48:21'),(28,21,'crop','Rice',3.00,NULL,'Rainfed',1,'Eme','2025-10-06 18:48:21','2025-10-06 18:48:21'),(29,22,'poultry','Chicken',2.00,10,'Egg Farm',0,'Good','2025-10-06 18:48:21','2025-10-06 18:48:21'),(30,27,'crop','Banana',1.00,NULL,'saba',0,'naimas','2025-10-06 20:36:01','2025-10-06 20:36:01'),(31,27,'livestock','Pig',0.50,5,'Meat',0,'yummy','2025-10-06 20:36:01','2025-10-06 20:36:01'),(32,27,'poultry','Chicken',0.25,10,'Egg',0,'Sunny side up','2025-10-06 20:36:01','2025-10-06 20:36:01'),(33,27,'poultry','Duck',10.00,2,'Balut',0,'Penoy','2025-10-06 20:36:01','2025-10-06 20:36:01');
/*!40000 ALTER TABLE `farm_parcel_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_parcels`
--

DROP TABLE IF EXISTS `farm_parcels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_parcels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `enrollment_id` bigint(20) unsigned NOT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `total_farm_area_ha` decimal(10,2) DEFAULT NULL,
  `ownership_document_no` varchar(255) DEFAULT NULL,
  `within_ancestral_domain` tinyint(1) NOT NULL DEFAULT 0,
  `is_agrarian_reform_beneficiary` tinyint(1) NOT NULL DEFAULT 0,
  `ownership_type` enum('registered_owner','tenant','lessee','others') DEFAULT NULL,
  `land_owner_name` varchar(255) DEFAULT NULL,
  `ownership_other_specify` varchar(255) DEFAULT NULL,
  `crop_commodity` varchar(255) DEFAULT NULL,
  `livestock_poultry_type` varchar(255) DEFAULT NULL,
  `size_ha` decimal(10,2) DEFAULT NULL,
  `num_of_head` int(10) unsigned DEFAULT NULL,
  `farm_type` varchar(255) DEFAULT NULL,
  `is_organic_practitioner` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_parcels_enrollment_id_foreign` (`enrollment_id`),
  CONSTRAINT `farm_parcels_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_parcels`
--

LOCK TABLES `farm_parcels` WRITE;
/*!40000 ALTER TABLE `farm_parcels` DISABLE KEYS */;
INSERT INTO `farm_parcels` VALUES (21,4,NULL,NULL,5.00,'123',1,1,'registered_owner',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-10-06 18:48:21','2025-10-06 18:48:21'),(22,4,NULL,NULL,2.00,'123',1,1,'tenant',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-10-06 18:48:21','2025-10-06 18:48:21'),(24,5,'Calog Sur','Abulug',NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-10-06 19:02:52','2025-10-06 19:02:52'),(26,6,'Bacsay Mapulapula','Claveria',NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-10-06 19:10:01','2025-10-06 19:10:01'),(27,7,'Kilkiling','Claveria',5.00,NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-10-06 20:36:01','2025-10-06 20:36:01');
/*!40000 ALTER TABLE `farm_parcels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"43f0d1b5-9e8e-4edb-8fde-7955726bd40b\",\"displayName\":\"App\\\\Mail\\\\ContactMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:31:\\\"App\\\\Mail\\\\ContactMessageReceived\\\":3:{s:14:\\\"contactMessage\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\ContactMessage\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:17:\\\"admin@example.com\\\";}}s:6:\\\"mailer\\\";s:3:\\\"log\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1760251346,\"delay\":null}',0,NULL,1760251346,1760251346);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_07_30_093906_add_two_factor_columns_to_users_table',1),(5,'2025_07_30_093939_create_personal_access_tokens_table',1),(6,'2025_09_01_013854_create_news_table',2),(7,'2025_09_01_015251_add_is_admin_to_users_table',3),(8,'2025_09_01_015523_create_enrollments_table',4),(9,'2025_09_01_015530_create_farm_parcels_table',4),(10,'2025_09_01_051022_create_farm_parcel_items_table',5),(11,'2025_09_01_052144_update_farm_parcel_items_table_add_columns',6),(12,'2025_09_01_061551_add_status_to_enrollments_table',7),(13,'2025_10_07_024442_add_rsbsa_reference_number_to_enrollments_table',8),(14,'2025_10_12_044219_update_news_audience_values',9),(15,'2025_10_12_063538_create_contact_messages_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `featured_image_path` varchar(255) DEFAULT NULL,
  `categories` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`categories`)),
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `audience` varchar(255) NOT NULL DEFAULT 'all_farmers',
  `priority` enum('normal','important','urgent') NOT NULL DEFAULT 'normal',
  `status` enum('draft','scheduled','published') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_slug_unique` (`slug`),
  KEY `news_published_at_index` (`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Pagasa Warns of Extended Rainfall, Farmers Urged to Protect Crops','pagasa-warns-of-extended-rainfall-farmers-urged-to-protect-crops-QPcuHy','The Philippine Atmospheric, Geophysical and Astronomical Services Administration (PAGASA) has issued an advisory warning of extended rainfall across Northern Luzon due to the southwest monsoon. Farmers are advised to secure their rice paddies and vegetable crops against possible flooding and waterlogging.\r\nAgricultural experts recommend using proper drainage systems and monitoring soil conditions to prevent crop damage. PAGASA added that while the rains may benefit some irrigated areas, excessive water could reduce yields if not managed properly.','news/T0GZnipFDqGxgTJ8ADMtg6U3vx2txzEmPsEm8GxE.jpg','[]','[\"water\",\"liquid\",\"scenery\",\"asf\",\"dasfasdfasdfasdfasgasdg\",\"ashghhhhhhhhhhhhhhhhhhhh hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh\"]','all_farmers','important','published','2025-09-01 06:09:48',NULL,'2025-09-01 06:06:42','2025-09-01 06:09:48'),(2,'Test','test-HblTcg','Test Selena','news/ghoRWL584AJVz6fCZNSoQyeOsrvPua9m6PwHxLBp.png','[\"market\"]','[\"important\",\"maybe\",\"idk\",\"Test 2\"]','farmers','normal','published','2025-10-11 21:46:12',NULL,'2025-10-06 03:13:42','2025-10-11 21:46:12'),(3,'Smart Irrigation Tech Boosts Farm Yields Amid Dry Season','smart-irrigation-tech-boosts-farm-yields-amid-dry-season-ApOfZI','As Central Luzon faces an extended dry spell, local farmers are turning to smart irrigation systems to maintain crop health and improve yields. The Department of Agriculture has partnered with tech startups to deploy solar-powered drip irrigation kits across Pampanga and Tarlac, helping over 2,000 farmers reduce water usage by up to 40%.\r\nThe initiative includes training sessions on sensor-based watering schedules and mobile app monitoring. Farmers report healthier crops and lower costs, with rice and corn yields projected to increase by 15% this season.\r\n“This technology is a game-changer,” says Engr. Liza Ramos of AgriTech Solutions. “It empowers farmers to make data-driven decisions and adapt to climate challenges.”','news/ukKwNozjK4cdXwxb2kboJzO2ev4bHjwS2O5uL9N6.png','[\"weather\",\"market\",\"training\",\"government\",\"technology\"]','[\"smart irrigation\",\"dry season\",\"solar-powered farming\",\"agriculture technology\",\"crop yield\",\"water conservation\",\"farmer training\",\"Central Luzon farming\",\"DA initiatives\",\"climate adaptation\"]','all_farmers','important','published','2025-10-11 22:11:28',NULL,'2025-10-11 22:11:28','2025-10-11 22:11:28');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('O0vkKvgFtzfEpoNQMhVx3CBeKodXN75Bv6UFgAEJ',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNHVOWnQyY1dVZFB4aXRzdnl3Q25SR3QwUnAyVU5vSWhPcko5Q1RhViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkWC5wdmM1aDhGRXJWUkNISmYybEJuT2VsWFcyOGxvR2pUbzJwWU1MSnNyQnBENFR5THRLbWEiO30=',1760254400);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@example.com',NULL,'$2y$12$X.pvc5h8FErVRCHJf2lBnOelXW28loGjTo2pYMLJsrBpD4TyLtKma',1,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-31 18:02:49','2025-10-11 23:26:48');
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

-- Dump completed on 2025-10-12 16:28:56
