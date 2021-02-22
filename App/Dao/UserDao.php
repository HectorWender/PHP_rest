<?php

namespace App\Dao;

class UserDao
{

	private $id;
	private $name;
	private $email;
	private $password;

	//Constructor
	public function __construct($id = 0, $name = '', $email = '', $password = '')
	{
		$this->id       = $id;
		$this->name     = $name;
		$this->email    = $email;
		$this->password = $password;
	}

	//Setters
	public function setId($id)
	{
		$this->id = $id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	//Getter
	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}
}
