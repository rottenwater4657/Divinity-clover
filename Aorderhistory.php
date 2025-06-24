<?php
session_start();

// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "login");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch all order data including student names
$sql = "SELECT o.order_id, s.username, m.name AS item_name, m.price, o.quantity, o.order_time, o.status
        FROM orders o
        JOIN students s ON o.user_id = s.id
        JOIN menu m ON o.item_id = m.id
        ORDER BY o.order_time DESC";

$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Orders</title>
  <link rel="stylesheet" href="adminhistory.css">
</head>
<body>
    <h2>📋 All Orders</h2>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Student Name</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): 
            $total = $row['price'] * $row['quantity'];
        ?>
            <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['item_name']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>Rs. <?= $row['price'] ?></td>
                <td>Rs. <?= $total ?></td>
                <td><?= $row['order_time'] ?></td>
            <td>
  <span class="status <?= strtolower($row['status']) === 'ready' ? 'status-ready' : 'status-pending' ?>">
    <?= htmlspecialchars($row['status']) ?>
  </span>
</td>
      
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>