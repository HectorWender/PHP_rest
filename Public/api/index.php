<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, 
// Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../../vendor/autoload.php");

use App\Controller\UserController;

$controller = null;
$id         = null; //Param
$method     = $_SERVER["REQUEST_METHOD"]; //POST, PUT, DELETE and GET
$uri        = $_SERVER["REQUEST_URI"];
$data       = null;

//recebe os valores por requisição
parse_str(file_get_contents('php://input'), $data);

// echo json_encode(["tipo" => $method, "data" => $data, "uri" => $uri]);

//TRATA A URI
//Quebra a url e resta só a controller e o id
$unsetCount = 2;
$explode = explode("/", $uri);


for ($i = 0; $i < $unsetCount; $i++) {
  unset($explode[$i]);
}

$explode = array_filter(array_values($explode));

isset($explode[0]) ? $controller = $explode[0] : null;
isset($explode[1]) ? $id         = $explode[1] : null;
// var_dump($explode, $controller, $id);

$userCtl = new UserController();

switch ($method) {
  case 'GET':
    if ($controller != null && $id == null) {
      echo $userCtl->listAll();
    } elseif ($controller != null && $id != null) {
      echo $userCtl->listById($id);
    } else {
      echo json_encode(["result" => "invalid"]);
    }
    break;

  case 'POST':
    if ($controller != null && $id == null) {
      echo $userCtl->create($data);
      // echo json_encode(["result" => "create"]);
    } else {
      echo json_encode(["result" => "invalid"]);
    }
    break;

  case 'PUT':
    if ($controller != null && $id != null) {
      echo $userCtl->update($id, $data);
      // echo json_encode(["result" => "update"]);
    } else {
      echo json_encode(["result" => "invalid"]);
    }
    break;

  case 'DELETE':
    if ($controller != null && $id != null) {
      echo $userCtl->delete($id);
    } else {
      echo json_encode(["result" => "invalid"]);
    }
    break;

  default:
    echo json_encode(["result" => "invalid resquest. Send a GET, POST, PUT or DELETE request"]);
    break;
}
