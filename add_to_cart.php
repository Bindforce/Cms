<?php
session_start();
include("includes/db_connect.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    echo json_encode(["status" => "login_required"]);
    exit();
}

$item_id = (int)$_POST['item_id'];
$qty = (int)$_POST['quantity'];

$item = $conn->query(
    "SELECT item_id, name, price, image, stock 
     FROM menu_items 
     WHERE item_id = $item_id"
)->fetch_assoc();

if (!$item) {
    echo json_encode(["status" => "invalid_item"]);
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$current_qty = 0;
foreach ($_SESSION['cart'] as $ci) {
    if ($ci['id'] == $item_id) {
        $current_qty = $ci['qty'];
        break;
    }
}

if (($current_qty + $qty) > $item['stock']) {
    echo json_encode([
        "status" => "out_of_stock",
        "available" => $item['stock'] - $current_qty
    ]);
    exit();
}

$cart_item = [
    "id"    => $item["item_id"],
    "name"  => $item["name"],
    "price" => $item["price"],
    "qty"   => $qty,
    "image" => $item["image"]
];

$found = false;
foreach ($_SESSION['cart'] as &$ci) {
    if ($ci["id"] == $item_id) {
        $ci["qty"] += $qty;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = $cart_item;
}

echo json_encode([
    "status" => "success",
    "cart_count" => count($_SESSION['cart'])
]);
?>
