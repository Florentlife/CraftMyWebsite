<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Achat de Jetons</h1>
	</div>
</header>
<section class="layout" id="page">
<div class="container">

	<?php if(isset($_GET['success']) AND $_GET['success'] == 'true'){ ?>
	<div class="alert alert-success">Votre code a bien été validé, vous avez été crédité de <?php echo $_GET['tokens']; ?>  Jetons ! </div>
	<?php } elseif(isset($_GET['success']) AND $_GET['success'] == 'false'){ ?>
	<div class="alert alert-danger">Le code entré est incorrect, vous n'avez pas été crédité...</div>
	<?php } 
	if($_Serveur_['Payement']['paypal'] == true) 
		{
			?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Payement par PayPal</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-success">Deux possibilités s'offrent à vous pour les dons, vous pouvez payer par PayPal, soit avec votre compte PayPal soit avec votre Carte Bleu de manière sécurisée depuis le site PayPal (le payement ne s'effectue donc pas sur notre serveur/site). L'avantage de PayPal est que le joueur reçoit plus de Jetons qu'avec un payement téléphonique (qui sont surtaxés).</div>
			<?php 
			require_once('controleur/tokens/paypal.php'); 
			?>
			<div class="row">
				<?php
				if(isset($offresTableau))
					for($i = 0; $i < count($offresTableau); $i++)
					{
						echo '
						<div class="col-md-4 offre-boutique">
							<div class="well offre-contenu">
								<div class="contenuBoutique">
									<h3 class="titre-offre">'. $offresTableau[$i]['nom'] .'</h3>
									' .espacement($offresTableau[$i]['description']). '
								</div>
								<div class="footer-offre"> ';
									if(isset($_Joueur_)) {
										if($lienPaypal[$i] == 'viaMail')
											require('controleur/paypal/paypalMail.php');
										else
											echo '<a href="'. $lienPaypal[$i] .'" class="btn btn-primary">Acheter !</a>';
									}
									else { echo'<a href="?&page=connection" class="btn btn-danger">Connexion..</a>'; }
									echo '
									<button class="btn btn-info pull-right">' .$offresTableau[$i]['prix']. ' euro</button>
								</div>
							</div>
						</div>		';
					}
					else
						echo '<div style="margin-left: 15px;margin-right: 15px;" class="alert alert-danger"><strong>Aucune offre de payement par paypal n\'est disponible pour le moment...</strong></div>';
					?>
				</div>
			</div>
		</div>
			<?php 
		}
	if($_Serveur_['Payement']['dedipass'] == true)
	{
		?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Paiement par Dedipass</h3>
			</div>
			 <div class="panel-body">
					<div class="alert alert-success">Vous pouvez payer par Dedipass, vous paierez ainsi avec votre forfait téléphonique, c'est donc un avantage important. D'un autre côté, vous serez déversé de moins de jetons qu'avec un payement paypal (qui sont beaucoup moins taxés).</div>
					<div data-dedipass="<?=$_Serveur_['Payement']['public_key'];?>" data-dedipass-custom=""></div>		
			</div>
		</div>
		<?php
	}
	include('modele/tokens/paysafecard.php');
	if(isset($_Joueur_) && $_Serveur_['Payement']['paysafecard'] == true && !empty($paysafecardTab))
	{
		?>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Paiement par Paysafecard</h3>
			</div>
			 <div class="panel-body">
					<div class="alert alert-success">Vous pouvez payer par Paysafecard, vous paierez ainsi avec une carte prépayé que vous pouvez acheter en bureau tabac. Cependant, ces paiements nécessitent une vérification manuelle par l'administrateur, vos jetons ne seront donc pas directement crédités !</div>
					<div class="row">
						<?php 
						foreach($paysafecardTab as $key => $value)
						{
							?><div class="col-md-4 offre-boutique">
								<div class="well offre-contenu">
									<div class="contenuBoutique">
										<h3 class="titre-offre"><?=$value['montant'];?></h3>
										<?=espacement($value['description']);?>
									</div>
									<div class="footer-offre"> 
										<a class="btn btn-primary" data-toggle="collapse" href="#paysafecard<?=$value['id'];?>" role="button" aria-expanded="false" aria-controls="paysafecard<?=$value['id'];?>">Acheter : </a>
										<div class="collapse" id="paysafecard<?=$value['id'];?>">
										  <div class="card card-body container">
										  	<form action="?action=buyPaysafecard" method="POST">
										  			<input type="hidden" name="offre" value="<?=$value['id'];?>">
												  	<div class="row">
												    	<label class="control-label">Entrez votre code</label>
												    </div>
											    	<div class="row">
											    		<input type="number" name="code" class="form-control" required size="16" />
											    	</div>
											    	<div class="row text-center">
											    		<button type="submit" class="btn btn-success">Envoyer !</button>
											    	</div>
											</form>
										  </div>
										</div>
									</div>
								</div>
							</div>
				  <?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>
</section>
