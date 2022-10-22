-- MySQL dump 10.19  Distrib 10.3.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_lem_system
-- ------------------------------------------------------
-- Server version	10.3.34-MariaDB-1:10.3.34+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblinstalations`
--

USE db_lem_system;

DROP TABLE IF EXISTS `tblinstalations`;
DROP TABLE IF EXISTS `tblequipement`;
DROP TABLE IF EXISTS `tblhistory`;


CREATE TABLE `tblinstalations` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tecnicoid` int(10) DEFAULT NULL,
  `clientid` int(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `equipo` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,

  `nodoid` int(10),
  `position` varchar(100) DEFAULT NULL,
  `coordinator` varchar(100) DEFAULT NULL,
  `firmwaretype` varchar(100) DEFAULT NULL,
  `placatype` varchar(100) DEFAULT NULL,
  `frequency` varchar(100) DEFAULT NULL,
  
  `chipcompany` varchar(100) DEFAULT NULL,
  `sondatype` varchar(100) DEFAULT NULL,
  `sondalarge` varchar(100) DEFAULT NULL,
  `maxhigh` varchar(100) DEFAULT NULL,
  `sensorhigh` varchar(100) DEFAULT NULL,
  `waterhigh` varchar(100) DEFAULT NULL,
  `deeppool` varchar(100) DEFAULT NULL,
  `staticlevel` varchar(100) DEFAULT NULL,
  `dinamiclevel` varchar(100) DEFAULT NULL,
  `referencesensor` varchar(100) DEFAULT NULL,
  `pulses` varchar(100) DEFAULT NULL,
  `energytype` varchar(100) DEFAULT NULL,



  `Coments` varchar(500) DEFAULT NULL,
  
  PRIMARY KEY (`id`)
);



CREATE TABLE `tblequipement` (
  `equipement` varchar(100) NOT NULL,
  `atributes` varchar(100) DEFAULT NULL,
 
  PRIMARY KEY (`equipement`)
);




CREATE TABLE `tblhistory` (
  `id` int(10) NOT NULL,
  `tecnicoid` int(10) DEFAULT NULL,
  `clientid` int(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `equipo` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,

  `nodoid` int(10),
  `position` varchar(100) DEFAULT NULL,
  `coordinator` varchar(100) DEFAULT NULL,
  `firmwaretype` varchar(100) DEFAULT NULL,
  `placatype` varchar(100) DEFAULT NULL,
  `frequency` varchar(100) DEFAULT NULL,
  
  `chipcompany` varchar(100) DEFAULT NULL,
  `sondatype` varchar(100) DEFAULT NULL,
  `sondalarge` varchar(100) DEFAULT NULL,
  `maxhigh` varchar(100) DEFAULT NULL,
  `sensorhigh` varchar(100) DEFAULT NULL,
  `waterhigh` varchar(100) DEFAULT NULL,
  `deeppool` varchar(100) DEFAULT NULL,
  `staticlevel` varchar(100) DEFAULT NULL,
  `dinamiclevel` varchar(100) DEFAULT NULL,
  `referencesensor` varchar(100) DEFAULT NULL,
  `pulses` varchar(100) DEFAULT NULL,
  `energytype` varchar(100) DEFAULT NULL,

  `Coments` varchar(500) DEFAULT NULL
);

INSERT INTO `tblequipement` VALUES ('Coordinador',"");
INSERT INTO `tblequipement` VALUES ('Estacion Meteorologica', 'chipcompany');
INSERT INTO `tblequipement` VALUES ('Sonda','chipcompany,sondatype,sondalarge');
INSERT INTO `tblequipement` VALUES ('Canales','maxhigh,sensorhigh,waterhigh');
INSERT INTO `tblequipement` VALUES ('Pozos','chipcompany,deeppool,staticlevel,dinamiclevel,referencesensor,pulses,energytype');








