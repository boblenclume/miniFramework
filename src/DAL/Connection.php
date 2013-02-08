<?php 

namespace DAL;

class Connection extends \PDO
{
	public function executeQuery($query, $parameters = array())
	{
		$stmt = $this->prepare($query);
		
		foreach($parameters as $col => $value){
			$stmt->bindValue(':' . $col, $value);
		}
		print_r($stmt);
		return $stmt->execute();
	}
}