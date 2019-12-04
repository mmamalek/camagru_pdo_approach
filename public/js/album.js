buttons = document.getElementsByClassName("delete-post");

function updateEventListeners(){
    var i = 0;
    while(buttons[i]){
        buttons.addEventListener("click", test);
    }
}

function test(x){
    console.log("clicked");
}