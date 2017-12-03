<section class="content-item">
<div class="container">
<center>
<div class="alert alert-info" role="alert">
	Bienvenue sur le forum de <?php echo $_Serveur_['General']['name']; ?>,
	Ici vous pourrez échanger et partager avec toute la communauté du serveur ! </div>
<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['modeJoueur'] == true)
 	{
 		?>
 			<div class="col-md-offset-6 col-md-6">
 				<a href="?action=mode_joueur" class="btn btn-primary">Passer en mode visuel <?php echo ($_SESSION['mode']) ? "Administrateur" : "Joueur"; ?></a>
 			</div>
 		<?php 
 	}
$fofo = $_Forum_->affichageForum();
for($i = 0; $i < count($fofo); $i++)
{ ?>
		</br><br/>
		<table class="table table-striped">
		<caption><div class="row"><div class="col-md-9"><center><h3><?php echo ucfirst($fofo[$i]['nom']); ?></h3></center></div><?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['general']['deleteForum'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']){ ?><div class="col-md-3" style="text-align: right;"><a href="?action=remove_forum&id=<?php echo $fofo[$i]['id']; ?>" class="btn btn-danger" style="text-align: right;">Supprimer</a></div><?php } ?></div></caption>
		<thead>
			<tr>
				<th></th>
				<th>Nom</th>
				<th>Nombre de discussions</th>
				<th>Sous-Forum</th>
				<th>Dernière réponse</th>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode'])
				{
					?><th>Actions</th>
					<th></th><?php
				}
				?>
			</tr>
		</thead>

<?php
$categorie = $_Forum_->infosForum($fofo[$i]['id']);
?>

    <tbody>
<?php   for($j = 0; $j < count($categorie); $j++) { 
			
			$derniereReponse = $_Forum_->derniereReponseForum($categorie[$j]['id']);
			?>
            <tr>

				<td><?php if($categorie[$j]['img'] == NULL) { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons"><?php echo $categorie[$j]['img']; ?></a><?php }?></td>
				<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $categorie[$j]['nom']; ?></a></td>
				<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $categorie[$j]['description']; ?></a></td>
				<td><?php 	$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie');
							$sousforum->execute(array(
								'id_categorie' => $categorie[$j]['id']
							));
							$sousforum = $sousforum->fetchAll(); 
							if(count($sousforum) != 0)
							{ ?>
						<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="sous-forum<?php echo $categorie[$j]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 99.5%;">
						Il y à <?php echo count($sousforum); ?> sous-forum <?php if(count($sousforum) != "0") { ?><span class="caret"></span><?php } ?>
						</button>
						<?php if(count($sousforum) != "0") { ?>
						<ul class="dropdown-menu" aria-labelledby="sous-forum<?php echo $categorie[$j]['id']; ?>">
							<?php for($s = 0; $s < count($sousforum); $s++) {
								?><li><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>&id_sous_forum=<?php echo $sousforum[$s]['id']; ?>"><?php echo $sousforum[$s]['nom']; ?></a></li>
							<?php } ?>
						</ul>
						<?php } ?>
						</div>
				<?php }	else { ?>
				Il n'y a pas de sous-forum
				<?php } ?>
				</td>
				<td><?php if($derniereReponse != false) { ?> 
					<a href="?page=post&id=<?php echo $derniereReponse['id']; ?>" title="<?=$derniereReponse['titre'];?>">Dernier: <?php $taille = strlen($derniereReponse['titre']);
					echo substr($derniereReponse['titre'], 0, 15);
					if(strlen($taille > 15)){ echo '...'; } ?><br/><?=$derniereReponse['pseudo'];?>, Le <?php $date = explode('-', $derniereReponse['date_post']); echo '' .$date[2]. '/' .$date[1]. '/' .$date[0]. ''; ?></a>
			<?php
				}
				else { ?><p> Il n'y a pas de sujet dans ce forum </p> <?php } 
				?></td><?php
				if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode'])
				{
					?><td><a href="?action=remove_cat&id=<?php echo $categorie[$j]['id']; ?>">Supprimer la catégorie</a></td>
					<td><a href=<?php if($categorie[$j]['close'] == 0) { ?>"?action=lock_cat&id=<?=$categorie[$j]['id'];?>&lock=1" title="Fermer le forum"><i class="fa fa-unlock-alt"<?php } else { ?>"?action=unlock_cat&id=<?=$categorie[$j]['id'];?>&lock=0" title="Ouvrir le forum"><i class="fa fa-lock"<?php } ?> aria-hidden="true"></i></a></td><?php
				}
?>
			</tr>
			<?php } ?>
	</tbody>
</table><br/><br/><br/><hr/>
<?php
}
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addCategorie'] == true ) AND !$_SESSION['mode'])
{
	?>
	<h3>Créer une catégorie : </h3>
	<div style="text-align: center">
		<form action="?action=create_cat" method="post">
			<div class="row">
				<div class="col-md-4">
					<label class="control-label" for="nom">Nom de la catégorie</label>
					<input type="text" name="nom" id="nom" maxlength="40" class="form-control" require />
				</div>
				<div class="col-md-4">
					<label class="control-label" for="img">Icon disponible sur : https://design.google.com/icons/</label>
					<input type="text" name="img" id="img" maxlength="300" class="form-control" />
				</div>
				<div class="col-md-4">
					<label class="control-label">Forum : </label>
					<select name="forum" require>
						<?php
						for($z = 0; $z < count($fofo); $z++)
						{
							?><option value="<?php echo $fofo[$z]['id']; ?>"><?php echo $fofo[$z]['nom']; ?></option><?php
						}
						?></select>
			</div>
			<div class="row">
				<div class="col-md-8">
					<label class="control-label" for="desc">Description</label>
					<textarea maxlength="300" class="form-control" name="desc" id="desc" require ></textarea>
				</div>
			</div><br/>
			<div class="row">
				<div class="col-md-offset-2 col-md-4">
					<button type="submit" class="btn btn-success btn-lg btn-round">Créer une catégorie</button>
				</div>
			</div>
		</form>
	</div>
	
<br><hr/>
<?php if($_PGrades_['PermsForum']['general']['addForum'] == true OR $_Joueur_['rang'] == 1)
{
	?><a class="btn btn-primary btn-xs btn-block" role="button" data-toggle="collapse" href="#add_forum" aria-expanded="false" aria-controls="add_forum">
Ajouter un forum
</a>
<div class="collapse" id="add_forum">
	<div class="well">
		<form action="?action=create_forum" method="post">
			<div class="row">
				<div class="col-md-12">
					<label class="control-label" for="nom">Nom du forum</label>
					<input type="text" name="nom" id="nom" maxlength="80" class="form-control" require />
				</div>
			<br/>
			<div class="row">
				<div class="col-md-offset-2 col-md-4">
					<button type="submit" class="btn btn-success btn-lg btn-round">Créer un forum</button>
				</div>
			</div>
		</form>
	</div>
</div><?php
}
} ?>
</center>
</div>
</section>