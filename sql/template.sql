CREATE DATABASE IF NOT EXISTS `dbname`
USE `dbname`;

/* Putting everything in backticks is mysqldump's default */
CREATE TABLE `tablename` (
  `id` int(11)        AUTO_INCREMENT NOT NULL,
  `username`          varchar(128) NOT NULL,
  `password`          varchar(128) NOT NULL,
  `email`             varchar(128) NOT NULL,
  `cookie`            varchar(256) NOT NULL,
  `salt`              varchar(256) NOT NULL,
  `verification_code` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
);

/* Slightly less guaranteed syntax */
CREATE TABLE IF NOT EXISTS contacts (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    first_name  VARCHAR(50) NOT NULL,
    last_name   VARCHAR(50) NOT NULL,
    phone       VARCHAR(15) NOT NULL,
    email       VARCHAR(100) NOT NULL,
    UNIQUE KEY unique_email (email)
);