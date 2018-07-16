<?php
if(isset($_POST['id']))
{
	$id = htmlspecialchars($_POST['id']);
	$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
	if($Messagerie->verifConv($id))
	{
		if(isset($_POST['page']))
			$page = intval($_POST['page']);
		else
			$page = 1;
		$messages = $Messagerie->getMessages($id, $nbPages, $page);
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
		echo '
		<nav aria-label="Pages Messages">
		  <ul class="pagination">';
		if($page > 1)
	  	{
	  		?><li class="page-item">
		      <a class="page-link" onClick="getMessages(<?=$id;?>, 1);" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		        <span class="sr-only">Précédent</span>
		      </a>
		    </li> <?php
	  	}
		  	for($i = 1; $i <= $nbPages; $i++)
		  	{
		  		echo '<li class="page-item"><a class="page-link" onClick="getMessages('.$id.', '.$i.');">'.$i.'</a></li>';
		  	}
		  	if($page < $nbPages)
		  	{
			    ?>
			    <li class="page-item">
			      <a class="page-link" onClick="getMessages(<?=$id;?>, <?=$nbPages;?>);" aria-label="Next">
			        <span aria-hidden="true">&raquo;</span>
			        <span class="sr-only">Suivant</span>
			      </a>
			    </li><?php 
			}
			?>
		  </ul>
		</nav>
		<?php
	}
	else
		echo 'false';
}
else
	echo 'false';
?>