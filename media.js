const vid = document.getElementById("video");

function f(){
	let constrains = {audio: false, video: true};

	navigator.mediaDevices.getUserMedia(constrains).then(
		stream => {vid.srcObject = stream}
	).catch(alert("Too sad"));
}

window.addEventListener('load', f, false);
