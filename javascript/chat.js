const form = document.querySelector(".typing-area");
inputField = form.querySelector(".message");
userStatus = document.querySelector(".details p");
userID = document.querySelector(".details input").value;
file = form.querySelector(".file");
mediaBtn = form.querySelector(".fa-paperclip");
sendBtn = form.querySelector("button");
chatBox = document.querySelector(".chat-box");
var timer = null;

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from submitting
}

mediaBtn.onclick = ()=>{
    file.click();
}

file.onchange = ()=>{
    inputField.value = file.files[0].name;
}

if(userID != ""){
    setInterval(()=>{
        let xhr = new XMLHttpRequest(); //creating XML object
        xhr.open("POST", "php/get-status.php?userID="+userID, true);
        xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
                if(xhr.status == 200){
                    let data = xhr.response;
                    userStatus.innerText = data;
                }
            }
        }
        let formData = new FormData(form); //creating new formData
        xhr.send(formData); // sending form data to php
    }, 1000);
}

inputField.onkeyup = ()=>{
    //Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/is-typing.php?status=1", true);
    xhr.onload = ()=>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
            }
        }
    }
    xhr.send();
}

function changeToActive() {
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/is-typing.php?status=0", true);
    xhr.onload = ()=>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
            }
        }
    }
    xhr.send();
}

inputField.onkeydown = ()=>{
    clearTimeout(timer);
    timer = setTimeout(changeToActive, 1200)
}

sendBtn.onclick = ()=>{
     //Ajax
     let xhr = new XMLHttpRequest(); //creating XML object
     xhr.open("POST", "php/insert-chat.php", true);
     xhr.onload = ()=>{
         if(xhr.readyState == XMLHttpRequest.DONE){
             if(xhr.status == 200){
                let data = xhr.response;
                if(data == ''){
                    inputField.value = "";
                    if(!chatBox.classList.contains("active")){
                        scrollToBottom();
                    }
                }else{
                    alert(data);
                }
                
             }
         }
     }
     // Sending data from Ajax to php
     let formData = new FormData(form); //creating new formData
     xhr.send(formData); // sending form data to php
}

setInterval(()=>{
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form); //creating new formData
    xhr.send(formData); // sending form data to php
}, 200);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

