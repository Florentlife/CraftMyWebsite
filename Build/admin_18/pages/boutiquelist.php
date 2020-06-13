<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Historique de la boutique
    </h2>
</div>
<style>
:disabled{
    cursor: not-allowed;
    display: inherit;
}
.inputwithoutarrow::-webkit-outer-spin-button,
.inputwithoutarrow::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.inputwithoutarrow[type=number] {
  -moz-appearance: textfield;
}
</style>


<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage'))
{
	echo '
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder à cette page.</strong>
		</div>';
} 
else
{ ?>


<div class="row">

    <div class="col-xs-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Liste des Achats <small id="infoState">(Croissant sur ID)</small>
                </h4>
            </div>
            <div class="card-body">
            	<div class="row" style="margin-bottom:20px;">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                    	<?php $req = $bddConnection->query('SELECT COUNT(id) AS count FROM cmw_boutique_stats'); $data = $req->fetch(PDO::FETCH_ASSOC);  ?>
                        <h5>Nombre d'achat/pages: <input style="margin-top:3px;" type="number"
                                onchange="setMaxShow('input-changemax')" id="input-changemax" min="1"
                                max="<?php echo $data['count']; ?>" step="1" placeholder="2020 ?" class="input-disabled form-control"
                                value="<?php echo $data['count']>50 ? '50': $data['count'] ; ?>"> 
                                <button type="button" onclick="setMaxShow('input-changemax')" class="btn w-100 btn-success d-sm-block d-md-none">Mettre à jour</button></h5>
                        <h5 style="margin-top:20px;">Rechercher un membre: <input style="margin-top:3px;" type="text"
                                onkeyup="updateList();" id="input-search" class="input-disabled form-control"
                                placeholder="ex: Vladimir"></h5>
                    </div>
                </div>
                   <table class="table table-striped table-hover">
						<thead>
							<tr>
								<th style="width:75px;cursor:pointer;" onclick="setAxe('id')">ID</th>
                                <th style="cursor:pointer;" onclick="setAxe('pseudo');">Pseudo</th>
                                <th style="cursor:pointer;" onclick="setAxe('offre_id');">Offre</th>
                                <th style="cursor:pointer;" onclick="setAxe('prix');">Prix Unitaire</th>
                                <th >Quantité</th>
                                <th style="cursor:pointer;" onclick="setAxe('prixTotal');">Prix Total</th>
                                <th style="cursor:pointer;" onclick="setAxe('date_achat');">Date d'achat</th>

							</tr>
						</thead>
						<tbody id="allAchat">
					
						</tbody>
					</table>
            </div>
            <div class="card-footer">

                    <div class="row">

                        <div class="offset-md-4"></div>
                        <div class="col-md-4">

                            <div class="d-flex justify-content-center">

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <button class="page-link" onclick="lessIndex();" aria-hidden="true"
                                                id="left">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </button>
                                        </li>
                                        <input min="0" step="1" class="text-center inputwithoutarrow" max="9999" onchange="setIndex();"
                                            id="block" type="number" value="0" />

                                        <li class="page-item">
                                            <button class="page-link" onclick="moreIndex();" aria-hidden="true"
                                                id="right">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </button>
                                        </li>
                                    </ul>
                                </nav>


                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
var maxShow;
var oldmaxShow;
var index;
var block;
var right = document.getElementById("right");
var left = document.getElementById("left");
var valindex = document.getElementById("block");
var PlayerTotal = <?php echo $data['count']; ?>;
var axe = "id";
var axeType = "ASC"; /* ASC = croissant && DESC = !ASC */


$(window).on('load', function () {
    maxShow =oldmaxShow= (PlayerTotal>50) ? 50:PlayerTotal;
    index = 0;
   
    updateIndex();
});


function setIndex(){
    let nb = valindex.value;

    if(nb <= PlayerTotal / maxShow){
        index = nb;
    } else {
        valindex.value = index =  Math.trunc(PlayerTotal / maxShow) ;
    }
    
    updateIndex();
}

function setAxe(a) {
    if(a != axe)
    {
        axe = a;
        axeType = "DESC";
    }
    else {
        axeType = axeType == "DESC" ? "ASC" : "DESC";
    }
    updateList();
}

function updateIndex() {
    left.disabled = index <= 0;
    right.disabled = index + 1 >= PlayerTotal / maxShow;
    updateList();
}

function lessIndex() {
    index--;
    valindex.value = index;
    setIndex();
}

function moreIndex() {
    index++;
    valindex.value = index;
    setIndex();
}

function updateState() {
    document.getElementById("infoState").innerHTML="("+(axeType == "DESC" ? "Décroissant" : "Croissant")+" sur "+axe+")";
}

function updateList()
{
    updateState();
    $.post("admin.php?action=getJsonAchat",
    {
        axe: axe,
        axeType: axeType,
        index: index,
        search: document.getElementById("input-search").value,
        max: maxShow
    }, function(data, status){
    	console.log(data);
        if(status != "success")
        {
              notif("error", "Erreur lors du chargement", status, 5000);
        } else {
            try {
            	if(data.includes('[DIV]')) {
              	  showAll(JSON.parse(data.substring(data.indexOf('[DIV]')+5)));
            	}
            } catch(e) {
                notif("error", "Erreur lors du chargement", e, 5000);
            }
        }
    });
}



async function showAll(allPlayer) {
    let el = document.getElementById("allAchat");
    var all = '';
    for(let i = 0; i < allPlayer.length; i++) {
        all += '<tr class="ligneMembres"';
        all += '<td>'+allPlayer[i].id2+'</td>';
         all += '<td>'+allPlayer[i].pseudo+'</td>';
          all += '<td>'+allPlayer[i].offre_id+'</td>';
           all += '<td>'+allPlayer[i].prix+'</td>';
            all += '<td>'+allPlayer[i].quantite+'</td>';
             all += '<td>'+allPlayer[i].prixTotal+'</td>';
              all += '<td>'+allPlayer[i].date_achat+'</td>';
        all += '</tr>';
    }
    el.innerHTML = all;
    block = document.querySelectorAll(".input-disabled");
}

function setMaxShow(id) {
    let doc = document.getElementById(id);
    if( parseInt(doc.value) == 2020) { alert("Le Covid-19 ne nous aura pas eu !"); }
    doc.value = parseInt(doc.value) > PlayerTotal ? PlayerTotal : parseInt(doc.value) < 1 ? 1 : doc.value;
    if(oldmaxShow != doc.value){
        oldmaxShow = maxShow = doc.value;
      updateIndex();
    }
}
</script>
	<?php 
}