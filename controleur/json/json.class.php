<?php
require('JSONAPI.php');
class JsonCon
{
	public $api;
	private $pseudo;
	private $bddConnection;
	
	public function __construct($adresse, $post, $utilisateur, $mdp, $salt)
	{	
		$api = new JSONAPI($adresse, $post, $utilisateur, $mdp, $salt);
		$this->api = $api;
	}
	
	public function GetConnection()
	{
		$c = $this->api->call("server.version");
		return $c;
	}
	
	public function SetConnectionBase($bddConnection)
	{
		$this->bddConnection = $bddConnection;
	}
	
	public function SetPlayerName($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	
	public function SendBroadcast($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		$this->api->call("chat.broadcast", array($message));
	}

	public function sendChat($donnees)
	{
		$data = $this->api->call("chat.broadcast", array($donnees));
		return $data;
	}
	
	public function GetChat($donnees)
	{
		$c = $this->api->call("streams.chat.latest", $donnees);
		return $c;
	}

	public function getPlugins()
	{
		$plugins['Test'] = $this->api->call("getPlugins");
		$plugins['Test'] = $plugins['Test'][0]["success"];

		return $plugins;
	}

	public function GetConsole()
	{
		$msg = 12;
		$console['Test'] = $this->api->call("getLatestConsoleLogsWithLimit", array($msg));
		$console['Test'] = $console['Test'][0]["success"];

		return $console;
	}

	public function reloadServer() {
		return $this->api->call("reloadServer");
	}

	public function restartServer() {
		return $this->api->call("server.power.restart");
	}
	
	public function SendMessage($donnees)
	{
		$c = $this->api->call("players.name.send_message", $donnees);
		return $c;
	}

	public function getGroups()
	{
		return $this->api->call("groups.all");
	}
	public function getMonnaie()
	{
		return $this->api->call("economy.currency.name_plural");
	}
	public function getFile($addr)
	{
		return $this->api->call('files.read', array($addr));
	}

	public function runConsoleCommand($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		$this->api->call("runConsoleCommand", array($message));
	}
	
	//Cette fonction à la propriété de gérer les "Grades temporaires" !
	public function AddPlayerToGroup($message, $duree)
	{
		$this->api->call("runConsoleCommand", array('manudel '.$this->pseudo));
		$this->api->call("permissions.addPlayerToGroup", array($this->pseudo, $message));
		require_once('modele/boutique/tempgrades.class.php');
		$tempGrade = new TempGrades($this->bddConnection, $this->pseudo, $duree, $message);
		if($tempGrade->ExistPlayer())
		{
			if($duree == 0)
				$tempGrade->MajJoueurVie();
			else
				$tempGrade->MajJoueur();
		}
		else
		{
			if($duree == 0)
				$tempGrade->CreerJoueurVie();
			else
				$tempGrade->CreerJoueur();
		}
	}

	public function ResetPlayer($pseudo, $grade)
	{
		$this->api->call("runConsoleCommand", array('manudel '.$pseudo));
		if(!empty($grade))
			$this->api->call("permissions.addPlayerToGroup", array($pseudo, $grade));	
	}
	
	public function GivePlayerItem($commande)
	{
		$this->api->call("runConsoleCommand", array('give '.$this->pseudo . ' '. $commande));	
	}

	public function GivePlayerXp($message)
	{
		$this->api->call("givePlayerXp", array($message));
	}

	public function GivePlayerMoney($message)
	{
		$this->api->call("econ.depositPlayer", array($this->pseudo, $message));
	}

	public function GetBanList()
	{
		return $this->api->call("files.read", array("banned-players.json"));
	}

	public function GetGroupsList()
	{
		return $this->api->call("files.list_directory", array("plugins/GroupManager/worlds"));
	}
	
	// Récupère les pseudo des joueurs et le nombre de joueurs en ligne...
	public function GetServeurInfos()
	{
		$serveurStats['enLignes'] = $this->api->call("getPlayerCount"); 
		$serveurStats['enLignes'] = $serveurStats['enLignes'][0]['success'];
		
		$serveurStats['maxJoueurs'] = $this->api->call("getPlayerLimit"); 
		$serveurStats['maxJoueurs'] = $serveurStats['maxJoueurs'][0]['success'];
		
		$serveurStats['joueurs'] = $this->api->call("getPlayerNames"); 
		$serveurStats['joueurs'] = $serveurStats['joueurs'][0]['success'];
		
		$serveurStats['version'] = $this->api->call("getBukkitVersion");
		$serveurStats['version'] = $serveurStats['version'][0]['success'];
		$serveurStats['version'] = substr($serveurStats['version'], 0, 6);

		$serveurStats['usedMemoryServer'] = $this->call("server.performance.memory.used");
	    $serveurStats['totalMemoryServer'] = $this->call("server.performance.memory.total");
	    $serveurStats['usedDiskSizeServer'] = $this->call("server.performance.disk.used");
	    $serveurStats['totalDiskSizeServer'] = $this->api->call("server.performance.disk.size");
	    $serveurStats['freeDiskSizeServer'] = formatSize($serveurStats['totalDiskSizeServer'][0]["success"] - $serveurStats['usedDiskSizeServer'][0]["success"]);
		$serveurStats['usedMemoryServer'] = formatSize($serveurStats['usedMemoryServer'][0]["success"]);
	    $serveurStats['totalMemoryServer'] = formatSize($serveurStats['totalMemoryServer'][0]["success"]);
	    $serveurStats['usedDiskSizeServer'] = formatSize($serveurStats['usedDiskSizeServer'][0]["success"]);
	    $serveurStats['totalDiskSizeServer'] = formatSize($serveurStats['totalDiskSizeServer'][0]["success"]);
	    return $serveurStats;
	}
}

function formatSize($nb){
	return ($nb < 1024) ? round($nb, 2) ."Mo" : round($nb/1024, 2) ."Go";
}
?>
