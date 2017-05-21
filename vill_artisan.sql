-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 21 Mai 2017 à 17:55
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
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title_article` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `author_article` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_article` datetime NOT NULL,
  `text_article` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `picture_article` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author_comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_article` int(11) NOT NULL,
  `text_comment` varchar(1500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`id`, `id_author`, `author_event`, `title_event`, `text_event`, `photo_event`, `date_event`) VALUES
(1, 25, 'Sodara NHEK', 'sodara', 'Moi', 'nothing', '2017-05-19'),
(2, 25, 'Sodara NHEK', 'sodara', 'Moi', 'nothing', '2017-05-19'),
(3, 25, 'Sodara NHEK', 'xcvxv', 'xvxvxcv', 'nothing', '2017-05-19'),
(4, 25, 'Sodara NHEK', 'vbnvbnvb', 'nvbnvbn', 'nothing', '2017-05-19'),
(5, 25, 'Sodara NHEK', 'vbnvbnvb', 'nvbnvbn', 'nothing', '2017-05-19'),
(6, 25, 'Sodara NHEK', 'vbnvbnvb', 'nvbnvbn', 'nothing', '2017-05-19'),
(7, 25, 'Sodara NHEK', 'dgdgd', 'dgdgdgg', 'nothing', '2017-05-19'),
(8, 25, 'Sodara NHEK', 'dgdgd', 'dgdgdgg', './users/SodaraNHEK/591f1898aaf8a.jpeg', '2017-05-19'),
(9, 25, 'Sodara NHEK', 'UYo', 'dsfsfsf', 'nothing', '2017-05-19'),
(10, 25, 'Sodara NHEK', 'UYo', 'dsfsfsf', 'nothing', '2017-05-19'),
(11, 25, 'Sodara NHEK', 'UYo', 'dsfsfsf', 'nothing', '2017-05-19'),
(12, 25, 'Sodara NHEK', 'UYo', 'dsfsfsf', 'nothing', '2017-05-19'),
(13, 25, 'Sodara NHEK', 'rertert', 'reterret', 'nothing', '2017-05-19'),
(14, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7222f41.jpeg', '2017-05-19'),
(15, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c72edf3f.jpeg', '2017-05-19'),
(16, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c732818e.jpeg', '2017-05-19'),
(17, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7359084.jpeg', '2017-05-19'),
(18, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c738b971.jpeg', '2017-05-19'),
(19, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c73bb394.jpeg', '2017-05-19'),
(20, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c73e374a.jpeg', '2017-05-19'),
(21, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7b87a41.jpeg', '2017-05-19'),
(22, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7bc6540.jpeg', '2017-05-19'),
(23, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7c0716f.jpeg', '2017-05-19'),
(24, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7c33b47.jpeg', '2017-05-19'),
(25, 25, 'Sodara NHEK', 'rertert', 'reterret', './users/SodaraNHEK/591f1c7c5bb20.jpeg', '2017-05-19'),
(26, 25, 'Sodara NHEK', 'fdgdg', 'dfgdfgd', 'nothing', '2017-05-19'),
(27, 25, 'Sodara NHEK', 'fdgdg', 'dfgdfgd', 'nothing', '2017-05-19'),
(28, 25, 'Sodara NHEK', 'fdgdg', 'dfgdfgd', 'nothing', '2017-05-19'),
(29, 25, 'Sodara NHEK', 'fdgdfg', 'dfgdfgd', 'nothing', '2017-05-19'),
(30, 25, 'Sodara NHEK', 'fdgdfg', 'dfgdfgd', 'nothing', '2017-05-19'),
(31, 25, 'Sodara NHEK', 'fdgfgdfg', 'dfgdgd', 'nothing', '2017-05-19'),
(32, 25, 'Sodara NHEK', 'fdgfgdfg', 'dfgdgd', 'nothing', '2017-05-19'),
(33, 25, 'Sodara NHEK', 'fdgfgdfg', 'dfgdgd', 'nothing', '2017-05-19'),
(34, 25, 'Sodara NHEK', 'fdgfgdfg', 'dfgdgd', 'nothing', '2017-05-19'),
(35, 25, 'Sodara NHEK', 'fdgfgdfg', 'dfgdgd', 'nothing', '2017-05-19'),
(36, 25, 'Sodara NHEK', 'fdgfgdfg', 'dfgdgd', 'nothing', '2017-05-19'),
(37, 25, 'Sodara NHEK', 'dgdfg', 'fdgdfg', 'nothing', '2017-05-19'),
(38, 25, 'Sodara NHEK', 'ffh', 'gfhfghfg', 'nothing', '2017-05-19'),
(39, 25, 'Sodara NHEK', 'vbnvbnvb', 'nvbnvbvbn', 'nothing', '2017-05-19'),
(40, 25, 'Sodara NHEK', 'vbnvbnvb', 'nvbnvbvbn', 'nothing', '2017-05-19'),
(41, 25, 'Sodara NHEK', 'ghfhgffg', 'hfghfghf', 'nothing', '2017-05-19'),
(42, 25, 'Sodara NHEK', 'fdfdgd', 'gdffdgd', 'nothing', '2017-05-19'),
(43, 25, 'Sodara NHEK', 'rtrete', 'retetre', 'nothing', '2017-05-19');

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

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `id_sender`, `id_receiver`, `text_message`, `date_message`) VALUES
(61, 25, 26, 'YO', '2017-05-19'),
(62, 25, 26, 'Ca va?', '2017-05-19'),
(63, 26, 25, 'Oui', '2017-05-19'),
(64, 26, 25, 'Et toi?', '2017-05-19'),
(65, 26, 25, 'Ca va?', '2017-05-19'),
(66, 25, 26, 'Yes', '2017-05-19'),
(67, 25, 26, 'Alors?', '2017-05-19'),
(68, 25, 26, 'Quoi de beau?\n', '2017-05-19'),
(69, 26, 25, 'Rien', '2017-05-19'),
(70, 25, 26, 'rien?\n', '2017-05-19'),
(71, 25, 26, 'Hey', '2017-05-19'),
(72, 25, 26, 'Hey', '2017-05-19'),
(73, 25, 26, 'Hey', '2017-05-19'),
(74, 25, 26, 'Hey', '2017-05-19'),
(75, 25, 26, 'YO', '2017-05-19'),
(76, 25, 26, 'haha', '2017-05-20'),
(77, 25, 26, 'haha', '2017-05-20'),
(78, 25, 26, 'haha', '2017-05-20'),
(79, 25, 26, 'haha', '2017-05-20'),
(80, 25, 26, 'haha', '2017-05-20'),
(81, 25, 26, 'FGFDGDG', '2017-05-20');

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

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `user_type`, `lastname`, `firstname`, `password`, `mail`, `adress`, `postcode`, `user_village`, `user_interet`, `user_pic`) VALUES
(25, 'crafter', 'NHEK', 'Sodara', '$2y$10$c2FsdHlzYWx0eXNhbHR5cuJ9osWrdD098BB.G/zsVbRAKWDZYLzOi', 'sodara.nhek@supinternet.fr', '55 avenue de l\'enfer', 75011, 'Grands-Boulevards,Quinze-vingts', '', 'users/SodaraNHEK/profile_pic/SodaraNHEK.png');

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
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `crafter`
--
ALTER TABLE `crafter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
