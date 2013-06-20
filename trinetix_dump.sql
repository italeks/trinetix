/*
SQLyog Community v10.51
MySQL - 5.5.29-0ubuntu0.12.10.1 : Database - trinetix
*********************************************************************
*/


SET NAMES utf8;


CREATE DATABASE /*!32312 IF NOT EXISTS*/`trinetix` DEFAULT CHARACTER SET utf8 ;

USE `trinetix`;

/*Table structure for table `items_tree` */

DROP TABLE IF EXISTS `items_tree`;

CREATE TABLE `items_tree` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `left_key` int(10) NOT NULL DEFAULT '0',
  `right_key` int(10) NOT NULL DEFAULT '0',
  `level` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `left_key` (`left_key`,`right_key`,`level`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `items_tree` */

insert  into `items_tree`(`id`,`name`,`left_key`,`right_key`,`level`) values (1,'Напитки',1,32,1),(2,'Соки',2,9,2),(3,'Газированые',10,23,2),(4,'Акогольные',24,31,2),(5,'Сандора',3,8,3),(6,'Кока-кола',11,12,3),(7,'Фанта',13,20,3),(8,'Спрайт',21,22,3),(9,'Водка',25,30,3),(10,'Сандора Томат',4,5,4),(11,'Сандора Березовый',6,7,4),(12,'Фанта апельсин',14,15,4),(13,'Фанта лимон',16,17,4),(14,'Фанта вишня',18,19,4),(15,'Хортица',26,27,4),(16,'Немиров',28,29,4);

