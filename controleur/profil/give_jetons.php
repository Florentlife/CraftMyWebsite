<?php 
if(isset($_POST['pseudo']) && isset($_POST['montant']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
	$req->execute(array(
		'pseudo' => $pseudo
	));
	$row = $req->rowCount();
	if($row > 0)
	{
		$req = $bddConnection->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $_Joueur_['pseudo']
		));
		$donnees = $req->fetch();
		if($_POST['montant'] <= $donnees['tokens'])
		{
			$exec = $bddConnection->prepare('UPDATE cmw_users SET tokens = tokens + :jetons WHERE pseudo = :pseudo');
			$exec->execute(array(
				'jetons' => $_POST['montant'],
				'pseudo' => $pseudo
			));
			$moins = $bddConnection->prepare('UPDATE cmw_users SET tokens = tokens - :jetons WHERE pseudo = :pseudo');
			$moins->execute(array(
				'jetons' => $_POST['montant'],
				'pseudo' => $_Joueur_['pseudo']
			));
			$_Joueur_['tokens'] = $_Joueur_['tokens'] - $_POST['montant'];
			header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&success=jetons&pseudo='.$pseudo.'&montant='.$_POST['montant']);
		}
		else
		{
			header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&erreur=4');
		}
	}
	else
	{
		header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&erreur=5');
	}
}

?>