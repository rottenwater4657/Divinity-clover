<!DOCTYPE html>
<html>
<head>
  <title>Food Ordering Menu</title>
 <link rel="icon" href="images/logo.png" type="image/png">
  <link rel="stylesheet" href="menu.css">
</head>
<body>
    <div class="video-container">
        <video loop autoplay muted id="background-video">
            <source src="videos/check.mp4" type="video/mp4">
        </video>
    </div>
    
  <div class="top-nav">
   
    <a href="first.html" class="logout-btn">Logout</a>
    <a href="Sorderhistory.php">History</a>
   
    <a href="menuS.php" class="menu-btn">Menu</a>
  </div>
    
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