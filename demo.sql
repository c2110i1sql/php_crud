
-- DROP DATABASE `ontap_php`;
CREATE DATABASE `ontap_php` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

use ontap_php;


CREATE TABLE IF NOT EXISTS `category` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp DEFAULT NOW(),
  `updated_at` date DEFAULT NULL
) ENGINE = InnoDB;

INSERT INTO `category` SET `name` = 'Áo nam', status = 1;
INSERT INTO `category` SET `name` = 'Áo nữ', status = 0;
INSERT INTO `category` SET `name` = 'Quần bà ba', status = 1;
INSERT INTO `category` SET `name` = 'Túi ông tư', status = 1;
INSERT INTO `category` SET `name` = 'Bỉm baby', status = 0;

CREATE TABLE IF NOT EXISTS `product` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `image` VARCHAR(200) NOT NULL,
  `price` FLOAT(10,3) NOT NULL,
  `sale` FLOAT(8,3) DEFAULT '0',
  `content` text NULL,
  `category_id` int NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp DEFAULT NOW(),
  `updated_at` date DEFAULT NULL,
   FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE = InnoDB;