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
         anychart.onDocumentReady(function() {

                  	         	<?php
	$sql='CALL moyReussiteNotaJauge';
	$res = $bdd->query($sql);
	$tab = array(); // création du tableau PHP
   	 while($lg=$res->fetchObject()){
	$tab[]=[$lg ->jauge, $lg -> moyenne]; // alimentation du tableau php avec les données de la requête
   	 }
	print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
	?>

  // create bar chart
  chart = anychart.bar();

  // turn on chart animation
  chart.animation(true);

  // set container id for the chart
  chart.container('moyReussiteNotaJauge');
  chart.padding([10,10,10,10]);

  // set chart title text settings
  chart.title('Note moyenne de reussite en fonction de l\'affichage de la jauge');

  // create area series with passed data
  var series = chart.bar(t);
  // set tooltip formatter
  series.tooltip().titleFormatter(function(){if(this.x==0){return "Pas de Jauge"} else{return "Avec jauge"}});
  series.tooltip().textFormatter(function () {
      return 'Moyenne : ' + this.value.toLocaleString();
  });
  series.tooltip().position('right').anchor('left').offsetX(5).offsetY(0);

  // set yAxis labels formatter
  chart.yAxis().labels().textFormatter(function(){
      return this.value.toLocaleString();
    });

  // set titles for axises
  chart.xAxis().title('Affichage Jauge');
  chart.yAxis().title('Moyenne');
  chart.interactivity().hoverMode('byX');
  chart.tooltip().positionMode('point');
  // set scale minimum
  chart.yScale().minimum(0);
  chart.yScale().maximum(10);

  // initiate chart drawing
  chart.draw();
});

        </script>

		<div id='moyReussiteNotaJauge'></div>
		<style>
        #moyReussiteNotaJauge {
             width: 100%;
             height: 50%;
             margin: 0;
             padding: 0;
         }
        </style>
						 <script type="text/javascript">
         anychart.onDocumentReady(function() {
                  	         	<?php
	
	$sqlFaux0='CALL moyReussiteChemin(0);';
	$res = $bdd -> query($sqlFaux0);
	
	$sql1='CALL moyReussiteChemin(1);';
	$res1 = $bdd -> query($sql1);
	$chemin1 = $res1 -> fetchColumn();

	$sqlFaux1='CALL moyReussiteChemin(1);';
	$res4 = $bdd -> query($sqlFaux1);

	$sql2='CALL moyReussiteChemin(2);';
	$res2 = $bdd -> query($sql2);
	$chemin2 = $res2 -> fetchColumn();

	$sqlFaux5='CALL moyReussiteChemin(0);';
	$res5 = $bdd -> query($sqlFaux5);

	$sql3='CALL moyReussiteChemin(3);';
	$res3 = $bdd -> query($sql3);
	$chemin3 = $res3 -> fetchColumn();

	$sqlFaux6='CALL moyReussiteChemin(0);';
	$res6 = $bdd -> query($sqlFaux6);

	$sql0='CALL moyReussiteChemin(0);';
	$res0 = $bdd->query($sql0);
	$chemin0 = $res0 -> fetchColumn();

	$tab = array(["Facile", $chemin1],["Facile - Difficile", $chemin2],["Difficile - Facile", $chemin3],["Difficile", $chemin0]); // création du tableau PHP

	print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
	?>

  // create bar chart
  chart = anychart.bar();

  // turn on chart animation
  chart.animation(true);

  // set container id for the chart
  chart.container('moyReussiteChemin');
  chart.padding([10,10,5,5]);

  // set chart title text settings
  chart.title('Note moyenne de reussite en fonction du chemin');

  // create area series with passed data
  var series = chart.bar(t);
  // set tooltip formatter
  series.tooltip().titleFormatter(function(){return this.x});
  series.tooltip().textFormatter(function () {
      return 'Moyenne : ' + this.value.toLocaleString();
  });
  series.tooltip().position('right').anchor('left').offsetX(5).offsetY(0);

  // set yAxis labels formatter
  chart.yAxis().labels().textFormatter(function(){
      return this.value.toLocaleString();
    });

  // set titles for axises
  chart.xAxis().title('Chemin');
  chart.yAxis().title('Moyenne');
  chart.interactivity().hoverMode('byX');
  chart.tooltip().positionMode('point');
  // set scale minimum
  chart.yScale().minimum(0);
  chart.yScale().maximum(10);

  // initiate chart drawing
  chart.draw();
});

        </script>

		<div id='moyReussiteChemin'></div>
		<style>
         #moyReussiteChemin {
             width: 100%;
             height: 50%;
             margin: 0;
             padding: 0;
         }
         form {
			display:inline;
		}
        </style>
        <center>
        <form name="frm" action="./stats.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Précédent">
		</form>
		
		<form name="frm" action="./stats3.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Suivant">
		</form>
		</center>
	</body>
</html>
