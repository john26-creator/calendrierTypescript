<?php 
if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
include_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/EmployeController.php");

$employeController = new EmployeController;
$sideBarVariables = $employeController->getSideBarVariables();
?>





	<div id="sideBarEmploye">
		<div class="row" style=" margin-left:10px; margin-right: 10px;">
                <div id="1" class="col-sm-12 col-md-12 col-lg-4">
                    <a class="nav-link" href="#" id="infoPerso" onclick="infoPerso()"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-user"></i></div>
                        <p class="card-text"> Informations Personnelles </p>   
                    </div></a>
                </div>

            <?php
            if ($sideBarVariables["DEB"]) {
            ?>
                <div id="2" class="col-sm-12 col-md-12 col-lg-4">
                    <a class="nav-link" href="#" id="global" onclick="getAll(0)"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-line-chart"></i></div>
                        <p class="card-text"> Suivi global</p>   
                    </div></a>
                </div>
                <?php
            }
            if ($sideBarVariables["DEEBES"]) {
            ?>
                 <div id="3" class="col-sm-12 col-md-12 col-lg-4">
                    <a class="nav-link" href="#" id="suivitSemaine" onclick="suivitSemaine(<?php echo $sideBarVariables["tmp"]->getSemaine();?>)"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-question"></i></div>
                        <p class="card-text"> Suivi de la semaine </p>   
                    </div></a>
                </div>
            <?php
            }
            ?>

            </div>
            <div class="row" style=" margin-left:10px; margin-right: 10px;">
            <?php
				if ($sideBarVariables["FBI"]) {
				echo '<div id="4" class="col-sm-12 col-md-12 col-lg-4"><a class="nav-link" href="#" id="bilan" onclick="bilan(0)">
                    <div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-question"></i></div>
                        <p class="card-text"> Bilan Initial</p>   
                    </div></a>
                </div>';
				}
				if ($sideBarVariables["FBF"]) {
				echo '<div id="4" class="col-sm-12 col-md-12 col-lg-4">
                    <a class="nav-link" href="#" id="bilan" onclick="bilan(1)"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-question"></i></div>
                        <p class="card-text"> Bilan Final</p>   
                    </div></a>
                </div>';
				}
				if ($sideBarVariables["DBI"]) {
				echo '<div id="4" class="col-sm-12 col-md-12 col-lg-4">
                    <a class="nav-link" href="#" id="bilanInit" onclick="diplayBilanInit()"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fas fa-check"></i></div>
                        <p class="card-text">Résultat bilan Initial</p>   
                    </div></a>
                </div>';
				}
				if ($sideBarVariables["DBF"]) {
				echo '<div id="4" class="col-sm-12 col-md-12 col-lg-4">
                    <a class="nav-link" href="#" id="bilanFin" onclick="diplayBilanFin()"><div class="service card-body">
                        <div style="font-size:65px;padding: 20px 20px 10px;"><i class="fa fa-line-chart"></i></div>
                        <p class="card-text">Résultat Bilan Final</p>   
                    </div></a>
                </div>';
				} ?>
			</div>
		</div>