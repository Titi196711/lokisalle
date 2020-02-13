-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 02 fév. 2020 à 20:02
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `membre_id` int(3) UNSIGNED NOT NULL,
  `salle_id` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) UNSIGNED NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `membre_id` int(3) UNSIGNED NOT NULL,
  `produit_id` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) UNSIGNED NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('Madame','Monsieur') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(22, 'toto', 'f71dbe52628a3f83a77ab494817525c6', 'toto', 'toto', 'toto@toto.fr', 'Monsieur', 0, '2020-01-29 19:55:22'),
(23, 'tata', '49d02d55ad10973b7b9d0dc9eba7fdf0', 'tata', 'tata', 'tata@tata.fr', 'Monsieur', 0, '2020-01-29 19:56:51'),
(29, 'titi', '5d933eef19aee7da192608de61b6c23d', 'VOIZARD', 'Thierry', 'tvoizard@gmail.com', 'Monsieur', 1, '2020-01-30 19:42:11'),
(32, 'mimi', 'dde6ecd6406700aa000b213c843a3091', 'FELBACK', 'Michelle', 'mimi@mimi.fr', 'Madame', 0, '2020-01-30 19:51:22'),
(33, 'bibi', '8115153332991997460b9f236e0da71a', 'bibi', 'bibi', 'bibi@gmail.com', 'Madame', 0, '2020-01-31 18:06:43');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `prixsalle`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `prixsalle` (
`id_salle` int(3) unsigned
,`titre` varchar(200)
,`capacite` int(3)
,`categorie` enum('Réunion','Bureau','Formation')
,`description` text
,`etat` enum('Libre','Réservation')
,`prix` int(3)
,`date_arrivee` datetime
,`date_depart` datetime
);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) UNSIGNED NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('Libre','Réservation') NOT NULL,
  `salle_id` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `date_arrivee`, `date_depart`, `prix`, `etat`, `salle_id`) VALUES
(1, '2019-11-22 00:00:00', '2019-11-27 00:00:00', 1200, 'Réservation', 1),
(2, '2020-01-02 00:00:00', '2020-01-10 00:00:00', 800, 'Libre', 2),
(3, '2020-05-04 00:00:00', '2020-05-08 00:00:00', 900, 'Libre', 32),
(4, '2020-05-11 00:00:00', '2020-05-15 00:00:00', 1300, 'Libre', 33),
(5, '2020-04-13 00:00:00', '2020-04-17 00:00:00', 700, 'Libre', 28),
(6, '2020-03-23 00:00:00', '2020-03-27 00:00:00', 750, 'Libre', 10),
(7, '2020-05-18 00:00:00', '2020-05-22 00:00:00', 850, 'Libre', 34),
(8, '2020-03-30 00:00:00', '2020-04-03 00:00:00', 990, 'Libre', 23),
(9, '2020-04-13 00:00:00', '2020-04-17 00:00:00', 1010, 'Libre', 13),
(10, '2020-04-06 00:00:00', '2020-04-10 00:00:00', 650, 'Libre', 25),
(11, '2020-05-04 00:00:00', '2020-05-08 00:00:00', 650, 'Libre', 16),
(12, '2020-04-20 00:00:00', '2020-04-24 00:00:00', 770, 'Libre', 29),
(13, '2020-05-25 00:00:00', '2020-05-29 00:00:00', 1050, 'Libre', 35),
(14, '2020-04-27 00:00:00', '2020-05-01 00:00:00', 450, 'Libre', 31),
(15, '2020-02-17 00:00:00', '2020-02-21 00:00:00', 800, 'Libre', 17),
(16, '2019-11-22 00:00:00', '2019-11-27 00:00:00', 750, 'Réservation', 3),
(17, '2020-02-17 00:00:00', '0000-00-00 00:00:00', 800, 'Libre', 4),
(18, '2020-02-24 00:00:00', '2020-02-28 00:00:00', 750, 'Libre', 5),
(19, '2020-03-02 00:00:00', '2020-03-06 00:00:00', 1010, 'Libre', 6),
(20, '2020-03-09 00:00:00', '2020-03-13 00:00:00', 650, 'Libre', 7),
(21, '2020-03-16 00:00:00', '2020-03-20 00:00:00', 800, 'Libre', 9),
(22, '2020-03-30 00:00:00', '2020-04-03 00:00:00', 990, 'Libre', 11),
(23, '2020-04-06 00:00:00', '2020-04-10 00:00:00', 650, 'Libre', 12),
(24, '2020-04-20 00:00:00', '2020-04-24 00:00:00', 700, 'Libre', 14),
(25, '2020-04-27 00:00:00', '2020-05-01 00:00:00', 770, 'Libre', 15),
(26, '2020-02-24 00:00:00', '2020-02-28 00:00:00', 450, 'Libre', 18),
(27, '2020-03-02 00:00:00', '2020-03-06 00:00:00', 900, 'Libre', 19),
(28, '2020-03-09 00:00:00', '2020-03-13 00:00:00', 1300, 'Libre', 20),
(29, '2020-03-16 00:00:00', '2020-03-20 00:00:00', 850, 'Libre', 21),
(30, '2020-03-23 00:00:00', '2020-03-27 00:00:00', 1050, 'Libre', 22),
(31, '2020-02-17 00:00:00', '2020-02-21 00:00:00', 600, 'Libre', 24),
(32, '2020-02-24 00:00:00', '2020-02-28 00:00:00', 500, 'Libre', 26),
(33, '2020-03-02 00:00:00', '2020-03-06 00:00:00', 800, 'Libre', 27),
(34, '2020-03-09 00:00:00', '2020-03-13 00:00:00', 350, 'Libre', 30),
(35, '2020-03-16 00:00:00', '2020-03-20 00:00:00', 400, 'Libre', 36),
(36, '2020-03-23 00:00:00', '2020-03-27 00:00:00', 550, 'Libre', 37),
(37, '2020-03-30 00:00:00', '2020-04-03 00:00:00', 700, 'Libre', 38),
(38, '2020-04-06 00:00:00', '2020-04-10 00:00:00', 300, 'Libre', 39),
(39, '2020-04-06 00:00:00', '2020-04-10 00:00:00', 900, 'Libre', 40),
(40, '2020-04-13 00:00:00', '2020-04-17 00:00:00', 400, 'Libre', 41),
(41, '2020-04-20 00:00:00', '2020-04-24 00:00:00', 500, 'Libre', 42),
(42, '2020-04-27 00:00:00', '2020-05-01 00:00:00', 400, 'Libre', 43),
(43, '2020-04-27 00:00:00', '2020-05-01 00:00:00', 850, 'Libre', 44),
(44, '2020-05-04 00:00:00', '2020-05-08 00:00:00', 600, 'Libre', 45),
(45, '2020-05-11 00:00:00', '2020-05-16 00:00:00', 700, 'Libre', 8);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) UNSIGNED NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('Réunion','Bureau','Formation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Cézanne', 'Cette salle sera parfaite pour vos réunions d\'entreprise', 'reunion_0001.jpg', 'France', 'Paris', '30 rue Mademoiselle', 75015, 30, 'Réunion'),
(2, 'Mozart', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0002.jpg', 'France', 'Paris', '17 rue Turbigo', 75002, 5, 'Réunion'),
(3, 'Picasso', 'Cette salle vous permettra de travailler au calme', 'bureau_0001.jpg', 'France', 'Paris', '5 porte de saint cloud', 75016, 2, 'Bureau'),
(4, 'Monet', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0003.jpg', 'France', 'Paris', '1 rue de chateaudun', 75009, 8, 'Réunion'),
(5, 'Rossini', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0004.jpg', 'France', 'Paris', '16 rue Montmartre', 75018, 16, 'Réunion'),
(6, 'Vinci', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0005.jpg', 'France', 'Paris', '12 rue du Ranelagh', 75016, 16, 'Réunion'),
(7, 'Wagner', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0002.jpg', 'France', 'Paris', '14 rue du Ranelagh', 75016, 5, 'Bureau'),
(8, 'Verdi', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0003.jpg', 'France', 'Paris', '2 rue de Belleville', 75020, 12, 'Bureau'),
(9, 'Bach', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0004.jpg', 'France', 'Paris', '3 rue montparnasse', 75015, 6, 'Bureau'),
(10, 'Vivaldi', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0015.jpg', 'France', 'Paris', '25 place d\'italie', 75013, 7, 'Bureau'),
(11, 'Ravel', 'La salle parfaite pour vos formations', 'formation_0001.jpg', 'France', 'Paris', '32 rue Manceau', 75017, 25, 'Formation'),
(12, 'Bizet', 'La salle parfaite pour vos formations', 'formation_0002.jpg', 'France', 'Paris', '7 rue des invalides', 75007, 30, 'Formation'),
(13, 'Stravinski', 'La salle parfaite pour vos formations', 'formation_0003.jpg', 'France', 'Paris', '118 rue saint lazare', 75008, 30, 'Formation'),
(14, 'Puccini', 'La salle parfaite pour vos formations', 'formation_0004.jpg', 'France', 'Paris', '2 place nation', 75011, 40, 'Formation'),
(15, 'Bomtempo', 'La salle parfaite pour vos formations', 'formation_0005.jpg', 'France', 'Paris', '5 rue sorbonne', 75005, 40, 'Formation'),
(16, 'Champagne', 'Cette salle sera parfaite pour vos réunions d\'entreprise', 'reunion_0006.jpg', 'France', 'Lyon', '23 Rue Royale', 69001, 30, 'Réunion'),
(17, 'Groseille', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0007.jpg', 'France', 'Lyon', '102-104 Grande Rue de la Guillotière,', 69007, 5, 'Réunion'),
(18, 'Dragée', 'Cette salle vous permettra de travailler au calme', 'bureau_0006.jpg', 'France', 'Lyon', '1 Quai Claude Bernard', 69007, 2, 'Bureau'),
(19, 'Sable', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0008.jpg', 'France', 'Paris', '34 Rue Chevreul', 69007, 8, 'Réunion'),
(20, 'Saumon', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0009.jpg', 'France', 'Lyon', '16 Rue Hippolyte Flandrin', 69001, 16, 'Réunion'),
(21, 'Canard', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0010.jpg', 'France', 'Lyon', '21 Rue Pasteur', 69007, 16, 'Réunion'),
(22, 'Beure Clair', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0007.jpg', 'France', 'Lyon', '38 Rue de l’Arbre Sec', 69001, 5, 'Bureau'),
(23, 'Chartreuse', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0008.jpg', 'France', 'Lyon', '23 Rue de Sèze', 69006, 12, 'Bureau'),
(24, 'Bleuet', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0009.jpg', 'France', 'Lyon', '30 Cours de Verdun Perrache', 69002, 6, 'Bureau'),
(25, 'Pastel', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0010.jpg', 'France', 'Lyon', '2 Rue des Forces,', 69002, 7, 'Bureau'),
(26, 'Capucine', 'La salle parfaite pour vos formations', 'formation_0006.jpg', 'France', 'Lyon', '156 Rue de Créqui', 69003, 25, 'Formation'),
(27, 'Anthracite', 'La salle parfaite pour vos formations', 'formation_0007.jpg', 'France', 'Lyon', '36 Rue Tramassac', 69002, 30, 'Formation'),
(28, 'Bourgogne', 'La salle parfaite pour vos formations', 'formation_0008.jpg', 'France', 'Lyon', '8 Rue de Cuire', 69004, 30, 'Formation'),
(29, 'Fraise', 'La salle parfaite pour vos formations', 'formation_0016.jpg', 'France', 'Lyon', '9 Rue Major Martin', 69001, 40, 'Formation'),
(30, 'Chamois', 'La salle parfaite pour vos formations', 'formation_0009.jpg', 'France', 'Lyon', '122 Rue Montesquieu', 69007, 40, 'Formation'),
(31, 'Aiglefin', 'Cette salle sera parfaite pour vos réunions d\'entreprise', 'reunion_0011.jpg', 'France', 'Marseille', '1 Avenue Saint-Jean', 13001, 30, 'Réunion'),
(32, 'Anchois', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0012.jpg', 'France', 'Marseille', '3 rue Goudart', 13005, 5, 'Réunion'),
(33, 'Barracuda', 'Cette salle vous permettra de travailler au calme', 'bureau_0011.jpg', 'France', 'Marseille', '8 Rue Euthymenes', 13001, 2, 'Bureau'),
(34, 'Brochet', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0013.jpg', 'France', 'Marseille', '100 boulevard Baille', 13005, 8, 'Réunion'),
(35, 'Cabillaud', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0014.jpg', 'France', 'Paris', '16 boulevard Vauban', 13016, 16, 'Réunion'),
(36, 'Colib', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'reunion_0015.jpg', 'France', 'Marseille', '27 Grand Rue', 13002, 16, 'Réunion'),
(37, 'Carrelet', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0012.jpg', 'France', 'Marseille', '36 rue Sainte-Françoise', 13016, 5, 'Bureau'),
(38, 'Dorade', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0013.jpg', 'France', 'Marseille', '126 rue Sainte', 13007, 12, 'Bureau'),
(39, 'Espadon', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0014.jpg', 'France', 'Marseille', '17 rue de l’Évêché', 13002, 6, 'Bureau'),
(40, 'Esturgeon', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'bureau_0005.jpg', 'France', 'Marseille', '24 Cours Julien', 13006, 7, 'Bureau'),
(41, 'Gallinette', 'La salle parfaite pour vos formations', 'formation_0011.jpg', 'France', 'Marseille', '54 rue Lorette', 13002, 25, 'Formation'),
(42, 'Goujon', 'La salle parfaite pour vos formations', 'formation_0012.jpg', 'France', 'Marseille', '6 Rue Méry', 13002, 30, 'Formation'),
(43, 'Huchon', 'La salle parfaite pour vos formations', 'formation_0013.jpg', 'France', 'Marseille', '17 Rue Pastoret', 13006, 30, 'Formation'),
(44, 'Lompe', 'La salle parfaite pour vos formations', 'formation_0014.jpg', 'France', 'Marseille', '231 Avenue Pierre Mendès France', 13008, 40, 'Formation'),
(45, 'Merval', 'La salle parfaite pour vos formations', 'formation_0010.jpg', 'France', 'Marseille', '102 rue Ferrari', 13005, 40, 'Formation');

-- --------------------------------------------------------

--
-- Structure de la vue `prixsalle`
--
DROP TABLE IF EXISTS `prixsalle`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prixsalle`  AS  select `salle`.`id_salle` AS `id_salle`,`salle`.`titre` AS `titre`,`salle`.`capacite` AS `capacite`,`salle`.`categorie` AS `categorie`,`salle`.`description` AS `description`,`produit`.`etat` AS `etat`,`produit`.`prix` AS `prix`,`produit`.`date_arrivee` AS `date_arrivee`,`produit`.`date_depart` AS `date_depart` from (`salle` join `produit` on(`salle`.`id_salle` = `produit`.`salle_id`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `salle_id` (`salle_id`),
  ADD KEY `membre_id` (`membre_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `membre_id` (`membre_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `salle_id` (`salle_id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `avis_ibfk_3` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id_salle`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `produit` (`salle_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
