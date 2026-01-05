<?php
session_start();
include "includes/header.php";

$user = "root";
$pass = "";
$db   = "canteen_db";
$host = "localhost";

$connection = new mysqli($host, $user, $pass, $db);
if ($connection->connect_error) {
    die("DB Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if ($name === '' || $email === '' || $message === '') {
        $_SESSION['feedback_msg'] = "All fields are required.";
        $_SESSION['feedback_type'] = "error";
        header("Location: contact.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['feedback_msg'] = "Please enter a valid email address.";
        $_SESSION['feedback_type'] = "error";
        header("Location: contact.php");
        exit();
    
     } elseif (!preg_match('/@gmail\.com$/', $email)) {

        $error = "Invalid email!";
     }
    $stmt = $connection->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            $_SESSION['feedback_msg'] = "Thank you! Your feedback has been submitted.";
            $_SESSION['feedback_type'] = "success";
        } else {
            $_SESSION['feedback_msg'] = "Something went wrong. Please try again.";
            $_SESSION['feedback_type'] = "error";
        }
        $stmt->close();
    } else {
        $_SESSION['feedback_msg'] = "Database error. Please try later.";
        $_SESSION['feedback_type'] = "error";
    }

    header("Location: contact.php");
    exit();
}

$feedback_msg = "";
$feedback_type = "";

if (isset($_SESSION['feedback_msg'])) {
    $feedback_msg  = $_SESSION['feedback_msg'];
    $feedback_type = isset($_SESSION['feedback_type']) ? $_SESSION['feedback_type'] : "success";

    unset($_SESSION['feedback_msg']);
    unset($_SESSION['feedback_type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Contact Us - Canteen</title>

<style>
:root{
    --primary: #ff7b00;
    --primary-dark: #d56400;
    --background: #fff4e6;
}
body{
    font-family: Arial, sans-serif;
    background: var(--background);
    margin: 0;
    padding: 0;
}
.contact-section{
    max-width: 1100px;
    margin: 50px auto;
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    border-left: 10px solid var(--primary);
}
.contact-title{ text-align:center; margin-bottom:30px; }
.contact-title h2{ font-size:32px; color:var(--primary); margin:0; }
.contact-title p{ color:#555; margin:6px 0 0; }

.contact-container{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.contact-info{
    background: #fff7ee;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #ffe2c7;
}
.contact-info h3{ color:var(--primary); margin:0 0 10px; }
.contact-info p{ margin:8px 0; font-size:15px; }

form{
    background: #fff7ee;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #ffd9b6;
}
form h3{ color:var(--primary); margin-top:0; }
form label{ font-weight:600; color:var(--primary-dark); display:block; margin-top:12px; }
form input, form textarea{
    width:100%;
    padding:12px;
    margin-top:8px;
    border:1px solid #ffc692;
    border-radius:8px;
    background:#fff;
    box-sizing:border-box;
}
form input:focus, form textarea:focus{ border-color:var(--primary); outline:none; }
form button{
    background:var(--primary);
    color:#fff;
    padding:12px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
    margin-top:6px;
}
form button:hover{ background:var(--primary-dark); }

.alert {
    padding:12px 16px;
    border-radius:8px;
    margin-bottom:20px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:12px;
}
.alert.success { background:#dbffe4; color:#145A32; border-left:6px solid #28a745; }
.alert.error   { background:#ffecec; color:#6a1f1f; border-left:6px solid #dc3545; }

.form-error {
    background:#ffecec;
    color:#6a1f1f;
    border-left:6px solid #dc3545;
    padding:12px 16px;
    border-radius:8px;
    margin-bottom:15px;
    font-weight:600;
    display:none;
}

.fade-out {
    animation: fadeOut 1s ease-in-out forwards;
    animation-delay: 3s;
}
@keyframes fadeOut {
    to { opacity:0; height:0; margin:0; padding:0; overflow:hidden; }
}

@media (max-width: 820px) {
    .contact-container { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<div class="contact-section">
    <div class="contact-title">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you — send feedback or questions below.</p>
    </div>

    <?php if ($feedback_msg !== ""): ?>
        <div id="feedbackAlert" class="alert <?= ($feedback_type === 'success') ? 'success' : 'error' ?>">
            <?= htmlspecialchars($feedback_msg) ?>
        </div>
    <?php endif; ?>

    <div class="contact-container">
        <div class="contact-info">
            <h3>📍 Our Address</h3>
            <p><strong>Location:</strong> Birendra College, chitwan, Nepal</p>

            <h3>📞 Contact</h3>
            <p><strong>Phone:</strong> +977-9812334567</p>
            <p><strong>Email:</strong> canteen@birendra.com</p>

            <h3>🕒 Opening Hours</h3>
            <p>Sun–Fri: 9:00 AM – 6:00 PM</p>
            <p>Saturday: Closed</p>
        </div>

        <form id="feedbackForm" method="POST" novalidate>
            <h3>📝 Send Your Feedback</h3>

            <div id="formError" class="form-error"></div>

            <label for="name">Your Name</label>
            <input id="name" name="name" type="text" required placeholder="Enter your name">

            <label for="email">Your Email</label>
            <input id="email" name="email" type="email" required placeholder="Enter your email">

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" required placeholder="Write your feedback"></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</div>

<script>

document.getElementById('feedbackForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    const errorBox = document.getElementById('formError');

    let errorMsg = "";

    if (name === "" || email === "" || message === "") {
        errorMsg = "All fields are required.";
    } else {
        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
        if (!emailPattern.test(email)) {
            errorMsg = "Please enter a valid email address.";
        }
    }

    if (errorMsg !== "") {
        e.preventDefault();
        errorBox.textContent = errorMsg;
        errorBox.style.display = "block";
    } else {
        error