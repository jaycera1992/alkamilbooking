-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table aristostar.s_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `s_users` DISABLE KEYS */;
INSERT INTO `s_users` (`user_id`, `first_name`, `last_name`, `email_address`, `password`, `contact_number`, `designation`, `role`, `created_user_id`, `updated_user_id`, `is_deleted`, `date_created`, `date_updated`) VALUES
	('015c7cf625cd5b7194671ea52', 'Yareld', 'Angerson', 'yerald@aristostar.com', '$2a$10$bbdbf02a918c9948166d7uSzCWQV3em2ye0uPSBt0fM7pggH6CnIy', '+971563412311', 'Sales Representative', 3, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 0, '2018-08-13 18:23:35', '2018-08-13 18:23:48'),
	('804625ba55805b557db33dea5', 'Administrator', '', 'admin@aristostar.com', '$2a$10$2404bbac308504fe53556eTuyu1gFmWIWZ/ARNNFYy5qRVPjWCGJi', '+971555192830', 'CEO', 1, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 0, '2018-07-23 11:02:26', '2018-08-13 23:58:02'),
	('b9a5b9dc2a565b718e287c49e', 'Marife', 'Zhian', 'marife@aristostar.com', '$2a$10$7304cbf7ce35f8441825fuRqT2wi3o9nr2BQ2St1ACflzYQ2KzO6u', '+971531234511', 'Sales Representative', 3, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 1, '2018-08-13 17:56:56', '2018-08-14 00:14:28');
/*!40000 ALTER TABLE `s_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
