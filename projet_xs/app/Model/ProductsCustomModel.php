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


	/**
	 * 
	 * @param  string choix de tri
	 * @return mixed Les données sous forme de tableau associatif
	 */
	public function findDesign($order){
		$sql = 'SELECT P.*, U.username FROM '.$this->table.' as P RIGHT JOIN users as U ON U.id = P.user_id WHERE P.public = 1'. $order;
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll();
	}





}