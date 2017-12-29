<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Boutique</h1>
	</div>
</header>
<section class="layout" id="page">
<div class="container">
	<div class="text-center">
		<h4 class="text-primary"><i class="fa fa-shopping-cart"></i> Boutique</h4>
		<h5><center>Comment ça marche?</center></h5>
		<p><center><strong>
			La boutique permet d'acheter du contenu In-Game depuis le site grâce à de l'argent réel, cela sert à payer l'hébergement du serveur.
			La monnaie virtuelle utilisée sur la boutique est le "Jeton", vous pouvez obtenir des jetons en échange de dons <a href="?&page=token" style="color: blue;">sur cette page</a>
		</strong></center></p>
		</br>
		<?php if(isset($_Joueur_)) { ?>
		<center>
		<hr>
			<font style="font-family: minecraftia;font-size: 20px;">Bonjour <?php echo $_Joueur_['pseudo']; ?></font>
				<h4>Vous avez <strong><?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' <img style="width: 25px;" src="./theme/default/img/jeton.png" />'; ?></h4></strong>
				<a href="?page=panier" class="btn btn-primary btn-block">Votre panier contient <?php echo $_Panier_->compterArticle().($_Panier_->compterArticle()>1 ? ' articles' : ' article') ?></a>
		</center>
		<?php } else { ?>
		<hr>
		<center>
		<h4>Veuillez vous connecter pour accéder à la boutique:</h4>
		<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Connexion</a>
		</center>
		<?php } ?>
	</div>
	</br>
	</br>
	<h3><center>Choisissez votre catégorie :</center></h3>
		<div class="tabbable">
			<ul class="nav nav-tabs" style="margin-bottom:5vh;">
			<?php
			$j = 0;
			while($j < count($categories))
			{
			$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
			?>
				  
					<li class="nav-item">
						<a href="#categorie-<?php echo $j; ?>" data-toggle="tab" class="nav-link <?php if($j == 0) echo 'active'; ?>"><?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); echo $categories[$j]['titre']; ?></a>
					</li>
			<?php $j++; } ?>
			</ul>
			<div class="tab-content">
				<?php
				$j = 0;
				while($j < count($categories))
				{
				$categories[$j]['titre'] = str_replace(' ', '_', $categories[$j]['titre']);
				?>
				
				<div id="categorie-<?php echo $j; ?>" class="tab-pane fade <?php if($j==0) echo 'in active show';?>" <?php if($j == 0) { echo 'aria-expanded="true"'; } else echo 'aria-expanded="false"'; ?>>
				<?php $categories[$j]['titre'] = str_replace('_', ' ', $categories[$j]['titre']); ?>
						<div class="panel-body">
							<?php if($categories[$j]['message'] == ""){ ?>
							<?php } else { ?>
							<p>
							<div class="alert alert-dismissable alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<center><?php echo $categories[$j]['message']; ?></center>
							</div>
							</p>
							<?php } ?>
							<div class="row">
							<?php
								foreach($categories as $key => $value)
								{
									$categories[$key]['offres'] == 0;
								}
								for($i = 1; $i <= count($offresTableau); $i++)
								{
									if($offresTableau[$i]['categorie'] == $categories[$j]['id'])
									{
										echo '
										<div class="col-md-4 panel panel-default" style="margin-left: 10px;width: 30%;">
											<div class="panel-body">
													<h3 class="titre-offre"><center>'. $offresTableau[$i]['nom'] .'</center></h3>
													<div class="offre-description">' .$offresTableau[$i]['description']. '</div>
												</div>
												';
													if(isset($_Joueur_)) {
														echo '<a href="?page=boutique&offre=' .$offresTableau[$i]['id']. '" class="btn btn-primary btn-block" title="Voir la fiche produit"><i class="fa fa-eye"></i></a>';
													echo '<a href="?action=addOffrePanier&offre='. $offresTableau[$i]['id']. '&quantite=1" class="btn btn-info btn-block" title="Ajouter directement au panier une unité"><i class="fa fa-shopping-basket"></i></a>';}
													else { echo'<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-block" ><span class="glyphicon glyphicon-user"></span> Se connecter</a>'; }
										echo '<button class="btn btn-success btn-block">Prix : ' .$offresTableau[$i]['prix']. ' <img style="width: 25 px;" src="./theme/default/img/jeton.png" /></button>
													</br>
													</button>
												
										</div>		';
										$categories[$j]['offres']++;
									}
								}
							?>
							</div>
							<?php 
							if($categories[$j]['offres'] == 0)
								echo '<div class="alert alert-dismissible alert-danger">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<center><strong>Oh zut !</strong> <a href="#" class="alert-link">'.$categories[$key]['titre'].'</a> est encore vide, ré-essayez plus tard !.</center>
								</div>';
							?>
						</div>
					</div>
				<?php $j++; } ?>	
			</div>
		</div>						
	<?php
	if(isset($_GET['offre']))
	{
	?>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header"  style="background-color: #0c84e4;">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel" style="color: white;">Achat de: <?php echo $infosOffre['offre']['nom']; ?></h4>
		  </div>
		  <div class="modal-body">
				<p>
					<br />
					Vous obtiendrez ce grade sur <?php echo $infosCategories['serveur']; ?>.<br />
					<?php
					$enLigne = false;
					if($infosCategories['serveurId'] == -2 OR $infosCategories['serveurId'] == -1)
						for($i = 0; $i < count($lecture['Json']); $i++)
						{
							if($enligne[$i])
							{
								echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$i]['nom'] .'"';
								$enLigne = true;
							}
							
						}
					else
						if($enligne[$infosCategories['serveurId']])
						{
							echo 'Vous êtes connecté sur le serveur:<br /> "'. $lecture['Json'][$infosCategories['serveurId']]['nom'] .'"';
							$enLigne = true;
						}
						
					if(!$enLigne AND $infosCategories['connection'])
						echo 'Vous n\'êtes pas connecté sur le serveur !';
					?>
					<br />
					<br />
					Cette offre contiens: <br />
					<blockquote>
					<?php
					if(isset($infosOffre['offre']['description']))
						echo $infosOffre['offre']['description'];
					else
						echo 'Cette offre est un don sans contrepartie...';
					?>
					</blockquote>
				</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
			<?php 	if(($enLigne AND $infosCategories['connection']) OR !$infosCategories['connection']) { ?>
							<form action="index.php" method="GET">
								<input type="hidden" name="action" value="addOffrePanier"/>
								<input type="hidden" name="offre" value="<?php echo $_GET['offre']; ?>"/>
								<label for="quantite">Quantité à acheter : </label>
								<input type="number" id="quantite" name="quantite" value="1" />
								<button type="submit" class="btn btn-success">Ajouter au panier</button>
							</form><?php } else{ ?>
							Connectez vous sur le serveur voulu... <?php } 
					?>
		  </div>
		</div>
	  </div>
	</div>
	<?php

	$modal = true;
	$idModal = 'myModal';

	}
	?>
</div>
</section>
