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
</head>
<body>
  <a href="adminpage.php">
    <button > Back</button>
    </a>
    <h1>🍽️ Admin Panel - Canteen Menu</h1>
<h3>Add New Item</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Item Name" required>
    <input type="number" name="price" step="1" placeholder="Price" required>
    <button class="btn" type="submit" name="add">Add Item</button>
</form>
<h3>Current Menu</h3>
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
