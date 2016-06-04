<?php
//On demarre les sessions

    session_start();

/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que l'
espace membre puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
try
{
$bdd=new PDO('mysql:host=localhost;dbname=locateyou','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $ex)
{
die('Erreur'.$ex->getMessage());
}

//Email du webmaster
$mail_webmaster = 'samymwamba@example.com';



/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';

//Nom du design
$design = 'default';
?>