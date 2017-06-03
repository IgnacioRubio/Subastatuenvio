

var form = document.getElementById("form_puja");

form.addEventListener("submit", createBid);

function createBid (e) {

	var event = e || window.event;
	event.preventDefault();

	document.getElementById("pMessSucc").hidden = true;
	document.getElementById("pMess").hidden = true;

	creationBid();
}


function creationBid () {
	var email, puja, id_subasta;

	email = getCookie("email");
	puja = document.getElementById("puja").value;
	id_subasta = document.getElementById("id_subasta").value;

	var ajax = getXMLHTTP();

	ajax.open("POST", "crear_puja.php");


	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			if (ajax.responseText) {

				document.getElementById("pMessSucc").hidden = false;
				document.getElementById("pMessSucc").innerHTML = "La puja se creó con éxito. Si no ve la puja, refresque la página.";
			}
			else {
				document.getElementById("pMess").hidden = false;
				document.getElementById("pMess").innerHTML = "No se pudo crear la puja.";
			}
		}
	}

	ajax.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("email=" + email + "&puja=" + puja + "&id_subasta=" + id_subasta);
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

// a function to get a Cookie

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}