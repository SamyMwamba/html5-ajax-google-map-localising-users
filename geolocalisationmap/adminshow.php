<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Admin Locate you</title>
    <script src="http://maps.google.com/maps/api/js?sensor=false"
            type="text/javascript"></script>
    <link rel="stylesheet" href="css/materialize.css">
    <script type="text/javascript">
        //<![CDATA[

        var customIcons = {
            restaurant: {
                icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            },
            bar: {
                icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
                shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
            }
        };

        function load() {
            <?php include("phpgetter.php")?>
            var map = new google.maps.Map(document.getElementById("map"), {
                center: new google.maps.LatLng(-11.6876026, 27.5026174),
                zoom: 13,
                mapTypeId: 'roadmap'
            });
            var infoWindow = new google.maps.InfoWindow;

            // Change this depending on the name of your PHP file


                var markers =<?php echo getAllmarkers()?>;
                for (var i = 0; i < markers.length; i++) {
                    var station=markers[i];
                    var name = station['devicename'];

                    var point = new google.maps.LatLng(
                        parseFloat(station['latitude']),
                        parseFloat(station['longitude']));

                    var html = "<b>la position de " + name + "</b> <br/>" ;
                    var icon = "img.png";
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        icon: icon.icon,
                        shadow: icon.shadow
                    });
                    bindInfoWindow(marker, map, infoWindow, html);
                }

        }

        function bindInfoWindow(marker, map, infoWindow, html) {
            google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });
        }

        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() {}

        //]]>
    </script>
</head>

<body onload="load()">
<h3>Tracking of devices's compagny</h3>
<div id="map" style="width: 100%;height: 600px"></div>
</body>
</html>
