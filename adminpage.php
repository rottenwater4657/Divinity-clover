<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "login");

// Fetch all orders with student info
$sql = "SELECT o.order_id, u.username, m.name AS item, o.quantity, o.status
        FROM orders o
        JOIN students u ON o.user_id = u.id
        JOIN menu m ON o.item_id = m.id
        ORDER BY o.order_id DESC";

$result = $mysqli->query($sql);

// Mark an order as ready
if (isset($_POST['mark_ready'])) {
    $order_id = (int)$_POST['order_id'];
    $mysqli->query("UPDATE orders SET status='Ready' WHERE order_id=$order_id");
    header("Location: adminpage.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <a href="../login and sign up/first.html">
    <button > Back</button>
    </a>
    <a href =menu.php>menu</a><br>
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
