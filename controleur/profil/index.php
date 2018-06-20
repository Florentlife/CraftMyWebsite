<?php

include('controleur/profil/serveur.php');

include('modele/joueur/donneesJoueur.class.php');

$joueurDonnees = new JoueurDonnees($bddConnection, $_GET['profil']);
$joueurDonnees = $joueurDonnees->getTableauDonnees();

if(empty($joueurDonnees))
{
	header('Location: ?page=erreur&erreur=19&type=Profil&titre='.htmlspecialchars("Utilisateur inexistant !").'&contenue='.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
}

if(empty($joueurDonnees['skype']))
	$joueurDonnees['skype'] = 'inconnu';
if(empty($joueurDonnees['age']))
	$joueurDonnees['age'] = '??';
if(empty($joueurDonnees['tokens']))
	$joueurDonnees['tokens'] = '0';



if($joueurDonnees['rang'] == 0) {
	$gradeSite = 'Joueur';
} elseif($joueurDonnees['rang'] == 1) {
	$gradeSite = "<span class='prefix style16' style='color: red;'>".$_Serveur_['General']['createur']."</span>";
} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
	$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
	$readGradeSite = $openGradeSite->GetTableau();
	$gradeSite = "<span class='prefix ".$readGradeSite['prefix']." ". $readGradeSite['effets']. "'>".$readGradeSite['Grade']."</span>";
	if(empty($readGradeSite['Grade']))
		$gradeSite = 'Joueur';
} else {
	$gradeSite = 'Joueur';
}

include('theme/' .$_Serveur_['General']['theme']. '/pages/profil.php');
?>