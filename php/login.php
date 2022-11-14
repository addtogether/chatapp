<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($email) && !empty($password)){
        //checking credentials
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $check = password_verify($password, $row['password']);
            if($check){
                $_SESSION['unique_id'] = $row['unique_id'];
                $status = "active";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    echo "success";
                }
                // header("location: users.php");
            }else{
                echo "Password is incorrect!";
            }
        }else{
            echo "Email does not exist! sign up first.";
        }
    }else{
        echo "All input fields are required";
    }

?>