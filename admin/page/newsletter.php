<div class="cmw-page-content-header"><strong>Gestion</strong> - NewsLetter</div>
<div class="row">
	<?php if($_Joueur_['rang'] != 1 AND !$_PGrades_['PermsPanel']['newsletter']['actions']['send']) { ?>
	<div class="col-md-12 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux newsletter.</strong>
		</div>
	</div>
	<?php } else {?>
	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Liste des utilisateur recevant la newsletter</strong></h3>
			</div>
			<div class="panel-body">
				<?php $news = $bddConnection->query('SELECT * FROM cmw_users WHERE newsletter = 1');?>
				<h3><?= $news->rowCount()?> joueurs vont recevoir la newsletter !</h3>
				<table class="table">
					<tr>
						<th>Pseudo</th>
						<th>Email</th>
					</tr>
					<?php 
						while ($donneesnews = $news->fetch(PDO::FETCH_ASSOC)) {?>
					<tr>
						<td><?php echo $donneesnews['pseudo']; ?></td>
						<td><?php echo $donneesnews['email']; ?></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Envoyer une newsletter</strong></h3>
			</div>
			<div class="panel-body">
				<form method="post" action="?&action=newsletter">
					<input type="text" name="from" class="form-control w-100" placeholder="Avec quel adresse e-mail voulez vous envoyer la newsletter" /> 
					<input type="text" name="sujet" class="form-control w-100" placeholder="Le sujet de la newsletter" /> 
					<textarea name="contenu" style="resize: vertical;width: 100%;height: 300px"></textarea>
					<button class="btn btn-lg btn-primary btn-block" type="submit"> Envoyer</button>
				</form>
			</div>
		</div>
	</div>
	<?php }?>
</div>