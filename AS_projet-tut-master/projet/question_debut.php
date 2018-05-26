<?php

session_start();

$_SESSION['first_question'] = 1;

//Estimation du nb d'heures passé en famille
	$heure_famille= 18*7 - $_POST['zs_heure_metier'] -$_POST['zs_heure_act'] - $_POST['zs_sommeil'] * 7;


	require("config.php");

	try{
	$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
	}
	catch(PDOException $e){
		die("Erreur : ".$e->getMessage());
	}

	 //transfert des données vers la database avec requete preparée

	$req = $bdd->prepare('INSERT INTO utilisateur(sexe, age, situation_familliale, nombre_enfants, csp, csp_heure, activite, activite_heure, heure_sommeil, heure_famille)
									 VALUES( :sexe, :age, :situation_familliale, :enfant, :csp, :csp_heure, :activite, :activite_heure, :heure_sommeil, :heure_famille )');

	$req->execute(array(
		'sexe' => $_POST['zs_genre'],
		'age' => $_POST['zs_age'],
		'situation_familliale' => $_POST['zs_famille'],
		'enfant' => $_POST['zs_enfant'],
		'csp' => $_POST['zs_metier'],
		'csp_heure' => $_POST['zs_heure_metier'],
		'activite' => $_POST['zs_activite'],
		'activite_heure' => $_POST['zs_heure_act'],
		'heure_sommeil' => $_POST['zs_sommeil'],
		'heure_famille' => $heure_famille

	));

	//Recup id max utilisateur, pour inserer le type de chemin
	$id = $bdd ->prepare('SELECT MAX(id_personne) from utilisateur');
	$id ->execute();
	$id = $id ->fetch();
	$id = $id[0];
	$_SESSION['id_utilisateur'] = $id;

	$chemin=$id%4;

  // Insertion du type de chemin dans table jeux
	$sql = $bdd->prepare('INSERT INTO jeux(categorie) VALUES(?)');
	$sql->execute(array($chemin));
	$sql->closeCursor();

	// Insertion temps depart du questionnaire dans table jeux
	$insert_temps = $bdd->exec("UPDATE jeux SET temps_debut_utilisateur = now() where temps_debut_utilisateur is null ");

	// On recupére l'id du questionnaire qui vient juste de se creer
	$id_questionnaire = $bdd ->prepare('SELECT MAX(id_questionnaire) from jeux');
	$id_questionnaire ->execute();
	$id_questionnaire= $id_questionnaire->fetch();
	$id_questionnaire = $id_questionnaire[0];
	$_SESSION['id_questionnaire'] = $id_questionnaire;

	//Pour n'insérer qu'une fois l'affichage jauge dans table jeux
	$_SESSION['nb_insertion_jauge']=1;
	//creation d'un nombre aleatoire qui choisira les utilisateurs qui verront la jauge (50% de change)
    $_SESSION['nb_aleatoire'] = rand(1,2);
		$_SESSION['jauge'] = 50;



// Après envoie du questionnaire, redirection vers page jeu

header('location: ./Questions.php');  //location: http://localhost/projet/Questions.php

exit();

?>
