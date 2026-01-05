<?php
session_start();
include('../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {

    $name = trim($_POST['item_name']);
    $price = floatval($_POST['price']);
    $category = trim($_POST['category']);
    $stock = intval($_POST['stock']); 

    $photoName = null;

    if (!empty($_FILES['photo']['name'])) {

        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time() . "_" . rand(1000, 9999) . "." . $ext;

        $uploadPath = "../images/" . $photoName;

        if (!is_dir("../images")) {
            mkdir("../images", 0777, true);
        }

        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath);
    }

   
    $stmt = $conn->prepare(
        "INSERT INTO menu_items (name, price, category, stock, image)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sdsis", $name, $price, $category, $stock, $photoName);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_menu.php?added=1");
    exit();
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM menu_items WHERE item_id = $id");
    echo "success";
    exit();
}

$items = $conn->query("SELECT * FROM menu_items ORDER BY item_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Menu</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    padding: 20px;
}
.container { width: 90%; margin: auto; }
h1 { text-align: center; color: #ff6f3c; margin-bottom: 30px; }
h3 { color: #ff6f3c; }
#success-msg {
    background: #4CAF50;
    color: white;
    padding: 12px 17px;
    border-radius: 7px;
    margin-bottom: 15px;
    animation: fadeout 1s ease-in-out forwards;
    animation-delay: 3s;
}
@keyframes fadeout { to { opacity: 0; visibility: hidden; } }
.form-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    box-shadow: 0px 0px 8px rgba(0,0,0,0.1);
}
input, select {
    width: 95%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
button {
    background: #ff6f3c;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    margin-top: 10px;
    cursor: pointer;
}
button:hover { background: red; }
table {
    width: 100%;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    border-collapse: collapse;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}
th {
    background: #ff6f3c;
    color: white;
}
img {
    width: 60px;
    height: 60px;
    border-radius: 6px;
    object-fit: cover;
}
.delete-btn {
    background: red;
    padding: 8px 12px;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}
.delete-btn:hover { background: #ff6f3c; }
</style>

<script>
function deleteItem(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "manage_menu.php?delete_id=" + id, true);
    xhr.onload = function () {
        if (this.responseText.trim() === "success") {
            document.getElementById("item-" + id).remove();
        }
    };
    xhr.send();
}
window.onload = function() {
    if (window.location.search.includes("added=1")) {
        history.replaceState({}, document.title, "manage_menu.php");
    }
};
</script>

</head>
<body>
<div class="container">
<h1>Manage Menu</h1>

<?php if (isset($_GET['added'])): ?>
<div id="success-msg">✔ Item added successfully!</div>
<?php endif; ?>

<div class="form-box">
<h3>Add Menu Item</h3>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="item_name" placeholder="Item Name" required>
    <input type="number" step="0.01" name="price" placeholder="Price (Rs)" required>

    <input type="number" name="stock" placeholder="Stock Quantity" min="0" required>

    <select name="category" required>
        <option value="">-- Select Category --</option>
        <option>Breakfast</option>
        <option>Lunch</option>
        <option>Snacks</option>
        <option>Beverages</option>
    </select>

    <br><br><label><b>Upload Photo:</b></label>
    <input type="file" name="photo" accept="image/*">

    <button type="submit" name="add_item">Add Item</button>
</form>
</div>

<table>
<tr>
    <th>ID</th>
    <th>Photo</th>
    <th>Name</th>
    <th>Category</th>
    <th>Price (Rs)</th>
    <th>Stock</th> 
    <th>Action</th>
</tr>

<?php while ($row = $items->fetch_assoc()): ?>
<tr id="item-<?= $row['item_id'] ?>">
    <td><?= $row['item_id'] ?></td>
    <td>
        <?php if ($row['image']): ?>
            <img src="../images/<?= $row['image'] ?>">
        <?php else: ?>
            <span>No Photo</span>
        <?php endif; ?>
    </td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['category']) ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $row['stock'] ?></td> 
    <td><span class="delete-btn" onclick="deleteItem(<?= $row['item_id'] ?>)">Delete</span></td>
</tr>
<?php endwhile; ?>
</table>
<style>
 td {
  padding-top: 10px;
  padding-bottom: 20px;
  padding-left: 50px;
  padding-right: 20px;
}
</style>
</div>
</body>
</html>
