<?php

class CommentController extends AbstractController{
  public function formAction(){
      if(!isset($_POST['pseudo_user']))
      return json_encode(["error"=>"pseudo_user missing"]);

    $pseudo_user = strip_tags($_POST['pseudo_user']);
    $pseudo_user = htmlentities($pseudo_user);
    $pseudo_user = trim($pseudo_user);
      
    $contenu_comm = strip_tags($_POST['contenu_comm']);
    $contenu_comm = htmlentities($contenu_comm);
    $contenu_comm = trim($contenu_comm);

    $id_user = CommentModel::getList($this->pdo, $pseudo_user, $contenu_comm);

    return json_encode(["message"=>"Créé !",
                        "id_user"=>$id_user,
                        "pseudo_user" => $pseudo_user,
                        "contenu_comm"=>$contenu_comm
                        ]);

      
  
  
  }
  public function createAction(){
      if(!isset($_POST['contenu_comm']))
      return json_encode(["error"=>"contenu_comm missing"]);

    $contenu_comm = strip_tags($_POST['contenu_comm']);
    $contenu_comm = htmlentities($contenu_comm);
    $contenu_comm = trim($contenu_comm);
      
    
    $pseudo_user = strip_tags($_POST['pseudo_user']);
    $pseudo_user = htmlentities($pseudo_user);
    $pseudo_user = trim($pseudo_user);

    $id_comm = CommentModel::create($this->pdo, $contenu_comm, $pseudo_user);

    return json_encode(["message"=>"Créé !",
                        "id_comm"=>$id_comm,
                        "contenu_comm" => $contenu_comm,
                        "pseudo_user" => $pseudo_user
                        ]);

  
  }
  public function deleteAction(){
      
      if(!isset($_POST['id_comm']))
      return json_encode(["error"=>"id_comm missing"]);
    $id_comm = $_POST['id_comm'];

    CommentModel::delete($this->pdo, $id_comm);

    return json_encode(["message"=>"Supprimé !", "id_comm"=>$id_comm]);
  }

  
  
  }
}