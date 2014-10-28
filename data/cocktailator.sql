-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 28 Octobre 2014 à 16:36
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cocktailator`
--
CREATE DATABASE cocktailator;
USE cocktailator;
-- --------------------------------------------------------

--
-- Structure de la table `cocktail`
--

CREATE TABLE IF NOT EXISTS `cocktail` (
  `id_cocktail` smallint(5) unsigned NOT NULL,
  `cocktail_name` varchar(100) NOT NULL,
  `cocktail_require` varchar(500) NOT NULL,
  `cocktail_step` varchar(500) NOT NULL,
  PRIMARY KEY (`id_cocktail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `has_favorite_cocktail`
--

CREATE TABLE IF NOT EXISTS `has_favorite_cocktail` (
  `id_user` int(10) unsigned NOT NULL,
  `id_cocktail` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_user`,`id_cocktail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `has_ingredient`
--

CREATE TABLE IF NOT EXISTS `has_ingredient` (
  `id_cocktail` smallint(5) unsigned NOT NULL,
  `id_ingredient` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_cocktail`,`id_ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `has_low_categ`
--

CREATE TABLE IF NOT EXISTS `has_low_categ` (
  `id_ingredient` smallint(5) unsigned NOT NULL,
  `id_low_categ` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_ingredient`,`id_low_categ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `has_super_categ`
--

CREATE TABLE IF NOT EXISTS `has_super_categ` (
  `id_ingredient` smallint(5) unsigned NOT NULL,
  `id_super_categ` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_ingredient`,`id_super_categ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `id_ingredient` smallint(11) unsigned NOT NULL,
  `ing_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) unsigned NOT NULL,
  `user_name` varchar(35) NOT NULL,
  `user_password` varchar(35) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
