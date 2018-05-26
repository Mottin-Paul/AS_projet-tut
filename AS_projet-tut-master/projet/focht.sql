-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2018 at 05:47 PM
-- Server version: 5.5.47-0+deb8u1
-- PHP Version: 7.0.4-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focht`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`focht`@`%` PROCEDURE `chiffreAge` (OUT `p_min` INT, OUT `p_moy` INT, OUT `p_max` INT)  BEGIN

SELECT MIN( age ) , AVG( age ) , MAX( age ) INTO p_min, p_moy, p_max
FROM utilisateur;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `Insert_temps_reponse_1` (IN `num_personne` INT)  BEGIN

SET @Temps_total = 
(SELECT timediff(temps_rep, temps_debut_utilisateur)
FROM reponse
JOIN appartient on appartient.id_reponse = reponse.id_reponse
JOIN jeux on jeux.id_questionnaire = appartient.id_questionnaire
WHERE appartient.id_personne = num_personne 
AND reponse.id_reponse in (SELECT MAX(id_reponse) FROM reponse));

UPDATE reponse SET Temps_prit_rep = @Temps_total
WHERE Temps_prit_rep IS null;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `Insert_temps_reponse_autre` (IN `num_personne` INT)  BEGIN

SET @Temps_before = 
(SELECT temps_rep
FROM reponse
WHERE id_reponse in (SELECT MAX(id_reponse) - 1 FROM reponse));

SET @Temps_inserer = 
(SELECT timediff(temps_rep,@Temps_before)
FROM reponse
JOIN appartient on appartient.id_reponse = reponse.id_reponse
JOIN jeux on jeux.id_questionnaire = appartient.id_questionnaire
WHERE appartient.id_personne = num_personne AND reponse.id_reponse in (SELECT MAX(id_reponse) FROM reponse));

UPDATE reponse SET Temps_prit_rep = @Temps_inserer
WHERE Temps_prit_rep IS null;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `Insert_temps_tot` (IN `num_personne` INT)  BEGIN

SET @temps_tot=(
SELECT timediff(temps_rep, temps_debut_utilisateur)
FROM reponse
JOIN appartient on appartient.id_reponse = reponse.id_reponse
JOIN jeux on jeux.id_questionnaire = appartient.id_questionnaire
WHERE appartient.id_personne = num_personne 
AND reponse.id_reponse in (SELECT MAX(id_reponse) FROM reponse));

UPDATE utilisateur SET temps_total = @temps_tot
WHERE utilisateur.id_personne = num_personne ;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `moyNoteAge` (OUT `p_1cat` FLOAT, OUT `p_2cat` FLOAT, OUT `p_3cat` FLOAT, OUT `p_4cat` FLOAT, OUT `p_5cat` FLOAT, OUT `p_6cat` FLOAT)  BEGIN

SELECT AVG(reussite_nota) INTO p_1cat
FROM utilisateur
WHERE age BETWEEN 0 and 17;

SELECT AVG(reussite_nota) INTO p_2cat
FROM utilisateur
WHERE age between 18 and 25;

SELECT AVG(reussite_nota) INTO p_3cat
FROM utilisateur
WHERE age between 26 and 35;

SELECT AVG(reussite_nota) INTO p_4cat
FROM utilisateur
WHERE age between 36 and 50;

SELECT AVG(reussite_nota) INTO p_5cat
FROM utilisateur
WHERE age between 50 and 65;

SELECT AVG(reussite_nota) INTO p_6cat
FROM utilisateur
WHERE age > 65;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `moyReussiteChemin` (IN `v_chemin` INT)  BEGIN

SELECT AVG(reussite_nota)
FROM utilisateur
WHERE id_personne = ( SELECT u.id_personne
FROM utilisateur u
WHERE u.id_personne = utilisateur.id_personne 
AND u.id_personne %4 = v_chemin);

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `moyReussiteNotaJauge` (IN `affi_jauge` INT)  BEGIN

SELECT AVG(reussite_nota)
FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE jauge = affi_jauge; 

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `moyReussiteSexe` (IN `v_sexe` VARCHAR(5))  BEGIN

SELECT sexe, AVG(reussite_nota)
FROM utilisateur
WHERE sexe = v_sexe;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `nbPersParNote` ()  BEGIN

SELECT DISTINCT reussite_nota, COUNT( reussite_nota ) 
FROM utilisateur
GROUP BY reussite_nota;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `nbRegretQuestion` ()  BEGIN

SELECT DISTINCT question.id_question, COUNT( regret ) 
FROM question
JOIN appartient on appartient.id_question = question.id_question
JOIN utilisateur on utilisateur.id_personne = utilisateur.id_personne
where appartient.id_question = regret
GROUP BY regret;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `nbSexe` (IN `p_sexe` VARCHAR(5), OUT `v_sexe` INT)  BEGIN

SELECT COUNT(id_personne) INTO v_sexe
FROM utilisateur
WHERE sexe = p_sexe;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `nbUtilisateurCsp` (IN `p_csp` VARCHAR(20))  BEGIN

SELECT COUNT( csp ) 
FROM utilisateur
WHERE csp = p_csp;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `nbUtilisateurParCsp` ()  BEGIN

SELECT DISTINCT csp, COUNT( csp ) 
FROM utilisateur
GROUP BY csp;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `reussiteChemin` ()  BEGIN

SELECT distinct categorie, reussite, COUNT(DISTINCT id_personne)
FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite != '0'
GROUP BY categorie;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `reussiteJauge` ()  BEGIN

SELECT jauge, reussite, COUNT(DISTINCT id_personne)
FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite != '0'
AND reussite IS NOT NULL
GROUP BY jauge, reussite;

END$$

CREATE DEFINER=`focht`@`%` PROCEDURE `reussiteSexe` ()  BEGIN

SELECT sexe, reussite, COUNT(reussite)
FROM utilisateur
WHERE reussite != '0'
GROUP BY sexe, reussite;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `appartient`
--

CREATE TABLE `appartient` (
  `id_questionnaire` int(11) NOT NULL,
  `id_reponse` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Triggers `appartient`
--
DELIMITER $$
CREATE TRIGGER `Insert_temps_reponse` AFTER INSERT ON `appartient` FOR EACH ROW BEGIN

UPDATE reponse
SET temps_rep = now()
where id_reponse = NEW.id_reponse;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `choix_question`
--

CREATE TABLE `choix_question` (
  `id_choix` int(11) NOT NULL,
  `choix1` varchar(50) DEFAULT NULL,
  `choix2` varchar(50) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choix_question`
--

INSERT INTO `choix_question` (`id_choix`, `choix1`, `choix2`, `id_question`) VALUES
(1, 'Je reporte', 'Je reste', 1),
(2, 'Je partage', 'Je paye', 2),
(3, 'Mentir', 'Vérité', 3),
(4, 'Faire la bise', 'Serrer la main', 4),
(5, 'Vivre ensemble', 'Attendre un peu', 5),
(6, 'Chez votre conjoint', 'Chez vous', 6),
(7, 'Accepter', 'Refuser', 7),
(8, 'Savoir', 'Ne pas savoir', 8),
(9, 'Refuser de choisir', 'Choisir votre partenaire', 9),
(10, 'Vous lui dites la vérité', 'Vous lui dites que ça ne le regarde pas', 10),
(11, 'Mutation', 'Licenciement', 11),
(12, 'Afterwork avec les collègues', 'Dîner avec le partenaire', 12),
(13, 'Votre enfant', 'Le partenaire', 13),
(14, 'Acceptez-vous', 'Refusez-vous', 14),
(15, 'Mariage religieux', 'Non religieux', 15),
(16, 'Mariage en grand comité', 'Mariage en petit comité', 16);

-- --------------------------------------------------------

--
-- Table structure for table `jeux`
--

CREATE TABLE `jeux` (
  `id_questionnaire` int(11) NOT NULL,
  `categorie` int(11) DEFAULT NULL,
  `jauge` int(11) DEFAULT NULL,
  `temps_debut_utilisateur` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `texte` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id_question`, `texte`) VALUES
(1, 'Durant votre premier rendez-vous, votre patron vous appelle pour une urgence au bureau, reporter vous le rendez-vous ?'),
(2, 'À la fin de votre premier rendez-vous le serveur apporte l\'addition, que décidez-vous ?'),
(3, 'Durant la première rencontre avec la famille du conjoint autour d\'un repas ses parents vous pose une question délicates: “dites moi combien de partenaire avez-vous eu avant de rencontrer notre enfants ? “ répondez-vous de manière honnête ou préférez vous mentir ?'),
(4, 'Vous rencontrez la famille de votre conjoint pour la première fois, optez vous pour serrer la main ou faire la bise ?'),
(5, 'Votre conjoint vous propose d\'emménager ensemble, cependant elle a un des ses parents à charge, qui est dépendant physiquement. Acceptez-vous de vivre avec votre conjoint et donc son parent ou refusez vous ?'),
(6, ' Vous discutez avec votre conjoint de franchir une étape, celle de vivre ensemble. La question est qui emménage chez qui ?'),
(7, 'Au cours d’une discussion sur le fait de fonder une famille avec votre conjoint, ce dernier vous manifeste son intention de vouloir adopter un enfant handicapé dans un avenir proche, acceptez-vous ou non ?'),
(8, 'Lors d’une discussion avec votre conjoint sur le fait de fonder une famille, ce dernier vous demande si vous accepteriez de connaître le sexe de votre enfant avant sa naissance.'),
(9, 'Durant une violente dispute avec votre conjoint, il/elle vous reproche que votre meilleur(e) ami(e) est un obstacle à votre vie de couple et vous demande de faire un choix entre l’un des deux, que décidez-vous ?'),
(10, 'Votre conjoint se présente énervé devant vous sans que vous n’en connaissiez la raison. Il se trouve qu’une personne qu’il(elle) ne connait pas vous a envoyé un message contenant des mots doux. Votre conjoint vous donne votre portable en vous demandant qui est cette personne, vous découvrez que c’est votre tante et que vous ne lui aviez jamais parlé d’elle. Comment réagissez-vous ?'),
(11, 'Vous apprenez à votre travail qu’un plan social est en cours. Votre supérieur vous propose une mutation de 3 ans à l’autre bout du monde bien rémunéré, si vous dites non vous êtes licenciés. Que choisissez-vous devant votre conjoint ?'),
(12, 'Vos collègues de travail vous propose un super afterwork le soir même, c’est un bon moyen de se faire remarquer positivement par votre supérieur, cependant vous aviez prévu un dîner avec votre conjoint, que faites-vous ?'),
(13, 'Votre conjoint subit un terrible accident de voiture avec votre enfant. Une seule table d’opération est libre ce qui signifie que la personne que vous choisissez de faire passer en 2ème a de faibles chances de s’en sortir. Qui choisissez-vous de faire passe en 1er ? '),
(14, 'Votre partenaire est cloué(e) au lit en raison d’une vilaine grippe. Elle vous demande de modifier vos horaires de bureau pour aller chercher les enfants lorsque l’école est fini.'),
(15, 'Votre conjoint et vous allez vous marier, cependant une question importante reste en suspens. La famille de votre conjoint est très pieuse et serait extrêmement heureuse d’organiser une cérémonie religieuse, à l’inverse votre famille, totalement anti-religieuse serait très vexé à l’idée de participer à un événement pareil. Que dites-vous à votre conjoint ?'),
(16, 'Votre conjoint et vous allez vous marier, cependant une question importante reste en suspens, la belle-famille est de taille importante ce qui nécessite d’organiser une cérémonie en grand comité, malheureusement vous n’êtes pas très alaise face à autant de monde. Que choisissez-vous ?');

-- --------------------------------------------------------

--
-- Table structure for table `question_difficile`
--

CREATE TABLE `question_difficile` (
  `id_q_d` varchar(25) NOT NULL,
  `id_question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_difficile`
--

INSERT INTO `question_difficile` (`id_q_d`, `id_question`) VALUES
('Q1', 1),
('Q2', 3),
('Q3', 5),
('Q4', 7),
('Q5', 9),
('Q6', 11),
('Q7', 13),
('Q8', 15);

-- --------------------------------------------------------

--
-- Table structure for table `question_facile`
--

CREATE TABLE `question_facile` (
  `id_q_f` varchar(25) NOT NULL,
  `id_question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_facile`
--

INSERT INTO `question_facile` (`id_q_f`, `id_question`) VALUES
('Q1', 2),
('Q2', 4),
('Q3', 6),
('Q4', 8),
('Q5', 10),
('Q6', 12),
('Q7', 14),
('Q8', 16);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `id_reponse` int(11) NOT NULL,
  `reponse` varchar(40) DEFAULT NULL,
  `temps_rep` datetime NOT NULL,
  `temps_prit_rep` varchar(200) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_personne` int(11) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `situation_familliale` varchar(25) DEFAULT NULL,
  `csp` varchar(25) DEFAULT NULL,
  `csp_heure` int(11) DEFAULT NULL,
  `activite` varchar(100) DEFAULT NULL,
  `activite_heure` int(11) DEFAULT NULL,
  `heure_sommeil` int(11) DEFAULT NULL,
  `heure_famille` int(11) DEFAULT NULL,
  `regret` varchar(25) NOT NULL,
  `deci_diff` varchar(25) NOT NULL,
  `reussite` varchar(3) DEFAULT NULL,
  `reussite_nota` int(11) DEFAULT NULL,
  `nombre_enfants` int(11) DEFAULT NULL,
  `temps_total` varchar(200) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`id_questionnaire`,`id_reponse`,`id_question`,`id_personne`),
  ADD KEY `FK_appartient_id_reponse` (`id_reponse`),
  ADD KEY `FK_appartient_id_question` (`id_question`),
  ADD KEY `FK_appartient_id_personne` (`id_personne`);

--
-- Indexes for table `choix_question`
--
ALTER TABLE `choix_question`
  ADD PRIMARY KEY (`id_choix`),
  ADD KEY `FK_choix_question_id_question` (`id_question`);

--
-- Indexes for table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`id_questionnaire`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `question_difficile`
--
ALTER TABLE `question_difficile`
  ADD PRIMARY KEY (`id_q_d`),
  ADD KEY `FK_question_difficile_id_question` (`id_question`);

--
-- Indexes for table `question_facile`
--
ALTER TABLE `question_facile`
  ADD PRIMARY KEY (`id_q_f`),
  ADD KEY `FK_question_facile_id_question` (`id_question`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_reponse`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_personne`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choix_question`
--
ALTER TABLE `choix_question`
  MODIFY `id_choix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id_questionnaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `FK_appartient_id_personne` FOREIGN KEY (`id_personne`) REFERENCES `utilisateur` (`id_personne`),
  ADD CONSTRAINT `FK_appartient_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`),
  ADD CONSTRAINT `FK_appartient_id_questionnaire` FOREIGN KEY (`id_questionnaire`) REFERENCES `jeux` (`id_questionnaire`),
  ADD CONSTRAINT `FK_appartient_id_reponse` FOREIGN KEY (`id_reponse`) REFERENCES `reponse` (`id_reponse`);

--
-- Constraints for table `choix_question`
--
ALTER TABLE `choix_question`
  ADD CONSTRAINT `FK_choix_question_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Constraints for table `question_difficile`
--
ALTER TABLE `question_difficile`
  ADD CONSTRAINT `FK_question_difficile_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Constraints for table `question_facile`
--
ALTER TABLE `question_facile`
  ADD CONSTRAINT `FK_question_facile_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
