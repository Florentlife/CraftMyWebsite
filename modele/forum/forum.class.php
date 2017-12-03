<?php 

class Forum {
	
	//Mise en mémoire de l'Objet permettant l'accès à la Base de donnée
	private $bdd;
	
	//Constructeur
	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}
	
	//Fonction d'affichage des Forums
	public function affichageForum() 
	{
		$forum = $this->bdd->query('SELECT * FROM cmw_forum');
		$donnees = $forum->fetchAll();
		return $donnees;
	}
	
	//Fonction de récupération des données de chaque forum
	public function infosForum($id)
	{
		$requete = $this->bdd->prepare('SELECT * FROM cmw_forum_categorie WHERE forum = :forum');
		$requete->execute(array(
			'forum' => htmlspecialchars($id)
		));
		$donnees = $requete->fetchAll();
		return $donnees;
	}
	
	//Récupération de la dernière réponse 
	public function derniereReponseForum($id)
	{
		$derniere_reponse_req = $this->bdd->prepare('SELECT cmw_forum_answer.pseudo AS pseudo, cmw_forum_answer.date_post AS date_post, cmw_forum_answer.id_topic AS id, cmw_forum_post.nom AS titre
			FROM cmw_forum_answer 
				INNER JOIN cmw_forum_post 
					ON cmw_forum_answer.id_topic = cmw_forum_post.id 
			WHERE cmw_forum_post.id_categorie = :id
			ORDER BY cmw_forum_answer.date_post DESC');
		$derniere_reponse_req->execute(array(
			'id' => htmlspecialchars($id)
			));
		$derniere_reponse_donnees = $derniere_reponse_req->fetch();
		if(!isset($derniere_reponse_donnees['pseudo']))
		{
			$dernier_topic = $this->bdd->prepare('SELECT nom AS titre, id, pseudo, date_creation AS date_post, COUNT(id) AS count
			FROM cmw_forum_post 
			WHERE id_categorie = :id');
			$dernier_topic->execute(array(
				'id' => htmlspecialchars($id)
			));
			$derniere_reponse_donnees = $dernier_topic->fetch();
			if($derniere_reponse_donnees['count'] == 0)
				return FALSE;
			else
				return $derniere_reponse_donnees;
		}
		else
			return $derniere_reponse_donnees;
	}
	
	//Récupération catégorie
	public function infosCategorie($id)
	{
		$categorie = $this->bdd->prepare('SELECT * FROM cmw_forum_categorie WHERE id = :id');
		$categorie->execute(array(
			'id' => htmlspecialchars($id)
			));
		$donnees = $categorie->fetch();
		return $donnees;
	}
	
	//Récupération sousForum
	public function infosSousForum($id, $fetch)
	{
		$sousForum = $this->bdd->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie');
		$sousForum->execute(array(
			'id_categorie' => htmlspecialchars($id)
			));
		if($fetch == 0)
			$donnees = $sousForum->fetch();
		else
			$donnees = $sousForum->fetchAll();
		return $donnees;
	}
	
	//Compte les topics
	public function compteTopics($id)
	{
		$count_topic2 = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id_categorie AND sous_forum IS NULL');
		$count_topic2->bindParam(':id_categorie', htmlspecialchars($id));
		$count_topic2->execute();
		return $count_topic2->rowCount();
	}
	
	//Récupération des topics 
	public function infosTopics($id, $count)
	{
		$topic = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id_categorie AND sous_forum IS NULL ORDER BY epingle DESC LIMIT '.$count.', 20');
		$topic->bindParam(':id_categorie', htmlspecialchars($id));
		$topic->execute();
		return $topic->fetchAll();
	}
	
	//récupération de la table cmw_sous_forum pour le fofo si on se trouve dans un sousForum
	public function SousForum($id)
	{
		$sousforum = $this->bdd->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id = :id');
		$sousforum->execute(array(
			'id' => htmlspecialchars($id)
		));
		return $sousforum->fetch();
	}
	
	//Compte topics pour les topics de sous forum
	public function compteTopicsSF($id)
	{
		$count_topic = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE sous_forum LIKE :sous_forum');
		$count_topic->bindParam(':sous_forum', $id);
        $count_topic->execute();
		return $count_topic->rowCount();
	}
	
	//InfosTopics pour les sous forum
	public function infosSousForumTopics($id, $count)
	{
		$topic = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE sous_forum LIKE :sous_forum ORDER BY epingle DESC LIMIT '.$count.', 20');
		$topic->bindParam(':sous_forum', htmlspecialchars($id));
        $topic->execute();
		return $topic->fetchAll();
	}
	
	//Page post.php récupération du topic
	public function getTopic($id)
	{
		$topic = $this->bdd->prepare('SELECT cmw_forum_post.nom AS nom, d_edition, pseudo, contenue, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, id_categorie, sous_forum, last_answer, etat, cmw_forum_post.id AS id, cmw_forum_categorie.nom AS nom_categorie 
		FROM cmw_forum_post 
			INNER JOIN cmw_forum_categorie 
				ON cmw_forum_post.id_categorie = cmw_forum_categorie.id
		WHERE cmw_forum_post.id = :id');
		$topic->execute(array(
			'id' => $id
		));
		$donnees = $topic->fetch();
		if(isset($donnees['sous_forum']))
		{
			$nom = $this->bdd->prepare('SELECT nom FROM cmw_forum_sous_forum WHERE id = :id'); 
			$nom->execute(array('id' => $donnees['sous_forum']));
			$data = $nom->fetch();
			$donnees['nom_sf'] = $data['nom'];
		}
		return $donnees;
	}
	
	//Compte réponse du topic
	public function compteReponse($id)
	{
		$count = $this->bdd->prepare('SELECT COUNT(id) AS count_id FROM cmw_forum_answer WHERE id_topic = :id_topic');
		$count->bindParam(':id_topic', $id);
		$count->execute();
		$fetch = $count->fetch();
		return $fetch['count_id'];
	}
	
	//Affichage réponse en fonction de la page :
	public function affichageReponse($id, $count)
	{
		$answer = $this->bdd->prepare('SELECT id, id_topic, pseudo, contenue, d_edition, DAY(date_post) AS day, MONTH(date_post) AS mois, YEAR(date_post) AS annee FROM cmw_forum_answer WHERE id_topic LIKE :id_topic ORDER BY id ASC LIMIT '.$count.', 20');
		$answer->bindParam(':id_topic', $id);
		$answer->execute();
		return $answer->fetchAll();
	}
	
	//compte les Like des answer 
	public function compteLike($id, &$count)
	{
		$like = $this->bdd->prepare('SELECT * AS count FROM cmw_forum_like WHERE id_answer = :id_answer AND Appreciation = 1');
		$like->bindParam(':id_answer', $id, PDO::PARAM_INT);
		$like->execute();
		$count = $like->rowCount();
		return $like->fetchAll();
	}
	
	//Pareil pour DisLike :
	public function compteDisLike($id, &$count)
	{
		$dislike = $this->bdd->prepare('SELECT * FROM cmw_forum_like WHERE id_answer = :id_answer AND Appreciation = 2');
		$dislike->bindParam(':id_answer', $id, PDO::PARAM_INT);
		$dislike->execute();
		$count = $dislike->rowCount();
		return $dislike->fetchAll();
	}
	
	//Vérifie si la personne a déjà réagit 
	public function testVote($id, $joueur)
	{
		$test_vote = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_forum_like WHERE pseudo = :pseudo AND id_answer = :id_answer');
		$test_vote->execute(array(
			'pseudo' => $joueur,
			'id_answer' => $id
		));
		return $test_vote->fetch();
	}
	
	//Vérification si le forum est lock 
	public function isLock($id)
	{
		$req = $this->bdd->prepare('SELECT close FROM cmw_forum_categorie WHERE id = :id');
		$req->execute(array(
			'id' => $id
			));
		return $req->fetch();
	}
	
	//Vérifie l'existence du forum 
	public function exist($id)
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_forum_categorie WHERE id = :id');
		$req->execute(array(
			'id' => $id
			));
		$data = $req->fetch();
		if($data['count'] > 0)
			return true;
		else
			return false;
	}

	//Renvoie le grade du joueur
	public function gradeJoueur($pseudo)
	{
		$req = $this->bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $pseudo ));
		$joueurDonnees = $req->fetch();
		if($joueurDonnees['rang'] == 0) {
			$gradeSite = 'Joueur';
		} elseif($joueurDonnees['rang'] == 1) {
			$gradeSite = "<span class='style16'>Créateur</span>";
		} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
			$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
			$readGradeSite = $openGradeSite->GetTableau();
			$gradeSite = $readGradeSite['Grade'];
			if(empty($readGradeSite['Grade']))
				$gradeSite = 'Joueur';
		} else {
			$gradeSite = 'Joueur';
		}
		return $gradeSite;
	}

	//Renvoie le préfix de la discussion
	public function getPrefix($prefix)
	{
		$req = $this->bdd->prepare('SELECT span, nom FROM cmw_forum_prefix WHERE id = :id');
		$req->execute(array(	'id' => $prefix));
		$fetch = $req->fetch();
		$return = '<span class="'.$fetch['span'].'">'.$fetch['nom'].'</span>';
		return $return;
	}
}
?>