<?php

namespace Model;

use src\DAL;

class DataMapperTest extends \TestCase
{
	public function testPersistInsertNewLocation()
    {
       $mock = $this->getMock('MockConnection');
       $mock->expects($this->once())
       		->method('executeQuery')
       		->will($this->returnArgument(0));
    }
}