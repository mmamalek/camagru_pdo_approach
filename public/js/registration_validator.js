const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");
const registrationForm = document.getElementById("form");

var green = "#333333";
var red = "#ff0000";

// Handle form
registrationForm.addEventListener('submit', function (event) {


	if (validateUsername() && validateEmail() && validatePassword() && validateConfirmPassword()) {

	} else{
		event.preventDefault();
	}
});

// Validators
function validateUsername() {
	if (empty(username)) {
		return false;
	}
	if (!meetLength(password, 2, 25)){
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
	if (!containsCharacters(email, 5)){
		return false;
	}
	return true;
}

function validatePassword() {
	if (empty(password)){
		return false;
	}
	if (!meetLength(password, 8, 100)){
		return false;
	}
	// check password against our character set
	// 1- a
	// 2- a 1
	// 3- A a 1
	// 4- A a 1 @
	if (!containsCharacters(password,3)){
		return false;
	}
	return true;
}
function validateConfirmPassword() {
	
	if (password.className !== 'valid') {
		setInvalid(password2, 'Password must be valid');
		return false;
	}
	// If they match
	if (password.value !== password2.value) {
		setInvalid(password2, 'Passwords must match');
		return false;
	} else {
		setValid(password2);
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

function containsCharacters(field, code) {
	var regEx;
	switch (code) {
		case 1:
			// letters
			regEx = /(?=.*[a-zA-Z])/;
			return matchWithRegEx(regEx, field, 'Must contain at least one letter');
		case 2:
			// letter and numbers
			regEx = /(?=.*\d)(?=.*[a-zA-Z])/;
			return matchWithRegEx(
				regEx,
				field,
				'Must contain at least one letter and one number'
			);
		case 3:
			// uppercase, lowercase and number
			regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
			return matchWithRegEx(
				regEx,
				field,
				'Must contain at least one uppercase, one lowercase letter and one number'
			);
		case 4:
			// uppercase, lowercase, number and special char
			regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/;
			return matchWithRegEx(
				regEx,
				field,
				'Must contain at least one uppercase, one lowercase letter, one number and one special character'
			);
		case 5:
			// Email pattern
			regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return matchWithRegEx(regEx, field, 'Must be a valid email address');
		default:
			return false;
	}
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
