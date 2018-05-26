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
			Notre page de stats des joueurs
		</p>

		<?php
		require ("config.php");

		try {
			$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
		} catch(PDOException $e) {
			die("Erreur : " . $e -> getMessage());
		}

		$nbpers = $bdd -> query("SELECT COUNT(id_personne) FROM utilisateur");
		$nb = $nbpers -> fetchColumn();

		$ageMoyen = $bdd -> query("SELECT ROUND(AVG(age)) FROM utilisateur");
		$ageMoy = $ageMoyen -> fetchColumn();

		echo("Il y a " . $nb . " personne qui ont effectuer notre test. </br>");
		echo("L'age moyen des testeurs est de ".$ageMoy. " ans");

		/*Verification des valeurs
		$nbSexeF = $bdd -> query("SELECT COUNT(id_personne) FROM utilisateur WHERE sexe = 'femme'");
		$nbF = $nbSexeF -> fetchColumn();
		$nbH = $nb - $nbF;
		echo $nbF;
		echo $nbH;*/
		?>

		<script type="text/javascript">
			anychart.onDocumentReady(function() {
				<?php
					$sql="SELECT COUNT(id_personne) FROM utilisateur WHERE sexe = 'femme'";
					$res = $bdd->query($sql);
					$nbSexeF = $res -> fetchColumn();
					$nbSexeH = $nb - $nbSexeF;
					$tab = array(['HOMME',$nbSexeH],['FEMME',$nbSexeF]);  					// création du tableau PHP

					print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
?>
				// create pie chart with passed data
				chart = anychart.pie(t);

				// set container id for the chart
				chart.container('RepartitionHF');

				// set chart title text settings
				chart.title('repartition HOMME - FEMME');

				// set legend title text settings
				chart.legend(true);
				chart.legend().title('Sexe ');
				chart.legend().title().padding([0, 0, 10, 0]);

				// set legend position and items layout
				chart.legend().position('bottom');
				chart.legend().itemsLayout('horizontal');
				chart.legend().align('center');

				// initiate chart drawing
				chart.draw();
			});
		</script>


		<div id='RepartitionHF'></div>
		</br>
		 <script type="text/javascript">
         anychart.onDocumentReady(function() {

                  	         	<?php
	$sql='CALL nbPersParNote';
	$res = $bdd->query($sql);
	$tab = array(); // création du tableau PHP
   	 while($lg=$res->fetchObject()){
	$tab[]=[$lg ->reussite_nota, $lg -> NbPers]; // alimentation du tableau php avec les données de la requête
   	 }
	print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
	?>

  // create bar chart
  chart = anychart.bar();

  // turn on chart animation
  chart.animation(true);

  // set container id for the chart
  chart.container('PersParNote');
  chart.padding([10,10,5,5]);

  // set chart title text settings
  chart.title('Nombre de personne par note');

  // create area series with passed data
  var series = chart.bar(t);
  // set tooltip formatter
  series.tooltip().titleFormatter(function(){return this.x});
  series.tooltip().textFormatter(function () {
      return 'Valeur : ' + parseInt(this.value).toLocaleString();
  });
  series.tooltip().position('right').anchor('left').offsetX(5).offsetY(0);

  // set yAxis labels formatter
  chart.yAxis().labels().textFormatter(function(){
      return this.value.toLocaleString();
    });

  // set titles for axises
  chart.xAxis().title('Notes');
  chart.yAxis().title('Nb Personne');
  chart.interactivity().hoverMode('byX');
  chart.tooltip().positionMode('point');
  // set scale minimum
  chart.yScale().minimum(0);

  // initiate chart drawing
  chart.draw();
});

        </script>
		<div id='PersParNote'></div>

				 <script type="text/javascript">
         anychart.onDocumentReady(function() {

                  	         	<?php
	$sql='CALL moyReussiteSexe';
	$res = $bdd->query($sql);
	$tab = array(); // création du tableau PHP
   	 while($lg=$res->fetchObject()){
	$tab[]=[$lg ->sexe, $lg -> moyenne]; // alimentation du tableau php avec les données de la requête
   	 }
	print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
	?>

  // create bar chart
  chart = anychart.bar();

  // turn on chart animation
  chart.animation(true);

  // set container id for the chart
  chart.container('moyReussiteSexe');
  chart.padding([10,10,5,5]);

  // set chart title text settings
  chart.title('Note moyenne de reussite par sexe');

  // create area series with passed data
  var series = chart.bar(t);
  // set tooltip formatter
  series.tooltip().titleFormatter(function(){return this.x});
  series.tooltip().textFormatter(function () {
      return 'Valeur : ' + this.value.toLocaleString();
  });
  series.tooltip().position('right').anchor('left').offsetX(5).offsetY(0);

  // set yAxis labels formatter
  chart.yAxis().labels().textFormatter(function(){
      return this.value.toLocaleString();
    });

  // set titles for axises
  chart.xAxis().title('Sexe');
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

		<div id='moyReussiteSexe'></div>
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
  chart.padding([10,10,5,5]);

  // set chart title text settings
  chart.title('Note moyenne de reussite en fonction de l affichage de la jauge');

  // create area series with passed data
  var series = chart.bar(t);
  // set tooltip formatter
  series.tooltip().titleFormatter(function(){return this.x});
  series.tooltip().textFormatter(function () {
      return 'Valeur : ' + this.value.toLocaleString();
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
						 <script type="text/javascript">
         anychart.onDocumentReady(function() {
   // ne marche pas completement je comprend pas pourquoi. Une fois sur deux
                  	         	<?php

	$sql0='CALL moyReussiteChemin(0);';
	$res0 = $bdd -> query($sql0);
	$chemin0 = $res0 -> fetchColumn();

	$sqlFaux1='CALL moyReussiteChemin(0);';
	$res4 = $bdd -> query($sqlFaux1);

	$sql1='CALL moyReussiteChemin(1);';
	$res1 = $bdd -> query($sql1);
	$chemin1 = $res1 -> fetchColumn();

	$sqlFaux5='CALL moyReussiteChemin(0);';
	$res5 = $bdd -> query($sqlFaux5);

	$sql2='CALL moyReussiteChemin(2);';
	$res2 = $bdd -> query($sql2);
	$chemin2 = $res2 -> fetchColumn();

	$sqlFaux6='CALL moyReussiteChemin(0);';
	$res6 = $bdd -> query($sqlFaux6);

	$sql3='CALL moyReussiteChemin(3);';
	$res3 = $bdd->query($sql3);
	$chemin3 = $res3 -> fetchColumn();

	$tab = array(["Facile", $chemin0],["Facile - Difficile", $chemin1],["Difficile - Facile", $chemin2],["Difficile", $chemin3]); // création du tableau PHP

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
      return 'Valeur : ' + this.value.toLocaleString();
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
		
		<script type="text/javascript">
         anychart.onDocumentReady(function(){
         	<?php
         	$sqlZNFaux='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Non"
AND jauge = 0';
	$resZNFaux = $bdd->query($sqlZNFaux);
         	
$sqlZN='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Non"
AND jauge = 0';
	$resZN = $bdd->query($sqlZN);
	$jaugeZN = $resZN -> fetchColumn();
	
	$sqlZO='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Oui"
AND Jauge = 0';
	$resZO = $bdd->query($sqlZO);
	$jaugeZO = $resZO -> fetchColumn();
	
	$sqlUN='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Non"
AND jauge = 1';
	$resUN = $bdd->query($sqlUN);
	$jaugeUN = $resUN->fetchColumn();
	
	$sqlUO='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Oui"
AND Jauge = 1';
	$resUO = $bdd->query($sqlUO);
	$jaugeUO = $resUO->fetchColumn();
	$tab = array(["Jauge ",$jaugeZN,$jaugeZO],[" Pas de Jauge ",$jaugeUN , $jaugeUO]);  					// création du tableau PHP

print('var t='.json_encode($tab)); 		// encodage au format JSON et passage au javascript
?>
  // create data set on our data
  var dataSet = anychart.data.set(t);

  // map data for the first series, take x from the zero column and value from the first column of data set
  var seriesData_1 = dataSet.mapAs({x: [0], value: [1]});

  // map data for the second series, take x from the zero column and value from the second column of data set
  var seriesData_2 = dataSet.mapAs({x: [0], value: [2]});

  // create bar chart
  chart = anychart.bar();

  // turn on chart animation
  chart.animation(true);

  // set container id for the chart
  chart.container('reussiteChemin');
  chart.padding([10,40,5,20]);

  // set chart title text settings
  chart.title('Répartition reussite en fonction de la jauge');
  chart.title().padding([0,0,10,0]);

  // set scale minimum
  chart.yScale().minimum(0);

  chart.xAxis().labels().rotation(-90).padding([0,0,20,0]);

  chart.yAxis().labels().textFormatter(function(){
    return this.value.toLocaleString();
  });

  // set titles for Y-axis
  chart.yAxis().title('Nombre personne');

  // helper function to setup settings for series
  var setupSeries = function(series, name) {
    var seriesLabels = series.labels();
    series.hoverLabels().enabled(false);
    seriesLabels.enabled(true);
    seriesLabels.position('right');
    seriesLabels.textFormatter(function(){
      return  this.value.toLocaleString();
    });
    series.name(name);
    seriesLabels.anchor('left');
    series.tooltip().titleFormatter(function () {
      return this.x;
    });
    series.tooltip().textFormatter(function () {
      return this.seriesName + ' : NbPersonne ' + parseInt(this.value).toLocaleString();
    });
    series.tooltip().position('right').anchor('left').offsetX(5).offsetY(0);
  };

  // temp variable to store series instance
  var series;

 // create first series with mapped data
  series = chart.bar(seriesData_1);
  setupSeries(series, 'Non');

  // create second series with mapped data
  series = chart.bar(seriesData_2);
  setupSeries(series, 'Oui');

  // turn on legend
  chart.legend().enabled(true).fontSize(13).padding([0,0,20,0]);

  chart.interactivity().hoverMode('single');
  chart.tooltip().positionMode('point');

  // initiate chart drawing
  chart.draw();
});
        </script>
                <style>
         html, body, #reussiteChemin {
             width: 100%;
             height: 100%;
             margin: 0;
             padding: 0;
         }
        </style>
		
        <div id='reussiteChemin'></div>
	</body>
</html>
