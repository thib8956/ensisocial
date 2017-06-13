-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2017 at 08:22 PM
-- Server version: 10.1.22-MariaDB-
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `authorcomment`
--

INSERT INTO `authorcomment` (`authorid`, `commentid`, `pk_authorcomment`) VALUES
(43, 19, 19),
(49, 20, 20),
(52, 21, 21),
(53, 22, 22),
(47, 23, 23),
(47, 24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `authornews`
--

CREATE TABLE `authornews` (
  `authorid` int(11) NOT NULL,
  `newsfeedid` int(11) NOT NULL,
  `pk_authornews` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `authornews`
--

INSERT INTO `authornews` (`authorid`, `newsfeedid`, `pk_authornews`) VALUES
(45, 3, 3),
(46, 4, 4),
(46, 5, 5),
(54, 7, 7),
(54, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `chatgeneral`
--

CREATE TABLE `chatgeneral` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date` datetime NOT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date`, `upvote`, `downvote`) VALUES
(19, 'En attendant les AS travaillent environ aussi peu que s IR ... 🙄', '2017-06-13 18:54:07', NULL, NULL),
(20, 'Totalement d\'accord avec Victor .... 😕', '2017-06-13 18:58:49', NULL, NULL),
(21, 'Vous inqui&eacute;tez pas les enfants, ls emplois du temps sont au top du top ! Vous verrez en fin d\'ann&eacute;e vous les narguerez 😎', '2017-06-13 19:01:07', NULL, NULL),
(22, 'Moi j\'ai pas les m&ecirc;mes vacances c\'est de l\'arnaque !!', '2017-06-13 19:09:56', NULL, NULL),
(23, 'Moi jai pas de vacances non plus d&egrave;s que l\'&eacute;cole est en vacances je suis en entreprise', '2017-06-13 19:14:18', NULL, NULL),
(24, 'Apr&egrave;s j\'suis pay&eacute;e moi =D', '2017-06-13 19:14:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `img` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT 'default-group.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id`, `name`, `description`, `img`) VALUES
(1, 'IR', 'La spécialité informatique et réseaux forme des ingénieurs capables de maîtriser les savoirs, savoir-faire et savoir-être indispensables à un ingénieur informatique à l’ère du numérique. Ce domaine, fortement dynamisé par Internet, par l’interconnexion des objets, des équipements, des services et des personnes, par la production massive de données est en évolution rapide et transforme tous les secteurs d’activités.\n \nLe domaine professionnel de l’informatique est en quête d’ingénieurs en informatique et réseaux bénéficiant de connaissances et de compétences avancées pour la conception et la mise en œuvre de systèmes innovants destinés à la nouvelle société de l’information. Face à cette demande, la formation prépare aux métiers d’ingénieur en informatique et réseaux intervenant dans des secteurs aussi variés que les services, l’industrie, la santé, la conception de produits, etc.\n \nUne formation scientifique solide, un accent mis sur le génie logiciel, l’architecture et la modélisation, complétée par des modules de spécialisation permet aux futurs ingénieurs en informatique et réseaux d’aborder des métiers d’ingénieurs variés relevant de l’ingénierie des systèmes logiciels complexes, de l’ingénierie des applications réseaux et Internet ou encore de l’ingénierie de systèmes embarqués. Une formation au management et à la gestion de projets, complétée par des projets et stages sont l’occasion de se préparer à la fonction d’encadrement et à la prise de responsabilités.', 'default-info.gif'),
(2, 'meca', 'La spécialité mécanique de l’ENSISA forme aux différents métiers de l’ingénieur mécanicien dans les domaines de la conception et de la fabrication.\n \nElle s’appuie sur le développement des connaissances en sciences pour l’ingénieur et en génie mécanique mais aussi sur l’apprentissage des responsabilités, l’adaptation aux exigences d’un environnement professionnel en pleine évolution.\nLes liens étroits avec les entreprises mécaniques nationales mais aussi régionales sont l‘occasion de visites sur sites industriels et de diverses études notamment au travers de projets, tout au long de la formation.\nL’adossement des enseignements aux résultats de recherches et développements des laboratoires reconnus de l’ENSISA (LPMT), mais aussi des centres techniques, est un gage de qualité et de génération de connaissances toujours plus actuelles.\n \nL’ENSISA et tout particulièrement sa spécialité mécanique est partenaire de la plate-forme technologique de métrologie Alsace Métrologie, ce qui lui assure des liens toujours plus étroits avec l’industrie et une compétence dans ce domaine, fort importante en génie mécanique.\n \nDynamisé par les enjeux environnementaux et de développement durable, le secteur de la mécanique recherche des ingénieurs ayant des connaissances et des compétences de pointe tant en conception qu’en fabrication. Le cycle de vie complet d’un produit et son impact sur l’environnement doivent bien évidemment être considérés et ceci dans la limite des connaissances scientifiques actuelles.', 'default-meca.jpg'),
(3, 'textile', 'La spécialité textile et fibres, adossée au Laboratoire de Physique et Mécanique Textiles, repose, en plus des enseignements classiques de sciences pour l’ingénieur, sur la transmission de la technique et des connaissances spécifiques à l’ingénierie des fibres. Ces liens étroits entre recherche et enseignement garantissent à la formation une remise à jour continue des enseignements et la présentation de connaissances toujours plus actuelles. C’est la spécialité historique de l’Ecole, issue de l’école textile créée en 1861.\n \nDe plus, les équipements, les pilotes industriels ainsi que les relations privilégiées que la filière entretient avec les acteurs du secteur (industriels, Institut Français du Textile et de l’Habillement, Pôle Textile Alsace, Pôle de Compétitivité Fibres-Energivie, …) permettent à l’étudiant, tout au long de son cursus, de mettre en pratique à une échelle industrielle ou semi-industrielle les connaissances acquises.\n \nLes propriétés physiques, mécaniques et chimiques du matériau fibreux en font un outil extraordinairement polyvalent qui peut être destiné aussi bien à la réalisation de structures souples relevant de la haute technologie qu’à des produits destinés à la grande consommation.\nL’ENSISA forme des ingénieurs capables de maîtriser les savoirs et savoir-faire indispensables aux Industries Textiles de demain.\n \nLa reconnaissance de la spécialité par les entreprises nationales et internationales est un atout indéniable pour l’insertion des ingénieurs diplômés.', 'default-textil.jpg'),
(4, 'AS', 'La spécialité automatique et systèmes embarqués propose une formation pluridisciplinaire de haut niveau scientifique dans les domaines de la conception des systèmes intelligents et du traitement des signaux et des images.\n \nLa formation met l’accent sur l’optimisation et la commande des systèmes dynamiques, ainsi que sur l’instrumentation et le traitement des signaux et des images.\nElle s’articule autour d’une formation généraliste à laquelle viennent s’ajouter des modules d’enseignement de spécialité.\n \nDe plus, elle permet à l’élève-ingénieur, par le biais de projets à caractère « Recherche et Développement », d’aborder des problèmes concrets et d’affirmer ses capacités d’autonomie et de prise de responsabilités pour aborder et résoudre un problème de type industriel, facilitant ainsi sa future insertion professionnelle.\n \nLes domaines d’excellence de la spécialité automatique et systèmes sont principalement l’automatique, le contrôle-commande des systèmes dynamiques, les méthodes de mesures et de traitement du signal et de l’image, l’électronique et les systèmes embarqués, la mécanique des systèmes et la robotique. Ces technologies innovantes sont essentiellement destinées à des applications dans les secteurs de l’automobile, de l’aéronautique et de l’industrie de transformation.\n ', 'default-as.jpg'),
(5, 'FIP', 'Les entreprises industrielles, de la région Alsace mais également bien au delà, sont sans cesse à la recherche d’ingénieurs capables de gérer des aspects scientifiques, techniques, organisationnels et économiques d’un système de production.\n \nLes systèmes de production sont de plus en plus complexes à concevoir et à exploiter, face à un marché concurrentiel et en pleine évolution. De plus, la gestion de production et toutes les activités industrielles transverses en lien avec cette gestion, demandent de plus en plus de compétences.\n \nPour répondre à ce besoin d’ingénieurs, l’ENSISA et l’ITII Alsace (Institut des techniques d’ingénieurs de l’industrie d’Alsace) se sont associés, en 2009, pour proposer une spécialité systèmes de production (formation initiale par apprentissage et formation continue); cette spécialité est habilitée par la Commission des titres d’ingénieur.\n \nLes objectifs de cette spécialité par alternance visent la formation d’ingénieurs capables de :\nPrendre en charge et gérer des projets de développement et d’amélioration de la production en milieu industriel\nParticiper à l’accroissement des performances de l’entreprise dans le domaine de la production et de la gestion de production\nOptimiser l’outil de fabrication.\n \nLe libellé du diplôme délivré est :\nDiplôme d’ingénieur de l’école nationale supérieure d’ingénieurs sud Alsace en ingénierie des systèmes de production, en partenariat avec l’ITII Alsace, au titre de la formation initiale sous statut d’apprenti ou au titre de la formation continue.\n \nLa première promotion est sortie en juin 2012.', 'default-fip.jpg'),
(6, 'enseignant', NULL, 'default-group.png'),
(7, 'personnelUha', NULL, 'default-group.png');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `iduser`, `idgroup`) VALUES
(1, 35, 1),
(2, 36, 6),
(4, 38, 1),
(5, 39, 1),
(6, 40, 1),
(9, 43, 2),
(10, 44, 3),
(11, 45, 1),
(12, 46, 1),
(13, 47, 5),
(14, 48, 1),
(15, 49, 3),
(16, 50, 2),
(17, 51, 5),
(18, 52, 6),
(19, 53, 7),
(20, 54, 4),
(21, 55, 4);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lu` tinyint(1) DEFAULT '0',
  `message` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `newscomment`
--

CREATE TABLE `newscomment` (
  `newsfeedid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `pk_newscomment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `newscomment`
--

INSERT INTO `newscomment` (`newsfeedid`, `commentid`, `pk_newscomment`) VALUES
(7, 19, 19),
(7, 20, 20),
(7, 21, 21),
(7, 22, 22),
(7, 23, 23),
(7, 24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date` datetime NOT NULL,
  `content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0',
  `score` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `newsfeed`
--

INSERT INTO `newsfeed` (`id`, `title`, `date`, `content`, `place`, `type`, `score`) VALUES
(3, 'Ce son des vacances !!', '2017-06-13 18:29:56', '☀☀ 🤗 ☀☀\r\nhttps://www.youtube.com/watch?v=5yX6NyhCwAI', '0', 0, 1),
(4, 'Dailymotion &lt;3 (oupa)', '2017-06-13 18:32:53', 'J\'pr&eacute;f&egrave;re &ccedil;a moi perso http://www.dailymotion.com/video/x5g981x', '45', 0, 2),
(5, 'Coucou les IR', '2017-06-13 18:36:37', 'Vous avez choisi la meilleure fii&egrave;re les gars =D', '1', 1, 1),
(7, '🤣 Ahaha 🤣', '2017-06-13 18:43:55', 'Les IR se croient vraiment trop chaud a mettre des liens 🤣😂🤣😂🤣', '0', 0, -2),
(8, 'Notre image de groupe...😉', '2017-06-13 18:44:54', 'Cet aspirateur est vraiment bien trop classe !!!! 😉', '4', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `addresse` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `zipcode` varchar(5) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `birth` date NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `formation` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `connectedTime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT 'default-profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `addresse`, `zipcode`, `town`, `birth`, `phone`, `formation`, `connectedTime`, `profile_pic`) VALUES
(35, 'florian.jaby@uha.fr', '$2y$11$bYkax7VHM3IEhG9pJ8.WeO6BjUK3T6h.1x3ZNTv9w8cDlun8szuaq', 'Florian', 'Jaby', '14 rue jacques preiss', '68100', 'Mulhouse', '1970-01-01', '0640699330', 'IR', 1497363305, 'default-profile.png'),
(36, 'queen@uha.fr', '$2y$11$w4c6XUcgjqYyn6AteI/4oOMBQJiLo8DuW/P/A11fjUQafLvDZ3eXm', 'Elisabeth', 'd\'Angleterre', '', '', '', '1970-01-01', '', 'enseignant', 1497378144, 'default-profile.png'),
(38, 'thibaud.bg@uha.fr', '$2y$11$Hl4jJL8asPOBmMefx2UJF.wsdJ7kedslPo2ab7EZbufq6nREs8H.K', 'Thibaud', 'Gasser', '', '', '', '1970-01-01', '', 'IR', 1497378144, 'default-profile.png'),
(39, 'francois.straebler@uha.fr', '$2y$11$Kw42/uNdTrqTyHhhPX.aD.5byCsHrT33MspW2DXNwWKqdGDVKxR1G', 'François', 'Straebler', '', '', '', '1995-10-24', '', 'IR', 0, 'default-profile.png'),
(40, 'gabin.michalet@uha.fr', '$2y$11$oly.A2ZgfMl9WxzUmj2gSePtHwU58mY53vvQH5LE39iSui7iKeU/a', 'Gabin', 'Michalet', '7 rue des Frères Lumiére', '68350', 'Brunstatt', '1996-03-10', '0652935679', 'IR', 1497373621, '307194206f5a9617de556175f958441e.jpg'),
(43, 'ptitvictor@uha.fr', '$2y$11$ovgIBC/WB9f0moJUxv426eGb8M3ynanAkSJqJEd/rpK0U2TtL4Mo.', 'P\'tit', 'Victor', '', '', '', '1970-01-01', '', 'meca', 1497378145, 'bf3cdac926143e8822babbf482f966d1.jpg'),
(44, 'randomtextile@uha.fr', '$2y$11$82CaOPvSqVh2CCOwegDBh.NcHX8/DIx.IMHrTdrAsnuCbUyAhidcm', 'Personne en', 'Textile', '', '', '', '1970-01-01', '', 'textile', 1497376543, 'default-profile.png'),
(45, 'antoine.benard@uha.fr', '$2y$11$5pfiQ/4dk8ImQ0Y3ZHhDA.qpYFf.2FVnqHPxAGtmpUvF9kTR0IBf2', 'Antoine', 'Bénard', '', '', '', '1970-01-01', '', 'IR', 1497372743, '18dc2096ad81615b330ae7fd4cd7af03.jpg'),
(46, 'bastien.geldreich@uha.fr', '$2y$11$NxJnfVX/FCXS4bQC7Uc4bObPkBNpSd7ZJ7v/YdiYBVhrR6Qr3TjJW', 'Bastien', 'Geldreich', '', '', '', '1970-01-01', '', 'IR', 1497373022, '9ab45237de5e1caf35385382b56d09a2.jpg'),
(47, 'alternant@uha.fr', '$2y$11$qiea7gXifjCc0shJVPhzleSPoBUVVGYJ0inyUMgFFSzt1G4gpZWG.', 'Jenny', 'Productik', '', '', '', '1970-01-01', '', 'FIP', 1497374214, 'default-profile.png'),
(48, 'fadel.hallal@uha.fr', '$2y$11$npqUnFN6Lp0FGymZ1fflMuZnzqmqWjqyQRlCfv.RRpcMK5uQ1uJeW', 'Fadel', 'Hallal', '', '', '', '1970-01-01', '', 'IR', 0, 'default-profile.png'),
(49, 'myriam.invetion@uha.fr', '$2y$11$jj0BUH8RtY1c.pM.F9CF7udKgqQYyQi.ODagRzuepnU9VPxMYFIhK', 'Myriam', 'Textil', '', '', '', '1970-01-01', '', 'textile', 1497373163, '5fab7aa5e2b9a3e97e72a4ebc8cbae86.gif'),
(50, 'meca@uha.fr', '$2y$11$0xKdANgxp9CHhM5.89bz6.sANzcftOnfg1EDtuPOf9Epz0wF77zp2', 'Mikael', 'Nick', '', '', '', '1970-01-01', '', 'meca', 0, 'default-profile.png'),
(51, 'alternant2@uha.fr', '$2y$11$5.W2OEmtYIexQek1.oOEGOwnd3H/90RamPoX.cXWeJarv.QkV5qPS', 'Phillipe', 'Roduc', '', '', '', '1970-01-01', '', 'FIP', 0, 'default-profile.png'),
(52, 'enseignant@uha.fr', '$2y$11$OF21JUAhZUAT50e1jRHpweMEM6CdKZIFb7UiHWdum0pQtU37LrXRa', 'Prof', 'Cool', '', '', '', '1970-01-01', '', 'enseignant', 1497373294, '1a52c76948540de006861659f22353bb.jpg'),
(53, 'persouha@uha.fr', '$2y$11$k3SENviVe1nCKWHVUITjHe7Gr2UCK1DiN9w0OkpXXSkPuA0wdBmBK', 'Technicien', 'Kirépartou', '', '', '', '1970-01-01', '', 'personnelUha', 1497373838, '3c9c6a284e7b7b5962216afe82b5bd70.gif'),
(54, 'as1@uha.fr', '$2y$11$KmIKhfcpweprZf8MaMnXy.p2ELP8fGEfdd9O7z0MgLH3sxf4avePC', 'Robin', 'Minimoys', '', '', '', '1970-01-01', '', 'AS', 1497372950, 'a94fcc1697eca52318123d79af06e494.jpg'),
(55, 'as2@uha.fr', '$2y$11$P79l2fNq.DP5Dvexn7cA3Od8iV8ESKtg/wP287wXO418FiUphH.o6', 'Joto', 'Syst', '', '', '', '1970-01-01', '', 'AS', 0, 'default-profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `iduser` int(11) NOT NULL,
  `idnews` int(11) NOT NULL,
  `pk_vote` int(11) NOT NULL,
  `vote` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`iduser`, `idnews`, `pk_vote`, `vote`) VALUES
(49, 7, 1, 0),
(52, 4, 2, 1),
(40, 4, 3, 1),
(40, 3, 4, 1),
(40, 7, 5, 0),
(40, 5, 6, 1);

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
-- Indexes for table `chatgeneral`
--
ALTER TABLE `chatgeneral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idgroup` (`idgroup`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_recipient` (`id_recipient`);

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
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`pk_vote`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idnews` (`idnews`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorcomment`
--
ALTER TABLE `authorcomment`
  MODIFY `pk_authorcomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `authornews`
--
ALTER TABLE `authornews`
  MODIFY `pk_authornews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `chatgeneral`
--
ALTER TABLE `chatgeneral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `newscomment`
--
ALTER TABLE `newscomment`
  MODIFY `pk_newscomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `pk_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorcomment`
--
ALTER TABLE `authorcomment`
  ADD CONSTRAINT `fk_comment` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authornews`
--
ALTER TABLE `authornews`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`authorid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newsfeed` FOREIGN KEY (`newsfeedid`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`idgroup`) REFERENCES `groupe` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_recipient`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `newscomment`
--
ALTER TABLE `newscomment`
  ADD CONSTRAINT `fk_news` FOREIGN KEY (`newsfeedid`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_newscomment` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`idnews`) REFERENCES `newsfeed` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
