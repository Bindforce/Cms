<?php
session_start();
include "includes/db_connect.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST['full_name']);
   $email = strtolower(trim($_POST['email']));

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if ($full_name == "" || $email == "" || $username == "" || $password == "" || $confirm == "") {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
        } elseif (!preg_match('/@gmail\.com$/', $email)) {

        $error = "Invalid email!";
} elseif (strlen($password) < 8) {

        $error = "Password must be at least 8 characters long!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {

        $check1 = $conn->prepare("SELECT user_id FROM users WHERE username=?");
        $check1->bind_param("s", $username);
        $check1->execute();
        $check1->store_result();

        $check2 = $conn->prepare("SELECT customer_id FROM customers WHERE username=?");
        $check2->bind_param("s", $username);
        $check2->execute();
        $check2->store_result();

        if ($check1->num_rows > 0 || $check2->num_rows > 0) {
            $error = "Username already exists!";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO customers (full_name, email, username, password)
                 VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $full_name, $email, $username, $hashed);
            $stmt->execute();

            $success = "Account created successfully! Please login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff9a7b, #ff5f3d, #ff3d1f);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            width: 430px;
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }
        .login-title {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #ff3d1f;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            font-weight: bold;
            font-size: 16px;
            display: block;
            margin-bottom: 6px;
        }
        .input-group input {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #aaa;
        }
        .login-bt {
            width: 100%;
            padding: 14px;
            background: #ff3d1f;
            border: none;
            color: white;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
        }
        .error-box {
            background: #ffe6e6;
            padding: 12px;
            border-left: 5px solid red;
            color: red;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .success-box {
            background: #e6ffea;
            padding: 12px;
            border-left: 5px solid green;
            color: green;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="login-box">
    <div class="login-title">Create Account</div>

    <?php if ($error): ?>
        <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success-box"><?= $success ?></div>
        <p style="text-align:center;">
            <a href="login.php" style="color:#ff3d1f;font-weight:bold;">Go to Login</a>
        </p>
    <?php endif; ?>

    <?php if (!$success): ?>
    <form method="POST">

        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="full_name" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>
        </div>

        <button class="login-bt">Create Account</button>

        <p style="text-align:center; margin-top:15px; font-size:15px;">
            Already have account?
            <a href="login.php" style="color:#ff3d1f; font-weight:bold;">Login</a>
        </p>

    </form>
    <?php endif; ?>
</div>

</body>
</html>
