	<?php
	session_start();

  require("secu.php");
	require("config.php");

	try{
	$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
	}
	catch(PDOException $e){
		die("Erreur : ".$e->getMessage());
	}

	//Variable pour gérer le css dans zs_deci_diff
	$varcss = 9
	?>

	<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Emotions et Decisions</title>
			<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
			<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-blue.min.css" />
			<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
			<link rel="stylesheet" type="text/css" href="style/styles.css"/>
		</head>

		<body>
			<div id="header">
				<h1>Emotions et Décisions</h1>
				<div class="title">
					<h2>Ressenti</h2>
					<p>Merci de votre participations, dans l'espoir d'ameliorer notre site et d'avoir vos impressions
						veuillez répondre à ces quelques questions s'il vous plait !</p>
				</div>
			</div>

			<form name="frm_fin" action="enr_question_fin.php" method="post">
				<div  id = "question">
					<div class="list">
						<div class="list_fin">
							<ul>
								<li>Avez-vous une question sur laquelle vous voudriez revenir ? <br>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<span class="mdl-list__item-secondary-action">
											<div class = "listcheckbox">
												

													<div class ="checkbox">
													<?php for ($index=1; $index < 5; $index++) {
													?>
													
													<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="list-checkbox-<?php echo $index;?>">
														<input type="checkbox" id="list-checkbox-<?php echo $index;?>" class="mdl-checkbox__input" name="zs_regret[]" value="<?php echo $index;?>">
														<a href="#" class="info">Question <?php echo $index;?>
															<span>
																<?php
																	//recuperation de la var initialisé dans questions.php, tableau contenant les numeros des questions
																	$chemin = $_SESSION['tab_question'];
																	//var_dump($chemin); affiche le tableau pour verif

																	// determination longueur du tableau precedent
																	$long = sizeof($chemin);
																	//echo $long;

																	// Boucle pour afficher toutes les questions auxquels a répondu l'utilisateur

																	$indice = $chemin[$index-1];// transmition du numero de question du tableau a la variable
																	$sql=$bdd->prepare('SELECT id_question, texte FROM question WHERE id_question = ?');
																	$sql->execute(array($indice));
																	$question = $sql->fetch();
																	//affichage des 8 questions, avec pour valeur d'enregistrement le numero de question ( table question Primary key)
																	echo " ".secu::affichage($question['texte'])." ";
																?>
															</span>
														</a><br>
													</label>
													
												<?php
												}
												?>
												</div>
												<div class ="checkbox">
												<?php for ($index=5; $index < 9; $index++) {
													?>
													
													<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="list-checkbox-<?php echo $index;?>">
														<input type="checkbox" id="list-checkbox-<?php echo $index;?>" class="mdl-checkbox__input" name="zs_regret[]" value="<?php echo $index;?>">
														<a href="#" class="info">Question <?php echo $index;?>
															<span>
																<?php
																	//recuperation de la var initialisé dans questions.php, tableau contenant les numeros des questions
																	$chemin = $_SESSION['tab_question'];
																	//var_dump($chemin); affiche le tableau pour verif

																	// determination longueur du tableau precedent
																	$long = sizeof($chemin);
																	//echo $long;

																	// Boucle pour afficher toutes les questions auxquels a répondu l'utilisateur

																	$indice = $chemin[$index-1];// transmition du numero de question du tableau a la variable
																	$sql=$bdd->prepare('SELECT id_question, texte FROM question WHERE id_question = ?');
																	$sql->execute(array($indice));
																	$question = $sql->fetch();
																	//affichage des 8 questions, avec pour valeur d'enregistrement le numero de question ( table question Primary key)
																	echo " ".secu::affichage($question['texte'])." ";
																?>
															</span>
														</a><br>
													</label>
													
												<?php
												}
												?>
												</div>
											</div>
										</span>
									</div>
								</li>
								<br>
								<li>Quelles décisions ont été les plus difficiles à prendre ? <br>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<span class="mdl-list__item-secondary-action">
											<div class = "listcheckbox">
												
													<div class = "checkbox">
													<?php for ($index=1; $index < 5; $index++) {
													?>
													
													<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="list-checkbox-<?php echo $varcss;?>">
														<input type="checkbox" id="list-checkbox-<?php echo $varcss;?>" class="mdl-checkbox__input" name="zs_deci_diff[]" value="<?php echo $index;?>" >
														<a href="#" class="info">Réponse <?php echo $index;?>
															<span>
																<?php
																	//recuperation de la var initialisé dans questions.php, tableau contenant les numeros des questions
																	$chemin = $_SESSION['tab_question'];
																	//var_dump($chemin); affiche le tableau pour verif

																	// determination longueur du tableau precedent
																	$long = sizeof($chemin);
																	//echo $long;

																	// Boucle pour afficher toutes les choix auxquels a fait face l'utilisateur

																	$indice = $chemin[$index-1];// transmition du numero de question du tableau a la variable, pour aller chercher le choix
																	$sql2=$bdd->prepare('SELECT choix1, choix2, c.id_question FROM choix_question c JOIN question on c.id_question=question.id_question WHERE question.id_question = ?');
																	$sql2->execute(array($indice));
																	$choix = $sql2->fetch();

																	//affichage des 8 choix ( 2 par ligne), avec pour valeur d'enregistrement le numeros de question (table choix Foreign key)
																	echo " ".secu::affichage($choix['choix1']).", ".secu::affichage($choix['choix2']);
																?>
															</span>
														</a><br>
													</label>
													
													<?php
													$varcss = $varcss +1;
													}
													?>
													</div>
													<div class = "checkbox">
													<?php for ($index=5; $index < 9; $index++) {
													?>
													
													<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="list-checkbox-<?php echo $varcss;?>">
														<input type="checkbox" id="list-checkbox-<?php echo $varcss;?>" class="mdl-checkbox__input" name="zs_deci_diff[]" value="<?php echo $index;?>" >
														<a href="#" class="info">Réponse <?php echo $index;?>
															<span>
																<?php
																	//recuperation de la var initialisé dans questions.php, tableau contenant les numeros des questions
																	$chemin = $_SESSION['tab_question'];
																	//var_dump($chemin); affiche le tableau pour verif

																	// determination longueur du tableau precedent
																	$long = sizeof($chemin);
																	//echo $long;

																	// Boucle pour afficher toutes les choix auxquels a fait face l'utilisateur

																	$indice = $chemin[$index-1];// transmition du numero de question du tableau a la variable, pour aller chercher le choix
																	$sql2=$bdd->prepare('SELECT choix1, choix2, c.id_question FROM choix_question c JOIN question on c.id_question=question.id_question WHERE question.id_question = ?');
																	$sql2->execute(array($indice));
																	$choix = $sql2->fetch();

																	//affichage des 8 choix ( 2 par ligne), avec pour valeur d'enregistrement le numeros de question (table choix Foreign key)
																	echo " ".secu::affichage($choix['choix1']).", ".secu::affichage($choix['choix2']);
																?>
															</span>
														</a><br>
													</label>
													
													<?php
													$varcss = $varcss +1;
													}
													?>
												</div>
											</div>
										</span>
									</div>
								</li>
							</ul>
						</div>
						<div class="list_fin">
							<ul>
 								<li>Pensez-vous avoir pris les bonnes décisions ?
									<span class="mdl-list__item-secondary-action">
										<p><br>
											<label class="demo-list-radio mdl-radio mdl-js-radio mdl-js-ripple-effect" for="list-option-oui">
												<input type="radio" id="list-option-oui" class="mdl-radio__button" name="zs_reussite" value="Oui" checked required > Oui<br>
											</label>
										</p>
										<p>
											<label class="demo-list-radio mdl-radio mdl-js-radio mdl-js-ripple-effect" for="list-option-non">
												<input type="radio" id="list-option-non" class="mdl-radio__button" name="zs_reussite" value="Non" > Non<br>
											</label>
										</p>
									</span>
								</li>
								<br>
								<br>
								<br>
								<br>
								<li>Sur une échelle de 0 à 10 à combien estimez-vous votre réussite ? <br>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<p>
											<input type = "number" min="0" max="10" class="mdl-textfield__input" id="reussite" pattern="[0-9]*" name="zs_reussite_nota" >
											<label class="mdl-textfield__label" for="reussite"> Une note entre 0 et 10 !</label>
											<span class="mdl-textfield__error">Uniquement un nombre s'il vous plait !</span>
										</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="button">
						<input class="mdl-button mdl-button--raised mdl-button--colored" type="submit" value="Envoyer">
					</div>
				</div>
			</form>
		</body>
	</html>
	<?php

	?>
