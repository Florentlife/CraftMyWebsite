<div class="modal fade" id="ConnectionSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Connexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form class="form-signin" role="form" method="post" action="?&action=connection">
      <div class="modal-body">
		<div class="row">
			<?php if(isset($_COOKIE['pseudo'])) 
				echo '<div class="col-md-4">
				<img class="profile-img" src="https://minecraft-api.com/api/skins/128.php?player='.$_COOKIE['pseudo'].'" alt="" />
				</div>';
			?>
			<div class="<?php if(isset($_COOKIE['pseudo'])) echo 'col-md-8'; else echo 'col-md-12'; ?>">
				<div class="form-group row">
					<label for="PseudoConectionForm" class="col-md-3 col-form-label">Pseudo </label>
					<div class="col-md-6">
						<input type="text" name="pseudo" class="form-control" id="PseudoConectionForm" placeholder="Pseudo" required autofocus>
					</div>
				</div>
				<div class="form-group row">
					<label for="MdpConnectionForm" class="col-md-3 col-form-label">Mot de passe </label>
					<div class="col-md-6">
						<input type="password" name="mdp" class="form-control" id="MdpConnectionForm" placeholder="Votre mot de passe" required>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-9">
					  <div class="form-check">
						<label class="form-check-label">
						  <input class="form-check-input" name="reconnexion" type="checkbox"> Se souvenir de moi
						</label>
					  </div>
					</div>
				</div>	
				<center><a href="#" data-target="#passRecover" data-toggle="modal">Mot de passe oublié ?</a></center>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Connexion</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<div class="modal fade" id="passRecover" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form class="-signin" role="form" method="post" action="?&action=passRecover">
      <div class="modal-body">
        <div class="row">
			<p class="text-justify text-center">Merci d'indiquer votre email utilisé à l'inscription , vous recevrez un lien pour réinitialiser votre mot de passe.</p>
			<div class="offset-md-2 col-md-8"><input type="email" name="email" class="form-control" id="EmailRecoverForm" placeholder="Email" required autofocus></div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="InscriptionSlide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form role="form" method="post" action="?&action=inscription">
      <div class="modal-body">
		<center><p><div class="alert alert-warning" style="text-align: center;">Veuillez mettre une adresse email correcte !</div></p></center>
		<div class="form-group row">
			<label for="PseudoInscriptionForm" class="col-md-2 col-form-label">Pseudo</label>
			<div class="col-md-8">
				<input type="text" name="pseudo" class="form-control" id="PseudoInscriptionForm" placeholder="Votre pseudo exact In-Game">
			</div>
		</div>
		<div class="form-group row">
			<label for="EmailInscriptionForm" class="col-md-2 col-form-label">Email</label>
			<div class="col-md-8">
				<input type="email" name="email" class="form-control" id="EmailInscriptionForm" placeholder="Merci d'entrer une adresse email valide">
			</div>
		</div>
		<div class="form-group row">
			<label for="MdpInscriptionForm" class="col-md-2 col-form-label">Mot de passe</label>
			<div class="col-md-8">
				<input type="password" name="mdp" class="form-control" id="MdpInscriptionForm" placeholder="Votre mot de passe">
			</div>
		</div>
		<div class="form-group row">
			<label for="MdpConfirmInscriptionForm" class="col-md-2 col-form-label">Mot de passe</label>
			<div class="col-md-8">
				<input type="password" name="mdpConfirm" class="form-control" id="MdpConfirmInscriptionForm" placeholder="Confirmez-le">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-6">
			  <div class="form-check">
				<label class="form-check-label">
				  <input type="checkbox" name="souvenir" checked> S'inscrire à la newsletter.
				</label>
			  </div>
			</div>
		</div>	
		<div class="form-group row">
			<div class="col-md-6">
				<label>Captcha:</label>
				<input type='text' name='CAPTCHA' placeholder='captcha' class="form-control"/>
			</div>
			<div class="col-md-6">
				<img id='captcha' src='include/purecaptcha/purecaptcha_img.php?t=login_form' style="width: 100%;height: 100px;"/>
				<br/>
				<button type="button" onclick='var t=document.getElementById("captcha"); t.src=t.src+"&amp;"+Math.random();' href="" class="btn btn-info"><i class="fa fa-refresh"></i> Recharger le captcha</button>
				<br/>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
      </div>
	  </form>
    </div>
  </div>
</div>