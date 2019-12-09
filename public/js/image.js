//var comment = document.getElementsById("like-cb");
var like = document.getElementById("like-button");
var comment = document.getElementById("comment-text");
var send = document.getElementById("send-comment");
var deletePost = document.getElementById("delete-post");


send.addEventListener("click", sendComment);
like.addEventListener("click", sendLike);
deletePost.addEventListener("click", deleteImage);

function sendComment(x){
   

    var srcURI = x.srcElement.baseURI;

   
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            window.getComments(x);
        }
    };
    xhttp.open("POST", "/images/comment", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + srcURI + "&comment=" + comment.value);
    comment.value = "";

    
}

function getComments(x){

    var srcURI = x.srcElement.baseURI;
    var commentsBlock = document.getElementById("comments-block");
   
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            commentsBlock.innerHTML = this.responseText;
         
        }
    };
    xhttp.open("POST", "/images/getComments", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + srcURI);

    
}

function sendLike(x){
    var srcURI = x.srcElement.baseURI;

   
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           
            var likes = document.getElementById("likes-count");
            likes.innerHTML = this.responseText;
            updateLikeButton(x);
        }
    };
    xhttp.open("POST", "/images/like", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + srcURI);

    
}

function updateLikeButton(x){
    var srcURI = x.srcElement.baseURI;
    var like = document.getElementById("like-button");
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
            if (this.responseText){
                like.innerHTML = "unlike";
            } else {
                like.innerHTML = "like";
            }
        }
    };
    xhttp.open("POST", "/images/liked", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + srcURI);

    
}

function updateComments(x){
    var comments = getComments(x);
    var commentsBlock = document.getElementById("comments-block");
  
}

function deleteImage(x){

    var srcURI = x.srcElement.baseURI;
    var pageContents = document.getElementsByClassName("contents");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         
            pageContents[0].innerHTML = "Post deleted";
            
        }
    };
    xhttp.open("POST", "/images/deletePost/" + deletePost.className, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + srcURI);

}