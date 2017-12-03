<footer>
        <div class="card card-inverse card-primary text-xs-center">
            <div class="card-block">
                <div class="container text-center">
                    <h4 style="color:white;">Rejoignez-nous sur les réseaux sociaux</h4>
                    <h6 style="margin:0px;">&nbsp;</h6>
                    <div class="row">
                        <div class="col-sm-3 text-center wow fadeInLeft">
                            <a href="#" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-facebook"></i>
                                <i class="fa fa-facebook-official fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInLeft" data-wow-delay="0.3s">
                            <a href="#" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-youtube"></i>
                                <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInRight" data-wow-delay="0.4s">
                            <a href="#" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-steam"></i>
                                <i class="fa fa-steam fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInRight" data-wow-delay="0.7s">
                            <a href="#" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-twitter"></i>
                                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-inverse card-inverse text-xs-center bg-inverse">
            <div class="card-block container">
                Tous droits réservés, site créé pour le serveur <?php echo $_Serveur_['General']['name']; ?> avec <a href="http://craftmywebsite.fr">CraftMyWebsite.fr</a><br/>
				Version de CraftMyWebsite: CE <?php echo $versioncms; ?>
                <div style="display:inline-block;float:right;">
                    <a href="#"><span class="badge badge-primary"><?php 
					echo $playeronline; ?></span> Joueurs connectés au serveur</a> / <a href="#"><span class="badge badge-secondary"><?php $req = $bddConnection->query('SELECT COUNT(id) AS count 
					FROM cmw_users');
					$fetch = $req->fetch();
					echo $fetch['count']; ?></span> Membres inscrits</a>
                </div>
            </div>
        </div>
    </footer>