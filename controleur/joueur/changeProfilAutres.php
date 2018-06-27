<?php

$skype = VerifieDonnee($_POST['skype']);
$age = VerifieDonnee($_POST['age']);

$age = intval($age);

if($skype == 1 AND $age == 1)
	header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']. '&erreur=1');
	
ValideChangement($skype, $age, $_Joueur_['pseudo'], $bddConnection);
		
header('Location: ?&page=profil&profil=' .$_Joueur_['pseudo']);
		
function VerifieDonnee($donnee)
{	
	if(!isset($donnee) OR empty($donnee))
		return 1;
		
	$donnee = str_replace(' ', '_', $donnee);
	$donnee = htmlspecialchars($donnee);
	return $donnee;
}	

function ValideChangement($skype, $age, $pseudo, $bddConnection)
{	
	require_once('modele/joueur/maj.class.php');
	$maj = new Maj($pseudo, $bddConnection);
	if($skype != 1)
		$maj->setNouvellesDonneesSkype($skype);
	else
		$maj->setNouvellesDonneesSkype('');
	if($age != 1)
		$maj->setNouvellesDonneesAge($age);
	else
		$maj->setNouvellesDonneesAge(0);
}
?>