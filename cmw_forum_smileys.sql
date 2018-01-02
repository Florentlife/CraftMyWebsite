-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 02 jan. 2018 à 18:42
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cmwsuppo_version`
--

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_smileys`
--

CREATE TABLE IF NOT EXISTS `cmw_forum_smileys` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `symbole` varchar(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `priorite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_forum_smileys`
--

INSERT INTO `cmw_forum_smileys` (`id`, `symbole`, `image`, `priorite`) VALUES
(1, ':)', 'theme/smileys/1.gif', 500),
(2, ':diable', 'theme/smileys/37.gif', 499),
(3, ':D', 'theme/smileys/2.gif', 498),
(4, 'x)', 'theme/smileys/3.gif', 0),
(5, 'xd', 'theme/smileys/4.gif', 0),
(6, ':excited:', 'theme/smileys/5.gif', 0),
(7, ';)', 'theme/smileys/6.gif', 0),
(8, ':embarrass', 'theme/smileys/11.gif', 0),
(9, '8)', 'theme/smileys/13.gif', 0),
(10, ':o', 'theme/smileys/20.gif', 0),
(11, ':(', 'theme/smileys/23.gif', 0),
(12, ':c', 'theme/smileys/23.gif', 0),
(13, ':\'(', 'theme/smileys/24.gif', 0),
(14, '<3', 'theme/smileys/120.gif', 0),
(15, ':angel:', 'theme/smileys/36.gif', 0),
(16, ':salut:', 'theme/smileys/48.gif', 0),
(17, ':beer:', 'theme/smileys/51.gif', 0),
(18, ':cul:', 'theme/smileys/96.gif', 0),
(19, ':calimero', 'theme/smileys/97.gif', 0),
(20, ':vomir:', 'theme/smileys/98.gif', 0),
(21, ':google', 'theme/smileys/110.gif', 0),
(22, ':je sors:', 'theme/smileys/112.gif', 0),
(23, ':tu sors:', 'theme/smileys/117.gif', 0),
(24, ':vive moi:', 'theme/smileys/113.gif', 0),
(25, ':fouet:', 'theme/smileys/130.gif', 0),
(26, ':caca:', 'theme/smileys/151.gif', 0),
(27, ':bomb', 'theme/smileys/157.gif', 0),
(28, ':p', 'theme/smileys/131.gif', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
