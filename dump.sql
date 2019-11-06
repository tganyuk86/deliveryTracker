-- MySQL dump 10.13  Distrib 8.0.17, for macos10.14 (x86_64)
--
-- Host: localhost    Database: deliverytracker
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),(2,1,'name','text','Name',1,1,1,1,1,1,NULL,2),(3,1,'email','text','Email',1,1,1,1,1,1,NULL,3),(4,1,'password','password','Password',1,0,0,1,1,0,NULL,4),(5,1,'remember_token','text','Remember Token',0,0,0,0,0,0,NULL,5),(6,1,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(7,1,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(8,1,'avatar','image','Avatar',0,1,1,1,1,1,NULL,8),(9,1,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}',10),(10,1,'user_belongstomany_role_relationship','relationship','Roles',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}',11),(11,1,'settings','hidden','Settings',0,0,0,0,0,0,NULL,12),(12,2,'id','number','ID',1,0,0,0,0,0,NULL,1),(13,2,'name','text','Name',1,1,1,1,1,1,NULL,2),(14,2,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(15,2,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(16,3,'id','number','ID',1,0,0,0,0,0,NULL,1),(17,3,'name','text','Name',1,1,1,1,1,1,NULL,2),(18,3,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(19,3,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(20,3,'display_name','text','Display Name',1,1,1,1,1,1,NULL,5),(21,1,'role_id','text','Role',1,1,1,1,1,1,NULL,9),(22,4,'id','text','Id',1,0,0,0,0,0,'{}',1),(23,4,'name','text','Name',0,1,1,1,1,1,'{}',2),(24,4,'lat','timestamp','Lat',1,1,1,1,1,1,'{}',3),(25,4,'lon','timestamp','Lon',1,1,1,1,1,1,'{}',4),(26,4,'called_at','timestamp','Called At',0,1,1,1,1,1,'{}',5),(27,4,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',6),(28,4,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',7),(29,4,'order','text_area','Order',0,1,1,1,1,1,'{}',8),(30,4,'value','number','Value',0,1,1,1,1,1,'{}',9),(31,6,'id','number','Id',1,1,0,0,0,0,'{}',1),(32,6,'name','text','Name',0,1,1,1,1,1,'{}',2),(33,6,'created_at','timestamp','Created At',0,1,1,1,0,1,'{}',3),(34,6,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',4),(35,5,'id','text','Id',1,0,0,0,0,0,'{}',1),(38,5,'price','text','Price',0,1,1,1,1,1,'{}',8),(39,5,'created_at','timestamp','Created At',0,0,0,0,0,0,'{}',4),(40,5,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',5),(41,7,'id','number','Id',1,1,0,0,0,0,'{}',1),(42,7,'name','text','Name',1,1,1,1,1,1,'{}',2),(43,7,'created_at','timestamp','Created At',0,0,0,0,0,0,'{}',3),(44,7,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',4),(45,5,'stock_hasone_product_relationship','relationship','products',0,1,1,1,1,1,'{\"model\":\"App\\\\Product\",\"table\":\"products\",\"type\":\"belongsTo\",\"column\":\"productID\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"data_rows\",\"pivot\":\"0\",\"taggable\":\"0\"}',6),(46,5,'productID','text','ProductID',0,0,0,0,0,0,'{}',2),(47,5,'typeID','text','TypeID',0,0,0,0,0,0,'{}',3),(48,5,'stock_hasone_stocktype_relationship','relationship','stockTypes',0,1,1,1,1,1,'{\"model\":\"App\\\\StockType\",\"table\":\"stockTypes\",\"type\":\"belongsTo\",\"column\":\"typeID\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"data_rows\",\"pivot\":\"0\",\"taggable\":\"0\"}',7);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','TCG\\Voyager\\Http\\Controllers\\VoyagerUserController','',1,0,NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(2,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(3,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'','',1,0,NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(4,'locations','locations','Location','Locations',NULL,'App\\Location',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-11-04 23:41:11','2019-11-05 00:20:54'),(5,'stock','stock','Stock','Stocks',NULL,'App\\Stock',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-11-05 00:21:29','2019-11-05 02:33:28'),(6,'stockTypes','stocktypes','Stocktype','Stocktypes',NULL,'App\\StockType',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-11-05 00:21:37','2019-11-05 02:07:26'),(7,'products','products','Product','Products',NULL,'App\\Product',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}','2019-11-05 02:10:30','2019-11-05 02:10:30');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `called_at` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (6,'236 Cedric Ave, York, ON M6C 3Y1, Canada','43.6907637','-79.43814900000001','20:10:17','2019-11-07 01:10:21','2019-11-07 01:10:21',NULL,NULL),(7,'17 Lascelles Blvd, Toronto, ON M4V 2B6, Canada','43.6949411','-79.39894979999997','20:10:23','2019-11-07 01:10:29','2019-11-07 01:10:29',NULL,NULL);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,NULL,5,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.media.index',NULL),(3,1,'Users','','_self','voyager-person',NULL,NULL,3,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.users.index',NULL),(4,1,'Roles','','_self','voyager-lock',NULL,NULL,2,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.roles.index',NULL),(5,1,'Tools','','_self','voyager-tools',NULL,NULL,9,'2019-11-04 20:16:49','2019-11-04 20:16:49',NULL,NULL),(6,1,'Menu Builder','','_self','voyager-list',NULL,5,10,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.menus.index',NULL),(7,1,'Database','','_self','voyager-data',NULL,5,11,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.database.index',NULL),(8,1,'Compass','','_self','voyager-compass',NULL,5,12,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.compass.index',NULL),(9,1,'BREAD','','_self','voyager-bread',NULL,5,13,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.bread.index',NULL),(10,1,'Settings','','_self','voyager-settings',NULL,NULL,14,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.settings.index',NULL),(11,1,'Hooks','','_self','voyager-hook',NULL,5,13,'2019-11-04 20:16:49','2019-11-04 20:16:49','voyager.hooks',NULL),(12,1,'Locations','','_self',NULL,NULL,NULL,15,'2019-11-04 23:41:12','2019-11-04 23:41:12','voyager.locations.index',NULL),(13,1,'Stocks','','_self',NULL,NULL,NULL,16,'2019-11-05 00:21:29','2019-11-05 00:21:29','voyager.stock.index',NULL),(14,1,'Stocktypes','','_self',NULL,NULL,NULL,17,'2019-11-05 00:21:37','2019-11-05 00:21:37','voyager.stocktypes.index',NULL),(15,1,'Products','','_self',NULL,NULL,NULL,18,'2019-11-05 02:10:30','2019-11-05 02:10:30','voyager.products.index',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2019-11-04 20:16:49','2019-11-04 20:16:49');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_01_000000_add_voyager_user_fields',1),(4,'2016_01_01_000000_create_data_types_table',1),(5,'2016_05_19_173453_create_menu_table',1),(6,'2016_10_21_190000_create_roles_table',1),(7,'2016_10_21_190000_create_settings_table',1),(8,'2016_11_30_135954_create_permission_table',1),(9,'2016_11_30_141208_create_permission_role_table',1),(10,'2016_12_26_201236_data_types__add__server_side',1),(11,'2017_01_13_000000_add_route_to_menu_items_table',1),(12,'2017_01_14_005015_create_translations_table',1),(13,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),(14,'2017_03_06_000000_add_controller_to_data_types_table',1),(15,'2017_04_21_000000_add_order_to_data_rows_table',1),(16,'2017_07_05_210000_add_policyname_to_data_types_table',1),(17,'2017_08_05_000000_add_group_to_settings_table',1),(18,'2017_11_26_013050_add_user_role_relationship',1),(19,'2017_11_26_015000_create_user_roles_table',1),(20,'2018_03_11_000000_add_user_settings',1),(21,'2018_03_14_000000_add_details_to_data_types_table',1),(22,'2018_03_16_000000_make_settings_value_nullable',1),(23,'2019_08_19_000000_create_failed_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(2,'browse_bread',NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(3,'browse_database',NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(4,'browse_media',NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(5,'browse_compass',NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(6,'browse_menus','menus','2019-11-04 20:16:49','2019-11-04 20:16:49'),(7,'read_menus','menus','2019-11-04 20:16:49','2019-11-04 20:16:49'),(8,'edit_menus','menus','2019-11-04 20:16:49','2019-11-04 20:16:49'),(9,'add_menus','menus','2019-11-04 20:16:49','2019-11-04 20:16:49'),(10,'delete_menus','menus','2019-11-04 20:16:49','2019-11-04 20:16:49'),(11,'browse_roles','roles','2019-11-04 20:16:49','2019-11-04 20:16:49'),(12,'read_roles','roles','2019-11-04 20:16:49','2019-11-04 20:16:49'),(13,'edit_roles','roles','2019-11-04 20:16:49','2019-11-04 20:16:49'),(14,'add_roles','roles','2019-11-04 20:16:49','2019-11-04 20:16:49'),(15,'delete_roles','roles','2019-11-04 20:16:49','2019-11-04 20:16:49'),(16,'browse_users','users','2019-11-04 20:16:49','2019-11-04 20:16:49'),(17,'read_users','users','2019-11-04 20:16:49','2019-11-04 20:16:49'),(18,'edit_users','users','2019-11-04 20:16:49','2019-11-04 20:16:49'),(19,'add_users','users','2019-11-04 20:16:49','2019-11-04 20:16:49'),(20,'delete_users','users','2019-11-04 20:16:49','2019-11-04 20:16:49'),(21,'browse_settings','settings','2019-11-04 20:16:49','2019-11-04 20:16:49'),(22,'read_settings','settings','2019-11-04 20:16:49','2019-11-04 20:16:49'),(23,'edit_settings','settings','2019-11-04 20:16:49','2019-11-04 20:16:49'),(24,'add_settings','settings','2019-11-04 20:16:49','2019-11-04 20:16:49'),(25,'delete_settings','settings','2019-11-04 20:16:49','2019-11-04 20:16:49'),(26,'browse_hooks',NULL,'2019-11-04 20:16:49','2019-11-04 20:16:49'),(27,'browse_locations','locations','2019-11-04 23:41:11','2019-11-04 23:41:11'),(28,'read_locations','locations','2019-11-04 23:41:11','2019-11-04 23:41:11'),(29,'edit_locations','locations','2019-11-04 23:41:11','2019-11-04 23:41:11'),(30,'add_locations','locations','2019-11-04 23:41:11','2019-11-04 23:41:11'),(31,'delete_locations','locations','2019-11-04 23:41:11','2019-11-04 23:41:11'),(32,'browse_stock','stock','2019-11-05 00:21:29','2019-11-05 00:21:29'),(33,'read_stock','stock','2019-11-05 00:21:29','2019-11-05 00:21:29'),(34,'edit_stock','stock','2019-11-05 00:21:29','2019-11-05 00:21:29'),(35,'add_stock','stock','2019-11-05 00:21:29','2019-11-05 00:21:29'),(36,'delete_stock','stock','2019-11-05 00:21:29','2019-11-05 00:21:29'),(37,'browse_stockTypes','stockTypes','2019-11-05 00:21:37','2019-11-05 00:21:37'),(38,'read_stockTypes','stockTypes','2019-11-05 00:21:37','2019-11-05 00:21:37'),(39,'edit_stockTypes','stockTypes','2019-11-05 00:21:37','2019-11-05 00:21:37'),(40,'add_stockTypes','stockTypes','2019-11-05 00:21:37','2019-11-05 00:21:37'),(41,'delete_stockTypes','stockTypes','2019-11-05 00:21:37','2019-11-05 00:21:37'),(42,'browse_products','products','2019-11-05 02:10:30','2019-11-05 02:10:30'),(43,'read_products','products','2019-11-05 02:10:30','2019-11-05 02:10:30'),(44,'edit_products','products','2019-11-05 02:10:30','2019-11-05 02:10:30'),(45,'add_products','products','2019-11-05 02:10:30','2019-11-05 02:10:30'),(46,'delete_products','products','2019-11-05 02:10:30','2019-11-05 02:10:30');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Product 1','2019-11-05 02:10:46','2019-11-05 02:10:46'),(2,'Product 2','2019-11-07 01:43:44','2019-11-07 01:43:44');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2019-11-04 20:16:49','2019-11-04 20:16:49'),(2,'user','Normal User','2019-11-04 20:16:49','2019-11-04 20:16:49');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Site Title','Site Title','','text',1,'Site'),(2,'site.description','Site Description','Site Description','','text',2,'Site'),(3,'site.logo','Site Logo','','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','','','text',4,'Site'),(5,'admin.bg_image','Admin Background Image','','','image',5,'Admin'),(6,'admin.title','Admin Title','Voyager','','text',1,'Admin'),(7,'admin.description','Admin Description','Welcome to Voyager. The Missing Admin for Laravel','','text',2,'Admin'),(8,'admin.loader','Admin Loader','','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','','','text',1,'Admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `typeID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (2,'1','1',150,'2019-11-05 02:23:41','2019-11-05 02:23:41'),(3,'1','2',45,'2019-11-05 02:27:47','2019-11-05 02:27:47'),(5,'2','2',50,'2019-11-07 02:24:10','2019-11-07 02:24:10');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockTypes`
--

DROP TABLE IF EXISTS `stockTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stockTypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockTypes`
--

LOCK TABLES `stockTypes` WRITE;
/*!40000 ALTER TABLE `stockTypes` DISABLE KEYS */;
INSERT INTO `stockTypes` VALUES (1,'Quarter','2019-11-05 00:24:14','2019-11-05 00:24:14'),(2,'Half Quarter','2019-11-05 00:24:25','2019-11-05 00:24:25'),(3,'Oz','2019-11-05 00:24:40','2019-11-05 00:24:40'),(4,'Half Oz','2019-11-05 00:24:47','2019-11-05 00:24:47');
/*!40000 ALTER TABLE `stockTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,1,'admin','admin@admin.com','users/default.png',NULL,'$2y$10$NWTuXwX8BmwyN9XSGo/6TuA.WYAeyuhxLYyoW3VLKr0SVyGJPBoau',NULL,NULL,'2019-11-04 20:46:51','2019-11-04 20:46:51');
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

-- Dump completed on 2019-11-06 16:49:00
