-- phpMyAdmin SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ensisocial`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorcomment`
--

CREATE TABLE `authorcomment` (
  `authorid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `pk_authorcomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `authornews`
--

CREATE TABLE `authornews` (
  `authorid` int(11) NOT NULL,
  `newsfeedid` int(11) NOT NULL,
  `pk_authornews` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `newscomment`
--

CREATE TABLE `newscomment` (
  `newsfeedid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `pk_newscomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `score` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `connected` tinyint(1) NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `addresse`, `zipcode`, `town`, `birth`, `phone`, `formation`, `connected`, `profile_pic`) VALUES
(2, 'a@uha.fr', '$2y$11$YPGv6PD53GUUUh9kZCitIeZlsBCpPllLXIb2BQXdH9tMVnBnqEtf.', 'François', 'Straebler', '51 rue de chorey', 21200, 'beaune', '1970-01-01', '0771068564', 'IR', 1, 'default-profile.png'),
(3, 'b@uha.fr', '$2y$11$dx1WBlDZ/4atBb0SCF0ghuRIFqjVrnqueUSVc7LOmmAmM91NAiaOy', 'Thibaud', 'Gasser', '', 0, '', '1970-01-01', '', 'IR', 1, 'default-profile.png'),
(4, 'c@uha.fr', '$2y$11$x5hZP/nOJfLJ5agVWsnCVu78yezij.kfMBO1sqyaGeDI96ai0JLu2', 'Florian', 'Jaby', '', 0, '', '1970-01-01', '', 'IR', 0, 'default-profile.png'),
(5, 'd@uha', '$2y$11$ttG2EeeAA5D0hxahu3oMI.awUhQLs10YED4pr.uhUAue/DPhCWyN2', 'Gabin', 'Michalet', '', 0, '', '1970-01-01', '', 'IR', 0, 'default-profile.png');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `iduser` int(11) NOT NULL,
  `idnews` int(11) NOT NULL,
  `pk_vote` int(11) NOT NULL,
  `vote` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorcomment`
--
ALTER TABLE `authorcomment`
  ADD PRIMARY KEY (`pk_authorcomment`),
  ADD UNIQUE KEY `commentid` (`commentid`),
  ADD KEY `fk_user` (`authorid`);

--
-- Indexes for table `authornews`
--
ALTER TABLE `authornews`
  ADD PRIMARY KEY (`pk_authornews`),
  ADD UNIQUE KEY `newsfeedid` (`newsfeedid`),
  ADD KEY `fk_author` (`authorid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newscomment`
--
ALTER TABLE `newscomment`
  ADD PRIMARY KEY (`pk_newscomment`),
  ADD UNIQUE KEY `commentid` (`commentid`),
  ADD KEY `fk_news` (`newsfeedid`);

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--

-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`pk_vote`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idnews` (`idnews`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `authorcomment`
--
ALTER TABLE `authorcomment`
  MODIFY `pk_authorcomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `authornews`
--
ALTER TABLE `authornews`
  MODIFY `pk_authornews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `newscomment`
--
ALTER TABLE `newscomment`
  MODIFY `pk_newscomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
ALTER TABLE `newscomment`
  MODIFY `pk_newscomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `pk_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `authorcomment`
--
ALTER TABLE `authorcomment`
  ADD CONSTRAINT `fk_comment` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Contraintes pour la table `authornews`
--
ALTER TABLE `authornews`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newsfeed` FOREIGN KEY (`newsfeedid`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `newscomment`
--
ALTER TABLE `newscomment`
  ADD CONSTRAINT `fk_news` FOREIGN KEY (`newsfeedid`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newscomment` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`idnews`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
