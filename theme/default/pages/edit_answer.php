<?php 

if(isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?><form action="?action=edit_answer" method="POST">
	<div class="container">
		<h4 class="title">Edition d'une réponse</h4>
		<input type="hidden" name="id_answer" value="<?php echo $id; ?>"/>
		<label for="contenue" class="control-label">Editez votre réponse</label><br/>
		<textarea name="contenue" maxlength="10000" class="form-control" id="contenue"><?php echo $donnee['contenue']; ?></textarea>
		<button type="submit" class="btn btn-primary pull-right">Envoyer</button>
      </div>
	  </form>
      <?php 
}
else
	header('Location: ?page=erreur&erreur=0');
