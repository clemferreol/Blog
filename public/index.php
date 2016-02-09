<?php

$controller_name = "user";
$action_name = "formlogin";

$class_name = ucfirst($controller_name."Controller");

$controller_file = "../controller/".$class_name.".php";

//CHECK CLASS EXIST
if(!file_exists($controller_file)){
    $controller_file = "../Controller/errorController.php";
    $class_name = "ErrorController";
    $action_name = "notFoundAction";
}

require_once($controller_file);
$controller = new $class_name();

//CHECK METHOD EXIST
$action = strtolower($action_name)."Action";
if(!method_exists($controller,$action)){
    $controller_file = "../Controller/errorController.php";
    require_once($controller_file);
    $action = "notFoundAction";
    $controller = new errorController();
}
$result = $controller->$action();

echo $result;
