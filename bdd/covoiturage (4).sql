-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 30 jan. 2024 à 16:40
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

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
(1, 'Azzedine', 'Chalabi', 'agent@admin.com', '$2y$10$UqvQIVCzW43ob9H4j1EChuH7/wSNh3oSdBA0bohTJbTPUxcdsOOPy', 556096567, 1, '162527'),
(2, 'Azzedine', 'Chalabi', 'agent7@admin.com', '$2y$10$mKMdR5tTaSyONbXPZCwAhOTTsMAX9Gsr2VlW1NLHXdxL5t39jOJ0i', 556096543, 0, '188208'),
(3, 'Azzedine', 'Chalabi', 'agent67@admin.com', '$2y$10$u6rjUkoGX97VzSa1hx5eWO1ZgIrqkV.GIMjRyVe53fcYLnDGFEBXG', 556126567, 0, '538943'),
(4, 'akrour', 'rania', 'akrour.raniaa@gmail.com', '$2y$10$e9GCCzZBqXaIHBKkvz.sLuHB5I3Mt2XjEBzrsTkQ84aBrW7IzGLK.', 562032715, 0, '580903'),
(5, 'ryz', 'devlopper', 'yousrarebai886@gmail.com', '$2y$10$XNPYRMHUacDy.xunQQCgOeW07e1w7WvJbYCfSxC.th0Vn3fQ..zFi', 554092451, 1, NULL);

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
(2, 'Azzedine', 'Chalabi', 'bouguerrifatmazohra@gmail.com', '123', 556096512, 'A123', NULL, 'Chalabi Azzedine', 1, '716317'),
(3, 'ryz', 'devlopper', 'yousrarebai886@gmail.com', '$2y$10$FQAUDJWHMbQwaOOpLVfwruWlKK8n0X0ddIPkzkyOOdgUpgcXVELoO', 554092451, '2000', NULL, 'devlopper ryz', 1, NULL);

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
(42, NULL, 'alger ', 'oran', '2023-12-08', '23:31:00', 2, '0.00'),
(43, 2, 'City A', 'City B', '2023-01-15', '23:34:00', 2, '0.00'),
(44, 3, 'ruiba', 'alger', '2024-01-29', '12:00:00', 19, '300000.00'),
(47, 3, 'REGHAIA', 'bouz', '2024-01-10', '12:59:00', 19, '300.00');

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
(1, 'alger', 'rouina'),
(2, 'aa', 'ss'),
(3, 'aa', 'ss'),
(4, 'aa', 'ss');

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
  ADD PRIMARY KEY (`id_reservation`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`);

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
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id_conducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  MODIFY `id_trajet_propose` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
