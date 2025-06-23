<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $admin_code = $_POST['admin_code'];
    if ($admin_code === "1234") { 
        header("Location: staffsignup.php");
        exit();
    } else {
        echo "<p>Access denied.</p>";
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
     <link rel="stylesheet" href="check.css">
    <link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>
    <div class="video-container">
        <video loop autoplay muted id="background-video">
            <source src="videos/check.mp4" type="video/mp4">
        </video>
    </div>
    <div class="form-container">
<h1>Enter Admin Code</h1>
<form  method="post">
    <input type="text" name="admin_code" placeholder="Admin Code" required>
    <button type="submit">Check</button>
</form>
</div>
  
</body>
</html>
       

