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

xhr.open("GET", "phpsend.php", true);
xhr.send(null);
}

function submitChat()
{
var xhr = getXMLHttpRequest();
var latitude = encodeURIComponent(document.getElementById('latitude').value);
var longitude = encodeURIComponent(document.getElementById('longitude').value);
var devicename =encodeURIComponent(document.getElementById('devicename').value);




xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('mycard').innerHTML = xhr.responseText; //donnees textuellerecuperee
        }
};

xhr.open("POST", "phpsend.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send("latitude="+latitude+"&longitude="+longitude+"&devicename="+devicename);

}
var timer=setInterval("refreshChat()", 5000); // repete tous les 5 secondes
