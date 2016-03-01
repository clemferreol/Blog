<?php

class CommentModel{

  public static function getList($pdo){
    $res = $pdo->query("SELECT * FROM commentaires");
    $commentaires = [];
    foreach ($res as $row) {
      $commentaires[] = $row;
    }
    return $commentaires;
  }

  public static function delete($pdo, $id_comm){
    $q = $pdo->prepare('DELETE FROM commentaires WHERE id_comm = :id_comm');
    $q->bindParam('id_comm',$id_comm);
    $reussi = $q->execute();
    return $reussi;
  }

  public static function create($pdo, $contenu_comm){
    $q = $pdo->prepare('INSERT INTO commentaires
                          SET contenu_comm = :contenu_comm');
    $q->bindParam('contenu_comm',$contenu_comm);
    $q->execute();
    $id_comm = $pdo->lastInsertId();
    return $id_comm;
  }
}