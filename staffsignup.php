<?php
include("./sql.php");
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
     $conn = conntodb();
    $userName=$_POST['username'];
    $password=$_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql="INSERT into staffs(username,hash_password)
          VALUES ('$userName','$hashed_password')";
    try{
    mysqli_query($conn,$sql);
    echo "user is now registered";
     header("refresh:0.1;url=studentlogin.php"); 
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
    <title>🖋 SIGN IN</title>
     <link rel="stylesheet" href="signin.css">
          <link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>
     <div class="video-container">
        <video loop autoplay muted id="background-video">
            <source src="videos/login.mp4" type="video/mp4">
        </video>
    </div>
   
    <div class="form-container">
        <div class="head">
    <h1> 🖋 SIGN IN </h1>
     <a href="first.html">
             <button class="back-button">↩</button> </a>
    <form action="" method="post">
    <input type="text" name="username" placeholder=" Enter Your Username" required><br>
    <input type="password" name="password" placeholder=" Enter Your Password" required><br> 
    <button type="submit">  Sign In 🖋 </button>
    </div>
    </div>
</form>
</body>
</html>