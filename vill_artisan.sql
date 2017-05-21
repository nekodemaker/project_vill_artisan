-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 21 Mai 2017 à 22:01
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vill_artisan`
--

-- --------------------------------------------------------

--
-- Structure de la table `crafter`
--

CREATE TABLE `crafter` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `crafter_adress` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_village` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_job` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_history` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_shop` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_profile_photo` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_shop_photo` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `crafter_photo_work` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coord_latitude` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `coord_longitude` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `author_event` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_event` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text_event` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo_event` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_event` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `text_message` varchar(300) NOT NULL,
  `date_message` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `postcode` int(5) NOT NULL,
  `user_village` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_interet` varchar(200) NOT NULL,
  `user_pic` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `villages`
--

CREATE TABLE `villages` (
  `id` int(11) NOT NULL,
  `village_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `villages`
--

INSERT INTO `villages` (`id`, `village_name`) VALUES
(44, 'Louvre / CHâtelet-les-halles'),
(45, 'Opéra / Vendôme'),
(46, 'Grands-Boulevards'),
(47, 'Arts et métiers'),
(48, 'Saint Victor / Jardins des Plantes'),
(49, 'Sorbonne / Val de Grâce'),
(50, 'Odéon / Notre-Dames des champs'),
(51, 'Saint-Germain-des-prés / Monnaie'),
(52, 'Invalides / Saint Thomas D\'Aquin'),
(53, 'Gros Caillou / École militaire'),
(54, 'Champs-Elysées'),
(55, 'Europe / Madeleine'),
(56, 'Saint Georges / Rochechouart'),
(57, 'Saint Vincent de Paul'),
(58, 'Hôpital saint Louis'),
(59, 'Folie-Méricourt / Sainte Ambroises'),
(60, 'Roquette'),
(61, 'Quinze-vingts'),
(62, 'Picpus / Bel-air'),
(63, 'Bercy'),
(64, 'Quartier de la Gare'),
(65, 'Maison Blanche'),
(66, 'Salpêtrière / Croulebarbe'),
(67, 'Montparnasse'),
(68, 'Petit-Montrouge'),
(69, 'Plaisance'),
(70, 'Saint Lambert'),
(71, 'Grenade / Javel'),
(72, 'Auteil'),
(73, 'La Muette'),
(74, 'Ternes / Plaine Monceau'),
(75, 'Batignoles'),
(76, 'Clignancourt'),
(77, 'Montmartre'),
(78, 'Goutte d\'Or / La Chapelle'),
(79, 'La Vilette'),
(80, 'Combat / Amérique'),
(81, 'Belleville / Père Lachaise'),
(82, 'Saint Fargeau'),
(83, 'Charonne / Maraichers');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `crafter`
--
ALTER TABLE `crafter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `crafter`
--
ALTER TABLE `crafter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
