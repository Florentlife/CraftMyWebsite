<?php 
require('modele/grades/NOT_TOUCH/perms.config.php');

class Permission {

	private $joueur;
	private $bdd;

	private static $instance = null; //Instance de la classe singleton

	//Constructeur
	private function __construct($joueur, $bdd) {
		$this->joueur = $joueur;
		$this->bdd = $bdd;
	}

	//Gestion du Singleton
	public static function getInstance() {
		global $bddConnection;
		global $_Joueur_;
		if(is_null(self::$instance))
		{
			self::$instance = new Permission($_Joueur_, $bddConnection);
		}
		return self::$instance;
	}

	public function verifPerm(...$perm)
	{
		$grade = $this->getGrade();
		if($grade == 0)
		{
			if($perm == "connect")
				return true;
			return false;
		}
		if($grade == -1)
			return false;
		if($grade == 1)
			return true;
		else
		{
			$TableauPerm = $this->readPerm($grade);
			$retour = false;
			foreach($perm as $value)
			{
				if(!is_array($TableauPerm[$value]))
				{
					if($TableauPerm[$value] == 'on' || $TableauPerm[$value] === true)
						$retour = true;
				}
				else
					$TableauPerm = $TableauPerm[$value];
			}
			return $retour;
		}

	}

	private function readPerm($grade)
	{
		$lecture = new Lire('modele/grades/'.$grade.'.yml');
		$lecture = $lecture->GetTableau();
		return $lecture;
	}


	//Récupère le grade du joueur
	private function getGrade() {
		if($this->exist($this->joueur))
		{
			$req = $this->bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
			$req->execute(array(
				'pseudo' => $this->joueur['pseudo']
			));
			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data['rang'];
		}
		return -1;
	}

	private function exist($pseudo)
	{
		if(!is_null($this->joueur))
			return true;
		return false;
	}

}

?>