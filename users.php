<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
            <?php
                include_once "php/config.php";
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }
            ?>
                <div class="content">
                    <img src="php/images/<?php echo $row['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname']." ".$row['lname']?>
                            <div class="dropdown">
                                <span><i class="far fa-edit"></i></span>
                                <div class="dropdown-content">
                                    <ul>
                                        <li><a href="new_group.php">New Group</a></li>
                                        <li><a href="update.php">Edit Profile</a></li>
                                        <li>Dark &nbsp;
                                            <label class="switch">
                                            <input onclick="changeTheme()" type="checkbox" checked>
                                            <span class="slider round"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </span>
                        <p><?php echo $row['status']?></p>
                    </div>
                </div>

                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list"></div>
        </section>
    </div>
    <script src="javascript/users.js"></script>
</body>
</html>