<?php
    session_start();
    include_once "config.php";

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $users = mysqli_real_escape_string($conn, $_POST['users']);
    $users .= ",".$_SESSION['unique_id']; 
    // echo $users;

    $sql = mysqli_query($conn, "INSERT INTO grp (group_name, users) VALUES('{$name}', '{$users}')");

    if($sql){
       echo "success";
    }
    else{
        echo "Something went wrong";
    }