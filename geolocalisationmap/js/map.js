/**
 * Created by int-samy-parseToM3 on 01/06/2016.
 */
$(function(){


    var map;
    function initialise() {
        var latlng = new google.maps.LatLng(-11.6876026,131.044922);
        var myOptions = {
            zoom: 4,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            disableDefaultUI: true
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);


    }





});