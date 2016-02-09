<?php
include('connexion.php');
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$errors = array();
$isFormGood = true;

if(!empty($_POST))
{

  $query = ('SELECT * FROM users WHERE `mail_user` = :mail AND `pseudo_user` = :pseudo');
	$preparation = $database->prepare($query);
	$preparation->bindParam('mail', $_POST['mail'], PDO::PARAM_STR);
	$preparation->bindParam('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$preparation->execute();

	//Boucle pour récupérer les donnees de la table.
	while($donnees = $preparation->fetch()){
		$mail_verif = $donnees['mail_user'];
		$pseudo_verif = $donnees['pseudo_user'];
	}
  // Verification Nom
  if(!isset($_POST['nom']) || is_numeric($_POST['nom']) || (strlen($_POST['nom']) < 1))
  {
      $errors['nom'] = 'Votre nom doit contenir au moins un caractère';
      $isFormGood = false;
  }
  // Verification Prénom
  if(!isset($_POST['prenom']) || is_numeric($_POST['prenom']) || (strlen($_POST['prenom']) < 1))
  {
      $errors['prenom'] = 'Votre prénom doit contenir au moins un caractère';
      $isFormGood = false;
  }
  // Verification Pseudo
  if(!isset($_POST['pseudo']) || (strlen($_POST['pseudo']) < 4) || is_numeric($_POST['pseudo']))
  {
      if(!isset($pseudo_verif)){
        $errors['pseudo'] = 'Le pseudo est déjà utilisé !';
      }else{
        $errors['pseudo'] = 'Veuillez saisir un pseudo de 4 caractères minimum';
      }
      $isFormGood = false;
  }
  // Vérification Mail
  if(!isset($_POST['mail']) || (strlen($_POST['mail']) < 4))
  {
      if(!isset($mail_verif)){
        $errors['mail'] = 'Le mail est déjà utilisé !';
      }else{
        $errors['mail'] = 'Veuillez saisir un mail de 4 caractères minimum';
      }
      $isFormGood = false;
  }
  // Vérficiation password
  if(!isset($_POST['pwd']) || strlen($_POST['pwd']) < 6)
  {
      $errors['pwd'] = 'Veuillez saisir un mot de passe de 6 caractères minimum';
      $isFormGood = false;
  }
  // Vérification password = Password 2
  if(!isset($_POST['pwd2']) || ($_POST['pwd2'] != $_POST['pwd']))
  {
      $errors['pwd2'] = 'Veuillez saisir une vérification similaire au mot de passe';
      $isFormGood = false;
  }


  if(!$isFormGood)
  {
      http_response_code(400);
      echo(json_encode(array('success'=>false, "errors"=>$errors)));
  }
  else
  {
      unset($_POST['pwd2']);
      $query = ('INSERT INTO `users`(`nom_user`, `prenom_user`, `pseudo_user`, `mdp_user`, `mail_user`) VALUES (:nom, :prenom, :pseudo, :mdp, :mail)');
    	$preparation = $database->prepare($query);
    	$encryptPass = sha1($_POST['pwd']);
    	$preparation->bindParam('nom', $_POST['nom'], PDO::PARAM_STR);
    	$preparation->bindParam('prenom', $_POST['prenom'], PDO::PARAM_STR);
      $preparation->bindParam('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
      $preparation->bindParam('mdp', $encryptPass, PDO::PARAM_STR);
      $preparation->bindParam('mail', $_POST['mail'], PDO::PARAM_STR);
    	$preparation->execute();
      echo(json_encode(array('success'=>true, "user"=>$_POST)));
      //Faire la requête mysql pour insérer un nouvel utilisateur
      // Dire que c'est good.
      // Envoyer mail confirmation user données.
  }
}
else
{
    http_response_code(400);
    echo(json_encode(array('success'=>false, "errors"=>array('Missing form data'))));
}
