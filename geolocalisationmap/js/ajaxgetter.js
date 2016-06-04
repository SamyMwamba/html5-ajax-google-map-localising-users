/**
 * Created by int-samy-parseToM3 on 02/06/2016.
 */
function getXMLHttpRequest() {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }

    return xhr;
}


function refreshChat()
{
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            document.getElementById('map').innerHTML = xhr.responseText; // donnees textuelle recuperees
        }
    };

    xhr.open("GET", "phpgetter.php", true);
    xhr.send(null);
}

function submitChat()
{
    var xhr = getXMLHttpRequest();
xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            document.getElementById('map').innerHTML = xhr.responseText; //donnees textuellerecuperee
        }
    };


}
var timer=setInterval("refreshChat()", 5000); // repete tous les 5 secondes
