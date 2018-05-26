<?php
session_start();
// fonction de redirection vers page web
function redirect_to($url) {
	header($url);
}

require ("secu.php");
require ("config.php");
try {
	$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
} catch(PDOException $e) {
	die("Erreur : " . $e -> getMessage());
}
$num_personne = $_SESSION['id_utilisateur'];
$num_question = $_SESSION['num_question'];
// On récupére la reponse
$reponse = $_POST['choix'];
// On intègre les reponses dans la bdd
$req = $bdd -> prepare('INSERT INTO reponse(reponse) VALUES(?)');
$req -> execute(array($reponse));
$req -> closeCursor();
//On recupere l'id max reponse qu'on met dans une variable session (moins risque mélange de données si pls utilisateurs)
$num_reponse = $bdd -> prepare('SELECT MAX(id_reponse) FROM reponse');
$num_reponse -> execute();
$num_reponse = $num_reponse -> fetch();
$num_reponse = $num_reponse[0];
$_SESSION['id_reponse'] = $num_reponse;
//Gestion et modification de la jauge
$affichage_jauge = $_SESSION['affichage_jauge'];
$jauge = $_SESSION['jauge'];
$nb_aleatoire = $_SESSION['nb_aleatoire'];
if ($nb_aleatoire == 2) {
	$choix = $bdd -> prepare('Select * from choix_question where id_choix = "' . $num_question . '"');
	$choix -> execute();
	$intitule_choix = $choix -> fetch();
	$choix = $intitule_choix['choix1'];
	//Modification de la jauge selon réponse de l'utilisateur
	if ($choix == $reponse) {
		$bonus = rand(-10, 15);
		$_SESSION['jauge'] = $jauge + $bonus;
	} else {
		$bonus = rand(-10, 10);
		$_SESSION['jauge'] = $jauge - $bonus;
	}
}
$max_question_facile = $bdd -> prepare('select id_question from question_facile where id_question in (select max(id_question) from question_facile)');
$max_question_facile -> execute();
$valeur_facile = $max_question_facile -> fetch();
$i = $_SESSION['i'];
//Récupère les valeurs pour la table appartient
//Recup id max questionnaire
$num_questionnaire = $bdd -> prepare('SELECT MAX(id_questionnaire) FROM jeux');
$num_questionnaire -> execute();
$num_questionnaire = $num_questionnaire -> fetch();
$num_questionnaire = $num_questionnaire[0];
// Insertion dans appartient
$req = $bdd -> prepare('INSERT INTO appartient(id_questionnaire,id_reponse,id_question,id_personne)
													VALUES(:id_questionnaire,:id_reponse,:id_question,:id_personne)');
$req -> execute(array('id_questionnaire' => $num_questionnaire, 'id_reponse' => $num_reponse, 'id_question' => $num_question, 'id_personne' => $num_personne));
$req -> closeCursor();
// Insertion du temps de réponse pour la question 1
if ($num_question == 1 || $num_question == 2) {
	$insert_temps_rep_1 = $bdd -> query("CALL Insert_temps_reponse_1 ($num_personne)");
}
// Insertion du temps pour les autres réponse
else if ($num_question > 2) {
	$insert_temps_rep_autre = $bdd -> query("CALL Insert_temps_reponse_autre ($num_personne)");

}
if ($i < $valeur_facile['id_question'] / 2) {
	$i++;
	$_SESSION['i'] = $i;
	$_SESSION['first_question'] = 2;
	redirect_to('location:./Questions.php');
	//http://localhost/Testouille/Questions.php
}
if ($i >= $valeur_facile['id_question'] / 2) {
	// Redirection vers questionnaire fin si jeu fini
	$bdd -> query("CALL Insert_temps_tot ($num_personne)");
	header('location:./question_fin.php');
	exit();
}
?>
