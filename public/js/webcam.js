// 'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const capture = document.getElementById("capture-image");


const constraints = {
  audio: false,
  video: {
    width: 640, height: 480
  }
};





// Access webcam
async function init() {
  console.log("initializing camera");
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);


     handleSuccess(stream)

  
  } catch (e) {
    
  }
}

//Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
  video.onplay();
}

//Load init
//init();

// Draw image
var context = canvas.getContext('2d');
capture.addEventListener("click", function() {
  context.drawImage(video, 0, 0, 640, 480);
  sendImage();
});


document.getElementById("sticker1").addEventListener("click", function() {

  stickersLivePreview();
});
document.getElementById("sticker2").addEventListener("click", function() {
  document.getElementById("s2");
  stickersLivePreview();
});
document.getElementById("sticker3").addEventListener("click", function() {
  document.getElementById("s3");
  stickersLivePreview();
});

function stickersLivePreview()
{
  
  var stickers = document.getElementsByName("sticker");
  var stc = document.getElementsByClassName("st");
    var i = 0;
    while(stickers[i]){
      if (stickers[i].checked){
       // document.getElementById("sticker" + i  + "-preview").style.visibility = "visible";
      //  document.getElementById("sticker" + i  + "-preview").firstChild.src= "/sticker/sticker"+i+".png";
        stc[i].style.border = "solid purple 3px";
      }
      else{
      //  document.getElementById("sticker" + i + "-preview").style.visibility = "hidden";
      //  document.getElementById("sticker" + i + "-preview").firstChild.src = "";
        stc[i].style.border = "none";
      }
      i++;
    }
}

//send image to server
function sendImage(){

    var dataURL = canvas.toDataURL();
    var stickers = document.getElementsByName("sticker");
    //console.log(dataURL);
    var selectedStickers = '';
    var i = 0;
    while(stickers[i]){
      if (stickers[i].checked){
        selectedStickers = selectedStickers + "," + i;
      }
      i++;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            addImageToPage(this.responseText);
            setActionListeners();
        }
    };
    xhttp.open("POST", "/images/dcode", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + dataURL + "&stickers=" + selectedStickers);
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
//    preview.appendChild(imagePreview);
    preview.prepend(imagePreview);
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


var uploadImage = document.getElementById("upload-image");
var img = document.getElementById("upoaded-image-preview");

uploadImage.addEventListener("change", uploadUploadedImage);
uploadImage.style.display = "none";

function uploadUploadedImage(x){
  var formData = new FormData();

  var file = this.files[0];
  if (file){

    formData.append("file", file);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            displayUploadedImage(this.responseText);
        }
    };
    xhttp.open("POST", "/images/dcodeUploads", true);
    
    xhttp.send(formData);
  }
}

function displayUploadedImage(image){
  var imgsrc = "/" + image;
 img.src = imgsrc;
}

var startCamera = document.getElementById("start-camera-button");
startCamera.addEventListener("click", function (){
  img.src = "";
  init();

});

document.getElementById("choose-image").addEventListener("click", function (){
  video.srcObject = null;
  video.width = 0;
  video.height = 0;
  img.style.maxHeight = "100%";
  uploadImage.click();
  console.log("world");

});







