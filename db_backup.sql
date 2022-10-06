-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.5-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for larablog
CREATE DATABASE IF NOT EXISTS `larablog` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `larablog`;

-- Dumping structure for table larablog.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larablog.migrations: ~3 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(6, '2014_10_12_000000_create_users_table', 1),
	(7, '2014_10_12_100000_create_password_resets_table', 1),
	(8, '2017_10_15_135415_create_posts_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table larablog.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larablog.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table larablog.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larablog.posts: ~7 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `post`, `user_id`, `published`, `views`, `created_at`, `updated_at`) VALUES
	(1, 'Sample Post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat.', '1', 1, 100, NULL, NULL),
	(2, 'Sample Post 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat.', '1', 1, 100, NULL, NULL),
	(3, 'Sample Post 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat.', '1', 1, 100, NULL, NULL),
	(4, 'Sample Post 2212', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat.', '1', 1, 100, NULL, NULL),
	(5, 'Sample Post 45', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat.', '1', 1, 100, NULL, NULL),
	(6, 'The Story of How a 21 year old become a billionaire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis, ante in pretium volutpat, risus metus molestie odio, non placerat magna diam sit amet augue. Donec ullamcorper ornare mauris, id bibendum lacus viverra vel. Curabitur in pellentesque metus. Quisque gravida molestie turpis, id tincidunt purus viverra vitae. In sollicitudin, arcu at interdum sagittis, massa mi cursus diam, eu sodales purus erat vitae dui. Curabitur tempus urna consequat odio pretium pellentesque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tincidunt eros orci, sit amet pharetra eros accumsan vitae. Quisque a massa id nisi sodales rhoncus sed ut ante. Duis sed augue non velit feugiat varius eget eu velit. Nam commodo posuere massa sed convallis. Phasellus dapibus commodo lectus, vitae gravida lorem. Donec molestie a nisi ac mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam tempor ante et rutrum consequat', '1', 0, 0, '2017-10-15 19:08:56', '2017-10-15 19:08:56'),
	(8, 'The Story of How a 21 year old become a billionaire nn', '"aaSorting": []"aaSorting": []"aaSorting": []"aaSorting": []', '1', 1, 0, '2017-10-15 22:06:36', '2017-10-15 22:06:36');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table larablog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table larablog.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Seun Matt', 'test@test.com', '$2y$10$0C6PgDg1ZKevUs2xR1kN2O9xI/folM321wMfbhwCSCmwK/I1Ib2jW', 1, '0tyxULShzHb8KWXM9gXlTUHwLsHrVGjE7zRcEkoCS4ATIK37yzecNFpdDpnO', NULL, NULL),
	(2, 'Test Man', 'test@man.com', '$2y$10$msafSVeAFBn6FJWBzhklruRsFe9bJbQnVMaZi2Wdl9TnKv6KqvlsK', 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
