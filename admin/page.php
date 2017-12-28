<?php 
include './admin/include/donneescustom.php';
include './admin/include/header.php';
?>
<div class="cmw-cube">
	<div class="container-fluid">
		<div class="row">

		<div class="col-xs-12 col-md-8">

				<div class="cmw-left-navbar">
					<a class="hvr-wobble-horizontal" href="admin.php"> CraftMyWebsite - Gestion du site <?php echo $lecture['General']['name']; ?></a>
					<a href="index.php" class="cmw-pull-right hvr-grow-shadow"><i class="fa fa-desktop" aria-hidden="true"></i> Voir le site</a>
				</div>

			</div>

			<div class="col-xs-12 col-md-4" style="padding-right: 0px;">

				<div class="cmw-right-navbar">
					<audio id="horn" src="./admin/assets/sound/horn.mp3"></audio>
					<a onmouseover="document.getElementById('horn').play()" onmouseout="document.getElementById('horn').pause()" href="index.php?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>" class="dropdown-toggle cmw-header-username hvr-buzz" data-toggle="dropdown"><img src="https://mc.frozenspace.net/api/avatar/<?php echo $_Joueur_['pseudo']; ?>/32" /> <?php echo $_Joueur_['pseudo']; ?></a>
					<a href="../index.php?&action=deco" class="cmw-nav-disconnect hvr-underline-reveal"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a></div>
				</div>

			</div>
		</div>
		<div class="container-fluid">
			<div class="cmw-main-container">
				<div class="row">
					<div class="cmw-sidebar col-xs-12 col-md-2">
						<?php include './admin/include/sidebar.php'; ?>
					</div>

					<div class="cmw-page-container col-xs-12 col-md-10">
						<?php include './admin/include/pagegen.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include './admin/include/footer.php'; ?>
