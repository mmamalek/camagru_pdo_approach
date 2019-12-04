//var comment = document.getElementsById("like-cb");
var like = document.getElementById("like-button");
var comment = document.getElementById("comment-text");
var send = document.getElementById("send-comment");
var deletePost = document.getElementById("delete-post");

console.log(deletePost);
send.addEventListener("click", sendComment);
like.addEventListener("click", sendLike);
deletePost.addEventListener("click", deleteImage);

function sendComment(x){
    console.log(comment.value);

    var srcURI = x.srcElement.baseURI;

   
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
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
            console.log(this.responseText);
            commentsBlock.innerHTML = this.responseText;
            //return (this.responseText);
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
            //console.log(this.responseText);
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
            console.log(this.responseText);
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
    console.log(comments);
}

function deleteImage(x){
    console.log("delete me");
}