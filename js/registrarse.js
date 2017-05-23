

var form = document.getElementById("form_registro");

form.addEventListener("submit", signUp);

function signUp (e) {

	document.getElementById("divSuccess").hidden = true;
	document.getElementById("divDanger").hidden = true;

	var event = e || window.event;
	event.preventDefault();

	signUpValidation();
}


function signUpValidation () {
	var nombre, apellidos, email, pass, role;

	nombre = document.getElementById("nombre").value;
	apellidos = document.getElementById("apellidos").value;
	email = document.getElementById("email").value;
	pass = document.getElementById("password").value;
	role = document.getElementById("role").value;

	var ajax = getXMLHTTP();

	ajax.open("POST", "../php/registrarse.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			if (ajax.responseText) {
				document.getElementById("divSuccess").hidden = false;
				document.getElementById("divDanger").hidden = true;
				document.getElementById("divSuccess").innerHTML = "Cuenta registrada con éxito. Puede <a href='iniciar_sesion.html'>iniciar sesión</a> ahora con los datos proporcionados.";
			}
			else {
				document.getElementById("divSuccess").hidden = true;
				document.getElementById("divDanger").hidden = false;
				document.getElementById("divDanger").innerHTML = "Datos de inicio de sesión no son válidos.";
			}
		}
	}

	ajax.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("nombre=" + nombre + "&apellidos=" + apellidos + "&email=" + email + "&password=" + pass + "&role=" + role);
}



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