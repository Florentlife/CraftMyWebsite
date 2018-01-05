<?php

if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['postit']['actions']['addPostIt'] == true) {
	
	$req = $bddConnection->prepare('INSERT INTO cmw_postit(auteur, message) VALUES (?, ?)');
	$req->execute(Array(
        $_Joueur_['pseudo'],
        $_POST['post-it_message'] ));


}

?>