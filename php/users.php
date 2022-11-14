<?php
    session_start();
    include_once "config.php";
    $sender_id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$sender_id} AND friend LIKE '%{$sender_id}%' ");
    $output = "";


    if(mysqli_num_rows($sql) <= 0){
        $var = true;
        include "data.php";
        if($output == ""){
            $output .= "No friends are available to chat";
        }
    }
    else if(mysqli_num_rows($sql) > 0){
        if(mysqli_affected_rows($conn)){
            include "data.php";
        }
    }

    echo $output;
?>