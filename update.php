<?php 
    session_start();
    include_once "php/config.php";
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
    $sql = mysqli_query($conn,"SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    $row = mysqli_fetch_assoc($sql);
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Update Details</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-text">This is an error message!!</div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $row['fname']?>" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row['lname']?>" required>
                    </div>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Update Details">
                </div>
            </form>
            <div class="link">Back To Chat? <a href="users.php">Click Here</a></div>
        </section>
    </div>
    <script src="javascript/update.js"></script>

</body>
</html>