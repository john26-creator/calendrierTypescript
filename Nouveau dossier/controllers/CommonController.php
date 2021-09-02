<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employeur.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Employe.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Evaluationburnout.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/SuivitEmploye.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/Division.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/Utils.php");


class CommonController
{
    private  $employeurDAO;
    private  $employeDAO;
    private  $evaluationBurnoutDAO;
    private  $suivitEmployeDAO;
    private  $divisionDAO;
    
    function __construct() {
        $this->employeDAO = new Employe;
        $this->evaluationBurnoutDAO = new EvaluationBurnout;
        $this->suivitEmployeDAO = new SuivitEmploye;
        $this->employeurDAO = new Employeur;
        $this->divisionDAO = new Division;
    }
    
    
    public function getDivisions ($idEntreprise) {
        $divisions = $this->divisionDAO->findAll ($idEntreprise);
        $resultat = array();
        foreach ($divisions as $division){
            array_push($resultat, ["nom" => $division->getNom(), "division" => $division->getId()]);
        }
        return json_encode($resultat);
    }
    
    /**
     * retourne un tableau associatif ("DBI" => $DBI, "DBF" => $DBF)
     * DBI = Display Bilan Initial
     * DBF = Display Bilan Final
     */
    public function getDisplayBarVariables ($idEntreprise) {
        $tmp = $this->employeurDAO->getEmployeurById ($idEntreprise) [0];
        $bilan = $tmp->getBilan();
        
        if ($bilan == 0) { // Le bilan initial est en cours
            $DBF = false;
            // verifions l'état des bilans initiaux. Si il y a au moins un bilan fait on  affiche la moyenne des bilans initiaux
            $evaluationList = $this->evaluationBurnoutDAO->findByIdEntrepriseAndSemaine($idEntreprise,0);
            if (count ($evaluationList) > 0) {
                $DBI = true;
            }
            else {
                $DBI = false;
            }
        }
        else { // tous les bilan initiaux ont été fait
            $DBI = true;
            // verifions l'état des bilans finaux. Si il y a au moins un bilan fait on  affiche la moyenne des bilans finaux
            $evaluationList = $this->evaluationBurnoutDAO->findByIdEntrepriseAndSemaine($idEntreprise,1);
            if (count ($evaluationList) > 0) {
                $DBF = true;
            }
            else {
                $DBF = false;
            }
        }
        
        return array("DBI" => $DBI, "DBF" => $DBF);
    }
    
    function getInfoPersoEmployeur ($idEntreprise) {
        $results = $this->employeurDAO->getEmployeurById($idEntreprise);
        
        $response ='<table class="table table-primary table-hover">
		<thead class="thead-primary">
			<tr>
				<th scope="col">Num Entreprise</th>
				<th scope="col">Nom Employeur</th>
				<th scope="col">Entreprise</th>
			</tr>
		</thead>
		<tbody>';
        
        if(count ($results) > 0)
        {
            $result = $results[0];
            $response .= "<tr>";
            $response .= "<td>" . $result->getId() . "</td>";
            $response .= "<td>" . $result->getDirigeant() . "</td>";
            $response .= "<td>" . $result->getNomEntreprise() . "</td>";
            $response .= "</tr>";
            
            return $response;
        }
        $response .= '</tbody>
		</table>';
        return "error no employe found";
    }
    
    /**
     * Creation du graphes de suivit bien être global
     * Moyenne des indicateur bien être (sommeil, energie...)
     */
    public function getGlobal ($id_division=0,$idEntreprise) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $results = $this->suivitEmployeDAO->getSemainesSuivitsEmployesByEntrepriseId ($idEntreprise);
        
        $weeks = $this->getWeeks ($results);
        
        $plots = array();
        $labels = array();
        $ids_employe = array();
        
        if ($id_division!=0){
            $ids_employe = $this->employeDAO->findEmployesFromDivision($id_division);
        }
        
        for($i = 0; $i < count($weeks); ++$i) {
            
            if(count($ids_employe)==0) {
                $results = $this->suivitEmployeDAO->getSuivitsEmployesByEntrepriseIdAndWeek ($idEntreprise,$weeks[$i]);
            }
            else {
                $results = $this->suivitEmployeDAO->getSuivitsEmployesByEntrepriseIdWeekAndDivision ($idEntreprise,$weeks[$i],$ids_employe);
                
            }
            
            $sum = 0;
            $nbResult = 0;
            
            foreach ($results as $result){
                $sum += ($result->getSommeil() + (10 - $result->getStress()) + (10 - $result->getAnxiete()) +  $result->getEnergie() +  $result->getDigestion()) / 5;
                $nbResult++;
            }
            if ($nbResult == 0) {$nbResult = 1;}
            array_push($plots, $sum/$nbResult);
            array_push($labels, "semaine" . $weeks[$i]);
        }
        
        return array (["label"=>$labels,"values"=>$plots]);
    }
    
    
    /**
     * Creation des graphes de suivi bien être (sommeil, energie...)
     */
    public function createEvolutionChart ($title,$id_division=0,$idEntreprise) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $results = $this->suivitEmployeDAO->getSemainesSuivitsEmployesByEntrepriseId ($idEntreprise);
        $weeks = $this->getWeeks ($results);
        $ids_employe = $this->getEmployefromDivision ($id_division);
        $arrays = $this->addLabelAndPlot($weeks,$title,$ids_employe,$idEntreprise);
        return array(["label"=>$arrays["labels"],"values"=>$arrays["plots"]]);
    }
    
    public function stress ($id_division=0) {
        return $this->createEvolutionChart("stress",$id_division);
    }
    
    public function anxiete ($id_division=0) {
        return $this->createEvolutionChart("anxiete",$id_division);
    }
    
    public function energie ($id_division=0) {
        return $this->createEvolutionChart("energie",$id_division);
    }
    
    public function sommeil ($id_division=0) {
        return $this->createEvolutionChart("sommeil",$id_division);
    }
    
    public function digestion ($id_division=0) {
        return $this->createEvolutionChart("digestion",$id_division);
    }
    
    
    
    /**
     * Effectue la moyenne des suivis employés
     * Renvoie ces donnees
     */
    private function addLabelAndPlot ($weeks,$indicator, $ids_employe, $idEntreprise) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $plots = array();
        $labels = array();
        
        for($i = 0; $i < count($weeks); ++$i) {
            $results = array();
            if(count($ids_employe)==0) {
                $results = $this->suivitEmployeDAO->getSuivitsEmployesByEntrepriseIdAndWeek ($idEntreprise,$weeks[$i]);
            }
            else {
                $results = $this->suivitEmployeDAO->getSuivitsEmployesByEntrepriseIdWeekAndDivision ($idEntreprise,$weeks[$i],$ids_employe);
            }
            
            $sum = 0;
            $nbResult = 0;
            foreach ($results as $result){
                switch ($indicator) {
                    case "stress":
                        $sum += $result->getStress();
                        break;
                    case "anxiete":
                        $sum += $result->getAnxiete();
                        break;
                    case "digestion":
                        $sum += $result->getDigestion();
                        break;
                    case "energie":
                        $sum += $result->getEnergie();
                        break;
                    case "sommeil":
                        $sum += $result->getSommeil();
                        break;
                }
                $nbResult++;
            }
            
            if ($nbResult == 0) {$nbResult = 1;}
            array_push($plots, $sum/$nbResult);
            array_push($labels, "semaine" . $weeks[$i]);
        }
        return array("plots" => $plots, "labels" => $labels);
    }
    
    private function getWeeks ($results) {
        $weeks = array();
        foreach ($results as $result){
            array_push($weeks, $result->getSemaine());
        }
        return $weeks;
    }
    
    /**
     * créer le chart des bilans finaux des employés
     **/
    public function diplayBilanInit ($id_division=0, $idEntreprise) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $ids_employe = $this->getEmployefromDivision ($id_division);
        
        $result = array();
        if(count($ids_employe)==0) {
            $results = $this->evaluationBurnoutDAO->findByIdEntrepriseAndSemaine ($idEntreprise, '0');
        } else {
            $results = $this->evaluationBurnoutDAO->getEvaluationFromEmployesGroup ($idEntreprise, '0', $ids_employe);
        }
        
        return $this->getChartLink ($results, "moyBilanInit", "Somme des bilans initiaux");
    }
    
    private function getEmployefromDivision ($id_division) {
        if ($id_division!=0){
            return $ids_employe = $this->employeDAO->findEmployesFromDivision($id_division);
        } else {
            return array();
        }
    }
    
    /**
     * créer le chart des bilans finaux des employés
     **/
    public function diplayBilanFin ($id_division=0, $idEntreprise) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $results = $this->evaluationBurnoutDAO->findByIdEntrepriseAndSemaine ($idEntreprise, '1');
        return $this->getChartLink ($results, "moyBilanFinal", "Somme des bilans finaux");
    }
    
    /**
     * A partir des evaluations
     * calcul du nombre de courleur (rouge, orange vert) pour chaque indicateur
     * creer le chart dans le dossier tmp.
     */
    private function getChartLink ($results, $title, $legend) {
        if(count ($results) > 0) {
            
            $SEPs = array();
            $SDs = array();
            $SAPs = array();
            $labels = array();
            
            //pour chaque évaluation
            foreach ($results as $result){
                //Je recupere le resultat du MBI
                if($result == false) {
                    $SEPColor = "blue";
                    $SDColor = "blue";
                    $SAPColor = "blue";
                } else {
                
                    $resultatSEP = $result->getQuestion1() + $result->getQuestion2() + $result->getQuestion3() + $result->getQuestion6() + $result->getQuestion8() +$result->getQuestion13() + $result->getQuestion14() + $result->getQuestion16() + $result->getQuestion20();
                    $resultatSD  = $result->getQuestion5() + $result->getQuestion10() + $result->getQuestion11() + $result->getQuestion15() + $result->getQuestion22();
                    $resultatSAP = $result->getQuestion4() + $result->getQuestion7() + $result->getQuestion9() + $result->getQuestion12() + $result->getQuestion17() + $result->getQuestion18() + $result->getQuestion19() + $result->getQuestion21();
                    
                    //Puis je recupere les couleurs de chaque indicateur SEP, SD, SAP
                    if ($resultatSEP <= 17) {
                        $SEPColor = "green";
                    } else if ($resultatSEP <= 29) {
                        $SEPColor = "orange";
                    } else {
                        $SEPColor = "red";
                    }
                    
                    if ($resultatSD <= 5) {
                        $SDColor = "green";
                    } else if ($resultatSD <= 11) {
                        $SDColor = "orange";
                    } else {
                        $SDColor = "red";
                    }
                    
                    if ($resultatSAP > 39) {
                        $SAPColor = "green";
                    } else if ($resultatSAP > 33) {
                        $SAPColor = "orange";
                    } else {
                        $SAPColor = "red";
                    }
                }
                
                //Et je les insere dans un tableau
                array_push($SEPs, $SEPColor);
                array_push($SAPs, $SAPColor);
                array_push($SDs, $SDColor);
            }
            
            //Je donne à chaque couleur/indicateur le nombre d'occurrence
            $greenSEP = 0;
            $orangeSEP = 0;
            $redSEP = 0;
            $blueSEP = 0;
            foreach($SEPs as $value) {
                if ($value == "green") $greenSEP++;
                else if ($value == "orange") $orangeSEP++;
                else if ($value == "red") $redSEP++;
                else if ($value == "blue") $blueSEP++;
            }
            
            $greenSD = 0;
            $orangeSD = 0;
            $redSD = 0;
            $blueSD = 0;
            foreach($SDs as $value) {
                if ($value == "green") $greenSD++;
                else if ($value == "orange") $orangeSD++;
                else if ($value == "red") $redSD++;
                else if ($value == "blue") $blueSD++;
            }
            
            $greenSAP = 0;
            $orangeSAP = 0;
            $redSAP = 0;
            $blueSAP = 0;
            foreach($SAPs as $value) {
                if ($value == "green") $greenSAP++;
                else if ($value == "orange") $orangeSAP++;
                else if ($value == "red") $redSAP++;
                else if ($value == "blue") $blueSAP++;
            }
            
            $data1y=array($greenSEP,$greenSD,$greenSAP);
            $data2y=array($orangeSEP,$orangeSD,$orangeSAP);
            $data3y=array($redSEP,$redSD,$redSAP);
            $data4y=array($blueSEP,$blueSD,$blueSAP);
            
            
            return json_encode(["data1"=>$data1y,"data2"=>$data2y,"data3"=>$data3y,"data4"=>$data4y]);
        }
    }
    
    public function suivitSemaine () {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
    }
    
    
    public function deconnexion () {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        session_destroy();
    }
    
    public function logoEntreprise ($idEntreprise) {
        if (session_status () != PHP_SESSION_ACTIVE) {session_start();}
        $results = $this->employeurDAO->findById($idEntreprise);
        if(count ($results) == 1) {
            header('Content-Type: image');
            echo $results[0]->getLogo();
        }
    }
}