<?php 
namespace App\Dao;

class Drink{
  private $id;
  private $name;
  private $ml;
  
  public function __construct($id, $name = 'water', $ml)
  {
		$this->id       = $id;
    $this->name     = $name;
    $this->ml       = $ml;
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

  public function setMl($ml)
  {
		$this->ml = $ml;
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
  
  public function getMl()
  {
		return $this->ml;
	}
}
