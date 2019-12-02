'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const capture = document.getElementById("snap");
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
capture.addEventListener("click", function() {
  context.drawImage(video, 0, 0, 640, 480);
  sendImage();
});


//send image to server
function sendImage(){

    var dataURL = canvas.toDataURL();
    //console.log(dataURL);
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            addImageToPage(this.responseText);
            setActionListeners();
        }
    };
    xhttp.open("POST", "/images/dcode", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + dataURL);
}






function addImageToPage(imageURL){
    
    var preview = document.getElementById("preview");

    
    var image = document.createElement("img");
    var saveButton = document.createElement("button");
    var deleteButton = document.createElement("button");
    var imagePreview = document.createElement("div");

    image.src = "/" + imageURL;


    saveButton.type="button";
    saveButton.className = "save-button"
    saveButton.id = imageURL;
    saveButton.innerHTML = "save";

    deleteButton.type = "button";
    deleteButton.className = "delete-button";
    deleteButton.id = imageURL;
    deleteButton.innerHTML = "delete";
  
    imagePreview.className = "image-preview";
  
    imagePreview.appendChild(image);
    imagePreview.appendChild(saveButton);
    imagePreview.appendChild(deleteButton);
    preview.appendChild(imagePreview);
}

function setActionListeners(){

  var saveButtons = document.getElementsByClassName("save-button");
  var deleteButtons = document.getElementsByClassName("delete-button");
  let i = 0;
  let j = 0;

  while(saveButtons[i]){
    saveButtons[i].addEventListener("click", saveImage);
    i++;
  }

  while(deleteButtons[j]){
    deleteButtons[j].addEventListener("click", deleteImage);
    j++;
  }
}

function saveImage(action){
  //console.log("save " + action.srcElement.id);

  var imageName = action.srcElement.id;
  var image = document.getElementById(imageName);
  var imageContainer = image.parentElement;
  var imagePreviewWindow = imageContainer.parentElement;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            imagePreviewWindow.removeChild(imageContainer);
            
        }
    };
    xhttp.open("POST", "/images/save/" + imageName, true);
    
    xhttp.send("image=" + imageName);
}

function deleteImage(action){
  //console.log("delete " + action.srcElement.id);

  var imageName = action.srcElement.id;
  var image = document.getElementById(imageName);
  var imageContainer = image.parentElement;
  var imagePreviewWindow = imageContainer.parentElement;

    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            imagePreviewWindow.removeChild(imageContainer);
        }
    };
    xhttp.open("POST", "/images/delete/" + imageName, true);
    
    xhttp.send("image=" + imageName);
}













