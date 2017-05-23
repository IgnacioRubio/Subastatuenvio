

var btnSalir = document.getElementById("btnSalir");

btnSalir.addEventListener("click", cerrarSesion);


function cerrarSesion () {
	document.cookie = "email=; expires= Thu, 01 Jan 1970 00:00:00 UTC; path=/";

	document.cookie = "role=; expires= Thu, 01 Jan 1970 00:00:00 UTC; path=/";

	window.location.replace("../index.html");
}