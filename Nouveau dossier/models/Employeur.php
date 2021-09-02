<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/Employeur.dao.php");

/**
 * Class Employeur
 */
class Employeur extends EmployeurDAO
{
	function getEmployeurById ($idEmployeur) {
		$request = "SELECT * FROM employeur where id = :idEmployeur;";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':idEmployeur',$idEmployeur);
		return $this->getSelfObjectsPreparedStatement($sth);
	}

	function deleteEmployeurById ($idEmployeur){
		$request = "DELETE FROM employeur where id = :idEmployeur;";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':idEmployeur',$idEmployeur);
		$sth->execute();
	}
	
	function updatePasswordAndDMdp($idEmployeur, $password) {
	    $request = "UPDATE employeur SET motDePasse = :password, d_mdp = '1' WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':password', $password);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function updateBilanAndweek ($bilan, $week, $idEmployeur) {
	    $request = "UPDATE employeur SET bilan = :bilan, semaine = :semaine WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':bilan', $bilan);
	    $sth->bindParam(':semaine',$week);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function setDMdp ($idEmployeur, $d_mdp) {
	    $request = "UPDATE employeur SET d_mdp = :d_mdp WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':d_mdp',$d_mdp);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function updateTentatives ($idEmployeur, $nbTentatives, $updateLastTentative) {
	    $request = "";
	    if ($updateLastTentative) {
	        $request = "UPDATE employeur SET nb_tentatives = :nb_tentatives, last_tentative = NOW() WHERE id = :idEmployeur;";
	    }
	    else {
	        $request = "UPDATE employeur SET nb_tentatives = :nb_tentatives WHERE id = :idEmployeur;";
	    }
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':nb_tentatives',$nbTentatives);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function resetLastTentativeAndlastConnexion($idEmployeur) {
	    $request = "UPDATE employeur SET nb_tentatives = '0', last_connexion = NOW() WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function resetLastTentative ($idEmployeur) {
	    $request = "UPDATE employeur SET last_tentative = NOW() WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function setLastTentative5minutesAgo ($idEmployeur) {
	    $request = "UPDATE employeur SET last_tentative = (NOW() - INTERVAL 5 MINUTE) WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	function setLastTentative1Day ($idEmployeur) {
	    $request = "UPDATE employeur SET last_tentative = (NOW() - INTERVAL 1 DAY) WHERE id = :idEmployeur;";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':idEmployeur',$idEmployeur);
	    $sth->execute();
	}
	
	
	/**
	/* Unique Key Finder
	* @return object
	*/
	public function findByEmailAndPassword($email,$password)
	{
		$request="SELECT * FROM employeur WHERE email= :email AND motDePasse = :password  LIMIT 1";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	public function findAll () {
		$request = "SELECT * FROM employeur;";
		$sth = $this->db->prepare($request);
		return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	public function updateEmployeur ($entreprise, $dirigeant, $siret, $ape, $bilan, $semaine, $email, $password, $id) {
		$request = "UPDATE employeur SET nomEntreprise = :entreprise, dirigeant = :dirigeant, siret = :siret, ape = :ape, bilan = :bilan, semaine = :semaine" 
									. ", email = :email, motDePasse = :password WHERE id = :id";
		
		$sth = $this->db->prepare($request);
		$sth->bindParam(':entreprise',$entreprise);
		$sth->bindParam(':dirigeant',$dirigeant);
		$sth->bindParam(':siret',$siret);
		$sth->bindParam(':ape',$ape);
		$sth->bindParam(':bilan',$bilan);
		$sth->bindParam(':semaine',$semaine);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		$sth->bindParam(':id',$id);
		
		$sth->execute();
	}
	
	public function updateEmployeurNoPassword ($entreprise, $dirigeant, $siret, $ape, $bilan, $semaine, $email, $id) {
	    $request = "UPDATE employeur SET nomEntreprise = :entreprise, dirigeant = :dirigeant, siret = :siret, ape = :ape, bilan = :bilan, semaine = :semaine"
	        . ", email = :email WHERE id = :id";
	        
	        $sth = $this->db->prepare($request);
	        $sth->bindParam(':entreprise',$entreprise);
	        $sth->bindParam(':dirigeant',$dirigeant);
	        $sth->bindParam(':siret',$siret);
	        $sth->bindParam(':ape',$ape);
	        $sth->bindParam(':bilan',$bilan);
	        $sth->bindParam(':semaine',$semaine);
	        $sth->bindParam(':email',$email);
	        $sth->bindParam(':id',$id);
	        
	        $sth->execute();
	}

	public function findByNomEntreprise ($nomEntreprise) {
		$request="SELECT * FROM employeur WHERE nomEntreprise= :nomEntreprise LIMIT 1";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':nomEntreprise',$nomEntreprise);
		return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	public function findByEmail ($email) {
	    $request="SELECT * FROM employeur WHERE email= :email LIMIT 1";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':email',$email);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}
	
	public function creerEmployeur ($entreprise, $dirigeant, $siret, $ape, $adresse, $email, $password) {
		$request = "INSERT INTO employeur(nomEntreprise, dirigeant, siret, APE, adresse, email, motDePasse, entreprise, semaine, bilan) 
                        VALUES (:nomEntreprise, :dirigeant, :siret, :ape, :adresse, :email, :password, '1', '1', '0');";
		$sth = $this->db->prepare($request);
		$sth->bindParam(':nomEntreprise',$entreprise);
		$sth->bindParam(':dirigeant',$dirigeant);
		$sth->bindParam(':siret',$siret);
		$sth->bindParam(':ape',$ape);
		$sth->bindParam(':adresse',$adresse);
		$sth->bindParam(':email',$email);
		$sth->bindParam(':password',$password);
		$sth->execute();
		
		return $this->db->lastInsertId();
	}
	
	public function creerEmployeurCPL ($id, $entreprise, $dirigeant, $siret, $ape, $adresse, $email, $password) {
	    $request = "INSERT INTO employeur(id, nomEntreprise, dirigeant, siret, APE, adresse, email, motDePasse, entreprise, semaine, bilan)
                        VALUES (:id, :nomEntreprise, :dirigeant, :siret, :ape, :adresse, :email, :password, '1', '1', '0');";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    $sth->bindParam(':nomEntreprise',$entreprise);
	    $sth->bindParam(':dirigeant',$dirigeant);
	    $sth->bindParam(':siret',$siret);
	    $sth->bindParam(':ape',$ape);
	    $sth->bindParam(':adresse',$adresse);
	    $sth->bindParam(':email',$email);
	    $sth->bindParam(':password',$password);
	    $sth->execute();
	    
	    return $this->db->lastInsertId();
	}
	
	public function updateLogo ($logo,$idEntreprise) {
		$request = "UPDATE employeur SET logo = '" . addslashes(file_get_contents ($logo)) . "' WHERE id = '" . addslashes($idEntreprise) . "';";	
		$this->db->query($request);
	}

}
