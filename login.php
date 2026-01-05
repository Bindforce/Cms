<?php
session_start();
include "includes/db_connect.php";
include "includes/header.php";

$error = "";
$loginSuccess = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();

        if ($password === $row['password']) {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            echo "<script>
                document.body.classList.add('fade-out');
                setTimeout(function() {
                    window.location.href='" .
                    ($row['role'] === 'admin'
                        ? 'admin/dashboard.php'
                        : 'staff/dashboard.php') .
                "';
                }, 500);
            </script>";
            exit();
        } else {
            $error = "Invalid username or password!";
            $loginSuccess = true; 
        }
    }

    if (!$loginSuccess) {

        $sql = "SELECT * FROM customers WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {

                $_SESSION['customer_id'] = $row['customer_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = 'customer';

                header("Location: menu.php");
                exit();
            } else {
                $error = "Invalid username or password!";
            }

        } else {
            $error = "Invalid username or password!";
        }
    }
}  
?>

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
    overflow: hidden;
    transition: opacity 0.5s ease;
}
.fade-out {
    opacity: 0;
}
.login-box {
    width: 430px;
    background: white;
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    animation: pop 0.5s ease;
}
@keyframes pop {
    from {transform: scale(0.8); opacity: 0;}
    to {transform: scale(1); opacity: 1;}
}
.login-title {
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 15px;
    color: #ff3d1f;
}
.input-group {
    margin-bottom: 20px;
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
    outline: none;
    transition: 0.2s;
}
.input-group input:focus {
    border-color: #ff3d1f;
    box-shadow: 0 0 6px rgba(255,61,31,0.4);
}
.login-btn {
    width: 100%;
    padding: 14px;
    background: white;
    border: none;
    color: white;
    font-size: 20px;
    font-weight: bold;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.2s;
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
    transition: 0.2s;
}
.login-bt:hover {
    background: #d73318;
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
</style>

<div class="login-box">

    <div class="login-title">Canteen Login</div>

    <?php if ($error != ""): ?>
        <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="login-bt">Login</button>
        <p style="text-align:center; margin-top:15px; font-size:15px;">
    No account?
    <a href="register.php" style="color:#ff3d1f; font-weight:bold; text-decoration:none;">
        Create one
    </a>
</p>

    </form>
</div>

