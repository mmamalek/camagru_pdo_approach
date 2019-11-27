const vid = document.getElementById("video");
const capture = document.getElementById("capture");

function f(){
	let constrains = {audio: false, video: true};

	navigator.mediaDevices.getUserMedia(constrains).then(
		stream => {vid.srcObject = stream}
	).catch(alert("Too sad"));
}
capture.addEventListener("click", x);

function x(){
	alert("message");
}