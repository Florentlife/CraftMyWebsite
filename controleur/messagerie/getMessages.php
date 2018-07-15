<?php
if(isset($_POST['id']))
{
	$id = htmlspecialchars($_POST['id']);
	$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
	if($Messagerie->verifConv($id))
	{
		$messages = $Messagerie->getMessages($id);
		foreach($messages as $value)
		{
			echo '<div class="row">';
			$date = new DateTime($value['date_envoie']);
			$date = strftime("%A %d %B %Y à %H:%M:%S", $date->getTimestamp());
			if($value['expediteur'] == $_Joueur_['pseudo'])
				echo '<div class="col-md-6">';
			else
				echo '<div class="col-md-9 offset-md-3" style="background-color: #1da1f2;">';
			echo '<p>'.$value['expediteur'].'<span style="float: right;">'.$date.'</span></p><hr/>
			<p class="text-message-conv">'.BBCode(espacement($value['message']), $bddConnection).'</p>
			</div><br/>';
			echo '</div>';
		}
	}
	else
		echo 'false';
}
else
	echo 'false';
?>