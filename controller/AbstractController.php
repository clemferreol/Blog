<?php

class AbstractController{
  protected $pdo;
  public function __construct($pdo){
    $this->pdo = $pdo;
  }
}