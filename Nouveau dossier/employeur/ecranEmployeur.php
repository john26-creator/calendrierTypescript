<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/employeur/header.php");
if (session_status () != PHP_SESSION_ACTIVE) {session_start();}?>
<?php if (!isset ($_SESSION["entreprise"])) {
    if ($_SERVER['PHP_SELF'] == "/employeur/ecranEmployeur.php") {header('Location: indexEmployeur.php');}
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeurController.php");

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");

?>

<?php 
//affichage des erreurs PHP en direct
error_reporting(E_ALL);
ini_set("display_errors", 1);
$employeurController = new EmployeurController;
$sideBarVariables = $employeurController->getDisplayBarVariables();

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

<div class="main">
<div class="container">
    <div class="row">        
            <div style="text-align:left;" class="col-6"> <span class="alert alert-warning">Derni&egrave;re connexion le <?php 
        $employeurController = new EmployeurController;
        echo $employeurController->lastConnexion();
        ?></span></div>
            <div style="text-align: center;" class="col-2"><?php 
        $employeur = new Employeur;
        $employeurInfos = $employeur->getEmployeurById($_SESSION['entreprise']);
        $tab = (array) $employeurInfos[0] ;
       

       echo '<h3><p style="margin-top:28px;">'.$tab['nomEntreprise'].'</p></h3>';

        ?></div>
            <div class="col-4"><img style="border-radius: 50%; float:right;" src="../controllers/DispatcherEmployeur.php?fonction=logoEntreprise" height="80" width="80" alt="logo entreprise" title="image"/></div>
    </div>        

<BR />

        

        

        
</div>

<div align="center">
            <div class="row" style=" margin-left:10px; margin-right: 10px;">
                <div id="1" class="col-sm-12 col-md-12 col-lg-6">
                    
                    <a href="#" id="global" onclick="getAll(0)"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-line-chart"></i></div>
                        <p class="card-text"> Suivi </p>   
                    </div></a>
                </div>
            
              
             
                
                <div  id="3" class="col-sm-12 col-md-12 col-lg-6">
                    <?php
                if ($sideBarVariables["DBI"]) {
                    echo '<a href="#" id="bilanInit" onclick="displayBilanInit()">';
                }
                if ($sideBarVariables["DBF"]) {
                    echo '<a href="#" id="bilanFin" onclick="displayBilanFin()">';
                } 
              ?>
                    <div class="service  card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-bar-chart"></i></div>
                        <p class="card-text"> Epuisement professionnel </p>
                    </div>
                    </a>
                </div>
            </div>
            </div>
 <div id="mainContainer"></div>       
</div>


</div></div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");?>