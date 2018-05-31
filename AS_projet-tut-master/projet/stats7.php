<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Emotions et Decisions</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-blue.min.css" />
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<link rel="stylesheet" href="style/styles.css"/>
		<!--<script src="anychart/js/anychart.min.js" type="text/javascript"></script>-->
	</head>

	<body>
		
		<u>
		<h3 align="center">Notre page de statistique des joueurs</h3>			
		</u>
		
		<?php
		require ("config.php");

		try {
			$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
		} catch(PDOException $e) {
			die("Erreur : " . $e -> getMessage());
		}

	$sqlTempsMoy0='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 0';
	$resTempsMoy0 = $bdd->query($sqlTempsMoy0);
	$TempsMoy0 = $resTempsMoy0 -> fetchColumn();
	
	$sqlTempsMoyFemme0='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 0
	AND sexe="femme"';
	$resTempsMoyF0 = $bdd->query($sqlTempsMoyFemme0);
	$TempsMoyF0 = $resTempsMoyF0 -> fetchColumn();
	
	$sqlTempsMoyHomme0='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 0
	AND sexe="homme"';
	$resTempsMoyH0 = $bdd->query($sqlTempsMoyHomme0);
	$TempsMoyH0 = $resTempsMoyH0 -> fetchColumn();
	
	$sqlTempsMoy1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 1';
	$resTempsMoy1 = $bdd->query($sqlTempsMoy1);
	$TempsMoy1 = $resTempsMoy1 -> fetchColumn();
	
	$sqlTempsMoyFemme1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 1
	AND sexe="femme"';
	$resTempsMoyF1 = $bdd->query($sqlTempsMoyFemme1);
	$TempsMoyF1 = $resTempsMoyF1 -> fetchColumn();
	
	$sqlTempsMoyHomme1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 1
	AND sexe="homme"';
	$resTempsMoyH1 = $bdd->query($sqlTempsMoyHomme1);
	$TempsMoyH1 = $resTempsMoyH1 -> fetchColumn();
	
	$sqlTempsMoy2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 2';
	$resTempsMoy2 = $bdd->query($sqlTempsMoy2);
	$TempsMoy2 = $resTempsMoy2 -> fetchColumn();
	
	$sqlTempsMoyFemme2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 2
	AND sexe="femme"';
	$resTempsMoyF2 = $bdd->query($sqlTempsMoyFemme2);
	$TempsMoyF2 = $resTempsMoyF2 -> fetchColumn();
	
	$sqlTempsMoyHomme2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 2
	AND sexe="homme"';
	$resTempsMoyH2 = $bdd->query($sqlTempsMoyHomme2);
	$TempsMoyH2 = $resTempsMoyH2 -> fetchColumn();
	
	$sqlTempsMoy3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 3';
	$resTempsMoy3 = $bdd->query($sqlTempsMoy3);
	$TempsMoy3 = $resTempsMoy3 -> fetchColumn();
	
	$sqlTempsMoyFemme3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 3
	AND sexe="femme"';
	$resTempsMoyF3 = $bdd->query($sqlTempsMoyFemme3);
	$TempsMoyF3 = $resTempsMoyF3 -> fetchColumn();
	
	$sqlTempsMoyHomme3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_total_format_date)))
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIn jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE categorie = 3
	AND sexe="homme"';
	$resTempsMoyH3 = $bdd->query($sqlTempsMoyHomme3);
	$TempsMoyH3 = $resTempsMoyH3 -> fetchColumn();
?>
<table id="tableauGeneral" border="2">
	<tr>
	<td></td>
	<td> Temps Moyen selon chemin</td>
	<td> Temps Moyen des Femmes selon le chemin</td>
	<td> Temps Moyen des Hommes selon le chemin</td>
	</tr>
   <tr>
       <td>Temps Moyen Facile</td>
       <td align="center"><?php echo($TempsMoy0) ?></td>
       <td align="center"><?php echo($TempsMoyF0) ?></td>
       <td align="center"><?php echo($TempsMoyH0) ?></td>
   </tr>
   <tr>
       <td>Temps Moyen Facile-Difficile</td>
       <td align="center"><?php echo($TempsMoy1) ?></td>
       <td align="center"><?php echo($TempsMoyF1) ?></td>
       <td align="center"><?php echo($TempsMoyH1) ?></td>
   </tr>
   <tr>
       <td>Temps Moyen Difficile-Facile</td>
       <td align="center"><?php echo($TempsMoy2) ?></td>
       <td align="center"><?php echo($TempsMoyF2) ?></td>
       <td align="center"><?php echo($TempsMoyH2) ?></td>
   </tr>
   <tr>
       <td>Temps Moyen Difficile</td>
       <td align="center"><?php echo($TempsMoy3) ?></td>
       <td align="center"><?php echo($TempsMoyF3) ?></td>
       <td align="center"><?php echo($TempsMoyH3) ?></td>
   </tr>
   
</table>
<br />

 <table id="tableauQuestion&Chemin" border="2">
	<tr>
	<td> Temps Moyen en fonction <br /> de la question et du chemin </td>
	<td> Chemin facile </td>
	<td> Chemin facile / difficile </td>
	<td> Chemin difficile / facile </td>
	<td> Chemin difficile </td>
	</tr>
   <tr>
   	<?php
	$sqlTempsMoy1Q1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 2';
	$resTempsMoy1Q1 = $bdd->query($sqlTempsMoy1Q1);
	$TempsMoy1Q1 = $resTempsMoy1Q1 -> fetchColumn();
	
	$sqlTempsMoy2Q1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 2
    AND question_facile.id_question = 2';
	$resTempsMoy2Q1 = $bdd->query($sqlTempsMoy2Q1);
	$TempsMoy2Q1 = $resTempsMoy2Q1 -> fetchColumn();
	
	$sqlTempsMoy3Q1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 3
    AND question_difficile.id_question = 1';
	$resTempsMoy3Q1 = $bdd->query($sqlTempsMoy3Q1);
	$TempsMoy3Q1 = $resTempsMoy3Q1 -> fetchColumn();
	
	$sqlTempsMoy0Q1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 1';
	$resTempsMoy0Q1 = $bdd->query($sqlTempsMoy0Q1);
	$TempsMoy0Q1 = $resTempsMoy0Q1 -> fetchColumn();
?>
       <td>Question 1</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q1) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy2Q1) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy3Q1) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q1) ?></td>
   </tr>
   <tr>
   	<?php
	$sqlTempsMoy1Q2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 4';
	$resTempsMoy1Q2 = $bdd->query($sqlTempsMoy1Q2);
	$TempsMoy1Q2 = $resTempsMoy1Q2 -> fetchColumn();
	
	$sqlTempsMoy2Q2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 2
    AND question_facile.id_question = 4';
	$resTempsMoy2Q2 = $bdd->query($sqlTempsMoy2Q2);
	$TempsMoy2Q2 = $resTempsMoy2Q2 -> fetchColumn();
	
	$sqlTempsMoy3Q2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 3
    AND question_difficile.id_question = 3';
	$resTempsMoy3Q2 = $bdd->query($sqlTempsMoy3Q2);
	$TempsMoy3Q2 = $resTempsMoy3Q2 -> fetchColumn();
	
	$sqlTempsMoy0Q2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 3';
	$resTempsMoy0Q2 = $bdd->query($sqlTempsMoy0Q2);
	$TempsMoy0Q2 = $resTempsMoy0Q2 -> fetchColumn();
?>
       <td>Question 2</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q2) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy2Q2) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy3Q2) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q2) ?></td>
   </tr>
   <tr>
   	<?php
	$sqlTempsMoy1Q3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 6';
	$resTempsMoy1Q3 = $bdd->query($sqlTempsMoy1Q3);
	$TempsMoy1Q3 = $resTempsMoy1Q3 -> fetchColumn();
	
	$sqlTempsMoy2Q3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 2
    AND question_facile.id_question = 6';
	$resTempsMoy2Q3 = $bdd->query($sqlTempsMoy2Q3);
	$TempsMoy2Q3 = $resTempsMoy2Q3 -> fetchColumn();
	
	$sqlTempsMoy3Q3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 3
    AND question_difficile.id_question = 5';
	$resTempsMoy3Q3 = $bdd->query($sqlTempsMoy3Q3);
	$TempsMoy3Q3 = $resTempsMoy3Q3 -> fetchColumn();
	
	$sqlTempsMoy0Q3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 5';
	$resTempsMoy0Q3 = $bdd->query($sqlTempsMoy0Q3);
	$TempsMoy0Q3 = $resTempsMoy0Q3 -> fetchColumn();
?>
       <td>Question 3</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q3) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy2Q3) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy3Q3) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q3) ?></td>
   </tr>
   <tr>
   	<?php
	$sqlTempsMoy1Q4='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 8';
	$resTempsMoy1Q4 = $bdd->query($sqlTempsMoy1Q4);
	$TempsMoy1Q4 = $resTempsMoy1Q4 -> fetchColumn();
	
	$sqlTempsMoy2Q4='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 2
    AND question_facile.id_question = 8';
	$resTempsMoy2Q4 = $bdd->query($sqlTempsMoy2Q4);
	$TempsMoy2Q4 = $resTempsMoy2Q4 -> fetchColumn();
	
	$sqlTempsMoy3Q4='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 3
    AND question_difficile.id_question = 7';
	$resTempsMoy3Q4 = $bdd->query($sqlTempsMoy3Q4);
	$TempsMoy3Q4 = $resTempsMoy3Q4 -> fetchColumn();
	
	$sqlTempsMoy0Q4='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 7';
	$resTempsMoy0Q4 = $bdd->query($sqlTempsMoy0Q4);
	$TempsMoy0Q4 = $resTempsMoy0Q4 -> fetchColumn();
?>
       <td>Question 4</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q4) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy2Q4) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy3Q4) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q4) ?></td>
   </tr>   
   <tr>
   	<?php
	$sqlTempsMoy1Q5='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 10';
	$resTempsMoy1Q5 = $bdd->query($sqlTempsMoy1Q5);
	$TempsMoy1Q5 = $resTempsMoy1Q5 -> fetchColumn();
	
	$sqlTempsMoy2Q5='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 2
    AND question_difficile.id_question = 9';
	$resTempsMoy2Q5 = $bdd->query($sqlTempsMoy2Q5);
	$TempsMoy2Q5 = $resTempsMoy2Q5 -> fetchColumn();
	
	$sqlTempsMoy3Q5='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 3
    AND question_facile.id_question = 10';
	$resTempsMoy3Q5 = $bdd->query($sqlTempsMoy3Q5);
	$TempsMoy3Q5 = $resTempsMoy3Q5 -> fetchColumn();
	
	$sqlTempsMoy0Q5='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 9';
	$resTempsMoy0Q5 = $bdd->query($sqlTempsMoy0Q5);
	$TempsMoy0Q5 = $resTempsMoy0Q5 -> fetchColumn();
?>
       <td>Question 5</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q5) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy2Q5) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy3Q5) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q5) ?></td>
   </tr>   
   <tr>
   	<?php
	$sqlTempsMoy1Q6='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 12';
	$resTempsMoy1Q6 = $bdd->query($sqlTempsMoy1Q6);
	$TempsMoy1Q6 = $resTempsMoy1Q6 -> fetchColumn();
	
	$sqlTempsMoy2Q6='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 2
    AND question_difficile.id_question = 11';
	$resTempsMoy2Q6 = $bdd->query($sqlTempsMoy2Q6);
	$TempsMoy2Q6 = $resTempsMoy2Q6 -> fetchColumn();
	
	$sqlTempsMoy3Q6='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 3
    AND question_facile.id_question = 12';
	$resTempsMoy3Q6 = $bdd->query($sqlTempsMoy3Q6);
	$TempsMoy3Q6 = $resTempsMoy3Q6 -> fetchColumn();
	
	$sqlTempsMoy0Q6='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 11';
	$resTempsMoy0Q6 = $bdd->query($sqlTempsMoy0Q6);
	$TempsMoy0Q6 = $resTempsMoy0Q6 -> fetchColumn();
?>
       <td>Question 6</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q6) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy2Q6) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy3Q6) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q6) ?></td>
   </tr>
   <tr>
   	<?php
	$sqlTempsMoy1Q7='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 14';
	$resTempsMoy1Q7 = $bdd->query($sqlTempsMoy1Q7);
	$TempsMoy1Q7 = $resTempsMoy1Q7 -> fetchColumn();
	
	$sqlTempsMoy2Q7='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 2
    AND question_difficile.id_question = 13';
	$resTempsMoy2Q7 = $bdd->query($sqlTempsMoy2Q7);
	$TempsMoy2Q7 = $resTempsMoy2Q7 -> fetchColumn();
	
	$sqlTempsMoy3Q7='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 3
    AND question_facile.id_question = 14';
	$resTempsMoy3Q7 = $bdd->query($sqlTempsMoy3Q7);
	$TempsMoy3Q7 = $resTempsMoy3Q7 -> fetchColumn();
	
	$sqlTempsMoy0Q7='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 13';
	$resTempsMoy0Q7 = $bdd->query($sqlTempsMoy0Q7);
	$TempsMoy0Q7 = $resTempsMoy0Q7 -> fetchColumn();
?>
       <td>Question 7</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q7) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy2Q7) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy3Q7) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q7) ?></td>
   </tr>
   <tr>
   	<?php
	$sqlTempsMoy1Q8='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 1
    AND question_facile.id_question = 16';
	$resTempsMoy1Q8 = $bdd->query($sqlTempsMoy1Q8);
	$TempsMoy1Q8 = $resTempsMoy1Q8 -> fetchColumn();
	
	$sqlTempsMoy2Q8='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 2
    AND question_difficile.id_question = 15';
	$resTempsMoy2Q8 = $bdd->query($sqlTempsMoy2Q8);
	$TempsMoy2Q8 = $resTempsMoy2Q8 -> fetchColumn();

	$sqlTempsMoy3Q8='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_facile ON question.id_question = question_facile.id_question
    WHERE categorie = 3
    AND question_facile.id_question = 16';
	$resTempsMoy3Q8 = $bdd->query($sqlTempsMoy3Q8);
	$TempsMoy3Q8 = $resTempsMoy3Q8 -> fetchColumn();
	
	$sqlTempsMoy0Q8='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN jeux ON jeux.id_questionnaire = appartient.id_questionnaire
    JOIN question ON question.id_question = appartient.id_question
    JOIN question_difficile ON question.id_question = question_difficile.id_question
    WHERE categorie = 0
    AND question_difficile.id_question = 15';
	$resTempsMoy0Q8 = $bdd->query($sqlTempsMoy0Q8);
	$TempsMoy0Q8 = $resTempsMoy0Q8 -> fetchColumn();
?>
       <td>Question 8</td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy1Q8) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy2Q8) ?></td>
       <td bgcolor="#00FF00" align="center"><?php echo($TempsMoy3Q8) ?></td>
       <td bgcolor="#FF0000" align="center"><?php echo($TempsMoy0Q8) ?></td>
   </tr>
</table> 
        <br />
        
  <table id="tableauQuestionGeneral" border="2">	
	<td> Temps Moyen sur question</td>
	<td> Temps réponse moyen sur la question</td>
   <tr>
   	<?php
   	$sqlTempsMoyQ1='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 1';
	$resTempsMoyQ1 = $bdd->query($sqlTempsMoyQ1);
	$TempsMoyQ1 = $resTempsMoyQ1 -> fetchColumn();
   	?>
       <td>Question 1 (Q1 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ1) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ2='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 2';
	$resTempsMoyQ2 = $bdd->query($sqlTempsMoyQ2);
	$TempsMoyQ2 = $resTempsMoyQ2 -> fetchColumn();
   	?>
       <td>Question 2 (Q1 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ2) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ3='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 3';
	$resTempsMoyQ3 = $bdd->query($sqlTempsMoyQ3);
	$TempsMoyQ3 = $resTempsMoyQ3 -> fetchColumn();
   	?>
       <td>Question 3 (Q2 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ3) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ4='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 4';
	$resTempsMoyQ4 = $bdd->query($sqlTempsMoyQ4);
	$TempsMoyQ4 = $resTempsMoyQ4 -> fetchColumn();
   	?>
       <td>Question 4 (Q2 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ4) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ5='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 5';
	$resTempsMoyQ5 = $bdd->query($sqlTempsMoyQ5);
	$TempsMoyQ5 = $resTempsMoyQ5 -> fetchColumn();
   	?>
       <td>Question 5 (Q3 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ5) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ6='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 6';
	$resTempsMoyQ6 = $bdd->query($sqlTempsMoyQ6);
	$TempsMoyQ6 = $resTempsMoyQ6 -> fetchColumn();
   	?>
       <td>Question 6 (Q3 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ6) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ7='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 7';
	$resTempsMoyQ7 = $bdd->query($sqlTempsMoyQ7);
	$TempsMoyQ7 = $resTempsMoyQ7 -> fetchColumn();
   	?>
       <td>Question 7 (Q4 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ7) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ8='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 8';
	$resTempsMoyQ8 = $bdd->query($sqlTempsMoyQ8);
	$TempsMoyQ8 = $resTempsMoyQ8 -> fetchColumn();
   	?>
       <td>Question 8 (Q4 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ8) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ9='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 9';
	$resTempsMoyQ9 = $bdd->query($sqlTempsMoyQ9);
	$TempsMoyQ9 = $resTempsMoyQ9 -> fetchColumn();
   	?>
       <td>Question 9 (Q5 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ9) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ10='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 10';
	$resTempsMoyQ10 = $bdd->query($sqlTempsMoyQ10);
	$TempsMoyQ10 = $resTempsMoyQ10 -> fetchColumn();
   	?>
       <td>Question 10 (Q5 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ10) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ11='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 11';
	$resTempsMoyQ11 = $bdd->query($sqlTempsMoyQ11);
	$TempsMoyQ11 = $resTempsMoyQ11 -> fetchColumn();
   	?>
       <td>Question 11 (Q6 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ11) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ12='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 12';
	$resTempsMoyQ12 = $bdd->query($sqlTempsMoyQ12);
	$TempsMoyQ12 = $resTempsMoyQ12 -> fetchColumn();
   	?>
       <td>Question 12 (Q6 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ12) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ13='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 13';
	$resTempsMoyQ13 = $bdd->query($sqlTempsMoyQ13);
	$TempsMoyQ13 = $resTempsMoyQ13 -> fetchColumn();
   	?>
       <td>Question 13 (Q7 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ13) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ14='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 14';
	$resTempsMoyQ14 = $bdd->query($sqlTempsMoyQ14);
	$TempsMoyQ14 = $resTempsMoyQ14 -> fetchColumn();
   	?>
       <td>Question 14 (Q7 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ14) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ15='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 15';
	$resTempsMoyQ15 = $bdd->query($sqlTempsMoyQ15);
	$TempsMoyQ15 = $resTempsMoyQ15 -> fetchColumn();
   	?>
       <td>Question 15 (Q8 : difficile)</td>
       <td align="center"><?php echo($TempsMoyQ15) ?></td>
   </tr>
   <tr>
   	<?php
   	$sqlTempsMoyQ16='SELECT SEC_TO_TIME(AVG(TIME_TO_SEC(Temps_prit_rep_format_date)))
	FROM reponse
	JOIN appartient ON reponse.id_reponse = appartient.id_reponse
    JOIN question ON question.id_question = appartient.id_question
    AND question.id_question = 16';
	$resTempsMoyQ16 = $bdd->query($sqlTempsMoyQ16);
	$TempsMoyQ16 = $resTempsMoyQ16 -> fetchColumn();
   	?>
       <td>Question 16 (Q8 : facile)</td>
       <td align="center"><?php echo($TempsMoyQ16) ?></td>
   </tr>
</table>
        
        <form name="frm" action="./stats6.php" method="post" align="center">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Précédent">
		</form>
		<br />
		<form name="frm" action="./page_accueil.php" method="post" align="center">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Accueil">
		</form>
		
	</body>
</html>
