-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 03 Février 2017 à 07:17
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `boutique_sf3`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `titre` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `titre`) VALUES
(1, 'armes de poing'),
(2, 'armes blanches'),
(3, 'armes lourdes'),
(4, 'armes d''assault');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `login` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `login`, `mdp`, `role`) VALUES
(1, 'Trump', 'donald', 'ROLE_USER'),
(2, 'Florence', 'juji', 'ROLE_USER'),
(3, 'Antoine', 'panzer', 'ROLE_USER'),
(4, 'Wars', 'star', 'ROLE_USER'),
(11, 'test123456', 'azeaz', 'ROLE_USER'),
(12, 'admin', 'admin', 'ROLE_ADMIN'),
(13, 'exped', 'exped', 'ROLE_EXPEDITOR');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `dateheureCreation` datetime NOT NULL,
  `etat` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `prixTotal` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `client_id`, `dateheureCreation`, `etat`, `prixTotal`) VALUES
(1, 1, '2017-02-01 00:00:00', 'PAYEE', 3015),
(2, 2, '2017-01-01 10:00:00', 'PAYEE', 72),
(3, 3, '2016-12-01 19:15:00', 'NON-PAYEE', 202515),
(4, 4, '2016-11-01 00:00:00', 'LIVREE', 8000),
(5, 4, '2017-02-01 14:45:00', 'NON-PAYEE', 3000);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `titre` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prix` double NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `prix`, `stock`) VALUES
(1, 'beretta', '9mm', 1500, 0),
(2, 'Magnum', '45 mm', 2000, 0),
(3, 'luger', '9mm', 2500, 5),
(4, 'desert eagle', '50mm', 3000, 10),
(5, 'laguiolle', NULL, 50, 5),
(6, 'machette', NULL, 25, 5),
(7, 'sabre', NULL, 47, 15),
(8, 'pelle', NULL, 15, 20),
(9, 'bazooka', NULL, 5000, 2),
(10, 'DCA', NULL, 200000, 1),
(11, 'famas', NULL, 8000, 5),
(12, 'AK47', NULL, 4000, 64);

-- --------------------------------------------------------

--
-- Structure de la table `produit_categorie`
--

CREATE TABLE `produit_categorie` (
  `produit_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `produit_categorie`
--

INSERT INTO `produit_categorie` (`produit_id`, `categorie_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 4),
(12, 4);

-- --------------------------------------------------------

--
-- Structure de la table `produit_commande`
--

CREATE TABLE `produit_commande` (
  `produit_id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `produit_commande`
--

INSERT INTO `produit_commande` (`produit_id`, `commande_id`) VALUES
(3, 3),
(4, 1),
(4, 4),
(4, 5),
(6, 2),
(7, 2),
(8, 1),
(8, 3),
(9, 4),
(10, 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7440455AA08CB10` (`login`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D19EB6921` (`client_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit_categorie`
--
ALTER TABLE `produit_categorie`
  ADD PRIMARY KEY (`produit_id`,`categorie_id`),
  ADD KEY `IDX_CDEA88D8F347EFB` (`produit_id`),
  ADD KEY `IDX_CDEA88D8BCF5E72D` (`categorie_id`);

--
-- Index pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD PRIMARY KEY (`produit_id`,`commande_id`),
  ADD KEY `IDX_47F5946EF347EFB` (`produit_id`),
  ADD KEY `IDX_47F5946E82EA2E54` (`commande_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `produit_categorie`
--
ALTER TABLE `produit_categorie`
  ADD CONSTRAINT `FK_CDEA88D8BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDEA88D8F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD CONSTRAINT `FK_47F5946E82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_47F5946EF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;
