<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class LocalDAO
*/
abstract class LocalDAO extends EntityBase
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
	protected $tarif;

	public function getTarif() {return $this->tarif;}
	public function setTarif($tarif) {$this->tarifmail=$tarif;}

	/**
	* Protected variable
	* @var varchar $motDePasse
	*/
	protected $type;

	public function getType() {return $this->type;}
	public function setType($type) {$this->type=$type;}

	/**
	* Protected variable
	* (PK)->Primary key
	* @var int $idEntreprise
	*/
	protected $capacite;

	public function getCpacite() {return $this->capacite;}
	public function setCapacite($capacite) {$this->capacite=$capacite;}

	
	/**
	* Constructor
	* @var mixed $id
	*/
	public function __construct($id=0)
	{
		parent::__construct();
		$this->table='local';
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
	    $request="SELECT * FROM local WHERE id= :id  LIMIT 1";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}

}