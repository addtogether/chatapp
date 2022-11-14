const searchBar = document.querySelector(".users .search input");
searchBtn = document.querySelector(".users .search button");
usersList = document.querySelector(".users .users-list");
darkMode = document.querySelector("input[type='checkbox']");
var head  = document.getElementsByTagName('head')[0];
cssFile = head.getElementsByTagName("link")[1];

cookie = getCookie("theme");
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

if(cookie == 1){
    darkMode.checked = true;
}else{
    darkMode.checked = false;
}
    

function changeTheme(){
    if(darkMode.checked == true){
        cssFile.href = "style1.css";
        document.cookie = "theme=1; expires=Thu, 18 Dec 2100 12:00:00 UTC; path=/";
    }else{
        cssFile.href = "style2.css";
        document.cookie = "theme=0; expires=Thu, 18 Dec 2100 12:00:00 UTC; path=/";
    }
}

searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBtn.classList.toggle("active");
    searchBar.focus();
    searchBar.value = "";
}

searchBar.onkeyup = ()=>{
    let inputSearch = searchBar.value;
    // console.log(inputSearch);
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/search.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("inputSearch=" + inputSearch);
}

function addFriend(id){
    //Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/add-friend.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success"){
                    console.log("HElo");
                    location.href = "users.php";
                }else{
                    alert(data);
                }
            }
        }
    }
    // Sending data from Ajax to php
    let formData = new FormData(); //creating new formData
    formData.append("id", id);
    xhr.send(formData); // sending form data to php
}

setInterval(()=>{
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET", "php/users.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
    
}, 500); 
//this function will run frequently after 500ms
// let xhr = new XMLHttpRequest(); //creating XML object
//     xhr.open("GET", "php/users.php", true);
//     xhr.onload = ()=>{
//         if(xhr.readyState == XMLHttpRequest.DONE){
//             if(xhr.status == 200){
//                 let data = xhr.response;
//                 usersList.innerHTML = data;
//             }
//         }
//     }
//     xhr.send(); // this updates only one time