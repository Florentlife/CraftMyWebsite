<div class="cmw-page-content-header"><strong>Réglages Forum</strong> - Paramétrez votre Forum</div>

<div class="row">
	<?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['forum']['showPage'] == false AND $_PGrades_['PermsPanel']['forum']['actions']['addSmiley'] == false))
	{
		echo '<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux réglages de la boutique.</strong>
		</div>
	</div>';
	}
	else
	{
		?><div class="alert alert-success">
			<strong>Sur cette section, vous pouvez gérer tout votre forum, créer des smileys unique.</strong>
		</div>
	<?php 
	}
	if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['forum']['actions']['addSmiley'] == true)
	{
		?><form method="POST" action="?action=addSmiley" enctype="multipart/form-data">
			<div class="col-lg-12">
				<div class="panel panel-default cmw-panel">
					<div class="panel-heading cmw-panel-header">
						<h3 class="panel-title"><strong>Ajout de Smiley</strong></h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="row">
								<label class="control-label">Symbole à utiliser sur le forum : (exemple : :D, :), :p, :vladort qui dort: )</label>
								<input type="text" name="symbole" class="form-control" maxlength="20">
							</div>
							<div class="row">
								<label class="control-label">Fichier smiley, la taille ne sera pas réduite sur le forum ! Il est donc vivement conseillé de ne pas dépasser du 32x32. (Les smileys actuels sont en 18x18 pour les basiques).
		                        <input type="file" id="file" name="image" class="custom-file-input">
		                        <span class="custom-file-control"></span>
		                        </label>
		                   	</div>
		                   	<hr/>
		                   	<div class="row text-center">
		                   		<input type="submit" class="btn btn-success" value="Ajouter le smiley !" />
		                   	</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</form><?php
	}
	if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['forum']['actions']['seeSmileys'] == true)
	{
		?><div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des Smileys</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <h3 class="text-center">Gestion des Smileys</h3>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Symbole</th>
                            <th>Images</th>
                            <th>Lien</th>
                            <th>Action</th>
                        </tr>
                    <?php 
                    $reqSmileys = $bddConnection->query('SELECT id, symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
                    while($data = $reqSmileys->fetch())
                    {
                    	?><tr>
                    		<td><?=$data['symbole'];?></td>
                    		<td><img src="./<?=$data['image'];?>" /></td>
                    		<td><?=$data['image'];?></td>
                    		<td><a href="?action=supprSmiley&id=<?=$data['id'];?>&image=<?=$data['image'];?>" class="btn btn-danger">Supprimer</a></td>
                    	</tr><?php
                    }
                    ?>
               		</table>
               	</div>
            </div>
        </div>
		<?php
	}
	?>
</div>