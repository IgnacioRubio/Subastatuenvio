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