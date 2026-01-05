<?php
session_start();
include('includes/header.php');
include('includes/db_connect.php');
?>

<section class="menu-section">
    
    <h2 class="menu-title">Our Delicious Menu</h2>
    <p class="menu-subtitle">Choose from a wide variety of freshly made meals</p>

    <div class="menu-container">

        <?php
        $items = $conn->query("SELECT * FROM menu_items");
        while ($row = $items->fetch_assoc()):
        ?>

        <div class="menu-card" style="position:relative;">
            <div style="
                position:absolute;
                top:10px;
                right:10px;
                background:<?= $row['stock'] > 0 ? '#28a745' : '#dc3545'; ?>;
                color:#fff;
                padding:6px 12px;
                border-radius:14px;
                font-size:13px;
                font-weight:bold;
                z-index:5;
            ">
                <?= $row['stock'] > 0 ? 'Stock: '.$row['stock'] : 'Out of Stock'; ?>
            </div>

            <img src="images/<?php echo $row['image']; ?>" class="menu-image">

            <h3 class="menu-name"><?php echo $row['name']; ?></h3>
            <p class="menu-category"><?php echo $row['category']; ?></p>
            <p class="menu-price">Rs. <?php echo $row['price']; ?></p>

            <form action="add_to_cart.php" method="POST" class="menu-form">
                <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                <input type="number" name="quantity" value="1" min="1" class="qty-input">
                <button type="button" class="add-btn">Add to Cart</button>

            </form>

        </div>

        <?php endwhile; ?>

    </div>

</section>

<script>
document.querySelectorAll(".menu-form").forEach(form => {
    const button = form.querySelector(".add-btn");

    button.addEventListener("click", function () {

        fetch("add_to_cart.php", {
            method: "POST",
            body: new FormData(form)
        })
        .then(res => res.json())
        .then(data => {

            if (data.status === "login_required") {
                window.location.href = "login.php";
                return;
            }

            if (data.status === "success") {
               const cartCount = document.getElementById("cart-count");
                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                }
            }
        });
    });
});
</script>


<?php include('includes/footer.php'); ?>
