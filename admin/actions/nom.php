<?php
if($_Joueur_['rang'] == 1 && isset($_POST['nom']))
{
	$_Serveur_['General']['createur'] = htmlspecialchars($_POST['nom']);
	$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}