<?php 
if(isset($_Joueur_) && ($_PGrades_['PermsForum']['moderation']['selTopic'] == true OR $_Joueur_['rang'] == 1))
{
	foreach($_POST['id'] as $value)
	{
		$id = htmlspecialchars($value);
		$idCat = htmlspecialchars($_POST['idCat']);
		if(isset($_POST['prefix']) && ($_PGrades_['PermsForum']['moderation']['addPrefix'] == true OR $_Joueur_['rang'] == 1))
		{
			$prefix = htmlspecialchars($_POST['prefix']);
			$req = $bddConnection->prepare('UPDATE cmw_forum_post SET prefix = :prefix WHERE id = :id');
			$req->execute(array(
				'prefix' => $prefix,
				'id' => $id
				));
			
		}
		if(isset($_POST['epingle']) && ($_PGrades_['PermsForum']['moderation']['epingle'] == true OR $_Joueur_['rang'] == 1))
		{
			$epingle = htmlspecialchars($_POST['epingle']);
			$req = $bddConnection->prepare('UPDATE cmw_forum_post SET epingle = :epingle WHERE id = :id');
			$req->execute(array(
				'epingle' => $epingle,
				'id' => $id
			));
		}
		if(isset($_POST['close']) && ($_PGrades_['PermsForum']['moderation']['closeTopic'] == true OR $_Joueur_['rang'] == 1))
		{
			$close = htmlspecialchars($_POST['close']);
			$req = $bddConnection->prepare('UPDATE cmw_forum_post SET etat = :etat WHERE id = :id');
			$req->execute(array(
				'etat' => $close,
				'id' => $id
				));
		}
		if(isset($_POST['idSF']))
		{
			$sf = htmlspecialchars($_POST['idSF']);
			header('Location: ?page=forum_categorie&id='.$idCat.'&id_sous_forum='.$sf);
		}
		else
			header('Location: ?page=forum_categorie&id='.$idCat);
	}
}