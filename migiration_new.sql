-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: foodomaa
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

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
-- Table structure for table `accept_deliveries`
--

DROP TABLE IF EXISTS `accept_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accept_deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accept_deliveries_order_id_unique` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accept_deliveries`
--

LOCK TABLES `accept_deliveries` WRITE;
/*!40000 ALTER TABLE `accept_deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `accept_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addon_categories`
--

DROP TABLE IF EXISTS `addon_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addon_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addon_categories`
--

LOCK TABLES `addon_categories` WRITE;
/*!40000 ALTER TABLE `addon_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `addon_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addon_category_item`
--

DROP TABLE IF EXISTS `addon_category_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addon_category_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addon_category_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addon_category_item`
--

LOCK TABLES `addon_category_item` WRITE;
/*!40000 ALTER TABLE `addon_category_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `addon_category_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `addon_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `house` text COLLATE utf8mb4_unicode_ci,
  `landmark` text COLLATE utf8mb4_unicode_ci,
  `tag` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,3,'Torsgatan 10, 111 23 Stockholm, Sweden',NULL,NULL,NULL,'2020-05-29 15:18:05','2020-05-29 15:18:05','59.335785594586234','18.051017691213875');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alerts`
--

DROP TABLE IF EXISTS `alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alerts`
--

LOCK TABLES `alerts` WRITE;
/*!40000 ALTER TABLE `alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `max_count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_collection_logs`
--

DROP TABLE IF EXISTS `delivery_collection_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_collection_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_collection_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_collection_logs`
--

LOCK TABLES `delivery_collection_logs` WRITE;
/*!40000 ALTER TABLE `delivery_collection_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_collection_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_collections`
--

DROP TABLE IF EXISTS `delivery_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_collections`
--

LOCK TABLES `delivery_collections` WRITE;
/*!40000 ALTER TABLE `delivery_collections` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_guy_details`
--

DROP TABLE IF EXISTS `delivery_guy_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_guy_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission_rate` decimal(8,2) NOT NULL DEFAULT '5.00',
  `is_notifiable` tinyint(1) DEFAULT '0',
  `max_accept_delivery_limit` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_guy_details`
--

LOCK TABLES `delivery_guy_details` WRITE;
/*!40000 ALTER TABLE `delivery_guy_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_guy_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gps_tables`
--

DROP TABLE IF EXISTS `gps_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gps_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gps_tables`
--

LOCK TABLES `gps_tables` WRITE;
/*!40000 ALTER TABLE `gps_tables` DISABLE KEYS */;
INSERT INTO `gps_tables` VALUES (1,1,NULL,NULL,NULL,NULL,'2020-05-29 15:18:20','2020-05-29 15:18:20',NULL),(2,2,NULL,NULL,NULL,NULL,'2020-05-29 15:20:22','2020-05-29 15:20:22',NULL),(3,3,NULL,NULL,NULL,NULL,'2020-06-16 20:25:05','2020-06-16 20:25:05',NULL),(4,4,NULL,NULL,NULL,NULL,'2020-06-17 03:17:44','2020-06-17 03:17:44',NULL),(5,5,NULL,NULL,NULL,NULL,'2020-06-18 04:17:26','2020-06-18 04:17:26',NULL);
/*!40000 ALTER TABLE `gps_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_categories`
--

DROP TABLE IF EXISTS `item_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_categories`
--

LOCK TABLES `item_categories` WRITE;
/*!40000 ALTER TABLE `item_categories` DISABLE KEYS */;
INSERT INTO `item_categories` VALUES (1,'Burger',1,'2020-05-29 15:15:19','2020-05-29 15:15:19',2);
/*!40000 ALTER TABLE `item_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `item_category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `old_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_recommended` tinyint(1) NOT NULL,
  `is_popular` tinyint(1) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci,
  `placeholder_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_veg` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,1,'Whooper',5.00,0.00,'/assets/img/items/15907581849YnqyFi4K8.jpg',1,1,1,'2020-05-29 15:16:24','2020-05-29 15:16:24',NULL,NULL,1,0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_11_06_222923_create_transactions_table',1),(4,'2018_11_07_192923_create_transfers_table',1),(5,'2018_11_07_202152_update_transfers_table',1),(6,'2018_11_15_124230_create_wallets_table',1),(7,'2018_11_19_164609_update_transactions_table',1),(8,'2018_11_20_133759_add_fee_transfers_table',1),(9,'2018_11_22_131953_add_status_transfers_table',1),(10,'2018_11_22_133438_drop_refund_transfers_table',1),(11,'2019_01_19_062844_create_settings_table',1),(12,'2019_01_19_132750_create_locations_table',1),(13,'2019_01_21_055516_create_promo_sliders_table',1),(14,'2019_01_21_073753_create_restaurants_table',1),(15,'2019_01_22_045205_add_slug_to_restaurants_table',1),(16,'2019_01_26_103144_create_items_table',1),(17,'2019_01_26_103412_create_item_categories_table',1),(18,'2019_02_01_095905_add_extras_to_items_table',1),(19,'2019_02_01_103027_add_placeholder_image_to_restaurants_table',1),(20,'2019_02_02_032957_add_lat_long_to_restaurants_table',1),(21,'2019_02_02_033139_add_certificate_to_restaurants_table',1),(22,'2019_02_08_061116_add_restaurant_charges_to_restaurants_table',1),(23,'2019_02_08_101537_create_coupons_table',1),(24,'2019_02_16_042718_add_auth_token_to_users_table',1),(25,'2019_02_17_031843_add_phobe_number_to_users_table',1),(26,'2019_02_18_054807_create_pages_table',1),(27,'2019_02_19_084731_create_orders_table',1),(28,'2019_02_19_084930_create_orderstatuses_table',1),(29,'2019_02_19_085232_create_orderitems_table',1),(30,'2019_02_20_044738_create_addresses_table',1),(31,'2019_02_20_104553_add_default_address_id_to_users_table',1),(32,'2019_02_25_051228_add_payment_mode_to_orders_table',1),(33,'2019_02_28_053038_add_order_comment_to_orders_table',1),(34,'2019_05_13_111553_update_status_transfers_table',1),(35,'2019_05_21_074923_create_permission_tables',1),(36,'2019_06_25_103755_add_exchange_status_transfers_table',1),(37,'2019_07_09_054236_create_payment_gateways_table',1),(38,'2019_07_11_054103_create_user_restaurant_table',1),(39,'2019_07_11_135603_add_restaurant_id_to_orders_table',1),(40,'2019_07_13_054323_add_delivery_pin_to_users_table',1),(41,'2019_07_13_135125_create_gps_tables_table',1),(42,'2019_07_15_053733_create_accept_deliveries_table',1),(43,'2019_07_16_062435_add_address_pincode_landmark_to_restaurants_table',1),(44,'2019_07_23_030953_create_slides_table',1),(45,'2019_07_24_031824_add_sku_to_restaurants_table',1),(46,'2019_07_29_184926_decimal_places_wallets_table',1),(47,'2019_07_31_032042_add_is_active_to_restaurants_table',1),(48,'2019_08_11_172547_add_transaction_id_to_orders_table',1),(49,'2019_08_13_130103_add_is_accepted_to_restaurants_table',1),(50,'2019_08_13_140046_add_is_active_to_items_table',1),(51,'2019_08_14_093404_add_restaurant_id_to_coupons_table',1),(52,'2019_08_14_112249_add_count_to_coupons_table',1),(53,'2019_08_16_105252_create_push_tokens_table',1),(54,'2019_08_18_102353_add_is_featured_to_restaurants_table',1),(55,'2019_08_20_084106_add_user_id_to_itemcategories_table',1),(56,'2019_08_24_182445_add_location_id_to_promo_sliders_table',1),(57,'2019_09_15_044915_create_addons_table',1),(58,'2019_09_18_234250_create_addon_categories_table',1),(59,'2019_09_19_000319_create_addon_category_item_table',1),(60,'2019_09_20_054300_create_order_item_addons_table',1),(61,'2019_09_23_225754_create_restaurant_earnings_table',1),(62,'2019_09_25_005540_add_commission_rate_to_restaurants_table',1),(63,'2019_09_25_014138_create_restaurant_payouts_table',1),(64,'2019_09_25_025705_add_restaurant_payout_id_to_restaurant_earnings_table',1),(65,'2019_10_02_193759_add_discount_transfers_table',1),(66,'2019_11_06_232008_add_delivery_type_to_restaurants_table',1),(67,'2019_11_07_050958_add_delivery_type_to_orders_table',1),(68,'2019_11_08_022754_create_delivery_guy_details_table',1),(69,'2019_11_08_023100_add_delivery_guy_detail_id_to_users_table',1),(70,'2019_11_17_223225_add_nullable_constraint_to_pincode_landmark_in_restaurants_table',1),(71,'2019_11_20_042206_add_payable_to_orders_table',1),(72,'2019_11_28_052028_add_delivery_radius_to_restaurants_table',1),(73,'2019_12_02_015709_add_lat_lng_to_addresses_table',1),(74,'2019_12_05_223129_add_gps_delivery_charges_fields_to_restaurants_table',1),(75,'2019_12_09_000038_create_popular_geo_places_table',1),(76,'2019_12_13_043245_add_postion_id_and_size_to_promo_sliders_table',1),(77,'2019_12_15_223236_add_long_text_constrait_for_body_to_pages_table',1),(78,'2019_12_18_002035_create_translations_table',1),(79,'2019_12_18_011559_add_default_language_and_is_active_to_translations_table',1),(80,'2019_12_19_221313_change_desc_contraints_to_items_table',1),(81,'2019_12_20_061211_add_commission_rate_to_delivery_guy_details_table',1),(82,'2019_12_29_063818_create_modules_table',1),(83,'2019_12_29_233803_create_ratings_table',1),(84,'2019_12_30_235034_change_price_constraints_on_every_table_increase_limit',1),(85,'2020_01_05_223346_create_delivery_collections_table',1),(86,'2020_01_05_223712_create_delivery_collection_logs_table',1),(87,'2020_01_06_005737_create_restaurant_categories_table',1),(88,'2020_01_06_012659_create_restaurant_category_restaurant_table',1),(89,'2020_01_06_024126_create_restaurant_category_sliders_table',1),(90,'2020_01_12_225036_create_password_reset_otps_table',1),(91,'2020_01_26_055400_change_constraints_of_location_in_orders_table',1),(92,'2020_01_28_075230_add_short_name_and_code_to_modules_table',1),(93,'2020_02_03_223654_add_old_price_to_items_table',1),(94,'2020_02_07_003016_add_is_veg_to_items_table',1),(95,'2020_02_14_014122_add_heading_column_to_gps_tables',1),(96,'2020_03_13_234146_change_address_constraints_on_addresses_table',1),(97,'2020_03_31_001623_add_min_order_price_to_restaurants_table',1),(98,'2020_04_01_011619_create_alerts_table',1),(99,'2020_04_09_125640_create_sms_otps_table',1),(100,'2020_04_09_125652_create_sms_gateways_table',1),(101,'2020_04_15_120225_change_restaurant_owner_role_to_store_owner',1),(102,'2020_04_15_184850_change_order_id_constraints_in_accept_deliveries_table',1),(103,'2020_04_17_140857_add_is_sms_notifiable_to_restaurants_table',1),(104,'2020_04_17_141115_add_is_sms_notifiable_to_delivery_guy_details_table',1),(105,'2020_04_19_113902_add_auto_acceptable_to_restaurants_table',1),(106,'2020_04_21_132439_add_max_accept_delivery_limit_to_delivery_guy_details_table',1),(107,'2020_04_25_161840_add_is_active_to_addons_table',1),(108,'2020_05_06_123402_change_columns_datatypes_for_many_tables',1),(109,'2020_05_06_125302_add_schedule_data_to_restaurants_table',1),(110,'2020_05_06_125339_add_is_schedulable_to_restaurants_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(3,'App\\User',2),(4,'App\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_installed` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings_path` longtext COLLATE utf8mb4_unicode_ci,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item_addons`
--

DROP TABLE IF EXISTS `order_item_addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderitem_id` int(11) NOT NULL,
  `addon_category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_price` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item_addons`
--

LOCK TABLES `order_item_addons` WRITE;
/*!40000 ALTER TABLE `order_item_addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_item_addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderitems`
--

LOCK TABLES `orderitems` WRITE;
/*!40000 ALTER TABLE `orderitems` DISABLE KEYS */;
INSERT INTO `orderitems` VALUES (1,1,1,'Whooper',2,5.00,'2020-05-29 15:18:20','2020-05-29 15:18:20'),(2,2,1,'Whooper',3,5.00,'2020-05-29 15:20:22','2020-05-29 15:20:22'),(3,3,1,'Whooper',4,5.00,'2020-06-16 20:25:05','2020-06-16 20:25:05'),(4,4,1,'Whooper',5,5.00,'2020-06-17 03:17:44','2020-06-17 03:17:44'),(5,5,1,'Whooper',9,5.00,'2020-06-18 04:17:26','2020-06-18 04:17:26');
/*!40000 ALTER TABLE `orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unique_order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderstatus_id` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `coupon_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` mediumtext COLLATE utf8mb4_unicode_ci,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` decimal(20,2) DEFAULT NULL,
  `restaurant_charge` decimal(20,2) DEFAULT NULL,
  `delivery_charge` decimal(20,2) DEFAULT NULL,
  `total` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_comment` text COLLATE utf8mb4_unicode_ci,
  `restaurant_id` int(11) DEFAULT NULL,
  `transaction_id` text COLLATE utf8mb4_unicode_ci,
  `delivery_type` int(11) NOT NULL DEFAULT '1',
  `payable` decimal(20,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'OD-05-29-0VTY-JA53QE3MB',2,3,NULL,'{\"lat\":\"59.335785594586234\",\"lng\":\"18.051017691213875\",\"address\":\"Torsgatan 10, 111 23 Stockholm, Sweden\",\"house\":null,\"tag\":null}',', Torsgatan 10, 111 23 Stockholm, Sweden',NULL,4.00,NULL,14.00,'2020-05-29 15:18:20','2020-05-29 15:19:48','COD',NULL,1,NULL,1,14.00),(2,'OD-05-29-YTNS-7PGRYEROJ',1,3,NULL,'{\"lat\":\"59.335785594586234\",\"lng\":\"18.051017691213875\",\"address\":\"Torsgatan 10, 111 23 Stockholm, Sweden\",\"house\":null,\"tag\":null}',', Torsgatan 10, 111 23 Stockholm, Sweden',NULL,4.00,NULL,19.00,'2020-05-29 15:20:22','2020-05-29 15:20:22','COD',NULL,1,NULL,1,19.00),(3,'OD-06-16-BYWC-M14KBZK6W',1,3,NULL,'{\"lat\":\"59.335785594586234\",\"lng\":\"18.051017691213875\",\"address\":\"Torsgatan 10, 111 23 Stockholm, Sweden\",\"house\":null,\"tag\":null}',', Torsgatan 10, 111 23 Stockholm, Sweden',NULL,4.00,NULL,24.00,'2020-06-16 20:25:05','2020-06-16 20:25:05','COD',NULL,1,NULL,1,24.00),(4,'OD-06-17-JITE-OGZRGORV5',2,3,NULL,'{\"lat\":\"59.335785594586234\",\"lng\":\"18.051017691213875\",\"address\":\"Torsgatan 10, 111 23 Stockholm, Sweden\",\"house\":null,\"tag\":null}',', Torsgatan 10, 111 23 Stockholm, Sweden',NULL,4.00,NULL,29.00,'2020-06-17 03:17:44','2020-06-19 15:14:21','COD',NULL,1,NULL,1,29.00),(5,'OD-06-18-KJ6J-EYVRV13R9',2,3,NULL,'{\"lat\":\"59.335785594586234\",\"lng\":\"18.051017691213875\",\"address\":\"Torsgatan 10, 111 23 Stockholm, Sweden\",\"house\":null,\"tag\":null}',', Torsgatan 10, 111 23 Stockholm, Sweden',NULL,4.00,NULL,49.00,'2020-06-18 04:17:26','2020-06-19 08:46:18','COD',NULL,1,NULL,1,49.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderstatuses`
--

DROP TABLE IF EXISTS `orderstatuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderstatuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderstatuses`
--

LOCK TABLES `orderstatuses` WRITE;
/*!40000 ALTER TABLE `orderstatuses` DISABLE KEYS */;
INSERT INTO `orderstatuses` VALUES (1,'Ready For Pick Up'),(2,'Ready For Pick Up'),(3,'Ready For Pick Up'),(4,'Ready For Pick Up'),(5,'Ready For Pick Up');
/*!40000 ALTER TABLE `orderstatuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_otps`
--

DROP TABLE IF EXISTS `password_reset_otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_otps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_otps`
--

LOCK TABLES `password_reset_otps` WRITE;
/*!40000 ALTER TABLE `password_reset_otps` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_otps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_gateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_gateways`
--

LOCK TABLES `payment_gateways` WRITE;
/*!40000 ALTER TABLE `payment_gateways` DISABLE KEYS */;
INSERT INTO `payment_gateways` VALUES (1,'COD','Cash On Delivery Payment',NULL,1,'2020-05-29 08:22:59','2020-05-29 08:22:59'),(2,'Stripe','Online Payment with Stripe',NULL,0,'2020-05-29 08:22:59','2020-05-29 08:22:59'),(3,'Paypal','Paypal Express Checkout',NULL,0,'2020-05-29 08:22:59','2020-05-29 08:22:59'),(4,'PayStack','PayStack Payment Gateway',NULL,0,'2020-05-29 08:22:59','2020-05-29 08:22:59'),(5,'Razorpay','PayStack Payment Gateway',NULL,0,'2020-05-29 08:22:59','2020-05-29 08:22:59');
/*!40000 ALTER TABLE `payment_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `popular_geo_places`
--

DROP TABLE IF EXISTS `popular_geo_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `popular_geo_places` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `popular_geo_places`
--

LOCK TABLES `popular_geo_places` WRITE;
/*!40000 ALTER TABLE `popular_geo_places` DISABLE KEYS */;
/*!40000 ALTER TABLE `popular_geo_places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_sliders`
--

DROP TABLE IF EXISTS `promo_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `position_id` int(11) NOT NULL DEFAULT '0',
  `size` int(11) NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_sliders`
--

LOCK TABLES `promo_sliders` WRITE;
/*!40000 ALTER TABLE `promo_sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_tokens`
--

DROP TABLE IF EXISTS `push_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_tokens`
--

LOCK TABLES `push_tokens` WRITE;
/*!40000 ALTER TABLE `push_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `rateable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`),
  KEY `ratings_rateable_id_index` (`rateable_id`),
  KEY `ratings_rateable_type_index` (`rateable_type`),
  KEY `ratings_user_id_foreign` (`user_id`),
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_categories`
--

DROP TABLE IF EXISTS `restaurant_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_categories`
--

LOCK TABLES `restaurant_categories` WRITE;
/*!40000 ALTER TABLE `restaurant_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_category_restaurant`
--

DROP TABLE IF EXISTS `restaurant_category_restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_category_restaurant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_category_id` int(10) unsigned NOT NULL,
  `restaurant_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_category_restaurant`
--

LOCK TABLES `restaurant_category_restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant_category_restaurant` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_category_restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_category_sliders`
--

DROP TABLE IF EXISTS `restaurant_category_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_category_sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_placeholder` text COLLATE utf8mb4_unicode_ci,
  `categories_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_category_sliders`
--

LOCK TABLES `restaurant_category_sliders` WRITE;
/*!40000 ALTER TABLE `restaurant_category_sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_category_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_earnings`
--

DROP TABLE IF EXISTS `restaurant_earnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_earnings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `is_requested` tinyint(1) NOT NULL DEFAULT '0',
  `is_processed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `restaurant_payout_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_earnings`
--

LOCK TABLES `restaurant_earnings` WRITE;
/*!40000 ALTER TABLE `restaurant_earnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_earnings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_payouts`
--

DROP TABLE IF EXISTS `restaurant_payouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_payouts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `restaurant_earning_id` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` longtext COLLATE utf8mb4_unicode_ci,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_payouts`
--

LOCK TABLES `restaurant_payouts` WRITE;
/*!40000 ALTER TABLE `restaurant_payouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_payouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_user`
--

DROP TABLE IF EXISTS `restaurant_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `restaurant_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_user`
--

LOCK TABLES `restaurant_user` WRITE;
/*!40000 ALTER TABLE `restaurant_user` DISABLE KEYS */;
INSERT INTO `restaurant_user` VALUES (1,2,1,NULL,NULL);
/*!40000 ALTER TABLE `restaurant_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_range` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pureveg` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `placeholder_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_charges` decimal(20,2) DEFAULT NULL,
  `delivery_charges` decimal(20,2) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `commission_rate` decimal(8,2) NOT NULL DEFAULT '0.00',
  `delivery_type` int(11) NOT NULL DEFAULT '1',
  `delivery_radius` decimal(8,2) NOT NULL DEFAULT '10.00',
  `delivery_charge_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FIXED',
  `base_delivery_charge` decimal(20,2) DEFAULT NULL,
  `base_delivery_distance` int(11) DEFAULT NULL,
  `extra_delivery_charge` decimal(20,2) DEFAULT NULL,
  `extra_delivery_distance` int(11) DEFAULT NULL,
  `min_order_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `is_notifiable` tinyint(1) DEFAULT '0',
  `auto_acceptable` tinyint(1) NOT NULL DEFAULT '0',
  `schedule_data` longtext COLLATE utf8mb4_unicode_ci,
  `is_schedulable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `restaurants_sku_unique` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,'BurgerKing','Fast food',NULL,'/assets/img/restaurants/15907581006gWYCowU9c.jpg',NULL,'15','10',1,'2020-05-29 15:15:00','2020-05-29 15:16:57','burgerking-LKjJwkpG7d1ZjZz',NULL,'59.3432685','18.0512449','LIC34533KK',4.00,NULL,'Karlbergsvägen 4,  Stockholm','113 27',NULL,'15907581009CLO0HjrMj',1,1,0,0.00,1,10.00,'FIXED',NULL,NULL,NULL,NULL,10.00,0,0,NULL,0);
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2020-05-29 08:22:59','2020-05-29 08:22:59'),(2,'Delivery Guy','web','2020-05-29 08:22:59','2020-05-29 08:22:59'),(3,'Store Owner','web','2020-05-29 08:22:59','2020-05-29 08:22:59'),(4,'Customer','web','2020-05-29 08:22:59','2020-05-29 08:22:59');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=392 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'storeColor','#fc8019'),(2,'splashLogo','splash.jpg'),(3,'firstScreenHeading','Order from top & favourite restaurants'),(4,'firstScreenSubHeading','Ready to see top restaurant to order?'),(5,'firstScreenSetupLocation','setup your location'),(6,'firstScreenLoginText','Have an account?'),(7,'footerNearme','Near Me'),(8,'footerExplore','Explore'),(9,'footerCart','Cart'),(10,'footerAccount','Account'),(11,'restaurantCountText','Restaurants Near You'),(12,'searchAreaPlaceholder','Search your area...'),(13,'searchPopularPlaces','Popular Places'),(14,'recommendedBadgeText','Recommended'),(15,'recommendedBadgeColor','#d53d4c'),(16,'popularBadgeText','Popular'),(17,'popularBadgeColor','#ff5722'),(18,'newBadgeText','New'),(19,'newBadgeColor','#2196F3'),(20,'currencyFormat','€'),(21,'currencyId','EUR'),(22,'cartColorBg','#60b246'),(23,'cartColorText','#ffffff'),(24,'cartEmptyText','Your Cart is Empty'),(25,'firstScreenHeroImage','assets/img/various/156662819939lzR3gB2i.png'),(26,'restaurantSearchPlaceholder','Search for restaurants and items...'),(27,'accountManageAddress','Manage Address'),(28,'accountMyOrders','My Orders'),(29,'accountHelpFaq','Help & FAQs'),(30,'accountLogout','Logout'),(31,'cartMakePayment','Make Payment'),(32,'cartLoginHeader','Almost There'),(33,'cartLoginSubHeader','Login or Signup to place your order'),(34,'cartLoginButtonText','Continue'),(35,'cartDeliverTo','Deliver To'),(36,'cartChangeLocation','Change'),(37,'buttonNewAddress','New Address'),(38,'buttonSaveAddress','Save Address'),(39,'editAddressAddress','Flat/Apartment Number'),(40,'editAddressHouse','House / Flat No.'),(41,'editAddressLandmark','Landmark'),(42,'editAddressTag','Tag'),(43,'addressTagPlaceholder','Eg. Home, Work'),(44,'cartApplyCoupon','Apply Coupon'),(45,'cartInvalidCoupon','Invalid Coupon'),(46,'cartSuggestionPlaceholder','Suggestion for the restaurant...'),(47,'editAddressText','Edit'),(48,'deleteAddressText','Delete'),(49,'noAddressText','You don\'t have any saved addresses.'),(50,'cartSetAddressText','Set Your Address'),(51,'cartPageTitle','Cart'),(52,'checkoutPageTitle','Checkout'),(53,'checkoutPlaceOrder','Place Order'),(54,'runningOrderPlacedTitle','Order Placed Successfully'),(55,'runningOrderPlacedSub','Waiting for the restaurant to confirm your order'),(56,'runningOrderPreparingTitle','Chef at work!!'),(57,'runningOrderPreparingSub','Restaurant is preparing your order'),(58,'runningOrderOnwayTitle','Vroom Vroom!!'),(59,'runningOrderOnwaySub','Order has been picked up and is on its way'),(60,'runningOrderRefreshButton','Refresh Order Status'),(61,'noOrdersText','You have not placed any order yet.'),(62,'orderTextTotal','Total:'),(63,'checkoutPaymentListTitle','Select your prefered payment method'),(64,'checkoutSelectPayment','Select Payment Method'),(65,'mapApiKey',NULL),(66,'storeName','swell'),(67,'storeLogo','logo.png'),(68,'runningOrderDeliveryAssignedTitle','Delivery Guy Assigned'),(69,'runningOrderDeliveryAssignedSub','On the way to pick up your order.'),(70,'runningOrderCanceledTitle','Order Canceled'),(71,'runningOrderCanceledSub','Sorry. Your order has been canceled.'),(72,'stripePublicKey',NULL),(73,'stripeSecretKey',NULL),(74,'firstScreenWelcomeMessage','Welcome,'),(75,'firstScreenLoginBtn','Login'),(76,'loginErrorMessage','Woopss!! Something went wrong. Please try again.'),(77,'pleaseWaitText','Please Wait...'),(78,'loginLoginTitle','LOGIN'),(79,'loginLoginSubTitle','Enter your email and password'),(80,'loginLoginEmailLabel','Email'),(81,'loginLoginPasswordLabel','Password'),(82,'homePageMinsText','MINS'),(83,'homePageForTwoText','FOR TWO'),(84,'itemsPageRecommendedText','RECOMMENDED'),(85,'floatCartItemsText','Items'),(86,'floatCartViewCartText','View Cart'),(87,'cartItemsInCartText','Items in Cart'),(88,'cartBillDetailsText','Bill Details'),(89,'cartItemTotalText','Item Total'),(90,'cartRestaurantCharges','Restaurant Charges'),(91,'cartDeliveryCharges','Delivery Charges'),(92,'cartCouponText','Coupon'),(93,'cartToPayText','To Pay'),(94,'cartSetYourAddress','Set Your Address'),(95,'checkoutPaymentInProcess','Payment in process. Do not hit refresh or go back.'),(96,'checkoutStripeText','Stripe'),(97,'checkoutStripeSubText','Online Payment'),(98,'checkoutCodText','COD'),(99,'checkoutCodSubText','Cash On Delivery'),(100,'showPromoSlider','false'),(101,'loginLoginPhoneLabel','Phone'),(102,'loginLoginNameLabel','Name'),(103,'registerErrorMessage','Woppss!! Something went wrong. Please try again.'),(104,'registerRegisterTitle','Register'),(105,'registerRegisterSubTitle','Regsiter now for free'),(106,'firstScreenRegisterBtn','Register'),(107,'loginDontHaveAccount','Don\'t have an account yet? '),(108,'regsiterAlreadyHaveAccount','Already have an account? '),(109,'favicon-16x16','favicon-16x16.png'),(110,'favicon-32x32','favicon-32x32.png'),(111,'favicon-96x96','favicon-96x96.png'),(112,'favicon-128x128','favicon-128x128.png'),(113,'storeEmail','info@swell.com'),(114,'seoMetaTitle','swell'),(115,'seoMetaDescription',NULL),(116,'storeUrl','https://resto.solutionweb.io/'),(117,'twitterUsername','twitter-username'),(118,'seoOgTitle',NULL),(119,'seoOgDescription',NULL),(120,'seoTwitterTitle',NULL),(121,'seoTwitterDescription',NULL),(122,'seoOgImage',NULL),(123,'seoTwitterImage',NULL),(124,'accountMyAccount','My Account'),(125,'desktopHeading','Order from restaurants near you'),(126,'desktopSubHeading','Easy way to get the food you love delivered.\r\nWe bring food from the best restaurants and desserts to your doorstep. We have <b style=\"\">hundreds</b> of restaurants to choose from.'),(127,'desktopUseAppButton','Use App'),(128,'desktopAchievementOneTitle','Restaurants'),(129,'desktopAchievementOneSub','2300+'),(130,'desktopAchievementTwoTitle','Items'),(131,'desktopAchievementTwoSub','65000+'),(132,'desktopAchievementThreeTitle','Customers'),(133,'desktopAchievementThreeSub','1M+'),(134,'desktopAchievementFourTitle','Deliveries'),(135,'desktopAchievementFourSub','5M+'),(136,'desktopSocialFacebookLink','https://www.facebook.com'),(137,'desktopSocialGoogleLink','https://www.google.com'),(138,'desktopSocialYoutubeLink',NULL),(139,'desktopSocialInstagramLink','https://www.instagram.com'),(140,'desktopFooterSocialHeader','We Are Social'),(141,'desktopFooterAddress','#1201, Someplace, Near Somewhere'),(142,'runningOrderDeliveryPin','Delivery Pin: '),(143,'deliveryNoOrdersAccepted','No Orders Accepted Yet'),(144,'deliveryNoNewOrders','No New Orders Yet'),(145,'firstScreenHeroImageSm','assets/img/various/156662819939lzR3gB2i-sm.png'),(146,'showMap','true'),(147,'paypalEnv','sandbox'),(148,'paypalSandboxKey',NULL),(149,'paypalProductionKey',NULL),(150,'enablePushNotification','false'),(151,'enablePushNotificationOrders','false'),(152,'firebaseSenderId','587656068333'),(153,'firebaseSecret',NULL),(154,'runningOrderDelivered','Order Delivered'),(155,'runningOrderDeliveredSub','The order has been delivered to you. Enjoy.'),(156,'showGdpr','false'),(157,'gdprMessage','We use Cookies to give you the best possible service. By continuing to browse our site you are agreeing to our use of Cookies'),(158,'gdprConfirmButton','Okay'),(159,'restaurantFeaturedText','Featured'),(160,'deliveryNewOrdersTitle','New Orders'),(161,'deliveryAcceptedOrdersTitle','Accepted Orders'),(162,'deliveryWelcomeMessage','Welcome'),(163,'deliveryOrderItems','Order Items'),(164,'deliveryRestaurantAddress','Restaurant Address'),(165,'deliveryGetDirectionButton','Get Direction'),(166,'deliveryDeliveryAddress','Delivery Address'),(167,'deliveryOnlinePayment','Online Payment'),(168,'deliveryDeliveryPinPlaceholder','ENTER DELIVERY PIN'),(169,'deliveryAcceptOrderButton','Accept'),(170,'deliveryPickedUpButton','Picked Up'),(171,'deliveryDeliveredButton','Delivered'),(172,'deliveryOrderCompletedButton','Order Completed'),(173,'deliveryInvalidDeliveryPin','Incorrect delivery pin. Please try again.'),(174,'deliveryAlreadyAccepted','This delivery has been accepted by someone else.'),(175,'deliveryLogoutDelivery','Logout Delivery'),(176,'enableGoogleAnalytics','false'),(177,'googleAnalyticsId',NULL),(178,'taxApplicable','false'),(179,'taxPercentage',NULL),(180,'firebasePublic','BH5L8XrGsNpki5uF1008FbZzgKKZN-NmhOwdWL5Lxh5r3nsgZ6N_Dged1IYXXCCJwpnrXzs52G_v3vM_naO0hxY'),(181,'deliveryLogoutConfirmation','Are you sure?'),(182,'customizationHeading','Customizations'),(183,'customizableItemText','Customizable'),(184,'customizationDoneBtnText','Continue'),(185,'paystackPublicKey','pk_test_ecf3496bdf36bced2112a502f5f5bb96e1340124'),(186,'paystackPrivateKey',NULL),(187,'paystackPayText','PAY WITH PAYSLACK'),(188,'minPayout','150'),(189,'enableFacebookLogin','false'),(190,'facebookAppId',NULL),(191,'facebookLoginButtonText','Login with Facebook'),(192,'enableGoogleLogin','false'),(193,'googleAppId',NULL),(194,'googleLoginButtonText','Login with Google'),(195,'customCSS',NULL),(196,'enSOV','false'),(197,'twilioSid',NULL),(198,'twilioAccessToken',NULL),(199,'twilioServiceId',NULL),(200,'fieldValidationMsg','This is a required field.'),(201,'nameValidationMsg','Please enter your full name.'),(202,'emailValidationMsg','Please enter a valid email.'),(203,'phoneValidationMsg','Please enter a phone number in this format: +1123456789'),(204,'minimumLengthValidationMessage','This field must be at least 8 characters long.'),(205,'emailPhoneAlreadyRegistered','Email or Phone has already been registered.'),(206,'enterPhoneToVerify','Please enter your phone number to verify'),(207,'invalidOtpMsg','Invalid OTP. Please check and try again.'),(208,'otpSentMsg','An OTP has been sent to '),(209,'resendOtpMsg','Resend OTP to '),(210,'resendOtpCountdownMsg','Resend OTP in '),(211,'verifyOtpBtnText','Verify OTP'),(212,'socialWelcomeText','Hi '),(213,'emailPassDonotMatch','Email & Password do not match.'),(214,'enSPU','true'),(215,'runningOrderReadyForPickup','Food is Ready'),(216,'runningOrderReadyForPickupSub','Your order is ready for self pickup.'),(217,'deliveryTypeDelivery','Delivery'),(218,'deliveryTypeSelfPickup','Self Pickup'),(219,'noRestaurantMessage','No restaurants are available.'),(220,'selectedSelfPickupMessage','You have selected Self Pickup.'),(221,'vehicleText','Vehicle:'),(222,'deliveryGuyAfterName','is your delivery valet today.'),(223,'callNowButton','Call Now'),(224,'enableGoogleAPI','false'),(225,'checkoutRazorpayText','Razorpay'),(226,'checkoutRazorpaySubText','Pay with cards, wallet or UPI'),(227,'razorpayKeyId','rzp_test_VWcp86nfU6T7rV'),(228,'razorpayKeySecret','eLzMBr1cycRG0iEjgMptgjMs'),(229,'allowLocationAccessMessage','Kindly allow location access for live tracking.'),(230,'enableDeliveryPin','true'),(231,'deliveryOrdersRefreshBtn','Refresh'),(232,'restaurantAcceptTimeThreshold','10'),(233,'deliveryAcceptTimeThreshold','45'),(234,'taxText','Tax'),(235,'itemsRemovedMsg','Items added from the previous restaurant have been removed.'),(236,'ongoingOrderMsg','You have some on-going orders. VIEW'),(237,'trackOrderText','Track Order'),(238,'orderPlacedStatusText','Order Placed'),(239,'preparingOrderStatusText','Preparing Order'),(240,'deliveryGuyAssignedStatusText','Delivery Guy Assigned'),(241,'orderPickedUpStatusText','Order Picked Up'),(242,'deliveredStatusText','Delivered'),(243,'canceledStatusText','Canceled'),(244,'readyForPickupStatusText','Ready For Pickup'),(245,'pureVegText','Pure Veg'),(246,'certificateCodeText','Certificate Code: '),(247,'showMoreButtonText','Show More'),(248,'showLessButtonText','Show Less'),(249,'walletName','Wallet'),(250,'accountMyWallet','My Wallet'),(251,'noWalletTransactionsText','No Wallet Transactions Yet!!!'),(252,'walletDepositText','Deposit'),(253,'walletWithdrawText','Withdraw'),(254,'payPartialWithWalletText','Pay partial amount with wallet'),(255,'willbeDeductedText','will be deducted from your balance of'),(256,'payFullWithWalletText','Pay full amount with Wallet.'),(257,'orderPaymentWalletComment','Payment for order:'),(258,'orderPartialPaymentWalletComment','Partial payment for order:'),(259,'orderRefundWalletComment','Refund for order cancellation.'),(260,'orderPartialRefundWalletComment','Partial Refund for order cancellation.'),(261,'enDevMode','true'),(262,'walletRedeemBtnText','Redeem'),(263,'restaurantNewOrderNotificationMsg','A New Order has Arrived !!!'),(264,'restaurantNewOrderNotificationMsgSub','New Order Notification'),(265,'deliveryGuyNewOrderNotificationMsg','A New Order is Waiting !!!'),(266,'deliveryGuyNewOrderNotificationMsgSub','New Order Notification'),(267,'firebaseSDKSnippet',''),(268,'cartCouponOffText','OFF'),(269,'willBeRefundedText','will be refunded back to your wallet.'),(270,'willNotBeRefundedText','No Refund will be made to your wallet as the restaurant has already prepared the order.'),(271,'cartRestaurantNotOperational','Restaurant is not operational on your selected location.'),(272,'addressDoesnotDeliverToText','Does not deliver to'),(273,'googleApiKey','AIzaSyBRbDjAmZEqpIUg9LJclblxdrFwGD7dNcw'),(274,'useCurrentLocationText','Use Current Location'),(275,'gpsAccessNotGrantedMsg','GPS access is not granted or was denied.'),(276,'yourLocationText','YOUR LOCATION'),(277,'notAcceptingOrdersMsg','Currently Not Accepting Any Orders'),(278,'exploreRestautantsText','RESTAURANTS'),(279,'exploreItemsText','ITEMS'),(280,'hidePriceWhenZero','true'),(281,'phoneCountryCode','+1'),(282,'orderCancellationConfirmationText','Do you want to cancel this order?'),(283,'yesCancelOrderBtn','Yes, Cancel Order'),(284,'cancelGoBackBtn','Go back'),(285,'cancelOrderMainButton','Cancel Order'),(286,'deliveryOrderPlacedText','Order Placed'),(287,'deliveryCashOnDelivery','Cash On Delivery'),(288,'socialLoginOrText','OR'),(289,'orderCancelledText','Order Cancelled'),(290,'searchAtleastThreeCharsMsg','Enter at least 3 characters to search.'),(291,'multiLanguageSelection','true'),(292,'changeLanguageText','Change Language'),(293,'deliveryFooterNewTitle','New Orders'),(294,'deliveryFooterAcceptedTitle','Accepted'),(295,'deliveryFooterAccount','Account'),(296,'enableDeliveryGuyEarning','false'),(297,'deliveryGuyCommissionFrom','FULLORDER'),(298,'deliveryEarningsText','Earnings'),(299,'deliveryOnGoingText','On-Going'),(300,'deliveryCompletedText','Completed'),(301,'deliveryCommissionMessage','Commission for order: '),(302,'itemSearchText','Search results for: '),(303,'itemSearchNoResultText','No results found for: '),(304,'itemSearchPlaceholder','Search for items...'),(305,'googleApiKeyIP','AIzaSyBRbDjAmZEqpIUg9LJclblxdrFwGD7dNcw'),(306,'itemsMenuButtonText','MENU'),(307,'enPassResetEmail','false'),(308,'mail_host',NULL),(309,'mail_port',NULL),(310,'mail_username',NULL),(311,'mail_password',NULL),(312,'mail_encryption',NULL),(313,'enRestaurantCategorySlider','0'),(314,'restaurantCategorySliderPosition','2'),(315,'restaurantCategorySliderSize','3'),(316,'showRestaurantCategorySliderLabel','false'),(317,'restaurantCategorySliderStyle','0.4'),(318,'enRAR','true'),(319,'rarModEnHomeBanner','true'),(320,'rarModShowBannerRestaurantName','true'),(321,'rarModHomeBannerPosition','2'),(322,'rarModHomeBannerBgColor','rgb(255, 235, 59)'),(323,'rarModHomeBannerTextColor','rgb(0, 0, 0)'),(324,'rarModHomeBannerStarsColor','rgb(255, 162, 0)'),(325,'rarModHomeBannerText','Rate and Review'),(326,'rarModRatingPageTitle','Rate Your Order'),(327,'rarModDeliveryRatingTitle','Rate the Delivery'),(328,'rarModRestaurantRatingTitle','Rate the Restaurant'),(329,'rarReviewBoxTitle','Your Feedback'),(330,'rarReviewBoxTextPlaceHolderText','Write your feedback here (optional)'),(331,'rarSubmitButtonText','Submit'),(332,'showPercentageDiscount','true'),(333,'itemPercentageDiscountText','% OFF'),(334,'showVegNonVegBadge','true'),(335,'exploreNoResults','No Items or Restaurants Found'),(336,'updatingMessage','Updating System'),(337,'userNotFoundErrorMessage','No user found with this email.'),(338,'invalidOtpErrorMessage','Invalid OTP Entered'),(339,'resetPasswordPageTitle','Reset Password'),(340,'resetPasswordPageSubTitle','Enter your email address to continue'),(341,'sendOtpOnEmailButtonText','Send OTP on Email'),(342,'alreadyHaveResetOtpButtonText','I already have an OTP'),(343,'enterResetOtpMessageText','Enter the OTP sent to you email'),(344,'verifyResetOtpButtonText','Verify OTP'),(345,'dontHaveResetOtpButtonText','I dont have an OTP'),(346,'enterNewPasswordText','Please enter a new password below'),(347,'newPasswordLabelText','New Password'),(348,'setNewPasswordButtonText','Set New Password'),(349,'exlporeByRestaurantText','By'),(350,'forgotPasswordLinkText','Forgot Password?'),(351,'categoriesNoRestaurantsFoundText','No Restaurants Found'),(352,'categoriesFiltersText','Filters'),(353,'sendEmailFromEmailAddress','do-not-reply@foodomaa.com'),(354,'sendEmailFromEmailName','Foodomaa'),(355,'passwordResetEmailSubject','Reset Password OTP'),(356,'registrationPolicyMessage',NULL),(357,'locationSavedAddresses','Saved Addresses'),(358,'restaurantMinOrderMessage','Min cart value should be atleast '),(359,'footerAlerts','Alerts'),(360,'showFromNowDate','true'),(361,'markAllAlertReadText','Mark all read'),(362,'noNewAlertsText','No new alerts'),(363,'currencySymbolAlign','right'),(364,'restaurantNotificationAudioTrack','Alert-5'),(365,'restaurantNewOrderRefreshRate','15'),(366,'enDelChrRnd','true'),(367,'expandAllItemMenu','true'),(368,'msg91AuthKey',NULL),(369,'msg91SenderId',NULL),(370,'defaultSmsGateway','1'),(371,'otpMessage','Your OTP verification code is:'),(372,'twilioFromPhone',NULL),(373,'smsRestaurantNotify','false'),(374,'smsDeliveryNotify','false'),(375,'defaultSmsRestaurantMsg','You have received a new order.'),(376,'smsRestOrderValue','false'),(377,'smsOrderNotify','false'),(378,'defaultSmsDeliveryMsg','A new order has arrived.'),(379,'showOrderAddonsDelivery','true'),(380,'showDeliveryFullAddressOnList','true'),(381,'sendgrid_api_key',NULL),(382,'showUserInfoBeforePickup','true'),(383,'recommendedLayoutV2','true'),(384,'cartItemNotAvailable','Item Not Available'),(385,'cartRemoveItemButton','Remove Item'),(386,'deliveryTotalEarningsText','Total Earnings'),(387,'flatApartmentAddressRequired','false'),(388,'deliveryUsePhoneToAccessMsg','Use your mobile phone to login to the Delivery Application.'),(389,'restaurantNotActiveMsg','Not Accepting Orders'),(390,'uploadImageQuality','75'),(391,'deliveryMaxOrderReachedMsg','Max Order Limit Reached');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `promo_slider_id` int(11) NOT NULL,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `image_placeholder` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_gateways`
--

DROP TABLE IF EXISTS `sms_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_gateways` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_gateways`
--

LOCK TABLES `sms_gateways` WRITE;
/*!40000 ALTER TABLE `sms_gateways` DISABLE KEYS */;
INSERT INTO `sms_gateways` VALUES (1,'MSG91','2020-05-29 08:22:59','2020-05-29 08:22:59'),(2,'TWILIO','2020-05-29 08:22:59','2020-05-29 08:22:59');
/*!40000 ALTER TABLE `sms_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_otps`
--

DROP TABLE IF EXISTS `sms_otps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_otps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_otps`
--

LOCK TABLES `sms_otps` WRITE;
/*!40000 ALTER TABLE `sms_otps` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_otps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint(20) unsigned NOT NULL,
  `wallet_id` int(10) unsigned DEFAULT NULL,
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` json DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  KEY `transactions_type_index` (`type`),
  KEY `transactions_wallet_id_foreign` (`wallet_id`),
  CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) unsigned NOT NULL,
  `to_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) unsigned NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` int(10) unsigned NOT NULL,
  `withdraw_id` int(10) unsigned NOT NULL,
  `discount` bigint(20) NOT NULL DEFAULT '0',
  `fee` bigint(20) NOT NULL DEFAULT '0',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  KEY `transfers_deposit_id_foreign` (`deposit_id`),
  KEY `transfers_withdraw_id_foreign` (`withdraw_id`),
  CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'English','{\r\n	\"desktopHeading\": \"Order from restaurants near you\",\r\n	\"desktopSubHeading\": \"Foodoma is the easy way to get the food you love delivered.\\r\\nWe bring food from the best restaurants and desserts to your doorstep. We have <b style=\\\"\\\">hundreds</b> of restaurants to choose from.\",\r\n	\"desktopUseAppButton\": \"Use App Now\",\r\n	\"desktopAchievementOneTitle\": \"Restaurants\",\r\n	\"desktopAchievementOneSub\": \"2300+\",\r\n	\"desktopAchievementTwoTitle\": \"Items\",\r\n	\"desktopAchievementTwoSub\": \"65000+\",\r\n	\"desktopAchievementThreeTitle\": \"Customers\",\r\n	\"desktopAchievementThreeSub\": \"1M+\",\r\n	\"desktopAchievementFourTitle\": \"Deliveries\",\r\n	\"desktopAchievementFourSub\": \"5M+\",\r\n	\"desktopFooterAddress\": \"<p>#1201, Someplace, Near Somewhere</p><p><a href=\\\"/pages/hello-world\\\" target=\\\"_blank\\\">Cookie Policy</a><br></p>\",\r\n	\"desktopFooterSocialHeader\": \"We Are Social\",\r\n	\"desktopSocialFacebookLink\": \"https://www.facebook.com\",\r\n	\"desktopSocialGoogleLink\": \"https://www.google.com\",\r\n	\"desktopSocialYoutubeLink\": null,\r\n	\"desktopSocialInstagramLink\": \"https://www.instagram.com\",\r\n	\"gdprMessage\": \"<p>We use Cookies to give you the best possible service. By continuing to browse our site you are agreeing to our use of <b>Cookies.&nbsp;</b></p>\",\r\n	\"gdprConfirmButton\": \"Okay\",\r\n	\"changeLanguageText\": \"Change Language\",\r\n	\"firstScreenHeading\": \"Order from top & favourite restaurants\",\r\n	\"firstScreenSubHeading\": \"Ready to see top restaurant to order?\",\r\n	\"firstScreenSetupLocation\": \"setup your location\",\r\n	\"firstScreenWelcomeMessage\": \"Welcome,\",\r\n	\"firstScreenLoginText\": \"Have an account?\",\r\n	\"firstScreenLoginBtn\": \"Login\",\r\n	\"loginErrorMessage\": \"Woopss!! Something went wrong. Please try again.\",\r\n	\"pleaseWaitText\": \"Please Wait...\",\r\n	\"loginLoginTitle\": \"LOGIN\",\r\n	\"loginLoginSubTitle\": \"Enter your email and password\",\r\n	\"loginLoginEmailLabel\": \"Email\",\r\n	\"loginLoginPasswordLabel\": \"Password\",\r\n	\"loginDontHaveAccount\": \"Don\'t have an account yet?\",\r\n	\"firstScreenRegisterBtn\": \"Register\",\r\n	\"registerRegisterTitle\": \"Register\",\r\n	\"registerRegisterSubTitle\": \"Regsiter now for free\",\r\n	\"loginLoginNameLabel\": \"Name\",\r\n	\"loginLoginPhoneLabel\": \"Phone\",\r\n	\"regsiterAlreadyHaveAccount\": \"Already have an account?\",\r\n	\"fieldValidationMsg\": \"This is a required field.\",\r\n	\"nameValidationMsg\": \"Please enter your full name.\",\r\n	\"emailValidationMsg\": \"Please enter a valid email.\",\r\n	\"phoneValidationMsg\": \"Please enter a phone number in this format: +1123456789\",\r\n	\"minimumLengthValidationMessage\": \"This field must be at least 8 characters long.\",\r\n	\"emailPhoneAlreadyRegistered\": \"Email or Phone has already been registered.\",\r\n	\"emailPassDonotMatch\": \"Email & Password do not match.\",\r\n	\"enterPhoneToVerify\": \"Please enter your phone number to verify\",\r\n	\"invalidOtpMsg\": \"Invalid OTP. Please check and try again.\",\r\n	\"otpSentMsg\": \"An OTP has been sent to\",\r\n	\"resendOtpMsg\": \"Resend OTP to\",\r\n	\"resendOtpCountdownMsg\": \"Resend OTP in\",\r\n	\"verifyOtpBtnText\": \"Verify OTP\",\r\n	\"socialWelcomeText\": \"Hi\",\r\n	\"socialLoginOrText\": \"OR\",\r\n	\"deliveryTypeDelivery\": \"Delivery\",\r\n	\"deliveryTypeSelfPickup\": \"Self Pickup\",\r\n	\"noRestaurantMessage\": \"No restaurants are available.\",\r\n	\"restaurantCountText\": \"Restaurants Near You\",\r\n	\"restaurantFeaturedText\": \"Featured\",\r\n	\"homePageMinsText\": \"MINS\",\r\n	\"homePageForTwoText\": \"FOR TWO\",\r\n	\"footerNearme\": \"Near Me\",\r\n	\"footerExplore\": \"Explore\",\r\n	\"footerCart\": \"Cart\",\r\n	\"footerAccount\": \"Account\",\r\n	\"restaurantSearchPlaceholder\": \"Search for restaurants\",\r\n	\"exploreRestautantsText\": \"RESTAURANTS\",\r\n	\"exploreItemsText\": \"ITEMS\",\r\n	\"searchAtleastThreeCharsMsg\": \"Enter at least 3 characters to search.\",\r\n	\"recommendedBadgeText\": \"Recommended\",\r\n	\"popularBadgeText\": \"Popular\",\r\n	\"newBadgeText\": \"New\",\r\n	\"itemsPageRecommendedText\": \"RECOMMENDED\",\r\n	\"floatCartViewCartText\": \"View Cart\",\r\n	\"floatCartItemsText\": \"Items\",\r\n	\"customizableItemText\": \"Customizable\",\r\n	\"customizationHeading\": \"Customizations\",\r\n	\"customizationDoneBtnText\": \"Continue\",\r\n	\"pureVegText\": \"Pure Veg\",\r\n	\"certificateCodeText\": \"Certificate Code:\",\r\n	\"showMoreButtonText\": \"Show More\",\r\n	\"showLessButtonText\": \"Show Less\",\r\n	\"notAcceptingOrdersMsg\": \"Currently Not Accepting Any Orders\",\r\n	\"cartPageTitle\": \"Cart\",\r\n	\"cartItemsInCartText\": \"Items in Cart\",\r\n	\"cartEmptyText\": \"Your Cart is Empty\",\r\n	\"cartSuggestionPlaceholder\": \"Write your comment/suggestion for the restaurant...\",\r\n	\"cartCouponText\": \"Coupon\",\r\n	\"cartApplyCoupon\": \"Coupon Applied\",\r\n	\"cartInvalidCoupon\": \"Invalid Coupon\",\r\n	\"cartCouponOffText\": \"OFF\",\r\n	\"cartBillDetailsText\": \"Bill Details\",\r\n	\"cartItemTotalText\": \"Item Total\",\r\n	\"cartToPayText\": \"To Pay\",\r\n	\"cartDeliveryCharges\": \"Delivery Charges\",\r\n	\"cartRestaurantCharges\": \"Restaurant Charges\",\r\n	\"cartSetYourAddress\": \"Set Your Address\",\r\n	\"buttonNewAddress\": \"New Address\",\r\n	\"cartChangeLocation\": \"Change\",\r\n	\"cartDeliverTo\": \"Deliver To\",\r\n	\"checkoutSelectPayment\": \"Proceed to Checkout\",\r\n	\"cartLoginHeader\": \"Almost There\",\r\n	\"cartLoginSubHeader\": \"Login or Signup to place your order\",\r\n	\"cartLoginButtonText\": \"Continue\",\r\n	\"selectedSelfPickupMessage\": \"You have selected Self Pickup.\",\r\n	\"taxText\": \"Tax\",\r\n	\"itemsRemovedMsg\": \"Items added from the previous restaurant have been removed.\",\r\n	\"ongoingOrderMsg\": \"You have some on-going orders. VIEW\",\r\n	\"cartRestaurantNotOperational\": \"Restaurant is not operational on your selected location.\",\r\n	\"checkoutPageTitle\": \"Checkout\",\r\n	\"checkoutPaymentListTitle\": \"Select your prefered payment method\",\r\n	\"checkoutPaymentInProcess\": \"Payment in process. Do not hit refresh or go back.\",\r\n	\"checkoutStripeText\": \"Stripe\",\r\n	\"checkoutStripeSubText\": \"Online Payment\",\r\n	\"checkoutCodText\": \"COD\",\r\n	\"checkoutCodSubText\": \"Cash On Delivery\",\r\n	\"paystackPayText\": \"Pay with PayStack\",\r\n	\"checkoutRazorpayText\": \"Razorpay\",\r\n	\"checkoutRazorpaySubText\": \"Pay with cards, wallet or UPI\",\r\n	\"runningOrderPlacedTitle\": \"Order Placed Successfully\",\r\n	\"runningOrderPlacedSub\": \"Waiting for the restaurant to confirm your order\",\r\n	\"runningOrderPreparingTitle\": \"Chef at work!!\",\r\n	\"runningOrderPreparingSub\": \"Restaurant is preparing your order\",\r\n	\"runningOrderOnwayTitle\": \"Vroom Vroom!!\",\r\n	\"runningOrderOnwaySub\": \"Order has been picked up and is on its way\",\r\n	\"runningOrderDeliveryAssignedTitle\": \"Delivery Guy Assigned\",\r\n	\"runningOrderDeliveryAssignedSub\": \"On the way to pick up your order.\",\r\n	\"runningOrderCanceledTitle\": \"Order Canceled\",\r\n	\"runningOrderCanceledSub\": \"Sorry. Your order has been canceled.\",\r\n	\"runningOrderReadyForPickup\": \"Food is Ready\",\r\n	\"runningOrderReadyForPickupSub\": \"Your order is ready for self pickup.\",\r\n	\"runningOrderDelivered\": \"Order Delivered\",\r\n	\"runningOrderDeliveredSub\": \"The order has been delivered to you. Enjoy.\",\r\n	\"runningOrderRefreshButton\": \"Refresh Order Status\",\r\n	\"deliveryGuyAfterName\": \"is your delivery valet today.\",\r\n	\"vehicleText\": \"Vehicle:\",\r\n	\"callNowButton\": \"Call Now\",\r\n	\"allowLocationAccessMessage\": \"Kindly allow location access for live tracking.\",\r\n	\"trackOrderText\": \"Track Order\",\r\n	\"orderPlacedStatusText\": \"Order Placed\",\r\n	\"preparingOrderStatusText\": \"Preparing Order\",\r\n	\"deliveryGuyAssignedStatusText\": \"Delivery Guy Assigned\",\r\n	\"orderPickedUpStatusText\": \"Order Picked Up\",\r\n	\"deliveredStatusText\": \"Delivered\",\r\n	\"canceledStatusText\": \"Canceled\",\r\n	\"readyForPickupStatusText\": \"Ready For Pickup\",\r\n	\"restaurantNewOrderNotificationMsg\": \"A New Order has Arrived !!!\",\r\n	\"restaurantNewOrderNotificationMsgSub\": \"New Order Notification\",\r\n	\"deliveryGuyNewOrderNotificationMsg\": \"A New Order is Waiting !!!\",\r\n	\"deliveryGuyNewOrderNotificationMsgSub\": \"New Order Notification\",\r\n	\"runningOrderDeliveryPin\": \"Delivery Pin:\",\r\n	\"accountMyAccount\": \"My Account\",\r\n	\"accountManageAddress\": \"Manage Address\",\r\n	\"addressDoesnotDeliverToText\": \"Does not deliver to\",\r\n	\"accountMyOrders\": \"My Orders\",\r\n	\"accountHelpFaq\": \"Help & FAQs\",\r\n	\"accountLogout\": \"Logout\",\r\n	\"accountMyWallet\": \"My Wallet\",\r\n	\"noOrdersText\": \"You have not placed any order yet.\",\r\n	\"orderCancelledText\": \"Order Cancelled\",\r\n	\"searchAreaPlaceholder\": \"Search your area...\",\r\n	\"searchPopularPlaces\": \"Popular Places\",\r\n	\"useCurrentLocationText\": \"Use Current Location\",\r\n	\"gpsAccessNotGrantedMsg\": \"GPS access is not granted or was denied.\",\r\n	\"yourLocationText\": \"YOUR LOCATION\",\r\n	\"editAddressAddress\": \"Apartment/Flat Number\",\r\n	\"editAddressTag\": \"Tag\",\r\n	\"addressTagPlaceholder\": \"Eg. Home, Work\",\r\n	\"buttonSaveAddress\": \"Save Address\",\r\n	\"deleteAddressText\": \"Delete\",\r\n	\"noWalletTransactionsText\": \"No Wallet Transactions Yet!!!\",\r\n	\"walletDepositText\": \"Deposit\",\r\n	\"walletWithdrawText\": \"Withdraw\",\r\n	\"payPartialWithWalletText\": \"Pay partial amount with wallet\",\r\n	\"willbeDeductedText\": \"will be deducted from your balance of\",\r\n	\"payFullWithWalletText\": \"Pay full amount with Wallet.\",\r\n	\"orderPaymentWalletComment\": \"Payment for order:\",\r\n	\"orderPartialPaymentWalletComment\": \"Partial payment for order:\",\r\n	\"orderRefundWalletComment\": \"Refund for order cancellation.\",\r\n	\"orderPartialRefundWalletComment\": \"Partial Refund for order cancellation.\",\r\n	\"walletRedeemBtnText\": \"Redeem\",\r\n	\"cancelOrderMainButton\": \"Cancel Order\",\r\n	\"willBeRefundedText\": \"will be refunded back to your wallet.\",\r\n	\"willNotBeRefundedText\": \"No Refund will be made to your wallet as the restaurant has already prepared the order.\",\r\n	\"orderCancellationConfirmationText\": \"Do you want to cancel this order?\",\r\n	\"yesCancelOrderBtn\": \"Yes, Cancel Order\",\r\n	\"cancelGoBackBtn\": \"Go back\",\r\n	\"deliveryWelcomeMessage\": \"Welcome\",\r\n	\"deliveryAcceptedOrdersTitle\": \"Accepted Orders\",\r\n	\"deliveryNoOrdersAccepted\": \"No Orders Accepted Yet\",\r\n	\"deliveryNewOrdersTitle\": \"New Orders\",\r\n	\"deliveryNoNewOrders\": \"No New Orders Yet\",\r\n	\"deliveryOrderItems\": \"Order Items\",\r\n	\"deliveryRestaurantAddress\": \"Restaurant Address\",\r\n	\"deliveryDeliveryAddress\": \"Delivery Address\",\r\n	\"deliveryGetDirectionButton\": \"Get Direction\",\r\n	\"deliveryOnlinePayment\": \"Online Payment\",\r\n	\"deliveryCashOnDelivery\": \"Cash On Delivery\",\r\n	\"deliveryDeliveryPinPlaceholder\": \"ENTER DELIVERY PIN\",\r\n	\"deliveryAcceptOrderButton\": \"Accept\",\r\n	\"deliveryPickedUpButton\": \"Picked Up\",\r\n	\"deliveryDeliveredButton\": \"Delivered\",\r\n	\"deliveryOrderCompletedButton\": \"Order Completed\",\r\n	\"deliveryAlreadyAccepted\": \"This delivery has been accepted by someone else.\",\r\n	\"deliveryInvalidDeliveryPin\": \"Incorrect delivery pin. Please try again.\",\r\n	\"deliveryLogoutDelivery\": \"Logout Delivery\",\r\n	\"deliveryLogoutConfirmation\": \"Are you sure?\",\r\n	\"deliveryOrdersRefreshBtn\": \"Refresh\",\r\n	\"deliveryOrderPlacedText\": \"Order Placed\",\r\n	\"deliveryFooterNewTitle\": \"New Orders\",\r\n	\"deliveryFooterAcceptedTitle\": \"Accepted\",\r\n	\"deliveryFooterAccount\": \"Accounts\",\r\n	\"deliveryEarningsText\": \"Balance\",\r\n	\"deliveryOnGoingText\": \"On-Going\",\r\n	\"deliveryCompletedText\": \"Completed\",\r\n	\"deliveryCommissionMessage\": \"Commission for order:\",\r\n	\"itemSearchText\": \"Search results for: \",\r\n	\"itemSearchNoResultText\": \"No results found for: \",\r\n	\"itemSearchPlaceholder\": \"Search for items...\",\r\n	\"itemsMenuButtonText\": \"MENU\",\r\n	\"itemPercentageDiscountText\": \"% OFF\",\r\n	\"exploreNoResults\": \"No Items or Restaurants Found\",\r\n	\"updatingMessage\": \"Updating\",\r\n	\"userNotFoundErrorMessage\": \"No user found with this email.\",\r\n	\"invalidOtpErrorMessage\": \"Invalid OTP Entered\",\r\n	\"resetPasswordPageTitle\": \"Reset Password\",\r\n	\"resetPasswordPageSubTitle\": \"Enter your email address to continue\",\r\n	\"sendOtpOnEmailButtonText\": \"Send OTP on Email\",\r\n	\"alreadyHaveResetOtpButtonText\": \"I already have an OTP\",\r\n	\"enterResetOtpMessageText\": \"Enter the OTP sent to you email\",\r\n	\"verifyResetOtpButtonText\": \"Verify OTP\",\r\n	\"dontHaveResetOtpButtonText\": \"I dont have an OTP\",\r\n	\"enterNewPasswordText\": \"Please enter a new password below\",\r\n	\"newPasswordLabelText\": \"New Password\",\r\n	\"setNewPasswordButtonText\": \"Set New Password\",\r\n	\"exlporeByRestaurantText\": \"By\",\r\n	\"forgotPasswordLinkText\": \"Forgot Password?\",\r\n	\"categoriesNoRestaurantsFoundText\": \"No Restaurants Found\",\r\n	\"categoriesFiltersText\": \"Filters\",\r\n	\"registrationPolicyMessage\": null,\r\n	\"locationSavedAddresses\": \"Saved Addresses\",\r\n	\"restaurantMinOrderMessage\": \"Min cart value should be atleast \",\r\n	\"footerAlerts\": \"Alerts\",\r\n	\"markAllAlertReadText\": \"Mark All Read\",\r\n	\"noNewAlertsText\": \"No new alerts\"\r\n}\r\n','2020-05-29 08:22:59','2020-05-29 08:22:59',1,1);
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth_token` longtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_address_id` int(11) DEFAULT '0',
  `delivery_pin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_guy_detail_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@demo.com',NULL,'$2y$10$2z12Bh4VCQY3CVwD2FWYSeQ7rrLI/a4iVJWSUTGMaLZ7jJKpH/cWa','MmqVIVmm83YElblyKb3sjatXiqXcPtviQYdRvYEuNIzeEkTzKxPu5LkKzbLP','2020-05-29 08:22:59','2020-05-29 08:22:59',NULL,NULL,0,'FHUD9',NULL),(2,'Resto','resto@demo.com',NULL,'$2y$10$X4UOgHByi5.4N/R4oN.we.OhQjEWEqkDk4pwga0PnD/m8EYoABb/K','DCQmZjy6i9BFgVH4D6w0J3isDYjp5kVwx9MLUwyU5jBi5JowUz7xxvqyp9tk','2020-05-29 14:28:05','2020-06-19 14:58:28','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZm9vZG9tYWEuY2xkc3RvcmFnZS5jb20vcHVibGljL2FwaS9sb2dpbiIsImlhdCI6MTU5MjU3MTUwOCwibmJmIjoxNTkyNTcxNTA4LCJqdGkiOiIxTUtTaHJCUE92NE1LcHIzIiwic3ViIjoyLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Shzt__w2n2Ze7Ya24PFr6cNP-HfQj49MryEDI4nfXMg','0612323232',0,'YG0OK',NULL),(3,'user','user@demo.com',NULL,'$2y$10$rsIbzMw74YjnkmErfb5IweiWkRCGUZbFx3.j4xQjGt0TMLrWurW9i',NULL,'2020-05-29 15:10:22','2020-06-18 04:16:48','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3Jlc3RvLnNvbHV0aW9ud2ViLmlvL3B1YmxpYy9hcGkvbG9naW4iLCJpYXQiOjE1OTI0NDY2MDgsIm5iZiI6MTU5MjQ0NjYwOCwianRpIjoiVUJVbTNpZDU0TXFrRXBCNyIsInN1YiI6MywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.EugjkHHrcQ42No0hPEUNwr2c369CJvIFhrNPxJtWSFg','07828282828',1,'A2H66',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `holder_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` bigint(20) NOT NULL DEFAULT '0',
  `decimal_places` smallint(6) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  KEY `wallets_slug_index` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'App\\User',1,'Default Wallet','default',NULL,0,2,'2020-05-29 08:23:21','2020-05-29 08:23:21'),(2,'App\\User',2,'Default Wallet','default',NULL,0,2,'2020-05-29 14:28:05','2020-05-29 14:28:05'),(3,'App\\User',3,'Default Wallet','default',NULL,0,2,'2020-05-29 15:10:22','2020-05-29 15:10:22');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-19 20:37:19
