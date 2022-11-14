const form = document.querySelector(".signup form");
const fnameField = document.getElementById("fname");
const lnameField = document.getElementById("lname");
updateBtn = form.querySelector(".button input");
errortxt = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from submitting
}

updateBtn.onclick = ()=>{
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    
    if(!((fnameField.value.match(lowerCaseLetters) || fnameField.value.match(upperCaseLetters)) && (lnameField.value.match(lowerCaseLetters) || lnameField.value.match(upperCaseLetters)))){
        errortxt.style.display = "block";
        errortxt.innerHTML = "Name must contain letters only!";
    }
    else{
        //Ajax
        let xhr = new XMLHttpRequest(); //creating XML object
        xhr.open("POST", "php/update.php", true);
        xhr.onload = ()=>{
            if(xhr.readyState == XMLHttpRequest.DONE){
                if(xhr.status == 200){
                    let data = xhr.response;
                    if(data == "success"){
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
        xhr.send(formData); // sending form data to php
    }
}