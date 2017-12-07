<?php
if(isset($_POST['pseudo']) AND isset($_POST['mdp']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']))
{
	$get_Pseudo = $_POST['pseudo'];

	$bddConnection = $base->getConnection();
	require_once('modele/joueur/connection.class.php');
	$userConnection = new Connection($_POST['pseudo'], $bddConnection);
	$ligneReponse = $userConnection->getReponseConnection();
	
	$donneesJoueur = $ligneReponse->fetch();
	if(empty($donneesJoueur))
	{
		header('Location: ?&page=erreur&erreur=5');
	}
	else
	{
		$compte_valide_pour_connection = false;
		if(preg_match('/^[a-f0-9]{32}$/', $donneesJoueur['mdp']))
		{
			if(md5(sha1($_POST['mdp'])) == $donneesJoueur['mdp'])
			{
				$req = $bddConnection->prepare('UPDATE cmw_users SET mdp = :mdp WHERE pseudo = :pseudo');
				$req->execute(array(
					'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
					'pseudo' => htmlspecialchars($_POST['pseudo'])
				)); 
				$compte_valide_pour_connection = true;
			}
		}
		else
		{
			if(password_verify($_POST['mdp'], $donneesJoueur['mdp']))
			{
				$compte_valide_pour_connection = true;
			}
		}
		if($compte_valide_pour_connection)
		{
			require_once('modele/joueur/ScriptBySprik07/reqVerifMailBDD.class.php');
			$req_verifMailBdd = new VerifMailBdd($get_Pseudo, $bddConnection);
			$rep_verifMailBdd = $req_verifMailBdd->getReponseConnection();
			$get_verifMailBdd = $rep_verifMailBdd->fetch();
			$VerifMailBdd = $get_verifMailBdd['ValidationMail'];

			if($VerifMailBdd == '1')
			{
				require_once('controleur/joueur/joueurcon.class.php');
				$reconnexion = NULL;
				if(isset($_POST['reconnexion']))
					$reconnexion = 1;
				$utilisateur_connection = new JoueurCon($donneesJoueur['id'], $donneesJoueur['pseudo'], $donneesJoueur['email'], $donneesJoueur['rang'], $donneesJoueur['tokens'], $reconnexion, $donneesJoueur['mdp']);
				header('Location: '.$_SERVER['HTTP_REFERER']);
			}
			else
			{
				header('Location: ?&page=erreur&erreur=14');
			}
		}
		else 
		{ 
			header('Location: ?&page=erreur&erreur=6');
		}
	}
}
else
{
	header('Location: ?&page=erreur&erreur=4');
}
?>
