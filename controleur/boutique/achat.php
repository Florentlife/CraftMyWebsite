<?php
	if($_Joueur_['tokens'] >= $_Panier_->montantGlobal())
	{
		$nb = $_Panier_->compterArticle();
		for($a = 0; $a < $nb; $a++)
		{
			$recupActions = $bddConnection->prepare('SELECT * FROM cmw_boutique_action WHERE id_offre = :id_offre');
			$recupActions->execute(array('id_offre' => $_SESSION['panier']['id'][$a]));
			for($i = 0; $i < count($lecture['Json']); $i++)
			{
				$jsonCon[$i]->SetConnectionBase($bddConnection);
			}
			$offre = $_SESSION['panier']['id'][$a];
			require_once('modele/boutique/offres.class.php'); 
			$offres = new OffresList($bddConnection, $_Joueur_, $jsonCon);
			$offresTableau = $offres->GetTableauOffres();
			$offresByGet = $offres->GetOffresGet();

			require_once('modele/boutique/categories.class.php');
			$categoriesObj = new CategoriesList($bddConnection);
			$categories = $categoriesObj->GetTableauCategories();

			for($i = 0; $i < count($lecture['Json']); $i++)
			{
				$enligne[$i] = false;
				if(isset($_Joueur_['pseudo']) AND isset($serveurStats[$i]['joueurs']) AND in_array($_Joueur_['pseudo'], $serveurStats[$i]['joueurs']))
					$enligne[$i] = true;
			}
			$infosOffre = $offres->GetInfosOffre($offre, $_Joueur_);
			$infosCategories = $categoriesObj->GetInfosCategorie($infosOffre['offre']['categorie'], $lecture['Json']);
			for($i = 0; $i < count($lecture['Json']); $i++)
			{
				$jsonCon[$i]->SetPlayerName($_Joueur_['pseudo']);
			}
			while($donneesActions = $recupActions->fetch())
			{

				if($infosCategories['serveurId'] == -1) 
					for($i = 0; $i < count($lecture['Json']); $i++)
					{
						for($z=0; $z < $_SESSION['panier']['quantite'][$a]; $z++)
						{
							SendCommand($jsonCon[$i], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree']);
						}
					}
				elseif($infosCategories['serveurId'] == -2)
					for($i = 0; $i < count($lecture['Json']); $i++)
					{
						for($z = 0; $z < $_SESSION['panier']['quantite'][$a]; $z++)
						{
							if($enligne[$i])
								SendCommand($jsonCon[$i], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree']);
						}
					}
				else
					for($z = 0; $z < $_SESSION['panier']['quantite'][$a]; $z++)
					{
						SendCommand($jsonCon[$infosCategories['serveurId']], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree']);
					}
			}
			require_once('modele/app/statistiques.class.php');
		    $stats = new StatsUpdate($bddConnection);
		    $prix = $_SESSION['panier']['prix'][$a]*$_SESSION['panier']['quantite'][$a]*(1-$_SESSION['panier']['reduction']);
		    $stats->AddSell($_SESSION['panier']['id'][$a], $prix, $_Joueur_['pseudo']);
			$oldValues = $bddConnection->prepare('SELECT tokens FROM cmw_users WHERE pseudo = :pseudo');
			$oldValues->execute( array (
				'pseudo' => $_Joueur_['pseudo'] ));
			$oldTokens = $oldValues->fetch();
			$update = $bddConnection->prepare('UPDATE cmw_users set tokens = :tokens WHERE pseudo = :pseudo');
			$update->execute( array (
				'tokens' => $oldTokens['tokens'] - $prix,
				'pseudo' => $_Joueur_['pseudo'] ));

			$_Joueur_['tokens'] = $_Joueur_['tokens'] - $prix;
			$_SESSION['Player']['tokens'] = $_Joueur_['tokens'];
		}
		$_Panier_->supprimerPanier();
		header('Location: ?page=panier');
	}
	else
		header('Location: ?page=erreur&erreur=18');

function SendCommand($jsonCon, $methode, $valeur, $duree)
{
	if($methode == 0)
		$jsonCon->runConsoleCommand($valeur);
	
	if($methode == 1)
		$jsonCon->SendBroadcast($valeur);
		
	if($methode == 2)
		$jsonCon->AddPlayerToGroup($valeur, $duree);
	
	if($methode == 3)
		$jsonCon->GivePlayerItem($valeur);
		
	if($methode == 4)
		$jsonCon->GivePlayerMoney($valeur);
		
	if($methode == 5)
		$jsonCon->GivePlayerXp($valeur);
}
?>
