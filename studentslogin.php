<?php
session_start();
include("./sql.php");
$conn=conntodb();
if(isset($_POST['login'])){
      $userName=$_POST['username'];
    $password=$_POST['password'];
    $sql="select * from students where username=?";
     $stmt = mysqli_prepare($conn, $sql);
     if ($stmt) {

        mysqli_stmt_bind_param($stmt, "s", $userName);

        mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['hash_password'])) {
           echo "loading...";
           $_SESSION['user_id'] = $row['id'];
            header("refresh:1.5;url=studentpage.php");
            exit();
        } else {
            echo "Wrong Username Or Password";
        }
    }
    mysqli_stmt_close($stmt);
    } else {
        echo "Query preparation failed.";
    }



}


?>
<!DOCTYPE html> <html lang="en"> 
    <head> <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Student login</title>
         <link rel="stylesheet" href="signin.css">
          <link rel="icon" href="logo.png" type="image/png">
         </head> 
         <body>
  <!-- Background video -->
    <div class="video-container">
        <video loop autoplay muted id="background-video">
            <source src="videos/login.mp4" type="video/mp4">
        </video>
    </div>
  <div class="form-container">
    <div class="head"> <a href="first.html">
             <button class="back-button">↩</button> 

            </a> 
            <h1>Login</h1>
            </div>
            <form method="POST">
                 Username: <input type="text" name="username" required><br>
                 Password: <input type="password" name="password" required><br> 
                <button type="submit" name="login">Login</button>

 </form> 
  <div class=signup>
  Do not have an account yet?<a href="studentsignup.php">sign up</a>
  </div>
  </div>
</body> 
 </html>