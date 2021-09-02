<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class EmployeDAO
*/
abstract class EmployeDAO extends EntityBase
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
	* (PK)->Primary key
	* @var int $idEntreprise
	*/
	protected $idEntreprise;

	public function getIdEntreprise() {return $this->idEntreprise;}
	public function setIdEntreprise($idEntreprise) {$this->idEntreprise=$idEntreprise;}

	/**
	* Protected variable
	* @var tinyint $entreprise
	*/
	protected $entreprise;

	public function getEntreprise() {return $this->entreprise;}
	public function setEntreprise($entreprise) {$this->entreprise=$entreprise;}
	
	
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
	
	protected $rgpd;
	
	public function getRGPD() {return $this->rgpd;}
	public function setRGPD($rgpd) {$this->rgpd=$rgpd;}
	
	protected $mentionsLu;
	
	public function getMentionsLu() {return $this->mentionsLu;}
	public function setMentionsLu($mentionsLu) {$this->mentionsLu=$mentionsLu;}

	/**
	* Constructor
	* @var mixed $id
	*/
	public function __construct($id=0)
	{
		parent::__construct();
		$this->table='employe';
		$this->primkeys=['id','idEntreprise'];
		$this->fields=['email','motDePasse','entreprise','d_mdp','nb_tentatives','last_tentative','last_connexion' ,'RGPD', 'mentionsLu'];
		$this->sql="SELECT * FROM {$this->table}";
		if($id) $this->read($id);
	}

	/**
	* Column id Finder
	* @return object[]
	*/
	public function findById($id)
	{
	    $request="SELECT * FROM employe WHERE id= :id  LIMIT 1";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}

}