<?php
session_start();
        //On nomme les variables du formulaire

            $reussite=$_POST['zs_reussite'];
            $reussite_nota=$_POST['zs_reussite_nota'];

            if ( isset($_POST['zs_regret']) && is_array($_POST['zs_regret']) ) {
    				$regret = implode(',', $_POST['zs_regret']) ;
				} else {
    				$regret = '' ;
				}

            if ( isset($_POST['zs_deci_diff']) && is_array($_POST['zs_deci_diff']) ) {
    				$deci_diff = implode(',', $_POST['zs_deci_diff']) ;
				} else {
    				$deci_diff = '' ;
				}




print_r($_POST['zs_regret']);
echo ",";
print_r($_POST['zs_deci_diff']);
echo ",";



        require("config.php");

		try{
		$bdd = new PDO($_SGBD["nsd"], $_SGBD["username"], $_SGBD["password"]);
		}
		catch(PDOException $e){
			die("Erreur : ".$e->getMessage());
		}

         //Recup de l'id max donc du dernier utilisateur

		$id_max = $_SESSION['id_utilisateur'];





         //transfert des données vers la database avec requete preparée

         $req = $bdd->prepare('UPDATE utilisateur SET regret = :regret, deci_diff = :deci_diff, reussite = :reussite, reussite_nota = :reussite_nota WHERE id_personne="'.$id_max.'"');

         $req->execute(array(

             'regret' => $regret,

             'deci_diff' => $deci_diff,

             'reussite' => $reussite,

             'reussite_nota' => $reussite_nota

             ));

  session_destroy();

	header('location: ./page_fin.html');
?>
