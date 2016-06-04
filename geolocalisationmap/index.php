<?php
/**
 * Created by PhpStorm.
 * User: int-samy-parseToM3
 * Date: 31/05/2016
 * Time: 08:39
 */
?>
<!doctype html>
    <html>
<head>
    <meta charset="utf-8">

    <meta name="keywords" content="map geolocalisation">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>serveur de geolocalisation</title>
    <link rel="stylesheet" type="text/css" href="css/materialize.css">
    <link rel="stylesheet" type="text/css" href="css/stylemap.css">
    <script src="js/ajaxsender.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>

</head>
<body ononline="getLocation()" onpageshow="getLocation()">
<?php

include("config.php");
?>




<div class="center">
    <?php
    //On affiche un message de bienvenue, si lutilisateur est connecte, on affiche son pseudo
    ?>
 <h1>   Bonjour<?php if(isset($_SESSION['username'])){echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');} ?>,</h1><br />


    <?php
    //Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour voir ses messages et un pour se deconnecter
    if(isset($_SESSION['username']))
    {
        ?>
        <h2>Tu es en ligne</h2>
        <div class="col l12 s12" id="mycard"></div>
        <div class="col l12 s12" id="demo"></div>
        <form id="myform" method="post" action="">

            <input type="text" class="hide" name="longitude" id="longitude">
            <input type="text" class="hide" name="latitude" id="latitude">
            <input type="text" class="hide" name="devicename" value="<?php echo $_SESSION['username'] ?>" id="devicename">


        </form>





        <a class="btn" href="connexion.php">Se d&eacute;connecter</a>




        <p id="demo"></p>

        <script>
            var x = document.getElementById("demo");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
                var latitude=document.getElementById('latitude');
                var longitude=document.getElementById('longitude');
                latitude.value=position.coords.latitude;
                longitude.value=position.coords.longitude;

            }
        </script>
    <?php
    }
    else
    {
//Sinon, on lui donne un lien pour sinscrire et un autre pour se connecter
        ?>


        <a class="btn" href="sign_up.php">Inscription</a><br/>
            <div class="divider"></div>
        <a class="btn" href="connexion.php">Se connecter</a>

    <?php
    }
    ?>
</div>

<script>
    function sendDatatoinput()
    {
        var latitude=document.getElementById('latitude');
        var longitude=document.getElementById('longitude');

    }

</script>
<script>



       getLocation();

       setInterval(submitChat,5000);

</script>
<script type="text/javascript" src="js/ajaxsender.js"></script>
<script src="js/materialize.js"></script>
<script src="js/jquery-2.1.3.min.js"></script>
</body>
</html>