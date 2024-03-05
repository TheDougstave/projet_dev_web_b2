-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 05 mars 2024 à 14:48
-- Version du serveur : 8.1.0
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Base de données : `b2-paris`
--

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
CREATE TABLE IF NOT EXISTS `intervention` (
  `IDI` int NOT NULL AUTO_INCREMENT,
  `DATE` date NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `DETAIL` varchar(1023) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `STATUT` int NOT NULL,
  `ADRESSE` varchar(255) NOT NULL,
  `URGENCE` int NOT NULL,
  PRIMARY KEY (`IDI`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`IDI`, `DATE`, `CREATED_AT`, `DETAIL`, `NOM`, `STATUT`, `ADRESSE`, `URGENCE`) VALUES
(1, '2024-03-05', '2024-03-05 13:42:06', 'Changement du boîtier éléctrique de dernière génération. Boîtier à récupérer.', 'Changement boîtier', 1, '10bis rue des fleurs de lys', 1),
(2, '2024-03-05', '2024-03-05 13:42:06', 'Vérifier si il n y a pas eu de probleme énergie.', 'Check-up', 1, '1 rue de pin ', 1),
(3, '2024-03-05', '2024-03-05 13:42:06', 'Appel client à cause d un probleme boîtier: attendre explication client', 'problème boîtier', 1, '12 rue des lions', 1);

-- --------------------------------------------------------

--
-- Structure de la table `intervient`
--

DROP TABLE IF EXISTS `intervient`;
CREATE TABLE IF NOT EXISTS `intervient` (
  `IDI` int NOT NULL,
  `IDU` int NOT NULL,
  KEY `INTERVENTION_INTERVIENT_FK` (`IDI`),
  KEY `INTERVIENT_USER_FK` (`IDU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `intervient`
--

INSERT INTO `intervient` (`IDI`, `IDU`) VALUES
(1, 4),
(1, 5),
(1, 1),
(2, 4),
(2, 2),
(3, 5),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `NUM` int NOT NULL,
  `AFFECTATION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`NUM`, `AFFECTATION`) VALUES
(1, 'Client'),
(2, 'Intervenant'),
(3, 'Standardiste'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

DROP TABLE IF EXISTS `statut`;
CREATE TABLE IF NOT EXISTS `statut` (
  `NUM` int NOT NULL,
  `ETAT` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`NUM`, `ETAT`) VALUES
(1, 'Non-commencé'),
(2, 'En cours'),
(3, 'Terminé');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `IDU` int NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` int NOT NULL,
  `CREATED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `MODIFIED_AT` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDU`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`IDU`, `EMAIL`, `PASSWORD`, `ROLE`, `CREATED_AT`, `MODIFIED_AT`) VALUES
(1, 'BB@theShire.me', '$2y$10$d6TzdAOM3Bzg05xGdw2uQuu.GE9jD30FADVE4KLfFABlQOlwat9Hm', 1, '2024-03-05 13:49:53', '2024-03-05 14:47:48'),
(2, 'theG@MiddleEarth.me', '$2y$10$d6TzdAOM3Bzg05xGdw2uQuu.GE9jD30FADVE4KLfFABlQOlwat9Hm', 1, '2024-03-05 13:49:53', '2024-03-05 14:47:55'),
(3, 'froBO@theShire.me', '$2y$10$d6TzdAOM3Bzg05xGdw2uQuu.GE9jD30FADVE4KLfFABlQOlwat9Hm', 1, '2024-03-05 13:49:53', '2024-03-05 14:47:59'),
(4, 'Legolas@elf.me', '$2y$10$d6TzdAOM3Bzg05xGdw2uQuu.GE9jD30FADVE4KLfFABlQOlwat9Hm', 2, '2024-03-05 13:53:22', '2024-03-05 14:48:05'),
(5, 'TheGREATGimli@mm.me', '$2y$10$d6TzdAOM3Bzg05xGdw2uQuu.GE9jD30FADVE4KLfFABlQOlwat9Hm', 2, '2024-03-05 13:53:22', '2024-03-05 14:48:11');
COMMIT;
