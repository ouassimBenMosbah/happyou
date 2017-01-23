-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 02 Novembre 2016 à 21:51
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_boitier`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `admin`
--

TRUNCATE TABLE `admin`;
--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `mdp`) VALUES
(1, 'admin', '41ec94e63648d36c5f7bfd2697a5f31f324d946978500940b90efcb3d2eef08f');

-- --------------------------------------------------------

--
-- Structure de la table `boitier`
--

CREATE TABLE IF NOT EXISTS `boitier` (
  `Num_serie_boitier` varchar(25) NOT NULL,
  `Date_install` date DEFAULT NULL,
  `id_question` int(11) NOT NULL,
  `id_lieu` int(11) NOT NULL,
  PRIMARY KEY (`Num_serie_boitier`),
  KEY `FK_Boitier_id_question` (`id_question`),
  KEY `FK_Boitier_id_lieu` (`id_lieu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `boitier`
--

TRUNCATE TABLE `boitier`;
--
-- Contenu de la table `boitier`
--

INSERT INTO `boitier` (`Num_serie_boitier`, `Date_install`, `id_question`, `id_lieu`) VALUES
('TST1', '2016-10-03', 4, 1),
('TST2', '2016-10-03', 4, 1),
('TST3', '2016-10-03', 1, 2),
('TST4', '2016-10-03', 6, 5);

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `id_lieu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_lieu` varchar(127) NOT NULL,
  PRIMARY KEY (`id_lieu`)
) ENGINE=InnoDB AUTO_INCREMENT=414 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `lieu`
--

TRUNCATE TABLE `lieu`;
--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`id_lieu`, `nom_lieu`) VALUES
(1, 'Toilettes RDC'),
(2, 'Toilettes 1er étage'),
(3, 'Foret'),
(4, 'Grange'),
(5, 'Réception'),
(6, 'Piscine'),
(7, 'Jardin'),
(8, 'Supermarché'),
(9, 'Roof top'),
(10, 'Bar'),
(11, 'Cinema'),
(12, 'Cave'),
(13, 'Douche');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `question`
--

TRUNCATE TABLE `question`;
--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_question`, `Question`) VALUES
(1, 'Est-ce que les toilettes sont propres ?'),
(2, 'Est-ce que le papier toilette est disponible ?'),
(3, 'Comptez-vous revenir ?'),
(4, 'Est-ce que les toilettes sont spacieuses ?'),
(5, 'Avez-vous aimé votre projet ?'),
(6, 'Est-ce que vous avez apprécié votre séjour ?'),
(7, 'L\'eau est froide ?'),
(8, 'Avez-vous été gêné par les moustiques ? '),
(9, 'Avez-vous trouvé ce que vous cherchiez ?'),
(10, 'Avez-vous aimez la vue ?'),
(11, 'Est-ce l\'ambiance vous a plus ?'),
(12, 'La qualité du son était bonne ?'),
(13, 'La pièce était bien éclairée ?'),
(14, 'Est-ce que le shampoing vous a plu ?'),
(15, 'Est-ce que l\'ambiance vous a plus ?');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id_vote` int(11) NOT NULL AUTO_INCREMENT,
  `Smiley` int(11) NOT NULL,
  `Num_serie_boitier` varchar(25) NOT NULL,
  `timestamp_vote` timestamp NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_lieu` int(11) NOT NULL,
  PRIMARY KEY (`id_vote`),
  KEY `FK_Vote_Num_serie_boitier` (`Num_serie_boitier`),
  KEY `FK_Vote_id_question` (`id_question`),
  KEY `FK_Vote_id_lieu` (`id_lieu`)
) ENGINE=InnoDB AUTO_INCREMENT=3014 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `vote`
--

TRUNCATE TABLE `vote`;
--
-- Contenu de la table `vote`
--


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `boitier`
--
ALTER TABLE `boitier`
  ADD CONSTRAINT `FK_Boitier_id_lieu` FOREIGN KEY (`id_lieu`) REFERENCES `lieu` (`id_lieu`),
  ADD CONSTRAINT `FK_Boitier_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_Vote_Num_serie_boitier` FOREIGN KEY (`Num_serie_boitier`) REFERENCES `boitier` (`Num_serie_boitier`),
  ADD CONSTRAINT `FK_Vote_id_lieu` FOREIGN KEY (`id_lieu`) REFERENCES `lieu` (`id_lieu`),
  ADD CONSTRAINT `FK_Vote_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
