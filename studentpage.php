<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
     <link rel="icon" href="images/Log clover.jpg" type="image/png">
     <link rel="stylesheet" href="mainstyle.css">
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
                <a href="#" class="nav-link">Feedback</a>
              </li>
              <li class="class-item">
                <a href="first.html" class="nav-link"> Log Out</a>
              </li>
        
            </ul>
        </nav>
    
     


<div name="place order">
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

    $user_id = $_SESSION['user_id'];

    // Check if qty array is sent
    if (isset($_POST['qty']) && is_array($_POST['qty'])) {
        $qty = $_POST['qty'];

        foreach ($qty as $item_id => $quantity) {
            $item_id = (int)$item_id;
            $quantity = (int)$quantity;

            if ($quantity > 0) {
                $stmt = $mysqli->prepare("INSERT INTO orders (user_id, item_id, quantity) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $user_id, $item_id, $quantity);
                $stmt->execute();
            }
        }

        echo "<h2> Order Placed Successfully!</h2>";        
    }
} 
?>  
<h2>🍽️ Place Your Order</h2>

<form  method="POST">
    <table>
        <tr>
            <th>Item</th>
            <th>Price (Rs.)</th>
            <th>Quantity</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>  
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['price'] ?></td> 
                <td>
                    <input type="number" name="qty[<?= $row['id'] ?>]" min="0" value="0">
                    <input type="hidden" name="price[<?= $row['id'] ?>]" value="<?= $row['price'] ?>">
                    <input type="hidden" name="name[<?= $row['id'] ?>]" value="<?= htmlspecialchars($row['name']) ?>">
                </td>
            </tr>
     <?php } ?>
    </table>
    <button type="submit" name ="order" class="btn">Submit Order</button><br>
  
</form>
    </div>

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
</div>    

</body>
</html>