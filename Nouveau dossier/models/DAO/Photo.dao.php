<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/DAO.php");

/**
 * Class PhotoDAO
*/
abstract class PhotoDAO extends EntityBase
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
	* @var varchar $photo
	*/
	protected $photo;

	public function getPhoto() {return $this->photo;}
	public function setPhoto($photo) {$this->photo=$photo;}

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
		$this->table='photo';
		$this->primkeys=['id'];
		$this->fields=['id_local','photo'];
		$this->sql="SELECT * FROM {$this->table}";
		if($id) $this->read($id);
	}

	/**
	* Column id Finder
	* @return object[]
	*/
	public function findById($id)
	{
	    $request="SELECT * FROM photo WHERE id= :id  LIMIT 1";
	    $sth = $this->db->prepare($request);
	    $sth->bindParam(':id',$id);
	    return $this->getSelfObjectsPreparedStatement($sth);
	}

}