<?php
function getAllmarkers()
{
    global $count;
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=locateyou', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $erreur) {
        die("ERREUR : " . $erreur->getMessage());
    }

    $reponse = $bdd->query("SELECT devicename, longitude,latitude FROM users ");

    while ($donnes = $reponse->fetch(PDO::FETCH_OBJ)) {


        $count[] = $donnes;
    }
    $allmarkerjson = json_encode($count);
return $allmarkerjson;
}
?>




