<?php
session_start();

// Check if session ID matches
if (!isset($_GET['session_id']) || $_GET['session_id'] !== session_id()) {
    die('Access denied');
}

if (!isset($_SESSION['username'])) {
    die('Access denied');
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .vulnerable-text {
            background-color: brown;
            color: wheat;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
    <div class="vulnerable-text">
        This page is vulnerable! It uses default admin passwords, exposes your session ID in the URL, and saves your password in plaintext in the database.
    </div>
    <p>This is your dashboard.</p>
</body>
</html>
