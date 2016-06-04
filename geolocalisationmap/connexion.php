<!DOCTYPE html>
<?php/**
 * Created by PhpStorm.
 * User: int-samy-parseToM3
 * Date: 14/02/2016
 * Time: 11:41
 */


?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Geolocalisation System</title>

	<link rel="stylesheet" href="css/materialize.css">
	<meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">

	<!--  Android 5 Chrome Color-->
	<meta name="theme-color" content="#EE6E73">
</head>
<body onload="Materialize.toast('Tu es sur le serveur de geolocalisation', 4000)">


<?php

include("config.php");
?>
<div class="container">
	<div class="row">
		<div class="center">
<?php
//Si lutilisateur est connecte, on le deconecte
global $form;
if(isset($_SESSION['username']))
{
	//On le deconecte en supprimant simplement les sessions username et userid
	unset($_SESSION['username'], $_SESSION['userid']);
?>
<div class="message"><h3>Vous avez bien &eacute;t&eacute; d&eacute;connect&eacute;.</h3><br />
<a class="btn red waves-green" href="<?php echo $url_home; ?>">Accueil</a></div>
<?php
}
else
{
	$ousername = '';
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['username']))
	{
		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysql_real_escape_string(stripslashes($_POST['username']));

		}
		else
		{
			$username = mysql_real_escape_string($_POST['username']);

		}
		//On recupere le mot de passe de lutilisateur
		$req = $bdd->query('select id,devicename from users where devicename="'.$username.'"');
		while($dn=$req->fetch()){


			//On le compare a celui quil a entre et on verifie si le membre existe
			if($dn['devicename']==$username and $req->rowCount()>0)
			{
				//Si le mot de passe es bon, on ne vas pas afficher le formulaire
				$form = false;
				//On enregistre son pseudo dans la session username et son identifiant dans la session userid
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['userid'] = $dn['id'];
				?>
				<div class="message"><h3>Vous avez bien &eacute;t&eacute; connect&eacute;.</h3><br />
					<a class="btn" href="<?php echo $url_home; ?>">Accueil</a></div>
			<?php
			}
			else
			{
				//Sinon, on indique que la combinaison nest pas bonne
				$form = true;
				$message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
			}
		}

	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//On affiche un message sil y a lieu
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
	//On affiche le formulaire
?>
<div class="content">
    <form action="connexion.php" method="post">
       <h3> Veuillez entrer vos identifiants pour vous connecter:</h3><br />
        <div class="center">
			<form id="myform" method="post" action="">
				<label for="username">Enter a username</label>
				<input type="text" name="username" id="username">

				<input type="text" class="hide" name="longitude" id="longitude">
				<input type="text" class="hide" name="latitude" id="latitude">
				<input type="submit" value="connect" class="btn green">

			</form>
		</div>
    </form>
</div>
<?php
	}
}
?>
		<div class="foot"><a href="<?php echo $url_home; ?>">Retour &agrave; l'accueil</a> - <a href="http://www.supportduweb.com/">Support du Web</a></div>
</div>
		</div>
	</div>
<script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="js/materialize.js"></script>
<script>


</script>
</body>
</html>