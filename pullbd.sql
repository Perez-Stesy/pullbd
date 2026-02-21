-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 fév. 2026 à 23:34
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pullbd`
--

-- --------------------------------------------------------

--
-- Structure de la table `chauffeurs`
--

DROP TABLE IF EXISTS `chauffeurs`;
CREATE TABLE IF NOT EXISTS `chauffeurs` (
  `chauffeur_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prenoms` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  PRIMARY KEY (`chauffeur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chauffeurs`
--

INSERT INTO `chauffeurs` (`chauffeur_id`, `nom`, `prenoms`, `telephone`, `sexe`, `disponible`) VALUES
(1, 'Toni', 'Boni', '+2290195658956', 'Masculin', 1),
(2, 'Jean', 'Claude', '+2290165984523', 'Masculin', 0);

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `cource_id` int NOT NULL AUTO_INCREMENT,
  `point_depart` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `point_arrivee` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_heure` datetime NOT NULL,
  `chauffeur_id` int DEFAULT NULL,
  `statut` enum('en attentte','en cours','terminée') COLLATE utf8mb4_general_ci NOT NULL,
  `image_vehicule` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cource_id`),
  KEY `fk1` (`chauffeur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`cource_id`, `point_depart`, `point_arrivee`, `date_heure`, `chauffeur_id`, `statut`, `image_vehicule`) VALUES
(1, 'Porto-novo', 'Cotonou', '2026-02-20 17:04:25', NULL, 'en attentte', ''),
(2, 'Cotonou ', 'Porto-novo ', '2026-02-20 17:04:25', NULL, 'en attentte', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`chauffeur_id`) REFERENCES `chauffeurs` (`chauffeur_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
