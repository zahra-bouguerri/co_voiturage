-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 08:43 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `adresse_client` varchar(255) DEFAULT NULL,
  `mdp_client` varchar(255) DEFAULT NULL,
  `numero_tel` varchar(20) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `verification_token` varchar(250) DEFAULT NULL,
  `is_verified` tinyint(50) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `adresse_client`, `mdp_client`, `numero_tel`, `nom`, `prenom`, `verification_token`, `is_verified`) VALUES
(1, 'agent@admin.com', '$2y$10$B/pVYbpu1kK7M6d/26/mw.kePdWNoU4jX.gAzX0mdlsIh3l/R0oH.', '0556096567', 'Azzedine', 'Chalabi', '619921', 0),
(4, 'bouguerrifatmazohra@gmail.com', '$2y$10$iFeatPuXJ8uTu/nqNVIAruPHKKvKE.Pb2JttCnruK2W.TO4kCWNrW', '0556096561', 'Azzedine', 'Chalabi', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conducteur`
--

CREATE TABLE `conducteur` (
  `id_conducteur` int(11) NOT NULL,
  `adresse_conducteur` varchar(255) DEFAULT NULL,
  `mdp_conducteur` varchar(255) DEFAULT NULL,
  `numero_tel` int(250) DEFAULT NULL,
  `matricule_voiture` varchar(250) DEFAULT NULL,
  `nb_places` int(11) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `voiture` varchar(50) DEFAULT NULL,
  `verification_token` varchar(250) DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conducteur`
--

INSERT INTO `conducteur` (`id_conducteur`, `adresse_conducteur`, `mdp_conducteur`, `numero_tel`, `matricule_voiture`, `nb_places`, `nom`, `prenom`, `voiture`, `verification_token`, `is_verified`) VALUES
(1, 'agent5@admin.com', '$2y$10$71yeWjSlsObi/ghOmqQgHuRf.5vEeJ0NunYVRW9dR/nTVDa39pYsi', 556096567, '202031050514', NULL, 'Azzedine', 'Chalabi', 'Chalabi Azzedine', '426370', 0),
(2, 'bouguerrifatmazohra@gmail.com', '$2y$10$cx8lFiwbkaRQ1Q2fv9.iLe9mAPROtZotdUGQE.JxrcNe9oxlO19Ze', 556096561, 'azer', NULL, 'Azzedine', 'Chalabi', 'Chalabi Azzedine', NULL, 1);

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
-- Triggers `reservation`
--
DELIMITER $$
CREATE TRIGGER `decrement_nb_places` AFTER INSERT ON `reservation` FOR EACH ROW BEGIN
    UPDATE Trajet
    SET nb_places_dispo = nb_places_dispo - 1
    WHERE id_trajet = NEW.id_trajet AND nb_places_dispo > 0;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `lieu_depart` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `date_trajet` date DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `id_conducteur` int(11) DEFAULT NULL,
  `nb_places_dispo` int(11) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_trajet` (`id_trajet`);

--
-- Indexes for table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `id_conducteur` (`id_conducteur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id_conducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`);

--
-- Constraints for table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`id_conducteur`) REFERENCES `conducteur` (`id_conducteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
