-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cmw
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

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
-- Current Database: `cmw`
--


--
-- Table structure for table `cmw_boutique_action`
--

DROP TABLE IF EXISTS `cmw_boutique_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_boutique_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `methode` int(2) NOT NULL,
  `commande_valeur` text NOT NULL,
  `prix` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_boutique_action`
--

LOCK TABLES `cmw_boutique_action` WRITE;
/*!40000 ALTER TABLE `cmw_boutique_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_boutique_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_boutique_categories`
--

DROP TABLE IF EXISTS `cmw_boutique_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_boutique_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `ordre` int(11) NOT NULL,
  `serveur` int(11) NOT NULL,
  `connection` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_boutique_categories`
--

LOCK TABLES `cmw_boutique_categories` WRITE;
/*!40000 ALTER TABLE `cmw_boutique_categories` DISABLE KEYS */;
INSERT INTO `cmw_boutique_categories` VALUES (1,'test','test',1,-1,0);
/*!40000 ALTER TABLE `cmw_boutique_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_boutique_offres`
--

DROP TABLE IF EXISTS `cmw_boutique_offres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_boutique_offres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_boutique_offres`
--

LOCK TABLES `cmw_boutique_offres` WRITE;
/*!40000 ALTER TABLE `cmw_boutique_offres` DISABLE KEYS */;
INSERT INTO `cmw_boutique_offres` VALUES (1,'test','test',50,1,1);
/*!40000 ALTER TABLE `cmw_boutique_offres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_boutique_reduction`
--

DROP TABLE IF EXISTS `cmw_boutique_reduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_boutique_reduction` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code_promo` char(8) NOT NULL,
  `pourcent` tinyint(3) unsigned NOT NULL,
  `titre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_boutique_reduction`
--

LOCK TABLES `cmw_boutique_reduction` WRITE;
/*!40000 ALTER TABLE `cmw_boutique_reduction` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_boutique_reduction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_boutique_stats`
--

DROP TABLE IF EXISTS `cmw_boutique_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_boutique_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offre_id` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  `prix` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_boutique_stats`
--

LOCK TABLES `cmw_boutique_stats` WRITE;
/*!40000 ALTER TABLE `cmw_boutique_stats` DISABLE KEYS */;
INSERT INTO `cmw_boutique_stats` VALUES (1,1,'2018-05-07',-350,'Florentlife'),(2,1,'2018-05-07',50,'Florentlife');
/*!40000 ALTER TABLE `cmw_boutique_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum`
--

DROP TABLE IF EXISTS `cmw_forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `ordre` smallint(5) unsigned NOT NULL,
  `perms` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum`
--

LOCK TABLES `cmw_forum` WRITE;
/*!40000 ALTER TABLE `cmw_forum` DISABLE KEYS */;
INSERT INTO `cmw_forum` VALUES (1,'Forum CraftMyWebsite',0,0),(2,'Tzts',1,0);
/*!40000 ALTER TABLE `cmw_forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_answer`
--

DROP TABLE IF EXISTS `cmw_forum_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_answer` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_topic` smallint(6) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_post` date NOT NULL,
  `d_edition` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_answer`
--

LOCK TABLES `cmw_forum_answer` WRITE;
/*!40000 ALTER TABLE `cmw_forum_answer` DISABLE KEYS */;
INSERT INTO `cmw_forum_answer` VALUES (1,1,'Florentlife','[center][img=https://craftmywebsite.fr/img/cat6.png]test chat[/img][/center]','2018-04-17','2018-04-17'),(2,1,'Florentlife','[url]http://craftmywebsite.fr/forum[/url]','2018-04-17',NULL),(3,1,'Florentlife','[img]https://craftmywebsite.fr/img/cat6.png[/img]','2018-04-17',NULL),(4,1,'Florentlife','[center][img]https://craftmywebsite.fr/img/cat6.png[/img][/center]','2018-04-17',NULL),(5,1,'Florentlife','[spoiler]test1[/spoiler]\r\n[spoiler=test2]test2[/spoiler]','2018-04-17',NULL),(6,1,'Florentlife','[spoiler]test[/spoiler]t','2018-04-17','2018-04-17'),(8,1,'Florentlife','[url=&quot;test&quot;]http://test.fr[/url]','2018-04-17',NULL),(9,1,'Florentlife','[url=CraftMyWebsite]Test[/url]','2018-04-17',NULL),(10,1,'Florentlife','[url=https://craftmywebsite.fr/forum]CraftMyWebsite[/url]','2018-04-17',NULL),(11,1,'Florentlife','[color=test]green[/color]','2018-04-17',NULL),(12,1,'Florentlife','[url=https://craftmywebsite.fr/forum]CraftMyWebsite[/url]\r\n[url=https://craftmywebsite.fr/forum]CraftMyWebsite[/url]\r\n[color=red]test[/color]\r\n[color=red]test[/color]\r\n[color=#40A497]testttt[/color]\r\n','2018-04-17',NULL),(13,1,'Florentlife','test test@test.fr test','2018-04-17',NULL);
/*!40000 ALTER TABLE `cmw_forum_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_answer_removed`
--

DROP TABLE IF EXISTS `cmw_forum_answer_removed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_answer_removed` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_answer` smallint(5) unsigned NOT NULL,
  `id_topic` smallint(5) unsigned NOT NULL,
  `auteur_answer` varchar(60) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `Raison` varchar(200) DEFAULT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_answer_removed`
--

LOCK TABLES `cmw_forum_answer_removed` WRITE;
/*!40000 ALTER TABLE `cmw_forum_answer_removed` DISABLE KEYS */;
INSERT INTO `cmw_forum_answer_removed` VALUES (1,7,1,'Florentlife','2018-04-17','Aucune/Non renseigné','2018-04-17','Florentlife');
/*!40000 ALTER TABLE `cmw_forum_answer_removed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_categorie`
--

DROP TABLE IF EXISTS `cmw_forum_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_categorie` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `sous-forum` tinyint(4) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL,
  `close` tinyint(3) unsigned NOT NULL,
  `perms` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_categorie`
--

LOCK TABLES `cmw_forum_categorie` WRITE;
/*!40000 ALTER TABLE `cmw_forum_categorie` DISABLE KEYS */;
INSERT INTO `cmw_forum_categorie` VALUES (1,'Votre Premier Forum',NULL,0,1,0,0),(2,'Tzts',NULL,0,1,0,0),(3,'Test','chat',0,2,0,0);
/*!40000 ALTER TABLE `cmw_forum_categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_like`
--

DROP TABLE IF EXISTS `cmw_forum_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_like` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `Appreciation` smallint(6) NOT NULL,
  `vu` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `new` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_like`
--

LOCK TABLES `cmw_forum_like` WRITE;
/*!40000 ALTER TABLE `cmw_forum_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_forum_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_lu`
--

DROP TABLE IF EXISTS `cmw_forum_lu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_lu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(82) NOT NULL,
  `id_topic` int(10) unsigned NOT NULL,
  `vu` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_lu`
--

LOCK TABLES `cmw_forum_lu` WRITE;
/*!40000 ALTER TABLE `cmw_forum_lu` DISABLE KEYS */;
INSERT INTO `cmw_forum_lu` VALUES (1,'Florentlife',1,1),(2,'Emilien52',1,1),(3,'Florentlife',2,1),(4,'Florentlife',3,1),(5,'Florentlife',0,1),(6,'Florentlife',5,1),(7,'Emilien52',3,1);
/*!40000 ALTER TABLE `cmw_forum_lu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_post`
--

DROP TABLE IF EXISTS `cmw_forum_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_post` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_creation` date NOT NULL,
  `last_answer` varchar(40) DEFAULT NULL,
  `sous_forum` smallint(6) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `d_edition` date DEFAULT NULL,
  `prefix` tinyint(4) NOT NULL,
  `epingle` tinyint(3) unsigned NOT NULL,
  `affichage` int(10) unsigned NOT NULL,
  `last_answer_temps` int(11) NOT NULL,
  `perms` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_post`
--

LOCK TABLES `cmw_forum_post` WRITE;
/*!40000 ALTER TABLE `cmw_forum_post` DISABLE KEYS */;
INSERT INTO `cmw_forum_post` VALUES (1,1,'test','Florentlife','test','2018-04-16','Florentlife',NULL,0,NULL,0,0,0,1523974030,2),(3,1,'test3','Florentlife',' :google  :vive moi:  :beer:  :beer:  :fouet:  :angel:  :o ','2018-05-20','Florentlife',1,0,NULL,0,0,0,1526818916,0),(5,1,'test','Florentlife','test','2018-05-20','Florentlife',NULL,0,NULL,0,0,0,1526824881,0);
/*!40000 ALTER TABLE `cmw_forum_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_prefix`
--

DROP TABLE IF EXISTS `cmw_forum_prefix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_prefix` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `span` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_prefix`
--

LOCK TABLES `cmw_forum_prefix` WRITE;
/*!40000 ALTER TABLE `cmw_forum_prefix` DISABLE KEYS */;
INSERT INTO `cmw_forum_prefix` VALUES (1,'prefix prefixRed','Important'),(2,'prefix prefixOrange','Refusée'),(3,'prefix prefixGreen','Acceptée'),(4,'prefix prefixRoyalBl','En Attente');
/*!40000 ALTER TABLE `cmw_forum_prefix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_report`
--

DROP TABLE IF EXISTS `cmw_forum_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_report` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(6) NOT NULL,
  `id_topic_answer` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `reporteur` varchar(40) NOT NULL,
  `vu` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `new` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_report`
--

LOCK TABLES `cmw_forum_report` WRITE;
/*!40000 ALTER TABLE `cmw_forum_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_forum_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_smileys`
--

DROP TABLE IF EXISTS `cmw_forum_smileys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_smileys` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `symbole` varchar(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `priorite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_smileys`
--

LOCK TABLES `cmw_forum_smileys` WRITE;
/*!40000 ALTER TABLE `cmw_forum_smileys` DISABLE KEYS */;
INSERT INTO `cmw_forum_smileys` VALUES (1,':)','theme/smileys/1.gif',500),(2,':diable','theme/smileys/37.gif',499),(3,':D','theme/smileys/2.gif',498),(4,'x)','theme/smileys/3.gif',0),(5,'xd','theme/smileys/4.gif',0),(6,':excited:','theme/smileys/5.gif',0),(7,';)','theme/smileys/6.gif',0),(8,':embarrass','theme/smileys/11.gif',0),(9,'8)','theme/smileys/13.gif',0),(10,':o','theme/smileys/20.gif',0),(11,':(','theme/smileys/23.gif',0),(12,':c','theme/smileys/23.gif',0),(13,':\'(','theme/smileys/24.gif',0),(14,'<3','theme/smileys/120.gif',0),(15,':angel:','theme/smileys/36.gif',0),(16,':salut:','theme/smileys/48.gif',0),(17,':beer:','theme/smileys/51.gif',0),(18,':cul:','theme/smileys/96.gif',0),(19,':calimero','theme/smileys/97.gif',0),(20,':vomir:','theme/smileys/98.gif',0),(21,':google','theme/smileys/110.gif',0),(22,':je sors:','theme/smileys/112.gif',0),(23,':tu sors:','theme/smileys/117.gif',0),(24,':vive moi:','theme/smileys/113.gif',0),(25,':fouet:','theme/smileys/130.gif',0),(26,':caca:','theme/smileys/151.gif',0),(27,':bomb','theme/smileys/157.gif',0),(28,':p','theme/smileys/131.gif',0);
/*!40000 ALTER TABLE `cmw_forum_smileys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_sous_forum`
--

DROP TABLE IF EXISTS `cmw_forum_sous_forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_sous_forum` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `perms` int(10) unsigned NOT NULL,
  `close` tinyint(3) unsigned NOT NULL,
  `ordre` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_sous_forum`
--

LOCK TABLES `cmw_forum_sous_forum` WRITE;
/*!40000 ALTER TABLE `cmw_forum_sous_forum` DISABLE KEYS */;
INSERT INTO `cmw_forum_sous_forum` VALUES (1,1,'test',NULL,10,0,0),(2,1,'test5','trash',0,1,1);
/*!40000 ALTER TABLE `cmw_forum_sous_forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_topic_followed`
--

DROP TABLE IF EXISTS `cmw_forum_topic_followed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_topic_followed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `last_answer` int(11) NOT NULL,
  `vu` int(10) unsigned NOT NULL DEFAULT '1',
  `new` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_topic_followed`
--

LOCK TABLES `cmw_forum_topic_followed` WRITE;
/*!40000 ALTER TABLE `cmw_forum_topic_followed` DISABLE KEYS */;
INSERT INTO `cmw_forum_topic_followed` VALUES (1,'Florentlife',1,0,1,0),(2,'Florentlife',1,1,1,0),(3,'Florentlife',1,2,1,0),(4,'Florentlife',1,3,1,0),(5,'Florentlife',1,4,1,0),(6,'Florentlife',1,5,1,0),(7,'Florentlife',1,6,1,0),(8,'Florentlife',1,7,1,0),(9,'Florentlife',1,8,1,0),(10,'Florentlife',1,9,1,0),(11,'Florentlife',1,10,1,0),(12,'Florentlife',1,11,1,0),(13,'Florentlife',1,12,1,0),(14,'Florentlife',1,13,1,0),(15,'Florentlife',2,0,1,0),(16,'Florentlife',3,0,1,0),(17,'Florentlife',4,0,1,0),(18,'Florentlife',5,0,1,0);
/*!40000 ALTER TABLE `cmw_forum_topic_followed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_forum_topic_removed`
--

DROP TABLE IF EXISTS `cmw_forum_topic_removed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_forum_topic_removed` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `nb_reponse` int(10) unsigned NOT NULL,
  `auteur_topic` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `raison` varchar(300) NOT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_forum_topic_removed`
--

LOCK TABLES `cmw_forum_topic_removed` WRITE;
/*!40000 ALTER TABLE `cmw_forum_topic_removed` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_forum_topic_removed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_idees`
--

DROP TABLE IF EXISTS `cmw_idees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_idees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categorie` tinyint(3) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `description` text NOT NULL,
  `statut` tinyint(1) unsigned NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_idees`
--

LOCK TABLES `cmw_idees` WRITE;
/*!40000 ALTER TABLE `cmw_idees` DISABLE KEYS */;
INSERT INTO `cmw_idees` VALUES (1,2,1,'Importer un skin sur le site (sans lien avec MC) + image de profil',2,'Changement des photos de profil totalement intégré, Importation des skins en réflexion'),(2,2,1,'Ajout des centimes pour une offre PayPal',3,''),(3,1,1,'Modifier l\'affichage des smileys pour les afficher dans un dropdown',2,'Rendu moche, en attente de développeur FE pour intégration ou d\'idée pour meilleur rendu'),(4,2,1,'Widget : Chat serveur minecraft avec possibilité d\'envoie de message',3,''),(5,2,1,'Pouvoir fermer un sous-forum et changer leur ordre',3,''),(6,2,1,'Pouvoir faire des forum, categories, sous-forum, topics caché',3,''),(7,1,1,'Intégrer RCON',0,''),(9,2,1,'Pouvoir cocher plusieurs topics sur le forum  pour les supprimer apr&egrave;s',3,''),(10,2,1,'Avoir le choix de montrer notre adresse mail sur le profil',3,''),(11,2,1,'Onglet Membres avec la liste de tout les membres, cliquable vers leur page profil',1,''),(12,2,1,'Ajout d\'un testeur de force du mot de passe entr&eacute; &agrave; l\'inscription ainsi que d\'un v&eacute;rificateur de correspondance entre les mots de Passes. Une inscription ne peut pas se faire si la force du mot de passe n\'est pas suffisante !',3,''),(13,2,1,'Possibilit&eacute; de pouvoir customiser enti&egrave;rement les r&eacute;seaux sociaux demand&eacute; dans le profil',0,''),(14,0,0,'Pouvoir faire des abonnements',0,''),(15,2,1,'Pouvoir changer la couleur du site en un clic (palette de couleur)',0,''),(16,2,1,'Pouvoir ajouter des miniatures de plus ou en enlever (accueil)',0,''),(17,2,1,'Syst&egrave;me de messagerie priv&eacute;e.',0,''),(18,2,1,'Syst&egrave;me d\'ami, donne la possibilit&eacute; de pouvoir parler avec  (r&eacute;glages dans le profil)',0,''),(19,2,1,'Pouvoir choisir la longueur du mot de passe de l\'utilisateur (uniquement le cr&eacute;ateur dans le panel admin). Choisir entre majuscules, minuscules, chiffres et caract&egrave;res sp&eacute;ciaux',0,''),(20,2,1,'Newsletter',0,''),(21,1,1,'Notifications push (en &eacute;tude  ... Aucune version avanc&eacute;e)',0,''),(22,2,1,'Pouvoir ban un joueur du site',0,''),(23,2,1,'Rajout&eacute; la mise en page sur la description dans offres boutique + paypal (nl2br)',0,''),(24,2,1,'Syst&egrave;me de troph&eacute;es configurables dans le panel',0,''),(25,2,1,'bouton tout cocher dans la permissions panel',0,''),(26,1,1,'Pouvoir mettre radio/musique/video sur sont site web plus facilement directement sur le panel admin',0,''),(27,2,1,'Pouvoir cr&eacute;er des fen&ecirc;tres popup (par exemple sur la page d\'accueil pour annoncer une promo sur la boutique) avec la possibilit&eacute; de mettre une image !',0,''),(28,1,1,'Des effets sur le site ? (De la neige, des feuilles, de la pluie; vous voyez ou je veux en venir ! )',0,''),(29,0,1,'Pouvoir mettre une dynmap , sur une page personnalis&eacute; du site',0,''),(30,2,2,'Pour les listes d&eacute;roulantes du header, juste glisser la souris dessus au lieu de cliquer pour l\'activer',0,''),(33,2,1,'Un syst&egrave;me pour les votes qu\'au bout de 300 votes on gagne 64 &eacute;meraude (exemple)\r\nConfigurable via le panel.',0,''),(31,1,1,'Pouvoir rechercher un membre depuis le panel sans faire ctrl + F',0,''),(32,2,1,'Sa serais bien que dans le forum il y aurait le pseudo en dessous de la t&ecirc;te du skin\r\nDans la list des topic\r\nPour savoir directement qui a cr&eacute;e ce topic',3,''),(34,1,1,'Faire un systeme de notification sur le forum, par exemple : @Stylexe02  {Message} Et je recois une notif sur le site ',0,''),(35,2,1,'Pouvoir mettre des sous-titres aux sous-forums',0,''),(36,2,1,'Pouvoir mettre des couleurs dans les descriptions Paypal et boutique',0,''),(37,2,1,'Pouvoir activ&eacute; ou d&eacute;sactiv&eacute; l\'affichage du nombre de sous forum ( Voir image , cadre rouge :  http://prntscr.com/je4ppa )',0,''),(38,2,1,'Syst&egrave;me de &quot;r&eacute;cup&eacute;rer plus tard&quot; pour les votes',0,''),(39,2,1,'mettre si possible pour les 3 meilleur voteur un syst&egrave;me de r&eacute;compense par exemple des jeton a chaque 1 er du mois en fin modifiable sur le panel',0,''),(40,2,1,'Pouvoir choisir combien de fois un produit peut &egrave;tre vendu ( Genre on choisi de vendre 50 VIP ) et quand y\'en a pu Sa marque Rupture De Stock !',0,''),(41,2,1,'Pouvoir &agrave; la place de mettre 0 mettre gratuit sur les offres de la boutique !\r\n(&Ccedil;a fais plus jolie !)',0,''),(42,2,1,'Pouvoir mettre fonctionnel un code promo que sur une cat&eacute;gorie (exemple: promo sur les grades avec le code CMW \r\nBa si j\'ach&egrave;te de l\'argent le code ne marche pas)',0,''),(43,2,1,'mettre dans le param&egrave;tre de paiement quand un achat et effectuer un message de remerciement que l\'on peus edit&eacute; nous m&ecirc;me',0,''),(44,0,0,'Un nouveau syst&egrave;me de Paiement car MCGPASS a d&eacute;sactiv&eacute; son syst&egrave;me d\'inscription',0,''),(45,0,0,'Pouvoir payer sur le serveur sans avoir de jetons (par exemple en option dans le panel admin)',0,''),(46,2,1,'Pour les admins quand une mise a jour est arriv&eacute; un message s\'affiche sur la page d\'accueil pour pouvoir mettre a jour !',0,''),(47,2,1,'Pouvoir importer des images sur le site et les r&eacute;utilis&eacute; pour des actions boutiques etc...',0,''),(48,0,0,'Cr&eacute;e des une pages de changelogs pour les admins qui veulent dire ce qu\'il ont rajout&eacute; pour leurs serveur ainsi qu\'une FAQ 100% Personnalisable !',0,''),(49,0,0,'Rajouter une page ( activable ou non ) affichant les status des serveurs ou du serveurs et ainsi pouvoir choisir sur la page d\'accueil si ont met Online , Offline, ou en MAintenance qui permetterai sur la pages , status ses de voir si le faction ou le opprison est ouvert ou ferm&eacute; et sur la page d\'accueil permettre de voir si le serveur est : Ouvert, Ferm&eacute;, ou en Maintenance !',0,''),(50,0,0,'Pouvoir faire une page &quot; AVIS &quot; Comme pour le support mais ses des avis',0,''),(51,2,1,'Pouvoir passer son serveur en mode &quot;En Maintenance&quot; sur la page d\'accueil au lieu de En-Ligne ou Hors-Ligne',0,''),(52,1,1,' faire des backup qu\'on peut t&eacute;l&eacute;garger , en cas de probl&egrave;me la mettre ou quand on change h&eacute;bergeur pour que les joueur de perde rien sur le site .',0,''),(53,1,1,'Pouvoir Rajouter des gains pour le classement des votes et qu\'il se remettre a z&eacute;ro tous les 30 du mois sauf En fevrier tous les 28 Jours ',0,''),(54,0,0,'Pouvoir rajouter des plugins (ou addons) cr&eacute;er par la communaut&eacute;',0,''),(55,2,1,'Pouvoir modifier l\'ordre des sous-forums',0,''),(56,1,2,'Int&eacute;grer compl&egrave;tement BS4 sur le th&egrave;me d&eacute;fault :\'(',0,''),(57,2,2,'Bug pour passer les joueurs en Cr&eacute;ateur (#f-a-q)',3,''),(58,2,2,'Le bouton &quot;Se Souvenir de Moi&quot; ne fonctionnait plus',3,''),(59,2,1,'Mettre dans le profil du joueur, le nombre de vote effectu&eacute;',0,''),(60,1,1,'Mettre un syst&egrave;me sp&eacute;cifique au STAFF pour mettre sur le site si ils sont connect&eacute;s et pr&ecirc;t pour aider !\r\nSa pourra allez de paire avec le tchat direct',0,''),(61,2,1,'Pour le syst&egrave;me de vote mettre un moyen de donner plusieurs item diff&eacute;rents du serveur en mettant plusieurs ID ainsi que le nombre d\'objet de l\'item donn&eacute; !',0,''),(62,2,1,'Avoir l\'apercu du site quand on le met sur Discord ou Autre',0,''),(63,2,1,'Pouvoir choisir si le support est obligatoirement en Priv&eacute; ou en Public et bloqu&eacute; l\'autre possibilit&eacute; via le panels admin :wink: et choisir si on fait les deux',0,''),(64,2,1,'Pouvoir modifier le nom des Topics sur le forum',0,''),(65,1,1,'Pouvoir class&eacute; les membres de la page membres dans  le panel admin , Trier De A - Z , Trier De Z-A ,  Trier par Rank. ?',0,''),(66,2,2,'Remplacer end($lastGrade) par max($lastGrade) partout dans les grades (réfléchir)',0,''),(67,1,1,'D&eacute;tecter si le serveur est en whitelist + message personnalis&eacute; s\'il est whitelist, en ligne ou hors ligne',0,''),(68,0,0,'Pouvoir choisir si on peut mettre le chat in game et authme sur le site  , pour se co et parler dans le chat comme sa les membres du staff peuvent aussi faire le travail si il peuvent pas sur un ordinateur avec minecraft .',0,''),(69,1,1,'pouvoir choisir le pr&eacute;fix de la table de la BDD (si on veut choisir le pr&eacute;fix (ou multi-installation) ex : &quot;CMW_forum&quot; -&gt; &quot;CUSTOM_forum&quot;)',0,''),(70,1,1,'Quand on ban quelqu\'un in game , et quand il se co sur le site il a une page de d&eacute;bannissement . Et pour toute les requ&ecirc;te il a une cat&eacute;gorie sur le panel - D&eacute;bannissement avec toute les requ&ecirc;te .',0,''),(71,0,0,'Faire des pages custom accessible uniquement  aux grades d&eacute;finies',0,''),(72,2,2,'augmenter la taille de l\'activation de compte: http://prntscr.com/jjpdiq ( car ses petit pour modifi&eacute; le contenu du mail )',0,''),(73,2,2,'Pouvoir rester sur la page des rangs quand on en cr&eacute;e un ( car pour le moment sa nous retourne sur l\'accueil du panel )',0,''),(74,1,1,'Pouvoir choisir la couleur du rangs  ainsi que pour les prefix forum avec une palette de couleur',0,''),(75,1,1,'FluxRSS &amp; Atom pour les forums &amp; news',0,''),(76,1,1,'Pouvoir avoir plusieurs Grade Site en meme Temp ( qui permet d\'avoir les permissions de plusieurs grades en meme temp )',0,''),(77,1,1,'Pouvoir import&eacute; ses propres animations pour les grades du site',0,''),(78,0,0,'Pouvoir bougers de gauche a droite les liens basique et les menus d&eacute;roulant pour qu\'il soit a une autre place',0,''),(79,1,1,'Garder les serveurs JSON sur la bdd? ( si possible )',0,''),(80,1,1,'pouvoir utiliser des dollars en jeu pour en faire des tokens sur le site',0,''),(81,2,2,'Pouvoir faire en sorte que le post-it  ne refresh pas la page ( si possible )',0,''),(82,0,0,'Pouvoir choisir de mettre un systeme d\'inscription , quand on se co il a /register , et sa inscrit aussi la personne sur le site aussi',0,''),(83,1,1,'Mettre des cases sur les membres et non un bouton &quot;supprim&eacute;&quot; et supprim&eacute; plusieurs membre en meme temp et sa permet de pas missclick',0,''),(84,1,1,'Pouvoir avoir des boutiques respectives par serveurs ( C&agrave;D faire des &quot;cat&eacute;gories&quot; pour chaque serveur comme pour les liens de votes mais sur la boutique et ont choisi que la cat&eacute;gorie Grade , soit dans faction ou dans OpPrison et pouvoir donc cr&eacute;e plusieurs cat&eacute;gories du meme nom Grade 1 dans Faction et l\'autre dans OpPrison ( si vous comprenez pas je ferais un photoshop explicatif )',0,''),(85,2,1,'Faire une pr&eacute;visualisation du texte quond ecrit dans le topic',0,''),(86,2,1,'Pouvoir faire une signature sur le forum via le profil ',0,''),(87,2,1,'Pouvoir Modifi&eacute; le nom d\'un &quot;forum&quot; sans pass&eacute; par la BDD',0,''),(88,2,1,'Pouvoir Modifi&eacute; le nom d\'un topic en temp qu\'admin et si ont est le cr&eacute;ateur',0,''),(89,0,0,'Pourvoir modifier les post forum (nom , et tout ) on peut le modifier en joueur si on est le createur du post et si on est admin on peut tout modifier (nom et tout) modifier l\'ordre des post.',0,''),(90,2,1,'Mettre une perms pour que dans le panel admin on est acc&egrave;s a la vu des ip ou non ',0,'');
/*!40000 ALTER TABLE `cmw_idees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_jetons_paypal_offres`
--

DROP TABLE IF EXISTS `cmw_jetons_paypal_offres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_jetons_paypal_offres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `jetons_donnes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_jetons_paypal_offres`
--

LOCK TABLES `cmw_jetons_paypal_offres` WRITE;
/*!40000 ALTER TABLE `cmw_jetons_paypal_offres` DISABLE KEYS */;
INSERT INTO `cmw_jetons_paypal_offres` VALUES (1,'Donc généreux','',6.00,2500),(2,'4.99','test',4.99,499);
/*!40000 ALTER TABLE `cmw_jetons_paypal_offres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_maintenance`
--

DROP TABLE IF EXISTS `cmw_maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_maintenance` (
  `maintenanceId` int(1) NOT NULL AUTO_INCREMENT,
  `maintenanceMsg` text NOT NULL,
  `maintenanceMsgAdmin` text NOT NULL,
  `maintenanceTime` int(11) NOT NULL,
  `maintenancePref` int(1) NOT NULL,
  `maintenanceEtat` int(1) NOT NULL,
  PRIMARY KEY (`maintenanceId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_maintenance`
--

LOCK TABLES `cmw_maintenance` WRITE;
/*!40000 ALTER TABLE `cmw_maintenance` DISABLE KEYS */;
INSERT INTO `cmw_maintenance` VALUES (1,'Malheureusement le site est actuellement en maintenance..</br>Revenez plus tard.','Vous êtes administrateur ? Alors connectez-vous :',1501248800,0,0);
/*!40000 ALTER TABLE `cmw_maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_mcgpass`
--

DROP TABLE IF EXISTS `cmw_mcgpass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_mcgpass` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `tokens` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_mcgpass`
--

LOCK TABLES `cmw_mcgpass` WRITE;
/*!40000 ALTER TABLE `cmw_mcgpass` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_mcgpass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_news`
--

DROP TABLE IF EXISTS `cmw_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  `image` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_news`
--

LOCK TABLES `cmw_news` WRITE;
/*!40000 ALTER TABLE `cmw_news` DISABLE KEYS */;
INSERT INTO `cmw_news` VALUES (1,'Merci d\'avoir choisi CraftMyWebsite','Vous pourrez supprimer cette news depuis votre panel admin !<br /> CraftMyWebsite est en constant développement, pensez à suivre les mises à jour sur notre site !','CraftMyWebsite',1523871848,''),(2,'test','<p>test</p>\r\n','Florentlife',1524306055,'');
/*!40000 ALTER TABLE `cmw_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_news_commentaires`
--

DROP TABLE IF EXISTS `cmw_news_commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_news_commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `commentaire` text NOT NULL,
  `date_post` int(11) NOT NULL,
  `nbrEdit` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_news_commentaires`
--

LOCK TABLES `cmw_news_commentaires` WRITE;
/*!40000 ALTER TABLE `cmw_news_commentaires` DISABLE KEYS */;
INSERT INTO `cmw_news_commentaires` VALUES (1,2,'Florentlife','test55',1525284697,0,0);
/*!40000 ALTER TABLE `cmw_news_commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_news_reports`
--

DROP TABLE IF EXISTS `cmw_news_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_news_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `id_commentaires` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `message` text NOT NULL,
  `victime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_news_reports`
--

LOCK TABLES `cmw_news_reports` WRITE;
/*!40000 ALTER TABLE `cmw_news_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_news_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_news_stats`
--

DROP TABLE IF EXISTS `cmw_news_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_news_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_news_stats`
--

LOCK TABLES `cmw_news_stats` WRITE;
/*!40000 ALTER TABLE `cmw_news_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_news_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_pages`
--

DROP TABLE IF EXISTS `cmw_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_pages`
--

LOCK TABLES `cmw_pages` WRITE;
/*!40000 ALTER TABLE `cmw_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_postit`
--

DROP TABLE IF EXISTS `cmw_postit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_postit` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `auteur` varchar(40) NOT NULL,
  `message` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_postit`
--

LOCK TABLES `cmw_postit` WRITE;
/*!40000 ALTER TABLE `cmw_postit` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_postit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_support`
--

DROP TABLE IF EXISTS `cmw_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL,
  `etat` int(1) NOT NULL,
  `ticketDisplay` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_support`
--

LOCK TABLES `cmw_support` WRITE;
/*!40000 ALTER TABLE `cmw_support` DISABLE KEYS */;
INSERT INTO `cmw_support` VALUES (1,'Florentlife','test','test','2018-05-03 20:49:50',0,0);
/*!40000 ALTER TABLE `cmw_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_support_commentaires`
--

DROP TABLE IF EXISTS `cmw_support_commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_support_commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_support_commentaires`
--

LOCK TABLES `cmw_support_commentaires` WRITE;
/*!40000 ALTER TABLE `cmw_support_commentaires` DISABLE KEYS */;
INSERT INTO `cmw_support_commentaires` VALUES (1,1,'Florentlife','test','2018-05-03 20:49:54');
/*!40000 ALTER TABLE `cmw_support_commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_sysip`
--

DROP TABLE IF EXISTS `cmw_sysip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_sysip` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `idPerIP` int(11) NOT NULL,
  `nbrPerIP` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_sysip`
--

LOCK TABLES `cmw_sysip` WRITE;
/*!40000 ALTER TABLE `cmw_sysip` DISABLE KEYS */;
INSERT INTO `cmw_sysip` VALUES (1,0,2);
/*!40000 ALTER TABLE `cmw_sysip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_sysmail`
--

DROP TABLE IF EXISTS `cmw_sysmail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_sysmail` (
  `idMail` int(1) NOT NULL AUTO_INCREMENT,
  `fromMail` text NOT NULL,
  `sujetMail` text NOT NULL,
  `msgMail` text NOT NULL,
  `strictMail` int(1) NOT NULL,
  `etatMail` int(1) NOT NULL,
  PRIMARY KEY (`idMail`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_sysmail`
--

LOCK TABLES `cmw_sysmail` WRITE;
/*!40000 ALTER TABLE `cmw_sysmail` DISABLE KEYS */;
INSERT INTO `cmw_sysmail` VALUES (1,'','Activation du compte !','Bienvenue sur notre site {JOUEUR} !\r\n\r\nVous vous êtes inscrit sur le site officiel du serveur NOM_DU_SERVEUR.\r\nPour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.\r\n\r\n{LIEN}\r\n\r\nInscription depuis cette adresse IP : {IP}\r\n---------------\r\nCeci est un mail automatique, merci de ne pas y répondre.',1,0);
/*!40000 ALTER TABLE `cmw_sysmail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_tempgrades`
--

DROP TABLE IF EXISTS `cmw_tempgrades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_tempgrades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `grade_temporaire` varchar(100) NOT NULL,
  `grade_temps` int(11) NOT NULL,
  `grade_vie` varchar(100) NOT NULL,
  `is_active` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_tempgrades`
--

LOCK TABLES `cmw_tempgrades` WRITE;
/*!40000 ALTER TABLE `cmw_tempgrades` DISABLE KEYS */;
/*!40000 ALTER TABLE `cmw_tempgrades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_users`
--

DROP TABLE IF EXISTS `cmw_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `email` varchar(32) NOT NULL,
  `anciennete` int(11) NOT NULL,
  `newsletter` int(1) NOT NULL,
  `rang` int(2) NOT NULL DEFAULT '1',
  `tokens` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `skype` varchar(16) NOT NULL,
  `resettoken` varchar(32) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `CleUnique` varchar(32) NOT NULL,
  `ValidationMail` int(1) NOT NULL,
  `img_extension` char(4) NOT NULL,
  `show_email` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_users`
--

LOCK TABLES `cmw_users` WRITE;
/*!40000 ALTER TABLE `cmw_users` DISABLE KEYS */;
INSERT INTO `cmw_users` VALUES (1,'Florentlife','$2y$10$tEc/pJb3gl4wbEeBuQCKcOhvxZgrP1d0R7pB0/RP4.ndPZ51.EPZW','florentlife.dev@gmail.com',1523871902,0,1,304,0,'','d02cff0067a6961c3e40a45333880e1c','0','0',1,'png',1),(3,'JorisLeCon','$2y$10$D.ONRVBB0J7AcZlzDVy2BORJxBXeHXbqu47rvoqt0g8uIeoYOvauS','jorisboureau@gmail.com',1524838869,1,0,0,0,'','','176.154.36.167','0',1,'0',0),(4,'Emilien52','$2y$10$VD8m0C9msRYTCotBbo1q7eFiROTn7Opx5e/Um/Oqf7zUzAvyTiFNi','emiliengarandeau@yahoo.fr',1524845928,1,1,0,0,'','','80.12.39.203','0',1,'png',0),(5,'SuperPandaxOff','$2y$10$Cbos/4SN9JrYBbzjUexAY.Ms7ix8IS.UdFI6E.u0uEf3ETNkCdkN2','MiniChouBGaminG@gmail.com',1525888161,1,0,0,0,'','','90.12.63.147','',1,'',0),(6,'captainthor35','$2y$10$OovBKFx10dxV053FNEr1beAd7wkrM2pWSHkbZ3/NvvBfT45M/G0/e','chicoine.hugo@gmail.com',1526061581,1,0,0,15,'1','','188.224.41.130','',1,'',0),(7,'Testeur','$2y$10$X0gz/UYSwrTDhkcufa/bB.Vxr9lnKI9e2maDEpb3zXgGIKQ9OUzPi','test@test.fr',1526823953,1,2,0,0,'','','90.76.80.237','',1,'',0);
/*!40000 ALTER TABLE `cmw_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_visits`
--

DROP TABLE IF EXISTS `cmw_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `dates` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=605 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_visits`
--

LOCK TABLES `cmw_visits` WRITE;
/*!40000 ALTER TABLE `cmw_visits` DISABLE KEYS */;
INSERT INTO `cmw_visits` VALUES (562,'171.13.14.10','2018-05-22'),(563,'54.153.54.163','2018-05-22'),(564,'91.140.105.199','2018-05-22'),(561,'139.162.226.245','2018-05-22'),(586,'77.72.85.108','2018-05-24'),(585,'217.72.205.120','2018-05-23'),(584,'217.72.205.90','2018-05-23'),(583,'217.72.205.121','2018-05-23'),(582,'192.241.208.242','2018-05-23'),(581,'86.250.59.165','2018-05-23'),(580,'141.212.122.16','2018-05-23'),(579,'195.115.117.36','2018-05-23'),(578,'216.218.206.68','2018-05-23'),(577,'185.10.68.132','2018-05-23'),(576,'91.202.132.206','2018-05-23'),(598,'54.215.254.26','2018-05-26'),(592,'139.162.116.133','2018-05-25'),(591,'107.170.245.250','2018-05-24'),(590,'195.115.117.37','2018-05-24'),(589,'216.218.206.67','2018-05-24'),(588,'185.10.68.132','2018-05-24'),(587,'13.56.232.243','2018-05-24'),(597,'173.249.16.204','2018-05-25'),(596,'139.162.78.135','2018-05-25'),(595,'74.82.47.5','2018-05-25'),(594,'185.10.68.132','2018-05-25'),(593,'85.93.170.155','2018-05-25'),(603,'2a02:a03f:5179:c200:21ee:30fc:1e93:2022','2018-05-27'),(602,'87.67.192.42','2018-05-26'),(601,'13.56.232.243','2018-05-26'),(599,'185.10.68.132','2018-05-26'),(600,'184.105.247.195','2018-05-26'),(534,'51.38.12.23','2018-05-21'),(604,'251.127.81.120','2018-05-27'),(574,'54.215.254.26','2018-05-23'),(573,'178.73.215.171','2018-05-22'),(572,'206.16.134.30','2018-05-22'),(571,'74.82.47.3','2018-05-22'),(570,'171.13.14.6','2018-05-22'),(569,'185.10.68.132','2018-05-22'),(568,'34.240.96.4','2018-05-22'),(567,'13.56.232.243','2018-05-22'),(566,'139.162.78.135','2018-05-22'),(565,'164.52.6.150','2018-05-22'),(555,'196.52.84.28','2018-05-22'),(554,'86.225.45.145','2018-05-21'),(553,'18.236.184.165','2018-05-21'),(552,'90.76.80.237','2018-05-21'),(551,'184.105.247.194','2018-05-21'),(550,'52.91.176.233','2018-05-21'),(549,'209.126.136.7','2018-05-21'),(548,'106.45.1.109','2018-05-21'),(547,'180.95.225.217','2018-05-21'),(546,'14.204.114.84','2018-05-21'),(545,'36.5.178.184','2018-05-21'),(544,'124.88.64.200','2018-05-21'),(543,'171.13.14.21','2018-05-21'),(542,'185.10.68.132','2018-05-21'),(541,'139.162.78.135','2018-05-21'),(540,'139.162.116.133','2018-05-21'),(539,'162.244.33.8','2018-05-21'),(538,'107.170.230.48','2018-05-21'),(537,'167.114.129.107','2018-05-21'),(536,'77.72.85.108','2018-05-21'),(535,'171.13.14.18','2018-05-21'),(560,'92.23.62.187','2018-05-22'),(559,'196.54.55.7','2018-05-22'),(558,'87.114.206.222','2018-05-22'),(557,'162.243.187.126','2018-05-22'),(556,'46.101.119.24','2018-05-22'),(575,'139.162.116.133','2018-05-23');
/*!40000 ALTER TABLE `cmw_visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_votes`
--

DROP TABLE IF EXISTS `cmw_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `nbre_votes` int(5) NOT NULL,
  `site` int(4) NOT NULL,
  `date_dernier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_votes`
--

LOCK TABLES `cmw_votes` WRITE;
/*!40000 ALTER TABLE `cmw_votes` DISABLE KEYS */;
INSERT INTO `cmw_votes` VALUES (1,'Florentlife',1,1,1525903847);
/*!40000 ALTER TABLE `cmw_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cmw_votes_config`
--

DROP TABLE IF EXISTS `cmw_votes_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cmw_votes_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `methode` tinyint(3) unsigned NOT NULL,
  `action` varchar(100) NOT NULL,
  `serveur` tinyint(3) unsigned NOT NULL,
  `lien` varchar(255) NOT NULL,
  `temps` int(10) unsigned NOT NULL,
  `titre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cmw_votes_config`
--

LOCK TABLES `cmw_votes_config` WRITE;
/*!40000 ALTER TABLE `cmw_votes_config` DISABLE KEYS */;
INSERT INTO `cmw_votes_config` VALUES (1,'',1,'jeton:4',0,'http://Test.fr',5,'test5'),(2,'test',1,'give:id:64:quantite:25',0,'http://2test2.fr',5,'test2'),(3,'test3',1,'give:id:264:quantite:4',0,'http://test3.fr',25,'test3');
/*!40000 ALTER TABLE `cmw_votes_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cmw'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-27  1:00:01
