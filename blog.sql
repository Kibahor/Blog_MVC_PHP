-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 29 nov. 2021 à 11:27
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------rror or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-5' at line 3 in /var/www/html/projet-php-blog/config/Connect

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `mail` varchar(120) NOT NULL,
  `login` varchar(60) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `firstName`, `lastName`, `mail`, `login`, `pass`) VALUES
(1, 'Patrick', 'Marthus', 'Patrick@marthus.be', 'admin', 'aaa'),
(2, 'Patrick', 'Marthus', 'Patrick@marthus.be', 'admin', 'aaa');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `created` date NOT NULL,
  `idAdmin` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `created`, `idAdmin`) VALUES
(1, 'Blockchain: the revolution we’re not ready for', 'This is precisely the promise of blockchains.\r\nCryptocurrencies, which are built on blockchains, are all over the press these days, mostly because of the high prices, volatility, and sensational narratives surrounding debacles like Mt. Gox and The Silk Road.\r\nBut there’s something much bigger going on than just digital currencies.\r\nWhile the mainstream media has been busy speculating about prices and black market intrigues, they’ve missed the fact that beneath it all, cryptographers had quietly invented an entirely new set of technological primitives.\r\nBlockchains (and the consensus protocols that support them) were invented as a result of developers trying to solve a bold problem: how to create digital, untraceable money. By combining cryptography, game theory, economics, and computer science, they managed to create an entirely new set of tools for building decentralized systems.\r\nBut what they created will change much more than just how we exchange money. It’s going to change the entire world. And hardly anyone seems to notice.\r\nEdward Witten, the famous physicist, once said of string theory that it was “a part of 21st century physics that fell by chance into the 20th century.” In other words, the physics community was not ready for string theory.\"\"\r\n\r\nWESH', '2017-08-09', 2),
(2, 'titre', 'content', '2021-11-28', 2),
(3, 'titre', 'content', '2021-11-28', 2),
(4, 'titre', 'content', '2021-11-28', 2),
(5, 'titre', 'content', '2021-11-28', 2),
(6, 'titre', 'content', '2021-11-28', 2),
(7, 'titre', 'content', '2021-11-28', 2),
(8, 'titre', 'content', '2021-11-28', 2),
(9, 'titre', 'content', '2021-11-28', 2),
(10, 'titre', 'content', '2021-11-28', 2),
(11, 'titre', 'content', '2021-11-28', 2),
(12, 'titre', 'content', '2021-11-28', 2);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `created` date NOT NULL,
  `idArticle` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idArticle`) REFERENCES `article` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
