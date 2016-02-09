<?php

class UserController{

    public function formLoginAction(){
        $view = include("../view/loginform.php");
        return $view;
    }

    public function postLoginAction(){
        if(isset($_POST['login'])){
            return json_encode(true);
        }else{
            return json_encode(false);
        }
    }

}