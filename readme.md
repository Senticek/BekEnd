Username for Admin: adminTest
Password for Admin: tester

after logging to admin account, in menu, button for administration will appear, administration is only accessible for user with admin identity, all editable items can be found there.Portfolio add items moves image to img/potfolio location and logo edit will move it to img and can be used after their assignment.
urls are not fixed therefore urls in edit are necessary to be written with http or https.In latte they are not fixed on one or another protocol,it depends on what administrator saved into database.


Sql database export:

-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `phone` char(40) CHARACTER SET utf8 DEFAULT NULL,
  `message` text CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `descriptions`;
CREATE TABLE `descriptions` (
  `id` int(11) NOT NULL,
  `descriptions` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `descriptions` (`id`, `descriptions`) VALUES
(1,	'Aplikace'),
(2,	'Nette - Symfony - Laravel'),
(3,	'DCSoft stránka'),
(4,	'favicon.ico');

DROP TABLE IF EXISTS `footeradress`;
CREATE TABLE `footeradress` (
  `id` int(11) NOT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `psc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `footeradress` (`id`, `adress`, `psc`) VALUES
(2,	'Ulice 123/45',	'606 00 Brno');

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(5) NOT NULL,
  `text` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `clickableText` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `links` (`id`, `text`, `url`, `clickableText`) VALUES
(1,	'Více informací naleznete na',	'https://dcsoft.cz/',	'dcsoft.cz'),
(2,	'adw',	'google.com',	'test');

DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `logo` (`id`, `image`) VALUES
(1,	'assets/img/logo.png');

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE `portfolio` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `headline` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `text` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `portfolio` (`id`, `image`, `headline`, `text`) VALUES
(102,	'assets/img/portfolio/game.png',	'Projekt #1',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque                                     assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam                                     velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.'),
(103,	'assets/img/portfolio/submarine.png',	'Projekt #3',	'adw'),
(104,	'assets/img/portfolio/cake.png',	'Projekt #4',	'Více informací naleznete na'),
(105,	'assets/img/portfolio/safe.png',	'Projekt #5',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque                                     assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam                                     velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.'),
(110,	'assets/img/portfolio/android_architecture.jpg',	'projekt test',	'test obrazek');

DROP TABLE IF EXISTS `socialnet`;
CREATE TABLE `socialnet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `socialnet` (`id`, `title`, `url`) VALUES
(1,	'facebook-f',	'facebook.com'),
(2,	'twitter',	NULL),
(3,	'linkedin-in',	NULL),
(4,	'dribble',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8 NOT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(25,	'adminTest',	'kljljk@gmail.com',	'$2y$12$KH3mmvLaiCO.YJdtl9Lf/uUgQe3sq/75kuAfbUKlsdWO83ybzAzIC',	'admin'),
(29,	'test',	'tomas.svoboda111@gmail.com',	'$2y$12$3exibwizZIpPU9JVf0YU5OdBAAtVBOiPPhxw4D4squU78U1Q2dH7W',	'uzivatel');


