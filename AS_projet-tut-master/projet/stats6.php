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
			Notre page de statistiques des joueurs
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
			anychart.onDocumentReady(function() {
				<?php
					$sql='SELECT COUNT(regret) FROM utilisateur WHERE regret = " "';
					$regretVide = $bdd->query($sql);
					$regretV = $regretVide -> fetchColumn();
					
					$sql2='SELECT COUNT(regret) FROM utilisateur WHERE regret != " "';
					$regret = $bdd->query($sql2);
					$regretP = $regret -> fetchColumn();
					
					$tab = array(['N\'ont pas de regret',$regretV],['Ont du regret',$regretP]);  					// création du tableau PHP

					print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
?>
				// create pie chart with passed data
				chart = anychart.pie(t);

				// set container id for the chart
				chart.container('regret');

				// set chart title text settings
				chart.title('Repartition du regret');

				// set legend title text settings
				chart.legend(true);
				chart.legend().title('Présence regret');
				chart.legend().title().padding([0, 0, 10, 0]);

				// set legend position and items layout
				chart.legend().position('bottom');
				chart.legend().itemsLayout('horizontal');
				chart.legend().align('center');

				// initiate chart drawing
				chart.draw();
			});
		</script>


		<div id='regret'></div>
		<style>
         #regret {
             width: 100%;
             height: 75%;
             margin: 0;
             padding: 0;
         }
        </style>
        
         <script type="text/javascript">
			anychart.onDocumentReady(function() {
				<?php
					$sql='SELECT COUNT(deci_diff) FROM utilisateur WHERE deci_diff = " "';
					$deci_diffVide = $bdd->query($sql);
					$deci_diffV = $deci_diffVide -> fetchColumn();
					
					$sql2='SELECT COUNT(deci_diff) FROM utilisateur WHERE deci_diff != " "';
					$deci_diff = $bdd->query($sql2);
					$deci_diffP = $deci_diff -> fetchColumn();
					
					$tab = array(['N\'ont pas eu de decision difficile',$deci_diffV],['Ont eu des decisions difficiles',$deci_diffP]);  					// création du tableau PHP

					print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
?>
				// create pie chart with passed data
				chart = anychart.pie(t);

				// set container id for the chart
				chart.container('deci_diff');

				// set chart title text settings
				chart.title('Repartition décision difficile');

				// set legend title text settings
				chart.legend(true);
				chart.legend().title('Présence décison difficile');
				chart.legend().title().padding([0, 0, 10, 0]);

				// set legend position and items layout
				chart.legend().position('bottom');
				chart.legend().itemsLayout('horizontal');
				chart.legend().align('center');

				// initiate chart drawing
				chart.draw();
			});
		</script>


		<div id='deci_diff'></div>     
        <style>
         #deci_diff {
             width: 100%;
             height: 75%;
             margin: 0;
             padding: 0;
         }
        </style>
         <style>
        form {
			display:inline;
		}
        </style>
        <center>
        <form name="frm" action="./stats5.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Précédent">
		</form>
		
		<form name="frm" action="./stats7.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Suivant">
		</form>
		</center>
	</body>
</html>
