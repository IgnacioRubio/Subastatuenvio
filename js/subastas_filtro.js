
document.getElementById("spanHogar").innerHTML = "0";
document.getElementById("spanVehiculo").innerHTML = "0";
document.getElementById("spanParcial").innerHTML = "0";
document.getElementById("spanCompleta").innerHTML = "0";
document.getElementById("spanAnimales").innerHTML = "0";
document.getElementById("spanIndustrial").innerHTML = "0";
document.getElementById("spanAlimentacion").innerHTML = "0";
document.getElementById("spanOtros").innerHTML = "0";

var form = document.getElementById("form_filtro");

form.addEventListener("reset", resetForm);

function resetForm (e) {

	var event = e || window.event;
	event.preventDefault();

	// values to nothing
	document.getElementById("origen").value = "";
	document.getElementById("destino").value = "";

	// checked to unchechked
	resetCheckedRadio("cat");



}



window.onload = function () {
	
	var ajax = getXMLHTTP();


	ajax.open("POST", "subastas_filtro.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {



			var data = JSON.parse(ajax.responseText);

			document.getElementById("spanHogar").innerHTML = data.numHogar;
			document.getElementById("spanVehiculo").innerHTML = data.numVehiculos;
			document.getElementById("spanParcial").innerHTML = data.numParcial;
			document.getElementById("spanCompleta").innerHTML = data.numCompleta;
			document.getElementById("spanAnimales").innerHTML = data.numAnimales;
			document.getElementById("spanIndustrial").innerHTML = data.numIndustrial;
			document.getElementById("spanAlimentacion").innerHTML = data.numAlimentacion;
			document.getElementById("spanOtros").innerHTML = data.numOtros;

		}
	}

	ajax.setRequestHeader ("Content-Type", "application/x-www-form-urlencoded");
	ajax.send();
}


//
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

// reset radio button checked

function resetCheckedRadio (name) {
	var groupRadio = document.getElementsByName(name);

	var checked = false;
	var i = 0;

	while (i < groupRadio.length) {

		groupRadio[i].checked = false;

		i++;
	}
}
