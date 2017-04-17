<?php
namespace Model;

use \W\Model\ConnectionModel;

class UsersModel extends \W\Model\UsersModel
{
	/**
	 * Récupère toutes les lignes de la table
	 * @param $groupBy La colonne en fonction de laquelle grouper
	 * @param $orderBy La colonne en fonction de laquelle trier
	 * @param $orderDir La direction du tri, ASC ou DESC
	 * @param $limit Le nombre maximum de résultat à récupérer
	 * @param $offset La position à partir de laquelle récupérer les résultats
	 * @return array Les données sous forme de tableau multidimensionnel
	 */
	public function findAll($groupBy = '', $orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null)
	{

		$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM ' . $this->table;
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

	/**
	 * Récupère un utilisateur en fonction de son email et de son token
	 * @param string $userEmail L'email d'un utilisateur
	 * @param string $token Le token d'un utilisateur
	 * @return mixed L'utilisateur, ou false si non trouvé
	 */
	public function getUserByEmailAndToken($userEmail, $userToken)
	{
		$app = getApp();

		$sql = 'SELECT id, email, token FROM ' . $this->table . 
			   ' WHERE ' . $app->getConfig('security_email_property') . ' = :email' .
               ' AND token = :token LIMIT 1';

		$dbh = ConnectionModel::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':email', $userEmail);
		$sth->bindValue(':token', $userToken);
		
		if($sth->execute()){
			$foundUser = $sth->fetch();
			if($foundUser){
				return $foundUser;
			}
		}

		return false;
	}

	/**
	 * Récupère tous les rôles définis
	 * @return mixed Les rôles, ou false si non trouvé
	 */
	public function findAllRoles()
	{
		$sql = 'desc ' . $this->table . ' role';

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

	public function lastFoundRows() {
		
		$resultFoundRows = $this->dbh->query('SELECT found_rows()');
		
		return $resultFoundRows->fetchColumn();
	}

}