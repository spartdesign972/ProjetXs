<?php

namespace Model;

class ProductsCustomModel extends \W\Model\Model
{
/**
	 * Récupère une ligne de la table en fonction d'un identifiant
	 * @param  integer Identifiant
	 * @return mixed Les données sous forme de tableau associatif
	 */
	public function findUserDesign($id)
	{

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :id ';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id, \PDO::PARAM_INT);
		$sth->execute();
		

		return $sth->fetchAll();
	}


}