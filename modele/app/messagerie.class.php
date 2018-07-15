<?php
setlocale(LC_TIME, "fr_FR");
class Messagerie
{
	private $bdd;
	private $pseudo;

	public function __construct($bdd, $pseudo)
	{
		$this->bdd = $bdd;
		$this->pseudo = $pseudo;
	}

	public function getConversations($page = 1)
	{
		$return = array();
		$nbConversations = $this->countConversations();
		$nbPages = ceil($nbConversations / 20);
		if($page > $nbPages)
			return false;
		$return['nbConversations'] = $nbConversations;
		$return['nbPages'] = $nbPages;
		$return['conv'] = array();
		$premierAffichage = ($page - 1) * 20;
		$req = $this->bdd->prepare('SELECT * FROM(SELECT DISTINCT cmw_messages.idConversation AS idConversation, cmw_messages.expediteur AS expediteur, cmw_messages.date_envoie AS date_envoie, cmw_conversations.pseudo1 AS pseudo1, cmw_conversations.pseudo2 AS pseudo2, cmw_messages.message AS message, cmw_messages.lu AS lu  FROM cmw_conversations 
			INNER JOIN cmw_messages ON cmw_conversations.id = idConversation
			WHERE pseudo1 = :pseudo OR pseudo2 = :pseudo
		    ORDER BY date_envoie DESC)cmw_conversations
		    GROUP BY idConversation ORDER BY date_envoie DESC');
		$req->execute(array(
			'pseudo' => $this->pseudo
		));
		while($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			$date = new DateTime($data['date_envoie']);
			$date = strftime("%A %d %B %Y à %H:%M:%S", $date->getTimestamp());
			if($data['pseudo1'] == $this->pseudo)
				$expediteur = $data['pseudo2'];
			else
				$expediteur = $data['pseudo1'];
			if($data['expediteur'] == $this->pseudo)
				$lu = 1;
			else
				$lu = $data['lu'];
			array_push($return['conv'], array(
				'id' => $data['idConversation'],
				'from' => $expediteur,
				'message' => BBCode(espacement($data['message']), $this->bdd),
				'date' => $date,
				'lu' => $lu
			));
		}
		return $return;
	}

	public function getMessages($idConv, $page = 1)
	{
		$nbMessages = $this->countMessages($idConv);
		$nbPages = ceil($nbMessages / 20);
		if($page > $nbPages)
			return false;
		$prAffic = ($page - 1) * 20;
		$req = $this->bdd->prepare('SELECT * FROM cmw_messages WHERE idConversation = :id ORDER BY date_envoie DESC LIMIT '.$prAffic.', 20');
		$req->execute(array(
			'id' => $idConv
		));
		$this->setLu($idConv);
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}

	public function setLu($id)
	{
		$req = $this->bdd->prepare('UPDATE cmw_messages SET lu = 1 WHERE idConversation = :id AND expediteur != :pseudo');
		$req->execute(array(
			'id' => $id,
			'pseudo' => $this->pseudo
		));
	}

	public function sendMessage($to, $msg)
	{
		if($this->alreadyConv($to, $idConv))
		{
			$req = $this->bdd->prepare('INSERT INTO cmw_messages (idConversation, expediteur, message, date_envoie, lu) VALUES (:id, :pseudo, :message, NOW(), 0)');
			$req->execute(array(
				'id' => $idConv,
				'pseudo' => $this->pseudo,
				'message' => $msg
			));
		}
		else
		{
			$reqVerif = $this->bdd->prepare('SELECT id FROM cmw_users WHERE pseudo = :pseudo');
			$reqVerif->execute(array(
				'pseudo' => $to
			));
			$fetch = $reqVerif->fetch(PDO::FETCH_ASSOC);
			if(isset($fetch['id']))
			{
				$reqConv = $this->bdd->prepare('INSERT INTO cmw_conversations (pseudo1, pseudo2) VALUES (:pseudo, :to)');
				$reqConv->execute(array(
					'pseudo' => $this->pseudo,
					'to' => $to
				));
				$this->sendMessage($to, $msg);
			}
			else
				return false;
		}
		return true;
	}

	public function verifConv($idConv)
	{
		$req = $this->bdd->prepare('SELECT pseudo1, pseudo2 FROM cmw_conversations WHERE id = :id');
		$req->execute(array(
			'id' => $idConv
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if($this->pseudo == $fetch['pseudo1'] OR $this->pseudo == $fetch['pseudo2'])
			return true;
		else
			return false;
	}

	private function alreadyConv($to, &$idConv)
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) AS count, id FROM cmw_conversations WHERE (pseudo1 = :pseudo AND pseudo2 = :to) OR (pseudo1 = :to AND pseudo2 = :pseudo)');
		$req->execute(array(
			'pseudo' => $this->pseudo,
			'to' => $to
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if($fetch['count'] > 0)
			$idConv = $fetch['id'];
		else
			return false;
		return true;
	}

	private function countConversations()
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_conversations WHERE pseudo1 = :pseudo OR pseudo2 = :pseudo');
		$req->execute(array(
			'pseudo' => $this->pseudo
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['count'];
	}

	private function countMessages($idConv)
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_messages WHERE idConversation = :id');
		$req->execute(array(
			'id' => $idConv
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['count'];
	}
}
?>