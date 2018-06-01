<?php
if(isset($_POST['contenu'], $_POST["sujet"]) && ($_Joueur_['rang'] == 1 || $_PGrades_['PermsPanel']['news']['actions']['addNews'])) {
	$newsletter = $bddConnection->query('SELECT pseudo,email FROM cmw_users WHERE newsletter = 1');
	while($dnewsletter = $newsletter->fetch(PDO::FETCH_ASSOC)){
		$to = $dnewsletter['email'];
		$subject = htmlspecialchars($_POST["sujet"]);
		$message = htmlspecialchars($_POST["contenu"]);
		$headers = 'From: ' . htmlspecialchars($_POST["from"]) . "\r\n" .
				'Reply-To: EMAIL DE RÉPONSE ( pas forcément de serveur )' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();	
				mail($to, $subject, $message, $headers);			
	}
}
?>