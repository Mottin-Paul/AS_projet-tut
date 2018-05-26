-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 12 Mai 2018 à 13:03
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `info`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `chiffreAge`(OUT p_min INT, OUT p_moy INT, OUT p_max INT)
BEGIN

SELECT MIN( age ) , AVG( age ) , MAX( age ) INTO p_min, p_moy, p_max
FROM utilisateur;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_temps_reponse_1`(IN num_personne INT)
BEGIN

SET @Temps_total = 
(SELECT timediff(temps_rep, temps_debut_utilisateur)
FROM reponse
JOIN appartient on appartient.id_reponse = reponse.id_reponse
JOIN jeux on jeux.id_questionnaire = appartient.id_questionnaire
WHERE appartient.id_personne = num_personne AND reponse.id_reponse in (SELECT MAX(id_reponse) FROM reponse));

UPDATE reponse SET Temps_prit_rep = @Temps_total
WHERE Temps_prit_rep IS null;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_temps_reponse_autre`(IN num_personne INT)
BEGIN

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_temps_tot`(IN num_personne INT)
BEGIN

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `moyNoteAge`(OUT p_1cat FLOAT, OUT p_2cat FLOAT, OUT p_3cat FLOAT, OUT p_4cat FLOAT, OUT p_5cat FLOAT, OUT p_6cat FLOAT)
BEGIN

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `moyReussiteChemin`( IN v_chemin INT)
BEGIN

SELECT AVG(reussite_nota)
FROM utilisateur
WHERE id_personne = ( SELECT u.id_personne
FROM utilisateur u
WHERE u.id_personne = utilisateur.id_personne 
AND u.id_personne %4 = v_chemin);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `moyReussiteNotaJauge`(IN affi_jauge INT)
BEGIN

SELECT AVG(reussite_nota)
FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE jauge = affi_jauge; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `moyReussiteSexe`( IN v_sexe VARCHAR(5))
BEGIN

SELECT sexe, AVG(reussite_nota)
FROM utilisateur
WHERE sexe = v_sexe;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nbPersParNote`()
BEGIN

SELECT DISTINCT reussite_nota, COUNT( reussite_nota ) 
FROM utilisateur
GROUP BY reussite_nota;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nbRegretQuestion`()
BEGIN

SELECT DISTINCT id_question, COUNT( regret ) 
FROM question
JOIN appartient on appartient.id_question = question.id_question
JOIN utilisateur on utilisateur.id_personne = utilisateur.id_personne
where id_question = regret
GROUP BY regret;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nbSexe`(IN p_sexe VARCHAR(5))
BEGIN

SELECT COUNT(id_personne)
FROM utilisateur
WHERE sexe = p_sexe;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nbUtilisateur`()
BEGIN

SELECT COUNT( id_personne ) 
FROM utilisateur;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nbUtilisateurCsp`(IN p_csp VARCHAR(20))
BEGIN

SELECT COUNT( csp ) 
FROM utilisateur
WHERE csp = p_csp;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nbUtilisateurParCsp`()
BEGIN

SELECT DISTINCT csp, COUNT( csp ) 
FROM utilisateur
GROUP BY csp;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reussiteChemin`()
BEGIN

SELECT categorie, reussite, COUNT(reussite)
FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite != '0'
GROUP BY categorie, reussite;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reussiteJauge`()
BEGIN

SELECT jauge, reussite, COUNT(reussite)
FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite != '0'
GROUP BY jauge, reussite;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reussiteSexe`()
BEGIN

SELECT sexe, reussite, COUNT(reussite)
FROM utilisateur
WHERE reussite != '0'
GROUP BY sexe, reussite;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE IF NOT EXISTS `appartient` (
  `id_questionnaire` int(11) NOT NULL,
  `id_reponse` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_questionnaire`,`id_reponse`,`id_question`,`id_personne`),
  KEY `FK_appartient_id_reponse` (`id_reponse`),
  KEY `FK_appartient_id_question` (`id_question`),
  KEY `FK_appartient_id_personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Déclencheurs `appartient`
--
DROP TRIGGER IF EXISTS `insertion_temps_reponse`;
DELIMITER //
CREATE TRIGGER `insertion_temps_reponse` AFTER INSERT ON `appartient`
 FOR EACH ROW BEGIN

UPDATE reponse
SET Temps_rep = now()
where id_reponse = NEW.id_reponse;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `choix_question`
--

CREATE TABLE IF NOT EXISTS `choix_question` (
  `id_choix` int(11) NOT NULL AUTO_INCREMENT,
  `choix1` varchar(25) DEFAULT NULL,
  `choix2` varchar(25) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_choix`),
  KEY `FK_choix_question_id_question` (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `choix_question`
--

INSERT INTO `choix_question` (`id_choix`, `choix1`, `choix2`, `id_question`) VALUES
(1, 'Je reporte', 'Je reste', 1),
(2, 'Je partage', 'Je paye', 2),
(3, 'Mentir', 'Vérité', 3),
(4, 'Faire la bise', 'Serrer la main', 4),
(5, 'Vivre ensemble', 'Attendre un peu', 5),
(6, 'Jeter les posters', 'Imposer votre décoration', 6),
(7, 'Accepter', 'Refuser', 7),
(8, 'Accepter', 'Refuser', 8),
(9, 'Refuser de choisir', 'Choisir votre partenaire', 9),
(10, 'Demander ', 'Regarder sans demander', 10),
(11, 'Mutation', 'Licenciement', 11),
(12, 'Travailler au domicile', 'Continuer ainsi', 12),
(13, 'L''aîné', 'Le cadet', 13),
(14, 'Acceptez-vous', 'Refusez-vous', 14),
(15, 'Mariage religieu', 'Non religieu', 15),
(16, 'Mariage en intérieur', 'Mariage en extérieur', 16);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE IF NOT EXISTS `jeux` (
  `id_questionnaire` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` int(11) DEFAULT NULL,
  `jauge` int(1) DEFAULT NULL,
  `temps_debut_utilisateur` datetime NOT NULL,
  PRIMARY KEY (`id_questionnaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=366 ;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_question`, `texte`) VALUES
(1, 'Durant votre premier rdv, votre patron vous appelle pour une urgence au bureau, reportez-vous le rendez-vous ?'),
(2, 'À la fin de votre premier rendez-vous le serveur apporte l''addition, que décidez-vous ?'),
(3, 'Durant la première rencontre avec la famille du conjoint autour d''un repas ses parents vous pose une question délicates: “dites moi combien de partenaire avez-vous eu avant de rencontrer notre enfants ? “ répondez-vous de manière honnête ou préférez vous mentir ?'),
(4, 'Vous rencontrez la famille de votre conjoint pour la première fois, optez vous pour serrer la main ou faire la bise ?'),
(5, 'Votre conjoint vous propose d''emménager ensemble, cependant elle a un des ses parents à charge, qui est dépendant physiquement. Acceptez-vous de vivre avec votre conjoint et donc son parent ou refusez vous ?'),
(6, 'Vous allez emménager avec votre conjoint, pendant que vous faites vos cartons vous réalisez que tous vos poster de Laurie que vous aviez acheté durant votre adolescence risque de mal passer dans le nouvel appartement, les jetez-vous ou imposez-vous votre décoration'),
(7, 'Au cours d’une discussion sur le fait de fonder une famille avec votre conjoint, ce dernier vous manifeste son intention de vouloir adopter un enfant handicapé dans un avenir proche, acceptez-vous ou non ?'),
(8, 'Votre conjoint veut donner à votre premier enfant le nom de Mao, même si c’est une fille, acceptez-vous ?'),
(9, 'Durant une violente dispute avec votre conjoint, il/elle vous reproche que votre meilleur(e) ami(e) est un obstacle à votre vie de couple et vous demande de faire un choix entre l’un des deux, que décidez-vous ?'),
(10, 'Votre conjoint envoie beaucoup de sms ces derniers jours sans que vous sachiez qui en est le destinataire. Lui demandez-vous ou regardez-vous son portable quand il/elle a le dos tourné ?'),
(11, 'Vous apprenez à votre travail qu’un plan social est en cours. Votre supérieur vous propose une mutation de 3 ans à l’autre bout du monde bien rémunéré, si vous dites non vous êtes licenciés. Que choisissez-vous devant votre conjoint ?'),
(12, 'Vous avez beaucoup de travail depuis le début de la semaine, afin de ne pas emmener du travail à votre domicile vous rentrez très tard, votre conjoint commence à se plaindre et en arrive à vous suspecter de voir quelqu''un d’autre. Que décidez-vous de faire ?'),
(13, 'Votre subissez un terrible accident de voiture avec vos 2 enfants et votre conjoint. Vos deux enfants sont dans un état critique et votre femme est inconsciente mais saine et sauve, vous devez pratiquer un massage cardiaque sur l’un de vos deux enfants, sachant pertinemment que pendant ce temps là l'),
(14, 'Votre partenaire est cloué(e) au lit en raison d’une vilaine grippe. Elle vous demande de modifier vos horaires de bureau pour aller chercher les enfants lorsque l’école est fini.'),
(15, 'Votre conjoint et vous allez vous marier, cependant une question importante reste en suspens. La famille de votre conjoint est très pieuse et serait extrêmement heureuse d’organiser une cérémonie religieuse, à l’inverse votre famille, totalement anti-religieuse serait très vexé à l’idée de participe'),
(16, 'Vous rêvez de vous marier en plein air. Cependant, les circonstances font que vous devrez vous marier à Lille en Novembre, le mariage risque donc d’être assez humide. Persévérez-vous dans votre idée ou décidez-vous de suivre l’idée de votre conjoint d’un mariage en intérieur ?');

-- --------------------------------------------------------

--
-- Structure de la table `question_difficile`
--

CREATE TABLE IF NOT EXISTS `question_difficile` (
  `id_q_d` varchar(25) NOT NULL,
  `id_question` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_q_d`),
  KEY `FK_question_difficile_id_question` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question_difficile`
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
-- Structure de la table `question_facile`
--

CREATE TABLE IF NOT EXISTS `question_facile` (
  `id_q_f` varchar(25) NOT NULL,
  `id_question` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_q_f`),
  KEY `FK_question_facile_id_question` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question_facile`
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
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` varchar(25) DEFAULT NULL,
  `temps_rep` datetime NOT NULL,
  `Temps_prit_rep` time DEFAULT NULL,
  PRIMARY KEY (`id_reponse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1068 ;

-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `FK_appartient_id_personne` FOREIGN KEY (`id_personne`) REFERENCES `utilisateur` (`id_personne`),
  ADD CONSTRAINT `FK_appartient_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`),
  ADD CONSTRAINT `FK_appartient_id_questionnaire` FOREIGN KEY (`id_questionnaire`) REFERENCES `jeux` (`id_questionnaire`),
  ADD CONSTRAINT `FK_appartient_id_reponse` FOREIGN KEY (`id_reponse`) REFERENCES `reponse` (`id_reponse`);

--
-- Contraintes pour la table `choix_question`
--
ALTER TABLE `choix_question`
  ADD CONSTRAINT `FK_choix_question_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `question_difficile`
--
ALTER TABLE `question_difficile`
  ADD CONSTRAINT `FK_question_difficile_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `question_facile`
--
ALTER TABLE `question_facile`
  ADD CONSTRAINT `FK_question_facile_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
