<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Ban-List</h1>
	</div>
</header>
<div class="container">		
	<h3 class="header-bloc">Liste des joueurs bannis</h3>
	<table class="table table-bordered">
		<tr>
			<th>Pseudo</th>
			<th>Date</th>
			<th>Source</th>
			<th>Durée</th>
			<th>Raison</th>
		</tr>
		<?php
		foreach($banlist[0] as $cle => $element)
		{
			echo '<tr>';
			if(!is_string($element))
				foreach($banlist[0][$cle] as $cle2 => $element2)
				{
					echo '<td>'. $element2 .'</td>';
				}
			else
				echo '<td>'.$banlist[0][$cle].'</td><td>Date inconnue</td><td>(Unknown)</td><td>?</td><td>Bannis par un admin</td>';
			echo '</tr>';
		}
		?>
	</table>
</div>