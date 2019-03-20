-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 20 mars 2019 à 20:02
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat_zone`
--

DROP TABLE IF EXISTS `chat_zone`;
CREATE TABLE IF NOT EXISTS `chat_zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `room` enum('WIM','APL','ASR','SGBD','PPP','EGOD','EC','ENG','ALG','GRAPH') NOT NULL,
  `message` text NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat_zone`
--

INSERT INTO `chat_zone` (`id`, `pseudo`, `room`, `message`, `date_creation`) VALUES
(9, 'Sevla', 'WIM', 'hello', '2019-03-20 20:37:49'),
(10, 'Sevla', 'WIM', 'hey', '2019-03-20 20:38:19'),
(11, 'Sevla', 'WIM', 'wow', '2019-03-20 20:40:56'),
(12, 'Sevla', 'WIM', 'dddd', '2019-03-20 20:41:00'),
(13, 'Keyser', 'WIM', 'salut!', '2019-03-20 20:41:42'),
(14, 'Keyser', 'WIM', 'ca va?', '2019-03-20 20:41:47'),
(15, 'Keyser', 'WIM', 'dsl pour l\'orthographe', '2019-03-20 20:41:57'),
(16, 'Sevla', 'WIM', 'pas grave', '2019-03-20 20:42:09'),
(17, 'Keyser', 'WIM', '123 soleil\r\nlll\r\n44', '2019-03-20 20:43:26'),
(18, 'Keyser', 'WIM', 'ddd', '2019-03-20 20:43:35'),
(19, 'Keyser', 'WIM', '545', '2019-03-20 20:43:49'),
(20, 'Keyser', 'WIM', '44', '2019-03-20 20:44:46'),
(21, 'Keyser', 'WIM', 'salutt', '2019-03-20 20:45:14'),
(22, 'Sevla', 'WIM', 'dd', '2019-03-20 20:45:22'),
(23, 'Sevla', 'WIM', 'ff', '2019-03-20 20:49:40'),
(24, 'Sevla', 'WIM', 'd', '2019-03-20 20:50:19'),
(25, 'Sevla', 'WIM', 'dd', '2019-03-20 20:50:59'),
(26, 'Sevla', 'WIM', 'helo', '2019-03-20 20:53:33'),
(27, 'Sevla', 'WIM', 'd', '2019-03-20 20:54:13'),
(28, 'Sevla', 'WIM', 's', '2019-03-20 20:54:47'),
(29, 'Keyser', 'WIM', 'wowo ca marche', '2019-03-20 20:55:39'),
(30, 'Sevla', 'SGBD', '1st', '2019-03-20 20:59:31'),
(31, 'Keyser', 'APL', 'd', '2019-03-20 21:01:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
