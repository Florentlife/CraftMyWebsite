<?php

$id = $_POST['site'];
require_once('modele/joueur/maj.class.php');
include('controleur/topVoteurs.php');
$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
$playerData = $joueurMaj->getReponseConnection();
$playerData = $playerData->fetch();

if(!ExistPost($id, $liensVotes))
	header('Location: ?&page=voter&erreur=3');
	
	
if(isset($_Joueur_['pseudo']) && $_POST['site'] > 0)
{


for($i = 0; $i < count($lecture['Json']); $i++)
{
	$jsonCon[$i]->SetConnectionBase($bddConnection);
}

if(!ExisteJoueur($_Joueur_['pseudo'], $id, $bddConnection))
	CreerJoueur($_Joueur_['pseudo'], $id, $bddConnection);

$donnees = RecupJoueur($_Joueur_['pseudo'], $id, $bddConnection);
$lectureVotes = LectureVote($id, $bddConnection);

$succes = false;
		if(!Vote($_Joueur_['pseudo'], $id, $bddConnection, $donnees, $lectureVotes['temps']))
		{
			header('Location: ?&page=voter&erreur=1&time=' .GetTempsRestant($donnees['date_dernier'], $lectureVotes['temps'], $donnees));
		}
		else
		{
			//$message = str_replace('{JOUEUR}', $_Joueur_['pseudo'], str_replace('{QUANTITE}', $lectureVotes['quantite'], str_replace('{ID}', $lectureVotes['id'], $lectureVotes['message'])));
			//$cmd = str_replace('{JOUEUR}', $_Joueur_['pseudo'], $lectureVotes['cmd']);
			$action = explode(':', $lectureVotes['action'], 2);
			if($action[0] == "give")
			{
				$action = explode(':', $action[1]);
				$id = $action[1];
				$quantite = $action[3];
				$message = str_replace('{JOUEUR}', $_Joueur_['pseudo'], str_replace('{QUANTITE}', $quantite, str_replace('{ID}', $id, $lectureVotes['message'])));
				if($lectureVotes['methode'] == 2)
				{
					if(!empty($lectureVotes['message']))
					{
						$jsonCon[$liensVotes['serveur']]->SendBroadcast($message);
					}
					$jsonCon[$liensVotes['serveur']]->GivePlayerItem($id . ' ' .$quantite);
					header('Location: ?&page=voter&success=true');
				}
				else
				{
					for($j =0; $j < count($jsonCon); $j++)
					{
						if($lectureVotes['display'] == 1)
						{

							$jsonCon[$j]->SendBroadcast($message);
						}
						$jsonCon[$j]->GivePlayerItem($id . ' ' .$quantite);
					}
				header('Location: ?&page=voter&success=true');
				}
			}
			elseif($action[0] == "jeton")
			{
				$message = str_replace('{JOUEUR}', $_Joueur_['pseudo'], $lectureVotes['message']);
				if($lectureVotes['methode'] == 2)
				{
					if($lectureVotes['display'] == 1)
					{
						$jsonCon[$liensVotes['serveur']]->SendBroadcast($message);
					}
					ajouterTokens($action[1]);
					header('Location: ?&page=voter&success=true');
				}
				else
				{
					for($j =0; $j < count($jsonCon); $j++)
					{
						if($lectureVotes['display'] == 1)
						{
							$jsonCon[$j]->SendBroadcast($message);
						}
					}
					ajouterTokens($action[1]);
					header('Location: ?&page=voter&success=true');
				}
			}
			else
			{
				$cmd = str_replace('{JOUEUR}', $_Joueur_['pseudo'], $action[1]);
				$message = str_replace('{JOUEUR}', $_Joueur_['pseudo'], str_replace('{CMD}', $cmd, $lectureVotes['message']));
				if($lectureVotes['methode'] == 2)
				{
					if($lectureVotes['display'] == 1)
					{
						$jsonCon[$liensVotes['serveur']]->SendBroadcast($message);
					}
					$jsonCon[$liensVotes['serveur']]->runConsoleCommand($cmd);
				header('Location: ?&page=voter&success=true');
				}
				else
				{
					for($j = 0; $j < count($jsonCon); $j++)
					{
						if($lectureVotes['display'] == 1 )
						{
							$jsonCon[$j]->SendBroadcast($message);
						}
						$jsonCon[$j]->runConsoleCommand($cmd);
					}
					header('Location: ?&page=voter&success=true');
				}
			}
		}
	}
	else 
	{
		header('Location: ?&page=voter&erreur=2');
	}

	function ajouterTokens($number){
		global $playerData, $joueurMaj, $_Joueur_;
		$playerData['tokens'] = $playerData['tokens'] + $number;
		$joueurMaj->setReponseConnection($playerData);
		$joueurMaj->setNouvellesDonneesTokens($playerData);
		$_Joueur_['tokens'] = $_Joueur_['tokens'] + $number;
		$_SESSION['Player']['tokens'] = $_Joueur_['tokens']; 
	}
	
	function ExistPost($id, $votesLiens)
	{
		if(isset($votesLiens[$id]))
			return true;
		else return false;
	}

	function RecupJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
		$donnees = $line->fetch();	
		return $donnees;
	}
	
	function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
	{
		if($donnees['date_dernier'] + $temps < time())
		{
			$req = $bddConnection->prepare('UPDATE cmw_votes SET nbre_votes = nbre_votes + 1, date_dernier = :tmp WHERE pseudo = :pseudo AND site = :site');
			$req->execute(array(
				'tmp' => time(),
				'pseudo' => $pseudo,
				'site' => $id	));
			return true;
		}
		else 
			return false;
	}
	
	function ExisteJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
			
		$donnees = $line->fetch();
		
		if(empty($donnees['pseudo']))
			return false;
		else
			return true;
	}
	
	function CreerJoueur($pseudo, $id, $bddConnection)
	{
		$req = $bddConnection->prepare('INSERT INTO cmw_votes(pseudo, site) VALUES(:pseudo, :site)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'site' => $id
			));
	}
	
	function GetTempsRestant($temps, $tempsTotal, $donnees)
	{
		$tempsEcoule = time() - $temps;
		$tempsRestant = $tempsTotal - $tempsEcoule;
		$tempsH = 0;
		$tempsM = 0;
		while($tempsRestant >= 3600)
		{
			$tempsH = $tempsH + 1;
			$tempsRestant = $tempsRestant - 3600;
		}
		while($tempsRestant >= 60)
		{
			$tempsM = $tempsM + 1;
			$tempsRestant = $tempsRestant - 60;
		}
		return $tempsH. ':' .$tempsM;
	}

	function LectureVote($id, $bddConnection)
	{
		$req = $bddConnection->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
		$req->execute(array('id' => $id));
		return $req->fetch();
	}
?>