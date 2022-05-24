-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 01 fév. 2019 à 17:45
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stocks`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `Article_code` varchar(10) NOT NULL,
  `Article_designation` varchar(100) NOT NULL,
  `Article_PUHT` float NOT NULL,
  `Article_Qte` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`Article_code`, `Article_designation`, `Article_PUHT`, `Article_Qte`) VALUES
('b001', 'CAISSON PLUS 2 ARMOIRES 2 PORTES', 250.55, 51),
('b002', 'BUREAU MDF /1M40 ', 325.15, 38),
('b003', 'TABLE POUR ORDINATEUR', 175.25, 61),
('b004', 'TABLE DE TRAVAIL 2M40 MDF', 290.15, 15),
('b005', 'BIBLIOTHEQUE 4PRTE', 445, 9),
('b006', 'ETAGERE DE RANGEMENT', 91.65, 18),
('b007', 'CHAISE ROUL', 82.6, 48),
('b008', 'CHAISE FIXE', 75.5, 36),
('b009', 'CHAISE EN BOIS', 115, 12),
('b010', 'Souris Optique', 16.1, 154);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `Client_num` int(11) NOT NULL,
  `Client_civilite` varchar(10) NOT NULL,
  `Client_nom` varchar(50) NOT NULL,
  `Client_prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`Client_num`, `Client_civilite`, `Client_nom`, `Client_prenom`) VALUES
(1, 'Madame', 'Galls', 'Charline'),
(3, 'Monsieur', 'Doeuf', 'John');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `Com_num` int(11) NOT NULL,
  `Com_client` int(11) NOT NULL,
  `Com_date` varchar(10) NOT NULL,
  `Com_montant` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`Com_num`, `Com_client`, `Com_date`, `Com_montant`) VALUES
(1, 1, '12/03/2019', 1295.95),
(3, 3, '12/03/2019', 246.1);

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

CREATE TABLE `detail` (
  `Detail_num` int(11) NOT NULL,
  `Detail_com` int(11) NOT NULL,
  `Detail_ref` varchar(10) NOT NULL,
  `Detail_qte` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detail`
--

INSERT INTO `detail` (`Detail_num`, `Detail_com`, `Detail_ref`, `Detail_qte`) VALUES
(1, 1, 'b004', 2),
(2, 1, 'b005', 1),
(3, 1, 'b006', 3),
(7, 3, 'b009', 2),
(8, 3, 'b010', 1);

-- --------------------------------------------------------

--
-- Structure de la table `temp`
--

CREATE TABLE `temp` (
  `Temp_ref` varchar(10) NOT NULL,
  `Temp_qte` int(11) NOT NULL,
  `Temp_designation` varchar(100) NOT NULL,
  `Temp_PUHT` float NOT NULL,
  `Temp_THT` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Article_code`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`Client_num`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`Com_num`),
  ADD KEY `Com_client` (`Com_client`);

--
-- Index pour la table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`Detail_num`),
  ADD KEY `Detail_ref` (`Detail_ref`),
  ADD KEY `detail_ibfk_2` (`Detail_com`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `Client_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `Com_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `detail`
--
ALTER TABLE `detail`
  MODIFY `Detail_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`Com_client`) REFERENCES `clients` (`Client_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`Detail_com`) REFERENCES `commandes` (`Com_num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`Detail_ref`) REFERENCES `articles` (`Article_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
