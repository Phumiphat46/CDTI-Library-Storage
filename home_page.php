<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register_db";

// Create Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
} 

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}


// echo $_SESSION['username']; // ตรงนี้เป็น username (ไม่ได้มีผลอะไรกับ code แค่ทดสอบ)
$username = $_SESSION['username']; // ตรงนี้เป็นusername (ไม่ได้มีผลอะไรกับ code แค่ทดสอบ)

if (isset($_SESSION['username'])):
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

?>
<!DOCTYPE html>
    <html> 
        <head>
            <title>Home</title>
            <link rel="stylesheet" href="home_style.css">
        </head>
        <body>
            <nav class = "header">
                <a href = "home_page.php" class= "Logo" style ="font-size:32px; font-weight:bold;"><i>CDTI's Library Storage</i></a>
                <div class = "header-right">
                    <a href = "#home" class = "active">Home</a>
                    <a href = "#creator">Creator</a>
                    <a href = "#nothing">n0thing</a>
                    <a href="home_page.php?logout='1'" style="color: red;">Logout</a>
                </div>
            </nav>
            
            <div class = "sidenav">
                <a href = "#about">About</a>
                <a href = "#services">Services</a>
                <a href = "#clients">Clients</a>
                <a href = "#creator">Creator</a>
            </div>
            
            <div class = "main" style = "padding-left:20px">
                <p> Welcome! <strong style = "color: red;"><?php echo $_SESSION["username"];?></strong></p>
                <?php endif ?>
                <p style = "line-height:0.99;">This is Work Library/Storage that you can<br></p>
                <p style = "text-indent:25px;">- Upload your <b>Artworks or Other Images</b><br></p>   
                <p style = "text-indent:25px;">- If you want to delete The Image that you have uploaded, you can Delete it!!!</p>        
            
                            
                <br>
                <br>
                <br>
                <br>
                <br>
                
                
                <?php /* (Unused code) retrive name of the user from database 
                    while ($rows = mysqli_fetch_assoc($result)) 
                    echo $rows['username'];  > */ 
                ?>

                <br>

                <!--- Upload part --->
                <form action = "(form)upload-to-s3.php" method = "post" enctype = "multipart/form-data">
                    Select file to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
                <ul>
                    
                <!-- retrive files from aws s3 --->
                <?php
                require 'retrive_files.php';
                ?>

                <!--- Delete part --->
                <h1>Delete File Form</h1>
                <form action="(form)delete_file.php" method="post">
                    <label for="filename">Enter the name of the file you want to delete:</label>
                    <input type="text" id="filename" name="filename" required>
                    <br><br>
                    <input type="submit" value="Delete File">
                </form>

                <p><a href="home_page.php?logout='1'" style="color: red;">Logout</a></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h2 id = "about">About</h2>

                <p>This website project is the part of Software Development 2 (semester 2/2566)</p> 
                <p><u class = teachr_underline>Assigned by</u> <b>Teacher Kritsada Phromsuthirak</b></p>
                <p>Created by <b>Phumiphat Pintira</b></p>
                
            </div>
        </body>
    </html>