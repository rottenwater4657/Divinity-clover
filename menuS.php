<?php
$mysqli = new mysqli("localhost", "root", "", "login");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Fetch menu
$result = $mysqli->query("SELECT * FROM menu");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <a href="studentpage.php">
    <button > Back</button>
    </a>
    <h1>Canteen Menu</h1>
<h3>Current Menu</h3>
<table>
    <tr><th>ID</th><th>Name</th><th>Price</th></tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td>$<?= $row['price'] ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>