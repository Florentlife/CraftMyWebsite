<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['reseaux']['showPage'] == true)
{
	$req = $bddConnection->query('SELECT COLUMN_NAME AS nom FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "cmw_reseaux"');
	$donneesSocial = $req->fetchAll(PDO::FETCH_ASSOC);
	array_shift($donneesSocial);
	array_shift($donneesSocial);

	$req = $bddConnection->query('SELECT * FROM cmw_reseaux 
		INNER JOIN cmw_users
		ON idJoueur = cmw_users.id;');
}
?>