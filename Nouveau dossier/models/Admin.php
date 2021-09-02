<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/Admin.dao.php");

/**
 * Class Admin
 */
class Admin extends AdminDAO
{
  
  public function findById($id) {
      $request="SELECT * FROM admin WHERE id= :id";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':id',$id);
      return $this->getSelfObjectsPreparedStatement($sth);
  }
  
  //TODO ajouter le test
  public function findByEmail ($email) {
      $request="SELECT * FROM admin WHERE email= :email";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':email',$email);
      return $this->getSelfObjectsPreparedStatement($sth);
  }

  
  public function updateAdminIdentifiers ($email, $password) {
      $request = "UPDATE admin SET password = :password WHERE email = :email;";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':email',$email);
      $sth->bindParam(':password',$password);
      
      $sth->execute();
  }
  
  public function updatePasswordAndDMdp ($id, $password) {
      $request = "UPDATE admin SET password = :password, d_mdp = 1 WHERE id = :id;";
      $sth = $this->db->prepare($request);
      
      $sth->bindParam(':password', $password);
      $sth->bindParam(':id', $id);
      
      $sth->execute();
  }
  
  public function setDMdp ($id, $d_mdp) {
      $request = "UPDATE admin SET d_mdp = :d_mdp WHERE id = :id;";
      $sth = $this->db->prepare($request);
      
      $sth->bindParam(':d_mdp', $d_mdp);
      $sth->bindParam(':id', $id);
      
      $sth->execute();
  }
  
  function updateTentatives ($idAdmin, $nbTentatives, $updateLastTentative) {
      $request = "";
      if ($updateLastTentative) {
          $request = "UPDATE admin SET nb_tentatives = :nb_tentatives, last_tentative = NOW() WHERE id = :idAdmin;";
      }
      else {
          $request = "UPDATE admin SET nb_tentatives = :nb_tentatives WHERE id = :idAdmin;";
      }
      $sth = $this->db->prepare($request);
      $sth->bindParam(':nb_tentatives',$nbTentatives);
      $sth->bindParam(':idAdmin',$idAdmin);
      $sth->execute();
  }
  
  function resetLastTentativeAndlastConnexion($idAdmin) {
      $request = "UPDATE admin SET nb_tentatives = '0', last_connexion = NOW() WHERE id = :idAdmin;";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':idAdmin',$idAdmin);
      $sth->execute();
  }
  
  function resetLastTentative ($idAdmin) {
      $request = "UPDATE admin SET last_tentative = NOW() WHERE id = :idAdmin;";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':idAdmin',$idAdmin);
      $sth->execute();
  }
  
  function setLastTentative5minutesAgo ($idAdmin) {
      $request = "UPDATE admin SET last_tentative = (NOW() - INTERVAL 5 MINUTE) WHERE id = :idAdmin;";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':idAdmin',$idAdmin);
      $sth->execute();
  }
  
  function setLastTentative1Day ($idAdmin) {
      $request = "UPDATE admin SET last_tentative = (NOW() - INTERVAL 1 DAY) WHERE id = :idAdmin;";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':idAdmin',$idAdmin);
      $sth->execute();
  }
  
}


