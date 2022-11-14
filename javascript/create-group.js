const form = document.querySelector(".login form");
usersList = document.querySelector(".users .users-list");
createBtn = document.querySelector(".button");
nameField = document.querySelector(".name");
errortxt = document.querySelector(".error-text");

users = [];

function addFriend(id, btn){
    btn.style.display = "none";
    removeBtn = btn.nextElementSibling;
    removeBtn.style.display = "block";
    users.push(id);
    console.log(users);
}

function removeFriend(id, btn){
    btn.style.display = "none";
    addBtn = btn.previousElementSibling;
    addBtn.style.display = "block";

    var index = users.indexOf(id);
    if (index > -1) {
       users.splice(index, 1);
    }
    console.log(users);
}

createBtn.onclick = ()=>{

    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    
    if(!((nameField.value.match(lowerCaseLetters) || nameField.value.match(upperCaseLetters)))){
        errortxt.style.display = "block";
        errortxt.innerHTML = "Name must contain letters only!";
    }else if(users.length == 0){
        errortxt.style.display = "block";
        errortxt.innerHTML = "Select atleast 1 user";
    }
    else{
    //Ajax
        let xhr = new XMLHttpRequest(); //creating XML object
        xhr.open("POST", "php/create-group.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
                if(xhr.status == 200){
                    let data = xhr.response;
                    if(data == "success"){
                        alert("Group Created Successfully")
                        location.href = "users.php";
                    }else{
                        errortxt.textContent = data;
                        errortxt.style.display = "block";
                    }
                }
            }
        }
        // Sending data from Ajax to php
        let formData = new FormData(form); //creating new formData
        formData.append("users", users);
        xhr.send(formData); // sending form data to php
    }
}