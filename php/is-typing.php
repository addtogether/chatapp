<?php
    session_start();
    include_once "config.php";

    if($_GET['status'] == 1){
        $sql = mysqli_query($conn, "UPDATE users SET status = 'is typing' WHERE unique_id = {$_SESSION['unique_id']}");
    }else{
        $sql = mysqli_query($conn, "UPDATE users SET status = 'active' WHERE unique_id = {$_SESSION['unique_id']}");
    }