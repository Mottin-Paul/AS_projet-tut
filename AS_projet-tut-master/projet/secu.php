<?php
	class Secu
	{
		public static function affichage($var)
		{
			return  htmlspecialchars($var);
		}

		public static function identification($pass)
		{

			if ($pass ==  "hehehe"){
				return true;
			}
			else{
				return false;
			}

		}
		public static function determi_chemin($id_personne){


			require("config.php");

			try{
			$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
			}
			catch(PDOException $e){
				die("Erreur : ".$e->getMessage());
			}

			$max_question_difficile = $bdd->prepare('SELECT id_question FROM question_difficile WHERE id_question IN (SELECT MAX(id_question) FROM question_difficile)');
		  $max_question_difficile -> execute();
			$valeur_difficile = $max_question_difficile->fetch();
			//echo $valeur_difficile['id_question'];

			$max_question_facile = $bdd->prepare('SELECT id_question FROM question_facile WHERE id_question IN (SELECT MAX(id_question) FROM question_facile)');
		  $max_question_facile -> execute();
			$valeur_facile = $max_question_facile->fetch();
			//echo $valeur_facile['id_question'];

			// Chemin question difficile
				if($id_personne % 4 == 0){
					$compteur = 0;
					$num_question = 1;

					while ($num_question <= $valeur_difficile['id_question']) {

						$chemin[$compteur] = $num_question;
						$compteur++;
						$num_question = $num_question + 2;
					}

				return $chemin;

				}

		// Chemin question facile
			if($id_personne % 4 == 1){
				$compteur = 0;
				$num_question = 2;

				while ($num_question <= $valeur_facile['id_question']) {

					$chemin[$compteur] = $num_question;
					$compteur++;
					$num_question = $num_question + 2;
			}

			return $chemin;

			}

			// Chemin question facile-difficile
				if($id_personne % 4 == 2){
					$compteur = 0;
					$num_question = 2;

					while ($num_question <= $valeur_difficile['id_question']) {

						$chemin[$compteur] = $num_question;
						$compteur++;
						$num_question = $num_question + 2;

						if ($num_question > $valeur_facile['id_question'] / 2 && $num_question % 2 == 0) {
							$num_question = $num_question - 1;
						}
					}

				return $chemin;

				}

				// Chemin question difficile-facile
					if($id_personne % 4 == 3){
						$compteur = 0;
						$num_question = 1;

						while ($num_question <= $valeur_facile['id_question']) {

							$chemin[$compteur] = $num_question;
							$compteur++;
							$num_question = $num_question + 2;

							if ($num_question > $valeur_facile['id_question'] / 2 && $num_question % 2 == 1) {
								$num_question = $num_question + 1;
							}
						}

					return $chemin;

					}
		}
	}
?>
