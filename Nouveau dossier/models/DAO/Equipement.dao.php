<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class EquipementDAO
*/
abstract class EquipementDAO extends EntityBase
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
	* @var varchar $nom
	*/
	protected $nom;

	public function getNom() {return $this->nom;}
	public function setNom($nom) {$this->nom=$nom;}

	/**
	* Protected variable
	* @var varchar $quantite
	*/
	protected $quantite;

	public function getQuantite() {return $this->quantite;}
	public function setQuantite($quantite) {$this->quantite=$quantite;}


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
		$this->table='equipement';
		$this->primkeys=['id'];
		$this->fields=['nom','quantite','id_local'];
		$this->sql="SELECT * FROM {$this->table}";
		if($id) $this->read($id);
	}

	/**
	* Column id Finder
	* @return object[]
	*/
	public function findById($id)
	{
	    $request="SELECT * FROM equipement WHERE id= :id  LIMIT 1";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}

}