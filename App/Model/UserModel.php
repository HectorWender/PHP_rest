<?php

namespace App\Model;

use App\Dao\UserDao;
use App\Util\Serialize;


class UserModel
{
  private $fileName;
  private $listUser = []; //Lista de todos os usuários

  public function __construct()
  {
    $this->fileName = "../database/user.db";
    $this->load();
    $this->dUser = new UserDao();
  }

  public function getAll()
  {
    return (new Serialize())->serialize($this->listUser);
  }

  public function getById($id)
  {
    foreach ($this->listUser as $item) {
      if ($item->getId() == $id)
        return (new Serialize())->serialize($item);
    }

    return json_encode([]);
  }

  public function create($user)
  {
    $user->setId($this->getLastId());
    $this->checkEmail($user);

    $this->listUser[] = $user;
    $this->save();

    return "created";
  }

  public function update($user)
  {
    $result = "not found";
    $this->checkEmail($user);

    $i = 0;
    foreach ($this->listUser as $item) {
      if ($item->getId() == $user->getId()) {
        $this->listUser[$i] = $user;
        $result = "updated";
      }
      $i++;
    }
    $this->save();

    return $result;
  }

  public function delete($id)
  {
    $result = "not found";

    $i = 0;
    foreach ($this->listUser as $item) {
      if ($item->getId() == $id) {
        unset($this->listUser[$i]);
        $result = "deleted";
        $i++;
      }
    }

    // for ($i = 0; $i < count($this->listUser); $i++) {
    //   if ($this->listUser[$i]->getId() == $id) {
    //     unset($this->listUser[$i]);
    //     $result = "ok";
    //   }
    // }

    $this->listUser = array_filter(array_values($this->listUser));
    $this->save();

    return $result;
  }

  //Internal Methods
  private function save()
  {
    $temp = [];

    foreach ($this->listUser as $lu) {
      $temp[]       = [
        "id"        => $lu->getId(),
        "name"      => $lu->getName(),
        "email"     => $lu->getEmail(),
        "password"  => $lu->getPassword()
      ];

      $fp = fopen($this->fileName, "w");
      fwrite($fp, json_encode($temp));
      fclose($fp);
    }
  }

  private function getLastId()
  {
    $lastId = 0;

    foreach ($this->listUser as $g) {
      if ($g->getId() > $lastId)
        $lastId = $g->getId();
    }

    return $lastId + 1;
  }

  private function load()
  {
    if (!file_exists($this->fileName) || filesize($this->fileName) <= 0)
      return [];

    $fp = fopen($this->fileName, "r");
    $str = fread($fp, filesize($this->fileName));
    fclose($fp);

    $arrayUser = json_decode($str);

    foreach ($arrayUser as $g) {
      $this->listUser[] = new UserDao(
        $g->id,
        $g->name,
        $g->email,
        $g->password
      );
    }
  }

  private function checkEmail($user)
  {
    $i = 0;
    foreach ($this->listUser as $item) {
      if ($item->getEmail() == $user->getEmail()) {
        return ('Email already exists');
      }
      $i++;
    }
  }
}
