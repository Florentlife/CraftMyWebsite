<?php
	// On vérifie si le systeme est compatible.
	$URLWEBSITE = "http://".$_SERVER['HTTP_HOST']; 
	$SYSTEMINFO = file_get_contents('http://craftmywebsite.fr/information/website.php?href='. $URLWEBSITE .'');
	if($SYSTEMINFO == ""){
	} else {
	echo $SYSTEMINFO;
	}
	// On récupère la classe permettant la lecture en YML. Les fichiers de config sont sous ce format.
	require_once('./modele/config/yml.class.php');
	
	// On lit le fichier de config et on récupère les information dans un tableau. Celui-ci contiens la config générale.
	$configLecture = new Lire('modele/config/config.yml');
	$_Serveur_ = $configLecture->GetTableau();
		
	// On effectue la même opération mais pour le fichier YML du menu.
	$configLecture = new Lire('./modele/config/configMenu.yml');
	$_Menu_ = $configLecture->GetTableau();

	for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
	{
		$_Menu_['MenuTexteBB'][$i] = $_Menu_['MenuTexte'][$i];
		$_Menu_['MenuTexte'][$i] = str_replace('<glyph>', '<span class="glyphicon glyphicon-', $_Menu_['MenuTexte'][$i]);
		$_Menu_['MenuTexte'][$i] = str_replace('</glyph>', '"></span> ', $_Menu_['MenuTexte'][$i]);
	}


	$configLecture = new Lire('modele/config/configWidgets.yml');
	$_Widgets_ = $configLecture->GetTableau();

    if($_Serveur_['General']['bgType'] == 0)
        $bgType = 'background: url(\'theme/upload/bg.png\') no-repeat fixed 0% 0% / 100% 100% transparent;';
    else
        $bgType = 'background: url(\'theme/upload/bg.png\') repeat scroll center top rgb(0, 0, 0);';

    require_once('controleur/perms/Permissions.class.php');
    require_once('modele/perms/PermissionsManager.class.php');
	
	require_once('controleur/tempMess.class.php');
	
	$playeronline = file_get_contents('https://minecraft-api.com/api/ping/playeronline.php?ip='.$_Serveur_['General']['ip'].'&port='.$_Serveur_['General']['port']);
	$maxPlayers = file_get_contents('https://minecraft-api.com/api/ping/maxplayer.php?ip='.$_Serveur_['General']['ip'].'&port='.$_Serveur_['General']['port']);
	// On charge la connection à la base MySQL via l'extention PDO.
	require_once ('controleur/connection_base.php');
	require('modele/forum/miseEnPage.php'); 
	require('modele/boutique/panier.class.php');
	$_Panier_ = new Panier($bddConnection);

	function gradeJoueur($pseudo, $bdd)
	{
		$req = $bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
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
?>
