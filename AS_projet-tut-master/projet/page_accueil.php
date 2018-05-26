<?php

require("secu.php");
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Emotions et Decisions</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" type="text/css" href="style/material-design-lite.css"/> 
		<script type="text/javascript" src="js/material-design-lite.js"></script>
		<link rel="stylesheet" href="style/styles.css"/>
	</head>

	<body>
		<div id="header">
			<h1>Salutation gentil cobaye !</h1>
			<div class="title">
				<p>Dans le cadre de nos études en informatique à l'IUT de Montpellier, nous avons besoin de votre aide pour répondre à une série de question.
				<p>Ce test se déroulera en trois étapes distcinctes :</p> 
					<p> - Un questionnaire personnel à remplir</p>
					<p> - Une série de questions avec deux choix possibles<p>
					<p> - Un questionnaire de fin récupérant votre ressenti sur le projet<p>
			</p>
			<p>Nous vous remercions par avance de votre participation !</p>
			</div>
		</div>
		
		
		<div class="button_accueil">
			<form name="frm" action="./question_debut.html" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Commencer">
			</form>
		</div>
		<div class="name">
			<p>AXEL BOISSON - THOMAS FOCH - YANN LEMAIRE -  PAUL MOTTIN</p>
		</div>
		
		<div class="admin">
			<p align="center" >Accès aux administrateurs du jeu </p>
			 <form action="page_accueil.php" method="post">
				 <p>
					 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="password">
						<input class="mdl-textfield__input" type="password" name="password"/>
						<label class="mdl-textfield__label" for="password">Uniquement pour les administrateurs</label>
					</div>
					<br>
					 <center><input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Valider"/></center>
				 </p>
			 </form>
			 
			 <?php
					
				if (isset($_POST['password'])) {
					$password = secu::identification($_POST['password']);
					if ($password ==  true){
						header('location:./stats.php');
					}
					
					if ($password ==  false){
					echo "<p align=\"center\">Mot de passe incorrect !</p>";
				    }

			    }		
			
		 ?>
			 
		</div>	
		
		
		
	</body>
</html>
