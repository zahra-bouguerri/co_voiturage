-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 07:19 AM
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
  `numero_tel` int(250) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conducteur`
--

CREATE TABLE `conducteur` (
  `id_conducteur` int(11) NOT NULL,
  `adresse_conducteur` varchar(255) DEFAULT NULL,
  `mdp_conducteur` varchar(255) DEFAULT NULL,
  `numero_tel` int(250) DEFAULT NULL,
  `matricule_voiture` varchar(20) DEFAULT NULL,
  `nb_places` int(11) DEFAULT NULL,
  `voiture` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_trajet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'alger', 'rouina');

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
-- Indexes for table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  ADD PRIMARY KEY (`id_trajet_propose`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id_conducteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trajet_propose`
--
ALTER TABLE `trajet_propose`
  MODIFY `id_trajet_propose` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
