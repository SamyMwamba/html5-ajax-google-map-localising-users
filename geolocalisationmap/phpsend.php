<?php
global $count;
		 try
		{
            $bdd = new PDO('mysql:host=localhost;dbname=locateyou', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		 }
		catch(Exception $erreur)
		{
			die("ERREUR : " . $erreur->getMessage());
		}
       if (isset($_POST['longitude'])AND isset($_POST['latitude']) AND isset($_POST['devicename'])) // Si les variables existent
        {
                 if ($_POST['devicename'] != NULL AND $_POST['latitude'] !=NULL AND $_POST['longitude'] !=NULL)

                    {
                      // On utilise les fonctions PHP mysql_real_escape_string et htmlspecialchars pour la sécurité
                        $longitude = htmlspecialchars($_POST['longitude']);
                        $latitude = htmlspecialchars($_POST['latitude']);
                        $devicename=htmlspecialchars($_POST['devicename']);
                      // Ensuite on enregistre le message
                        $sql="UPDATE `users`
                             SET `latitude` = :latitude,
                               `longitude` = :longitude
                                   WHERE  `devicename` = :devicename -- d ";

                        $statement = $bdd->prepare($sql);
                        $statement->bindValue(":latitude", $latitude);
                        $statement->bindValue(":longitude", $longitude);
                        $statement->bindValue(":devicename", $devicename);

                        $count = $statement->execute();

                        $bdd = null;



                    }
                 else { echo "il ya un champ qui est vide";}

        }


try
{
    $bdd = new PDO('mysql:host=localhost;dbname=locateyou', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $erreur)
{
    die("ERREUR : " . $erreur->getMessage());
}

$reponse = $bdd->query("SELECT devicename, longitude,latitude FROM users ");

while($donnes=$reponse->fetch(PDO::FETCH_OBJ))
{


 $count[]=$donnes;
}
$allmarkerjson=json_encode($count);
?>
 <script>
$(function(){
 var marker= <?php echo $allmarkerjson ?>;
 //<![CDATA[


 function load() {
     var mylatlng=new google.maps.LatLng(-11.6876026, 27.5026174);
     var options={
         center: mylatlng,
         zoom: 13,
         mapTypeId: 'roadmap'
         },
         map=new google.maps.Map(document.getElementById('map'));
         //setMarkers(map,marker);



 }

    function setMarker(map,locations)
    {
       for(i=0;i<locations.length;i++)
       {
           var station=locations[i];
           var myLatLng=new google.maps.LatLng(station['latitude'], station['longitude']);
            var infowindow=new google.Infowindow();
           var image='img.png';

           var marker=new google.map.Markers({

               position:myLatLng,
                map:map,
               icon:image,
               title:station['devicename']
           });
        (function(i){
            google.maps.event.addListener(marker."click",function(){

var starion=locations[i];
                infowindow.close();


                infowindow.setContent(

                    "<div id='infowindow'>"
                    +"<p class='text'>"+station['devicename'] +"</p>"

                    +"</div>"

                );
                infowindow.open(map,this);

            ),


        })(i);

       }


    }
        google.maps.event.addDomListener(window,'load',initialize);
)}


</script>





