

<?php

session_start();


$mysqli = new mysqli("localhost", "root", "", "login"); 

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch menu data
$result = $mysqli->query("SELECT * FROM menu");



if(isset($_POST['order'])) {

    if (!isset($_SESSION['user_id'])) {
        die("User not logged in.");
    }
}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div name = "order history">
      <?php



$user_id = $_SESSION['user_id'];

$sql = "SELECT o.order_id, m.name AS item_name, m.price, o.quantity, o.order_time, o.status
        FROM orders o
        JOIN menu m ON o.item_id = m.id
        WHERE o.user_id = ?
        ORDER BY o.order_time DESC";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?> 
<h2>📋 Your Order History</h2>

<table>
    <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total</th>
        <th>Date</th>
        <th>Status</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) {
        $total = $row['price'] * $row['quantity'];
    ?> 
        <tr>
            <td><?= htmlspecialchars($row['item_name']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>Rs. <?= $row['price'] ?></td>
            <td>Rs. <?= $total ?></td>
            <td><?= $row['order_time'] ?></td>
            <td><?=$row['status']?></td>
        </tr>
     <?php } ?> 
</table>
    </div>
</body>
</html>