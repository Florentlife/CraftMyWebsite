<?php
if(isset($_Joueur_) && isset($_POST['i']) && isset($_POST['message']) && (!isset($_SESSION['chat']) OR $_SESSION['chat'] < time()))
{
	$_SESSION['chat'] = time()+20;
	if($_PGrades_['PermsDefault']['chat']['color'] == true OR $_Joueur_['rang'] == 1)
		$message = str_replace('&', '§', $_POST['message']);
	else
		$message = str_replace('§', '', $_POST['message']);
	$message = htmlspecialchars($message);
	if(strlen($message) <= 100)
	{
		$i = htmlentities($_POST['i']);
		$Chat = new Chat($jsonCon);
		if($Chat->sendMessageChat($message, $i, $_Joueur_['pseudo']) == true)
			header('Location: ?page=chat');
		else
			header('Location: ?page=chat&erreur=send');
	}
	else
		header('Location: ?page=erreur&erreur=18');
}
else
	header('Location: ?page=erreur&erreur=18');
?>