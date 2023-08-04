# ************************************************************
# Sequel Ace SQL dump
# Version 20050
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.0.33)
# Database: fms
# Generation Time: 2023-08-04 00:23:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bookings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` bigint unsigned NOT NULL,
  `seat_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `origin_city_id` bigint unsigned NOT NULL,
  `destination_city_id` bigint unsigned NOT NULL,
  `intermediate_cities` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_trip_id_foreign` (`trip_id`),
  KEY `bookings_seat_id_foreign` (`seat_id`),
  KEY `bookings_origin_city_id_foreign` (`origin_city_id`),
  KEY `bookings_destination_city_id_foreign` (`destination_city_id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  CONSTRAINT `bookings_destination_city_id_foreign` FOREIGN KEY (`destination_city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `bookings_origin_city_id_foreign` FOREIGN KEY (`origin_city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `bookings_seat_id_foreign` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`id`),
  CONSTRAINT `bookings_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;

INSERT INTO `bookings` (`id`, `trip_id`, `seat_id`, `user_id`, `origin_city_id`, `destination_city_id`, `intermediate_cities`, `created_at`, `updated_at`)
VALUES
	(1,2,13,22,1,4,'[3]','2023-08-04 00:16:16','2023-08-04 00:16:16'),
	(2,1,1,22,4,7,'[6]','2023-08-04 00:19:33','2023-08-04 00:19:33');

/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table buses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `buses`;

CREATE TABLE `buses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_seats` tinyint NOT NULL DEFAULT '12',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `buses` WRITE;
/*!40000 ALTER TABLE `buses` DISABLE KEYS */;

INSERT INTO `buses` (`id`, `plate_number`, `number_of_seats`, `created_at`, `updated_at`)
VALUES
	(1,'B-335',12,'2023-08-04 00:05:15','2023-08-04 00:05:15'),
	(2,'B-549',12,'2023-08-04 00:05:36','2023-08-04 00:05:36'),
	(3,'B-700',12,'2023-08-04 00:05:54','2023-08-04 00:05:54');

/*!40000 ALTER TABLE `buses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Cairo','2023-08-04 00:03:59','2023-08-04 00:03:59'),
	(2,'Alfayoum','2023-08-04 00:04:07','2023-08-04 00:04:07'),
	(3,'Alminya','2023-08-04 00:04:14','2023-08-04 00:04:14'),
	(4,'Sohag','2023-08-04 00:04:23','2023-08-04 00:04:23'),
	(5,'Asyut','2023-08-04 00:04:32','2023-08-04 00:04:32'),
	(6,'Luxor','2023-08-04 00:04:38','2023-08-04 00:04:38'),
	(7,'Aswan','2023-08-04 00:04:44','2023-08-04 00:04:44');

/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table city_trip
# ------------------------------------------------------------

DROP TABLE IF EXISTS `city_trip`;

CREATE TABLE `city_trip` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city_id` bigint unsigned NOT NULL,
  `trip_id` bigint unsigned NOT NULL,
  `city_order` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_trip_city_id_foreign` (`city_id`),
  KEY `city_trip_trip_id_foreign` (`trip_id`),
  CONSTRAINT `city_trip_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `city_trip_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `city_trip` WRITE;
/*!40000 ALTER TABLE `city_trip` DISABLE KEYS */;

INSERT INTO `city_trip` (`id`, `city_id`, `trip_id`, `city_order`, `created_at`, `updated_at`)
VALUES
	(1,1,1,1,NULL,NULL),
	(2,2,1,2,NULL,NULL),
	(3,3,1,3,NULL,NULL),
	(4,5,1,4,NULL,NULL),
	(5,4,1,5,NULL,NULL),
	(6,6,1,6,NULL,NULL),
	(7,7,1,7,NULL,NULL),
	(8,1,2,1,NULL,NULL),
	(9,3,2,2,NULL,NULL),
	(10,4,2,3,NULL,NULL),
	(11,7,2,4,NULL,NULL);

/*!40000 ALTER TABLE `city_trip` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
	(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),
	(4,'2019_08_19_000000_create_failed_jobs_table',1),
	(5,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(6,'2023_07_31_130947_create_table_cities',1),
	(7,'2023_07_31_132514_create_table_buses',1),
	(8,'2023_07_31_132526_create_table_trips',1),
	(9,'2023_07_31_132543_create_table_city_trip',1),
	(10,'2023_07_31_133748_create_table_seats',1),
	(11,'2023_07_31_133838_create_table_bookings',1),
	(12,'2023_07_31_160136_create_sessions_table',1),
	(13,'2023_08_03_103835_add_user_id_field_to_bookings_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`)
VALUES
	(1,'App\\Models\\User',22,'api-token','7244ce564826d1ed9a3b14a0e2e96509322550dd753d475070d0914f2385822d','[\"*\"]','2023-08-04 00:20:21',NULL,'2023-08-04 00:09:07','2023-08-04 00:20:21');

/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table seats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `seats`;

CREATE TABLE `seats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` bigint unsigned NOT NULL,
  `seat_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seats_trip_id_foreign` (`trip_id`),
  CONSTRAINT `seats_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `seats` WRITE;
/*!40000 ALTER TABLE `seats` DISABLE KEYS */;

INSERT INTO `seats` (`id`, `trip_id`, `seat_number`, `created_at`, `updated_at`)
VALUES
	(1,1,'47e78','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(2,1,'1613f','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(3,1,'0b266','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(4,1,'ef358','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(5,1,'58a5a','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(6,1,'8087b','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(7,1,'73d84','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(8,1,'ac16c','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(9,1,'18572','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(10,1,'16f9a','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(11,1,'e061e','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(12,1,'7c712','2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(13,2,'d81ac','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(14,2,'e4333','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(15,2,'6d579','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(16,2,'4b869','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(17,2,'a0d34','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(18,2,'b688e','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(19,2,'4d285','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(20,2,'c1079','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(21,2,'2c90e','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(22,2,'88eb5','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(23,2,'3ca25','2023-08-04 00:07:52','2023-08-04 00:07:52'),
	(24,2,'02776','2023-08-04 00:07:52','2023-08-04 00:07:52');

/*!40000 ALTER TABLE `seats` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`)
VALUES
	('6dHavVpWAxHxJOIeKlMaXf6j7DeeO59Xm6p7Wp6y',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/117.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidU9KOHIzaXphVnpaeGJPQlJnVEM2NmxCUUJjam95bHpjYk9LUURYMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9mbGVldC5sb2NhbC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1691107381),
	('hcF8GSz15eEUQyU2PWM3pPtzijiD2BKUMeMGTkmU',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/117.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVFTOGhSbmtDcGZzdk1YZ0d0T3dncWFYS1dKU0hNZFJ0cXdYWnFiZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovL2ZsZWV0LmxvY2FsL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vZmxlZXQubG9jYWwvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1691107381),
	('ZHb9Ot8NvHXktTrGNvAgHdSHyJU6noUfwDGd00iW',21,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/117.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWmIzaFBWMlg0bkljRmFVNkwyYWYwUzBiekViVFdaYTl4bWhwY1dJcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9mbGVldC5sb2NhbC9ib29raW5nIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJG9XTXhmRkRQbmc4Nmh1bVU3NHdzSS5iWHgvLnlBRWI1eVJBVG5DVVRRWkRHZHhqaVhIV3lHIjt9',1691108531);

/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table trips
# ------------------------------------------------------------

DROP TABLE IF EXISTS `trips`;

CREATE TABLE `trips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trip_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trips_bus_id_foreign` (`bus_id`),
  CONSTRAINT `trips_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;

INSERT INTO `trips` (`id`, `trip_number`, `bus_id`, `created_at`, `updated_at`)
VALUES
	(1,'T9980',1,'2023-08-04 00:07:11','2023-08-04 00:07:11'),
	(2,'T8795',2,'2023-08-04 00:07:52','2023-08-04 00:07:52');

/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`)
VALUES
	(21,'admin','admin@admin.com',NULL,'$2y$10$oWMxfFDPng86humU74wsI.bXx/.yAEb5yRATnCUTQZDGdxjiXHWyG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-04 00:03:42','2023-08-04 00:03:42'),
	(22,'Ahmed','ahmed@zekry.com',NULL,'$2y$10$dvMiPAci8rHlhDVgEHgevOqtomfWiemFIbkxdtp.L8mGc9ubckwLS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-04 00:09:00','2023-08-04 00:09:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
