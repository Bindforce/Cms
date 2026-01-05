<?php 
session_start();
include('includes/header.php'); 
include('includes/db_connect.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$stmt = $conn->prepare("SELECT full_name FROM customers WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$customer = $stmt->get_result()->fetch_assoc();
$customer_name = $customer['full_name'];
?>

<section class="cart-section">

<?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>

    <div class="empty-cart-box">
        <h3>🛒 Your Cart is Empty</h3>
        <p>Add delicious food from our menu to continue!</p>
        <a href="menu.php" class="cart-btn">Browse Menu</a>
    </div>

<?php else: ?>

<h2>Your Cart</h2>

<table class="cart-table">
    <tr>
        <th>Item</th>
        <th>Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total</th>
        <th>Remove</th>
    </tr>

    <?php
    $grand_total = 0;
    foreach ($_SESSION['cart'] as $index => $item):
        $sub = $item["qty"] * $item["price"];
        $grand_total += $sub;
    ?>

    <tr>
        <td><img src="images/<?php echo $item['image']; ?>" class="cart-img"></td>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $item['qty']; ?></td>
        <td>Rs. <?php echo $item['price']; ?></td>
        <td>Rs. <?php echo $sub; ?></td>
        <td>
            <a href="remove_item.php?id=<?php echo $index; ?>" class="remove-btn">X</a>
        </td>
    </tr>

    <?php endforeach; ?>
</table>

<h3 class="grand-total">Grand Total: Rs. <?php echo $grand_total; ?></h3>

<div class="detail-box">

    <form id="orderForm" method="POST" action="place_order.php">

        <input type="hidden" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>">

        <label>Table Number / Address <span style="color:red">*</span></label>
        <input type="text" id="address" name="address" placeholder="Table No / Address" required>
        <div class="error" id="addressError"></div>

        <button type="button" class="order-btn" onclick="validateForm()">Place Order</button>
    </form>

</div>

<script>
function validateForm() {
    let address = document.getElementById("address");
    let addressError = document.getElementById("addressError");
    addressError.innerHTML = "";
    let value = address.value.trim();
    let pattern = /^[A-Za-z0-9 ]+$/;

    if (value === "") {
        addressError.innerHTML = "Please enter table number or address";
        return;
    }

    if (!pattern.test(value)) {
        addressError.innerHTML = "Only letters and numbers are allowed";
        return;
    }

    document.getElementById("orderForm").submit();
}
</script>

<?php endif; ?>

</section>

<?php include('includes/footer.php'); ?>
