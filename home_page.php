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

echo $_SESSION['username']; // ตรงนี้เป็นusername (ไม่ได้มีผลอะไรกับ code แค่ทดสอบ)
$username = $_SESSION['username']; // ตรงนี้เป็นusername (ไม่ได้มีผลอะไรกับ code แค่ทดสอบ)

if (isset($_SESSION['username'])):
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    require "isdirempty.php";
?>
<!DOCTYPE html>
    <html> 
        <head>
            <title>Home</title>
            <style>
           /* * {box-sizing: border-box;} */
         
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            .header {
                /* overflow: hidden; */
                position: fixed;
                background-color: #f1f1f1;
                padding: 20px 10px;
                width: 99%;
                height: 11%;
            }

            .header a.Logo {
                font-size: 88px;
                font-weight: bold;
            }

            .header a {
                float: left;
                color: black;
                text-align: center;
                padding: 12px;
                text-decoration: none;
                /* font-size: 18px; */
                line-height: 25px;
                border-radius: 4px;
            }

            .header a:hover {
                background-color: #ddd;
                color: black;
            }

            .header a.active {
                background-color: dodgerblue;
                color: white;
            }

            .header-right {
                float: right;
            }

            @media screen and (max-width: 500px){
                .header a {
                    float: none;
                    display: block;
                    text-align: left;
                }

                .header-right {
                    float: none;
                }
            }

            /* below are sidebar css */
            .sidenav {
                height: 81%;
                width: 200px;
                position: fixed;
                z-index: 1;
                bottom: 0px;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 20px;
            }
             
            .sidenav a {
                padding: 6px 8px 6px 16px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
            }
            .sidenav a:hover {
                color: #f1f1f1;
            }
            .main {
                margin-left: 200px; /* Same as the width of the sidenav */
                font-size: 28px; /* Increased text to enable scrolling */
                padding: 0px 10px;
                padding-top: 10%;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            } 
            </style>
        </head>
        <body>
            <nav class = "header">
                <a href = "#default" class= "Logo">CDTI</a>
                <div class = "header-right">
                    <a href = "#home" class = "active">Home</a>
                    <a href = "#contact">Contact</a>
                    <a href = "#about">About</a>
                    <a href="home_page.php?logout='1'" style="color: red;">Logout</a>
                </div>
            </nav>
            
            <div class = "sidenav">
                <a href = "#about">About</a>
                <a href = "#services">Services</a>
                <a href = "#clients">Clients</a>
                <a href = "#contact">Contact</a>
            </div>
            
            <div class = "main" style = "padding-left:20px">
                <p>This is Work Library/Storage</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p> Welcome <strong><?php echo $_SESSION["username"];?></strong></p>
                <?php endif ?>
                
                <?php
                    while ($rows = mysqli_fetch_assoc($result)) 
                    {
                ?>
                    <?php echo $rows['username']; ?> <!--- fecth data from database --->
                <?php
                    }
                ?>
                <br>
                <?php
                $lowcase_username = strtolower($username);
                isDirEmpty("uploads\\{$lowcase_username}");

                ?>
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

                <p>This is project is the part of Software Development 2 (semester 2/2566)
                    Captain Khon Lhor
                </p>
            </div>
        </body>
    </html>