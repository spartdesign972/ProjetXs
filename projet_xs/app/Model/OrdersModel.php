<?php
namespace Model;


class OrdersModel extends MasterModel
{
/**
	 * Récupère une ligne de la table en fonction d'un identifiant
	 * @param  integer Identifiant
	 * @return mixed Les données sous forme de tableau associatif
	 */
	public function findUserOrder($id)
	{

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :id ';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id, \PDO::PARAM_INT);
		$sth->execute();
		

		return $sth->fetchAll();
	}

	public function findAllWithUsers($groupBy = '', $orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null)
	{

		$sql = 'SELECT SQL_CALC_FOUND_ROWS o.*, u.lastname, u.firstname, u.username, u.email FROM orders as o JOIN users as u ON o.user_id = u.id';
		if (!empty($groupBy)){
			//sécurisation des paramètres, pour éviter les injections SQL
			if(!preg_match('#^[a-zA-Z0-9_$]+$#', $groupBy)){
				die('Error: invalid orderBy param');
			}
			$sql .= ' GROUP BY '.$groupBy;
		}
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

	public function findAllStatus()
	{
		$sql = 'desc ' . $this->table . ' status';

		$sth = $this->dbh->prepare($sql);
		if($sth->execute()){

			$row = $sth->fetch();

			preg_match('/enum\((.*)\)$/', $row['Type'], $matches);
			$vals = explode(',', $matches[1]);

			$trimmedvals = [];			
			foreach($vals as $key => $value) {
				$value = trim($value, "'");
				$trimmedvals[] = $value;
			}
			return $trimmedvals;
		}

		return false;
	}

}