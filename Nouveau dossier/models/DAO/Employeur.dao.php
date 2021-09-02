<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class EmployeurDAO
*/
abstract class EmployeurDAO extends EntityBase
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
   * (PK)->Primary key
   * @var varchar $nomEntreprise
   */
  public $nomEntreprise;

  public function getNomEntreprise() {return $this->nomEntreprise;}
  public function setNomEntreprise($nomEntreprise) {$this->nomEntreprise=$nomEntreprise;}

  /**
   * Protected variable
   * @var varchar $dirigeant
   */
  protected $dirigeant;

  public function getDirigeant() {return $this->dirigeant;}
  public function setDirigeant($dirigeant) {$this->dirigeant=$dirigeant;}

  /**
   * Protected variable
   * @var varchar $siret
   */
  protected $siret;

  public function getSiret() {return $this->siret;}
  public function setSiret($siret) {$this->siret=$siret;}

  /**
   * Protected variable
   * @var varchar $APE
   */
  protected $APE;

  public function getAPE() {return $this->APE;}
  public function setAPE($APE) {$this->APE=$APE;}

  /**
   * Protected variable
   * @var varchar $adresse
   */
  protected $adresse;

  public function getAdresse() {return $this->adresse;}
  public function setAdresse($adresse) {$this->adresse=$adresse;}

  /**
   * Protected variable
   * (UQ)->Unique key
   * @var varchar $email
   */
  protected $email;

  public function getEmail() {return $this->email;}
  public function setEmail($email) {$this->email=$email;}

  /**
   * Protected variable
   * @var varchar $motDePasse
   */
  protected $motDePasse;

  public function getMotDePasse() {return $this->motDePasse;}
  public function setMotDePasse($motDePasse) {$this->motDePasse=$motDePasse;}

  /**
   * Protected variable
   * @var tinyint $entreprise
   */
  protected $entreprise;

  public function getEntreprise() {return $this->entreprise;}
  public function setEntreprise($entreprise) {$this->entreprise=$entreprise;}

  /**
   * Protected variable
   * @var int $semaine
   */
  protected $semaine;

  public function getSemaine() {return $this->semaine;}
  public function setSemaine($semaine) {$this->semaine=$semaine;}

  /**
   * Protected variable
   * @var longblob $logo
   */
  protected $logo;

  public function getLogo() {return $this->logo;}
  public function setLogo($logo) {$this->logo=$logo;}

  /**
   * Protected variable
   * @var int $bilan
   */
  protected $bilan;

  public function getBilan() {return $this->bilan;}
  public function setBilan($bilan) {$this->bilan=$bilan;}
  
  
  
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
    $this->table='employeur';
    $this->primkeys=['id','nomEntreprise'];
    $this->fields=['dirigeant','siret','APE','adresse','email','motDePasse','entreprise','semaine','logo','bilan','d_mdp','nb_tentatives','last_tentative','last_connexion'];
    $this->sql="SELECT * FROM {$this->table}";
    if($id) $this->read($id);
  }

  /**
   * Column id Finder
   * @return object[]
   */
  public function findById($id)
  {
      $request="SELECT * FROM employeur WHERE id= :id  LIMIT 1";
      $sth = $this->db->prepare($request);
      $sth->bindParam(':id',$id);
      return $this->getSelfObjectsPreparedStatement($sth);
  }

  // ==========!!!DO NOT PUT YOUR OWN CODE (BUSINESS LOGIC) HERE!!!========== //
  // EXTEND THIS DAO CLASS WITH YOUR OWN CLASS CONTAINING YOUR BUSINESS LOGIC //
  //  BECAUSE THIS CLASS FILE WILL BE OVERWRITTEN UPON EACH NEW PHPDAO BUILD  //
  // ======================================================================== //
}

