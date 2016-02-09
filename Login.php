<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8" lang="fr">
</head>
<body>

<?php
//On définie logged en false
$_SESSION['logged'] = false;

//On vérifie si l'utilisateur à cliqué et si les variables existent.
if(isset($_POST['valid']) && isset($_POST['MDP'])){
	//Requête sur la BDD, selection de toute la table.
	$query = ('SELECT * FROM users WHERE `mdp_user` = :password AND `pseudo_user` = :pseudo');
	$preparation = $database->prepare($query);
	$encryptPass = sha1($_POST['MDP']);
	$preparation->bindParam('password', $encryptPass, PDO::PARAM_STR);
	$preparation->bindParam('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$preparation->execute();

	//Boucle pour récupérer les donnees de la table.
	while($donnees = $preparation->fetch()){
		$pass = $donnees['mdp_user'];
		$id = $donnees['id_user'];
	}

}
//Vérification de l'existence de Login et si le password de la bdd est égal au password donné.
if(isset($pass) && $pass === sha1($_POST['MDP'])){
	//On définie logged en true pour la vérif sur la page index.php.
	$_SESSION['logged'] = true;
	$_SESSION['id'] = $id;
}else{
	echo("<p>Login :</p><br>");
	echo("<form action='index.php' method='POST'>");
	echo("<input type='text' name='pseudo' placeholder='Pseudo' title='Le champ est vide !' required><br /><br />");
	echo("<input type='password' name='MDP' placeholder='Password' title='Il faut au moins 8 caractères !' required><br><br>");
	echo("<input type='submit' value='Valider' name='valid'></form><br />");
	if(isset($_POST['pseudo']) && isset($_POST['MDP'])){
		echo("<div class='fail'>Le mot de passe ou le pseudonyme est invalide !</div><br />");
	}
	echo("<h2>Vous n'êtes pas encore inscrit ?<br><a href='inscription.html'>Rejoignez-nous !</a></h2>");

	?>
	<script type="text/javascript">
		window.onload = function(){
			document.getElementsByName('pseudo')[0].focus();
		}
	</script>
	<?php
}

?>
<br>
<hr>
<br>
	<ul>
			<ul>
				<a href="#"><li>Articles récents</li></a>
				<a href="#"><li>Actualités</li></a>
				<a href="#"><li>Top 10</li></a></a>
			</ul>
	</ul>

</body>
</html>
