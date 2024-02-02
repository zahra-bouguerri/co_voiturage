-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 10:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covoiturage`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `supprimer_trajets_hourly_proc` ()   BEGIN
    DECLARE currentDate DATE;
    DECLARE currentTime TIME;
    DECLARE trajetId INT;
    DECLARE clientId INT;

    SET currentDate = CURDATE();
    SET currentTime = CURTIME();

    -- 1. Commencer une transaction
    START TRANSACTION;

    -- 2. Désactiver temporairement la contrainte de clé étrangère
    SET foreign_key_checks = 0;

    -- 3. Supprimer les trajets et insérer les données dans historique_trajet
    WHILE (SELECT COUNT(*) FROM trajet WHERE date_trajet < currentDate OR (date_trajet = currentDate AND heure_depart < ADDTIME(currentTime, '00:10:00'))) > 0 DO
        -- Sélectionner et supprimer un trajet
        SELECT id_trajet INTO trajetId FROM trajet WHERE date_trajet < currentDate OR (date_trajet = currentDate AND heure_depart < ADDTIME(currentTime, '00:10:00')) LIMIT 1;

        -- Pour chaque client associé à la réservation, insérer les données dans historique_trajet
        INSERT INTO historique_trajet (id_conducteur, id_client, lieu_depart, destination, date_trajet, heure_depart, nb_places_dispo, prix)
        SELECT t.id_conducteur, r.id_client, t.lieu_depart, t.destination, t.date_trajet, t.heure_depart, t.nb_places_dispo, t.prix
        FROM trajet t
        JOIN reservation r ON t.id_trajet = r.id_trajet
        WHERE t.id_trajet = trajetId;

        -- Supprimer les réservations associées au trajet
        DELETE FROM reservation WHERE id_trajet = trajetId;

        -- Supprimer le trajet
        DELETE FROM trajet WHERE id_trajet = trajetId;
    END WHILE;

    -- 4. Réactiver la contrainte de clé étrangère
    SET foreign_key_checks = 1;

    -- 5. Valider la transaction
    COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `client`
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
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `adresse_client`, `mdp_client`, `numero_tel`, `is_verified`, `verification_token`) VALUES
(1, 'Azzedine', 'Chalabi', 'agent@admin.com', '$2y$10$UqvQIVCzW43ob9H4j1EChuH7/wSNh3oSdBA0bohTJbTPUxcdsOOPy', 556096567, 1, '162527'),
(2, 'Azzedine', 'Chalabi', 'agent7@admin.com', '$2y$10$mKMdR5tTaSyONbXPZCwAhOTTsMAX9Gsr2VlW1NLHXdxL5t39jOJ0i', 556096543, 0, '188208'),
(3, 'Azzedine', 'Chalabi', 'agent67@admin.com', '$2y$10$u6rjUkoGX97VzSa1hx5eWO1ZgIrqkV.GIMjRyVe53fcYLnDGFEBXG', 556126567, 0, '538943'),
(4, 'akrour', 'rania', 'akrour.raniaa@gmail.com', '$2y$10$e9GCCzZBqXaIHBKkvz.sLuHB5I3Mt2XjEBzrsTkQ84aBrW7IzGLK.', 562032715, 0, '580903'),
(5, 'ryz', 'devlopper', 'yousrarebai886@gmail.com', '$2y$10$XNPYRMHUacDy.xunQQCgOeW07e1w7WvJbYCfSxC.th0Vn3fQ..zFi', 554092451, 1, NULL),
(6, 'bouguerri', 'zahra', 'bouguerrifatmazohra@gmail.com', '$2y$10$biJoi4.IjNLAA36muLnkpOb9bu7bDfjsphL3dO8/m0DfuggOY1mR.', 784126187, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conducteur`
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
-- Dumping data for table `conducteur`
--

INSERT INTO `conducteur` (`id_conducteur`, `nom`, `prenom`, `adresse_conducteur`, `mdp_conducteur`, `numero_tel`, `matricule_voiture`, `nb_places`, `voiture`, `is_verified`, `verification_token`) VALUES
(3, 'ryz', 'devlopper', 'yousrarebai886@gmail.com', '$2y$10$FQAUDJWHMbQwaOOpLVfwruWlKK8n0X0ddIPkzkyOOdgUpgcXVELoO', 554092451, '2000', NULL, 'devlopper ryz', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `historique_trajet`
--

CREATE TABLE `historique_trajet` (
  `id_historique_trajet` int(11) NOT NULL,
  `id_conducteur` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `lieu_depart` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `date_trajet` date DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `nb_places_dispo` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historique_trajet`
--

INSERT INTO `historique_trajet` (`id_historique_trajet`, `id_conducteur`, `id_client`, `lieu_depart`, `destination`, `date_trajet`, `heure_depart`, `nb_places_dispo`, `prix`) VALUES
(1, 2, 2, 'Ville A', 'Ville B', '2024-01-01', '08:00:00', 3, '50.00'),
(2, 2, 3, 'Ville A', 'Ville B', '2024-01-01', '08:00:00', 3, '50.00'),
(3, 2, 1, 'Ville A', 'Ville B', '2024-01-01', '08:00:00', 3, '50.00'),
(4, 2, 2, 'Ville C', 'Ville D', '2024-01-02', '09:30:00', 2, '40.00'),
(5, 2, 2, 'Ville A', 'Ville B', '2024-01-01', '08:00:00', 3, '50.00'),
(6, 2, 3, 'Ville A', 'Ville B', '2024-01-01', '08:00:00', 3, '50.00'),
(8, 2, 2, 'Ville C', 'Ville D', '2024-01-30', '21:00:00', 2, '40.00'),
(9, 3, 3, 'Ville E', 'Ville F', '2024-01-30', '22:10:00', 4, '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `paramètres`
--

CREATE TABLE `paramètres` (
  `id_parametre` int(11) NOT NULL,
  `nombre_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paramètres`
--

INSERT INTO `paramètres` (`id_parametre`, `nombre_max`) VALUES
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_trajet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_client`, `id_trajet`) VALUES
(105, 3, 49),
(147, 1, 74),
(148, 2, 70),
(149, 2, 71),
(150, 1, 75),
(151, 1, 76),
(152, 1, 72),
(153, 1, 75);

-- --------------------------------------------------------

--
-- Table structure for table `trajet`
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
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id_trajet`, `id_conducteur`, `lieu_depart`, `destination`, `date_trajet`, `heure_depart`, `nb_places_dispo`, `prix`) VALUES
(49, 3, 'hoch torchi', 'reghaia', '2024-02-20', '20:27:00', 9, '40.00'),
(66, 3, 'Alger Centre', 'Kouba', '2024-02-10', '08:00:00', 3, '3000.00'),
(67, 3, 'Bab El Oued', 'Hydra', '2024-02-11', '09:30:00', 4, '2500.00'),
(68, 3, 'Hussein Dey', 'Bir Mourad Rais', '2024-02-12', '12:00:00', 2, '2000.00'),
(69, 3, 'Birkhadem', 'Bab Ezzouar', '2024-02-13', '14:45:00', 5, '3500.00'),
(70, 3, 'Bab El Oued', 'El Madania', '2024-02-14', '16:30:00', 3, '2800.00'),
(71, 3, 'Alger', 'Tlemcen', '2024-03-01', '09:30:00', 5, '8000.00'),
(72, 3, 'Oran', 'Setif', '2024-03-05', '11:00:00', 2, '4000.00'),
(73, 3, 'Constantine', 'Tizi Ouzou', '2024-03-10', '14:30:00', 3, '6000.00'),
(74, 3, 'Annaba', 'Alger', '2024-03-15', '16:00:00', 4, '7000.00'),
(75, 3, 'rouiba', 'reghaia', '2024-03-20', '18:30:00', 2, '4500.00'),
(76, 3, 'meftah', 'ain taya', '2024-03-25', '20:00:00', 3, '5500.00');

-- --------------------------------------------------------

--
-- Table structure for table `trajet_propose`
--

CREATE TABLE `trajet_propose` (
  `id_trajet_propose` int(11) NOT NULL,
  `depart` varchar(255) DEFAULT NULL,
  `arrivee` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trajet_propose`
--

INSERT INTO `trajet_propose` (`id_trajet_propose`, `depart`, `arrivee`) VALUES
(1, 'alger', 'rouina'),
(2, 'aa', 'ss'),
(3, 'aa', 'ss'),
(4, 'aa', 'ss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `unique_numero_tel_constraint` (`numero_tel`),
  ADD UNIQUE KEY `unique_adresse_client_constraint` (`adresse_client`);

--
-- Indexes for table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id_conducteur`),
  ADD UNIQUE KEY `unique_numero_tel_constraint` (`numero_tel`),
  ADD UNIQUE KEY `unique_adresse_constraint` (`adresse_conducteur`),
  ADD UNIQUE KEY `unique_matricule_voiture` (`matricule_voiture`);

--
-- Indexes for table `historique_trajet`
--
ALTER TABLE `historique_trajet`
  ADD PRIMARY KEY (`id_historique_trajet`);

--
-- Indexes for table `paramètres`
--
ALTER TABLE `paramètres`
  ADD PRIMARY KEY (`id_parametre`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `reservation_ibfk_1` (`id_client`),
  ADD KEY `reservation_ibfk_2` (`id_trajet`);

--
-- Indexes for table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `fk_id_conducteur` (`id_conducteur`);

--
-- Indexes for table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  ADD PRIMARY KEY (`id_trajet_propose`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id_conducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `historique_trajet`
--
ALTER TABLE `historique_trajet`
  MODIFY `id_historique_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  MODIFY `id_trajet_propose` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_id_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`);

--
-- Constraints for table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `fk_id_conducteur` FOREIGN KEY (`id_conducteur`) REFERENCES `conducteur` (`id_conducteur`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `supprimer_trajets_hourly` ON SCHEDULE EVERY 1 HOUR STARTS '2024-01-30 21:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    CALL supprimer_trajets_hourly_proc;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
