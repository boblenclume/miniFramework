<?php
namespace Model;
use src\data;
use DAL\Connection;
use Model\Entities\Location;

class LocationFinder implements FinderInterface
{

	private $con;
	
	private $locations;
	
	public function __construct(Connection $con)    {        
		$this->con = $con;
	}

	
	public function findAll()    {        
		$stmt = $this->con->prepare("SELECT * FROM locations ORDER BY id");        
		$stmt->execute();        
		$allLocations = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($allLocations as $loc) {
			$comments = $this->findCommentsForIdLocation($loc['id']);
			$this->locations[$loc['id']] = new Location($loc['id'], 
														$loc['name'], 
														$loc['created_at'],
														$comments);      
		 }
		return $this->locations;
	}
	
	

	public function findOneById($id){
		$stmt = $this->con->prepare("SELECT * FROM locations WHERE id = " . $id);        
		$stmt->execute();        
		$aLocation = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		if (count($aLocation) === 0){
			return null;
		}
		$aLocation = $aLocation[0];
		$comments = self::findCommentsForIdLocation($aLocation['id']);
		$oneLocation = new Location($aLocation['id'], $aLocation['name'],$aLocation['created_at'], $comments);
		return $oneLocation;
	}
	
	public function findCommentsForIdLocation($id)    {   
		$this->comments = null;     
		$stmt = $this->con->prepare("SELECT * FROM comments WHERE locationId = :id ORDER BY id");  
		$stmt->bindValue(':id', $id);
		$stmt->execute();        
		$allComments = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($allComments as $comment) {
			$this->comments[$comment['id']] = new Entities\Comment($comment['id'], 
														$comment['userName'], 
														$comment['body'], 
														$comment['locationId'], 
														$comment['createdAt']);      
		 }
		return $this->comments;
	}

	public function getJson()
	{
		$url = '/var/www/uframework/src/data/locations.json';
		$data = json_decode(file_get_contents($url), true);
		return $data;
	}

	public function setJson($tab)
	{
		$url = '/var/www/uframework/src/data/locations.json';
		file_put_contents($url, json_encode($tab)) or die("erreur setJson");
	}

	
}
