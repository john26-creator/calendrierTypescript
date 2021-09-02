<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class DisponibiliteDAO
*/
abstract class DisponibiliteDAO extends EntityBase
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
	* @var DateTime $email
	*/
	protected $dateDebut;

	public function getDateDebut() {return $this->dateDebut;}
	public function setDateDebut($dateDebut) {$this->dateDebut=$dateDebut;}

	/**
	* Protected variable
	* @var varchar $motDePasse
	*/
	protected $dateFin;

	public function getDatefin() {return $this->dateFin;}
	public function setDateFin($dateFin) {$this->dateFin=$dateFin;}

	/**
	* Protected variable
	* @var varchar $id_local
	*/
	protected $id_local;

	public function getMotIdLocal() {return $this->id_local;}
	public function setMotIdLocal($id_local) {$this->id_local=$id_local;}
	

	/**
	* Constructor
	* @var mixed $id
	*/
	public function __construct($id=0)
	{
		parent::__construct();
		$this->table='disponibilite';
		$this->primkeys=['id'];
		$this->fields=['tarif','type','capacite'];
		$this->sql="SELECT * FROM {$this->table}";
		if($id) $this->read($id);
	}

	/**
	* Column id Finder
	* @return object[]
	*/
	public function findById($id)
	{
	    $request="SELECT * FROM disponibilite WHERE id= :id  LIMIT 1";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}

}