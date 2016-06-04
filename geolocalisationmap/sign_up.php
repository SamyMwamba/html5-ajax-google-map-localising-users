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


	<link rel="stylesheet" href="css/materialize.css">

	<meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">

	<!--  Android 5 Chrome Color-->
	<meta name="theme-color" content="#EE6E73">
	<!-- CSS-->
	<link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body onload="Materialize.toast('Vous etes entrain de vous inscrire', 4000)">

<div class="container">
	<div class="row">
		<div class="center">
<?php
include("config.php");

			//On verifie si lemail est valide
		if(isset($_POST['username'])){
				//On echape les variables pour pouvoir les mettre dans une requette SQL
				$username = mysql_real_escape_string($_POST['username']);

				//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
				$etat = $bdd->query('select id from users where devicename="'.$username.'"');
				$dn=$etat->rowCount();
				if($dn==0)
				{
					//On recupere le nombre dutilisateurs pour donner un identifiant a lutilisateur actuel
					$etat2 = $bdd->query('select id from users');
					$dn2=$etat2->rowCount();
					$id = $dn2+1;
					//On enregistre les informations dans la base de donnee
					if($bdd->query('insert into users(devicename) values ("'.$username.'")'))
					{
						//Si ca a fonctionne, on naffiche pas le formulaire
						$form = false;
?>
<div class="message"><h3>Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.</h3><br />
<a href="connexion.php" class="btn">Se connecter</a></div>
<?php
					}
					else
					{
						//Sinon on dit quil y a eu une erreur
						$form = true;
						$message = 'Une erreur est survenue lors de l\'inscription.';
					}
				}
				else
				{
					//Sinon, on dit que le pseudo voulu est deja pris
					$form = true;
					$message = 'Un autre utilisateur utilise d&eacute;j&agrave; le nom d\'utilisateur que vous d&eacute;sirez utiliser.';
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
		echo '<div class="message"><h5 style="color:#c70000">' .$message.'</h5></div>';
	}
	//On affiche le formulaire
?>
<div class="container">
	<div class="row">
    <form action="sign_up.php" method="post" class="center">
       <h3> Veuillez remplir ce formulaire pour vous inscrire:</h3><br />
        <div class="col l8 s12 center">
            <label for="username">Nom d'utilisateur</label><input type="text" id="username" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
            <input class="btn  red " type="submit" value="Envoyer" />
		</div>
    </form>
		</div>
</div>

<?php
}
?>

			<div class="foot"><a href="<?php echo $url_home; ?>">Retour &agrave; l'accueil</a> - <a href="http://www.supportduweb.com/">Support du Web</a></div>
	</div>
		</div>
	</div>
<script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="js/materialize.js"></script>
<script>

	$(".button-collapse").sideNav();
</script>
</body>
</html>