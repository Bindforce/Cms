<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../admin/login.php");
    exit();
}


?>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
    body, .admin-section {
        margin-top: 30 !important;
        padding-top: 0 !important;
    }

    
    .main-content {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
</style>


<audio id="ding" src="../assets/sound/notification.mp3"></audio>

<section class="admin-section">
    <h1>🛒 Live Orders</h1>

    <div id="order-area">
        Loading orders...
    </div>
</section>
<style>  
    h1 {
         text-align: center;
           
            margin-bottom: 30px;
        }
</style>



<script>
let lastCount = 0;
let firstLoad = true;


loadOrders();


setInterval(loadOrders, 3000);

function loadOrders() {
    fetch("load_orders.php")
        .then(res => res.text())
        .then(html => {
            document.getElementById("order-area").innerHTML = html;
        });

    
    fetch("order_count.php")
        .then(res => res.text())
        .then(count => {
            count = parseInt(count);

            if (!firstLoad && count > lastCount) {
                document.getElementById("ding").play(); 
            }

            firstLoad = false;
            lastCount = count;
        });
}


function updateStatus(orderId) {
    fetch("update_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "order_id=" + orderId
    })
    .then(res => res.text())
    .then(response => {
        loadOrders(); 
    });
}
</script>
