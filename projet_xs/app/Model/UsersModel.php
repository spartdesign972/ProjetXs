<?php
namespace Model;

use \W\Model\ConnectionModel;

class UsersModel extends \W\Model\UsersModel
{
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

}