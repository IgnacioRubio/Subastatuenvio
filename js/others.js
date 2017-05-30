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