<?php
session_start();
include "../includes/db_connect.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

$stmt = $conn->prepare(
    "SELECT full_name, email, username
     FROM customers 
     WHERE customer_id = ?"
);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$customer = $stmt->get_result()->fetch_assoc();

$stmt2 = $conn->prepare(
    "SELECT o.order_id, o.total_amount, o.order_time, 
            GROUP_CONCAT(m.name SEPARATOR ', ') AS items
     FROM orders o
     JOIN order_items oi ON o.order_id = oi.order_id
     JOIN menu_items m ON oi.item_id = m.item_id
     WHERE o.customer_id = ?
     GROUP BY o.order_id
     ORDER BY o.order_time DESC"
);
$stmt2->bind_param("i", $customer_id);
$stmt2->execute();
$orders = $stmt2->get_result();

?>
<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: #fff4ee;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: 40px auto;
}

.title {
    font-size: 32px;
    font-weight: bold;
    color: #ff3d1f;
    margin-bottom: 25px;
}

.card {
    background: #ffffff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    margin-bottom: 30px;
}

.card h3 {
    color: #ff3d1f;
    margin-bottom: 15px;
}

.profile-info p {
    font-size: 16px;
    margin: 8px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    background: #ff3d1f;
    color: white;
    padding: 12px;
}

table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

.price {
    font-weight: bold;
    color: #d73318;
}

.logout-btn {
 display: inline-block;
    padding: 14px 400px;
    background: #ff3d1f;
    color: white;
    font-size: 18px;
    font-weight: bold;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.2s;
}

.logout-btn:hover {
    background: #d73318;
}
.logout-box {
    text-align: center;
}

</style>

</head>
<body>

<div class="container">

    <div class="title">My Profile</div>

    <div class="card profile-info">
        <h3>Customer Information</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($customer['full_name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($customer['email']) ?></p>
        <p><strong>Username:</strong> <?= htmlspecialchars($customer['username']) ?></p>
       
    </div>

    <div class="card">
        <h3>Order History</h3>

        <?php if ($orders->num_rows > 0): ?>
        <table>
            <tr>
                <th>SN</th>
                <th>Date</th>
                <th>Food Items</th>
                <th>Total Price</th>
            </tr>

            <?php $count = 1; ?>
            <?php while ($row = $orders->fetch_assoc()): ?>
            <tr>
                <td><?= $count ?></td>
                <td><?= date("d M Y", strtotime($row['order_time'])) ?></td>
                <td><?= htmlspecialchars($row['items']) ?></td>
                <td class="price">Rs. <?= number_format($row['total_amount'], 2) ?></td>
            </tr>
            <?php $count++; endwhile; ?>
        </table>
        <?php else: ?>
            <p>No previous orders found.</p>
        <?php endif; ?>
    </div>
<div class="card logout-box">
    <a href="../admin/logout.php" class="logout-btn">Logout</a>
</div>

</div>

</body>
</html>
