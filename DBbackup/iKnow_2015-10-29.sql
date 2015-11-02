# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: gene.rnet.missouri.edu (MySQL 5.0.95)
# Database: iKnow
# Generation Time: 2015-10-29 19:31:08 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin` (
  `adminid` int(11) NOT NULL,
  `username` varchar(45) NOT NULL default '',
  `password` varchar(45) NOT NULL default '',
  `email` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;

INSERT INTO `Admin` (`adminid`, `username`, `password`, `email`)
VALUES
	(1,'siman','111','1@gmail.com');

/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Category`;

CREATE TABLE `Category` (
  `catid` int(11) NOT NULL,
  `name` varchar(45) default NULL,
  `describe` varchar(45) default NULL,
  `pic` longblob,
  PRIMARY KEY  (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;

INSERT INTO `Category` (`catid`, `name`, `describe`, `pic`)
VALUES
	(1,'推拿按摩','推拿按摩',''),
	(2,'刮痧火罐','刮痧火罐',NULL),
	(3,'汗蒸浴场','汗蒸浴场',NULL),
	(4,'足疗养生','足疗养生',NULL),
	(5,'中医康复','中医康复',NULL),
	(6,'疾病调理','疾病调理',NULL),
	(7,'单项调理','单项调理',NULL),
	(8,'根骶疗法','根骶疗法',NULL),
	(9,'中医艾灸','中医艾灸',NULL),
	(10,'五行调理','五行调理',NULL);

/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Comment`;

CREATE TABLE `Comment` (
  `orderid` int(11) unsigned NOT NULL auto_increment,
  `massaid` varchar(20) NOT NULL default '',
  `date` datetime NOT NULL,
  `content` varchar(300) NOT NULL default '',
  `stars` enum('1','2','3','4','5') NOT NULL default '3',
  `customerid` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`orderid`),
  KEY `FK_customer` (`customerid`),
  KEY `FK_massaid` (`massaid`),
  CONSTRAINT `FK_massaid` FOREIGN KEY (`massaid`) REFERENCES `MassagistDetail` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_customer` FOREIGN KEY (`customerid`) REFERENCES `Customer` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_order` FOREIGN KEY (`orderid`) REFERENCES `Order` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23510 DEFAULT CHARSET=utf8;

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;

INSERT INTO `Comment` (`orderid`, `massaid`, `date`, `content`, `stars`, `customerid`)
VALUES
	(23452,'18910907795','2015-10-04 16:15:52','呵呵','5','1'),
	(23453,'15652519917','2015-10-04 16:16:02','呵呵呵','5','1'),
	(23458,'15652519917','2015-10-04 04:23:08','测试1','5','6268981388'),
	(23460,'15652519917','2015-10-04 16:16:16','呵呵呵','5','1'),
	(23462,'15652519917','2015-10-04 04:30:11','Ffg','5','6268981388'),
	(23463,'18618329557','2015-10-04 04:30:43','11111','4','6268981388'),
	(23464,'15652519917','2015-10-04 04:31:44','','3','6268981388'),
	(23465,'15652519917','2015-10-04 15:42:06','Hhh','5','6268981388'),
	(23466,'15652519917','2015-10-04 15:42:14','Hhh','5','6268981388'),
	(23467,'15652519917','2015-10-11 18:52:32','哈哈哈哈','5','6268981388'),
	(23468,'15652519917','2015-10-05 14:34:13',' ','5','6268981388'),
	(23472,'18618329557','2015-10-05 17:58:51','Good','5','1'),
	(23473,'15652519917','2015-10-26 22:28:47','l l l','5','6268981388'),
	(23475,'18618329557','2015-10-04 15:42:28','Hhh','1','6268981388'),
	(23476,'15652519917','2015-10-26 22:29:00','l l l','5','6268981388'),
	(23477,'15652519917','2015-10-05 14:34:22','Hhh','5','6268981388'),
	(23478,'15652519917','2015-10-04 18:20:54','借记卡额','5','1'),
	(23479,'18618329557','2015-10-26 22:29:06','l l l','5','6268981388'),
	(23481,'15652519917','2015-10-08 05:50:15','呵呵','5','6268981388'),
	(23482,'15652519917','2015-10-08 21:48:51','呵呵呵呵呵','5','6268981388'),
	(23483,'15652519917','2015-10-08 22:01:15','还呵呵呵呵呵呵','5','6268981388'),
	(23503,'15652519917','2015-10-15 08:06:47','呵呵','5','6268981388'),
	(23506,'15652519917','2015-10-26 22:06:10','呵呵','5','6268981388'),
	(23507,'15652519917','2015-10-26 22:02:51','健健康康','5','6268981388'),
	(23508,'15652519917','2015-10-22 19:17:28','Hffh','3','12345678'),
	(23509,'15652519917','2015-10-22 19:19:41','Gggg','5','12345678');

/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Customer`;

CREATE TABLE `Customer` (
  `phone` varchar(20) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `signupdate` date NOT NULL,
  `Country` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;

INSERT INTO `Customer` (`phone`, `password`, `signupdate`, `Country`)
VALUES
	('1','c4ca4238a0b923820dcc509a6f75849b','0000-00-00','86'),
	('12345678','25d55ad283aa400af464c76d713c07ad','0000-00-00','86'),
	('6268981388','9cafeef08db2dd477098a0293e71f90a','2015-09-30','86');

/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Has_Service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Has_Service`;

CREATE TABLE `Has_Service` (
  `hsid` int(11) NOT NULL auto_increment COMMENT '\\n',
  `masaid` varchar(20) NOT NULL default '',
  `serviceid` int(11) NOT NULL,
  `amount` int(11) NOT NULL default '0',
  `comment_sum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`hsid`),
  KEY `massagist_idx` (`masaid`),
  KEY `service_idx` (`serviceid`),
  CONSTRAINT `HSmassagist` FOREIGN KEY (`masaid`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `HSservice` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

LOCK TABLES `Has_Service` WRITE;
/*!40000 ALTER TABLE `Has_Service` DISABLE KEYS */;

INSERT INTO `Has_Service` (`hsid`, `masaid`, `serviceid`, `amount`, `comment_sum`)
VALUES
	(1,'15136352580',1,7,0),
	(2,'15136352580',3,8,0),
	(3,'15136352580',4,0,0),
	(4,'15136352580',5,0,0),
	(5,'15136352580',6,0,0),
	(6,'15136352580',7,0,0),
	(7,'15136352580',8,0,0),
	(8,'15136352580',9,0,0),
	(9,'15136352580',10,0,0),
	(10,'15136352580',11,0,0),
	(11,'15136352580',12,0,0),
	(12,'15136352580',13,0,0),
	(13,'15136352580',14,0,0),
	(15,'15136352580',15,0,0),
	(16,'15136352580',16,0,0),
	(17,'15136352580',17,0,0),
	(18,'15036391991',1,0,0),
	(19,'15036391991',2,0,0),
	(20,'15036391991',3,0,0),
	(21,'15036391991',4,0,0),
	(22,'15036391991',5,0,0),
	(23,'15136352580',2,0,0),
	(24,'15036391991',6,0,0),
	(25,'15036391991',7,0,0),
	(26,'15036391991',8,0,0),
	(27,'15036391991',9,0,0),
	(28,'15036391991',10,0,0),
	(29,'15036391991',11,0,0),
	(30,'15036391991',12,0,0),
	(31,'15036391991',13,0,0),
	(32,'15036391991',14,0,0),
	(33,'15036391991',15,0,0),
	(34,'15036391991',16,0,0),
	(35,'15036391991',17,0,0),
	(36,'13233997914',1,0,0),
	(37,'13233997914',2,0,0),
	(38,'13233997914',3,0,0),
	(39,'13233997914',4,0,0),
	(40,'13233997914',5,0,0),
	(41,'13233997914',6,0,0),
	(42,'13233997914',7,0,0),
	(43,'13233997914',8,0,0),
	(44,'13233997914',9,0,0),
	(45,'13233997914',10,0,0),
	(46,'13233997914',11,0,0),
	(47,'13233997914',12,0,0),
	(48,'13233997914',13,0,0),
	(49,'13233997914',14,0,0),
	(50,'13233997914',15,0,0),
	(51,'13233997914',16,0,0),
	(52,'13233997914',17,0,0),
	(53,'15036995492',1,0,0),
	(54,'15036995492',2,0,0),
	(55,'15036995492',3,0,0),
	(56,'15036995492',4,0,0),
	(57,'15036995492',5,0,0),
	(58,'15036995492',6,0,0),
	(59,'15036995492',7,0,0),
	(60,'15036995492',8,0,0),
	(61,'15036995492',9,0,0),
	(62,'15036995492',10,0,0),
	(63,'15036995492',11,0,0),
	(64,'15036995492',12,0,0),
	(65,'15036995492',13,0,0),
	(66,'15036995492',14,0,0),
	(67,'15036995492',15,0,0),
	(68,'15036995492',16,0,0),
	(69,'15036995492',17,0,0),
	(70,'13938813461',1,0,0),
	(71,'13938813461',2,0,0),
	(72,'13938813461',3,0,0),
	(73,'13938813461',4,0,0),
	(74,'13938813461',5,0,0),
	(75,'13938813461',6,0,0),
	(76,'13938813461',7,0,0),
	(77,'13938813461',8,0,0),
	(78,'13938813461',9,0,0),
	(79,'13938813461',10,0,0),
	(80,'13938813461',11,0,0),
	(81,'13938813461',12,0,0),
	(82,'13938813461',13,0,0),
	(83,'13938813461',14,0,0),
	(84,'13938813461',15,0,0),
	(85,'13938813461',16,0,0),
	(86,'13938813461',17,0,0),
	(87,'15515339859',1,0,0),
	(88,'15515339859',2,0,0),
	(89,'15515339859',3,0,0),
	(90,'15515339859',4,0,0),
	(91,'15515339859',5,0,0),
	(92,'15515339859',6,0,0),
	(93,'15515339859',7,0,0),
	(94,'15515339859',8,0,0),
	(95,'15515339859',9,0,0),
	(96,'15515339859',10,0,0),
	(97,'15515339859',11,0,0),
	(98,'15515339859',12,0,0),
	(99,'15515339859',13,0,0),
	(100,'15515339859',14,0,0),
	(101,'15515339859',15,0,0),
	(102,'15515339859',16,0,0),
	(103,'15515339859',17,0,0),
	(104,'15981947606',1,0,0),
	(105,'15981947606',2,0,0),
	(106,'15981947606',3,0,0),
	(107,'15981947606',4,0,0),
	(108,'15981947606',5,0,0),
	(109,'15981947606',6,0,0),
	(110,'15981947606',7,0,0),
	(111,'15981947606',8,0,0),
	(112,'15981947606',9,0,0),
	(113,'15981947606',10,0,0),
	(114,'15981947606',11,0,0),
	(115,'15981947606',12,0,0),
	(116,'15981947606',13,0,0),
	(117,'15981947606',14,0,0),
	(118,'15981947606',15,0,0),
	(119,'15981947606',16,0,0),
	(120,'15981947606',17,0,0);

/*!40000 ALTER TABLE `Has_Service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Massagist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Massagist`;

CREATE TABLE `Massagist` (
  `phone` varchar(20) NOT NULL default '',
  `password` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Massagist` WRITE;
/*!40000 ALTER TABLE `Massagist` DISABLE KEYS */;

INSERT INTO `Massagist` (`phone`, `password`)
VALUES
	('1','1'),
	('13233997914','670b14728ad9902aecba'),
	('13611076322','670b14728ad9902aecba'),
	('13837943124','670b14728ad9902aecba'),
	('13838484868','670b14728ad9902aecba'),
	('13938813461','670b14728ad9902aecba'),
	('15036391991','670b14728ad9902aecba'),
	('15036995492','670b14728ad9902aecba'),
	('15136352580','670b14728ad9902aecba'),
	('15515339859','670b14728ad9902aecba'),
	('15652519917','670b14728ad9902aecba'),
	('15981947606','670b14728ad9902aecba'),
	('18516866236','670b14728ad9902aecba'),
	('18612980135','670b14728ad9902aecba'),
	('18618329557','670b14728ad9902aecba'),
	('18683990175','670b14728ad9902aecba'),
	('18910535092','670b14728ad9902aecba'),
	('18910907795','670b14728ad9902aecba');

/*!40000 ALTER TABLE `Massagist` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table massagist_appt
# ------------------------------------------------------------

DROP TABLE IF EXISTS `massagist_appt`;

CREATE TABLE `massagist_appt` (
  `orderid` int(11) unsigned NOT NULL auto_increment,
  `massaid` varchar(20) NOT NULL default '',
  `start` datetime NOT NULL,
  `end` datetime default NULL,
  `serviceid` int(11) default NULL,
  `customerid` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`orderid`),
  KEY `massaid_fk` (`massaid`),
  KEY `serviceid_fk` (`serviceid`),
  KEY `customerid_fk` (`customerid`),
  CONSTRAINT `customerid_fk` FOREIGN KEY (`customerid`) REFERENCES `Customer` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `massaid_fk` FOREIGN KEY (`massaid`) REFERENCES `MassagistDetail` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_pk` FOREIGN KEY (`orderid`) REFERENCES `Order` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `serviceid_fk` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23510 DEFAULT CHARSET=utf8;

LOCK TABLES `massagist_appt` WRITE;
/*!40000 ALTER TABLE `massagist_appt` DISABLE KEYS */;

INSERT INTO `massagist_appt` (`orderid`, `massaid`, `start`, `end`, `serviceid`, `customerid`)
VALUES
	(23450,'18618329557','2015-03-02 12:10:10','2015-03-02 13:10:10',1,'1'),
	(23492,'15652519917','2015-10-14 08:00:00','2015-10-14 09:00:00',1,'6268981388'),
	(23495,'15652519917','2015-10-14 11:00:00','2015-10-14 12:00:00',1,'6268981388'),
	(23499,'15652519917','2015-10-21 08:00:00','2015-10-21 09:00:00',1,'6268981388'),
	(23501,'15652519917','2015-11-17 11:00:00','2015-11-17 12:00:00',1,'6268981388'),
	(23502,'15652519917','2015-10-16 13:00:00','2015-10-16 14:00:00',2,'6268981388'),
	(23503,'15652519917','2015-10-15 20:00:00','2015-10-15 21:00:00',4,'6268981388'),
	(23505,'15652519917','2015-10-28 20:00:00','2015-10-28 21:00:00',1,'6268981388'),
	(23506,'15652519917','2015-10-19 20:00:00','2015-10-19 21:00:00',1,'6268981388'),
	(23507,'15652519917','2015-10-20 12:00:00','2015-10-20 13:00:00',2,'6268981388'),
	(23508,'15652519917','2015-10-22 20:00:00','2015-10-22 21:00:00',1,'12345678'),
	(23509,'15652519917','2015-10-22 10:00:00','2015-10-22 11:00:00',1,'12345678');

/*!40000 ALTER TABLE `massagist_appt` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table MassagistDetail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `MassagistDetail`;

CREATE TABLE `MassagistDetail` (
  `phone` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL default '',
  `stars` enum('1','2','3') NOT NULL default '3',
  `shopid` int(11) NOT NULL,
  `pic` varchar(200) NOT NULL default '',
  `intro` varchar(500) NOT NULL default '',
  `level` enum('M','H','E') NOT NULL default 'M',
  `visiting_start` time default NULL,
  `visiting_end` time default NULL,
  `city` varchar(100) NOT NULL default '',
  `province` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`phone`),
  KEY `mstore_idx` (`shopid`),
  CONSTRAINT `mdphone` FOREIGN KEY (`phone`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mdshop` FOREIGN KEY (`shopid`) REFERENCES `Shop` (`shopid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `MassagistDetail` WRITE;
/*!40000 ALTER TABLE `MassagistDetail` DISABLE KEYS */;

INSERT INTO `MassagistDetail` (`phone`, `name`, `stars`, `shopid`, `pic`, `intro`, `level`, `visiting_start`, `visiting_end`, `city`, `province`)
VALUES
	('1','1','3',2,'','','M',NULL,NULL,'',''),
	('13233997914','韦雪玲','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/13233997914.png','擅长：足浴，保健按摩','H',NULL,NULL,'',''),
	('13611076322','张琴','3',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/13611076322.png','张琴 43岁，足道技术精湛，通过足底反射区准确知道问题所在，曾成功调理腿脚麻木，风湿性关节炎，高血压患者。擅长踩背，治愈腰间盘突出，腰肌劳损等。','H',NULL,NULL,'',''),
	('13837943124','孔滨','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/13837943124.png','擅长：颈肩腰腿痛，足浴','H',NULL,NULL,'',''),
	('13838484868','胡楠楠','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/13838484868.png','擅长：中医推拿，刮痧','H',NULL,NULL,'',''),
	('13938813461','孙建波','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/13938813461.png','擅长：足浴，推拿，精油排毒','H',NULL,NULL,'',''),
	('15036391991','李晓伟','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/15036391991.png','擅长；颈肩腰腿疼的调理','H',NULL,NULL,'',''),
	('15036995492','郭艳平','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/15036995492.png','','H',NULL,NULL,'',''),
	('15136352580','李毅江','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/15136352580.png','2012年毕业于河南推拿学院 针推专业；2013年进修于北京东城区中医院疼痛科；擅长：中医推拿，足浴痛症调理','H',NULL,NULL,'',''),
	('15515339859','刘卫国','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/15515339859.png','擅长：各类骨病，颈肩腰腿痛及疑难杂症；诊治疗效显著且无副作用','E',NULL,NULL,'',''),
	('15652519917','梁海珊','2',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/15652519917.png','梁海珊，河北保定人，1968年出生，中医调理师。35岁开始学习中医推拿，专业调理、精油spa、中医推拿、中医足道，2年前跟随张珑曦老师学习根骶能量疗法。擅长调理：颈椎病、关节炎、肩周炎、骨质增生、腰间突出、高血压、失眠、妇科炎症、亚健康等人群。','H',NULL,NULL,'',''),
	('15981947606','丁瑞超','3',2,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/15981947606.png','擅长;颈肩腰腿痛，脊椎类疾病及偏瘫后遗症','H',NULL,NULL,'',''),
	('18516866236','廖长亮','3',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/18516866236.png','廖长亮：32岁，玄极功法传承人之一，玄极功法以“太极功法”为基础，结合摸、提、推、拿、按、点、摩等复合手法，作用人体头、颈、肩、臂、腹、背、腰、眼、足等部位，能够起到疏通经络、调理脏腑、理筋复位、协调阴阳、有症调愈、无病养生的作用，达到“筋柔者百病不生、阴平阳秘、培元固本”之神奇功效，安全舒适、无任何副作用。\r专业调理：1.颈肩腰腿痛、颈椎病、肩周炎、腰椎间盘突出、四肢麻木、中风后遗症。\r2.头痛、头晕、前列腺、乳腺增生等疾病。','H',NULL,NULL,'',''),
	('18612980135','高永帅','3',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/18612980135.png','高永帅，25岁，河北霸州人，十七岁跟随张珑曦学习根骶调理术，专注于《黄帝内经》的精髓，在继承祖传中医的基础上，有融合了现代医学和心理学的先进理念，手法中以轻软、渗透、持续、缠绵，以意领气，以气行学，激发人体本元之气，补虚养元，终使人体阴平阳秘，引阴入阳，从而达到精气神疗法的最高境界，为中医外治手法又增一朵奇葩，即为“根骶能量健康法”。擅长调理乳腺增生，类风湿，便秘等问题。','H',NULL,NULL,'',''),
	('18618329557','张珑曦','3',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/18618329557.png','珑曦先生，河北霸州人，自幼习武。十六岁时跟随长辈学习根骶调理术，专注于《黄帝内经》的精髓，在继承祖传中医的基础上，有融合了现代医学和心理学的先进理念，经过近二十年的临床实践发现了未被文献记载的人体自我调节规律！他在临床实践中潜心研究，积累经验，为这种民间疗法寻找理论依据，用心观察自然，在大自然中需找答案，逐步完善了这种了疗法。手法中以轻软、渗透、持续、缠绵，以意领气，以气行学，激发人体本元之气，补虚养元，终使人体阴平阳秘，引阴入阳，从而达到精气神疗法的最高境界，为中医外治手法又增一朵奇葩，即为“根骶能量健康法”。擅长调理妇科，腰间盘突出，阳痿早泄等一系列疾病。','H',NULL,NULL,'',''),
	('18683990175','高明秀','3',3,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/18683990175.png','擅长：通过脊柱疏通调理鼻炎，头痛，乳腺增生，肩周炎，痛经，前列腺炎等亚健康疾病。','M',NULL,NULL,'',''),
	('18910535092','吴京龙','3',3,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/18910535092.png','擅长：调理颈肩腰腿痛，坐骨神经痛，女性宫寒，月经不调，痛经，男性前列腺炎，阳痿，早泄','M',NULL,NULL,'',''),
	('18910907795','刘国斋','3',1,'http://gene.rnet.missouri.edu/iKnow/img/mathumb/18910907795.png','刘国斋，中医调理师，34岁、26岁开始从事中医专业调理，擅长调理虚火引起的牙疼，咽喉疼，肩周疼痛，月经不调乳腺增生、失眠、头疼，增补充元气、去除寒湿。补肾效果明显。','H',NULL,NULL,'','');

/*!40000 ALTER TABLE `MassagistDetail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL default '',
  `content` varchar(2000) NOT NULL default '',
  `pic` varchar(100) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `title`, `content`, `pic`)
VALUES
	(1,'六种腹痛会要命，千万不可小视','几乎每个人都经历过腹痛，但大多认为“忍一忍、揉一揉，做个热敷就过去了”。甚至有些中老年人因腹痛进了医院，如果医生开心电图、腹部CT等检查，还要埋怨医生“乱开检查，没医德”。其实，腹痛是急诊科最常见的就诊原因，也是一项最复杂的临床症状。老年人腹痛更是严重疾病的信号，一旦误诊误治还可能危及生命。以下六种十分凶险的疾病都可以出现腹痛。\n<br>\n大约有8%的急性心肌梗死患者，在早期可表现为突发上腹部剧痛，伴有恶心呕吐，局部可有或无压痛，容易误诊为胃及十二指肠溃疡急性穿孔、急性胆囊炎等。所以，既往有冠心病、心绞痛病史的中老年病人，如果突然出现上腹剧痛，一定要警惕急性心肌梗死的可能。\n<br>\n心绞痛的疼痛可位于胸骨下段、左心前区或上腹部，放射至颈、下颌、左肩胛部或右前胸，疼痛可很快消失或仅有左前胸不适、发闷感，与活动相关，休息可以缓解。少数会表现为静息性上腹痛，很容易误诊为急性胃肠炎。\n<br>\n腹痛、腹胀、在腹部可触及','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img1.jpeg'),
	(2,'[秋季养生食谱]之杂骨菌菇汤]','杂骨菌菇汤，里面放了少量的枸杞子，枸杞滋补肝肾、益精明目。平日多喝菌类的汤，可以有效的给身体排毒，清理肠胃。\n<br>\n准备食材：<br>\n排骨100克、金针菇1小把、草菇2个、平菇2个、口蘑2个、枸杞6颗、姜3片、葱1根、料酒2茶匙、盐1茶匙、白胡椒粉少许。\n<br>\n做法：<br>\n步骤1：把菌菇等材料洗净切好，葱洗干净切成葱花。<br>\n步骤2：将菌菇放盐水里泡十分钟，再捞出沥干水分。<br>\n步骤3：杂骨用水冲洗干净，焯水后捞出用流动的水冲洗干净。放入锅中，倒入足够量的水，放姜片、料酒，中火煮开后转小火，盖上盖子炖半个小时左右。<br>\n步骤4：锅里杂骨汤炖的差不多了，开盖，把菌菇和枸杞子放入锅中，盖上盖子继续炖半小时左右。<br>\n步骤5：加盐和白胡椒粉调味，撒上葱花就可以了。','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img2.jpeg'),
	(3,'治疗口腔溃疡的九个小秘方','很多人都可能发生过口腔溃疡，一般而言，口腔内出现的溃疡95%是复发性口腔溃疡(俗称口疮)，它是最常见的口腔黏膜疾病，与龋齿、牙周病一样也是最常见的口腔疾病之一。在口腔里任何一个部位都可能发生溃疡，甚至舌头上都可能发生，具有红、黄、凹、痛四个特点。<br>\n　　红——开始只是一个圆形或者椭圆形的白点，慢慢扩大，周围的黏膜变成红色。<br>\n　　黄——过了一两天后，由于纤维素渗出，中间白色的溃疡变成黄色。<br>\n　　凹——四周黏膜稍微高点，溃疡中心部位凹进去。<br>\n　　痛——由于存在炎症，疼痛明显。<br>\n\n　　治疗口腔溃疡秘方<br>\n\n　　漱口法<br>\n　　1、姜水漱口<br>\n　　口腔溃疡用热姜水漱口，每日2~3次，一般6~9次溃疡面即可收敛。<br>\n　　2、浓茶漱口<br>\n　　用浓茶漱口，因茶中含有多种维生素，能防治各种炎症，对口腔溃疡面的康复，有一定辅助治疗作用。<br>\n　　3、萝卜藕汁<br>\n　　取生萝卜2只，鲜藕一段洗净捣烂绞汁去渣，用汁含漱，每日3次，连用4天可见效。<br>\n　　维生素<br>\n　　4、维生素E<br>\n　　用针刺破维生素E胶丸，将药液挤出涂于口腔溃疡处，保留1分钟，每日用药4次，于饭后及睡觉前用，一般3天可愈。<br>\n　　5、维生素B2<br>\n　　将维生素B2研为细粉状，用适量香油调匀，做成稀糊状，涂于溃疡表面，每日4～6次。具有不苦，不涩，味香，无刺激性，止痛等良好功效。连用2～3天，口腔溃疡可获愈。<br>\n　　6、维生素C片<br>\n　　将维生素C药片压成面，涂在患处，一两次就有效。也可将维生素C研成粉末状，若系小溃疡，仅需取少许敷于患处即可;若溃疡面较大，则应先轻轻刮除溃疡面渗出物，然后再敷药粉。每日用药2～3次，溃疡小者用药1～2次即愈，溃疡大者用药2～3次，疼痛可显著减轻，2～3天溃疡面即可痊愈。<br>\n\n　　药敷法<br>\n　　7、冰糖<br>\n　　口腔溃疡时，在口里含几块冰糖，有一定疗效。<br>\n　　8、云南白药粉<br>\n　　用消毒棉签蘸云南白药粉末敷患处，一般用药3天后可愈合。<br>\n　　9、冰硼散<br>\n　　将冰硼散粉末，涂于患处，1~2次就有效。<br>\n　　医生忠告，复发性口腔溃疡的患者应注意口腔卫生，避免损伤口腔黏膜，同时保持心情舒畅、充足的睡眠，不要过度劳累。<br>','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img3.jpeg'),
	(4,'长期间有这些习惯对身体很不好','都市人工作、生活繁忙，有些不良习惯会导致自己的身体产生不良影响，众惠生活小编或多或少也有些不良习惯，呜呜~问题来了，究竟哪些习惯是不好呢？众惠生活小编在网上搜到一些资讯，居然发现有些看似好的习惯，原来居然是坏的！！这一定要和各位分享一下！<br>\n \n      对身体不利的习惯如果长期发展下去危害极大，说严重点相当于慢性自杀。如果你有下面这些不好的习惯，那么请从今天起慢慢用心去改正吧！<br>\n \n      一、长时间热水泡脚<br>\n \n      大家都知道泡脚对身体有好处，也能解乏，可是长时间热水泡脚不仅会影响血液流量且没有传说中那些治病的功效，最重要的是可能影响睡眠，严重还会危及生命。经常会有新闻报道泡热水脚猝死、泡脚时长影响健康等。所以这类行为大家要避免。泡脚水温不宜过高，且时间不应超过20分钟。<br>\n \n      二、跷二郎腿<br>\n \n      跷二郎腿在工作生活中都会经常见到。但长期跷二郎腿对身体危害很大的！它会影响到男性生殖健康，很容易导致神经压迫症，因重心不稳还会导致脊椎问题，经常跷二郎腿还会导致O型腿的产生。恢复正确坐姿对身体很重要。<br>\n \n      三、冷水洗头<br>\n \n      很多人都喜欢用凉水洗头，但凉水洗头会对身体造成伤害，冷水通过头皮刺激到大脑，经常冷水洗头会导致长期头疼等症状。用冷水洗头不利于新陈代谢，还会导致女孩子经期腹痛等症状。<br>\n \n      四、不盖马桶盖冲厕所<br>\n \n      很多人在如厕后直接冲水，没有盖马桶盖的习惯，殊不知冲水时马桶内的瞬间气旋最高可以将病菌带到6米的高空中，并且病菌的悬浮时间可达几个小时之久。所以不盖马桶盖的行为要尽量改正。<br>\n \n      五、用洗衣机洗内衣<br>\n \n      内衣不可在洗衣机中洗涤，应单独手洗，否则容易造成交叉感染。外衣上的颗粒粉尘细菌等与内衣的各种汗液残留物细菌造成交叉感染，对人体危害可想而知。<br>\n \n      六、睡前玩手机<br>\n \n      都说睡眠时间应该满足7--8小时才有利健康。现在很多年轻人，睡眠时间不仅不足7小时，且睡前玩手机已经成为了他们的习惯。这种行为不仅会导致睡眠质量差，还会直接导致记忆力下降，情绪也会受到影响。长此以往对身体健康危害很大。<br>\n \n      七、吃饭速度过快<br>\n \n      随着生活节奏的加快，很多人的吃饭速度也越来越快，吃饭太快会对消化系统造成极大负担，很容易导致胃痛胃胀，增加肥胖几率。试着慢慢降低你的吃饭速度吧。<br>\n \n      大家要注意自己身体哦！<br>','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img4.jpeg'),
	(5,'健胃、补血、清肺、养阴、补肾应有尽有,建议收藏留作补时用!','通过药材与食物的搭配，借助药材的药效提高汤的营养价值及食用功效。不同的药材有不同的功效，在选用药材时应注意药性，选对药材，才能达到调养身体的目的。<br>\n\n淮山药<br>\n\n1、性味归经】：味甘，性平。归脾，肺，肾经。<br>\n\n2、【功效】：补脾养胃，生津益肺，补肾涩精。其保健作用得机理是可根据身体的需要转化为雄性激素或雌性激素，补充由于衰老和疾病造成的激素失调，从而使人保持旺盛的精力，增强抵御疾病的能力，加速受损组织的修复，并能预防和减缓恶性肿瘤、糖尿病、动脉硬化、心脏病、肥胖、老年痴呆症等。<br>\n\n三七<br>\n\n1、【功能与主治】散瘀止血，消肿定痛。用于咯血，吐血，衄血，便血，崩漏，外伤出血，胸腹刺痛，跌扑肿痛。<br>\n\n2、【食用功效】有益气养血、治疗崩漏、产后虚弱、自汗、盗汗、有滋阳强壮作用。也治疗老年人的头风痛、腰肌酸软无力等症。<br>\n\n枸杞<br>\n\n1、【功能与主治】:滋补肝肾，益精明目。用于虚劳精亏，腰膝酸痛，眩晕耳鸣，内热消渴，血虚萎黄，目昏不明。<br>\n\n黄芪<br>\n\n1、【功能与主治】：补气固表，利尿托毒，排脓，敛疮生肌。用于气虚乏力，食少便溏，中气下陷，久泻脱肛，便血崩漏，表虚自汗，气虚水肿，痈疽难溃，久溃不敛，血虚痿黄，内热消渴;慢性肾炎蛋白尿，糖尿病。蜜制黄芪益气补中。用于气虚乏力，食少便溏。<br>\n\n山楂<br>\n\n1、【功能与主治】消食健胃，行气散瘀。用于肉食积滞，胃脘胀满，泻痢腹痛，瘀血经闭，产后瘀阻，心腹刺痛，疝气疼痛;高脂血症。焦山楂消食导滞作用增强。用于肉食积滞，泻痢不爽。<br>\n\n当归<br>\n\n1、【功能与主治】补血活血，调经止痛、润肠通便。用于血虚萎黄，眩晕心悸，月经不调，经闭痛经，虚寒腹痛，肠燥便秘，风湿痹痛，跌扑损伤，痈疽疮疡。酒当归活血通经。用于经闭痛经，风湿痹痛，跌扑损伤。<br>\n\n天麻<br>\n\n天麻天麻润而不燥，主入肝经，长于平肝息风，凡肝风内动、头目眩晕之症，不论虚实，均为要药。<br>\n\n1、平肝息风。天麻质润多液，能养血息风，可治疗血虚肝风内动的头痛、眩晕，亦可用于小儿惊风、癫痫、破伤风。<br>\n2、祛风止痛。用于风痰引起的眩晕、偏正头痛、肢体麻木、半身不遂。<br>\n\n南沙参<br>\n\n1、【功能主治】养阴清肺，化痰益气。用于肺热燥咳、阴虚劳嗽、干咳痰粘、气阴不足、烦热口干。<br>\n\n北沙参<br>\n\n1、【性味】甘苦淡，凉。<br>\n\n2、【归经】 入肺、脾经。<br>\n\n3、【功能主治】 养阴清肺，益胃生津。用于肺热燥咳、劳嗽痰血、热病津伤口渴。<br>\n\n石斛<br>\n\n养阴生津、增强体质、补益脾胃、护肝利胆、清虚热、强筋壮骨、抑制肿瘤、明亮眼目、延年益寿。<br>\n\n芡实<br>\n1、【药性】甘、涩，平。归脾、肾经。<br>\n\n2、【功效】益肾固精，健脾止泻，除湿止带。<br>\n\n玉竹<br>\n\n1、【性味归经】，味甘，性平。归肺;胃经。<br>\n\n2、【功效主治】滋阴润肺;养胃生津。燥咳;劳嗽;热病阴液耗伤之咽干口渴;内热消渴;阴虚外感;头昏眩晕;筋脉挛痛。<br>\n\n陈皮<br>\n\n1、【性味归经】温;辛、苦;归脾、肺经。<br>\n\n2、【功能主治】调中带滞、顺气消痰、宣通五脏。<br>\n\n桂圆<br>\n\n补益心脾，养血安神。用于气血不足、心悸怔忡、健忘失眠、血虚萎黄。<br>\n\n百合<br>\n\n1、【功能主治】养阴润肺，清心安神。用于阴虚久咳，痰中带血，虚烦惊悸，失眠多梦，精神恍惚。具有养阴润肺止咳功效，用于肺阴虚的燥热咳嗽，痰中带血，如百花膏。治肺虚久咳，劳嗽咯血，如百合固金汤。具有清心安神功效，用于热病余热未清，虚烦惊悸，失眠多梦等。药用时煎服，10～30g。清心宜生用，润肺蜜炙用。<br>\n\n2、【功效】养阴清热，滋补精血。<br>\n\n玉米须<br>\n\n玉米须味甘、淡，性平;归肾、肝、胆经;质轻渗降;具有利尿消肿，平肝利胆的功效;主治水肿，小便淋沥，黄疸，胆囊炎，胆结石，高血压病，糖尿病，乳汁不通。有利尿降压功能。<br>\n\n红豆<br>\n\n1、【性能】味甘，性平。能健脾利湿，散血，解毒。<br>\n\n2、【用途】用于水肿、脚气;产后缺乳，腹泻、黄疸或小便不利;痔疮，肠痈。<br>\n\n杏仁<br>\n\n富含蛋白质、脂肪、糖类、胡萝卜素、B族维生素、维生素C、维生素P以及钙、磷、铁等营养成分。其性苦微温，有小毒，滋润养肺通便。适用于阴虚肺热、咳嗽、咽干舌燥、大便干结者。<br>\n\n罗汉果<br>\n\n其性甘凉，清热润肺止咳通便。<br>','http://gene.rnet.missouri.edu/iKnow/img/disc/disc_img5.jpeg');

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Order`;

CREATE TABLE `Order` (
  `orderid` int(11) unsigned NOT NULL auto_increment,
  `customerid` varchar(20) NOT NULL default '',
  `massaid` varchar(20) NOT NULL default '',
  `serviceid` int(11) NOT NULL,
  `qty` int(11) NOT NULL default '1',
  `time` datetime default NULL,
  `promotion` varchar(45) default NULL,
  `status` enum('UNPAID','UNCOMMENT','DONE','WARN') NOT NULL default 'WARN',
  `amount` decimal(10,2) NOT NULL,
  `unitprice` decimal(10,2) NOT NULL,
  `level` enum('M','H','E') NOT NULL default 'M',
  `shopid` int(11) NOT NULL,
  `shopname` varchar(100) NOT NULL default '',
  `massagistname` varchar(45) NOT NULL default '',
  `servicename` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`orderid`),
  KEY `customer_foreignkey` (`customerid`),
  KEY `massagist_foreignkey` (`massaid`),
  KEY `serviced_foreignkey` (`serviceid`),
  KEY `promotion_foreignkey` (`promotion`),
  CONSTRAINT `customer_foreignkey` FOREIGN KEY (`customerid`) REFERENCES `Customer` (`Phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `massagist_foreignkey` FOREIGN KEY (`massaid`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `promotion_foreignkey` FOREIGN KEY (`promotion`) REFERENCES `Promotion` (`Promotionid`),
  CONSTRAINT `serviced_foreignkey` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`)
) ENGINE=InnoDB AUTO_INCREMENT=23510 DEFAULT CHARSET=utf8;

LOCK TABLES `Order` WRITE;
/*!40000 ALTER TABLE `Order` DISABLE KEYS */;

INSERT INTO `Order` (`orderid`, `customerid`, `massaid`, `serviceid`, `qty`, `time`, `promotion`, `status`, `amount`, `unitprice`, `level`, `shopid`, `shopname`, `massagistname`, `servicename`)
VALUES
	(23449,'6268981388','15036391991',1,1,'2015-10-14 06:40:40',NULL,'UNPAID',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23450,'1','15136352580',1,2,'0000-00-00 00:00:00',NULL,'UNPAID',216.00,108.00,'H',1,'东方力道中医推拿院','赵文斌','单人全身精油按摩'),
	(23452,'1','13233997914',1,3,'0000-00-00 00:00:00',NULL,'DONE',354.00,118.00,'E',3,'京洛保健会馆(京洛按摩)','尚洪涛','单人全身精油按摩'),
	(23453,'1','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23454,'1','15136352580',3,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',119.00,119.00,'H',1,'东方力道中医推拿院','赵文斌','单人经络保健/生姜足道'),
	(23455,'1','15036391991',2,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',89.00,89.00,'M',2,'妙手笔私人养生会所','谢文松','经络调理SPA套餐'),
	(23456,'1','15036391991',2,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',89.00,89.00,'M',2,'妙手笔私人养生会所','谢文松','经络调理SPA套餐'),
	(23457,'1','15036995492',3,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',109.00,109.00,'M',4,'正气堂中医养生馆','王金海','单人经络保健/生姜足道'),
	(23458,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23459,'1','15036391991',1,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23460,'1','15036391991',1,3,'0000-00-00 00:00:00',NULL,'DONE',294.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23461,'1','15036391991',1,2,'0000-00-00 00:00:00',NULL,'UNCOMMENT',196.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23462,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23463,'6268981388','15136352580',1,1,'0000-00-00 00:00:00',NULL,'DONE',108.00,108.00,'H',1,'东方力道中医推拿院','赵文斌','单人全身精油按摩'),
	(23464,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23465,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23466,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23467,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23468,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23469,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'UNPAID',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23470,'1','15036391991',2,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',89.00,89.00,'M',2,'妙手笔私人养生会所','谢文松','经络调理SPA套餐'),
	(23471,'1','15036391991',2,1,'0000-00-00 00:00:00',NULL,'UNCOMMENT',89.00,89.00,'M',2,'妙手笔私人养生会所','谢文松','经络调理SPA套餐'),
	(23472,'1','15136352580',2,2,'0000-00-00 00:00:00',NULL,'DONE',198.00,99.00,'H',1,'东方力道中医推拿院','赵文斌','经络调理SPA套餐'),
	(23473,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23474,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'UNPAID',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23475,'6268981388','15136352580',1,1,'0000-00-00 00:00:00',NULL,'DONE',108.00,108.00,'H',1,'东方力道中医推拿院','赵文斌','单人全身精油按摩'),
	(23476,'6268981388','15036391991',1,1,'0000-00-00 00:00:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23477,'6268981388','15036391991',1,1,'2015-10-04 15:39:25',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23478,'1','15036391991',1,1,'2015-10-04 16:15:30',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23479,'6268981388','15136352580',1,1,'2015-10-05 14:34:50',NULL,'DONE',108.00,108.00,'H',1,'东方力道中医推拿院','赵文斌','单人全身精油按摩'),
	(23480,'1','15036391991',1,1,'2015-10-05 17:57:18',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23481,'6268981388','15036391991',1,1,'2015-10-08 05:50:03',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23482,'6268981388','15036391991',1,1,'2015-10-08 21:48:36',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23483,'6268981388','15036391991',1,1,'2015-10-08 22:01:00',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23484,'6268981388','15036391991',1,1,'2015-10-14 06:43:19',NULL,'UNPAID',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23485,'6268981388','15036391991',1,1,'2015-10-14 06:45:07',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23486,'6268981388','15036391991',1,1,'2015-10-14 06:54:00',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23487,'6268981388','15036391991',1,1,'2015-10-14 06:54:55',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23488,'6268981388','15036391991',1,1,'2015-10-14 06:56:45',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23489,'6268981388','15036391991',1,1,'2015-10-14 06:57:40',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23490,'6268981388','15036391991',1,1,'2015-10-14 07:01:32',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23491,'6268981388','15036391991',1,1,'2015-10-14 07:08:40',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23492,'6268981388','15036391991',1,1,'2015-10-14 07:10:57',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23493,'6268981388','15036391991',1,1,'2015-10-14 07:11:45',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23494,'6268981388','15036391991',1,1,'2015-10-14 07:12:18',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23495,'6268981388','15036391991',1,1,'2015-10-14 07:13:02',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23496,'6268981388','15036391991',1,1,'2015-10-14 07:13:32',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23497,'6268981388','15036391991',1,1,'2015-10-14 07:14:38',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23498,'6268981388','15036391991',1,1,'2015-10-14 07:15:15',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23499,'6268981388','15036391991',1,1,'2015-10-14 07:15:56',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23500,'6268981388','15036391991',1,1,'2015-10-14 07:16:24',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23501,'6268981388','15036391991',1,1,'2015-10-14 07:18:35',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23502,'6268981388','15036391991',2,1,'2015-10-14 07:20:39',NULL,'UNCOMMENT',89.00,89.00,'M',2,'妙手笔私人养生会所','谢文松','经络调理SPA套餐'),
	(23503,'6268981388','15036391991',4,1,'2015-10-15 08:06:28',NULL,'DONE',156.00,156.00,'M',2,'妙手笔私人养生会所','谢文松','精品艾灸套餐'),
	(23505,'6268981388','15036391991',1,1,'2015-10-18 05:02:50',NULL,'UNCOMMENT',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23506,'6268981388','15036391991',1,1,'2015-10-20 03:22:51',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23507,'6268981388','15036391991',2,1,'2015-10-20 20:51:48',NULL,'DONE',89.00,89.00,'M',2,'妙手笔私人养生会所','谢文松','经络调理SPA套餐'),
	(23508,'12345678','15036391991',1,1,'2015-10-22 18:47:39',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩'),
	(23509,'12345678','15036391991',1,1,'2015-10-22 19:19:19',NULL,'DONE',98.00,98.00,'M',2,'妙手笔私人养生会所','谢文松','单人全身精油按摩');

/*!40000 ALTER TABLE `Order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Promotion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Promotion`;

CREATE TABLE `Promotion` (
  `Promotionid` varchar(45) NOT NULL default '',
  `value` float default NULL,
  `valid` tinyint(1) default NULL,
  PRIMARY KEY  (`Promotionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Recommand_massagist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recommand_massagist`;

CREATE TABLE `Recommand_massagist` (
  `massagistid` varchar(45) NOT NULL default '',
  `shopname` varchar(100) NOT NULL default '',
  `name` varchar(45) NOT NULL default '',
  `stars` enum('1','2','3') NOT NULL default '3',
  `intro` varchar(500) NOT NULL default '',
  `pic` varchar(200) NOT NULL default '',
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  PRIMARY KEY  (`massagistid`),
  CONSTRAINT `Remassagist` FOREIGN KEY (`massagistid`) REFERENCES `Massagist` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Recommand_massagist` WRITE;
/*!40000 ALTER TABLE `Recommand_massagist` DISABLE KEYS */;

INSERT INTO `Recommand_massagist` (`massagistid`, `shopname`, `name`, `stars`, `intro`, `pic`, `latitude`, `longtitude`)
VALUES
	('13233997914','身知道益生健康养生堂','刘国斋','3','刘国斋，中医调理师，34岁、26岁开始从事中医专业调理，擅长调理虚火引起的牙疼，咽喉疼，肩周疼痛，月经不调乳腺增生、失眠、头疼，增补充元气、去除寒湿。补肾效果明显。','http://gene.rnet.missouri.edu/iKnow/img/mathumb/18910907795.png',39.935177,116.43958),
	('15036391991','身知道益生健康养生堂','梁海珊','3','梁海珊，河北保定人，1968年出生，中医调理师。35岁开始学习中医推拿，专业调理、精油spa、中医推拿、中医足道，2年前跟随张珑曦老师学习根骶能量疗法。擅长调理：颈椎病、关节炎、肩周炎、骨质增生、腰间突出、高血压、失眠、妇科炎症、亚健康等人群。','http://gene.rnet.missouri.edu/iKnow/img/mathumb/15652519917.png',39.935177,116.43958),
	('15136352580','身知道益生健康养生堂','张珑曦','3','珑曦先生，河北霸州人，自幼习武。十六岁时跟随长辈学习根骶调理术，专注于《黄帝内经》的精髓，在继承祖传中医的基础上，有融合了现代医学和心理学的先进理念，经过近二十年的临床实践发现了未被文献记载的人体自我调节规律！他在临床实践中潜心研究，积累经验，为这种民间疗法寻找理论依据，用心观察自然，在大自然中需找答案，逐步完善了这种了疗法。手法中以轻软、渗透、持续、缠绵，以意领气，以气行学，激发人体本元之气，补虚养元，终使人体阴平阳秘，引阴入阳，从而达到精气神疗法的最高境界，为中医外治手法又增一朵奇葩，即为“根骶能量健康法”。擅长调理妇科，腰间盘突出，阳痿早泄等一系列疾病。','http://gene.rnet.missouri.edu/iKnow/img/mathumb/18618329557.png',39.935177,116.43958);

/*!40000 ALTER TABLE `Recommand_massagist` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Recommand_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recommand_news`;

CREATE TABLE `Recommand_news` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `content` varchar(2000) NOT NULL default '',
  `pic` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `Recommand_news` WRITE;
/*!40000 ALTER TABLE `Recommand_news` DISABLE KEYS */;

INSERT INTO `Recommand_news` (`id`, `title`, `content`, `pic`)
VALUES
	(1,'热烈庆祝身知道App上线','2015年10月28日，身知道1.0新版本APP正式上线，成功完成对0.1版本的迭代与功能升级。与身知道0.1版本相比，身知道全新1.0版APP及微信服务号不仅完全保留广受好评的上门预约及到店服务两大功能模块，还针对企业家、商务人士、行业精英、高级白领等高端人群开通名医专家预约诊疗VIP定制服务。','http://gene.rnet.missouri.edu/iKnow/img/slide/slide1.png'),
	(2,'身知道福利大放送','秋高气爽，花好月圆，正是一年好中秋。值此佳节身知道暖心让利，为各大城市青年白领备足了好礼，周二套餐秒杀已拉开序幕，月圆人更圆，让我们的健康美丽陪伴您享团圆。','http://gene.rnet.missouri.edu/iKnow/img/slide/slide2.png');

/*!40000 ALTER TABLE `Recommand_news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Recommand_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Recommand_service`;

CREATE TABLE `Recommand_service` (
  `serviceid` int(11) NOT NULL,
  `shopname` varchar(100) NOT NULL default '',
  `servicename` varchar(45) NOT NULL default '',
  `price` decimal(10,2) NOT NULL,
  `pic` varchar(200) NOT NULL default '',
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  PRIMARY KEY  (`serviceid`),
  CONSTRAINT `R-serviced` FOREIGN KEY (`serviceid`) REFERENCES `Service` (`serviceid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Recommand_service` WRITE;
/*!40000 ALTER TABLE `Recommand_service` DISABLE KEYS */;

INSERT INTO `Recommand_service` (`serviceid`, `shopname`, `servicename`, `price`, `pic`, `latitude`, `longtitude`)
VALUES
	(6,'身知道益生健康养生堂','中医足腿(含中药浴足)+肩+腿+脚底走罐',98.00,'http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop02.jpg',39.935177,116.43958),
	(9,'身知道益生健康养生堂','全身保健',109.00,'http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop02.jpg',39.935177,116.43958),
	(12,'身知道益生健康养生堂','玄极推拿局部',89.00,'http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop02.jpg',39.935177,116.43958);

/*!40000 ALTER TABLE `Recommand_service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Service`;

CREATE TABLE `Service` (
  `serviceid` int(11) NOT NULL auto_increment,
  `shopid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL default '',
  `shortdesc` varchar(200) NOT NULL default '',
  `price` decimal(10,2) NOT NULL,
  `funcdesc` varchar(1000) NOT NULL default '',
  `intro` varchar(1000) NOT NULL default '',
  `catid` int(11) NOT NULL,
  `price_high` decimal(10,2) NOT NULL,
  `price_expert` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL default '1',
  PRIMARY KEY  (`serviceid`),
  KEY `category_idx` (`catid`),
  KEY `sstore_idx` (`shopid`),
  CONSTRAINT `category` FOREIGN KEY (`catid`) REFERENCES `Category` (`catid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sshop` FOREIGN KEY (`shopid`) REFERENCES `Shop` (`shopid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

LOCK TABLES `Service` WRITE;
/*!40000 ALTER TABLE `Service` DISABLE KEYS */;

INSERT INTO `Service` (`serviceid`, `shopid`, `name`, `shortdesc`, `price`, `funcdesc`, `intro`, `catid`, `price_high`, `price_expert`, `duration`)
VALUES
	(1,1,'中医刮痧','清热解表、活血祛瘀',98.00,'清热解表、活血祛瘀','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',7,98.00,98.00,1),
	(2,1,'中医拔罐','祛风散寒、祛瘀除湿',98.00,'祛风散寒、祛瘀除湿','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',7,98.00,98.00,1),
	(3,1,'中医艾灸','温经通络、驱寒除湿、行气活血',98.00,'温经通络、驱寒除湿、行气活血','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',7,98.00,98.00,1),
	(4,1,'中医热敷','腰椎间盘突出、活血化瘀、风寒性病症、温经散寒、消炎止痛、月经不调、更年期综合症、前列腺炎、阳痿',198.00,'腰椎间盘突出、活血化瘀、风寒性病症、温经散寒、消炎止痛、月经不调、更年期综合症、前列腺炎、阳痿','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',7,198.00,198.00,1),
	(5,1,'中医足腿(含中药浴足)+单项','改善局部血液循环、消除疲劳调理身体阴阳平衡、祛风散寒',188.00,'改善局部血液循环、消除疲劳调理身体阴阳平衡、祛风散寒','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',7,188.00,188.00,1),
	(6,1,'中医足腿(含中药浴足)+肩+腿+脚底走罐','中药泡脚、松肩松腿、脚底走罐、消除疲劳、调理身心情绪、办公室综合症、改善局部血液循环',238.00,'中药泡脚、松肩松腿、脚底走罐、消除疲劳、调理身心情绪、办公室综合症、改善局部血液循环','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',4,238.00,238.00,1),
	(7,1,'中医足道(含中药浴足)+全身保健','改善局部血液循环、消除疲劳调理身体阴阳平衡、疏通身体经络、改善亚健康',298.00,'改善局部血液循环、消除疲劳调理身体阴阳平衡、疏通身体经络、改善亚健康','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',4,298.00,298.00,1),
	(8,1,'局部保健','疏通经络、消除工作疲劳、办公室综合症、改善亚健康',218.00,'疏通经络、消除工作疲劳、办公室综合症、改善亚健康','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',4,218.00,218.00,1),
	(9,1,'全身保健','疏通经络、消除工作疲劳、办公室综合症、改善亚健康、调理慢性疾病、延年益寿',280.00,'疏通经络、消除工作疲劳、办公室综合症、改善亚健康、调理慢性疾病、延年益寿','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',4,280.00,280.00,1),
	(10,1,'根骶能量疗法60分钟','调理修复、提升免疫力',680.00,'以有形的手法调动无形的能量，以无形的能量修复有形的整体，强化生精功能，调动后天的精气，补充先天的真气，起到自身的调理修复作用，提高自身的免疫力  \r适应症：腰椎间盘突出、骨质增生、风湿植物神经紊乱、心律失常、高血压、慢性胃炎、十二指肠溃疡，内分泌失调引起的肥胖、黄褐斑、更年期综合症、乳腺增生、卵巢囊肿、失眠、妇科炎症、前列腺等症','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',8,0.00,680.00,1),
	(11,1,'根骶能量疗法120分钟','调理修复、提升免疫力',1280.00,'以有形的手法调动无形的能量，以无形的能量修复有形的整体，强化生精功能，调动后天的精气，补充先天的真气，起到自身的调理修复作用，提高自身的免疫力','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',8,1280.00,1280.00,1),
	(12,1,'玄极推拿局部','调理头晕、头疼、肩部、腰部等',268.00,'头疼、头晕、肩部、腰部、关节炎、滑囊炎、腹部、乳腺增生、前列腺炎、改善局部血液循环颈椎病、肩周炎、腰椎间盘突出、腰肌劳损、四肢麻木、中风后遗症','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,268.00,268.00,1),
	(13,1,'玄极推拿局部+中药热敷70分钟','调理头晕、头疼、肩部、腰部等',458.00,'头疼、头晕、肩部、腰部、关节炎、滑囊炎、腹部、乳腺增生、前列腺炎、改善局部血液循环颈椎病、肩周炎、腰椎间盘突出、腰肌劳损、四肢麻木、中风后遗症','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,458.00,458.00,1),
	(14,1,'玄极推拿全身+中药热敷90分钟','调理头晕、头疼、肩部、腰部等',538.00,'头疼、头晕、肩部、腰部、关节炎、滑囊炎、腹部、乳腺增生、前列腺炎、改善局部血液循环颈椎病、肩周炎、腰椎间盘突出、腰肌劳损、四肢麻木、中风后遗症','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,538.00,538.00,1),
	(15,1,'艾灸立体疗法','温阳补气、扶正祛邪',218.00,'温阳补气、扶正祛邪、补虚固脱、开穴通脉、祛寒止痛、消瘀散结、固本培元，“人之真元乃一身之主宰，真气壮则人强，真气弱则人病，真气脱则人亡，保命之法，艾灼第一”、“人于无病时常灸关元、气海、命关、中脘，虽未得长生，亦可保百余年寿矣。”','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',9,218.00,218.00,1),
	(16,1,'五行调理局部','疏通十四经脉、平衡阴阳',488.00,'疏通十四经脉、平衡阴阳、调理五脏六腑、改善肠胃功能、内分泌失调、前列腺炎、月经不调、痛经、便秘泄泻','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,488.00,488.00,1),
	(17,1,'精油开背','达到消除疲劳，调理亚健康',198.00,'通过用具有治疗作用的精油辅助以手法，打通人体任督二脉和主疏通的膀胱经，促进人体新陈代谢，排除体内堆积的毒素，提升人体阳气。达到消除疲劳，调理亚健康的功效。','1. 请认真选取您需要的服务项目并如实填写您的联系方式及地址<br>2. 下单完成后，预约时间开始1天前取消订单将收取30%费用。预约时间开始前1天内取消订单收取10%费用，预约时间开始后不能取消订单<br>3. 如有服务时间及地点更改，请在下单完成后十分钟内与客服协商',1,198.00,198.00,1),
	(18,3,'中医刮痧','',49.00,'','',7,49.00,49.00,1),
	(19,3,'中医拔罐','',38.00,'','',7,38.00,38.00,1),
	(20,3,'痧罐一体机','',88.00,'','',7,88.00,88.00,1),
	(21,3,'中医艾灸','',60.00,'','',7,60.00,60.00,1),
	(22,3,'中医推拿','',58.00,'','',7,58.00,58.00,1),
	(23,3,'共振','',60.00,'','',7,60.00,60.00,1),
	(24,3,'中医熏疗','',68.00,'','',7,68.00,68.00,1),
	(25,3,'中医热敷','',60.00,'','',7,60.00,60.00,1),
	(26,3,'颈肩腰腿调理','',58.00,'','',7,58.00,58.00,1),
	(27,3,'经络刷','',58.00,'','',7,58.00,58.00,1),
	(28,3,'精油开背','',68.00,'','',7,68.00,68.00,1),
	(29,3,'放血疗法','',48.00,'','',7,48.00,48.00,1),
	(30,3,'中医熏蒸','',50.00,'','',7,50.00,50.00,1),
	(31,3,'肩颈调理套餐','',188.00,'','',10,188.00,188.00,1),
	(32,3,'腰部调理套餐','',166.00,'','',10,166.00,166.00,1),
	(33,3,'保健','',128.00,'','',10,128.00,128.00,1),
	(34,3,'女性、男性艾灸疗法保养','',398.00,'','',9,398.00,398.00,1),
	(35,3,'女性、男性艾灸疗法保养15次套餐','',3450.00,'','',9,3450.00,3450.00,1),
	(36,3,'立体艾灸精品','',218.00,'','',9,218.00,218.00,1),
	(37,3,'立体艾灸极品','',488.00,'','',9,488.00,488.00,1),
	(38,3,'立体艾灸精品15次套餐','',2820.00,'','',9,2820.00,2820.00,1),
	(39,3,'立体艾灸极品15次套餐','',3270.00,'','',9,3270.00,3270.00,1),
	(40,3,'经络特色艾灸','',438.00,'','',9,438.00,438.00,1),
	(41,3,'经络特色艾灸10次套餐','',3800.00,'','',9,3800.00,3800.00,1),
	(42,2,'足疗','促进血液循环，调节神经系统，疏通经络元气',98.00,'','',4,98.00,98.00,1),
	(43,2,'五行足疗','温经散寒，强化脏腑功能，促进细胞再生，疏通经络，培补元气',128.00,'','',10,128.00,128.00,1),
	(44,2,'中医足疗套餐A60分钟','促进血液循环，调节神经系统，疏通经络元气，解除疲劳',238.00,'','',4,238.00,238.00,1),
	(45,2,'中医足疗套餐A精油60分钟','促进血液循环，调节神经系统，疏通经络元气，解除疲劳',238.00,'','',4,238.00,238.00,1),
	(46,2,'中医足疗套餐B60分钟','促进血液循环，舒筋活血，加快新陈代谢，缓解疲劳，提高免疫力',188.00,'','',4,188.00,188.00,1),
	(47,2,'中医足疗套餐B中式60分钟','促进血液循环，舒筋活血，加快新陈代谢，缓解疲劳，提高免疫力',188.00,'','',4,188.00,188.00,1),
	(48,2,'保健按摩','疏通经络，行气活血，滑利关节，提高免疫力',118.00,'','',1,118.00,118.00,1),
	(49,2,'脐疗','健脾和胃，通理三焦，温补下元，通经活络，行气止痛',98.00,'','',1,98.00,98.00,1),
	(50,2,'精油开背','舒筋活血，促进血液循环，缓解疲劳',98.00,'','',1,98.00,98.00,1),
	(51,2,'保健精油按摩','舒筋活血，促进血液循环，缓解疲劳',238.00,'','',1,238.00,238.00,1),
	(52,2,'中医刮痧（头部）','消炎止痛，疏通驱散',48.00,'','',2,48.00,48.00,1),
	(53,2,'中医刮痧（面部）','适应：皮肤干燥松弛老化，黑眼圈，色素沉淀',128.00,'','',2,128.00,128.00,1),
	(54,2,'局部痧疗','活血祛瘀，疏通经络，增强免疫力',88.00,'','',2,88.00,88.00,1),
	(55,2,'综合痧疗','清热解表，活血祛瘀疏通经络',168.00,'','',2,168.00,168.00,1),
	(56,2,'立体艾灸','疏风解表，温经通络，强脏壮府，温阴补虚，回阳固脱',118.00,'','',9,118.00,118.00,1),
	(57,2,'药灸','补脾和胃，益气复脉，疲倦乏力',48.00,'','',9,48.00,48.00,1),
	(58,2,'中医推拿（局部）','适应：落枕，颈椎病，急性扭伤椎间盘突出，腰肌劳损，坐骨神经痛等',40.00,'','',1,58.00,58.00,1),
	(59,2,'中医推拿（综合）','舒筋活血，疏通经络，调节脏腑，平衡阴阳',118.00,'','',1,118.00,118.00,1),
	(60,2,'针灸','适应：脂肪肝，高血压，糖尿病，中风后遗症，顽固性失眠，月经不调，痛经',58.00,'','',7,58.00,58.00,1),
	(61,2,'拔罐','祛风散寒，祛瘀除湿',40.00,'','',7,40.00,40.00,1),
	(62,2,'经筋疗法','适应：高低肩，长短腿高血压，脊椎侧弯，下蹲困难强直脊椎炎等',108.00,'','',7,108.00,108.00,1);

/*!40000 ALTER TABLE `Service` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Shop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Shop`;

CREATE TABLE `Shop` (
  `shopid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL default '',
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  `phone` varchar(20) NOT NULL default '',
  `address` varchar(200) NOT NULL default '',
  `pic` varchar(200) default NULL,
  `opentime` time NOT NULL,
  `closetime` time NOT NULL,
  `city` varchar(100) NOT NULL default '',
  `province` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`shopid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `Shop` WRITE;
/*!40000 ALTER TABLE `Shop` DISABLE KEYS */;

INSERT INTO `Shop` (`shopid`, `name`, `latitude`, `longtitude`, `phone`, `address`, `pic`, `opentime`, `closetime`, `city`, `province`)
VALUES
	(1,'身知道益生健康养生堂',39.935177,116.43958,'+8601084077520','东四十条豆瓣胡同2号楼底商2室','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop01.jpg','08:00:00','22:00:00','',''),
	(2,'身知道黄河路门诊部',34.660217,112.423617,'+86037964886699','洛阳市涧西区黄河路地久商务大厦','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop02.jpg','10:00:00','24:00:00','',''),
	(3,'身知道磁器口养生馆',39.903634,116.422365,'+8601067086771','东城区崇外大街新世界家园4号楼1单元 502室','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop03.jpg','09:00:00','23:00:00','',''),
	(4,'身知道伞度林中医馆',39.902618,119.53668,'+8603358356655','秦皇岛市河北大街西段449号','http://gene.rnet.missouri.edu/iKnow/img/servicethumb/shop04.jpg','09:00:00','21:00:00','',''),
	(333,'333',0,0,'333','333','5.jpg','12:12:12','12:12:12','333','333'),
	(333231,'3331',0,0,'333','333','1.gif','12:12:12','12:12:12','333','333');

/*!40000 ALTER TABLE `Shop` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
