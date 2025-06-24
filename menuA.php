<?php
$mysqli = new mysqli("localhost", "root", "", "login");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Add food
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stmt = $mysqli->prepare("INSERT INTO menu (name, price) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $price);
    $stmt->execute();
}
// Update price
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $stmt = $mysqli->prepare("UPDATE menu SET price = ? WHERE id = ?");
    $stmt->bind_param("ii", $price, $id);
    $stmt->execute();
}
// Delete item
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $mysqli->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
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
    <link rel="stylesheet" href="last.css">
</head>
<body>
     <nav class="navbar">
          
            <a href="#" class="nav-logo">
<img src="images/Logo DC.png" alt="Profile" style="height: 60px; border-radius: 50%; margin-left: auto;">
            </a>
            <ul class="nav-menu">
              <li class="class-item">
                <a href="adminpage.php" class="nav-link">Home</a>
              </li>
              <li class="class-item">
                <a href="menuA.php" class="nav-link">Menu</a>
              </li>
              <li class="class-item">
                <a href="Aorderhistory.php" class="nav-link">Order History</a>
              </li>
              <li class="class-item">
                <a href="#" class="nav-link">Contact Us</a>
              </li>
              <li class="class-item">
                <a href="#" class="nav-link">Feedback</a>
              </li>
              <li class="class-item">
                <a href="first.html" class="nav-link"> Log Out</a>
              </li>
        
            </ul>
        </nav>
  
    <h1> Admin Panel - Canteen Menu</h1>
<div class="form-container">
        <div class="head">
    <h2 > Add New Item </h2>
   <form method="POST">
    <input type="text" name="name" placeholder="Item Name" required>
    <input type="number" name="price" step="1" placeholder="Price" required>
    <button class="btn" type="submit" name="add">Add Item</button>
</form>
    </div>
    </div>
    

<h1>Current Menu</h1>
<table>
    <tr><th>ID</th><th>Name</th><th>Price</th><th>Update</th><th>Delete</th></tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td>$<?= $row['price'] ?></td>
        <td>
            <form method="POST" style="display:flex;">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="number" name="price" step="1" value="<?= $row['price'] ?>" required>
                <button class="btn" name="update">Update</button>
            </form>
        </td>
        <td>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button class="btn btn-delete" name="delete">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>