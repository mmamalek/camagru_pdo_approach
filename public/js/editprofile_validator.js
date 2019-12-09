const username = document.getElementById("username");
const email = document.getElementById("email");
const editProfileForm = document.getElementById("form");

var green = "#333333";
var red = "#ff0000";

// Handle form
editProfileForm.addEventListener('submit', function (event) {


	if (validateUsername() && validateEmail()) {

	} else{
		event.preventDefault();
	}
});

// Validators
function validateUsername() {
	if (empty(username)) {
		return false;
	}
	if (!onlyLettersAndNumbers(username)){
		return false;
	}
	return true;
}

function validateEmail() {
	if (empty(email)){
		return false;
	}
	if (!containsCharacters(email)){
		return false;
	}
	return true;
}

// Utility functions
function empty(field) {
	if (isEmpty(field.value.trim())) {
		// set field invalid
		setInvalid(field, `${field.name} must not be empty`);
		return true;
	} else {
		// set field valid
		setValid(field);
		return false;
	}
}

function isEmpty(value) {
	if (value === '') return true;
	return false;
}
function setInvalid(field, message) {
	field.className = 'invalid';
	field.nextElementSibling.innerHTML = message;
	field.nextElementSibling.style.color = red;
}
function setValid(field) {
	field.className = 'valid';
	field.nextElementSibling.innerHTML = '';
	field.nextElementSibling.style.color = green;
}
function onlyLettersAndNumbers(field) {
	if (/^[a-zA-Z][a-zA-Z0-9]+$/.test(field.value)) {
		setValid(field);
		return true;
	} else {
		setInvalid(field, `${field.name} must contain only letters and digits`);
		return false;
	}
}
function meetLength(field, minLength, maxLength) {
	if (field.value.length >= minLength && field.value.length < maxLength) {
		setValid(field);
		return true;
	} else if (field.value.length < minLength) {
		setInvalid(
			field,
			`${field.name} must be at least ${minLength} characters long`
		);
		return false;
	} else {
		setInvalid(
			field,
			`${field.name} must be shorter than ${maxLength} characters`
		);
		return false;
	}
}

function containsCharacters(field) {
	var regEx;
			// Email pattern
    regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return matchWithRegEx(regEx, field, 'Must be a valid email address');
}

function matchWithRegEx(regEx, field, message) {
	if (field.value.match(regEx)) {
		setValid(field);
		return true;
	} else {
		setInvalid(field, message);
		return false;
	}
}