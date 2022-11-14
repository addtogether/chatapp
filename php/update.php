<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $id = (int) $_SESSION['unique_id'];

    if(!empty($fname) && !empty($lname)){
        //checking if user uploaded file or not
        if($_FILES['image']['name'] != null){ //if file is uploaded
            $img_name = $_FILES['image']['name'];
            // $img_type = $_FILES['image']['type'];
            $temp_name = $_FILES['image']['tmp_name'];

            //spliting the image name into 2 parts name and extention
            $img_split = explode(".", $img_name);
            $img_ext = end($img_split);   //got the extention of file

            $extentions = ['png', 'jpg', 'jpeg'];
            if(in_array($img_ext, $extentions) == true){
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($temp_name, "images/".$new_img_name)){
                    $sql = mysqli_query($conn,"SELECT * FROM users WHERE unique_id = $id");
                    $row = mysqli_fetch_assoc($sql);
                    unlink("images/".$row['img']);
                    //inserting user data into database
                    $sql2 = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', img = '{$new_img_name}'
                                            WHERE unique_id = $id");
                    if($sql2){
                        echo "success";
                    }
                    else{
                        echo "Something Went Wrong!";
                    }
                }
            
            }else{
            echo "Please Select a file of extentions:(jpeg, png, jpg)";
            }
        
        }else{
            $sql2 = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}' WHERE unique_id = $id");
            if($sql2){
                echo "success";
            }
            else{
                echo "Something Went Wrong!";
            }
        }
    
    }else{
        echo "All input field are required";
    }