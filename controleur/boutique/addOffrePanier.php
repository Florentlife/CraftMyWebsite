<?php 
if(isset($_Joueur_) && isset($_GET['offre']) && isset($_GET['quantite']))
{
	if($_GET['quantite'] > 0)
	{
		$req = $bddConnection->prepare('SELECT prix FROM cmw_boutique_offres WHERE id = :offre');
		$req->execute(array(
			'offre' => htmlspecialchars($_GET['offre'])
		));
		$fetch = $req->fetch();
		$execution = $_Panier_->ajouterProduit(htmlspecialchars($_GET['offre']), htmlspecialchars($_GET['quantite']), $fetch['prix']);
		if($execution !== false)
			header('Location: ?page=boutique');
		else
			var_dump($execution); var_dump($_GET);
	}
	else
		header('Location: ?page=erreur&erreur=17');
}
else
	header('Location: ?page=erreur&erreur=17');
?>