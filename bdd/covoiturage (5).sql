-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 02 fév. 2024 à 21:23
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(250) DEFAULT NULL,
  `prenom` varchar(250) DEFAULT NULL,
  `adresse_client` varchar(255) DEFAULT NULL,
  `mdp_client` varchar(255) DEFAULT NULL,
  `numero_tel` int(250) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse_client`, `mdp_client`, `numero_tel`, `is_verified`, `verification_token`) VALUES
(6, 'Azzedine', 'Chalabi', 'agent@admin.com', '$2y$10$UqvQIVCzW43ob9H4j1EChuH7/wSNh3oSdBA0bohTJbTPUxcdsOOPy', 556096567, 1, '162527'),
(10, 'akrour', 'rania', 'akrour.raniaa@gmail.com', '$2y$10$zlZO.PFbMMyrRKELcxoDrebL0gT8.sIgrczrwKb/6AwRWa4hmJoXC', 562032744, 1, '294364');

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

CREATE TABLE `conducteur` (
  `id_conducteur` int(11) NOT NULL,
  `nom` varchar(250) DEFAULT NULL,
  `prenom` varchar(250) DEFAULT NULL,
  `adresse_conducteur` varchar(255) DEFAULT NULL,
  `mdp_conducteur` varchar(255) DEFAULT NULL,
  `numero_tel` int(250) DEFAULT NULL,
  `matricule_voiture` varchar(20) DEFAULT NULL,
  `nb_places` int(11) DEFAULT NULL,
  `voiture` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`id_conducteur`, `nom`, `prenom`, `adresse_conducteur`, `mdp_conducteur`, `numero_tel`, `matricule_voiture`, `nb_places`, `voiture`, `is_verified`, `verification_token`) VALUES
(4, 'Azzedine', 'Chalabi', 'bouguerrifatmazohra@gmail.com', '123', 556096512, 'A123', NULL, NULL, 1, '716317'),
(5, 'Ryz', 'Devlopper', 'yousrarebai886@gmail.com', '$2y$10$FQAUDJWHMbQwaOOpLVfwruWlKK8n0X0ddIPkzkyOOdgUpgcXVELoO', 554092451, '2000', NULL, NULL, 1, NULL),
(6, 'akrour', 'rania', 'akrour.raniaa@gmail.com', '$2y$10$kH7O88iwQHMqPkN7izZk0uk23Cu/mwgDazLMGfS5QI5vTvjKmnjbS', 562032733, '2020200', NULL, 'peugeot', 1, '750208');

-- --------------------------------------------------------

--
-- Structure de la table `paramètres`
--

CREATE TABLE `paramètres` (
  `id_parametre` int(11) NOT NULL,
  `nombre_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paramètres`
--

INSERT INTO `paramètres` (`id_parametre`, `nombre_max`) VALUES
(1, 17);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_trajet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_client`, `id_trajet`) VALUES
(4, 10, 69),
(5, 10, 70);

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `id_conducteur` int(11) DEFAULT NULL,
  `lieu_depart` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `date_trajet` date DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `nb_places_dispo` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `id_conducteur`, `lieu_depart`, `destination`, `date_trajet`, `heure_depart`, `nb_places_dispo`, `prix`) VALUES
(69, 5, 'Alger', 'Tlemcen', '2024-03-01', '09:30:00', 3, '8000.00'),
(70, 4, 'Oran', 'Setif', '2024-03-05', '11:00:00', 1, '4000.00'),
(71, 4, 'Constantine', 'Tizi Ouzou', '2024-03-10', '14:30:00', 3, '6000.00'),
(72, 4, 'Annaba', 'Bejaia', '2024-03-15', '16:00:00', 4, '7000.00'),
(73, 5, 'meftah', 'reghaia', '2024-03-20', '18:30:00', 2, '4500.00'),
(74, 5, 'rouiba', 'ain taya', '2024-03-25', '20:00:00', 3, '5500.00'),
(75, 6, 'alger ', 'Dergana', '2024-01-17', '00:19:00', 5, '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `trajet_propose`
--

CREATE TABLE `trajet_propose` (
  `id_trajet_propose` int(11) NOT NULL,
  `depart` varchar(255) DEFAULT NULL,
  `arrivee` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajet_propose`
--

INSERT INTO `trajet_propose` (`id_trajet_propose`, `depart`, `arrivee`) VALUES
(5, 'Alger', 'Oran'),
(6, 'Constantine', 'Annaba'),
(7, 'Tizi Ouzou', 'Bejaia');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `unique_numero_tel_constraint` (`numero_tel`),
  ADD UNIQUE KEY `unique_adresse_client_constraint` (`adresse_client`);

--
-- Index pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id_conducteur`),
  ADD UNIQUE KEY `unique_numero_tel_constraint` (`numero_tel`),
  ADD UNIQUE KEY `unique_adresse_constraint` (`adresse_conducteur`),
  ADD UNIQUE KEY `unique_matricule_voiture` (`matricule_voiture`);

--
-- Index pour la table `paramètres`
--
ALTER TABLE `paramètres`
  ADD PRIMARY KEY (`id_parametre`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `reservation_ibfk_1` (`id_client`),
  ADD KEY `reservation_ibfk_2` (`id_trajet`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `fk_id_conducteur` (`id_conducteur`);

--
-- Index pour la table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  ADD PRIMARY KEY (`id_trajet_propose`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id_conducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  MODIFY `id_trajet_propose` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_id_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `fk_id_conducteur` FOREIGN KEY (`id_conducteur`) REFERENCES `conducteur` (`id_conducteur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
