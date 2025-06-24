<?php

session_start();


$mysqli = new mysqli("localhost", "root", "", "login");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Fetch menu data
$result = $mysqli->query("SELECT * FROM menu");



if (isset($_POST['order'])) {

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
  <link rel="stylesheet" href="menuS.css">
</head>

<body>
  <nav class="navbar">

    <a href="#" class="nav-logo">
      <img src="images/Logo DC.png" alt="Profile" style="height: 60px; border-radius: 50%; margin-left: auto;">
    </a>
    <ul class="nav-menu">
      <li class="class-item">
        <a href="studentpage.php" class="nav-link">Home</a>
      </li>
      <li class="class-item">
        <a href="menuS.php" class="nav-link">Menu</a>
      </li>
      <li class="class-item">
        <a href="Sorderhistory.php" class="nav-link">Order History</a>
      </li>
      <li class="class-item">
        <a href="#" class="nav-link">Contact Us</a>
      </li>
      <li class="class-item">
        <a href="feedback.html" class="nav-link">Feedback</a>
      </li>
      <li class="class-item">
        <a href="first.html" class="nav-link"> Log Out</a>
      </li>

    </ul>
  </nav>
  <div name="order history">
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
    <h1>📋 Your Order History</h1>

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
        <td> <span class="status <?= strtolower($row['status']) === 'ready' ? 'status-ready' : 'status-pending' ?>">
                        <?= htmlspecialchars($row['status']) ?>
                    </span>
        </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>

</html>