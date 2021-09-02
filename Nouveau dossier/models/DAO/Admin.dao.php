<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class AdminDAO
*/
abstract class AdminDAO extends EntityBase
{
    
   /**
     * Protected variable
     * (PK)->Primary key
     * @var int $id
     */
   protected $id;
    
   public function getId() {return $this->id;}
    
   public function setId($id) {$this->id=$id;}

  /**
   * Protected variable
   * @var varchar $email
   */
  protected $email;

  public function getEmail() {return $this->email;}

  public function setEmail($email) {$this->email=$email;}

  /**
   * Protected variable
   * @var varchar $password
   */
  protected $password;

  public function getMotDePasse() {return $this->password;}

  public function setMotDePasse($password) {$this->password=$password;}
  
  
  protected $d_mdp;
  
  public function getDMP() {return $this->d_mdp;}
  public function setDMP($d_mdp) {$this->d_mp=$d_mdp;}
  
  protected $nb_tentatives;
  
  public function getNbTentatives() {return $this->nb_tentatives;}
  public function setNbTentatives($nb_tentatives) {$this->nb_tentatives=$nb_tentatives;}
  
  
  protected $last_tentative;
  
  public function getLastTentative() {return $this->last_tentative;}
  public function setLastTentative($last_tentative) {$this->last_tentative=$last_tentative;}
  
  
  protected $last_connexion;
  
  public function getLastConnexion() {return $this->last_connexion;}
  public function setLastConnexion($last_connexion) {$this->last_connexion=$last_connexion;}

  /**
   * Constructor
   * @var mixed $id
   */
  public function __construct($id=0)
  {
    parent::__construct();
    $this->table='admin';
    $this->primkeys=['id'];
    $this->fields=['email','password','d_mdp','nb_tentatives','last_tentative','last_connexion'];
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!========== //
  // EXTEND THIS DAO CLASS WITH YOUR OWN CLASS CONTAINING YOUR BUSINESS LOGIC //
  //  BECAUSE THIS CLASS FILE WILL BE OVERWRITTEN UPON EACH NEW PHPDAO BUILD  //
  // ======================================================================== //
}

