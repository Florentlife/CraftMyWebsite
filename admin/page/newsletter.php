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
					<input type="text" name="from" class="form-control" placeholder="Avec quel adresse e-mail voulez vous envoyer la newsletter" />
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="useSMTP" name="useSMTP" <?=(isset($_Serveur_['SMTP'])) ? 'checked' : '' ;?>>
						<label class="custom-control-label" for="useSMTP">Utiliser un serveur SMTP ?</label>
					</div>
			    	<input type="text" name="host" class="form-control" placeholder="Serveur SMTP: exemple : smtp.google.com" <?=(isset($_Serveur_['SMTP']['Host'])) ? 'value='.$_Serveur_['SMTP']['Host']: '';?>>
			    	<input type="text" name="username" class="form-control" placeholder="Utilisateur SMTP: exemple : adressemail@gmail.com" <?=(isset($_Serveur_['SMTP']['Username'])) ? 'value='.$_Serveur_['SMTP']['Username']: '';?>>
			    	<input type="password" name="password" class="form-control" placeholder="Mot de passe SMTP: exemple: votremdpSMTP" <?=(isset($_Serveur_['SMTP']['Password'])) ? 'value='.$_Serveur_['SMTP']['Password']: '';?>>
			    	<div class="form-group">
					    <label class="sr-only" for="exampleInputAmount">Port SMTP (exemple 587)</label>
					    <div class="input-group">
					      <div class="input-group-addon">Port SMTP</div>
					      <input type="number" class="form-control" id="port" name="port" placeholder="587" <?=(isset($_Serveur_['SMTP']['Port'])) ? 'value='.$_Serveur_['SMTP']['Port']: '';?>>
					    </div>
					</div>
					<div class="checkbox">
					  	<label>
					    	<input type="checkbox" value="tls" name="protocol" <?=(isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "tls") ? 'checked': '';?>>
					    	Protocole TLS (à cocher par défaut)
					  	</label>
					</div>
					<div class="checkbox">
					  	<label>
					    	<input type="checkbox" value="ssl" name="protocol" <?=(isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "ssl") ? 'checked': '';?>>
					    	Protocole SSL (si vous êtes sur de vous !)
					 	</label>
					</div>
					<div class="custom-control custom-checkbox">
						  <input type="checkbox" class="custom-control-input" name="memoireSMTP" id="memoireSMTP">
						  <label class="custom-control-label" for="memoireSMTP" <?=(isset($_Serveur_['SMTP'])) ? 'checked' : '';?>>Conserver ses informations pour une prochaine utilisation ?</label>
					</div>
					<input type="text" name="reply" class="form-control" placeholder="Adresse mail de réponse (laissez vide si même que celle d'envoi)">
					<input type="text" name="sujet" class="form-control" placeholder="Le sujet de la newsletter"/>
					<textarea name="contenu" id="contenuNewsLetter" style="resize: vertical;width: 100%;height: 300px">Votre message ! Code HTML autorisé !</textarea>
					<button class="btn btn-lg btn-primary btn-block" type="submit"> Envoyer</button>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
    CKEDITOR.replace( 'contenuNewsLetter' );
    </script>
	<?php }?>
</div>