
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check</title>
</head>
<body>
<h1>Enter Admin Code</h1>
<form action="" method="post">
    <input type="text" name="admin_code" placeholder="Admin Code" required>
    <button type="submit">Check</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_code = $_POST['admin_code'];
    if ($admin_code === "1234") {
        echo "<p>Access granted.</p>";
    } else {
        echo "<p>Access denied.</p>";
    }
}
?>
</body>
</html>
