-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 02 Juin 2017 à 11:36
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19


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

--
-- Contenu de la table `authornews`
--

INSERT INTO `authornews` (`authorid`, `newsfeedid`) VALUES
(2, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
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
  `date` datetime NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `newsfeed`
--

INSERT INTO `newsfeed` (`id`, `title`, `date`, `content`, `place`, `type`, `upvote`, `downvote`) VALUES
(1, 'Test de publication', '2017-06-02 11:28:26', 'Lorem ipsum dolor sit amet', NULL, NULL, NULL, NULL),
(2, 'Test de publication 2', '2017-06-02 11:29:00', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut dui purus. Nullam elit mauris, sollicitudin quis condimentum quis, consequat sed ligula. Nulla sem justo, eleifend sit amet nunc et, efficitur suscipit nunc. Nam faucibus at urna eu sodales. In ut justo semper, hendrerit neque non, aliquam sem. Praesent egestas vitae erat quis maximus. Mauris dignissim odio at leo tempor tempus. Nullam placerat semper ante eget finibus. Suspendisse efficitur vitae neque at interdum. Aenean a ante nec lorem molestie mattis ut eget arcu. Maecenas ut risus ac sapien egestas semper vel ut eros. Mauris luctus magna eget eros tincidunt, sed efficitur purus tincidunt. Mauris faucibus dolor nisl, quis consequat tellus sollicitudin nec.  Praesent diam diam, tincidunt vel est at, vulputate eleifend neque. Nulla eu hendrerit erat. Proin faucibus velit leo, nec consequat ante tempor a. Nam neque felis, egestas nec augue ut, hendrerit finibus lorem. Duis aliquam urna non orci venenatis, sed bibendum lectus cursus. Nulla eu libero id tellus pulvinar sollicitudin. Phasellus at erat nisi. Sed elementum, mi eget efficitur fringilla, arcu dolor ornare felis, ac sodales nisl est quis risus. Nulla facilisi. Aenean eu sollicitudin dolor, et feugiat justo. Vivamus sodales mauris id lorem vehicula, sed ullamcorper augue accumsan. Etiam id neque nulla. Vestibulum vel dolor nisi. Maecenas ac vestibulum lorem, ut porttitor sapien. Nunc gravida placerat rhoncus. ', NULL, NULL, NULL, NULL),
(3, 'Hello world !', '2017-06-02 11:30:15', '  Nunc auctor maximus velit nec mollis. Nam ac maximus augue, id venenatis quam. Aliquam eleifend ut tellus dignissim tempor. Duis quis sapien at metus convallis ullamcorper. Duis elementum vehicula porta. Quisque aliquam lacus sed dolor sodales aliquam ut non nisi. Proin pulvinar quam eu velit ullamcorper, nec auctor metus varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eros ex, elementum a velit eget, hendrerit dignissim risus. Mauris mollis sit amet ipsum et feugiat. Phasellus maximus suscipit feugiat. Aliquam rutrum quam eu ligula rutrum, at malesuada lacus eleifend. Cras at laoreet tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius sapien quis orci rutrum vulputate. ', NULL, NULL, NULL, NULL);

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
(3, 'b@uha.fr', '$2y$11$dx1WBlDZ/4atBb0SCF0ghuRIFqjVrnqueUSVc7LOmmAmM91NAiaOy', 'Thibaud', 'Gasser', '', 0, '', '1970-01-01', '', 'IR', 1),
(4, 'c@uha.fr', '$2y$11$x5hZP/nOJfLJ5agVWsnCVu78yezij.kfMBO1sqyaGeDI96ai0JLu2', 'Florian', 'Jaby', '', 0, '', '1970-01-01', '', 'IR', 0),
(5, 'd@uha', '$2y$11$ttG2EeeAA5D0hxahu3oMI.awUhQLs10YED4pr.uhUAue/DPhCWyN2', 'Gabin', 'Michalet', '', 0, '', '1970-01-01', '', 'IR', 0),
(6, 'g@uha.fr', '$2y$11$7rrU7Ne2.FSQuhNgD7vymOJHTAkMMxYzlRzrKh0E8E6TIDPhGY6LC', 'Prout', 'Caca', '', 0, '', '1970-01-01', '', 'IR', 0);


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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
