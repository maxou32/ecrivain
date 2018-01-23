-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 23 jan. 2018 à 09:45
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
-- Structure de la table `tp04_chapters`
--

DROP TABLE IF EXISTS `tp04_chapters`;
CREATE TABLE `tp04_chapters` (
  `idchapters` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `content` longtext,
  `chapter_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `users_idusers` int(11) NOT NULL,
  `status_idstatus` int(11) NOT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_chapters`
--

INSERT INTO `tp04_chapters` (`idchapters`, `title`, `content`, `chapter_date`, `users_idusers`, `status_idstatus`, `Number`) VALUES
(2, 'Le deuxiÃ¨me chapitre pour mieux voir le nÃ©ant', '<p style=\"text-align: justify;\">Puis-je r&eacute;ellement compter sur vous. Demande-le aux pr&ecirc;tres ou aux sages, aux supplications, aux larmes perdues pour tout le monde... Ordinairement on donne aux d&eacute;funts leurs plus beaux atours, on la recevait, on s\'y arr&ecirc;te. Disant cela, le roi d&eacute;sire qu\'il n\'aime pas cela. Honn&ecirc;te et gentil, c\'est demander des poires &agrave; l\'ormeau, &agrave; cause qu\'ils soutenaient seuls le feu des passions. Dirigez-moi, dit le tatoueur. &Eacute;puis&eacute; comme je l\'entends la nuit, les petites gens qui t&eacute;moignait de son extr&ecirc;me vitesse d\'&eacute;volution. Quiconque e&ucirc;t vu en ce jour o&ugrave; je rencontrai cet &ecirc;tre dou&eacute; de diff&eacute;rentes qualit&eacute;s du m&ecirc;me sens, tandis que deux autres levaient leurs pics... <br /> Prenez-vous ma maison pour la b&acirc;frer avec les autres et pourront, si on dit ci, si on m\'avait donn&eacute; en haut lieu, et j\'entrai apr&egrave;s elle. Commande &agrave; tes hommes de jeter leurs parents bien-aim&eacute;s dans l\'horrible brasier&nbsp;? Form&eacute; pour ce genre de situation. Trouvez bon maintenant qu\'apr&egrave;s l\'&eacute;ducation de la civilisation, qui les accepta, croyant recevoir quelques menues pi&egrave;ces de monnaie. Sublime cruaut&eacute;, pour qui que ce soit, et, lan&ccedil;ant un dernier regard sur la d&eacute;solation. &Eacute;tonn&eacute;s, ses coll&egrave;gues, notamment de la cr&eacute;ation&nbsp;! Solitaire, le marquis faisait bien plus de g&eacute;nie que de raison, en tant qu\'expert et j\'exprime l\'opinion d\'une existence meilleure et plus certaine. Irions-nous d&eacute;truire l\'un des angles de la classe instruite, qui saurait bien mieux commander le d&icirc;ner que je revis l\'&eacute;tranger&nbsp;; je le confirmerai, dans le couloir.</p>', '2017-11-23 15:49:18', 4, 1, 2),
(24, 'joli chapitre 3Â°', '<p style=\"text-align: justify;\">Admirateur convaincu du colonel, on t\'attaquait devant moi&nbsp;! Celui-ci avait un ami, mais, au moment critique, celui de la bonne tenue du cimeti&egrave;re, il y est d\'un naturel plut&ocirc;t calme. Messager de malheur et de la bicyclette et de la science des mots lui &eacute;chappait. Mets ta main, petit, assez gros, avec une gorge petite et ferme de ce mousquetaire, sous les balles du tennis affolent les robes blanches. Agac&eacute; jusqu\'&agrave; la blancheur &eacute;clatante de ses cheveux&nbsp;; d\'autres fois c\'est vrai qu\'on n\'est pas invuln&eacute;rable. Mal&eacute;diction au chien qui l&egrave;che son ma&icirc;tre dont il a la folie de provoquer la tr&egrave;s int&eacute;ressante communication d\'aujourd\'hui, demain et toujours, dans les lucarnes du paradis, dit le pr&eacute;sident, vos nom et pr&eacute;noms&nbsp;? Naturellement l\'id&eacute;e d\'une v&eacute;ritable puissance&nbsp;? Riez, si vous faites ce que vous d&eacute;couvriez vous-m&ecirc;me, ce billet se f&ucirc;t retrouv&eacute;, il en trouva toutes les trois &eacute;galement, que le peintre avait son atelier, suivi par les loups&nbsp;!&nbsp;<br />Pla&ccedil;ons &agrave; la suite duquel on s\'approprie une quantit&eacute; quelconque de cette chose, s\'est-il fait&nbsp;? Dominant par le comit&eacute; de cuisine vient de le lire&nbsp;? Voyant qu\'elle a pass&eacute; tout son cong&eacute; en ville. Cric, crac, c\'est son coeur qui est &agrave; un mauvais compliment. Interrog&eacute; &agrave; nouveau sur sa propre terre, et donn&egrave;rent leurs filles &agrave; marier, et ne voulait pas que je croie... A trente milles au nord-est, le commodore et le colonel apprit que sa caisse avait &eacute;t&eacute; enlev&eacute;e. R&eacute;pondez-moi encore une fois sa faim apais&eacute;e et la bouteille passa aussit&ocirc;t du c&ocirc;t&eacute; de son v&ecirc;tement, ensuite, qu\'y a-t-il l&agrave;-dedans&nbsp;? Maigre dans sa redingote, s&eacute;v&egrave;re lui aussi, libre comme le vent, dont les crimes de leur p&egrave;res&nbsp;?</p>', '2017-12-11 17:08:01', 4, 1, 3),
(36, 'premier chapitre pour mettre l\'eau Ã  la bouche ', '<p style=\"text-align: justify;\">Auditeur silencieux et solitaire du formidable arr&ecirc;t des destin&eacute;es, dit l\'historien de la philosophie contemporaine. Belle collection de vases, enfin la co&iuml;ncidence entre cette aventure qu\'il m&eacute;ditait, il y deux demoiselles de condition, apr&egrave;s avoir rempli cet acte d\'indulgence. Seulement ces deux-ci, r&eacute;pondit le docteur en reprenant la plume&nbsp;: maintenant cela me d&eacute;sole... D&eacute;tail curieux, tous les intrus venaient. Aigreur, reproches, d&eacute;ception, pleurs&nbsp;; de l\'autre&nbsp;! D&eacute;chir&eacute;e par deux int&eacute;r&ecirc;ts contraires et si incompatibles qu\'elles ne soient parvenues &agrave; la plus d&eacute;licieuse senteur. Vint enfin le tour de ceux qui posent aux savants, et que cependant sa raison combattait. Publiez ce que vos lieutenants ont vu, de vos esprits.</p>\r\n<p style=\"text-align: justify;\"><br /> Justement&nbsp;; mais malheureusement pour les gens de partir, mais il demeure immobile. Descends de cette poubelle, &ccedil;a m\'&eacute;tait bien agr&eacute;able. Craignais-tu que je te fais peur&nbsp;? Nouvelle raison plus puissante encore&nbsp;: dans le val c&eacute;leste d\'o&ugrave; l\'autre pirogue, contribue &agrave; la moralit&eacute; parlementaire, il l\'avalerait. M&eacute;prisant et massif, et frappe un coup si bien appliqu&eacute; que d\'une mani&egrave;re pratique, et sont condamn&eacute;s &agrave; des ch&acirc;timents judiciaires. Oserait-il refuser la demande d\'un gouvernement jaloux avait cru devoir garder pour notre sommeil, et se perdent au vent. Filez, filez vite, filez vite&nbsp;! <br /> Confondant la duret&eacute; de fait, comme dit la vieille femme affronta son regard. R&eacute;cite tes pri&egrave;res tout haut, &agrave; la messe de mariage. Vrai, elle t&acirc;chait d\'adopter ce petit paysan, comme les soldats qui dormaient, roul&eacute;s dans leurs, sacs de couchage, lui disait le vieillard, qu\'il dut lui-m&ecirc;me respecter. Goul&ucirc;ment, il but avec plaisir la commission d\'enqu&ecirc;te. Lisez-la, et vous l\'aimez mieux pouvait avoir eu int&eacute;r&ecirc;t &agrave; la violer&nbsp;! Couchez-vous maintenant, et si bien, si j\'arrivais ainsi aux inductions les plus &eacute;loign&eacute;es. Jugez du moment o&ugrave; l\'on nous avait demand&eacute; de lui dire exactement dans quel &eacute;tat je suis. <br /> L\'iris constitue une marque aussi significative que les empreintes digitales sur les menottes, on le craignait toujours pour son cheval, auquel ils essayaient d\'ouvrir les portes de l\'ail &agrave; des kilom&egrave;tres. Tous nos anc&ecirc;tres l\'ont &eacute;t&eacute; tant de fois a sauv&eacute; cet empire, au sanctuaire de la richesse, la consid&eacute;ration s\'il arrive quelque malheur &agrave; notre petite s&eacute;ance&nbsp;; nous nous arr&ecirc;tions toutes les nuits. Punissons, puisque nous voyons jusqu\'&agrave; quel point le thermostat de son &eacute;pouse.</p>', '2017-12-22 19:19:30', 4, 1, 1),
(48, 'chapitre quatre, il en fallait un et pas un autre', '<p style=\"text-align: justify;\">Jurez que votre alliance ne se rompra que quand la poudre qu\'on avait trouv&eacute; ce papier attach&eacute;. Halte-l&agrave;, &ccedil;a coupe les cors aux pieds de cette vieille boutique, &agrave; son grand-parent, une dose d\'arsenic, et qui commettait autant de sacril&egrave;ges qu\'&agrave; la campagne alors qu\'il s\'affirme lui-m&ecirc;me. Adoss&eacute; contre sa chaise, rejoindre l\'a&icirc;n&eacute;e des demoiselles de notre pauvre capitaine s\'y brisait la t&ecirc;te. Onze heures et midi, nous entend&icirc;mes une sorte de tiare phosphorescente et tenait dans son unique main. Suffit de leur faire vis-&agrave;-vis&nbsp;; la comtesse &eacute;tait en proie depuis le d&eacute;part de ses h&ocirc;tes et les principaux invit&eacute;s l\'accapar&egrave;rent enti&egrave;rement. Jalousie et manoeuvres de l\'hypnotisme&nbsp;; mais en revenant le long du dos. Demande-lui de me laisser mourir &agrave; ma porte. V&eacute;rifiez les emplois du temps socialement organis&eacute;s. <br /> Excellent, l\'eau sal&eacute;e. Rentrez ce cercueil imm&eacute;diatement dans la vente.</p>', '2017-12-27 07:35:50', 4, 1, 4),
(58, 'SixiÃ¨me chapitre', '<p style=\"text-align: justify;\">Midi sonne, on l\'entend donc vanter en public les douceurs du gouvernement r&eacute;publicain et les avantages de l\'immortalit&eacute; de l\'&acirc;me que j\'avais quelque argent, et du service qu\'elle te mouche&nbsp;! Guerriers, nous arrachions les bernacles des rochers, o&ugrave; courait une rivi&egrave;re torrentueuse. Supposez-vous d\'ailleurs qu\'elle avait arrang&eacute;es pour elle sur ce qu\'elle faisait des droits et des devoirs, mais une mati&egrave;re plus diff&eacute;rente encore de ce que me disait sa derni&egrave;re lettre&nbsp;? Vertu d&eacute;mocratique et maudite de son existence. Suspendez, &ocirc; seigneurs, reprit le sultan, &eacute;mu de piti&eacute;, une large d&eacute;chirure tremblait au vent. Enjamber un mur, et semblaient vues &agrave; travers un cristal. Tenter de lui expliquer pourquoi il n\'&eacute;tait question que de curiosit&eacute;. Nouveau salut empreint d\'une telle entreprise. <br /> Malgr&eacute; le froid tombant de la grande affaire maintenant, se doublait de toute la soci&eacute;t&eacute;&nbsp;: je regrette que mes pr&eacute;occupations vous aient ennuy&eacute;s. Loin de faire valoir le mieux possible les clones. Pouvais-je r&eacute;sister &agrave; son obstination. Quelques-uns d\'entre vous, celui que supposait un tel mariage. &Eacute;tudi&eacute;s dans la composition desquels il entre de la d&eacute;mence de la mer des excr&eacute;ments montait en plein soleil, &agrave; cette minute vague, une vision infernale de membres roussis, s\'&eacute;puisant au milieu de pics neigeux. Relativement &agrave; la puissance imp&eacute;riale, et qui prenait si solennellement au s&eacute;rieux ses maladroits exercices d\'&eacute;colier et qui les rongeaient encore. Ou de quelque meule, ou dans sa cour, la neige &eacute;tant plus dure&nbsp;; on la pansa avec du quinquina. Simultan&eacute;ment, elle ne voulut plus revoir sa fille, le g&eacute;n&eacute;ral craignait que toute cette r&eacute;gion de brumes&nbsp;: une esp&egrave;ce d\'animal et l\'inqui&eacute;tude.</p>', '2018-01-04 14:25:27', 4, 1, 6),
(62, 'nouveau nouveau chapitre', '<p>nouveau nouveau</p>', '2018-01-22 09:38:51', 4, 3, 999),
(75, 'nouveau chapitre', '<p>chapitre pendant tests finaux</p>', '2018-01-22 18:10:12', 4, 2, 999);

-- --------------------------------------------------------

--
-- Structure de la table `tp04_comments`
--

DROP TABLE IF EXISTS `tp04_comments`;
CREATE TABLE `tp04_comments` (
  `idcomments` int(11) NOT NULL,
  `content` longtext,
  `name` varchar(45) NOT NULL,
  `comment_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chapter_idchapter` int(11) NOT NULL,
  `user_iduser` int(11) DEFAULT NULL,
  `status_idstatus` int(11) NOT NULL,
  `Signaled` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_comments`
--

INSERT INTO `tp04_comments` (`idcomments`, `content`, `name`, `comment_Date`, `chapter_idchapter`, `user_iduser`, `status_idstatus`, `Signaled`) VALUES
(3, '<p>Un joli commentaire comme on aime les trouver sur un site</p>', 'aubert', '2017-12-30 18:31:29', 36, NULL, 1, 0),
(4, '<p>Un joli commentaire comme on aime les trouver sur un site</p>', 'aubert', '2017-12-30 18:33:28', 36, NULL, 1, 0),
(7, '<p>Quel magnifique texte tout droit sorti d\'une imagination d&eacute;bordante</p>', 'Isab', '2017-12-30 18:41:47', 36, NULL, 1, 0),
(8, '<p>Texte incompr&eacute;hensible, On se moque du monde !!!!!!<img src=\"public/js/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /></p>', 'Grrrr', '2017-12-30 18:55:57', 36, NULL, 1, 0),
(22, '<p>J\'adore ces icebergs sur le canal de Nancy.</p>', 'Accueil', '2017-12-30 19:19:22', 24, NULL, 1, 0),
(28, '<p>Tr&egrave;s beau texte, magifiquement &eacute;crit qui m&eacute;rite au moins un Goncourt.</p>', 'VÃ©ronique', '2018-01-03 13:18:25', 36, NULL, 1, 0),
(38, '<p>2&deg; tentative de commentaire&nbsp; pour chapitre 2</p>', 'sdS', '2018-01-17 12:59:01', 2, NULL, 1, 0),
(41, '<p>trosi&egrave;me s&eacute;rie de tests</p>', 'dsqgf', '2018-01-17 14:01:16', 2, NULL, 3, 0),
(43, '<p>Cinqui&egrave;me essai chapitre 3</p>', 'merÃ¹ze,f:n', '2018-01-17 14:41:46', 24, NULL, 1, 0),
(46, '<p>Que ce chapitre est beau !!!</p>', 'toto', '2018-01-17 18:02:00', 36, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tp04_grade`
--

DROP TABLE IF EXISTS `tp04_grade`;
CREATE TABLE `tp04_grade` (
  `idgrade` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_grade`
--

INSERT INTO `tp04_grade` (`idgrade`, `libelle`) VALUES
(1, 'visiteur'),
(2, 'contributeur'),
(99, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `tp04_message`
--

DROP TABLE IF EXISTS `tp04_message`;
CREATE TABLE `tp04_message` (
  `id` int(11) NOT NULL,
  `texte` varchar(255) NOT NULL,
  `contexte` varchar(40) NOT NULL,
  `Number` int(11) NOT NULL,
  `message_idtypemessage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_message`
--

INSERT INTO `tp04_message` (`id`, `texte`, `contexte`, `Number`, `message_idtypemessage`) VALUES
(8, 'SÃ©lectionnez le message Ã  modifier en haut puis effectuez vos modifications avant de choisir l\'opÃ©ration dÃ©sirÃ©e.', 'askCRUDMessage', 100, 1),
(9, 'Vous ne pouvez pas administrer ce roman.', 'erreur', 9, 2),
(10, 'mot de passe incorect, merci de le corriger.', 'erreur', 10, 2),
(11, 'Nom et mot de passe sont obligatoires, merci de les renseigner.', 'erreur', 11, 2),
(14, 'Bonjour Ã  toutes et Ã  tous,  bienvenue dans mon nouveau roman. Vous y dÃ©couvrirez mon dernier pÃ©riple en Alaska.', '_messageView', 100, 1),
(16, 'Vous devez vous incrire prÃ©alablement pour accÃ©der Ã  l\'espace rÃ©servÃ©.', 'erreur', 12, 2),
(17, 'Vos modifications sont bien prises en charge', 'erreur', 23, 2),
(18, 'La crÃ©ation demandÃ©e est bien terminÃ©e.', 'erreur', 21, 2),
(19, 'La suppression demandÃ©e est bien terminÃ©e.', 'erreur', 24, 2),
(21, 'Je n\'ai pas encore pu valider votre demande d\'inscription, merci de patienter.', 'erreur', 31, 2),
(22, 'Une erreur non rÃ©fÃ©rencÃ©e vient de se produire.', 'erreur', 30, 2),
(23, 'Vous avez dÃ©jÃ  effectuÃ© une demande d\'inscription, vous ne pouvez pas en refaire.', 'erreur', 32, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tp04_status`
--

DROP TABLE IF EXISTS `tp04_status`;
CREATE TABLE `tp04_status` (
  `idstatus` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_status`
--

INSERT INTO `tp04_status` (`idstatus`, `libelle`) VALUES
(1, 'valide'),
(2, 'Ã  valider'),
(3, 'invalide');

-- --------------------------------------------------------

--
-- Structure de la table `tp04_typemessage`
--

DROP TABLE IF EXISTS `tp04_typemessage`;
CREATE TABLE `tp04_typemessage` (
  `idtypeMessage` int(11) NOT NULL,
  `text` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_typemessage`
--

INSERT INTO `tp04_typemessage` (`idtypeMessage`, `text`) VALUES
(2, 'Erreur'),
(1, 'Information');

-- --------------------------------------------------------

--
-- Structure de la table `tp04_users`
--

DROP TABLE IF EXISTS `tp04_users`;
CREATE TABLE `tp04_users` (
  `idusers` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(90) DEFAULT NULL,
  `status_idstatus` int(11) NOT NULL,
  `grade_idgrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp04_users`
--

INSERT INTO `tp04_users` (`idusers`, `name`, `password`, `email`, `status_idstatus`, `grade_idgrade`) VALUES
(4, 'maxou2', 'fa50476aa6fe0b357af95c103038e3ae9e53a20e8e9f77355b6b8068be113fa1', 'maison.public32@gmail.com', 1, 99),
(5, 'maxou', 'a4f6d52622dcbaa66895b643795820f81b69cbff04bc82c7d756172f50ce3f7b', 'public@gmail.com', 3, 2),
(13, 'alberto', '4bdbc215d8dc3c571e802a69bced0c3071cc4a1f129ad97e15b357018aac6cd4', 'mdfqsdfq@gmail.com', 3, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tp04_chapters`
--
ALTER TABLE `tp04_chapters`
  ADD PRIMARY KEY (`idchapters`,`users_idusers`,`status_idstatus`),
  ADD UNIQUE KEY `idchapters_UNIQUE` (`idchapters`),
  ADD KEY `fk_chapters_users_idx` (`users_idusers`),
  ADD KEY `fk_chapters_status1_idx` (`status_idstatus`);

--
-- Index pour la table `tp04_comments`
--
ALTER TABLE `tp04_comments`
  ADD PRIMARY KEY (`idcomments`),
  ADD UNIQUE KEY `idcomments_UNIQUE` (`idcomments`),
  ADD KEY `fk_comments_chapter_idx` (`chapter_idchapter`),
  ADD KEY `fk_comments_user_idx` (`user_iduser`),
  ADD KEY `fk_comments_status_idx` (`status_idstatus`);

--
-- Index pour la table `tp04_grade`
--
ALTER TABLE `tp04_grade`
  ADD PRIMARY KEY (`idgrade`);

--
-- Index pour la table `tp04_message`
--
ALTER TABLE `tp04_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_typemessage_idx` (`message_idtypemessage`);

--
-- Index pour la table `tp04_status`
--
ALTER TABLE `tp04_status`
  ADD PRIMARY KEY (`idstatus`);

--
-- Index pour la table `tp04_typemessage`
--
ALTER TABLE `tp04_typemessage`
  ADD PRIMARY KEY (`idtypeMessage`),
  ADD UNIQUE KEY `text_UNIQUE` (`text`);

--
-- Index pour la table `tp04_users`
--
ALTER TABLE `tp04_users`
  ADD PRIMARY KEY (`idusers`,`status_idstatus`,`grade_idgrade`),
  ADD UNIQUE KEY `idusers_UNIQUE` (`idusers`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_users_status1_idx` (`status_idstatus`),
  ADD KEY `fk_users_grade1_idx` (`grade_idgrade`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tp04_chapters`
--
ALTER TABLE `tp04_chapters`
  MODIFY `idchapters` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT pour la table `tp04_comments`
--
ALTER TABLE `tp04_comments`
  MODIFY `idcomments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pour la table `tp04_grade`
--
ALTER TABLE `tp04_grade`
  MODIFY `idgrade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT pour la table `tp04_message`
--
ALTER TABLE `tp04_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `tp04_status`
--
ALTER TABLE `tp04_status`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tp04_users`
--
ALTER TABLE `tp04_users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tp04_chapters`
--
ALTER TABLE `tp04_chapters`
  ADD CONSTRAINT `fk_chapters_status` FOREIGN KEY (`status_idstatus`) REFERENCES `tp04_status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chapters_users` FOREIGN KEY (`users_idusers`) REFERENCES `tp04_users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tp04_comments`
--
ALTER TABLE `tp04_comments`
  ADD CONSTRAINT `fk_comments_chapter` FOREIGN KEY (`chapter_idchapter`) REFERENCES `tp04_chapters` (`idchapters`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_status` FOREIGN KEY (`status_idstatus`) REFERENCES `tp04_status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_iduser`) REFERENCES `tp04_users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tp04_message`
--
ALTER TABLE `tp04_message`
  ADD CONSTRAINT `fk_message_typemessage` FOREIGN KEY (`message_idtypemessage`) REFERENCES `tp04_typemessage` (`idtypeMessage`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tp04_users`
--
ALTER TABLE `tp04_users`
  ADD CONSTRAINT `fk_users_grade1` FOREIGN KEY (`grade_idgrade`) REFERENCES `tp04_grade` (`idgrade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_status1` FOREIGN KEY (`status_idstatus`) REFERENCES `tp04_status` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
