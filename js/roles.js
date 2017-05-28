

document.getElementById("liMenuIniciar").style.display = "initial";
document.getElementById("liMenuRegistro").style.display = "initial"; // none erase it

document.getElementById("liMenuEnviar").style.display = "none";
document.getElementById("liMenuPerfil").style.display = "none";

// Restring access to users depending on which role they are playing



// if they are sender or transporters i will do something

// do something :

// they must not access to sing in

// they must not access to sing up

// they should see their name display on the header with a greeting

// they can log out

var cookie = document.cookie;

if (cookie !== "") {

	// is 'remitentes'?
	if (cookie.search("remitentes") != -1) {
		// do something with this role

		// hide elements
		hideElements();

		// show elements
		showElements();

		document.getElementById("liMenuEnviar").style.display = "initial";

	}

	// otherwise 'transportistas'
	else if (cookie.search("transportistas") != -1){
		// do something with this role

		// hide elements		
		hideElements();

		// show elements
		showElements();
	}

	else {
		alert("You shall not pass");
	}
}




function hideElements () {
	
	// nav
	document.getElementById("liMenuIniciar").style.display = "none";
	document.getElementById("liMenuRegistro").style.display = "none";
}


function showElements () {

	// nav
	document.getElementById("liMenuPerfil").style.display = "initial";
}