<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/Employe.dao.php");

/**
 * Class Employe
 */
class Employe extends EmployeDAO
{


	
    function updateEmployeIdentifiers ($idEmploye, $email, $password) {
		$request = "UPDATE employe SET email = :email, motDePasse = :password WHERE id = :idEmploye;";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		$sth->bindParam(':idEmploye',$idEmploye);
		$sth->execute();
	}
	
	function updateMailEmploye ($idEmploye, $email) {
	    $request = "UPDATE employe SET email = :email WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':email',$email);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function updatePasswordAndDMdp($idEmploye, $password) {
	    $request = "UPDATE employe SET motDePasse = :password, d_mdp = '1' WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':password',$password);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function updateTentatives ($idEmploye, $nbTentatives, $updateLastTentative) {
	    $request = "";
	    if ($updateLastTentative) {
	       $request = "UPDATE employe SET nb_tentatives = :nb_tentatives, last_tentative = NOW() WHERE id = :idEmploye;";
	    }
	    else {
	        $request = "UPDATE employe SET nb_tentatives = :nb_tentatives WHERE id = :idEmploye;";
	    }
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':nb_tentatives',$nbTentatives);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function resetLastTentativeAndlastConnexion($idEmploye) {
	    $request = "UPDATE employe SET nb_tentatives = '0', last_connexion = NOW() WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function resetLastTentative ($idEmploye) {
	    $request = "UPDATE employe SET last_tentative = NOW() WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function setLastTentative5minutesAgo ($idEmploye) {
	    $request = "UPDATE employe SET last_tentative = (NOW() - INTERVAL 5 MINUTE) WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function setLastTentative1Day ($idEmploye) {
	    $request = "UPDATE employe SET last_tentative = (NOW() - INTERVAL 1 DAY) WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}
	
	function setDMdp ($idEmploye, $d_mdp) {
	    $request = "UPDATE employe SET d_mdp = :d_mdp WHERE id = :idEmploye;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':d_mdp',$d_mdp);
	    $sth->bindParam(':idEmploye',$idEmploye);
	    $sth->execute();
	}

	 public function deleteEmploye ($idEmploye, $idEntreprise)
	{
		$request = "DELETE FROM employe WHERE id = :idEmploye AND idEntreprise = :idEntreprise;";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':idEntreprise',$idEntreprise);
		$sth->bindParam(':idEmploye',$idEmploye);
		$sth->execute();
	}
	
	public function findByEmailAndPassword($email,$password)
	{
		$request="SELECT * FROM employe WHERE email =:email AND motDePasse = :password LIMIT 1";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		return $this->getSelfObjectsPreparedStatement($sth);
	}

	public function findByEmail($email)
	{
		$request="SELECT * FROM employe WHERE email= :email  LIMIT 1";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':email',$email);
		return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	function addEmploye ($email, $motDePasse, $idEntreprise)
	{
		$request = "INSERT INTO employe (email, motDePasse, idEntreprise, d_mdp) VALUES (:email,:motDePasse,:idEntreprise, :d_mdp);";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':motDePasse',$motDePasse);
		$sth->bindParam(':idEntreprise',$idEntreprise);
		$d_mdp = 1;
		$sth->bindParam(':d_mdp', $d_mdp);
		$sth->execute();
		return $this->db->lastInsertId();
	}
	
	function addEmployeCPL ($id, $email, $motDePasse, $idEntreprise)
	{
	    $request = "INSERT INTO employe (id, email, motDePasse, idEntreprise) VALUES (:id, :email,:motDePasse,:idEntreprise);";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    $sth->bindParam(':email',$email);
	    $sth->bindParam(':motDePasse',$motDePasse);
	    $sth->bindParam(':idEntreprise',$idEntreprise);
	    $sth->execute();
	    return $this->db->lastInsertId();
	}
	
	function getEmployesByIdEntreprise ($idEntreprise) {
		$request =  "SELECT * FROM employe WHERE idEntreprise = :idEntreprise;";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':idEntreprise',$idEntreprise);
		return $this->getSelfObjectsPreparedStatement($sth);
	}


	function getEmployeById ($idEmploye) {
		$request =  "SELECT * FROM employe WHERE id = :idEmploye;";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':idEmploye',$idEmploye);
		return $this->getSelfObjectsPreparedStatement($sth);
	}


	public function findEmployesFromDivision($id_division)
	{
		$divisionIds = array();
		array_push($divisionIds, "$id_division");
		$this->findDivisionChildren ($divisionIds, $id_division);
		$divisionIds = array_unique (array_filter($divisionIds));

		$employes = array();
		foreach ($divisionIds as $key => $currentIdDivision) {
		    $request="SELECT employe.id
        				FROM division_employe
        				INNER JOIN employe 
        				    ON employe.id = division_employe.id_employe 
        				WHERE division_employe.id_division = :currentIdDivision;";
			
			$sth = $this->db->prepare($request);
			$sth->bindParam(':currentIdDivision',$currentIdDivision);
			$valToadd =$this->getSelfObjectsPreparedStatement($sth);

			if (count($valToadd)>0){
				$employes = array_merge($employes, $valToadd);
			}

		}

		return $employes;
	}

	public function findDivisionChildren (&$result, $id_division) {
		$childrenIds = $this->getChildrenFromDivision ($id_division);
		if (count($childrenIds) == 0) { //c'est une feuille
			return  $id_division;
		}
		else {
			foreach ($childrenIds as $key => $value) {
				array_push ($result,$id_division);
				array_push ($result, $this->findDivisionChildren($result,$value->getId()));
			}
		}
	}

	public function getChildrenFromDivision ($id_division) {
	    $request = "SELECT id FROM division WHERE id_division = :id_division";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':id_division',$id_division);
		return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	public function getEmployeNoMBIEvaluation ($idEntreprise,$semaine) {
	    $request = "SELECT * FROM employe WHERE idEntreprise = :idEntreprisea AND id NOT IN (
            SELECT idEmploye FROM evaluationburnout WHERE idEntreprise = :idEntreprise AND semaine = :semaine )";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEntreprisea',$idEntreprise);
	    $sth->bindParam(':idEntreprise',$idEntreprise);
	    $sth->bindParam(':semaine',$semaine);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	public function getEmployeNosuivi ($idEntreprise,$semaine) {
	    $request = "SELECT * FROM employe WHERE idEntreprise = :idEntreprisea AND id NOT IN (
            SELECT id FROM suivitemploye WHERE idEntreprise = :idEntreprise AND semaine = :semaine )";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEntreprisea',$idEntreprise);
	    $sth->bindParam(':idEntreprise',$idEntreprise);
	    $sth->bindParam(':semaine',$semaine);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}

	public function getRGPD(){
		if(isset($_SESSION['idEmploye'])){
	$RGPD = $this->db->prepare("SELECT RGPD, mentionsLu FROM employe WHERE id = ?");
	$RGPD->execute(array($_SESSION['idEmploye']));
	$RGPDresult = $RGPD->fetch();
	
	
	if($RGPDresult[0] == NULL || $RGPDresult[0] == 0 || $RGPDresult[1] == NULL || $RGPDresult[1] == 0){
		echo '
			<style>
			.w3-modal{z-index:5;display:none;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}

			.w3-animate-zoom {animation:animatezoom 0.6s}@keyframes animatezoom{from{transform:scale(0)} to{transform:scale(1)}}

			.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:18px;outline:0;width:667px}

			.w3-card-4,.w3-hover-shadow:hover{box-shadow:0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19)}

			.w3-button:hover{color:#000!important;background-color:#ccc!important}

			.w3-display-topright{position:absolute;right:10px;top:0}

			.w3-container,.w3-panel{padding:1em 20px}.w3-panel{margin-top:16px;margin-bottom:16px}

			</style>


<div id="modal" class="w3-modal" >
    <div class="w3-modal-content w3-animate-zoom w3-card-4" style="border-radius:10px;">
      <header class="w3-container"> 
        
        <h3>Confidentialité de vos données</h3>
      </header>
      <div class="w3-container">
        <p>Bienvenue, <br/> Avant de pouvoir acc&eacute;der votre espace, vous devez lire et accepter les conditions g&eacute;n&eacute;rales d\'utilisation. <br/> Pour plus d\'informations, rendez-vous <a href="../includes/mentionsLegales.php">ici</a> </p>
        <br />
    <form method="POST" action="../includes/RGPD.php">
        <div>
            <input type="checkbox" id="lu" name="lu" value="1" >
            <label for="lu">J\'ai lu les CGU</label>
        </div>
        <br />
		<div>
    		<input type="checkbox" id="OUI" name="RGPD" value="1">
    		<label for="OUI">J\'accepte les CGU</label>
		</div>
        <br />
		<input type="submit" class="btn btn-primary" value="envoyer">
	</form>

      </div>
    </div>
  </div>

	
<script>document.getElementById(\'modal\').style.display=\'block\'</script>

		
';
		
		
		
	}
}
	}


	public function insertRGPD($reponseUser,$mentionsLu, $idUser){

		$consentement = $this->db->prepare("UPDATE employe SET RGPD = ?, mentionsLu = ?  WHERE id = ?");

		$consentement->execute(array($reponseUser,$mentionsLu,$idUser));

	}

}


