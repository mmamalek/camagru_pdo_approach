//var comment = document.getElementsById("like-cb");
var like = document.getElementById("like");
var comment = document.getElementById("comment-text");
var send = document.getElementById("send-comment");

send.addEventListener("click", sendComment);
like.addEventListener("click", sendLike);

function sendComment(){
    console.log(comment.value);
}

function sendLike(x){
    var srcURI = x.srcElement.baseURI;

   
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("POST", "/images/like", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image=" + srcURI);

    
}