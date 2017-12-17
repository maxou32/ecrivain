-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 07 déc. 2017 à 19:00
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
-- Base de données :  `ecrivain`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

CREATE TABLE `chapters` (
  `idchapters` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `resume` mediumtext,
  `content` longtext,
  `chapter_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `users_idusers` int(11) NOT NULL,
  `status_idstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapters`
--

INSERT INTO `chapters` (`idchapters`, `title`, `resume`, `content`, `chapter_date`, `users_idusers`, `status_idstatus`) VALUES
(1, 'Mon premier chapitre', 'le rÃ©sumÃ© de mon premier chapitre', 'Mon premier chapitre est le premier de tous les premiers', '2017-11-23 15:49:17', 5, 1),
(2, 'Le deuxiÃ¨me chapitre', 'Le rÃ©sumÃ© du deuxiÃ¨me chapitre palpitant', 'Le deuxiÃ¨me chapitre plante le dÃ©cors et reprend une forme sympathique.', '2017-11-23 15:49:18', 5, 2),
(3, 'le quatriÃ¨me chapitre', 'le rÃ©sumÃ© du quatriÃ¨me chapitre>', 'le quatriÃ¨me chapitre est le plus beau de tous les quatriÃ¨me chapitre>', '2017-11-28 15:53:47', 5, 1),
(5, 'le cinquiÃ¨me', 'le rÃ©sumÃ© du cinquiÃ¨me chapitre', 'le cinquiÃ¨me chapitre est encore meilleur que les 4 autres.', '2017-11-28 15:55:00', 5, 1),
(17, 'a', 'b', 'c', '2017-12-06 18:04:26', 5, 2),
(18, 'A1', 'B1', 'C1', '2017-12-06 18:05:27', 5, 2),
(19, '<sdf<sdf', 'b', 'c', '2017-12-07 14:08:24', 5, 2),
(20, 'dernier chapitre', 'le dernier', 'le dernier contenu', '2017-12-07 14:09:01', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `chapter_valide_view`
--

CREATE TABLE `chapter_valide_view` (
  `idchapters` int(11) DEFAULT NULL,
  `title` int(11) DEFAULT NULL,
  `resume` int(11) DEFAULT NULL,
  `content` int(11) DEFAULT NULL,
  `chapter_date` int(11) DEFAULT NULL,
  `users_idusers` int(11) DEFAULT NULL,
  `status_idstatus` int(11) DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL,
  `email` int(11) DEFAULT NULL,
  `grade_idgrade` int(11) DEFAULT NULL,
  `idstatus` int(11) DEFAULT NULL,
  `libelle` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `idcomments` int(11) NOT NULL,
  `content` mediumtext,
  `status_idstatus` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  `users_status_idstatus` int(11) NOT NULL,
  `users_grade_idgrade` int(11) NOT NULL,
  `chapters_idchapters` int(11) NOT NULL,
  `chapters_users_idusers` int(11) NOT NULL,
  `chapters_status_idstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

CREATE TABLE `grade` (
  `idgrade` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `grade`
--

INSERT INTO `grade` (`idgrade`, `libelle`) VALUES
(2, 'contributeur'),
(99, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `idstatus` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`idstatus`, `libelle`) VALUES
(1, 'valide'),
(2, 'à valider'),
(3, 'invalide');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(90) DEFAULT NULL,
  `status_idstatus` int(11) NOT NULL,
  `grade_idgrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idusers`, `name`, `password`, `email`, `status_idstatus`, `grade_idgrade`) VALUES
(4, 'maxou2', '0a1c643a4b76c377b5d82dcf4e42c968834cfae848c3b1e73e3b2cffebceeffb', 'max.public32@gmail.com', 2, 2),
(5, 'maxou', '3757e870d02871031037f264612886f27ac14847ef7f2b07874cea87d6ac7c5f', 'maxou@cabinet-ecriture.fr', 1, 99),
(6, 'cante', '9c75e4d30c06117cef345084d394cb2c3df8d64341921413a137087f5007ac87', 'max.public32@gmail.com', 1, 2),
(7, 'tototo', 'ac0d51a6ddcd7fd9b005036c58fd99ce5f83ac59219c75648bcbb0375a727025', 'maxou@maxou.fr', 1, 2),
(11, 'albert', '72d0166b5707d129dc321e56692fe454c034552ee9e2b38f5a7f1c1306a632ea', 'albert@albert.moi', 1, 2),
(12, 'albert 2', 'dfcbf382e4c2576d54073a26043fd0e76f155e0f889e2e116d72a3ea0c0dd94a', 'albert@albert.moi', 1, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`idchapters`,`users_idusers`,`status_idstatus`),
  ADD UNIQUE KEY `idchapters_UNIQUE` (`idchapters`),
  ADD KEY `fk_chapters_users_idx` (`users_idusers`),
  ADD KEY `fk_chapters_status1_idx` (`status_idstatus`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idcomments`,`status_idstatus`,`users_idusers`,`users_status_idstatus`,`users_grade_idgrade`,`chapters_idchapters`,`chapters_users_idusers`,`chapters_status_idstatus`),
  ADD KEY `fk_comments_status1_idx` (`status_idstatus`),
  ADD KEY `fk_comments_users1_idx` (`users_idusers`,`users_status_idstatus`,`users_grade_idgrade`),
  ADD KEY `fk_comments_chapters1_idx` (`chapters_idchapters`,`chapters_users_idusers`,`chapters_status_idstatus`);

--
-- Index pour la table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`idgrade`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idstatus`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`,`status_idstatus`,`grade_idgrade`),
  ADD UNIQUE KEY `idusers_UNIQUE` (`idusers`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_users_status1_idx` (`status_idstatus`),
  ADD KEY `fk_users_grade1_idx` (`grade_idgrade`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `idchapters` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `idcomments` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `grade`
--
ALTER TABLE `grade`
  MODIFY `idgrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `fk_chapters_status1` FOREIGN KEY (`status_idstatus`) REFERENCES `status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chapters_users` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_chapters1` FOREIGN KEY (`chapters_idchapters`,`chapters_users_idusers`,`chapters_status_idstatus`) REFERENCES `chapters` (`idchapters`, `users_idusers`, `status_idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_status1` FOREIGN KEY (`status_idstatus`) REFERENCES `status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_idusers`,`users_status_idstatus`,`users_grade_idgrade`) REFERENCES `users` (`idusers`, `status_idstatus`, `grade_idgrade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_grade1` FOREIGN KEY (`grade_idgrade`) REFERENCES `grade` (`idgrade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_status1` FOREIGN KEY (`status_idstatus`) REFERENCES `status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
