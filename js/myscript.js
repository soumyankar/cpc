function validateForm() {

	var valid = true;
	if (document.getElementById('roomNo').value.length == 0) {

		document.getElementById('ridMissing').style.visibility = 'visible';

		valid = false;

	} else if (isNaN(document.getElementById('roomNo').value)) {
		document.getElementById('ridnotnumber').style.visibility = 'visible';

		valid = false;

	}

	else if (document.getElementById('rPrice').value.length == 0) {
		document.getElementById('rPriceMissing').style.visibility = 'visible';
		valid = false;
	} else if (isNaN(document.getElementById('rPrice').value)) {
		document.getElementById('rPricenotnumber').style.visibility = 'visible';
		valid = false;
	}

	else if (document.getElementById(rStatus).value=="") {
		document.getElementById('rStatusMissing').style.visibility = 'visible';
		valid = false;
	}
	else if (document.getElementById('image').value.length == 0) {
		document.getElementById('ImageMissing').style.visibility = 'visible';

		valid = false;

	} else {
		document.getElementById('ridMissing').style.visibility = 'hidden';
		document.getElementById('ridnotnumber').style.visibility = 'hidden';
		document.getElementById('rPriceMissing').style.visibility = 'hidden';
		document.getElementById('rPricenotnumber').style.visibility = 'hidden';
		document.getElementById('rStatusMissing').style.visibility = 'hidden';
		document.getElementById('locationMissing').style.visibility = 'hidden';

	}

	return valid;
}
