<?php
namespace Model;
use DAL\Connection;

class CommentFinder implements FinderInterface
{

	private $con;
	
	private $comments;
	
	public function __construct(Connection $con)    {        
		$this->con = $con;
	}
	
	public function findAll()    {        
		$stmt = $this->con->prepare("SELECT * FROM comments ORDER BY id");        
		$stmt->execute();        
		$allComments = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($allComments as $comment) {
			$this->comments[$comment['id']] = new Comment($comment['id'], 
														$comment['userName'], 
														$comment['body'], 
														$comment['locationId'], 
														$comment['createdAt']);      
		 }
		return $this->comments;
	}
		
	public function findOneById($id){
		return $id;
	}	
	

}
