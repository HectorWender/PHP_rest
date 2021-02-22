<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Dao\UserDao;

class UserController
{

  private $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel();
  }

  //POST - Create new user
  public function create($data = null)
  {
    //id creation not secure
    isset($data['id']) && !empty($data['id']) ? null : $data['id'] = random_int(100, 500);

    $user = $this->convertType($data);
    $result = $this->validateEmpty($user);

    if ($result != "") {
      return json_encode(["result" => $result]);
    }

    return json_encode(["result" => $this->userModel->create($user)]);
  }

  //PUT - Update user
  public function update($id = 0, $data = null)
  {
    $user = $this->convertType($data);
    $user->setId($id);

    $result = $this->validateEmpty($user, true);

    if ($result != "") {
      return json_encode(["result" => $result]);
    }

    return json_encode(["result" => $this->userModel->update($user)]);
  }

  //DELETE an user
  public function delete($id = 0)
  {
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if ($id <= 0) {
      return json_encode(["result" => "invalid id"]);
    }

    $result =  $this->userModel->delete($id);

    return  json_encode(["result" => $result]);
  }

  //GET by id
  public function listById($id = 0)
  {
    // return json_encode(["result" => "getById - $id"]);
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if ($id <= 0) {
      return json_encode(["result" => "invalid id"]);
    }

    return $this->userModel->getById($id);
  }

  //GET all users
  function listAll()
  {
    // return json_encode(["result" => "getAll"]);
    return $this->userModel->getAll();
  }

  private function convertType($data)
  {
    return new UserDao(
      null,
      isset($data['name']) ? $data['name'] : null,
      isset($data['email']) ? $data['email'] : null,
      isset($data['password']) ? $data['password'] : null
    );
  }

  private function validateEmpty($user, $update = false)
  {
    if ($update && empty(strlen($user->getId())))
      return "invalid id";

    if (empty(strlen($user->getName())))
      return "invalid Name";

    if (empty(strlen($user->getEmail())))
      return "invalid Email";

    if (empty(strlen($user->getPassword())))
      return "invalid Password";

    return "";
  }
}
