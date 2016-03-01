<?php
require_once("../utils/init.php");

$called_url = $_SERVER['REQUEST_URI'];
$url_composants = explode("/",$called_url,4);

if(isset($url_composants[1])){
  if(strlen($url_composants[1]) ==0){
    $controller_name = "index";
  }else{
    $controller_name = $url_composants[1];
  }

}else{
  $controller_name = "index";
}
if(isset($url_composants[2])){
  $action_name = $url_composants[2];
}else{
  $action_name = "index";
}

$class_name = ucfirst($controller_name)
                   ."Controller";

global $pdo;
try{
  $controller = new $class_name($pdo);
}catch(Exception $e){
  $controller = new ErrorController($pdo);
}

$action = strtolower($action_name)."Action";
if(!method_exists($controller,$action)){
  $controller = new ErrorController($pdo);
  $action = "e404";
}

$result = $controller->$action();

if(is_string($result)){
  echo $result;
}
