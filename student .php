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
<!DOCTYPE html> <html lang="en"> 
    <head> <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Student login</title>
         <link rel="stylesheet" href="login.css">
          <link rel="icon" href="logo clover 1.png" type="image/png">
         </head> 
         <body>

  <div class="form-container">
    <div class="head"> <a href="first.html">
             <button class="back-button">↩</button> 

            </a> 
            <h1>Sign Up</h1>
            </div>
            <form method="POST">
                Username: <input type="text" name="username" required><br>
               Password: <input type="Password" name="Password" required><br>
                 <button type="submit" >Register</button>

                
 </form> 

  </div>
</body> 
 </html>