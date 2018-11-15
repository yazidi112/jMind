-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Lun 10 Septembre 2018 à 01:00
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `jmind`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `idac` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`idac`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `account`
--

INSERT INTO `account` (`idac`, `user`, `pwd`) VALUES
(1, 'yazidi', '9b0ec74e94b47881d6342fed2c2cf9a1');

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `idcountry` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`idcountry`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `countries`
--

INSERT INTO `countries` (`idcountry`, `country`) VALUES
(1, 'Morrocco'),
(2, 'France'),
(3, 'USA'),
(4, 'China');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `statistic`
--
CREATE TABLE IF NOT EXISTS `statistic` (
`registerdate` varchar(255)
,`users` bigint(21)
);
-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `registerdate` varchar(255) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`iduser`, `name`, `phone`, `picture`, `country`, `birthdate`, `registerdate`) VALUES
(2, 'mustapha', '0644846627', 'http://127.0.0.1/framework/jmind/examples/images/test/birdstracker.png', 4, '2018-09-19', '2018-09-19'),
(4, 'yazidi', 'imran', 'http://127.0.0.1/framework/jmind/examples/images/test/birdstracker.png', 1, '2018-09-20', '2018-09-20'),
(6, 'jialali', '032323324', 'http://127.0.0.1/framework/jmind/examples/images/test/birdstracker.png', 2, '2018-09-26', '2018-09-26'),
(7, 'yazidi', '=9+90', 'http://127.0.0.1/framework/jmind-1.0.0/examples/images/imran/20189902184831542.jpg', 1, '2018-09-19', '2018-09-29');

-- --------------------------------------------------------

--
-- Structure de la vue `statistic`
--
DROP TABLE IF EXISTS `statistic`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `statistic` AS select `users`.`registerdate` AS `registerdate`,count(0) AS `users` from `users` group by `users`.`birthdate`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
