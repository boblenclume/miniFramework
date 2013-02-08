<?php
namespace Model\Entities;
use DateTime;



class Location

{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var DateTime
	 */
	private $created_at;
	
	/**
	 * @var String
	 */
	private $comments;
	
	function __construct()
	{
	   $num=func_num_args();
	 
	   switch($num)
	   {
		case 0:
		$this->id = -1;
		$this->name = "";
		$this->created_at = new DateTime(null);
		$this->comments = "";
		break;

	     case 4:
			$this->id=func_get_arg(0);
			$this->name=func_get_arg(1);
			$this->created_at = func_get_arg(2);
			$this->comments = func_get_arg(3);		
		break;

		default : 
			echo "fail construct";
	   }
	}


	/**
	 * @return int
	 */

	public function getId()
	{
		return $this->id;
	}
	
	
/**
	 * @return int
	 */

	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param sring $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @return created_at
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}
	
	/**
	 * @return comments
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * @param sring $name
	 */
	public function setComments($comments)
	{
		$this->comments = $comments;
	}
	

}
