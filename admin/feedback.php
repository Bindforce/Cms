<?php
session_start();
include('../includes/db_connect.php');



$feedbacks = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #ff6f3c;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #ff6f3c;
            color: white;
        }

        tr:hover {
            background: #f9f9f9;
        }
    </style>
</head>
<body>

<h1>Customer Feedback</h1>

<table>
    <tr>
       
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        
    </tr>

    <?php while ($row = $feedbacks->fetch_assoc()): ?>
        <tr>
           
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
          
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
