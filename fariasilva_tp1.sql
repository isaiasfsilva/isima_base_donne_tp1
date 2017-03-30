-- MySQL dump 10.13  Distrib 5.5.51-38.2, for Linux (x86_64)
--
-- Host: localhost    Database: dvjgo267_fariasilva_tp1_basedonee_isima
-- ------------------------------------------------------
-- Server version	5.5.51-38.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Documents`
--

DROP TABLE IF EXISTS `Documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anee` year(4) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `niv_config` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('Rapport','Lettre','Plan','Note','Contrat') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Documents`
--

LOCK TABLES `Documents` WRITE;
/*!40000 ALTER TABLE `Documents` DISABLE KEYS */;
INSERT INTO `Documents` VALUES (25,2007,'Les trois mousquetaires',1,'Lettre'),(31,2017,'NEWBOOK',0,'Rapport'),(32,2017,'NEW BOOK 2',0,'Rapport'),(33,2017,'dddddddd',0,'Rapport'),(34,2017,'dddddddd',0,'Rapport'),(35,2017,'dddddddd',0,'Rapport'),(36,2017,'banana',0,'Rapport'),(37,2017,'banana',0,'Rapport'),(38,2017,'maÃ§a',0,'Rapport'),(39,2017,'maÃ§a',0,'Rapport'),(40,2017,'rttttttttt',0,'Rapport'),(41,2017,'eeeeeeeeeeee',0,'Rapport'),(42,2017,'ddddd',0,'Rapport'),(43,2017,'wewewe',0,'Rapport'),(44,2017,'fgffg',0,'Rapport'),(45,2017,'sdsd',0,'Rapport'),(46,2017,'sdsd',0,'Rapport'),(47,2017,'eerer',0,'Rapport'),(48,2017,'eerer',0,'Rapport'),(49,2017,'eerer',0,'Rapport'),(50,2017,'sdsdsd',0,'Rapport'),(51,2017,'222222222222',0,'Rapport'),(52,2017,'dfdf',0,'Rapport'),(62,2017,'4444',0,'Rapport');
/*!40000 ALTER TABLE `Documents` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dvjgo267`@`localhost`*/ /*!50003 TRIGGER `year` BEFORE INSERT ON `Documents` FOR EACH ROW IF (NEW.anee < 1000 OR NEW.anee > YEAR(CURRENT_DATE())) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'YEAR N EST PAS BON';
  END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dvjgo267_fariasi`@`localhost`*/ /*!50003 TRIGGER `year_update` BEFORE UPDATE ON `Documents` FOR EACH ROW IF (NEW.anee < 1000 OR NEW.anee > YEAR(CURRENT_DATE())) THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'YEAR N EST PAS BON'; END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Emprunt`
--

DROP TABLE IF EXISTS `Emprunt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Emprunt` (
  `id_doc` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id_doc`,`id_user`,`date_debut`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `Emprunt_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `Utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Emprunt_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `Documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Emprunt`
--

LOCK TABLES `Emprunt` WRITE;
/*!40000 ALTER TABLE `Emprunt` DISABLE KEYS */;
INSERT INTO `Emprunt` VALUES (25,10,'2017-02-20','2017-02-21'),(25,10,'2017-02-21','2017-02-22');
/*!40000 ALTER TABLE `Emprunt` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dvjgo267_fariasi`@`localhost`*/ /*!50003 TRIGGER `T1_BEFORE_INSERT_EMPRUNT` BEFORE INSERT ON `Emprunt` FOR EACH ROW IF (NEW.date_fin < NEW.date_debut OR NEW.date_debut > CURRENT_DATE() OR (select test_perm(NEW.id_doc, NEW.id_user))=0 OR  TIMESTAMPDIFF(MONTH,NEW.date_debut,NEW.date_fin)>1) THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ERROR INSERTION'; END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dvjgo267_fariasi`@`localhost`*/ /*!50003 TRIGGER `T1_BEFORE_UPDATE_EMPRUNT` BEFORE UPDATE ON `Emprunt` FOR EACH ROW IF (NEW.date_fin < NEW.date_debut OR NEW.date_debut > CURRENT_DATE() OR (select test_perm(NEW.id_doc, NEW.id_user))=0 OR TIMESTAMPDIFF(MONTH,NEW.date_debut,NEW.date_fin)>1) THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ERROR INSERTION'; END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Livres_auteurs`
--

DROP TABLE IF EXISTS `Livres_auteurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Livres_auteurs` (
  `id_doc` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ordre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_doc`,`id_user`),
  KEY `Livres_auteurs_ibfk_2` (`id_user`),
  CONSTRAINT `Livres_auteurs_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `Documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Livres_auteurs_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `Utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Livres_auteurs`
--

LOCK TABLES `Livres_auteurs` WRITE;
/*!40000 ALTER TABLE `Livres_auteurs` DISABLE KEYS */;
INSERT INTO `Livres_auteurs` VALUES (25,10,1),(25,18,0);
/*!40000 ALTER TABLE `Livres_auteurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utilisateur`
--

DROP TABLE IF EXISTS `Utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `config` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilisateur`
--

LOCK TABLES `Utilisateur` WRITE;
/*!40000 ALTER TABLE `Utilisateur` DISABLE KEYS */;
INSERT INTO `Utilisateur` VALUES (10,'TZITAS','ANDERSON',0),(18,'FARIA SILVA','isaias',0);
/*!40000 ALTER TABLE `Utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dvjgo267_fariasilva_tp1_basedonee_isima'
--
/*!50003 DROP FUNCTION IF EXISTS `emprunts_today` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`dvjgo267_fariasi`@`localhost` FUNCTION `emprunts_today`() RETURNS int(11)
    READS SQL DATA
BEGIN DECLARE t INT; SET t=0; SELECT COUNT(*) INTO t FROM Emprunt WHERE date_debut=CURDATE(); RETURN t; END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `test_perm` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`dvjgo267_fariasi`@`localhost` FUNCTION `test_perm`(id_doc INT, id_user INT) RETURNS int(11)
BEGIN  IF( SELECT EXISTS (SELECT 1 FROM Utilisateur WHERE Utilisateur.id=id_user and Utilisateur.config=1) ) THEN RETURN 1; END IF; IF( SELECT EXISTS (SELECT 1 FROM Documents WHERE Documents.id=id_doc and Documents.niv_config=0) ) THEN RETURN 1; END IF; IF( SELECT EXISTS (SELECT 1 FROM Livres_auteurs WHERE Livres_auteurs.id_doc=id_doc and Livres_auteurs.id_user=id_user) ) THEN RETURN 1; END IF; RETURN 0;END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `number_docs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`dvjgo267_fariasi`@`localhost` PROCEDURE `number_docs`()
BEGIN SELECT COUNT(*) as ndocs FROM Documents; END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `number_emprunt` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`dvjgo267_fariasi`@`localhost` PROCEDURE `number_emprunt`()
BEGIN SELECT COUNT(*) as nemp FROM Emprunt; END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `number_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`dvjgo267_fariasi`@`localhost` PROCEDURE `number_users`()
BEGIN SELECT COUNT(*) as nusers FROM Utilisateur; END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-30 10:35:30
