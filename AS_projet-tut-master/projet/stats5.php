<!DOCTYPE html>
<!-- Attention il faut remplacer tout les requetes $sql..Faux ou autre variable contenant FAUX. Ce sont juste des moyens de s'en sortir degeulasse-->
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Emotions et Decisions</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-blue.min.css" />
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<link rel="stylesheet" href="style/styles.css"/>
		<script src="anychart/js/anychart.min.js" type="text/javascript"></script>
	</head>

	<body>
		<p>
			Notre page de statistique des joueurs
		</p>

		<?php
		require ("config.php");

		try {
			$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
		} catch(PDOException $e) {
			die("Erreur : " . $e -> getMessage());
		}

		?>
		
  
                		<script type="text/javascript">
         anychart.onDocumentReady(function(){
         	<?php
         	
	$sqlF0='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "femme"
	AND categorie = 0';
	$resF0 = $bdd->query($sqlF0);
	$nbF0 = $resF0 -> fetchColumn();
	
	$sqlF1='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "femme"
	AND categorie = 1';
	$resF1 = $bdd->query($sqlF1);
	$nbF1 = $resF1 -> fetchColumn();
	
	$sqlF2='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "femme"
	AND categorie = 0';
	$resF2 = $bdd->query($sqlF2);
	$nbF2 = $resF2 -> fetchColumn();
	
	$sqlF3='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "femme"
	AND categorie = 3';
	$resF3 = $bdd->query($sqlF3);
	$nbF3 = $resF3 -> fetchColumn();
	
	$tab = array(["Facile", $nbF0],["Facile - Difficile", $nbF1],["Difficile - Facile", $nbF2],["Difficile", $nbF3]); // création du tableau PHP

print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
?>
  // create funnel chart
  chart = anychart.pyramid(t);

  // set container id for the chart
  chart.container("nbFemmeChemin");

  // set chart margin
  chart.margin(10, '20%', 10, '20%');

  // set chart legend settings
  var legend = chart.legend();
  legend.enabled(true);
  legend.position("right");
  legend.itemsLayout("vertical");
  legend.align("top");

  // set chart title
  chart.title("Nombre de Femme par categories.");

  // set chart base width settings
  chart.baseWidth("70%");

  // set chart labels settings
  var labels = chart.labels();
  labels.position("outsideright");
  labels.textFormatter(function() {
    return this.value;
  });

  // initiate chart drawing
  chart.draw();
});
        </script>
         	
        <div id='nbFemmeChemin'></div>
            <style>
         html, body, #nbFemmeChemin {
             width: 100%;
             height: 100%;
             margin: 0;
             padding: 0;
         }
        </style>
        
                        		<script type="text/javascript">
         anychart.onDocumentReady(function(){
         	<?php
         	
	$sqlH0='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "homme"
	AND categorie = 0';
	$resH0 = $bdd->query($sqlH0);
	$nbH0 = $resH0 -> fetchColumn();
	
	$sqlH1='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "homme"
	AND categorie = 1';
	$resH1 = $bdd->query($sqlH1);
	$nbH1 = $resH1 -> fetchColumn();
	
	$sqlH2='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "homme"
	AND categorie = 0';
	$resH2 = $bdd->query($sqlH2);
	$nbH2 = $resH2 -> fetchColumn();
	
	$sqlH3='SELECT COUNT(DISTINCT utilisateur.id_personne)
	FROM utilisateur
	JOIN appartient ON utilisateur.id_personne = appartient.id_personne
	JOIN jeux ON appartient.id_questionnaire = jeux.id_questionnaire
	WHERE sexe = "homme"
	AND categorie = 3';
	$resH3 = $bdd->query($sqlH3);
	$nbH3 = $resH3 -> fetchColumn();
	
	$tab = array(["Facile", $nbH0],["Facile - Difficile", $nbH1],["Difficile - Facile", $nbH2],["Difficile", $nbH3]); // création du tableau PHP

print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
?>
  // create funnel chart
  chart = anychart.pyramid(t);

  // set container id for the chart
  chart.container("nbHommeChemin");

  // set chart margin
  chart.margin(10, '20%', 10, '20%');

  // set chart legend settings
  var legend = chart.legend();
  legend.enabled(true);
  legend.position("right");
  legend.itemsLayout("vertical");
  legend.align("top");

  // set chart title
  chart.title("Nombre de Homme par categories.");

  // set chart base width settings
  chart.baseWidth("70%");

  // set chart labels settings
  var labels = chart.labels();
  labels.position("outsideright");
  labels.textFormatter(function() {
    return this.value;
  });

  // initiate chart drawing
  chart.draw();
});
        </script>
         	
        <div id='nbHommeChemin'></div>
            <style>
         html, body, #nbHommeChemin {
             width: 100%;
             height: 100%;
             margin: 0;
             padding: 0;
         }
        form {
			display:inline;
		}
        </style>
        <center>
        <form name="frm" action="./stats4.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Précédent">
		</form>
		
		<form name="frm" action="./stats6.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Suivant">
		</form>
		</center>
	</body>
</html>
