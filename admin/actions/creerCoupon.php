<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['creerCoupon'] == true)
{
	if(isset($_POST['code'], $_POST['titre'], $_POST['pourcent']))
	{
		$code = htmlspecialchars($_POST['code']);
		$titre = htmlspecialchars($_POST['titre']);
		$pourcent = htmlspecialchars($_POST['pourcent']);

		$req = $bddConnection->prepare('INSERT INTO cmw_boutique_reduction (code_promo, pourcent, titre) VALUES (:code, :pourcent, :titre)');
		$req->execute(array('code' => $code,
							'pourcent' => $pourcent,
							'titre' => $titre ));
		header('Location: ?page=boutique');
	}

}