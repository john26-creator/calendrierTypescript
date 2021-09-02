<?php 
if (session_status () != PHP_SESSION_ACTIVE) {session_start();}


?>

<style>

    .service{
        background-color: #f7f7f7;
        border: 1px solid #e4e8ea;
        text-align: center;
        border-radius: 5px;
        padding: 20px 20px 20px;
        margin-bottom: 20px;
        margin-top: 20px;

    }

    .service:hover{
        transition-duration: 0.7s;
        box-shadow: 0px 0px 15px black;
    }

    .header{

        width:100%;
        height: auto;
        background-image:linear-gradient(to bottom, #203a5d, 70%, #4ebac3);
        /*background-color: red;*/

    }

    img{
        display: block;
        max-height: 75%;
        max-width: 75%;
    }



    a{
        color : #4ebac3;
    }

    a:hover{
        transition-duration: 0.7s;
        color : #203a5d;
    }
    a:link {

        text-decoration: none !important;
    }


</style>
<div class="row">


    <div class="col-4">
        <a href="#" id="global" onclick="getAll(0)"><div class="service card-body">
                <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-line-chart"></i></div>
                <p class="card-text"> Suivi Bien-être</p>
            </div></a></div>
    <div class="col-4">
        <a href="#" id="infoPerso" onclick="infoPerso()">
            <div class="service card-body">
                <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-building"></i></div>
                <p class="card-text"> Infos Entreprise</p>
            </div></a>
    </div>

    <div class="col-4">
        <a href="#" id="updateSuiviEntreprise" onclick="formEntreprise()"><div class="service card-body">
                <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-edit"></i></div>
                <p class="card-text"> mise à jour suivi Entreprise</p>
            </div></a>
    </div>


    <?php
    if ($sideBarVariables["DBI"]) {
        echo '<div class="col-4">';
        echo '<a href="#" id="bilanInit" onclick="displayBilanInit()"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-check"></i></div>
                        <p class="card-text"> resultat bilan initial</p>   
                    </div></a></div>';
    }
    if ($sideBarVariables["DBF"]) {
        echo '<div class="col-4">';
        echo '<a href="#" id="bilanFin" onclick="displayBilanFin()"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-check"></i></div>
                        <p class="card-text"> Résultat bilan Final</p>   
                    </div></a></div>';
    }
    ?>

</div>



</div>
</nav>