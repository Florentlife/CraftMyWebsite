<?php
require('JSONAPI.php');
require('bootstrap.php');
require 'src/MinecraftQuery.php';
require 'src/MinecraftQueryException.php';
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;
use xPaw\SourceQuery\SourceQuery;
class JsonCon
{
	public $api;
	private $pseudo;
	private $bddConnection;
	private $mode;
	
	public function __construct($adresse, $post, $utilisateur, $mdp, $salt)
	{
		if(isset($utilisateur))
		{
			$this->mode = 1;
			$api = new JSONAPI($adresse, $post, $utilisateur, $mdp, $salt);
		}
		else
		{
			$api['query'] = new MinecraftQuery();
			$api['query']->Connect($adresse, $post['query']);
			$api['rcon'] = new SourceQuery();
			$api['rcon']->Connect($adresse, $post['rcon'], 1, SourceQuery::SOURCE);
			$api['rcon']->SetRconPassword($mdp);
			$this->mode = 2;
		}
		$this->api = $api;
	}

	private function TryMode()
	{
		return ($this->mode == 1);
	}
	
	public function GetConnection()
	{
		if($this->TryMode())
			$c = $this->api->call("server.version");
		else
		{
			$c = $this->api['query']->GetInfo();
		}
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
		if($this->TryMode())
		{
			$this->api->call("chat.broadcast", array($message));
		}
		else
		{
			$this->api['rcon']->Rcon("say ".$message);
		}
	}

	public function sendChat($donnees)
	{
		if($this->TryMode())
		{
			$data = $this->api->call("chat.broadcast", array($donnees));	
		}
		else
		{
			$data = $this->api['rcon']->Rcon('say '.$donnees);
		}
		return $data;
	}
	
	public function GetChat($donnees)
	{
		if($this->TryMode())
			$c = $this->api->call("streams.chat.latest", $donnees);
		return $c;
	}

	public function getPlugins()
	{
		if($this->TryMode())
		{
			$plugins['Test'] = $this->api->call("getPlugins");
			$plugins['Test'] = $plugins['Test'][0]["success"];
		}
		else
		{
			$data = $this->api['query']->GetInfo();
			$plugins['Test'] = $data['Plugins'];
		}

		return $plugins;
	}

	public function GetConsole()
	{
		$msg = 12;
		if($this->TryMode())
		{
			$console['Test'] = $this->api->call("getLatestConsoleLogsWithLimit", array($msg));
			$console['Test'] = $console['Test'][0]["success"];
		}
		return $console;
	}

	public function reloadServer() {
		if($this->TryMode())
			return $this->api->call("reloadServer");
		else
			return false;
	}

	public function restartServer() {
		if($this->TryMode())
			return $this->api->call("server.power.restart");
		else
			return false;
	}
	
	public function SendMessage($donnees)
	{
		if($this->TryMode())
			$c = $this->api->call("players.name.send_message", $donnees);
		return $c;
	}

	public function getGroups()
	{
		if($this->TryMode())
			return $this->api->call("groups.all");
		return false;
	}
	public function getMonnaie()
	{
		if($this->TryMode())
			return $this->api->call("economy.currency.name_plural");
		return false;
	}
	public function getFile($addr)
	{
		if($this->TryMode())
			return $this->api->call('files.read', array($addr));
		return false;
	}

	public function runConsoleCommand($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array($message));
		}
		else
		{
			$this->api['rcon']->Rcon($message);
		}		
	}
	
	//Cette fonction à la propriété de gérer les "Grades temporaires" !
	public function AddPlayerToGroup($message, $duree)
	{
		if($this->TryMode())
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
	}

	public function ResetPlayer($pseudo, $grade)
	{
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array('manudel '.$pseudo));
			if(!empty($grade))
				$this->api->call("permissions.addPlayerToGroup", array($pseudo, $grade));	
		}
	}
	
	public function GivePlayerItem($commande)
	{
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array('give '.$this->pseudo . ' '. $commande));	
		}
		else
		{
			$this->api['rcon']->Rcon('give '.$this->pseudo.' '.$commande);
		}
	}

	public function GivePlayerXp($message)
	{
		if($this->TryMode())
			$this->api->call("givePlayerXp", array($message));
	}

	public function GivePlayerMoney($message)
	{
		if($this->TryMode())
			$this->api->call("econ.depositPlayer", array($this->pseudo, $message));
	}

	public function GetBanList()
	{
		if($this->TryMode())
			return $this->api->call("files.read", array("banned-players.json"));
		return false;
	}

	public function GetGroupsList()
	{
		if($this->TryMode())
			return $this->api->call("files.list_directory", array("plugins/GroupManager/worlds"));
		return false;
	}
	
	// Récupère les pseudo des joueurs et le nombre de joueurs en ligne...
	public function GetServeurInfos()
	{
		if($this->TryMode())
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
			$serveurStats['uMS'] = array('Mo', 'Go');
			$serveurStats['tMS'] = array('Mo', 'Go');
			$serveurStats['usedMemoryServer'] = $this->api->call("server.performance.memory.used");
			$serveurStats['usedMemoryServer'] = $serveurStats['usedMemoryServer'][0]["success"];
			$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']);
			if ($serveurStats['usedMemoryServer'] < 1000) { //Taille en Mo
			//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
				$serveurStats['uMS'] = $serveurStats['uMS'][0];
		    } else { //Taille en Go
		    	$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']/1024,2);
		    	$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']);
		    	$serveurStats['uMS'] = $serveurStats['uMS'][1];
		    }

		    $serveurStats['totalMemoryServer'] = $this->api->call("server.performance.memory.total");
		    $serveurStats['totalMemoryServer'] = $serveurStats['totalMemoryServer'][0]["success"];
		    $serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']);
			if ($serveurStats['totalMemoryServer'] < 1000) { //Taille en Mo
			//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
				$serveurStats['tMS'] = $serveurStats['tMS'][0];
		    } else { //Taille en Go
		    	$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/1024,2);
		    	$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']);
		    	$serveurStats['tMS'] = $serveurStats['tMS'][1];
		    }
		    $serveurStats['uDSS'] = array('Mo', 'Go');
		    $serveurStats['tDSS'] = array('Mo', 'Go');
		    $serveurStats['fDSS'] = array('Mo', 'Go');
		    $serveurStats['usedDiskSizeServer'] = $this->api->call("server.performance.disk.used");
		    $serveurStats['usedDiskSizeServer'] = $serveurStats['usedDiskSizeServer'][0]["success"];
		    $serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']);
			if ($serveurStats['usedDiskSizeServer'] < 1000) { //Taille en Mo
			//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
				$serveurStats['uDSS'] = $serveurStats['uDSS'][0];
		    } else { //Taille en Go
		    	$serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']/1024,2);
		    	$serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']);
		    	$serveurStats['uDSS'] = $serveurStats['uDSS'][1];
		    }

		    $serveurStats['totalDiskSizeServer'] = $this->api->call("server.performance.disk.size");
		    $serveurStats['totalDiskSizeServer'] = $serveurStats['totalDiskSizeServer'][0]["success"];
		    $serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']);
			if ($serveurStats['totalDiskSizeServer'] < 1000) { //Taille en Mo
			//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
				$serveurStats['tDSS'] = $serveurStats['tDSS'][0];
		    } else { //Taille en Go
		    	$serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']/1024,2);
		    	$serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']);
		    	$serveurStats['tDSS'] = $serveurStats['tDSS'][1];
		    }

		    $serveurStats['freeDiskSizeServer'] = $this->api->call("server.performance.disk.free");
		    $serveurStats['freeDiskSizeServer'] = $serveurStats['freeDiskSizeServer'][0]["success"];
		    $serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']);
			if ($serveurStats['freeDiskSizeServer'] < 1000) { //Taille en Mo
			//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
				$serveurStats['fDSS'] = $serveurStats['fDSS'][0];
		    } else { //Taille en Go
		    	$serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']/1024,2);
		    	$serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']);
		    	$serveurStats['fDSS'] = $serveurStats['fDSS'][1];
		    }
		}
		else
		{
			$data = $this->api['query']->GetInfo();
			$serveurStats['enLignes'] = $data['Players'];
			$serveurStats['maxJoueurs'] = $data['MaxPlayers'];
			$serveurStats['version'] = $data['Version'];
			$serveurStats['joueurs'] = $this->api['query']->GetPlayers();
		}
	    return $serveurStats;
	}

	public function close()
	{
		if(!$this->TryMode())
		{
			$this->api['rcon']->Disconnect();
		}
	}
}

?>
