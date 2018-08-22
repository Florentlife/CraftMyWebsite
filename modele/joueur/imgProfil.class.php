<?php

class ImgProfil
{
	private $img;
	private $extension;
	private $bdd;
	private $id;
	public $modif;

	public function __construct($id, $mode='id')
	{
		global $bddConnection;
		$this->bdd = $bddConnection;
		if($mode == 'pseudo')
		{
			if($id == 'CraftMyWebsite')
				$this->id = NULL;
			else
			{
				$req = $bddConnection->prepare('SELECT id FROM  cmw_users WHERE pseudo = :pseudo');
				$req->execute(array(
					'pseudo' => $id
				));
				$fetch = $req->fetch(PDO::FETCH_ASSOC);
				if($fetch['id'] == NULL)
					$this->id = $id;
				else
					$this->id = $fetch['id'];
			}
		}
		else
			$this->id = $id;
		$req = $bddConnection->prepare('SELECT img_extension FROM cmw_users WHERE id = :id');
		$req->execute(array('id' => $this->id));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		$this->extension = $fetch['img_extension'];
	}

	public function getImgToSize($size, &$width, &$height)
	{
		$this->getImg();
		if($this->modif)
		{
			// Constraints
			$max_width = $size;
			$max_height = $size;
			list($width, $height) = getimagesize($this->img);
			$ratioh = $max_height/$height;
			$ratiow = $max_width/$width;
			$ratio = min($ratioh, $ratiow);
			// New dimensions
			$width = intval($ratio*$width);
			$height = intval($ratio*$height);
			return $this->img;
		}
		else
		{
			if(!is_numeric($this->id))
				$pseudo = $this->id;
			else
				$pseudo = $this->getPseudo();
			$this->img = "https://cravatar.eu/avatar/$pseudo/$size";
			return $this->img;
		}
	}

	public function getImg()
	{
		if(file_exists('utilisateurs/'.$this->id.'/profil.'.$this->extension))
		{
			$this->modif = true;
			$this->img = "utilisateurs/".$this->id.'/profil.'.$this->extension;
		}
		elseif($this->id == NULL)
		{
			$this->modif = true;
			$this->img = "https://craftmywebsite.fr/favicon.ico";
		}
		else
		{
			$this->modif = false;
			if(!is_int($this->id))
				$pseudo = $this->id;
			else 
				$pseudo = $this->getPseudo();
			$this->img = "https://cravatar.eu/avatar/".$pseudo.".png";
		}
	}

	public function getPseudo()
	{
		$req = $this->bdd->prepare('SELECT pseudo FROM cmw_users WHERE id = :id');
		$req->execute(array(
			'id' => $this->id
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['pseudo'];
	}

	public function getExtension()
	{
		return $this->extension;
	}

	public function redefineExt($newExt)
	{
		$req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = :extension WHERE id = :id');
		$req->execute(array(
			'extension' => $newExt,
			'id' => $this->id
		));
		$this->extension = $newExt;
	}

	public function removeImg()
	{
		unlink('utilisateurs/'.$this->id.'/profil.'.$this->extension);
		rmdir('utilisateurs/'.$this->id);
		$this->extension = NULL;
		$this->img = NULL;
		$this->modif = false;
		$req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = "" WHERE id = :id');
		$req->execute(array(
			'id' => $this->id
		));
	}
}
?>