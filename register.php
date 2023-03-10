<?php 
    session_start();
    include('server.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="stylesheet" href="login_and_register_style.css">
</head>
<body>
    
    <div class="header">
        <h2>Register</h2>
    </div>

    <form action="register_db.php" method="post">
        <?php include('errors.php'); ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div class="input-group">
            <label for="password_1">Password</label>
            <input type="password" name="password_1" id="userPwd_1">
        </div>

        <label style = "font-size: 16px;">
        <input type = "checkbox" onclick = show_pwd_btn1() style="font-size: 9;"> Show Password
        </label>

        <div class="input-group">
            <label for="password_2">Confirm Password</label>
            <input type="password" name="password_2" id ="userPwd_2">
        </div>

        <label style = "font-size: 16px;">
        <input type = "checkbox" onclick = show_pwd_btn2() style="font-size: 9;"> Show Password
        </label>

        <div class="input-group">
            <button type="submit" name="reg_user" class="btn">Register</button>
        </div>
        <p>Already a member? <a href="login.php">Sign in</a></p>
    </form>
<script>
function show_pwd_btn1() {
  var pwd_1 = document.getElementById("userPwd_1");
  if (pwd_1.type === "password") {
    pwd_1.type = "text";
  } else {
    pwd_1.type = "password";
  } 
}
function show_pwd_btn2() {
  var pwd_2 = document.getElementById("userPwd_2");
  if (pwd_2.type === "password") {
    pwd_2.type = "text";
  } else {
    pwd_2.type = "password";
  } 
}
</script>
</script>

</body>
</html>