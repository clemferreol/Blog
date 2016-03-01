<?php
spl_autoload_register(function($class_name){

  if(substr($class_name, -10) == "Controller"){
    $class_file = "../controller/"
                   .$class_name
                   .".php";  
  }

  if(substr($class_name, -5) == "Model"){
    $class_file = "../model/"
                   .$class_name
                   .".php";  
  }

  
  if(!file_exists($class_file)){
    throw new Exception("Cannot find ".$class_file);
  }
  require_once($class_file);
});