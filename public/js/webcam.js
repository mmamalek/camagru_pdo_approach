'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {
    width: 640, height: 480
  }
};

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');
snap.addEventListener("click", function() {
	context.drawImage(video, 0, 0, 640, 480);
});


//send image to server
function sendImage(){

    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML = this.responseText;
            console.log(this.responseText);
        }
    };
    xhttp.open("POST", "/images/dcode", true);
    xhttp.setRequestHeader("Content-type", "image/png");
    xhttp.send("image=" + dataURL);
}





function saveImage3(){

    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
    
    const form = document.createElement("form");
    form.action = "/images/dcode";
    form.method = "POST";

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "image";
    input.value = dataURL;

    var stickerURL = document.getElementById("sticker1").src;

    var sticker = document.createElement("input");
    sticker.type = "hidden";
    sticker.name = "sticker";
    sticker.value = stickerURL;

    form.appendChild(sticker);
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();

}

var save = document.getElementById("save");

save.addEventListener("click", sendImage);





// function saveImage2(){

//     var dataURL = canvas.toDataURL();
//     //console.log(dataURL);
    
//     const form = document.createElement("form");
//     form.action = "/images/dcode2";
//     form.method = "POST";

//     var input = document.createElement("input");
//     input.type = "hidden";
//     input.name = "image";
//     input.value = dataURL;

//     var stickerURL = document.getElementById("sticker1").src;

//     var sticker = document.createElement("input");
//     sticker.type = "hidden";
//     sticker.name = "sticker";
//     sticker.value = stickerURL;

//     form.appendChild(sticker);
//     form.appendChild(input);
//     document.body.appendChild(form);
//     form.submit();

// }

// var save = document.getElementById("save");

// save.addEventListener("click", saveImage2);