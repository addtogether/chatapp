<?php
    $conn = mysqli_connect("localhost", "root", "", "chatapp2");
    if(!$conn){
        echo "DataBase Connected" . mysqli_connect_error();
    }
?>