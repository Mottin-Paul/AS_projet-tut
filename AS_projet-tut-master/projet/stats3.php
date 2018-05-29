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

		?>
		
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
	$tab = array(["Pas de Jauge ",$jaugeZN,$jaugeZO],["Avec une Jauge ",$jaugeUN , $jaugeUO]);  					// création du tableau PHP

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
  chart.padding([10,40,10,20]);

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
         	
        <div id='reussiteChemin'></div>
               <style>
         #reussiteChemin {
             width: 100%;
             height: 100%;
             margin: 0;
             padding: 0;
         }
        </style>
        
        		<script type="text/javascript">
         anychart.onDocumentReady(function(){
         	<?php
         	         	
$sqlFN='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Non"
AND sexe = "femme"';
	$resFN = $bdd->query($sqlFN);
	$jaugeFN = $resFN -> fetchColumn();
	
	$sqlFO='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Oui"
AND sexe = "femme"';
	$resFO = $bdd->query($sqlFO);
	$jaugeFO = $resFO -> fetchColumn();
	
	$sqlHN='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Non"
AND sexe = "homme"';
	$resHN = $bdd->query($sqlHN);
	$jaugeHN = $resHN->fetchColumn();
	
	$sqlHO='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM utilisateur
JOIN appartient on utilisateur.id_personne = appartient.id_personne
JOIN jeux on appartient.id_questionnaire = jeux.id_questionnaire
WHERE reussite = "Oui"
AND sexe = "homme"';
	$resHO = $bdd->query($sqlHO);
	$jaugeHO = $resHO->fetchColumn();
	
	$tab = array(["Femme",$jaugeFN,$jaugeFO],["Homme",$jaugeHN , $jaugeHO]);  					// création du tableau PHP

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
  chart.container('reussiteSexe');
  chart.padding([10,40,5,20]);

  // set chart title text settings
  chart.title('Répartition reussite en fonction du sexe');
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
         	
        <div id='reussiteSexe'></div>
               <style>
         #reussiteSexe {
             width: 100%;
             height: 100%;
             margin: 0;
             padding: 0;
         }
        </style>
        
                		<script type="text/javascript">
         anychart.onDocumentReady(function(){
         	<?php
         	         	         	
$sqlC0N='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Non"
AND categorie = 0';
	$resC0N = $bdd->query($sqlC0N);
	$jaugeC0N = $resC0N -> fetchColumn();
	
	$sqlC0O='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Oui"
AND categorie = 0';
	$resC0O = $bdd->query($sqlC0O);
	$jaugeC0O = $resC0O -> fetchColumn();
	
	$sqlC1N='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Non"
AND categorie = 1';
	$resC1N = $bdd->query($sqlC1N);
	$jaugeC1N = $resC1N -> fetchColumn();
	
	$sqlC1O='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Oui"
AND categorie = 1';
	$resC1O = $bdd->query($sqlC1O);
	$jaugeC1O = $resC1O -> fetchColumn();
	
	$sqlC2N='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Non"
AND categorie = 2';
	$resC2N = $bdd->query($sqlC2N);
	$jaugeC2N = $resC2N -> fetchColumn();
	
	$sqlC2O='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Oui"
AND categorie = 2';
	$resC2O = $bdd->query($sqlC2O);
	$jaugeC2O = $resC2O -> fetchColumn();
	
	$sqlC3N='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Non"
AND categorie = 3';
	$resC3N = $bdd->query($sqlC3N);
	$jaugeC3N = $resC3N -> fetchColumn();
	
	$sqlC3O='SELECT COUNT(DISTINCT utilisateur.id_personne) FROM jeux
JOIN appartient on appartient.id_questionnaire = jeux.id_questionnaire
JOIN utilisateur on utilisateur.id_personne = appartient.id_personne
WHERE reussite = "Oui"
AND categorie = 3';
	$resC3O = $bdd->query($sqlC3O);
	$jaugeC3O = $resC3O -> fetchColumn();
	
	$tab = array(["Facile",$jaugeC0N,$jaugeC0O],["Facile - Difficile",$jaugeC1N , $jaugeC1O],
	["Difficile - Facile",$jaugeC2N,$jaugeC2O],["Difficile",$jaugeC3N , $jaugeC3O]);  					// création du tableau PHP

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
  chart.title('Répartition reussite en fonction du chemin');
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
         	
        <div id='reussiteChemin'></div>
            <style>
         html, body, #reussiteChemin {
             width: 100%;
             height: 50%;
             margin: 0;
             padding: 0;
         }
        form {
			display:inline;
		}
        </style>
        
        <form name="frm" action="./stats2.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Précédent">
		</form>
		
		<form name="frm" action="./stats4.php" method="post">
				<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Suivant">
		</form>        
	</body>
</html>