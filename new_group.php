<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form users">
            <header>Create New Group</header>
            <section class="form login">
                <form action="#">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Group Name</label>
                        <input type="text" class="name" name="name" placeholder="Enter Group Name">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Create">
                    </div>
                </form>
            </section>
            <div class="users-list">
            <?php
                include_once "./php/config.php";
                $sender_id = $_SESSION['unique_id'];
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$sender_id} AND friend LIKE '%{$sender_id}%' ");
                $output = "";

                if(mysqli_num_rows($sql) <= 0){
                    $output .= "No friends are available to Add";
                }
                elseif(mysqli_num_rows($sql) > 0){
                    if(mysqli_affected_rows($conn)){
                        while($row = mysqli_fetch_assoc($sql)){
                            $output .= '
                                        <a href="#">
                                            <div class="content">
                                                <img src="php/images/'.$row['img'].'" alt="">
                                                <div class="details">
                                                    <span>'.$row['fname']." ".$row['lname'].'</span>
                                                </div>
                                            </div>
                                            <div class="add-friend" style="margin-right: 0px !important" onclick="addFriend('.$row['unique_id'].', this)">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                            <div class="add-friend" style="display:none;margin-right: 0px !important" onclick="removeFriend('.$row['unique_id'].', this)">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </a>';
                        }
                    }
                }
                echo $output;
            ?>
            </div>
        </section>
    </div>
    <script src="javascript/create-group.js"></script>
</body>
</html>