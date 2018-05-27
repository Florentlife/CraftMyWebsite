<?php 
require('modele/forum/forum.class.php');

class AdminForum extends Forum
{
	private $success;
	private $actions;

	public function __construct($bdd)
	{
		Forum::__construct($bdd);
		$this->success = 0;
		$this->actions = 0;
	}

	public function setNewsPermsForum($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum SET perms = :perms WHERE id = :id');
		if($req->execute(array(
			'perms' => $perms,
			'id' => $id
		)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsForum req UPDATE';
	}

	public function setNewsPermsCategorie($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum_categorie SET perms = :perms WHERE id = :id');
		if($req->execute(array('perms' => $perms, 'id' => $id)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsCategorie req UPDATE';
	}

	public function setNewsPermsSousForum($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum_sous_forum SET perms = :perms WHERE id = :id');
		if($req->execute(array('perms' => $perms, 'id' => $id)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsSousForum req UPDATE';
	}

	public function setNewsPermsTopic($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum_post SET perms = :perms WHERE id = :id');
		if($req->execute(array('perms' => $perms, 'id' => $id)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsTopic req UPDATE';
	}

	public function getErreurs(&$e)
	{
		if($this->success == 0)
			return 0;
		else
		{
			$e['type'] = 'Erreur Forum';
			$e['titre'] = 'Erreur Administration';
			$e['contenue'] = '';
			for($i = 0; $i < $this->actions; $i++)
			{
				if(!empty($this->success[$i]))
					$e['contenue'] .= $this->success[$i].'<br/>';
			}
			return 1;
		}
	}

	public function getPage($entite, $id)
	{
		if($entite == 1)
			return 'forum';
		elseif($entite == 2)
			return 'forum';
		elseif($entite == 3)
		{
			$data = $this->SousForum($id);
			return 'forum_categorie&id='.$data['id_categorie'];
		}
		else
			return 'post&id='.$id;
	}
}

?>