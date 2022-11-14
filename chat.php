<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                    include_once "php/config.php";
                    if(isset($_GET['group_id'])){
                        $user_id = "";
                        $group_id = mysqli_real_escape_string($conn, $_GET['group_id']);
                        $sql = mysqli_query($conn, "SELECT * FROM grp WHERE id = {$group_id}");
                        $usernames = "";
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                            $users = explode(",", $row['users']);
                            foreach($users as $user){
                                $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $user");
                                $row1 = mysqli_fetch_assoc($sql1);
                                $usernames .= $row1['fname']." ".$row1['lname'].", ";
                            }
                        }
                        echo '<a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                            <img src="users.jpg" alt="">
                            <div class="details">
                                <input type="text" value="" hidden>
                                <span>'.$row['group_name'].'</span>
                                <p><marquee>'.$usernames.'</marquee></p></div>';
                    }
                    else{
                        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                        $group_id = "";
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                        echo '<a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                            <img src="php/images/'.$row['img'].'" alt="">
                            <div class="details">
                                <input type="text" value="'.$_GET['user_id'].'" hidden>
                                <span>'.$row['fname'].' '.$row['lname'].'</span>
                                <p>'.$row['status'].'</p>
                            </div>';
                    }
                ?>
                
            </header>
            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="sender_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="group_id" value="<?php echo $group_id; ?>" hidden>
                <input type="text" name="receiver_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="message" placeholder="Type a message here...">
                <input type="file" name="file" class="file" hidden>
                <i class="fas fa-paperclip"></i>
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="javascript/chat.js"></script>

</body>
</html>