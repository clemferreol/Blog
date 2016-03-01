<?php

class ArticlesController extends AbstractController{

  public function createAction(){
    if(!isset($_POST['titre_article']))
      return json_encode(["error"=>"titre_article missing"]);

    $titre_article = strip_tags($_POST['titre_article']);
    $titre_article = htmlentities($titre_article);
    $titre_article = trim($titre_article);

    $id_article = ArticlesModel::create($this->pdo, $titre_article);

    return json_encode(["message"=>"Créé !",
                        "id_article"=>$id_article,
                        "titre_article" => $titre_article
                        ]);

  }
  public function showAction(){
    return json_encode(["error"=>"not implemented"]);

    $titre_article = strip_tags($_POST['search']);
    $titre_article = htmlentities($titre_article);
    $titre_article = trim($titre_article);

    $id_article = ArticlesModel::create($this->pdo, $titre_article);

    return json_encode(["message"=>"Créé !",
                        "id_article"=>$id_article,
                        "titre_article" => $titre_article
                        ]);
  }
  public function updateAction(){
    return json_encode(["error"=>"not implemented"]);
  }
  public function deleteAction(){
    if(!isset($_POST['id_article']))
      return json_encode(["error"=>"id_article missing"]);
    $id_article = $_POST['id_article'];

    ArticlesModel::delete($this->pdo, $id_article);

    return json_encode(["message"=>"Supprimé !", "id_article"=>$id_article]);
  }

}
