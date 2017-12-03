-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 03 déc. 2017 à 15:06
-- Version du serveur :  10.1.29-MariaDB
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
-- Base de données :  `cmwv1.6`
--

-- --------------------------------------------------------

--
-- Structure de la table `cmw_boutique_action`
--

CREATE TABLE `cmw_boutique_action` (
  `id` int(11) NOT NULL,
  `methode` int(2) NOT NULL,
  `commande_valeur` text NOT NULL,
  `prix` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_boutique_action`
--

INSERT INTO `cmw_boutique_action` (`id`, `methode`, `commande_valeur`, `prix`, `duree`, `id_offre`) VALUES
(1, 0, '§achat {PLAYER} prince', 0, 0, 3),
(2, 0, '§achat {PLAYER} chevalier', 0, 1, 4),
(3, 1, 'TESSTTTT :D', 0, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_boutique_categories`
--

CREATE TABLE `cmw_boutique_categories` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `ordre` int(11) NOT NULL,
  `serveur` int(11) NOT NULL,
  `connection` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_boutique_categories`
--

INSERT INTO `cmw_boutique_categories` (`id`, `titre`, `message`, `ordre`, `serveur`, `connection`) VALUES
(1, 'GRADES', 'Permet de vous acheter des grades pour de meilleurs avantages sur le serveur', 1, 0, 0),
(2, 'Teeeesttt', 'test :D', 2, -1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_boutique_offres`
--

CREATE TABLE `cmw_boutique_offres` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `evo` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_boutique_offres`
--

INSERT INTO `cmw_boutique_offres` (`id`, `nom`, `description`, `prix`, `categorie_id`, `ordre`, `evo`) VALUES
(3, 'PRINCE', 'Description grade prince', 10000, 1, 1, 4),
(4, 'CHEVALIER', 'Avantages:</br>Kit chevalier toutes les 24 Heures</br>- Commande /back toutes les 3 minutes</br>- Commande /ec toutes les 1 minutes</br>- 18 places de stockage supplémentaire dans l\'Enderchest</br>- Commande /craft sans délais de réutilisation</br>- Accès à 8 Homes maximum</br>- Préfixe du grade [?] cyan</br>- Écrire en couleur sur les panneaux</br>Kit Chevalier:', 500, 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_boutique_reduction`
--

CREATE TABLE `cmw_boutique_reduction` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `code_promo` char(8) NOT NULL,
  `pourcent` tinyint(3) UNSIGNED NOT NULL,
  `titre` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_boutique_reduction`
--

INSERT INTO `cmw_boutique_reduction` (`id`, `code_promo`, `pourcent`, `titre`) VALUES
(1, 'CMWTEST', 100, 'Code de réduc de test');

-- --------------------------------------------------------

--
-- Structure de la table `cmw_boutique_stats`
--

CREATE TABLE `cmw_boutique_stats` (
  `id` int(11) NOT NULL,
  `offre_id` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  `prix` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_connectes`
--

CREATE TABLE `cmw_connectes` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `ip` char(15) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_dedipass`
--

CREATE TABLE `cmw_dedipass` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `code` varchar(8) NOT NULL,
  `rate` varchar(60) NOT NULL,
  `payout` float NOT NULL,
  `tokens` int(11) NOT NULL,
  `date_achat` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum`
--

CREATE TABLE `cmw_forum` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_answer`
--

CREATE TABLE `cmw_forum_answer` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_topic` smallint(6) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_post` date NOT NULL,
  `d_edition` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_answer_removed`
--

CREATE TABLE `cmw_forum_answer_removed` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_answer` smallint(5) UNSIGNED NOT NULL,
  `id_topic` smallint(5) UNSIGNED NOT NULL,
  `auteur_answer` varchar(60) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `Raison` varchar(200) DEFAULT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_categorie`
--

CREATE TABLE `cmw_forum_categorie` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nom` varchar(40) NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `sous-forum` tinyint(4) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL,
  `close` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_like`
--

CREATE TABLE `cmw_forum_like` (
  `id` smallint(4) UNSIGNED NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `Appreciation` smallint(6) NOT NULL,
  `vu` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `new` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_lu`
--

CREATE TABLE `cmw_forum_lu` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `pseudo` varchar(82) NOT NULL,
  `id_topic` int(10) UNSIGNED NOT NULL,
  `vu` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Structure de la table `cmw_forum_post`
--

CREATE TABLE `cmw_forum_post` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_creation` date NOT NULL,
  `last_answer` varchar(40) DEFAULT NULL,
  `sous_forum` smallint(6) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `d_edition` date DEFAULT NULL,
  `prefix` tinyint(4) NOT NULL,
  `epingle` tinyint(3) UNSIGNED NOT NULL,
  `affichage` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_prefix`
--

CREATE TABLE `cmw_forum_prefix` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `span` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_forum_prefix`
--

INSERT INTO `cmw_forum_prefix` (`id`, `span`, `nom`) VALUES
(1, 'prefix prefixRed', 'Important'),
(2, 'prefix prefixOrange', 'Refusée'),
(3, 'prefix prefixGreen', 'Acceptée'),
(4, 'prefix prefixRoyalBl', 'En Attente');

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_report`
--

CREATE TABLE `cmw_forum_report` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `type` smallint(6) NOT NULL,
  `id_topic_answer` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `reporteur` varchar(40) NOT NULL,
  `vu` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `new` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_sous_forum`
--

CREATE TABLE `cmw_forum_sous_forum` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_topic_followed`
--

CREATE TABLE `cmw_forum_topic_followed` (
  `id` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `last_answer` int(11) NOT NULL,
  `vu` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `new` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_forum_topic_removed`
--

CREATE TABLE `cmw_forum_topic_removed` (
  `id` int(11) UNSIGNED NOT NULL,
  `nom` varchar(80) NOT NULL,
  `nb_reponse` int(10) UNSIGNED NOT NULL,
  `auteur_topic` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `raison` varchar(300) NOT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_jetons_paypal_offres`
--

CREATE TABLE `cmw_jetons_paypal_offres` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `jetons_donnes` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_maintenance`
--

CREATE TABLE `cmw_maintenance` (
  `maintenanceId` int(1) NOT NULL,
  `maintenanceMsg` text NOT NULL,
  `maintenanceMsgAdmin` text NOT NULL,
  `maintenanceTime` int(11) NOT NULL,
  `maintenancePref` int(1) NOT NULL,
  `maintenanceEtat` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_maintenance`
--

INSERT INTO `cmw_maintenance` (`maintenanceId`, `maintenanceMsg`, `maintenanceMsgAdmin`, `maintenanceTime`, `maintenancePref`, `maintenanceEtat`) VALUES
(1, 'Malheureusement le site est actuellement en maintenance..</br>Revenez plus tard.', 'Vous êtes administrateur ? Alors connectez-vous :', 1501248800, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_news`
--

CREATE TABLE `cmw_news` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  `image` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_news`
--

INSERT INTO `cmw_news` (`id`, `titre`, `message`, `auteur`, `date`, `image`) VALUES
(3, 'Test', 'Teeeeeesssssttttt', 'Florentlife', 1509525890, '');

-- --------------------------------------------------------

--
-- Structure de la table `cmw_news_commentaires`
--

CREATE TABLE `cmw_news_commentaires` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `commentaire` text NOT NULL,
  `date_post` int(11) NOT NULL,
  `nbrEdit` int(11) NOT NULL,
  `report` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_news_commentaires`
--

INSERT INTO `cmw_news_commentaires` (`id`, `id_news`, `pseudo`, `commentaire`, `date_post`, `nbrEdit`, `report`) VALUES
(1, 3, 'Florentlife', 'teeesstt', 1509532138, 0, 0),
(2, 3, 'Florentlife', 'tesssteterererer', 1511552848, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_news_reports`
--

CREATE TABLE `cmw_news_reports` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `id_commentaires` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `message` text NOT NULL,
  `victime` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_news_stats`
--

CREATE TABLE `cmw_news_stats` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `pseudo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_news_stats`
--

INSERT INTO `cmw_news_stats` (`id`, `id_news`, `pseudo`) VALUES
(1, 3, 'Florentlife');

-- --------------------------------------------------------

--
-- Structure de la table `cmw_pages`
--

CREATE TABLE `cmw_pages` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_support`
--

CREATE TABLE `cmw_support` (
  `id` int(11) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL,
  `etat` int(1) NOT NULL,
  `ticketDisplay` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_support_commentaires`
--

CREATE TABLE `cmw_support_commentaires` (
  `id` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_sysip`
--

CREATE TABLE `cmw_sysip` (
  `id` int(1) NOT NULL,
  `idPerIP` int(11) NOT NULL,
  `nbrPerIP` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_sysip`
--

INSERT INTO `cmw_sysip` (`id`, `idPerIP`, `nbrPerIP`) VALUES
(1, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_sysmail`
--

CREATE TABLE `cmw_sysmail` (
  `idMail` int(1) NOT NULL,
  `fromMail` text NOT NULL,
  `sujetMail` text NOT NULL,
  `msgMail` text NOT NULL,
  `strictMail` int(1) NOT NULL,
  `etatMail` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cmw_sysmail`
--

INSERT INTO `cmw_sysmail` (`idMail`, `fromMail`, `sujetMail`, `msgMail`, `strictMail`, `etatMail`) VALUES
(1, 'exemple@exemple.fr', 'Activation du compte !', 'Bienvenue sur notre site {JOUEUR} !\r\n\r\nVous vous êtes inscrit sur le site officiel du serveur NOM_DU_SERVEUR.\r\nPour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.\r\n\r\n{LIEN}\r\n\r\nInscription depuis cette adresse IP : {IP}\r\n---------------\r\nCeci est un mail automatique, merci de ne pas y répondre.', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cmw_tempgrades`
--

CREATE TABLE `cmw_tempgrades` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `grade_temporaire` varchar(100) NOT NULL,
  `grade_temps` int(11) NOT NULL,
  `grade_vie` varchar(100) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_users`
--

CREATE TABLE `cmw_users` (
  `id` int(11) NOT NULL,
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
  `ValidationMail` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_visits`
--

CREATE TABLE `cmw_visits` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `dates` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_votes`
--

CREATE TABLE `cmw_votes` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `nbre_votes` int(5) NOT NULL,
  `site` int(4) NOT NULL,
  `date_dernier` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cmw_votes_stuff`
--

CREATE TABLE `cmw_votes_stuff` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `pseudo` varchar(42) NOT NULL,
  `action` tinyint(3) UNSIGNED NOT NULL,
  `value` text NOT NULL,
  `serveur` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cmw_boutique_action`
--
ALTER TABLE `cmw_boutique_action`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_boutique_categories`
--
ALTER TABLE `cmw_boutique_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_boutique_offres`
--
ALTER TABLE `cmw_boutique_offres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_boutique_reduction`
--
ALTER TABLE `cmw_boutique_reduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_boutique_stats`
--
ALTER TABLE `cmw_boutique_stats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_connectes`
--
ALTER TABLE `cmw_connectes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_dedipass`
--
ALTER TABLE `cmw_dedipass`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum`
--
ALTER TABLE `cmw_forum`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_answer`
--
ALTER TABLE `cmw_forum_answer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_answer_removed`
--
ALTER TABLE `cmw_forum_answer_removed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_categorie`
--
ALTER TABLE `cmw_forum_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_like`
--
ALTER TABLE `cmw_forum_like`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_lu`
--
ALTER TABLE `cmw_forum_lu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_post`
--
ALTER TABLE `cmw_forum_post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_prefix`
--
ALTER TABLE `cmw_forum_prefix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_report`
--
ALTER TABLE `cmw_forum_report`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_sous_forum`
--
ALTER TABLE `cmw_forum_sous_forum`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_topic_followed`
--
ALTER TABLE `cmw_forum_topic_followed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_forum_topic_removed`
--
ALTER TABLE `cmw_forum_topic_removed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_jetons_paypal_offres`
--
ALTER TABLE `cmw_jetons_paypal_offres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_maintenance`
--
ALTER TABLE `cmw_maintenance`
  ADD PRIMARY KEY (`maintenanceId`);

--
-- Index pour la table `cmw_news`
--
ALTER TABLE `cmw_news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_news_commentaires`
--
ALTER TABLE `cmw_news_commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_news_reports`
--
ALTER TABLE `cmw_news_reports`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_news_stats`
--
ALTER TABLE `cmw_news_stats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_pages`
--
ALTER TABLE `cmw_pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_support`
--
ALTER TABLE `cmw_support`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_support_commentaires`
--
ALTER TABLE `cmw_support_commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_sysip`
--
ALTER TABLE `cmw_sysip`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_sysmail`
--
ALTER TABLE `cmw_sysmail`
  ADD PRIMARY KEY (`idMail`);

--
-- Index pour la table `cmw_tempgrades`
--
ALTER TABLE `cmw_tempgrades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_users`
--
ALTER TABLE `cmw_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_visits`
--
ALTER TABLE `cmw_visits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_votes`
--
ALTER TABLE `cmw_votes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cmw_votes_stuff`
--
ALTER TABLE `cmw_votes_stuff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cmw_boutique_action`
--
ALTER TABLE `cmw_boutique_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `cmw_boutique_categories`
--
ALTER TABLE `cmw_boutique_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `cmw_boutique_offres`
--
ALTER TABLE `cmw_boutique_offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `cmw_boutique_reduction`
--
ALTER TABLE `cmw_boutique_reduction`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cmw_boutique_stats`
--
ALTER TABLE `cmw_boutique_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_connectes`
--
ALTER TABLE `cmw_connectes`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_dedipass`
--
ALTER TABLE `cmw_dedipass`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum`
--
ALTER TABLE `cmw_forum`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cmw_forum_answer`
--
ALTER TABLE `cmw_forum_answer`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_answer_removed`
--
ALTER TABLE `cmw_forum_answer_removed`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_categorie`
--
ALTER TABLE `cmw_forum_categorie`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_like`
--
ALTER TABLE `cmw_forum_like`
  MODIFY `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_lu`
--
ALTER TABLE `cmw_forum_lu`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_post`
--
ALTER TABLE `cmw_forum_post`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_prefix`
--
ALTER TABLE `cmw_forum_prefix`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `cmw_forum_report`
--
ALTER TABLE `cmw_forum_report`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_sous_forum`
--
ALTER TABLE `cmw_forum_sous_forum`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_topic_followed`
--
ALTER TABLE `cmw_forum_topic_followed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_forum_topic_removed`
--
ALTER TABLE `cmw_forum_topic_removed`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_jetons_paypal_offres`
--
ALTER TABLE `cmw_jetons_paypal_offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_maintenance`
--
ALTER TABLE `cmw_maintenance`
  MODIFY `maintenanceId` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cmw_news`
--
ALTER TABLE `cmw_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `cmw_news_commentaires`
--
ALTER TABLE `cmw_news_commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `cmw_news_reports`
--
ALTER TABLE `cmw_news_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_news_stats`
--
ALTER TABLE `cmw_news_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cmw_pages`
--
ALTER TABLE `cmw_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_support`
--
ALTER TABLE `cmw_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_support_commentaires`
--
ALTER TABLE `cmw_support_commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_sysip`
--
ALTER TABLE `cmw_sysip`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cmw_sysmail`
--
ALTER TABLE `cmw_sysmail`
  MODIFY `idMail` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cmw_tempgrades`
--
ALTER TABLE `cmw_tempgrades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_users`
--
ALTER TABLE `cmw_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_visits`
--
ALTER TABLE `cmw_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_votes`
--
ALTER TABLE `cmw_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cmw_votes_stuff`
--
ALTER TABLE `cmw_votes_stuff`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
