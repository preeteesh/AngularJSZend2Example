/*
SQLyog Ultimate v11.42 (64 bit)
MySQL - 5.6.16 : Database - primrose
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`primrose` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `primrose`;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `Address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_line_1` varchar(100) DEFAULT NULL,
  `address_line_2` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `address` */

insert  into `Address`(`id`,`address_line_1`,`address_line_2`,`town`,`post_code`,`telephone`,`fax`,`email`) values (1,'223','','London','AB 1234 CD','07 - 9522 - 1462','','myemail@primrose.co.uk'),(2,'7 Dunglass House','Shrubbery','Newbury','RG14 6HP','+421 907157945','123456789','myhovercraftisfullofeels@primrose.co.uk'),(3,'5 baytree terrace','Jamie\'s Den','Reading','RG14 BLA','87541384','','tstme@primrose.co.uk'),(4,'20 Eastgate','','Reading','RG14 OMG','7897118181','4571111891','whysoserious@primrose.co.uk'),(5,'A nice place','to live','Newbury','RG17 HD','123456789','5148741618','holyhandgrenade@primrose.co.uk'),(6,'This address ',' doens\'t work properly','London','AB1234','544871181','','ministry_of_silly_walks@primrose.co.uk'),(7,'Yet Another nice place ',' to live','Newbury','RG17 HD','97151818','','myownemail@primrose.co.uk');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `Supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `Supplier`(`id`,`supplier_name`) values (1,'Garden Beauty'),(2,'Small Lion'),(3,'Hozemock'),(4,'Queens Quality Seeds'),(5,'Lo - Gear'),(6,'BYOB'),(7,'MX Sales');

/*Table structure for table `supplier_addresses` */

DROP TABLE IF EXISTS `supplier_addresses`;

CREATE TABLE `supplier_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `address_id` (`address_id`),
  CONSTRAINT `supplier_addresses_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `supplier_addresses_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `supplier_addresses` */

insert  into `supplier_addresses`(`id`,`supplier_id`,`address_id`) values (1,1,6),(2,2,5),(3,4,1),(4,5,3),(5,6,2),(6,7,4),(7,2,7);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
