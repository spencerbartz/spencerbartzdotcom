CREATE DATABASE IF NOT EXISTS `sitedbmain`;
USE `sitedbmain`;

CREATE TABLE IF NOT EXISTS `users` (
  `id`                INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `username`          VARCHAR(128) NOT NULL UNIQUE,
  `password`          VARCHAR(128) NOT NULL,
  `email`             VARCHAR(128) NOT NULL UNIQUE,
  `cookie`            VARCHAR(256) NOT NULL,
  `salt`              VARCHAR(256) NOT NULL,
  `verification_code` VARCHAR(256) NOT NULL,
  `user_type`         VARCHAR(128) NOT NULL,
  `verified`          BOOLEAN DEFAULT FALSE,
  `invitation_sent`   BOOLEAN DEFAULT FALSE,
  `reset_password`    BOOLEAN DEFAULT FALSE,
  `date_created`      DATETIME,
  `date_last_updated` DATETIME
);

INSERT INTO `users` VALUES (1,'okyakusan','1dukX3.KTnx..','admin@spencerbartz.com','','1d51980ee487abaa','','guest', NOW(), NOW());

CREATE TABLE IF NOT EXISTS `images` (
  `id`                INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `image_data`        LONGBLOB NOT NULL,
  `image_name`        VARCHAR(256) NOT NULL UNIQUE,
  `min_user_type`     VARCHAR(128) NOT NULL,
  `date_created`      DATETIME,
  `date_last_updated` DATETIME
);

CREATE TABLE IF NOT EXISTS `videos` (
  `id`                INT(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `video_data`        LONGBLOB NOT NULL,
  `video_name`        VARCHAR(256) NOT NULL UNIQUE,
  `min_user_type`     VARCHAR(128) NOT NULL,
  `date_created`      DATETIME,
  `date_last_updated` DATETIME
);
