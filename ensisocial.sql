-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 10 Juin 2017 à 17:54
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
  `commentid` int(11) NOT NULL,
  `pk_authorcomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `authorcomment`
--

INSERT INTO `authorcomment` (`authorid`, `commentid`, `pk_authorcomment`) VALUES
(3, 5, 5),
(7, 7, 7),
(7, 8, 8),
(2, 9, 9);

-- --------------------------------------------------------

--
-- Structure de la table `authornews`
--

CREATE TABLE `authornews` (
  `authorid` int(11) NOT NULL,
  `newsfeedid` int(11) NOT NULL,
  `pk_authornews` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `authornews`
--

INSERT INTO `authornews` (`authorid`, `newsfeedid`, `pk_authornews`) VALUES
(2, 68, 57),
(3, 69, 58),
(3, 71, 60),
(7, 72, 61),
(3, 73, 62),
(5, 74, 63),
(5, 75, 64),
(9, 77, 66),
(9, 78, 67),
(9, 79, 68),
(9, 80, 69),
(9, 81, 70);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date`, `upvote`, `downvote`) VALUES
(5, 'mm', '2017-06-08 11:05:48', NULL, NULL),
(7, 'ee', '2017-06-08 11:10:21', NULL, NULL),
(8, 'mm', '2017-06-08 11:12:02', NULL, NULL),
(9, 'ou&eacute; c tro la clace', '2017-06-08 13:38:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default-group.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id`, `name`, `description`, `img`) VALUES
(1, 'Informatique et réseau', 'La spécialité informatique et réseaux forme des ingénieurs capables de maîtriser les savoirs, savoir-faire et savoir-être indispensables à un ingénieur informatique à l’ère du numérique. Ce domaine, fortement dynamisé par Internet, par l’interconnexion des objets, des équipements, des services et des personnes, par la production massive de données est en évolution rapide et transforme tous les secteurs d’activités.\n \nLe domaine professionnel de l’informatique est en quête d’ingénieurs en informatique et réseaux bénéficiant de connaissances et de compétences avancées pour la conception et la mise en œuvre de systèmes innovants destinés à la nouvelle société de l’information. Face à cette demande, la formation prépare aux métiers d’ingénieur en informatique et réseaux intervenant dans des secteurs aussi variés que les services, l’industrie, la santé, la conception de produits, etc.\n \nUne formation scientifique solide, un accent mis sur le génie logiciel, l’architecture et la modélisation, complétée par des modules de spécialisation permet aux futurs ingénieurs en informatique et réseaux d’aborder des métiers d’ingénieurs variés relevant de l’ingénierie des systèmes logiciels complexes, de l’ingénierie des applications réseaux et Internet ou encore de l’ingénierie de systèmes embarqués. Une formation au management et à la gestion de projets, complétée par des projets et stages sont l’occasion de se préparer à la fonction d’encadrement et à la prise de responsabilités.', 'default-group.png'),
(2, 'Mecanique', 'La spécialité mécanique de l’ENSISA forme aux différents métiers de l’ingénieur mécanicien dans les domaines de la conception et de la fabrication.\n \nElle s’appuie sur le développement des connaissances en sciences pour l’ingénieur et en génie mécanique mais aussi sur l’apprentissage des responsabilités, l’adaptation aux exigences d’un environnement professionnel en pleine évolution.\nLes liens étroits avec les entreprises mécaniques nationales mais aussi régionales sont l‘occasion de visites sur sites industriels et de diverses études notamment au travers de projets, tout au long de la formation.\nL’adossement des enseignements aux résultats de recherches et développements des laboratoires reconnus de l’ENSISA (LPMT), mais aussi des centres techniques, est un gage de qualité et de génération de connaissances toujours plus actuelles.\n \nL’ENSISA et tout particulièrement sa spécialité mécanique est partenaire de la plate-forme technologique de métrologie Alsace Métrologie, ce qui lui assure des liens toujours plus étroits avec l’industrie et une compétence dans ce domaine, fort importante en génie mécanique.\n \nDynamisé par les enjeux environnementaux et de développement durable, le secteur de la mécanique recherche des ingénieurs ayant des connaissances et des compétences de pointe tant en conception qu’en fabrication. Le cycle de vie complet d’un produit et son impact sur l’environnement doivent bien évidemment être considérés et ceci dans la limite des connaissances scientifiques actuelles.', 'default-group.png'),
(3, 'Textile et fibres', 'La spécialité textile et fibres, adossée au Laboratoire de Physique et Mécanique Textiles, repose, en plus des enseignements classiques de sciences pour l’ingénieur, sur la transmission de la technique et des connaissances spécifiques à l’ingénierie des fibres. Ces liens étroits entre recherche et enseignement garantissent à la formation une remise à jour continue des enseignements et la présentation de connaissances toujours plus actuelles. C’est la spécialité historique de l’Ecole, issue de l’école textile créée en 1861.\n \nDe plus, les équipements, les pilotes industriels ainsi que les relations privilégiées que la filière entretient avec les acteurs du secteur (industriels, Institut Français du Textile et de l’Habillement, Pôle Textile Alsace, Pôle de Compétitivité Fibres-Energivie, …) permettent à l’étudiant, tout au long de son cursus, de mettre en pratique à une échelle industrielle ou semi-industrielle les connaissances acquises.\n \nLes propriétés physiques, mécaniques et chimiques du matériau fibreux en font un outil extraordinairement polyvalent qui peut être destiné aussi bien à la réalisation de structures souples relevant de la haute technologie qu’à des produits destinés à la grande consommation.\nL’ENSISA forme des ingénieurs capables de maîtriser les savoirs et savoir-faire indispensables aux Industries Textiles de demain.\n \nLa reconnaissance de la spécialité par les entreprises nationales et internationales est un atout indéniable pour l’insertion des ingénieurs diplômés.', 'default-group.png'),
(4, 'Automatique et système', 'La spécialité automatique et systèmes embarqués propose une formation pluridisciplinaire de haut niveau scientifique dans les domaines de la conception des systèmes intelligents et du traitement des signaux et des images.\n \nLa formation met l’accent sur l’optimisation et la commande des systèmes dynamiques, ainsi que sur l’instrumentation et le traitement des signaux et des images.\nElle s’articule autour d’une formation généraliste à laquelle viennent s’ajouter des modules d’enseignement de spécialité.\n \nDe plus, elle permet à l’élève-ingénieur, par le biais de projets à caractère « Recherche et Développement », d’aborder des problèmes concrets et d’affirmer ses capacités d’autonomie et de prise de responsabilités pour aborder et résoudre un problème de type industriel, facilitant ainsi sa future insertion professionnelle.\n \nLes domaines d’excellence de la spécialité automatique et systèmes sont principalement l’automatique, le contrôle-commande des systèmes dynamiques, les méthodes de mesures et de traitement du signal et de l’image, l’électronique et les systèmes embarqués, la mécanique des systèmes et la robotique. Ces technologies innovantes sont essentiellement destinées à des applications dans les secteurs de l’automobile, de l’aéronautique et de l’industrie de transformation.\n ', 'default-group.png'),
(5, 'Filière par alternance', 'Les entreprises industrielles, de la région Alsace mais également bien au delà, sont sans cesse à la recherche d’ingénieurs capables de gérer des aspects scientifiques, techniques, organisationnels et économiques d’un système de production.\n \nLes systèmes de production sont de plus en plus complexes à concevoir et à exploiter, face à un marché concurrentiel et en pleine évolution. De plus, la gestion de production et toutes les activités industrielles transverses en lien avec cette gestion, demandent de plus en plus de compétences.\n \nPour répondre à ce besoin d’ingénieurs, l’ENSISA et l’ITII Alsace (Institut des techniques d’ingénieurs de l’industrie d’Alsace) se sont associés, en 2009, pour proposer une spécialité systèmes de production (formation initiale par apprentissage et formation continue); cette spécialité est habilitée par la Commission des titres d’ingénieur.\n \nLes objectifs de cette spécialité par alternance visent la formation d’ingénieurs capables de :\nPrendre en charge et gérer des projets de développement et d’amélioration de la production en milieu industriel\nParticiper à l’accroissement des performances de l’entreprise dans le domaine de la production et de la gestion de production\nOptimiser l’outil de fabrication.\n \nLe libellé du diplôme délivré est :\nDiplôme d’ingénieur de l’école nationale supérieure d’ingénieurs sud Alsace en ingénierie des systèmes de production, en partenariat avec l’ITII Alsace, au titre de la formation initiale sous statut d’apprenti ou au titre de la formation continue.\n \nLa première promotion est sortie en juin 2012.', 'default-group.png');

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `member`
--

INSERT INTO `member` (`id`, `iduser`, `idgroup`, `admin`) VALUES
(1, 2, 1, 1),
(3, 4, 1, 1),
(5, 5, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `newscomment`
--

CREATE TABLE `newscomment` (
  `newsfeedid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `pk_newscomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `newscomment`
--

INSERT INTO `newscomment` (`newsfeedid`, `commentid`, `pk_newscomment`) VALUES
(68, 5, 5),
(71, 7, 7),
(71, 8, 8),
(73, 9, 9);

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
  `score` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `newsfeed`
--

INSERT INTO `newsfeed` (`id`, `title`, `date`, `content`, `place`, `type`, `score`) VALUES
(68, 'fssdf', '2017-06-08 10:20:52', 'fdsg', '0', NULL, 0),
(69, 'Hhhz', '2017-06-08 11:05:35', 'jjfjfj', '0', NULL, 0),
(71, 'zz', '2017-06-08 11:07:22', 'zzz', '4', NULL, 0),
(72, 'dfs', '2017-06-08 11:23:54', 'dsfsf', '3', NULL, 0),
(73, 'Vive le tuning', '2017-06-08 13:35:52', 'C&eacute; tro bi1', '0', NULL, 1),
(74, 'heiiiinnnnnnnnnn', '2017-06-08 13:40:52', 'agagagagagag\r\n', '0', NULL, 0),
(75, 'fhhfdsjkfhds', '2017-06-08 13:42:28', 'hsdfjkhfdsk\r\n', '3', NULL, -2),
(77, 'qhukqfdqh', '2017-06-09 11:39:59', 'dfsbkfghsdgb\r\n', '2', NULL, 0),
(78, 'hhjhg', '2017-06-09 14:05:09', 'hgfjfj', '9', NULL, 0),
(79, 'gjdkfdf', '2017-06-09 14:06:53', 'sndljfnds\r\n', '0', NULL, 0),
(80, 'fdsfsd', '2017-06-09 14:07:05', 'dfsfsdf', '9', NULL, 0),
(81, 'fsdbdjs', '2017-06-09 14:07:18', 'fbdskfbsdk\r\n', '3', NULL, 0);

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
  `connectedTime` int(10) UNSIGNED DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `addresse`, `zipcode`, `town`, `birth`, `phone`, `formation`, `connectedTime`, `profile_pic`) VALUES
(2, 'a@uha.fr', '$2y$11$1TCxXMN5QGPc7nRrWkr1aeRxmxkE9Y2VccDFJF52gimpRZpsf0C7.', 'François', 'Straebler', '51 rue de chorey', 21200, 'beaune', '1970-01-01', '0771068564', 'IR', 1497109800, '3c5ea46acaebe1c136639b7a88d2aa87.jpg'),
(3, 'b@uha.fr', '$2y$11$fDFOYpFrqCX5uBWWN8566eNwMhnUPJemmGHfNQT4HFZH.lr0mJ/dq', 'Thibaud le BG du 69', 'Gasser', '69 rue de la voiture sa m&egrave;re', 69690, 'KEKEVILLE', '1969-01-01', '0669696969', 'IR', 1497110048, '418a50b5cb341772afc204570dce374c.jpg'),
(4, 'c@uha.fr', '$2y$11$x5hZP/nOJfLJ5agVWsnCVu78yezij.kfMBO1sqyaGeDI96ai0JLu2', 'Florian', 'Jaby', '', 0, '', '1970-01-01', '', 'IR', 1497109846, 'default-profile.png'),
(5, 'd@uha', '$2y$11$ttG2EeeAA5D0hxahu3oMI.awUhQLs10YED4pr.uhUAue/DPhCWyN2', 'Gabin', 'Michalet', '', 0, '', '1970-01-01', '', 'IR', NULL, '29e43cb78e85afd7985b1ee164e6eced.jpg'),
(7, 'test@uha.fr', '$2y$11$8oPRz6yLjREgzu4FEmQfT.Upw.OfLRAjqUyNSRIsp/1.J.9jl4UJC', 'test', 'test', '', 0, '', '2017-06-10', '', 'textile', NULL, '3126f911561df8a0d23ef727810c0b0c.jpg'),
(8, 'putin@uha.fr', '$2y$11$cVw4K.YHZPtm6InGnUhfgOCVfStkJYgHELMk0aGlRd.agz/wGWewy', 'poutine', 'vladimir', '', 0, '', '1970-01-01', '', 'IR', NULL, 'a283a5e2dc2471950c36ed202b27e9b1.jpg'),
(9, 'queen@uha.fr', '$2y$11$MOd012GX9KyZik9W8flRcevOHsvPQzPgowZ/LGa1dKfyJpG2w7FQC', 'la reine', 'd&#039;angleterre', '', 0, '', '1970-01-01', '', 'IR', NULL, '21c57cd7e706f9b9ea88715f5d8313b2.gif');

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
-- Index pour les tables exportées
--

--
-- Index pour la table `authorcomment`
--
ALTER TABLE `authorcomment`
  ADD PRIMARY KEY (`pk_authorcomment`),
  ADD UNIQUE KEY `commentid` (`commentid`),
  ADD KEY `fk_user` (`authorid`);

--
-- Index pour la table `authornews`
--
ALTER TABLE `authornews`
  ADD PRIMARY KEY (`pk_authornews`),
  ADD UNIQUE KEY `newsfeedid` (`newsfeedid`),
  ADD KEY `fk_author` (`authorid`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idgroup` (`idgroup`);

--
-- Index pour la table `newscomment`
--
ALTER TABLE `newscomment`
  ADD PRIMARY KEY (`pk_newscomment`),
  ADD UNIQUE KEY `commentid` (`commentid`),
  ADD KEY `fk_news` (`newsfeedid`);

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
  MODIFY `pk_authorcomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `authornews`
--
ALTER TABLE `authornews`
  MODIFY `pk_authornews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `newscomment`
--
ALTER TABLE `newscomment`
  MODIFY `pk_newscomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `pk_vote` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `authorcomment`
--
ALTER TABLE `authorcomment`
  ADD CONSTRAINT `fk_comment` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `authornews`
--
ALTER TABLE `authornews`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newsfeed` FOREIGN KEY (`newsfeedid`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`idgroup`) REFERENCES `groupe` (`id`);

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
