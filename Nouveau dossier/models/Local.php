<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/models/DAO/Local.dao.php");

/**
 * Class Employe
 */
class Local extends LocalDAO
{

	public function findAll()
	{
		$query = "SELECT * FROM local";
		$sth = $this->db->prepare($query);
		return $this->getSelfObjectsPreparedStatement($sth);
	}
}
