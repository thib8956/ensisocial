-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 31 Mai 2017 à 16:00
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ensisocial`
--

-- --------------------------------------------------------

--
-- Structure de la table `authorcomment`
--

CREATE TABLE `authorcomment` (
  `authorid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `authornews`
--

CREATE TABLE `authornews` (
  `authorid` int(11) NOT NULL,
  `newsfeedid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `upvote` int(11) NOT NULL,
  `downvote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newscomment`
--

CREATE TABLE `newscomment` (
  `newsfeedid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upvote` int(11) NOT NULL,
  `downvote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `formation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connected` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `addresse`, `zipcode`, `town`, `birth`, `phone`, `formation`, `connected`) VALUES
(2, 'a@uha.fr', '$2y$11$YPGv6PD53GUUUh9kZCitIeZlsBCpPllLXIb2BQXdH9tMVnBnqEtf.', 'François', 'Straebler', '51 rue de chorey', 21200, 'beaune', '1970-01-01', '0771068564', 'IR', 0),
(3, 'b@uha.fr', '$2y$11$dx1WBlDZ/4atBb0SCF0ghuRIFqjVrnqueUSVc7LOmmAmM91NAiaOy', 'thibaud', 'gasser', '', 0, '', '1970-01-01', '', 'IR', 0),
(4, 'c@uha.fr', '$2y$11$x5hZP/nOJfLJ5agVWsnCVu78yezij.kfMBO1sqyaGeDI96ai0JLu2', 'florian', 'jaby', '', 0, '', '1970-01-01', '', 'IR', 0),
(5, 'd@uha', '$2y$11$ttG2EeeAA5D0hxahu3oMI.awUhQLs10YED4pr.uhUAue/DPhCWyN2', 'gabin', 'michalet', '', 0, '', '1970-01-01', '', 'IR', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `authorcomment`
--
ALTER TABLE `authorcomment`
  ADD PRIMARY KEY (`authorid`,`commentid`);

--
-- Index pour la table `authornews`
--
ALTER TABLE `authornews`
  ADD PRIMARY KEY (`authorid`,`newsfeedid`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newscomment`
--
ALTER TABLE `newscomment`
  ADD PRIMARY KEY (`newsfeedid`,`commentid`);

--
-- Index pour la table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
