<style>
.blur{
    backdrop-filter: blur(8px);
}
</style>
<?php
$distant = file_get_contents('http://craftmywebsite.fr/release/version.txt');
if($distant == $versioncms){
    $typeversion = "stable";
}else{
    if($distant < $versioncms){
        $typeversion = "beta";
    }else{
        $typeversion = "outdated"; ?>
        <div class="modal blur show" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modal" style="">
            <div class="modal-dialog modal-xl" role="document">
                    <div class="alert alert-danger">
                        <p class="text-center" style="text-align: center !important;">
                        <center>
                            <h2>ATTENTION:</h2> Il semble que vous essayez d'installer une version antérieur du CMS !<br/>
                            Le support forum / discord n'est pas assuré sur les version antérieur à la <strong><?=$distant;?></strong> hors vous semblez être sur la version <strong><?=$versioncms;?></strong><br/>
                            Continuer uniquement si vous savez ce que vous faites<br/>
                        </center>
                        </p>
                </div>
            </div>
        </div>
    <?php    
    }
} ?>
<h4 class="mb-3"> Version - #<?=$versioncms;?> (<?=$typeversion;?>)</h4>

<div class="accordion" id="accordionExample">

    <div class="card bg-light">

            <h2 class="mb-3">
                <button class="btn btn-block btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Conditions Générales d'Utilisation
                </button>
            </h2>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="margin:0px;">
                <div class="card-body">
                    <?php include('app/miscellaneous/cgu.php'); ?>
                </div>
            </div>
    </div>

</div>
<hr class="mb-4">
            <a href="?action=cgu" class="btn btn-primary btn-lg btn-block">J'ai lu et j'accepte les conditions générales d'utilisations</a>