<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'staff') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>staff Dashboard</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #fff7f2;
            display: flex;
        }

        
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #ff6f3c;
            color: white;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .sidebar a {
            display: block;
            padding: 14px 20px;
            color: white;
            text-decoration: none;
            margin: 8px 10px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.35);
            transform: translateX(5px);
        }

        .logout-btn {
            background: #333 !important;
            margin-top: 40px;
        }

       
        .content {
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
        }

        .content h1 {
            font-size: 32px;
            color: #333;
        }

        .cards {
            display: flex;
            gap: 25px;
            margin-top: 30px;
        }

        .card {
            width: 280px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin: 0;
            margin-bottom: 10px;
            font-size: 22px;
            color: #ff6f3c;
        }

        .card p {
            color: #555;
            margin: 0 0 15px;
        }

        .card button {
            background: #ff6f3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .card button:hover {
            background: #ff793f;
        }
    </style>

</head>
<body>

    
    <div class="sidebar">
        <h2>staff Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_menu.php">Manage Menu</a>
        <a href="view_orders.php">View Orders</a>
        <a href="feedback.php">Feedback</a>
        <a href="../admin/logout.php" class="logout-btn">Logout</a>
    </div>

    
    <div class="content">
        <h1>Welcome, staff</h1>

        <div class="cards">

            <div class="card">
                <h3>Manage Menu</h3>
                <p>Add, edit or delete food items.</p>
                <button onclick="location.href='manage_menu.php'">Open</button>
            </div>

            <div class="card">
                <h3>Orders</h3>
                <p>View and process all orders.</p>
                <button onclick="location.href='view_orders.php'">View</button>
            </div>

            <div class="card">
                <h3>Feedback</h3>
                <p>Help us improve</p>
                <button onclick="location.href='feedback.php'">View</button>
            </div>

        </div>
    </div>

</body>
</html>
