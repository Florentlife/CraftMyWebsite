<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Forum</h1>
	</div>
</header>
<section class="layout" id="page">
<div class="container">
<div class="alert alert-info" role="alert">
	Bienvenue sur le forum de <?php echo $_Serveur_['General']['name']; ?>,
	Ici vous pourrez échanger et partager avec toute la communauté du serveur ! </div>
<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['modeJoueur'] == true)
 	{
 		?>
 			<p class="text-center">
 				<a href="?action=mode_joueur" class="btn btn-primary">Passer en mode visuel <?php echo ($_SESSION['mode']) ? "Administrateur" : "Joueur"; ?></a>
 			</p>
 		<?php 
 	}
$fofo = $_Forum_->affichageForum();
for($i = 0; $i < count($fofo); $i++)
{ ?>
		</br><br/>
		<table class="table table-striped">
		<div class="row"><div class="col-md-9"><center><h3><?php echo ucfirst($fofo[$i]['nom']); ?></h3></center></div><?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['general']['deleteForum'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']){ ?><div class="col-md-3" style="text-align: right;"><a href="?action=remove_forum&id=<?php echo $fofo[$i]['id']; ?>" class="btn btn-danger" style="text-align: right;">Supprimer</a></div><?php } ?></div>
		<thead>
			<tr>
				<th></th>
				<th>Nom</th>
				<th>Sous-Forum</th>
				<th>Dernière réponse</th>
				<th>Nombre de discussions</th>
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
				?></td>
			<td><p class="text-right"><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $_Forum_->compteTopicsForum($categorie[$j]['id']); ?></a></p></td><?php
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
if($_PGrades_['PermsForum']['general']['addForum'] == true OR $_Joueur_['rang'] == 1)
{
	?><a class="btn btn-primary btn-xs btn-block" role="button" data-toggle="collapse" href="#add_forum" aria-expanded="false" aria-controls="add_forum">
Ajouter une Catégorie
</a>
<div class="collapse" id="add_forum">
	<div class="well">
		<form action="?action=create_forum" method="post">
			<div class="row">
				<div class="col-md-12"><br>
					<p class="text-center"><label class="control-label" for="nomFo">Nom de la catégorie</label></p>
					<input type="text" name="nom" id="nomFo" maxlength="80" class="form-control" require="">
				</div>
			</div>
			<br/>
			<p class="text-right">
				<button type="submit" class="btn btn-success btn-lg btn-round">Créer une catégorie</button>
			</p>
		</form>
	</div>
</div><br><?php
}
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addCategorie'] == true ) AND !$_SESSION['mode'])
{
	?>
	<a class="btn btn-primary btn-xs btn-block" role="button" data-toggle="collapse" href="#add_categorie" aria-exepanded="false" aria-controls="add_categorie"> Ajouter un Forum</a>
	<div class="collapse" id="add_categorie">
			<form action="?action=create_cat" method="post"><br>
				<div class="from-group row">
						<label class="col-md-6 col-form-label" for="nomCat">Nom du Forum : </label>
						<div class="col-md-6">
							<input type="text" name="nom" id="nomCat" maxlength="40" class="form-control" require />
						</div>
				</div><br>
				<div class="froum-group row">
						<label class="col-md-6 col-form-label" for="img">Icon disponible sur : <a href="https://design.google.com/icons/">https://design.google.com/icons/</a></label>
						<div class="col-md-6">
							<input type="text" name="img" id="img" maxlength="300" class="form-control" />
						</div>
				</div><br>
				<div class="form-group row">
						<label class="col-md-6 col-form-label">Catégorie : </label>
						<div class="col-md-6">
							<select name="forum" class="form-control" require>
								<?php
								for($z = 0; $z < count($fofo); $z++)
								{
									?><option value="<?php echo $fofo[$z]['id']; ?>"><?php echo $fofo[$z]['nom']; ?></option><?php
								}
								?></select>
						</div><br/>
				</div><br>
				<p class="text-right">
					<button type="submit" class="btn btn-success btn-lg btn-round">Créer un Forum</button>
				</p>
			</form>
	</div>
<?php
}
?>
</div>
</section>