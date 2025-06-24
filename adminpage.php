
<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "login");

// Fetch all orders with student info
$sql = "SELECT o.order_id, u.username, m.name AS item, o.quantity, o.status
        FROM orders o
        JOIN students u ON o.user_id = u.id
        JOIN menu m ON o.item_id = m.id
        WHERE o.status != 'Ready'
        ORDER BY o.order_id DESC";

$result = $mysqli->query($sql);

// Mark an order as ready
if (isset($_POST['mark_ready'])) {
    $order_id = (int)$_POST['order_id'];
    $mysqli->query("UPDATE orders SET status='Ready' WHERE order_id=$order_id");
    header("Location: adminpage.php");
    exit();
} 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="admin.css">
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
                <a href="contact.html" class="nav-link">Contact Us</a>
              </li>
              <li class="class-item">
                <a href="feedback.html" class="nav-link">Feedback</a>
              </li>
              <li class="class-item">
                <a href="first.html" class="nav-link"> Log Out</a>
              </li>
        
            </ul>
        </nav>
    <h2>All Orders</h2>
<table border="1">
    <tr>
        <th>Order ID</th><th>Student</th><th>Item</th><th>Qty</th><th>Status</th><th>Action</th>
    </tr>
     <?php while ($row = $result->fetch_assoc()) { ?> 
        <tr>
            <td><?= $row['order_id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['item']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                 <?php if ($row['status'] === 'Pending') { ?> 
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                        <button type="submit" name="mark_ready">Mark Ready</button>
                    </form>
                 <?php } else { 
                   echo "✔ Ready"; 
                } ?> 
            </td>
        </tr>
     <?php } ?> 
</table>

</body>
</html>
