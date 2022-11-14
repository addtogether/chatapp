<?php
    session_start();
    include_once "config.php";

    $id = (int) $_GET['userID'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$id}");
    $row = mysqli_fetch_assoc($sql);
    echo $row['status'];