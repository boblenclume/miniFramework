<?php

/**
 */

namespace Model\Entities;
class Comment

{
	private $id;

	private $userName;

	private $body;

	private $createdAt;
	
	private $locationId;


	/**
	*
	* @param id int
	* @param userName String
	* @param createdAt DateTime|NULL
	*/
	public function __construct($id, $userName, $body, $locationId, $createdAt = NULL)
	{
		$this->id = $id;
		$this->userName = $userName;
		$this->body = $body;
		$this->locationId = $locationId;
		$this->createdAt = $createdAt;
	}

	/** 
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/** 
	 * @return String
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * @param String
	 */
	public function setUserName($userName)
	{
		$this->userName = $userName;
	}

	/** 
	 * @return String
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @param String
	 */
	public function setBody($body)
	{
		$this->body = $body;
	}

	/**
	 * @return DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
}
