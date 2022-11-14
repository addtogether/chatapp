<?php
    session_start();
    include_once "config.php";

    $friend_id = (int) $_POST['id'];
    $id = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE  unique_id = {$friend_id}");
    if($sql){
        $row = mysqli_fetch_assoc($sql);
        $addFriend = $row['friend'].$id;
        $sql1 = mysqli_query($conn, "UPDATE users SET friend = '{$addFriend}' WHERE  unique_id = {$friend_id}");
        if($sql1){
            echo "success";
        }
        else{
            echo "Something went wrong";
        }
    }
    else{
        echo "Something went wrong";
    }
    