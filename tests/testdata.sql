CREATE TABLE IF NOT EXISTS `url_mappings` (
  `id` bigint unsigned,
  `key` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
);
INSERT INTO `url_mappings` VALUES
(1,'8oEFlG','www.google.com',1,'2020-12-22 06:36:47','2020-12-22 06:39:57'),
(2,'rIgAU6','',0,'2020-12-22 06:36:47','2020-12-22 06:57:04'),
(3,'EAEKBy','',0,'2020-12-22 06:36:47','2020-12-22 06:57:30'),
(4,'Ue9boi','',0,'2020-12-22 06:36:47','2020-12-22 06:57:39'),
(5,'maSvTV','',0,'2020-12-22 06:36:47','2020-12-22 06:57:59');
