<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
        $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
        $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
        $msg = mysqli_real_escape_string($conn, $_POST['message']);
        
        if($group_id == ""){
            
            if($_FILES['file']['name'] != null){
                $img_name = $_FILES['file']['name'];
                // $img_type = $_FILES['image']['type'];
                $temp_name = $_FILES['file']['tmp_name'];
    
                //spliting the image name into 2 parts name and extention
                $img_split = explode(".", $img_name);
                $img_ext = end($img_split);   //got the extention of file
    
                $extentions = ['png', 'jpg', 'jpeg'];
                if(in_array($img_ext, $extentions) == true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($temp_name, "files/".$new_img_name)){
                        $sql = mysqli_query($conn, "INSERT INTO messages (receiver_msg_id, sender_msg_id, img)
                                                    VALUES ({$receiver_id}, {$sender_id}, '{$new_img_name}')") or die();
                    }
                }else{
                    echo "Please select 'png', 'jpg', 'jpeg' files only";
                }
            }
            else if(!empty($msg)){
                $sql = mysqli_query($conn, "INSERT INTO messages (receiver_msg_id, sender_msg_id, msg)
                                VALUES ({$receiver_id}, {$sender_id}, '{$msg}')") or die();
            }
        }else{
            if($_FILES['file']['name'] != null){
                $img_name = $_FILES['file']['name'];
                // $img_type = $_FILES['image']['type'];
                $temp_name = $_FILES['file']['tmp_name'];
    
                //spliting the image name into 2 parts name and extention
                $img_split = explode(".", $img_name);
                $img_ext = end($img_split);   //got the extention of file
    
                $extentions = ['png', 'jpg', 'jpeg'];
                if(in_array($img_ext, $extentions) == true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($temp_name, "files/".$new_img_name)){
                        $sql = mysqli_query($conn, "INSERT INTO group_msg (group_id, sender_msg_id, img)
                                                    VALUES ({$group_id}, {$sender_id}, '{$new_img_name}')") or die();
                    }
                }else{
                    echo "Please select 'png', 'jpg', 'jpeg' files only";
                }
            }
            else if(!empty($msg)){
                $sql = mysqli_query($conn, "INSERT INTO group_msg (group_id, sender_msg_id, msg)
                                VALUES ({$group_id}, {$sender_id}, '{$msg}')") or die();
            }
        }
        
    }
    else{
        session_destroy();
        header("../login.php");
    }
?>