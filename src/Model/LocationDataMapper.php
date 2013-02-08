<?php

namespace Model;
use DAL\Connection;
use Model\Entities\Location;

class LocationDataMapper
{
	
	private $con;
	
	
	public function __construct(Connection $con){
		$this->con = $con;
	}
	
	public function persist(Location $location){
		if ($location->getId() != -1){
			$request = "UPDATE locations SET name = :name WHERE id = :id";
			$code = $this->con->executeQuery($request, array("id" => $location->getId(), "name" => $location->getName()));

		}
		else{	
			$request = "INSERT INTO locations (id,name,created_at) VALUES ( null,:name, :createdAt)";
			$code = $this->con->executeQuery($request, array("name" => $location->getName(), "createdAt" => $location->getCreatedAt()->format('Y-m-d H:i:s')));
		}
		return $code;
	}
	
	public function remove(Location $location){
		$request = "DELETE FROM locations WHERE id = :id";
		echo "<br/> Request : " . $request;
		
		$stmt = $this->con->executeQuery($request, array("id" => $location->getId()));  
		$location->setId(null);      
	}
	
	
	
//	public function create($name){
//		if ($name === null)
//		{
//			$name = "echec";
//		}
//		$loc = array_pop($this->locations);
//		array_push($this->locations, $loc);
//		$nb = $loc['id'] + 1;
//		array_push($this->locations, array("id" => $nb, "name" => $name));
//		$this->setJson($this->locations);
//		return $nb;
//	}
//
//	public function update($id, $name){
//		$this->locations[$id] = array("id" => $id, "name" => $name);
//		$this->setJson($this->locations);
//	}
//
//	public function delete($id){
//		unset($this->locations[$id]);
//		$this->setJson($this->locations);
//	}
}