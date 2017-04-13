<?php
namespace Model;

class LikesModel extends \W\Model\Model
{

	public function findLikeByUserAndProd($user_id, $prod_id)
	{
		if (!is_numeric($user_id) || !is_numeric($prod_id)){
			return false;
		}

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id AND product_custom_id = :product_custom_id LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':user_id', $user_id);
		$sth->bindValue(':product_custom_id', $prod_id);
		$sth->execute();

		return $sth->fetch();
	}

}