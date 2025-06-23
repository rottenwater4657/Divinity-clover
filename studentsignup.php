<?php
include("./sql.php");
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
     $conn = conntodb();
    $userName=$_POST['username'];
    $password=$_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql="INSERT into students(username,hash_password)
          VALUES ('$userName','$hashed_password')";
    try{
    mysqli_query($conn,$sql);
    echo "user is now registered";
     header("refresh:3;url=studentlogin.php"); // Redirect after 3 second
exit();
    }
    catch(mysqli_sql_exception)
    {
        echo "could not register";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="signin.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    
</head>
<body>
    <!-- Background video -->
    <div class="video-container">
        <video loop autoplay muted id="background-video">
            <source src="videos/login.mp4" type="video/mp4">
        </video>
    </div>

    <!-- Login form -->
    <div class="form-container">
        <div class="head">
            <a href="first.html">
                <button class="back-button">↩</button>
            </a>
            <h1>Sign Up</h1>
        </div>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Register</button>
        </form>
       
    </div>
</body>
</html>
 