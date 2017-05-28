

var form = document.getElementById("form_enviar");

form.addEventListener("submit", sending);

function sending (e) {

	var event = e || window.event;

	document.getElementById("pDanger").hidden = true;


	var cookie = document.cookie;

	if (cookie !== "") {

		// is 'remitentes'?
		if (cookie.search("remitentes") != -1) {

			var imagen = document.getElementById("imagen");

			var pattImagen = /.+(\.png|\.gif|\.jpeg|\.jpg)/;

			if (imagen.value != "") {

				if (!pattImagen.test(imagen.value)) {
					event.preventDefault();
					document.getElementById("pDanger").hidden = false;
					document.getElementById("pDanger").innerHTML = "El formato de la imagen debe ser PNG, JPG, GIF o JPEG.";
				}
			}
		}

		else {
			event.preventDefault();
			alert("You should not be here, there's nothing you can do here with you currently role.");
		}
	}
}




/// SUPPORTER FUNCTIONS


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


// get radio button checked value

function getValueRadio (name) {
	var groupRadio = document.getElementsByName(name);

	var checked = false;
	var i = 0;

	while (!checked && i < groupRadio.length) {

		if (groupRadio[i].checked) {
			checked = true;
		}

		i++;
	}

	if (checked) {
		return groupRadio[i-1].value;
	}

	else {
		return -1;
	}

}