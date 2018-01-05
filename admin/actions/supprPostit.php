<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['postit']['actions']['addPostIt'] == true) {
	$req = $bddConnection->prepare('DELETE FROM cmw_postit WHERE id = :id');
	var_dump($req->execute(array(':id' => $_GET['id'])));
}
?>