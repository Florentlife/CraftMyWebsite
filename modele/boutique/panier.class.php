<?php 
class Panier
{

	private $bdd;

	public function __construct($bdd)
	{
		if(!isset($_SESSION['panier']))
		{
			$_SESSION['panier'] = array();
			$_SESSION['panier']['id'] = array();
			$_SESSION['panier']['quantite'] = array();
			$_SESSION['panier']['prix'] = array();
			$_SESSION['panier']['reduction'] = 0;
			$_SESSION['panier']['reduction_titre'] = '';
			$_SESSION['panier']['code'] = '';
		}
		$this->bdd = $bdd;
	}

	public function ajouterProduit($id, $quantite, $prix)
	{
			$pos = array_search($id, $_SESSION['panier']['id']);

			if($pos !== false)
			{
				$_SESSION['panier']['quantite'][$pos] += $quantite;
			}
			else
			{
				array_push($_SESSION['panier']['id'], $id);
				array_push($_SESSION['panier']['quantite'], $quantite);
				array_push($_SESSION['panier']['prix'], $prix);
			}
			return true;
	}

	public function supprimerProduit($id)
	{
			$tmp = array();
			$tmp['id'] = array();
			$tmp['quantite'] = array();
			$tmp['prix'] = array();
			$tmp['verrou'] = false;

			for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
			{
				if($_SESSION['panier']['id'][$i] !== $id)
				{
					array_push($tmp['id'], $_SESSION['panier']['id'][$i]);
					array_push($tmp['quantite'], $_SESSION['panier']['quantite'][$i]);
					array_push($tmp['prix'], $_SESSION['panier']['prix'][$i]);
				}
			}

			$_SESSION['panier'] = $tmp;
			unset($tmp);
			return true;
	}

	public function modifierQteArticle($id, $quantite)
	{
		if($quantite > 0)
			{
				$pos = array_search($id, $_SESSION['panier']['id']);

				if($pos !== false)
				{
					$_SESSION['panier']['quantite'][$pos] = $quantite;
				}
				else
					return FALSE;
				return TRUE;
			}
			else
			{
				$this->supprimerProduit($id);
				return true;
			}
	}

	public function montantGlobal()
	{
		$total = 0;
		for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
		{
			$req = $this->bdd->prepare('SELECT prix FROM cmw_boutique_offres WHERE id = :id');
			$req->execute(array(
				'id' => htmlspecialchars($_SESSION['panier']['id'][$i])
			));
			$fetch = $req->fetch(PDO::FETCH_ASSOC);
			$total += $_SESSION['panier']['quantite'][$i] * $fetch['prix'];
		}
		return $total*(1-$_SESSION['panier']['reduction']);
	}

	public function compterArticle()
	{
		return count($_SESSION['panier']['id']);
	}

	public function supprimerPanier()
	{
		unset($_SESSION['panier']);
	}

	public function infosArticle($id, &$nom, &$infos)
	{
			$req = $this->bdd->prepare('SELECT nom, description FROM cmw_boutique_offres WHERE id = :id');
			$req->execute(array(
				'id' => $id
			));
			$fetch = $req->fetch(PDO::FETCH_ASSOC);
			$nom = $fetch['nom'];
			$infos = $fetch['description'];
	}

	public function ajouterReduction($code)
	{
		setcookie('titre', 1, time()+3600000);
		if($this->verifReduction($code, $pourcent, $titre))
		{
			if($pourcent <= 100 && $pourcent > 0)
			{
				$_SESSION['panier']['reduction'] = $pourcent/100;
				$_SESSION['panier']['reduction_titre'] = htmlspecialchars($titre);
				$_SESSION['panier']['code'] = htmlspecialchars($code);
			}
		}
	}

	public function retirerReduction()
	{
		$_SESSION['panier']['reduction'] = 0;
		$_SESSION['panier']['reduction_titre'] = '';
	}

	private function verifReduction($code, &$pourcent, &$titre)
	{
		$req = $this->bdd->prepare('SELECT pourcent, titre FROM cmw_boutique_reduction WHERE code_promo = :code');
		$req->execute(array(
			'code' => htmlspecialchars($code)
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if(isset($fetch['titre']) AND isset($fetch['pourcent']))
		{
			$pourcent = $fetch['pourcent'];
			$titre = $fetch['titre'];
			return true;
		}
		else
			return false;
	}
}