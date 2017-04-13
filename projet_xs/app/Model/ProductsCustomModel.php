<?php

namespace Model;

class ProductsCustomModel extends \W\Model\Model
{
	public function findAllWithAuthorAndLikes($orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null)
	{

		$sql = 'SELECT p.*, u.username FROM products_custom as p JOIN users as u ON p.user_id = u.id WHERE p.public = true';
		if (!empty($orderBy)){

			//sécurisation des paramètres, pour éviter les injections SQL
			if(!preg_match('#^[a-zA-Z0-9_$]+$#', $orderBy)){
				die('Error: invalid orderBy param');
			}
			$orderDir = strtoupper($orderDir);
			if($orderDir != 'ASC' && $orderDir != 'DESC'){
				die('Error: invalid orderDir param');
			}
			if ($limit && !is_int($limit)){
				die('Error: invalid limit param');
			}
			if ($offset && !is_int($offset)){
				die('Error: invalid offset param');
			}

			$sql .= ' ORDER BY '.$orderBy.' '.$orderDir;
		}
        if($limit){
            $sql .= ' LIMIT '.$limit;
            if($offset){
                $sql .= ' OFFSET '.$offset;
            }
        }
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Récupère une ligne de la table en fonction d'un identifiant
	 * @param  integer Identifiant
	 * @return mixed Les données sous forme de tableau associatif
	 */
	public function findUserDesign($id)
	{

		$sql = 'SELECT P.*, U.username FROM '. $this->table .' as P LEFT JOIN users as U ON P.user_id = U.id WHERE P.user_id = :id';
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
		$sql = 'SELECT P.*, U.username FROM '.$this->table.' as P RIGHT JOIN users as U ON U.id = P.user_id WHERE P.public = 1 '. $order;
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll();
	}

}