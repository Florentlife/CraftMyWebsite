<?php
class JoueurDonnees
{
	private $donnees;
	private $bdd;
	private $reseaux;
	
    public function __construct($bdd, $pseudo)
    {	
    	$this->bdd = $bdd;
		$req = $bdd->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(Array ( 'pseudo' => $pseudo ));
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		$this->donnees = $donnees;
		$this->listReseaux();
		$this->getReseaux($donnees['id']);
	}
	
	public function getTableauDonnees(&$reseaux)
	{
		$reseaux = $this->reseaux;
		return $this->donnees;
	}

	private function getReseaux($id)
	{
		$req = $this->bdd->prepare('SELECT * FROM cmw_reseaux WHERE idJoueur = :id');
		$req->execute(array(
			'id' => $id
		));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		foreach($this->reseaux as $value)
		{
			if(empty($data[$value['nom']]))
				$this->donnees[$value['nom']] = "inconnu";
			else
				$this->donnees[$value['nom']] = $data[$value['nom']];
		}
	}

	private function listReseaux()
	{
		$req = $this->bdd->query('SELECT COLUMN_NAME AS nom FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "cmw_reseaux"');
		$donneesSocial = $req->fetchAll(PDO::FETCH_ASSOC);
		array_shift($donneesSocial);
		array_shift($donneesSocial);
		$this->reseaux = $donneesSocial;
	}
}
?>