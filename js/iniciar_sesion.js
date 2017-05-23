

var form = document.getElementById("form_inicio");

form.addEventListener("submit", signIn);

function signIn (e) {

	var event = e || window.event;
	event.preventDefault();

	document.getElementById("pDanger").hidden = true;

	signInValidation();
}


function signInValidation () {
	var email, pass, role;

	email = document.getElementById("email").value;
	pass = document.getElementById("password").value;
	role = document.getElementById("role").value;

	var ajax = getXMLHTTP();

	ajax.open("POST", "../php/iniciar_sesion.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			if (ajax.responseText) {
				// CREATE COOKIES  WITH EMAIL AND ROLE
				var d = new Date();
				var EXDAYS = 1;

    			d.setTime(d.getTime() + (EXDAYS*24*60*60*1000));
    			var expires = "expires="+ d.toUTCString();

    			setCookie("email", email, EXDAYS);
    			setCookie("role", role, EXDAYS);

				window.location.replace("../index.html");
			}
			else {
				document.getElementById("pDanger").hidden = false;
				document.getElementById("pDanger").innerHTML = "Datos de inicio de sesión incorrectos. Inténtelo de nuevo.";
			}
		}
	}

	ajax.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("email=" + email + "&password=" + pass + "&role=" + role);
}

/// SUPORTER FUNCTIONS

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