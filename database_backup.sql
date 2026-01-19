-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: rsbsa_admin_portal
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
INSERT INTO `cache` VALUES ('farmtrack-cache-dc44958e29ffba8b810d21377ae366b5','i:1;',1756738439),('farmtrack-cache-dc44958e29ffba8b810d21377ae366b5:timer','i:1756738439;',1756738439),('farmtrack-cache-psgc:city:021511000:barangays','a:41:{i:0;a:11:{s:4:\"code\";s:9:\"021511001\";s:4:\"name\";s:7:\"Alimoan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511001\";}i:1;a:11:{s:4:\"code\";s:9:\"021511002\";s:4:\"name\";s:22:\"Bacsay Cataraoan Norte\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511002\";}i:2;a:11:{s:4:\"code\";s:9:\"021511003\";s:4:\"name\";s:17:\"Bacsay Mapulapula\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511003\";}i:3;a:11:{s:4:\"code\";s:9:\"021511004\";s:4:\"name\";s:9:\"Bilibigao\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511004\";}i:4;a:11:{s:4:\"code\";s:9:\"021511005\";s:4:\"name\";s:10:\"Buenavista\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511005\";}i:5;a:11:{s:4:\"code\";s:9:\"021511006\";s:4:\"name\";s:13:\"Cadcadir East\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511006\";}i:6;a:11:{s:4:\"code\";s:9:\"021511007\";s:4:\"name\";s:11:\"Capannikian\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511007\";}i:7;a:11:{s:4:\"code\";s:9:\"021511008\";s:4:\"name\";s:15:\"Centro I (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511008\";}i:8;a:11:{s:4:\"code\";s:9:\"021511009\";s:4:\"name\";s:16:\"Centro II (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511009\";}i:9;a:11:{s:4:\"code\";s:9:\"021511010\";s:4:\"name\";s:5:\"Culao\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511010\";}i:10;a:11:{s:4:\"code\";s:9:\"021511011\";s:4:\"name\";s:7:\"Dibalio\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511011\";}i:11;a:11:{s:4:\"code\";s:9:\"021511012\";s:4:\"name\";s:9:\"Kilkiling\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511012\";}i:12;a:11:{s:4:\"code\";s:9:\"021511013\";s:4:\"name\";s:8:\"Lablabig\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511013\";}i:13;a:11:{s:4:\"code\";s:9:\"021511014\";s:4:\"name\";s:5:\"Luzon\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511014\";}i:14;a:11:{s:4:\"code\";s:9:\"021511015\";s:4:\"name\";s:7:\"Mabnang\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511015\";}i:15;a:11:{s:4:\"code\";s:9:\"021511016\";s:4:\"name\";s:9:\"Magdalena\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511016\";}i:16;a:11:{s:4:\"code\";s:9:\"021511017\";s:4:\"name\";s:10:\"Centro VII\";s:7:\"oldName\";s:12:\"Malasin East\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511017\";}i:17;a:11:{s:4:\"code\";s:9:\"021511018\";s:4:\"name\";s:9:\"Malilitao\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511018\";}i:18;a:11:{s:4:\"code\";s:9:\"021511019\";s:4:\"name\";s:9:\"Centro VI\";s:7:\"oldName\";s:7:\"Minanga\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511019\";}i:19;a:11:{s:4:\"code\";s:9:\"021511020\";s:4:\"name\";s:10:\"Nagsabaran\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511020\";}i:20;a:11:{s:4:\"code\";s:9:\"021511021\";s:4:\"name\";s:9:\"Centro IV\";s:7:\"oldName\";s:11:\"Nangasangan\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511021\";}i:21;a:11:{s:4:\"code\";s:9:\"021511022\";s:4:\"name\";s:9:\"Pata East\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511022\";}i:22;a:11:{s:4:\"code\";s:9:\"021511023\";s:4:\"name\";s:5:\"Pinas\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511023\";}i:23;a:11:{s:4:\"code\";s:9:\"021511024\";s:4:\"name\";s:8:\"Santiago\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511024\";}i:24;a:11:{s:4:\"code\";s:9:\"021511025\";s:4:\"name\";s:11:\"Santo Tomas\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511025\";}i:25;a:11:{s:4:\"code\";s:9:\"021511026\";s:4:\"name\";s:11:\"Santa Maria\";s:7:\"oldName\";s:7:\"Surngot\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511026\";}i:26;a:11:{s:4:\"code\";s:9:\"021511027\";s:4:\"name\";s:8:\"Tabbugan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511027\";}i:27;a:11:{s:4:\"code\";s:9:\"021511028\";s:4:\"name\";s:12:\"Taggat Norte\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511028\";}i:28;a:11:{s:4:\"code\";s:9:\"021511029\";s:4:\"name\";s:5:\"Union\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511029\";}i:29;a:11:{s:4:\"code\";s:9:\"021511030\";s:4:\"name\";s:20:\"Bacsay Cataraoan Sur\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511030\";}i:30;a:11:{s:4:\"code\";s:9:\"021511031\";s:4:\"name\";s:13:\"Cadcadir West\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511031\";}i:31;a:11:{s:4:\"code\";s:9:\"021511032\";s:4:\"name\";s:20:\"Camalaggoan/D Leaño\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511032\";}i:32;a:11:{s:4:\"code\";s:9:\"021511033\";s:4:\"name\";s:10:\"Centro III\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511033\";}i:33;a:11:{s:4:\"code\";s:9:\"021511034\";s:4:\"name\";s:8:\"Centro V\";s:7:\"oldName\";s:4:\"Mina\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511034\";}i:34;a:11:{s:4:\"code\";s:9:\"021511035\";s:4:\"name\";s:11:\"Centro VIII\";s:7:\"oldName\";s:12:\"Malasin West\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511035\";}i:35;a:11:{s:4:\"code\";s:9:\"021511036\";s:4:\"name\";s:9:\"Pata West\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511036\";}i:36;a:11:{s:4:\"code\";s:9:\"021511037\";s:4:\"name\";s:11:\"San Antonio\";s:7:\"oldName\";s:13:\"Sayad/Bimekel\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511037\";}i:37;a:11:{s:4:\"code\";s:9:\"021511038\";s:4:\"name\";s:10:\"San Isidro\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511038\";}i:38;a:11:{s:4:\"code\";s:9:\"021511039\";s:4:\"name\";s:11:\"San Vicente\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511039\";}i:39;a:11:{s:4:\"code\";s:9:\"021511040\";s:4:\"name\";s:11:\"Santo Niño\";s:7:\"oldName\";s:9:\"Barbarnis\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511040\";}i:40;a:11:{s:4:\"code\";s:9:\"021511041\";s:4:\"name\";s:10:\"Taggat Sur\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021511000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511041\";}}',1756810982),('farmtrack-cache-psgc:city:021518000:barangays','a:18:{i:0;a:11:{s:4:\"code\";s:9:\"021518001\";s:4:\"name\";s:11:\"Abanqueruan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518001\";}i:1;a:11:{s:4:\"code\";s:9:\"021518002\";s:4:\"name\";s:9:\"Allasitan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518002\";}i:2;a:11:{s:4:\"code\";s:9:\"021518003\";s:4:\"name\";s:4:\"Bagu\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518003\";}i:3;a:11:{s:4:\"code\";s:9:\"021518004\";s:4:\"name\";s:8:\"Balingit\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518004\";}i:4;a:11:{s:4:\"code\";s:9:\"021518005\";s:4:\"name\";s:8:\"Bidduang\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518005\";}i:5;a:11:{s:4:\"code\";s:9:\"021518006\";s:4:\"name\";s:8:\"Cabaggan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518006\";}i:6;a:11:{s:4:\"code\";s:9:\"021518007\";s:4:\"name\";s:10:\"Capalalian\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518007\";}i:7;a:11:{s:4:\"code\";s:9:\"021518008\";s:4:\"name\";s:7:\"Casitan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518008\";}i:8;a:11:{s:4:\"code\";s:9:\"021518009\";s:4:\"name\";s:13:\"Centro (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518009\";}i:9;a:11:{s:4:\"code\";s:9:\"021518010\";s:4:\"name\";s:5:\"Curva\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518010\";}i:10;a:11:{s:4:\"code\";s:9:\"021518011\";s:4:\"name\";s:5:\"Gattu\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518011\";}i:11;a:11:{s:4:\"code\";s:9:\"021518012\";s:4:\"name\";s:4:\"Masi\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518012\";}i:12;a:11:{s:4:\"code\";s:9:\"021518013\";s:4:\"name\";s:10:\"Nagattatan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518013\";}i:13;a:11:{s:4:\"code\";s:9:\"021518014\";s:4:\"name\";s:10:\"Nagtupacan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518014\";}i:14;a:11:{s:4:\"code\";s:9:\"021518015\";s:4:\"name\";s:8:\"San Juan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518015\";}i:15;a:11:{s:4:\"code\";s:9:\"021518016\";s:4:\"name\";s:10:\"Santa Cruz\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518016\";}i:16;a:11:{s:4:\"code\";s:9:\"021518017\";s:4:\"name\";s:5:\"Tabba\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518017\";}i:17;a:11:{s:4:\"code\";s:9:\"021518018\";s:4:\"name\";s:7:\"Tupanna\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021518000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518018\";}}',1756811444),('farmtrack-cache-psgc:city:021522000:barangays','a:18:{i:0;a:11:{s:4:\"code\";s:9:\"021522001\";s:4:\"name\";s:6:\"Bangan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522001\";}i:1;a:11:{s:4:\"code\";s:9:\"021522002\";s:4:\"name\";s:9:\"Callungan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522002\";}i:2;a:11:{s:4:\"code\";s:9:\"021522003\";s:4:\"name\";s:15:\"Centro I (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522003\";}i:3;a:11:{s:4:\"code\";s:9:\"021522004\";s:4:\"name\";s:16:\"Centro II (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522004\";}i:4;a:11:{s:4:\"code\";s:9:\"021522005\";s:4:\"name\";s:5:\"Dacal\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522005\";}i:5;a:11:{s:4:\"code\";s:9:\"021522006\";s:4:\"name\";s:8:\"Dagueray\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522006\";}i:6;a:11:{s:4:\"code\";s:9:\"021522008\";s:4:\"name\";s:7:\"Dammang\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522008\";}i:7;a:11:{s:4:\"code\";s:9:\"021522009\";s:4:\"name\";s:6:\"Kittag\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522009\";}i:8;a:11:{s:4:\"code\";s:9:\"021522010\";s:4:\"name\";s:8:\"Langagan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522010\";}i:9;a:11:{s:4:\"code\";s:9:\"021522011\";s:4:\"name\";s:7:\"Magacan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522011\";}i:10;a:11:{s:4:\"code\";s:9:\"021522012\";s:4:\"name\";s:6:\"Marzan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522012\";}i:11;a:11:{s:4:\"code\";s:9:\"021522013\";s:4:\"name\";s:7:\"Masisit\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522013\";}i:12;a:11:{s:4:\"code\";s:9:\"021522014\";s:4:\"name\";s:12:\"Nagrangtayan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522014\";}i:13;a:11:{s:4:\"code\";s:9:\"021522015\";s:4:\"name\";s:6:\"Namuac\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522015\";}i:14;a:11:{s:4:\"code\";s:9:\"021522016\";s:4:\"name\";s:10:\"San Andres\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522016\";}i:15;a:11:{s:4:\"code\";s:9:\"021522017\";s:4:\"name\";s:8:\"Santiago\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522017\";}i:16;a:11:{s:4:\"code\";s:9:\"021522018\";s:4:\"name\";s:6:\"Santor\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522018\";}i:17;a:11:{s:4:\"code\";s:9:\"021522019\";s:4:\"name\";s:7:\"Tokitok\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021522000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522019\";}}',1756805966),('farmtrack-cache-psgc:city:021524000:barangays','a:10:{i:0;a:11:{s:4:\"code\";s:9:\"021524001\";s:4:\"name\";s:12:\"Cadongdongan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524001\";}i:1;a:11:{s:4:\"code\";s:9:\"021524002\";s:4:\"name\";s:8:\"Capacuan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524002\";}i:2;a:11:{s:4:\"code\";s:9:\"021524003\";s:4:\"name\";s:15:\"Centro I (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524003\";}i:3;a:11:{s:4:\"code\";s:9:\"021524004\";s:4:\"name\";s:16:\"Centro II (Pob.)\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524004\";}i:4;a:11:{s:4:\"code\";s:9:\"021524005\";s:4:\"name\";s:7:\"Macatel\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524005\";}i:5;a:11:{s:4:\"code\";s:9:\"021524008\";s:4:\"name\";s:9:\"Portabaga\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524008\";}i:6;a:11:{s:4:\"code\";s:9:\"021524009\";s:4:\"name\";s:8:\"San Juan\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524009\";}i:7;a:11:{s:4:\"code\";s:9:\"021524010\";s:4:\"name\";s:10:\"San Miguel\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524010\";}i:8;a:11:{s:4:\"code\";s:9:\"021524011\";s:4:\"name\";s:10:\"Salungsong\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524011\";}i:9;a:11:{s:4:\"code\";s:9:\"021524012\";s:4:\"name\";s:5:\"Sicul\";s:7:\"oldName\";s:0:\"\";s:19:\"subMunicipalityCode\";b:0;s:8:\"cityCode\";b:0;s:16:\"municipalityCode\";s:9:\"021524000\";s:12:\"districtCode\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524012\";}}',1756810992),('farmtrack-cache-psgc:province:021500000:cities','a:29:{i:0;a:11:{s:4:\"code\";s:9:\"021501000\";s:4:\"name\";s:6:\"Abulug\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201501000\";}i:1;a:11:{s:4:\"code\";s:9:\"021502000\";s:4:\"name\";s:6:\"Alcala\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201502000\";}i:2;a:11:{s:4:\"code\";s:9:\"021503000\";s:4:\"name\";s:9:\"Allacapan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201503000\";}i:3;a:11:{s:4:\"code\";s:9:\"021504000\";s:4:\"name\";s:7:\"Amulung\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201504000\";}i:4;a:11:{s:4:\"code\";s:9:\"021505000\";s:4:\"name\";s:6:\"Aparri\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201505000\";}i:5;a:11:{s:4:\"code\";s:9:\"021506000\";s:4:\"name\";s:6:\"Baggao\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201506000\";}i:6;a:11:{s:4:\"code\";s:9:\"021507000\";s:4:\"name\";s:11:\"Ballesteros\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201507000\";}i:7;a:11:{s:4:\"code\";s:9:\"021508000\";s:4:\"name\";s:6:\"Buguey\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201508000\";}i:8;a:11:{s:4:\"code\";s:9:\"021509000\";s:4:\"name\";s:7:\"Calayan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201509000\";}i:9;a:11:{s:4:\"code\";s:9:\"021510000\";s:4:\"name\";s:12:\"Camalaniugan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201510000\";}i:10;a:11:{s:4:\"code\";s:9:\"021511000\";s:4:\"name\";s:8:\"Claveria\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201511000\";}i:11;a:11:{s:4:\"code\";s:9:\"021512000\";s:4:\"name\";s:6:\"Enrile\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201512000\";}i:12;a:11:{s:4:\"code\";s:9:\"021513000\";s:4:\"name\";s:8:\"Gattaran\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201513000\";}i:13;a:11:{s:4:\"code\";s:9:\"021514000\";s:4:\"name\";s:7:\"Gonzaga\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201514000\";}i:14;a:11:{s:4:\"code\";s:9:\"021515000\";s:4:\"name\";s:5:\"Iguig\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201515000\";}i:15;a:11:{s:4:\"code\";s:9:\"021516000\";s:4:\"name\";s:6:\"Lal-Lo\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201516000\";}i:16;a:11:{s:4:\"code\";s:9:\"021517000\";s:4:\"name\";s:5:\"Lasam\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201517000\";}i:17;a:11:{s:4:\"code\";s:9:\"021518000\";s:4:\"name\";s:8:\"Pamplona\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201518000\";}i:18;a:11:{s:4:\"code\";s:9:\"021519000\";s:4:\"name\";s:11:\"Peñablanca\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201519000\";}i:19;a:11:{s:4:\"code\";s:9:\"021520000\";s:4:\"name\";s:4:\"Piat\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201520000\";}i:20;a:11:{s:4:\"code\";s:9:\"021521000\";s:4:\"name\";s:5:\"Rizal\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201521000\";}i:21;a:11:{s:4:\"code\";s:9:\"021522000\";s:4:\"name\";s:12:\"Sanchez-Mira\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201522000\";}i:22;a:11:{s:4:\"code\";s:9:\"021523000\";s:4:\"name\";s:9:\"Santa Ana\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201523000\";}i:23;a:11:{s:4:\"code\";s:9:\"021524000\";s:4:\"name\";s:14:\"Santa Praxedes\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201524000\";}i:24;a:11:{s:4:\"code\";s:9:\"021525000\";s:4:\"name\";s:14:\"Santa Teresita\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201525000\";}i:25;a:11:{s:4:\"code\";s:9:\"021526000\";s:4:\"name\";s:11:\"Santo Niño\";s:7:\"oldName\";s:5:\"Faire\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201526000\";}i:26;a:11:{s:4:\"code\";s:9:\"021527000\";s:4:\"name\";s:6:\"Solana\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201527000\";}i:27;a:11:{s:4:\"code\";s:9:\"021528000\";s:4:\"name\";s:4:\"Tuao\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201528000\";}i:28;a:11:{s:4:\"code\";s:9:\"021529000\";s:4:\"name\";s:15:\"Tuguegarao City\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:1;s:6:\"isCity\";b:1;s:14:\"isMunicipality\";b:0;s:12:\"provinceCode\";s:9:\"021500000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201529000\";}}',1756805960),('farmtrack-cache-psgc:province:023100000:cities','a:37:{i:0;a:11:{s:4:\"code\";s:9:\"023101000\";s:4:\"name\";s:6:\"Alicia\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203101000\";}i:1;a:11:{s:4:\"code\";s:9:\"023102000\";s:4:\"name\";s:9:\"Angadanan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203102000\";}i:2;a:11:{s:4:\"code\";s:9:\"023103000\";s:4:\"name\";s:6:\"Aurora\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203103000\";}i:3;a:11:{s:4:\"code\";s:9:\"023104000\";s:4:\"name\";s:14:\"Benito Soliven\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203104000\";}i:4;a:11:{s:4:\"code\";s:9:\"023105000\";s:4:\"name\";s:6:\"Burgos\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203105000\";}i:5;a:11:{s:4:\"code\";s:9:\"023106000\";s:4:\"name\";s:7:\"Cabagan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203106000\";}i:6;a:11:{s:4:\"code\";s:9:\"023107000\";s:4:\"name\";s:8:\"Cabatuan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203107000\";}i:7;a:11:{s:4:\"code\";s:9:\"023108000\";s:4:\"name\";s:15:\"City of Cauayan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:1;s:14:\"isMunicipality\";b:0;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203108000\";}i:8;a:11:{s:4:\"code\";s:9:\"023109000\";s:4:\"name\";s:6:\"Cordon\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203109000\";}i:9;a:11:{s:4:\"code\";s:9:\"023110000\";s:4:\"name\";s:9:\"Dinapigue\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203110000\";}i:10;a:11:{s:4:\"code\";s:9:\"023111000\";s:4:\"name\";s:9:\"Divilacan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203111000\";}i:11;a:11:{s:4:\"code\";s:9:\"023112000\";s:4:\"name\";s:7:\"Echague\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203112000\";}i:12;a:11:{s:4:\"code\";s:9:\"023113000\";s:4:\"name\";s:4:\"Gamu\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203113000\";}i:13;a:11:{s:4:\"code\";s:9:\"023114000\";s:4:\"name\";s:14:\"City of Ilagan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:1;s:6:\"isCity\";b:1;s:14:\"isMunicipality\";b:0;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203114000\";}i:14;a:11:{s:4:\"code\";s:9:\"023115000\";s:4:\"name\";s:5:\"Jones\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203115000\";}i:15;a:11:{s:4:\"code\";s:9:\"023116000\";s:4:\"name\";s:4:\"Luna\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203116000\";}i:16;a:11:{s:4:\"code\";s:9:\"023117000\";s:4:\"name\";s:9:\"Maconacon\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203117000\";}i:17;a:11:{s:4:\"code\";s:9:\"023118000\";s:4:\"name\";s:13:\"Delfin Albano\";s:7:\"oldName\";s:9:\"Magsaysay\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203118000\";}i:18;a:11:{s:4:\"code\";s:9:\"023119000\";s:4:\"name\";s:6:\"Mallig\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203119000\";}i:19;a:11:{s:4:\"code\";s:9:\"023120000\";s:4:\"name\";s:9:\"Naguilian\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203120000\";}i:20;a:11:{s:4:\"code\";s:9:\"023121000\";s:4:\"name\";s:7:\"Palanan\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203121000\";}i:21;a:11:{s:4:\"code\";s:9:\"023122000\";s:4:\"name\";s:6:\"Quezon\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203122000\";}i:22;a:11:{s:4:\"code\";s:9:\"023123000\";s:4:\"name\";s:7:\"Quirino\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203123000\";}i:23;a:11:{s:4:\"code\";s:9:\"023124000\";s:4:\"name\";s:5:\"Ramon\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203124000\";}i:24;a:11:{s:4:\"code\";s:9:\"023125000\";s:4:\"name\";s:14:\"Reina Mercedes\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203125000\";}i:25;a:11:{s:4:\"code\";s:9:\"023126000\";s:4:\"name\";s:5:\"Roxas\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203126000\";}i:26;a:11:{s:4:\"code\";s:9:\"023127000\";s:4:\"name\";s:11:\"San Agustin\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203127000\";}i:27;a:11:{s:4:\"code\";s:9:\"023128000\";s:4:\"name\";s:13:\"San Guillermo\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203128000\";}i:28;a:11:{s:4:\"code\";s:9:\"023129000\";s:4:\"name\";s:10:\"San Isidro\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203129000\";}i:29;a:11:{s:4:\"code\";s:9:\"023130000\";s:4:\"name\";s:10:\"San Manuel\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203130000\";}i:30;a:11:{s:4:\"code\";s:9:\"023131000\";s:4:\"name\";s:11:\"San Mariano\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203131000\";}i:31;a:11:{s:4:\"code\";s:9:\"023132000\";s:4:\"name\";s:9:\"San Mateo\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203132000\";}i:32;a:11:{s:4:\"code\";s:9:\"023133000\";s:4:\"name\";s:9:\"San Pablo\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203133000\";}i:33;a:11:{s:4:\"code\";s:9:\"023134000\";s:4:\"name\";s:11:\"Santa Maria\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203134000\";}i:34;a:11:{s:4:\"code\";s:9:\"023135000\";s:4:\"name\";s:16:\"City of Santiago\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:1;s:14:\"isMunicipality\";b:0;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203135000\";}i:35;a:11:{s:4:\"code\";s:9:\"023136000\";s:4:\"name\";s:11:\"Santo Tomas\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203136000\";}i:36;a:11:{s:4:\"code\";s:9:\"023137000\";s:4:\"name\";s:8:\"Tumauini\";s:7:\"oldName\";s:0:\"\";s:9:\"isCapital\";b:0;s:6:\"isCity\";b:0;s:14:\"isMunicipality\";b:1;s:12:\"provinceCode\";s:9:\"023100000\";s:12:\"districtCode\";b:0;s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203137000\";}}',1756810586),('farmtrack-cache-psgc:region:010000000:provinces','a:4:{i:0;a:5:{s:4:\"code\";s:9:\"012800000\";s:4:\"name\";s:12:\"Ilocos Norte\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0102800000\";}i:1;a:5:{s:4:\"code\";s:9:\"012900000\";s:4:\"name\";s:10:\"Ilocos Sur\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0102900000\";}i:2;a:5:{s:4:\"code\";s:9:\"013300000\";s:4:\"name\";s:8:\"La Union\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0103300000\";}i:3;a:5:{s:4:\"code\";s:9:\"015500000\";s:4:\"name\";s:10:\"Pangasinan\";s:10:\"regionCode\";s:9:\"010000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0105500000\";}}',1756809891),('farmtrack-cache-psgc:region:020000000:provinces','a:5:{i:0;a:5:{s:4:\"code\";s:9:\"020900000\";s:4:\"name\";s:7:\"Batanes\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0200900000\";}i:1;a:5:{s:4:\"code\";s:9:\"021500000\";s:4:\"name\";s:7:\"Cagayan\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0201500000\";}i:2;a:5:{s:4:\"code\";s:9:\"023100000\";s:4:\"name\";s:7:\"Isabela\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0203100000\";}i:3;a:5:{s:4:\"code\";s:9:\"025000000\";s:4:\"name\";s:13:\"Nueva Vizcaya\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0205000000\";}i:4;a:5:{s:4:\"code\";s:9:\"025700000\";s:4:\"name\";s:7:\"Quirino\";s:10:\"regionCode\";s:9:\"020000000\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0205700000\";}}',1756805958),('farmtrack-cache-psgc:regions','a:17:{i:0;a:5:{s:4:\"code\";s:9:\"010000000\";s:4:\"name\";s:13:\"Ilocos Region\";s:10:\"regionName\";s:8:\"Region I\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0100000000\";}i:1;a:5:{s:4:\"code\";s:9:\"020000000\";s:4:\"name\";s:14:\"Cagayan Valley\";s:10:\"regionName\";s:9:\"Region II\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0200000000\";}i:2;a:5:{s:4:\"code\";s:9:\"030000000\";s:4:\"name\";s:13:\"Central Luzon\";s:10:\"regionName\";s:10:\"Region III\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0300000000\";}i:3;a:5:{s:4:\"code\";s:9:\"040000000\";s:4:\"name\";s:10:\"CALABARZON\";s:10:\"regionName\";s:11:\"Region IV-A\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0400000000\";}i:4;a:5:{s:4:\"code\";s:9:\"170000000\";s:4:\"name\";s:15:\"MIMAROPA Region\";s:10:\"regionName\";s:15:\"MIMAROPA Region\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"1700000000\";}i:5;a:5:{s:4:\"code\";s:9:\"050000000\";s:4:\"name\";s:12:\"Bicol Region\";s:10:\"regionName\";s:8:\"Region V\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"0500000000\";}i:6;a:5:{s:4:\"code\";s:9:\"060000000\";s:4:\"name\";s:15:\"Western Visayas\";s:10:\"regionName\";s:9:\"Region VI\";s:15:\"islandGroupCode\";s:7:\"visayas\";s:15:\"psgc10DigitCode\";s:10:\"0600000000\";}i:7;a:5:{s:4:\"code\";s:9:\"070000000\";s:4:\"name\";s:15:\"Central Visayas\";s:10:\"regionName\";s:10:\"Region VII\";s:15:\"islandGroupCode\";s:7:\"visayas\";s:15:\"psgc10DigitCode\";s:10:\"0700000000\";}i:8;a:5:{s:4:\"code\";s:9:\"080000000\";s:4:\"name\";s:15:\"Eastern Visayas\";s:10:\"regionName\";s:11:\"Region VIII\";s:15:\"islandGroupCode\";s:7:\"visayas\";s:15:\"psgc10DigitCode\";s:10:\"0800000000\";}i:9;a:5:{s:4:\"code\";s:9:\"090000000\";s:4:\"name\";s:19:\"Zamboanga Peninsula\";s:10:\"regionName\";s:9:\"Region IX\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"0900000000\";}i:10;a:5:{s:4:\"code\";s:9:\"100000000\";s:4:\"name\";s:17:\"Northern Mindanao\";s:10:\"regionName\";s:8:\"Region X\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1000000000\";}i:11;a:5:{s:4:\"code\";s:9:\"110000000\";s:4:\"name\";s:12:\"Davao Region\";s:10:\"regionName\";s:9:\"Region XI\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1100000000\";}i:12;a:5:{s:4:\"code\";s:9:\"120000000\";s:4:\"name\";s:12:\"SOCCSKSARGEN\";s:10:\"regionName\";s:10:\"Region XII\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1200000000\";}i:13;a:5:{s:4:\"code\";s:9:\"130000000\";s:4:\"name\";s:3:\"NCR\";s:10:\"regionName\";s:23:\"National Capital Region\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"1300000000\";}i:14;a:5:{s:4:\"code\";s:9:\"140000000\";s:4:\"name\";s:3:\"CAR\";s:10:\"regionName\";s:32:\"Cordillera Administrative Region\";s:15:\"islandGroupCode\";s:5:\"luzon\";s:15:\"psgc10DigitCode\";s:10:\"1400000000\";}i:15;a:5:{s:4:\"code\";s:9:\"160000000\";s:4:\"name\";s:6:\"Caraga\";s:10:\"regionName\";s:11:\"Region XIII\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1600000000\";}i:16;a:5:{s:4:\"code\";s:9:\"150000000\";s:4:\"name\";s:5:\"BARMM\";s:10:\"regionName\";s:47:\"Bangsamoro Autonomous Region in Muslim Mindanao\";s:15:\"islandGroupCode\";s:8:\"mindanao\";s:15:\"psgc10DigitCode\";s:10:\"1900000000\";}}',1756805425);
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
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
INSERT INTO `enrollments` VALUES (1,'enrollments/lHaSy9dYTlYbZnfNY6pB8QEf1FofomsEGAP4GnEe.jpg','Viloria','Rodge Andru','Perdido',NULL,'male','69','Rico Street','Centro Ii (pob.)','Sanchez-mira','Cagayan','Cagayan Valley','0939 752 1414',NULL,'2004-05-08','Sanchez-mira, Cagayan, Philippines','Post graduate',NULL,'single','Pesca, Lyka P.','Perdido, Margarita Escalante',0,'Rogelio D. Viloria Jr.','Father',3,2,1,0,0,0,NULL,1,'National Id','12345',NULL,NULL,'farmworker',NULL,NULL,NULL,NULL,'[\"Land preparation\"]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'submitted','2025-08-31 22:22:02','2025-09-01 06:54:46'),(4,'enrollments/uyZEZ1VUuP6SSBhKIyshQQzKBCLzQDFlgSL0Mxnf.jpg','Viloria','Rodge Andru','Perdido','Jr','male','16','Marzan Street','Centro Ii (pob.)','Sanchez-mira','Cagayan','Cagayan Valley','0939 752 1414','+63 1234 1234','2004-05-07','Sanchez-mira, Cagayan, Philippines','Post graduate','Others: Igelsia Filipina Independiente','married','Pesca, Lyka P.','Perdido, Margarita Escalante',0,'Rogelio Dreu Viloria Jr.','Father',3,2,1,0,0,0,NULL,1,'National Id','12345','Peregrino, Gladys P.','0912 345 6789','farmer','[\"rice\"]','Wheat',NULL,'Chicken',NULL,NULL,NULL,NULL,'[\"part of a farming household\"]',NULL,12000.00,5000.00,'Roger Sanchez','Yve','Grock','submitted','2025-09-01 01:42:10','2025-09-01 07:01:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_parcel_items`
--

LOCK TABLES `farm_parcel_items` WRITE;
/*!40000 ALTER TABLE `farm_parcel_items` DISABLE KEYS */;
INSERT INTO `farm_parcel_items` VALUES (12,11,'crop','Wheat',2.00,NULL,'Rainfed',1,'Good','2025-09-01 07:01:49','2025-09-01 07:01:49'),(13,11,'crop','Rice',3.00,NULL,'Rainfed',1,'Eme','2025-09-01 07:01:49','2025-09-01 07:01:49'),(14,12,'poultry','Chicken',2.00,10,'Egg Farm',0,'Good','2025-09-01 07:01:49','2025-09-01 07:01:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_parcels`
--

LOCK TABLES `farm_parcels` WRITE;
/*!40000 ALTER TABLE `farm_parcels` DISABLE KEYS */;
INSERT INTO `farm_parcels` VALUES (11,4,'Centro II (Pob.)','Sanchez-Mira',5.00,'123',1,1,'registered_owner',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-09-01 07:01:49','2025-09-01 07:01:49'),(12,4,'Nagattatan','Pamplona',2.00,'123',1,1,'tenant',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2025-09-01 07:01:49','2025-09-01 07:01:49');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_07_30_093906_add_two_factor_columns_to_users_table',1),(5,'2025_07_30_093939_create_personal_access_tokens_table',1),(6,'2025_09_01_013854_create_news_table',2),(7,'2025_09_01_015251_add_is_admin_to_users_table',3),(8,'2025_09_01_015523_create_enrollments_table',4),(9,'2025_09_01_015530_create_farm_parcels_table',4),(10,'2025_09_01_051022_create_farm_parcel_items_table',5),(11,'2025_09_01_052144_update_farm_parcel_items_table_add_columns',6),(12,'2025_09_01_061551_add_status_to_enrollments_table',7);
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
  `audience` varchar(255) NOT NULL DEFAULT 'all',
  `priority` enum('normal','important','urgent') NOT NULL DEFAULT 'normal',
  `status` enum('draft','scheduled','published') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_slug_unique` (`slug`),
  KEY `news_published_at_index` (`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Pagasa Warns of Extended Rainfall, Farmers Urged to Protect Crops','pagasa-warns-of-extended-rainfall-farmers-urged-to-protect-crops-QPcuHy','The Philippine Atmospheric, Geophysical and Astronomical Services Administration (PAGASA) has issued an advisory warning of extended rainfall across Northern Luzon due to the southwest monsoon. Farmers are advised to secure their rice paddies and vegetable crops against possible flooding and waterlogging.\r\nAgricultural experts recommend using proper drainage systems and monitoring soil conditions to prevent crop damage. PAGASA added that while the rains may benefit some irrigated areas, excessive water could reduce yields if not managed properly.','news/T0GZnipFDqGxgTJ8ADMtg6U3vx2txzEmPsEm8GxE.jpg','[]','[\"water\",\"liquid\",\"scenery\",\"asf\",\"dasfasdfasdfasdfasgasdg\",\"ashghhhhhhhhhhhhhhhhhhhh hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh\"]','all','important','published','2025-09-01 06:09:48',NULL,'2025-09-01 06:06:42','2025-09-01 06:09:48');
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
INSERT INTO `sessions` VALUES ('3BDaFvAplJdQB5dzmgEOc5pIz4ElphPfb6DrlTRZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidmtjMUg4Y1lPMTlYd1BwRVg2c2U0bGtDME9VNlZmZzlNamVLV1JmRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736801),('3vWLTrBdn6Btsr5VrJdT3sPIhnHy1kJkwwelk1bu',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3Zvd3VTeXBoczZsVlA3VVJOclZxa3RFUGF6RldEeEEwam9NNmxvdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736926),('c0HUpdYvGIyMen2Y2WsdIlYcVT7kxl0DbxovoNAn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkgyTFR6NHRuamdJclluc0Nja3dhVUd5OEhvenE5RGtYeExPSHYwZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736270),('dI33RIgUhUVERUz0dXIyDNNHz8AAXgTEB6fscPW3',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDhDQXVEcjc1TG9hSFlWS1hTaVgwOGxJYk1LVmhnQmpIOXZQSkpaTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736323),('dlUvohcuwHgSBgQUmbsX8jMN97kiIP2APcWHoBT0',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUG5aVG1QQXV1ZHpiMjN5R2NZRjV1Mk5QQ0hFWThhTTRjeEVuUXFrTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736182),('dn3CLf3RvUKGBHIhE3aDxlxVVJPJfEdpURdcwkbh',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2tLRWg1ZVhhMVoxbkZXT2dzejlBc1ViaFNlYW1qNlQwZVgwckxSWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736119),('HiqBgpJVykWDYO4YmhdqqQ9TFcQ1pyipWwnyBlhs',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiclp1UzFVM2UyRnBINmF4bG5xand0ZkRRaTVSWWJpUFlzS003NDZYNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736152),('HOiSyZRWdmISHfHrkh6gnAif2Q3rlH6DMGUamYFl',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTlVSDY2clFUZDJxQktnQlQ4VmgzSEJ0NkliUWhzamJnV3BFMlo5NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736075),('HwQGadD1ING9uHDki3Pv1r59P8KUUicYuBXBnY0K',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWR6Y3VaT0RDVjlPaVR4V2NkWm9lVVBnMkk5SVAzb0pLU3ZsRzRsSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736117),('IBHyhENvmWlnPY5db9etL7gX8vfXLd2H9gfRTk8T',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ04zb3lDU2lJTlJWaGRUWGMxU2VoVEF1elVQdzVab3JPSjFmZTh3TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736115),('mPw6JcOuK8Bg4CnNnKl86ZoJsX51hVcGB8hlYjF9',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTE1TaUFMM2lZZWIwajVkMU0xUzN3ZWFOSUlMQUJFQXRuUFVndERJQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736943),('nkfWkAuExW7OoXWq1KlMaJLy2Q7iFTQA37t99iBe',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0NnTHMyYnM4bFROVHM2bktKUEdEbEpvaEFMM0lCU0Rsb2JteUlJWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736150),('NqKcCOXmgxycUO1dkOazly92zP4drxsgMZHyMglQ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOTRsVHE5MGdiYUREajk1eHI3R1FlTDJxNU81Skk3Y3RZbFhEcXVxZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736231),('PGTNZwTabUbyhPtRCluN1y2gQF5EkM8uqDvn8k9R',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUFlWT1p2MWFFRG5HSDkzamV6YnZDRVVTcEJid2hFdEJoc3NjVGptNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9uZXdzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRYLnB2YzVoOEZFclZSQ0hKZjJsQm5PZWxYVzI4bG9HalRvMnBZTUxKc3JCcEQ0VHlMdEttYSI7fQ==',1756739030),('qfTH9AZ8VwENjUfDYcyJPiQL9lu3W17z4rgqxFeI',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0pCNUM5eEUxcG1MWEJxdlFjd1I1QVp3MmtySHA4V2szdlFwb3Y2WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736172),('QNmGg540LbTqYK9PwUvMYI04fzJFUh2pRY0krO9s',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGVrdFNSN3liUWk4TVVwMW14ZkdDcE9VZ1dxdjdHU0lEZHlnTkRNaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736186),('QyazoQx7nPoPKcap5zsVYIbySStisT43l9qMcyWb',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEttZjhGb2ZNcnNHNjJ4QVpGQldwT2xidjNDVG1zU0p2blo5cTBubyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736078),('rYlbOjbbmSP3ZAnMBI689qBuBR7CjCttfEApLYR4',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVc3RkliUEdKSW1TbHlJaDNKZUxteEJnbGFUcXNSV1JlVlZXUmFmeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736076),('TpQHHNpOqRxPHpivTyu80p16HjxhTYbkTySGmLqj',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoieHAyTTd2WGt0ekprMFhpa0VjSUV2ZW9EMDM5Tkgyc1k5bmVQd21iRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736037),('uDnydGyHBQe6cEAtKLGArjNK216GCG9wbxrv1kWe',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidmdTVmJyc0l4Um1JSlQya0t2bnFGM3U5TjNhbFB0aVZpNXg2ZHNJdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736154),('VEYNog5XlaYUjnAKOJcErfnbLaGU8y2WkCTxzl2G',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVZoMzkxQzNZWjFHZFNvNXBTbmpCeHZxdURZR05kUFp4bkp0YmVhdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736228),('vvanVZMxXqdnrpV0y52ScpSS3RdKDiUgMX0V51Z2',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDJPeGJ1alNMWHpBQU0yekZUNEgxRHNSekJodkpYWHBzVmVabTc5ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736027),('YEhDarB61o35Bruf1FFkyYktH9Py6KxpWQENZMt5',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUpkZ3ZXRVVOWWNIOVpzTjJ4Zm9xRlFuam9vM09aVU1jWXBLenUxYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zdG9yYWdlL25ld3MvVDBHWm5pcEZEcUd4Z1RKOEFETXRnNlUzdngydHh6RW1Qc0VtOEd4RS5qcGciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1756736046);
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
INSERT INTO `users` VALUES (1,'Admin','admin@example.com',NULL,'$2y$12$X.pvc5h8FErVRCHJf2lBnOelXW28loGjTo2pYMLJsrBpD4TyLtKma',1,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-31 18:02:49','2025-08-31 18:02:49');
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

-- Dump completed on 2025-09-01 23:13:35
