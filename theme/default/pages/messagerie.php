<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Messagerie</h1>
	</div>
</header>
<section class="layout" id="page">
	<div class="container">	
		<h3>Messagerie ...</h3>
		<div class="categories-edit">
			<ul class="nav nav-tabs" id="modifProfil">
				<li class="col-md-6 active"><a href="#conversation" data-toggle="tab"><center>Conversations</center></a></li>
				<li class="col-md-6"><a data-toggle="modal" data-backdrop="static" href="#modalRep"><center>Nouveau message</center></a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" style="margin-top: 10px;" id="infos">
				<?php
				$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
				$messages = $Messagerie->getConversations();
				if(!empty($messages['conv']))
				{
					?>
					<div id="accordion">
						<?php 
							foreach($messages['conv'] as $value)
							{
								$Img = new ImgProfil($value['from'], 'pseudo');
								?>
								<div class="card">
							    	<div class="card-header card-header-messagerie" id="messageHead<?=$value['id'];?>">
							      		<h5 class="mb-0">
							        		<button class="btn btn-link btn-message" type="button" data-toggle="modal" data-target="#modalMessage" data-backdrop="static"  data-id="<?=$value['id'];?>" data-with="<?=$value['from'];?>"><p class="text-left">
							          			<?=($value['lu'] == 0) ? '<i class="fas fa-envelope" id="i'.$value['id'].'"></i>': '<i class="far fa-envelope-open" id="i'.$value['id'].'"></i>';?> <img src="<?=$Img->getImgToSize(24, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="none" /><strong><?=$value['from'];?></strong>
							          			<span style="float: right;">le <?=$value['date'];?></span></p>
							          			<p class="text-message"><?=$value['message'];?></p>
							        		</button>
							      		</h5>
							    	</div>
							    </div>
								<?php
							} ?>
						</div>
					<?php 
				}
				?>
			</div>
	</div>
</section>