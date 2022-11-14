<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
        $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
        $group_id = mysqli_real_escape_string($conn, $_POST['group_id']);
        $output = "";

        if($group_id == ""){
            $sql = "SELECT * FROM messages WHERE (receiver_msg_id = {$sender_id} AND sender_msg_id = {$receiver_id})
                OR (receiver_msg_id = {$receiver_id} AND sender_msg_id = {$sender_id})";
            $query = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['sender_msg_id'] == $sender_id){ //this condition checks if it msg was send by user
                        if($row['msg'] == ''){
                            $msg = '<img class="outgoing-img" src="./php/files/'.$row['img'].'">';
                        }
                        else{
                            $msg = '<p>'.$row['msg'].'</p>';
                        }

                        $output .= '
                                    <div class="chat outgoing">
                                        <div class="details">
                                            '.$msg.'
                                        </div>
                                    </div>';
                    }else{
                        $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$receiver_id}");
                        $fetch = mysqli_fetch_assoc($sql1);
                        if($row['msg'] == ''){
                            $msg = '<img class="incoming-img" src="./php/files/'.$row['img'].'">';
                        }
                        else{
                            $msg = '<p>'.$row['msg'].'</p>';
                        }
                        $output .= '
                                    <div class="chat incoming">
                                        <img class="incoming-profile" src="php/images/'.$fetch['img'].'" alt="">
                                        <div class="details">
                                            '.$msg.'
                                        </div>
                                    </div>';
                    }
                }
                echo $output;
            }
        }
        else{
            $sql = "SELECT * FROM group_msg WHERE group_id = $group_id";
            $query = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['sender_msg_id'] == $sender_id){ //this condition checks if it msg was send by user
                        if($row['msg'] == ''){
                            $msg = '<img class="outgoing-img" src="./php/files/'.$row['img'].'">';
                        }
                        else{
                            $msg = '<p>'.$row['msg'].'</p>';
                        }

                        $output .= '
                                    <div class="chat outgoing">
                                        <div class="details">
                                            '.$msg.'
                                        </div>
                                    </div>';
                    }else{
                        $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$row['sender_msg_id']}");
                        $fetch = mysqli_fetch_assoc($sql1);
                        if($row['msg'] == ''){
                            $msg = '<img class="incoming-img" src="./php/files/'.$row['img'].'">';
                        }
                        else{
                            $msg = '<p>'.$row['msg'].'</p>';
                        }
                        $output .= '
                                    <div class="chat incoming">
                                        <img class="incoming-profile" src="php/images/'.$fetch['img'].'" alt="">
                                        <div class="details">
                                            '.$msg.'
                                        </div>
                                    </div>';
                    }
                }
                echo $output;
            }
        }

        
    }else{
        session_destroy();
        header("../login.php");
    }
?>