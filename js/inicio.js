
var numRemitentes = null;
var numTransportistas = null;
var numSubastas = null;



window.onload = function () {
	numRemitentes = document.getElementById("numRemitentes");
	numTransportistas = document.getElementById("numTransportistas");
	numSubastas = document.getElementById("numSubastas");

	updateData();
}

function updateData () {

	var ajax = getXMLHTTP();

	ajax.open("POST", "php/inicio.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {

			var data = JSON.parse(ajax.responseText);

			numRemitentes.innerHTML = data.numRemit;
			numTransportistas.innerHTML = data.numTrans;
			numSubastas.innerHTML = data.numSubas;
		}
	}

	ajax.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
	ajax.send();

}

/// SUPPORTER FUNCTIONS

function getXMLHTTP () {
	var obj = null;

	try {
		// obj ActiveX for IE 5.0
		obj = new ActiveXObject("Msxml2.XMLHTTP");

	} catch (e) {

		try {
			// obj ActiveX for IE 6.0
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e2) {
			obj = null;
		}
		
	}

	if (!obj && typeof XMLHttpRequest != "undefined") {
		obj = new XMLHttpRequest();
	}
	
	return obj;
}


// a function to set a Cookie

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}