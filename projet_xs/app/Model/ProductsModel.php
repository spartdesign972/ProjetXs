<?php
namespace Model;

class ProductsModel extends \W\Model\Model
{

	public function findAllWithCategory($groupBy = '', $orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null)
	{

		$sql = 'SELECT SQL_CALC_FOUND_ROWS p.*, pc.category, pc.name FROM ' . $this->table . ' as p JOIN products_category as pc ON p.category_id = pc.id';
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

	public function lastFoundRows() {
		
		$resultFoundRows = $this->dbh->query('SELECT found_rows()');
		
		return $resultFoundRows->fetchColumn();
	}

}